<?php namespace ALttP\Filler;

use ALttP\Filler;
use ALttP\Item;
use ALttP\Support\LocationCollection as Locations;
use ALttP\Support\ItemCollection as Items;
use ALttP\World;
use Log;

class Troll extends Filler {
	/**
	 * Fill algorithm application. So, place things, then swap them around until the world is fully open?
	 *
	 * @param array $required items that must be placed
	 * @param array $nice items that would be nice to have placed
	 * @param array $extra items that don't matter if they get placed
	 *
	 * @return null
	 */
	public function fill(array $required, array $nice, array $extra) {
		$randomized_order_locations = $this->shuffleLocations($this->world->getEmptyLocations());
		$requiredCollection = new Items($required);
		$my_items = $this->world->collectItems();

		$this->fastFillItemsInLocations($this->shuffleItems(array_merge($required, $nice)), $my_items, $randomized_order_locations);

		// so now we have items in locations, lets check if there are any inaccessables
		$i = 0;
		do {
			$my_items = $this->world->collectItems();
			$cannot_reach = $this->world->getLocationsWithItem()->filter(function($location) use ($my_items) {
				return !$location->canAccess($my_items);
			});

			$uncollectable_items = $this->shuffleItems($requiredCollection->intersect($cannot_reach->getItems())->values());

			$this->swapItems($uncollectable_items, $randomized_order_locations);
			if (++$i > 500) {
				throw new \Exception("Max nesting reached looking for available locations");
			}
		} while (count($uncollectable_items));

		$my_items = $this->world->collectItems();

		// at this point we assume all locations are accessable
		$randomized_order_locations = $this->shuffleLocations($this->world->getEmptyLocations());

		$this->fastFillItemsInLocations($this->shuffleItems($extra), $my_items, $randomized_order_locations);

		$my_items = $this->world->collectItems();

		// Inaccessible Locations
		$this->world->getEmptyLocations()->filter(function($location) use ($my_items) {
			return !$location->canAccess($my_items);
		})->each(function($location) {
			$location->setItem(new Item('ChocoboEgg', 'Chocobo Egg', [0x5A]));
		});
	}

	protected function shuffleLocations(Locations $locations) {
		return $locations->randomCollection($locations->count());
	}

	protected function shuffleItems(array $items) {
		return mt_shuffle($items);
	}

	/**
	 * move items that are stuck in the world, prefering items that open new locations
	 * If no items open a new location we might have a cycle lock. we then force one to move.
	 */
	protected function swapItems($uncollectable_items, $locations, $force = false) {
		Log::debug(sprintf("Starting: %s items can't be reached", count($uncollectable_items)));
		$swapped = false;
		$i = 0;
		foreach ($uncollectable_items as $item) {
			++$i;
			foreach ($locations->locationsWithItem($item) as $location) {
				$my_items = $this->world->collectItems();

				$my_new_items = $my_items->tempAdd($item);
				$available_after_placement = $locations->filter(function($location) use ($my_new_items, $force) {
					return $location->canAccess($my_new_items);// && ($force || !$location->canAccess(new Items)); // not free pool
				});
				$available_locations = $locations->filter(function($location) use ($my_items, $force) {
					return $location->canAccess($my_items);// && ($force || !$location->canAccess(new Items)); // not free pool
				});

				// only move item if it opens more locations
				if (!$force && $available_after_placement->count() <= $available_locations->count()) {
					Log::debug(sprintf('[%s]No Opens: %s in: %s before: %s after: %s', $i, $item->getNiceName(),
						$location->getName(), $available_locations->count(), $available_after_placement->count()));
					continue 2;
				}

				if (!$location->canAccess($my_items)) {
					$spheres = $this->world->getLocationSpheres();
					$optimal_sphere = $spheres[1];
					$low_items = $optimal_sphere->getItems()->count();
					foreach ($spheres as $sphere => $sphere_locations) {
						Log::debug("CHECK Sphere: $sphere");
						$sphere_items = $sphere_locations->getItems();
						if ($sphere_locations->getEmptyLocations()->count() && $sphere_items->count() < $low_items) {
							$optimal_sphere = $sphere_locations;
							$low_items = $sphere_items->count();
						}
					}
					Log::debug("LOW: $low_items");

					$new_location = $optimal_sphere->getEmptyLocations()->first();
					if ($new_location) {
						$location->setItem();
						$new_location->setItem($item);
						Log::debug(sprintf('[%s]Moving: %s from: %s to: %s', $i, $item->getNiceName(), $location->getName(), $new_location->getName()));
						$swapped = true;
						$force = false;
					}
				} else {
					Log::debug(sprintf('[%s]Safe: %s in: %s', $i, $item->getNiceName(), $location->getName()));
				}
			}
		}
		if (!$swapped && count($uncollectable_items)) {
			Log::debug("Forcing");
			return $this->swapItems($uncollectable_items, $locations, true);
		}
	}

	protected function fastFillItemsInLocations($fill_items, $my_items, $locations) {
		foreach($locations as $location) {
			if ($location->hasItem()) {
				continue;
			}
			$item = array_pop($fill_items);
			if (!$item) {
				break;
			}
			Log::debug(sprintf('Placing: %s in %s', $item->getNiceName(), $location->getName()));
			$location->setItem($item);
		}
	}
}
