<?php namespace Randomizer\Support;

use Randomizer\Location;
use Randomizer\Item;

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
	 * Deterime if the Locations given have a particular amount of a particular Item
	 *
	 * @param Item $item Item to search for
	 * @param LocationCollection $locations locations to search against
	 * @param int $count the required minimum number of Items
	 *
	 * @return bool
	 */
	public function itemInLocations(Item $item, $locations, $count = 1) {
		foreach ($locations  as $location) {
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
		$item_collection = new ItemCollection($this->filter(function($location) {
				return $location->hasItem();
			})->map(function ($location) {
				return $location->getItem();
			}));
		$item_collection->setWorld($this->first()->getRegion()->getWorld());
		return $item_collection;
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
}
