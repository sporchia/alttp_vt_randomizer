<?php namespace ALttP\Support;

use ALttP\Sprite;

/**
 * Collection of Sprites
 */
class SpriteCollection extends Collection {
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
	 * Add an Sprite to this Collection
	 *
	 * @param Sprite $item
	 *
	 * @return $this
	 */
	public function addItem(Sprite $item) {
		$this->offsetSet($item->getName(), $item);
		return $this;
	}
}
