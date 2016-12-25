<?php namespace ALttP\Support;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use ArrayIterator;

/**
 * Collection's aim to expand on the array native, and give meaningful accessors and extra functionality related to the
 * underlying elements.
 */
class Collection implements ArrayAccess, Countable, IteratorAggregate {
	protected $items = [];

	/**
	 * Create a new collection.
	 *
	 * @param mixed $items
	 *
	 * @return void
	 */
	public function __construct($items = []) {
		$this->items = is_array($items) ? $items : $this->getArrayableItems($items);
	}

	/**
	 * Remove an item from the collection by name.
	 *
	 * @return $this
	 */
	public function removeItem($name) {
		$this->offsetUnset($name);
		return $this;
	}

	/**
	 * Get one item randomly from the collection.
	 *
	 * @return mixed
	 */
	public function random() {
		$new = $this->values();
		return $new[mt_rand(0, $this->count() - 1)];
	}

	/**
	 * Get a random subset of the collection of given size
	 *
	 * @param int $number size of the new collection
	 *
	 * @return static
	 */
	public function randomCollection($number = 1) {
		$old = $this->values();
		$new = [];
		while ($number-- > 0 && count($old) > 0) {
			$new = array_merge($new, array_splice($old, mt_rand(0, count($old) - 1), 1));
		}
		return new static($new);
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
			return new static(array_filter($this->items, $callback));
		}

		return new static(array_filter($this->items));
	}

	/**
	 * Get an array of the underlying elements
	 *
	 * @return array
	 */
	public function values() {
		return array_values($this->items);
	}

	/**
	 * Get the items in the collection that are not present in the given items.
	 *
	 * @param mixed $items items to diff against
	 *
	 * @return static
	 */
	public function diff($items) {
		return new static(array_diff($this->items, $this->getArrayableItems($items)));
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
			if ($callback($item, $key) === false) {
				break;
			}
		}

		return $this;
	}

	/**
	 * Get the first item from the collection.
	 *
	 * @return mixed
	 */
	public function first() {
		return reset($this->items);
	}

	/**
	 * Get all of the items in the collection.
	 *
	 * @return array
	 */
	public function all() {
		return $this->items;
	}

	/**
	 * Merge the collection with the given items.
	 *
	 * @param mixed $items
	 *
	 * @return static
	 */
	public function merge($items) {
		return new static(array_merge($this->items, $this->getArrayableItems($items)));
	}

	/**
	 * Get a fresh copy of this object, the underlying items will still be the same
	 *
	 * @return static
	 */
	public function copy() {
		return new static($this->items);
	}

	/**
	 * Reduce the collection to a single value.
	 *
	 * @param callable $callback
	 * @param mixed $initial
	 *
	 * @return mixed
	 */
	public function reduce(callable $callback, $initial = null) {
		return array_reduce($this->items, $callback, $initial);
	}

	/**
	 * Run a map over each of the items.
	 *
	 * @param callable $callback
	 *
	 * @return static
	 */
	public function map(callable $callback) {
		$keys = array_keys($this->items);

		$items = array_map($callback, $this->items, $keys);

		return new static(array_combine($keys, $items));
	}

	/**
	 * Get the keys of the collection items.
	 *
	 * @return array
	 */
	public function keys() {
		return array_keys($this->items);
	}

	/**
	 * Determine if an item exists in the collection by key.
	 *
	 * @param mixed $key
	 *
	 * @return bool
	 */
	public function has($key) {
		return $this->offsetExists($key);
	}

	/**
	 * Get the collection of items as a plain array.
	 *
	 * @return array
	 */
	public function toArray() {
		return array_map(function ($value) {
			return $value instanceof Arrayable ? $value->toArray() : $value;
		}, $this->items);
	}

	/**
	 * Determine if an item exists at an offset.
	 *
	 * @param mixed $offset
	 *
	 * @return bool
	 */
	public function offsetExists($offset) {
		return array_key_exists($offset, $this->items);
	}

	/**
	 * Get an item at a given offset.
	 *
	 * @param mixed $offset
	 *
	 * @return mixed
	 */
	public function offsetGet($offset) {
		return $this->items[$offset];
	}

	/**
	 * Set the item at a given offset.
	 *
	 * @param mixed $offset
	 * @param mixed $value
	 *
	 * @return void
	 */
	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->items[] = $value;
		} else {
			$this->items[$offset] = $value;
		}
	}

	/**
	 * Unset the item at a given offset.
	 *
	 * @param mixed $offset
	 *
	 * @return void
	 */
	public function offsetUnset($offset) {
		unset($this->items[$offset]);
	}

	/**
	 * Count the number of items in the collection.
	 *
	 * @return int
	 */
	public function count() {
		return count($this->items);
	}

	/**
	 * Get an iterator for the items.
	 *
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new ArrayIterator($this->items);
	}

	/**
	 * Results array of items from Collection or Arrayable.
	 *
	 * @param mixed $items
	 *
	 * @return array
	 */
	protected function getArrayableItems($items) {
		if ($items instanceof self) {
			return $items->all();
		}

		return (array) $items;
	}
}
