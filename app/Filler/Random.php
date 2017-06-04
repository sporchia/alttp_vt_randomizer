<?php namespace ALttP\Filler;

use ALttP\Filler;
use ALttP\Item;
use ALttP\Support\LocationCollection as Locations;
use ALttP\World;
use Log;

class Random extends Filler {
	/**
	 * Fill algorithm application.
	 *
	 * @param array $required items that must be placed
	 * @param array $nice items that would be nice to have placed
	 * @param array $extra items that don't matter if they get placed
	 *
	 * @return null
	 */
	public function fill(array $required, array $nice, array $extra) {
		$randomized_order_locations = $this->shuffleLocations($this->world->getEmptyLocations());

		$my_items = $this->world->collectItems();

		$this->fillItemsInLocations($this->shuffleItems($required), $my_items, $randomized_order_locations, true);

		// at this point we assume all locations are accessable
		$randomized_order_locations = $this->shuffleLocations($this->world->getEmptyLocations());
		$this->fastFillItemsInLocations($this->shuffleItems($nice), $my_items, $randomized_order_locations);

		$this->fastFillItemsInLocations($this->shuffleItems($extra), $my_items, $randomized_order_locations->getEmptyLocations());

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

	protected function fillItemsInLocations($fill_items, $my_items, $locations, $check_for_new_locations = false) {
		Log::debug(sprintf("Filling %s items in %s locations", count($fill_items), $locations->getEmptyLocations()->count()));
		$total_items = count($fill_items);
		reset($fill_items);
		while (count($fill_items) && $locations->getEmptyLocations()->count()) {
			$item = current($fill_items);

			if (!$item) {
				dd($fill_items);
			}

			$available_locations = $locations->getEmptyLocations()->filter(function($location) use ($my_items) {
				return $location->canAccess($my_items);
			});

			$fillable_locations = $available_locations->filter(function($location) use ($item, $my_items) {
				return $location->canFill($item, $my_items);
			});

			if ($fillable_locations->count() == 0) {
				foreach ($locations->getEmptyLocations() as $log_loc) {
					Log::error("SOFT LOCK LOCATION: " . $log_loc->getName());
				}
				throw new \Exception(sprintf('No Available Locations: "%s"', $item->getNiceName()));
			}

			Log::debug(sprintf("Item: %s [%s] Locations: %s of %s",
				$item->getNiceName(), $item->getName(), $locations->getEmptyLocations()->count(), $available_locations->count()));

			if ($check_for_new_locations) {
				$my_new_items = $my_items->tempAdd($item);

				$available_after_placement = $locations->getEmptyLocations()->filter(function($location) use ($my_new_items) {
					return $location->canAccess($my_new_items);
				});

				Log::debug(sprintf("Before: %s After: %s", $available_locations->count(), $available_after_placement->count()));
				if ($available_after_placement->count() <= $available_locations->count()) {
					if (next($fill_items) !== false) {
						Log::debug(sprintf("Skipping Item: %s [%s]", $item->getNiceName(), $item->getName()));
						continue;
					} else {
						end($fill_items);
					}
				}
			}

			$fill_location = (count($fill_items) / $total_items <= .33)
				? $fillable_locations->first()
				: $fillable_locations->last();
			Log::debug(sprintf("Placing Item: %s in %s", $item->getNiceName(), $fill_location->getName()));
			$fill_location->setItem($item);

			unset($fill_items[key($fill_items)]);
			reset($fill_items);

			$my_items = $this->world->collectItems();
		}

		Log::debug(sprintf("Extra Items: %s", count($fill_items)));
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
			$location->setItem($item);
		}
	}
}
