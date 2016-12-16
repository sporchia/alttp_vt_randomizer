<?php namespace Randomizer\Support;

/**
 * Wrapper for Config options
 */
class Config extends Collection {
	public function __construct($items = []) {
		$this->items = is_array($items) ? $items : $this->getArrayableItems($items);
	}

	/**
	 * Get an item from the collection by key.
	 *
	 * @param  mixed  $key
	 * @param  mixed  $default
	 * @return mixed
	 */
	public function get($key, $default = null) {
		if ($this->offsetExists($key)) {
			return $this->items[$key];
		}

		return $default;
	}
}
