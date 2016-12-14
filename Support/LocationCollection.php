<?php namespace Randomizer\Support;

use Randomizer\Location;
use Randomizer\Item;

class LocationCollection extends Collection {
	public function addItem(Location $item) {
		$this->offsetSet($item->getName(), $item);
	}

	public function getEmptyLocations() {
		return $this->filter(function($location) {
			return !$location->hasItem();
		});
	}

	public function getNonEmptyLocations() {
		return $this->filter(function($location) {
			return $location->hasItem();
		});
	}

	public function itemInLocations(Item $item, $locations, $count = 1) {
		foreach ($locations  as $location) {
			if ($this->items[$location]->hasItem($item)) {
				$count--;
			}
		}
		return $count < 1;
	}

	public function getItems() {
		$item_collection = new ItemCollection($this->filter(function($location) {
				return $location->hasItem();
			})->map(function ($location) {
				return $location->getItem();
			}));
		$item_collection->setWorld($this->first()->getRegion()->getWorld());
		return $item_collection;
	}

	public function getRegions() {
		$regions = [];
		foreach ($this->items as $location) {
			if (!in_array($location->getRegion(), $regions)) {
				array_push($regions, $location->getRegion());
			}
		}
		return $regions;
	}

	public function locationsWithItem(Item $item = null) {
		return $this->filter(function($location) use ($item) {
			return $location->hasItem($item);
		});
	}
}
