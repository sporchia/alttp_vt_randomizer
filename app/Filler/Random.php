<?php namespace ALttP\Filler;

use ALttP\Filler;
use ALttP\Support\ItemCollection as Items;
use ALttP\Support\LocationCollection as Locations;

class Random extends Filler {
	/**
	 * Fill algorithm application.
	 *
	 * @param LocationCollection $locations locations to fill
	 * @param ItemCollection $required items that must be placed
	 * @param ItemCollection $nice items that would be nice to have placed
	 * @param ItemCollection $extra items that don't matter if they get placed
	 *
	 * @return null
	 */
	public function fill(Locations $locations, Items $required, Items $nice, Items $extra) {
	}

	public function shuffleLocations(Locations $locations) {
		return $locations->randomCollection($locations->count());
	}

	public function shuffleItems(array $items) {
		return mt_shuffle($items);
	}
}
