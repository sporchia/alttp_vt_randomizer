<?php namespace ALttP\Support;

use ALttP\Boss;

/**
 * Collection of Bosses
 */
class BossCollection extends Collection {
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
	 * Add a Boss to this Collection
	 *
	 * @param Boss $item
	 *
	 * @return $this
	 */
	public function addItem(Boss $item) {
		$this->offsetSet($item->getName(), $item);
		return $this;
	}

	/**
	 * Get a new Collection of Locations that the items have access to.
	 *
	 * @param ItemCollection $items Items available
	 *
	 * @return static
	 */
	public function canBeat(ItemCollection $items) {
		return $this->filter(function($boss) use ($items) {
			return $boss->canBeat($items);
		});
	}
}
