<?php namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Tower of Hera Region and it's Locations contained within
 */
class TowerOfHera extends Region\Standard\TowerOfHera {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		parent::initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->has('Hammer')
				&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
		};

		return $this;
	}

	public function initOverworldGlitches() {
		$this->initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl')
				&& (($items->has('Hammer') && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items))
					|| ($items->has('PegasusBoots')  && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)));
		};

		return $this;
	}
}
