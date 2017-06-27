<?php namespace ALttP\Filler;

use ALttP\Filler;
use ALttP\Item;
use ALttP\Support\LocationCollection as Locations;
use ALttP\Support\ItemCollection as Items;
use ALttP\World;
use Log;

class RandomSwap extends Filler {
	static private $reject_rate = 3;
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
		// to make sure all bottles are accounted for
		$bottles = Item::all()->filter(function($item) {
			return is_a($item, Item\Bottle::class);
		});
		foreach ($bottles as $bottle) {
			$requiredCollection->addItem($bottle);
		}
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

			$randomized_order_locations = $this->shuffleLocations($randomized_order_locations);

			$this->swapItems($uncollectable_items, $randomized_order_locations, $requiredCollection);
			if (++$i > 50) {
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
	protected function swapItems($uncollectable_items, $locations, $requiredCollection, $force = false) {
		Log::debug(sprintf("Starting: %s items can't be reached (forced: %s)", count($uncollectable_items), $force ? 'yes' : 'no'));
		$swapped = false;
		$i = 0;
		foreach ($uncollectable_items as $item) {
			++$i;
			$check_locations = $locations->locationsWithItem($item);
			if (!$check_locations->count()) {
				throw new \Exception("No Locations found for " . $item->getNiceName());
			}
			foreach ($locations->locationsWithItem($item) as $location) {
				Log::debug(sprintf('[%s] Checking: %s in: %s', $i, $item->getNiceName(), $location->getName()));

				$my_items = $this->world->collectItems();
				if ($location->canAccess($my_items)) {
					Log::debug(sprintf('[%s] Safe: %s in: %s', $i, $item->getNiceName(), $location->getName()));
					continue;
				}

				$my_new_items = $my_items->tempAdd($item);
				$available_after_placement = $locations->filter(function($location) use ($my_new_items) {
					return $location->canAccess($my_new_items);
				});
				$available_locations = $locations->filter(function($location) use ($my_items) {
					return $location->canAccess($my_items);
				});

				// only move item if it opens more locations
				if (!$force && $available_after_placement->count() <= $available_locations->count()) {
					Log::debug(sprintf('[%s] No Opens: %s in: %s before: %s after: %s', $i, $item->getNiceName(),
						$location->getName(), $available_locations->count(), $available_after_placement->count()));
					// jumping out 2 as any additional copies of this item would also not open new locations
					continue 2;
				}

				$new_location = $available_locations->getEmptyLocations()->first();

				if ($new_location) {
					$spheres = $this->world->getLocationSpheres();
					$new_location_sphere = null;
					foreach ($spheres as $level => $sphere) {
						if ($sphere->contains($new_location)) {
							$new_location_sphere = $sphere;
						}
					}
					$swipped = false;
					foreach ($requiredCollection as $required) {
						$move_move = $new_location_sphere->locationsWithItem($required)->filter(function($location) {
							return $location->getName() != 'Uncle';
							//return $location->locked();
						});
						if ($move_move->count() && !is_a($required, Item\Sword::class)) {
							$my_new_items = $my_items->tempAdd($item);
							$my_items_after_swap = $my_new_items->copy()->removeItem($required->getName());
							$available_after_swap = $locations->filter(function($location) use ($my_items_after_swap) {
								return $location->canAccess($my_items_after_swap);
							});
							$available_locations = $locations->filter(function($location) use ($my_new_items) {
								return $location->canAccess($my_new_items);
							});
							if ($available_after_swap->count() < $available_locations->count()) {
								continue;
							}
							$move_from = $move_move->first();
							$move_from->setItem();
							$location->setItem($required);
							Log::debug(sprintf('[%s] Push Moving: %s from: %s to: %s', $i, $required->getNiceName(), $move_from->getName(), $location->getName()));
							$swipped = true;
							break;
						}
					}

					if (!$swipped) {
						$location->setItem();
					} else {
						$new_location = $move_from;
					}
					$new_location->setItem($item);
					Log::debug(sprintf('[%s] Moving: %s from: %s to: %s', $i, $item->getNiceName(), $location->getName(), $new_location->getName()));
					$swapped = $new_location->canAccess($my_items);
					if ($force) {
						return;
					}
				} else {
					Log::debug(sprintf('[%s] No Location: %s from: %s', $i, $item->getNiceName(), $location->getName()));
				}
			}
		}
		if (!$swapped && count($uncollectable_items)) {
			return $this->swapItems($uncollectable_items, $locations, $requiredCollection, true);
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
