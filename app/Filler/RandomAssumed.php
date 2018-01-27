<?php namespace ALttP\Filler;

use ALttP\Filler;
use ALttP\Item;
use ALttP\Support\ItemCollection as Items;
use Log;

class RandomAssumed extends Filler {
	/**
	 * This fill places items in the first available location that it can possibly be in, assuming that unplaced
	 * items will be reachable. Those items will then have a smaller set of places that they can be placed.
	 *
	 * @param array $dungeon items that must be placed
	 * @param array $required items that must be placed
	 * @param array $nice items that would be nice to have placed
	 * @param array $extra items that don't matter if they get placed
	 *
	 * @return null
	 */
	public function fill(array $dungeon, array $required, array $win, array $nice, array $extra) {
		$randomized_order_locations = $this->shuffleLocations($this->world->getEmptyLocations());

		$this->fillItemsInLocations($dungeon, [], $randomized_order_locations, array_merge($required, $win, $nice));

		// random junk fill
		$gt_locations = $this->world->getRegion('Ganons Tower')->getEmptyLocations()->randomCollection(mt_rand(0, 15));
		$extra = $this->shuffleItems($extra);
		$trash = array_splice($extra, 0, $gt_locations->count());
		$this->fastFillItemsInLocations($trash, $gt_locations);

		$randomized_order_locations = $randomized_order_locations->getEmptyLocations()->reverse();

		$this->fillItemsInLocations($this->shuffleItems($required), $this->shuffleItems($win), $randomized_order_locations);

		$randomized_order_locations = $this->shuffleLocations($randomized_order_locations->getEmptyLocations());

		$this->fastFillItemsInLocations($this->shuffleItems($nice), $randomized_order_locations);

		$this->fastFillItemsInLocations($this->shuffleItems($extra), $randomized_order_locations->getEmptyLocations());
	}

	protected function fillItemsInLocations($fill_items, $win_items, $locations, $base_assumed_items = []) {
		$remaining_fill_items = new Items($fill_items);
		Log::debug(sprintf("Filling %s items in %s locations", $remaining_fill_items->count(),
			$locations->getEmptyLocations()->count()));

		if ($remaining_fill_items->count() > $locations->getEmptyLocations()->count()) {
			throw new \Exception("Trying to fill more items than available locations.");
		}

		if ($this->world->config('region.reachability', 'random') == 'random') {
			$min_reachable_locations = count($win_items);
			Log::debug(sprintf("Will try for at least %s reachable locations", $min_reachable_locations));
		}

		foreach ($fill_items as $key => $item) {
			$assumed_items = $this->world->collectItems($remaining_fill_items->removeItem($item->getName())->merge($base_assumed_items));

			$perform_access_check = true;

			// Check if the world is winnable with all the $win_items
			if ($this->world->config('region.reachability', 'random') == 'random') {
				$merged_items = $assumed_items->merge($win_items);
				if ($this->world->getWinCondition()($merged_items))
				{
					$reachable_locations = $locations->filter(function($location) use ($assumed_items) {
						return !$location->hasItem() && $location->canAccess($assumed_items);
					});
					if (count($reachable_locations) >= $min_reachable_locations)
					{
						// Allow placing this item pretty much anywhere
						$perform_access_check = false;
					}
				}
			}

			$fillable_locations = $locations->filter(function($location) use ($item, $assumed_items, $perform_access_check) {
				return !$location->hasItem() && $location->canFill($item, $assumed_items, $perform_access_check);
			});

			if ($fillable_locations->count() == 0) {
				throw new \Exception(sprintf('No Available Locations: "%s"', $item->getNiceName()));
			}

			$fill_location = $fillable_locations->first();

			Log::debug(sprintf("Placing Item: %s in %s", $item->getNiceName(), $fill_location->getName()));

			$fill_location->setItem($item);
		}

		// Put items needed to win in reachable locations
		$assumed_items = $this->world->collectItems(new Items($base_assumed_items));
		$reachable_locations = $locations->filter(function($location) use ($assumed_items) {
			return !$location->hasItem() && $location->canAccess($assumed_items);
		});
		$this->fastFillItemsInLocations($win_items, $reachable_locations);
	}
}
