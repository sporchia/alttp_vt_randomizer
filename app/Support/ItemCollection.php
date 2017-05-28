<?php namespace ALttP\Support;

use ALttP\Item;

/**
 * Collection of Items, maintains counts of items collected as well.
 */
class ItemCollection extends Collection {
	protected $item_counts = [];

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
	 * Add an Item to this Collection
	 *
	 * @param Item $item
	 *
	 * @return $this
	 */
	public function addItem(Item $item) {
		$this->offsetSet($item->getName(), $item);
		if (!isset($this->item_counts[$item->getName()])) {
			$this->item_counts[$item->getName()] = 0;
		}

		$this->item_counts[$item->getName()]++;

		return $this;
	}

	/**
	 * Remove an item from the collection by name.
	 *
	 * @return $this
	 */
	public function removeItem($name) {
		if (!isset($this->item_counts[$name])) {
			return $this;
		}
		$this->item_counts[$name]--;
		if ($this->item_counts[$name] === 0) {
			$this->offsetUnset($name);
		}

		return $this;
	}

	/**
	 * Run a filter over each of the items.
	 *
	 * @param callable|null $callback
	 *
	 * @return static
	 */
	public function filter(callable $callback = null) {
		if ($callback) {
			return new static(array_filter($this->values(), $callback));
		}

		return new static(array_filter($this->values()));
	}

	/**
	 * Get an array of the underlying elements
	 *
	 * @return array
	 */
	public function values() {
		$values = [];
		foreach ($this->items as $item) {
			for ($i = 0; $i < $this->item_counts[$item->getName()]; $i++) {
				$values[] = $item;
			}
		}
		return $values;
	}

	/**
	 * Get the items in the collection that are not present in the given items.
	 *
	 * @param mixed $items items to diff against
	 *
	 * @return static
	 */
	public function diff($items) {
		if (!count($items)) {
			return $this->copy();
		}

		// TODO: this might not be correct
		if (!is_a($items, static::class)) {
			return parent::diff($items);
		}

		$diffed = $this->copy();

		foreach ($diffed->item_counts as $name => $amount) {
			if (isset($items->item_counts[$name])) {
				if ($items->item_counts[$name] < $amount) {
					$diffed->item_counts[$name] = $amount - $items->item_counts[$name];
				} else {
					$diffed->offsetUnset($name);
				}
			}
		}
		return $diffed;
	}

	/**
	 * Execute a callback over each item.
	 *
	 * @param callable $callback
	 *
	 * @return $this
	 */
	public function each(callable $callback) {
		foreach ($this->items as $key => $item) {
			for ($i = 0; $i < $this->item_counts[$key]; $i++) {
				if ($callback($item, $key) === false) {
					break;
				}
			}
		}

		return $this;
	}

	/**
	 * Merge the collection with the given items.
	 *
	 * @TODO: this whole function may be incorrect
	 *
	 * @param mixed $items
	 *
	 * @return static
	 */
	public function merge($items) {
		if (!count($items)) {
			return $this->copy();
		}

		if (!is_a($items, static::class)) {
			return parent::diff($items);
		}

		$merged = $this->copy();

		foreach ($this->getArrayableItems($items) as $item) {
			$merged->addItem($item);
		}

		return $merged;
	}

	/**
	 * Get a fresh copy of this object, the underlying items will still be the same
	 *
	 * @return static
	 */
	public function copy() {
		$new = new static($this->items);
		$new->item_counts = $this->item_counts;

		return $new;
	}

	/**
	 * Run a map over each of the items.
	 *
	 * @param callable $callback
	 *
	 * @return array
	 */
	public function map(callable $callback) {
		$items = [];

		foreach ($this->item_counts as $key => $count) {
			for ($i = 0; $i < $count; $i++) {
				$items[] = $this->items[$key];
			}
		}

		return array_map($callback, $items);
	}

	/**
	 * Determine if an item exists in the collection by key.
	 *
	 * @param mixed $key
	 * @param int $at_least mininum number of item in collection
	 *
	 * @return bool
	 */
	public function has($key, $at_least = 1) {
		return $this->offsetExists($key) && $this->item_counts[$key] >= $at_least;
	}

	/**
	 * Count the number of items in the collection.
	 *
	 * @return int
	 */
	public function count() {
		return array_sum($this->item_counts);
	}

	/**
	 * Unset the item at a given offset.
	 *
	 * @param mixed $offset
	 *
	 * @return void
	 */
	public function offsetUnset($offset) {
		unset($this->item_counts[$offset]);
		unset($this->items[$offset]);
	}

	/**
	 * Add an Item to a copy of this Collection
	 *
	 * @param Item $item
	 *
	 * @return static
	 */
	public function tempAdd(Item $item) {
		$temp = $this->copy();
		return $temp->addItem($item);
	}

	/**
	 * Requirements for lifting rocks
	 *
	 * @return bool
	 */
	public function canLiftRocks() {
		return $this->has('PowerGlove')
			|| $this->has('ProgressiveGlove')
			|| $this->has('TitansMitt');
	}

	/**
	 * Requirements for lifting dark rocks
	 *
	 * @return bool
	 */
	public function canLiftDarkRocks() {
		return $this->has('TitansMitt')
			|| $this->has('ProgressiveGlove', 2);
	}

	/**
	 * Requirements for lighting torches
	 *
	 * @return bool
	 */
	public function canLightTorches() {
		return $this->has('FireRod') || $this->has('Lamp');
	}

	/**
	 * Requirements for melting things, like ice statues
	 *
	 * @return bool
	 */
	public function canMeltThings() {
		return $this->has('FireRod')
			|| ($this->has('Bombos') && $this->hasSword());
	}

	/**
	 * Requirements for fast travel through the duck
	 *
	 * @return bool
	 */
	public function canFly() {
		return $this->has('OcarinaActive') || $this->has('OcarinaInactive');
	}

	/**
	 * Requirements for lobbing arrows at things
	 *
	 * @return bool
	 */
	public function canShootArrows() {
		return $this->has('Bow')
			|| $this->has('BowAndArrows')
			|| $this->has('BowAndSilverArrows');
	}

	/**
	 * Requirements for having a sword
	 *
	 * @return bool
	 */
	public function hasSword() {
		return $this->has('L1Sword')
			|| $this->has('L1SwordAndShield')
			|| $this->has('ProgressiveSword')
			|| $this->hasUpgradedSword();
	}

	/**
	 * Requirements for having an upgraded sword
	 *
	 * @return bool
	 */
	public function hasUpgradedSword() {
		return $this->has('L2Sword')
			|| $this->has('MasterSword')
			|| $this->has('L3Sword')
			|| $this->has('L4Sword')
			|| $this->has('ProgressiveSword', 2);
	}

	/**
	 * Requirements for having a bottle
	 *
	 * @return bool
	 */
	public function hasABottle() {
		return $this->has('BottleWithBee')
			|| $this->has('BottleWithFairy')
			|| $this->has('BottleWithRedPotion')
			|| $this->has('BottleWithGreenPotion')
			|| $this->has('BottleWithBluePotion')
			|| $this->has('Bottle')
			|| $this->has('BottleWithGoldBee');
	}
}
