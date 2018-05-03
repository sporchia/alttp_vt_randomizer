<?php namespace ALttP\Filler;

use ALttP\Filler;
use ALttP\Item;
use ALttP\Support\ItemCollection as Items;
use Log;

class RandomAssumed extends Filler {
	private $ganon_junk_lower = 0;
	private $ganon_junk_upper = 15;

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
	public function fill(array $dungeon, array $required, array $nice, array $extra, array $initial = null) {
		$randomized_order_locations = $this->shuffleLocations($this->world->getEmptyLocations());

		$this->fillItemsInLocations($dungeon, $randomized_order_locations, array_merge($required, $nice, $initial));

		// Initial items fill
		$randomized_order_locations = $this->shuffleLocations($this->world->getEmptyLocations());
		$this->fillItemsInLocations($initial, $randomized_order_locations);

		// random junk fill
		$gt_locations = $this->world->getRegion('Ganons Tower')->getEmptyLocations()
			->randomCollection(mt_rand($this->ganon_junk_lower, $this->ganon_junk_upper));
		
		$extra = $this->shuffleItems($extra);
		$trash = array_splice($extra, 0, $gt_locations->count());
		$this->fastFillItemsInLocations($trash, $gt_locations);

		$randomized_order_locations = $randomized_order_locations->getEmptyLocations()->reverse();

		$this->fillItemsInLocations($this->shuffleItems($required), $randomized_order_locations, $initial);

		$randomized_order_locations = $this->shuffleLocations($randomized_order_locations->getEmptyLocations());

		$this->fastFillItemsInLocations($this->shuffleItems($nice), $randomized_order_locations);

		$this->fastFillItemsInLocations($this->shuffleItems($extra), $randomized_order_locations->getEmptyLocations());
	}

	/**
	 * This fill places items in the first available location that it can possibly be in, assuming that unplaced
	 * items will be reachable. Those items will then have a smaller set of places that they can be placed.
	 *
	 * @param int $min minimum junk items to be placed
	 * @param int $max maximum junk items to be placed
	 *
	 * @return $this
	 */
	public function setGanonJunkLimits(int $min, int $max) {
		$this->ganon_junk_lower = $min;
		$this->ganon_junk_upper = $max;

		return $this;
	}

	protected function fillItemsInLocations($fill_items, $locations, $base_assumed_items = []) {
		$remaining_fill_items = new Items($fill_items, $this->world);
		Log::debug(sprintf("Filling %s items in %s locations", $remaining_fill_items->count(),
			$locations->getEmptyLocations()->count()));

		$this->world->setCurrentlyFillingItems($remaining_fill_items);

		if ($remaining_fill_items->count() > $locations->getEmptyLocations()->count()) {
			throw new \Exception("Trying to fill more items than available locations.");
		}

		foreach ($fill_items as $key => $item) {
			$assumed_items = $this->world->collectItems($remaining_fill_items->removeItem($item->getName())->merge($base_assumed_items));

			$fillable_locations = $locations->filter(function($location) use ($item, $assumed_items) {
				return !$location->hasItem() && $location->canFill($item, $assumed_items);
			});

			if ($fillable_locations->count() == 0) {
				throw new \Exception(sprintf('No Available Locations: "%s" %s', $item->getNiceName(),
					json_encode($remaining_fill_items->map(function($i){return $i->getName();}))));
			}

			if ($item instanceof Item\Compass || $item instanceof Item\Map) {
				$fill_location = $fillable_locations->random();
			} else {
				$fill_location = $fillable_locations->first();
			}

			Log::debug(sprintf("Placing Item: %s in %s", $item->getNiceName(), $fill_location->getName()));

			$fill_location->setItem($item);
		}
	}
}
