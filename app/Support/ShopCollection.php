<?php namespace ALttP\Support;

use ALttP\Shop;
use ALttP\Support\LocationCollection;

/**
 * Collection of Shops
 */
class ShopCollection extends Collection {
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
	 * Add a Shop to this Collection
	 *
	 * @param Shop $item
	 *
	 * @return $this
	 */
	public function addItem(Shop $item) {
		$this->offsetSet($item->getName(), $item);
		return $this;
	}

	/**
	 * Get all the Items assigned in this
	 *
	 * @param World $world allow a world context to be passed in for item collection being returned
	 *
	 * @return ItemCollection
	 */
	public function getItems(World $world = null) {
		return $this->reduce(function ($locations, $shop) {
			return $locations->merge($shop->getLocations());
		}, new LocationCollection)->getItems($world);
	}

	public function getLocations() {
		return $this->reduce(function ($locations, $shop) {
			return $locations->merge($shop->getLocations());
		}, new LocationCollection);
	}
}
