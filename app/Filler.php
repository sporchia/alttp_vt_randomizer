<?php namespace ALttP;

use ALttP\Support\LocationCollection;

abstract class Filler {
	/**
	 * Returns a Filler of a specified type.
	 *
	 * @param string|null $type type of Filler requested
	 *
	 * @return self
	 */
	public static function factory($type = null) : self {
		switch ($type) {
			case 'Distributed':
				return new Filler\Distributed;
			case 'Random':
			default:
				return new Filler\Random;
		}
	}

	abstract public function shuffleLocations(LocationCollection $locations);
	abstract public function shuffleItems(array $items);
}
