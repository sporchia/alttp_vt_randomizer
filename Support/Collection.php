<?php namespace Randomizer\Support;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use ArrayIterator;

abstract class Collection implements ArrayAccess, Countable, IteratorAggregate {
	protected $items = [];

	public function __construct($items = []) {
		foreach ($this->getArrayableItems($items) as $item) {
			$this->addItem($item);
		}
	}

	public function removeItem($name) {
		$this->offsetUnset($name);
	}

	public function random() {
		$new = $this->values();
		return $new[mt_rand(0, $this->count() - 1)];
	}

	public function randomCollection($number = 1) {
		$old = $this->values();
		$new = [];
		while ($number-- > 0 && count($old) > 0) {
			$new = array_merge($new, array_splice($old, mt_rand(0, count($old) - 1), 1));
		}
		return new static($new);
	}

	public function filter(callable $callback = null) {
		if ($callback) {
			return new static(array_filter($this->items, $callback));
		}

		return new static(array_filter($this->items));
	}

	public function values() {
		return array_values($this->items);
	}

	public function diff($items) {
		return new static(array_diff($this->items, $this->getArrayableItems($items)));
	}

	public function each(callable $callback) {
		foreach ($this->items as $key => $item) {
			if ($callback($item, $key) === false) {
				break;
			}
		}

		return $this;
	}

	public function first() {
		return reset($this->items);
	}

	public function all() {
		return $this->items;
	}

	public function merge($items) {
		return new static(array_merge($this->items, $this->getArrayableItems($items)));
	}

	public function clone() {
		return new static($this->items);
	}

	public function reduce(callable $callback, $initial = null) {
		return array_reduce($this->items, $callback, $initial);
	}

	public function map(callable $callback) {
		$keys = array_keys($this->items);

		$items = array_map($callback, $this->items, $keys);

		return new static(array_combine($keys, $items));
	}

	public function keys() {
		return array_keys($this->items);
	}

	public function has($key) {
		return $this->offsetExists($key);
	}

	public function toArray() {
		return array_map(function ($value) {
			return $value instanceof Arrayable ? $value->toArray() : $value;
		}, $this->items);
	}

	public function offsetExists($offset) {
		return array_key_exists($offset, $this->items);
	}

	public function offsetGet($offset) {
		return $this->items[$offset];
	}

	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->items[] = $value;
		} else {
			$this->items[$offset] = $value;
		}
	}

	public function offsetUnset($offset) {
		unset($this->items[$offset]);
	}

	public function count() {
		return count($this->items);
	}

	public function getIterator() {
		return new ArrayIterator($this->items);
	}

	protected function getArrayableItems($items) {
		if ($items instanceof self) {
			return $items->all();
		}

		return (array) $items;
	}
}
