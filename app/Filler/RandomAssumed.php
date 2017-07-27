<?php namespace ALttP\Filler;

use ALttP\Filler;
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
	public function fill(array $dungeon, array $required, array $nice, array $extra) {
		$randomized_order_locations = $this->shuffleLocations($this->world->getEmptyLocations());

		$this->fillItemsInLocations($dungeon, $randomized_order_locations, $required);

		//$randomized_order_locations = $randomized_order_locations->getEmptyLocations()->reverse();
		$randomized_order_locations = $this->shuffleLocations($randomized_order_locations->getEmptyLocations());

		$this->fillItemsInLocations($this->shuffleItems($required), $randomized_order_locations);

		$randomized_order_locations = $this->shuffleLocations($randomized_order_locations->getEmptyLocations());

		$this->fastFillItemsInLocations($this->shuffleItems($nice), $randomized_order_locations);

		$this->fastFillItemsInLocations($this->shuffleItems($extra), $randomized_order_locations->getEmptyLocations());
	}

	protected function fillItemsInLocations($fill_items, $locations, $base_assumed_items = []) {
		$remaining_fill_items = new Items($fill_items);
		Log::debug(sprintf("Filling %s items in %s locations", $remaining_fill_items->count(),
			$locations->getEmptyLocations()->count()));

		if ($remaining_fill_items->count() > $locations->getEmptyLocations()->count()) {
			throw new \Exception("Trying to fill more items than available locations.");
		}

		foreach ($fill_items as $key => $item) {
			$assumed_items = $this->world->collectItems($remaining_fill_items->removeItem($item->getName())->merge($base_assumed_items));

			$fillable_locations = $locations->filter(function($location) use ($item, $assumed_items) {
				return !$location->hasItem() && $location->canFill($item, $assumed_items);
			});

			if ($fillable_locations->count() == 0) {
				throw new \Exception(sprintf('No Available Locations: "%s"', $item->getNiceName()));
			}

			$fill_location = $fillable_locations->first();

			Log::debug(sprintf("Placing Item: %s in %s", $item->getNiceName(), $fill_location->getName()));

			$fill_location->setItem($item);
		}
	}
}
