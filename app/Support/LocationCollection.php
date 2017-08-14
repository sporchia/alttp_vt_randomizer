<?php namespace ALttP\Support;

use ALttP\Location;
use ALttP\Item;

/**
 * Collection of Locations to place Items
 */
class LocationCollection extends Collection {
	/**
	 * Create a new collection.
	 *
	 * @param mixed $items
	 *
	 * @return void
	 */
	public function __construct($items = []) {
		foreach ($this->getArrayableItems($items) as $item) {
			$this->addItem($item);
		}
	}

	/**
	 * Add a Location to this Collection
	 *
	 * @param Location $item
	 *
	 * @return $this
	 */
	public function addItem(Location $item) {
		$this->offsetSet($item->getName(), $item);
		return $this;
	}

	/**
	 * Get a Collection of Locations that do not have Items assigned
	 *
	 * @return static
	 */
	public function getEmptyLocations() {
		return $this->filter(function($location) {
			return !$location->hasItem();
		});
	}

	/**
	 * Get a Collection of Locations that do have Items assigned
	 *
	 * @return static
	 */
	public function getNonEmptyLocations() {
		return $this->filter(function($location) {
			return $location->hasItem();
		});
	}

	/**
	 * Deterime if the Locations given has at least a particular amount of a particular Item
	 *
	 * @param Item $item Item to search for
	 * @param LocationCollection $locations locations to search against
	 * @param int $count the required minimum number of Items
	 *
	 * @return bool
	 */
	public function itemInLocations(Item $item, $locations, $count = 1) {
		foreach ($locations as $location) {
			if ($this->items[$location]->hasItem($item)) {
				$count--;
			}
		}
		return $count < 1;
	}

	/**
	 * Get all the Items assigned in this
	 *
	 * @return ItemCollection
	 */
	public function getItems() {
		return new ItemCollection($this->filter(function($location) {
				return $location->hasItem();
			})->map(function ($location) {
				return $location->getItem();
			}));
	}

	/**
	 * Get all the Regions that this Collection is part of
	 *
	 * @return array
	 */
	public function getRegions() {
		$regions = [];
		foreach ($this->items as $location) {
			if (!in_array($location->getRegion(), $regions)) {
				array_push($regions, $location->getRegion());
			}
		}
		return $regions;
	}

	/**
	 * Get a new Collection of Locations that have (a particlar) Item assigned
	 *
	 * @param Item|null $item Item to search for
	 *
	 * @return static
	 */
	public function locationsWithItem(Item $item = null) {
		return $this->filter(function($location) use ($item) {
			return $location->hasItem($item);
		});
	}

	/**
	 * cut the collection into two, and place the begginging at the end
	 *
	 * @param Location $location Location to cut at
	 *
	 * @return static
	 */
	public function reorderAt(Location $location) {
		$key = array_search($location, array_values($this->items));
		return new static(array_merge(array_slice($this->items, $key), array_slice($this->items, 0, $key)));
	}

	/**
	 * Get a new Collection of Locations that the items have access to.
	 *
	 * @param ItemCollection $items Items available
	 *
	 * @return static
	 */
	public function canAccess(ItemCollection $items) {
		return $this->filter(function($location) use ($items) {
			return $location->canAccess($items);
		});
	}
}
