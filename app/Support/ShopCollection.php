<?php namespace ALttP\Support;

use ALttP\Shop;

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
}
