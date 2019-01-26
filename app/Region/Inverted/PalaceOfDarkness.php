<?php namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\Item;
use ALttP\World;

/**
 * Palace of Darkness Region and it's Locations contained within
 */
class PalaceOfDarkness extends Region\Standard\PalaceOfDarkness {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		parent::initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('North East Dark World')->canEnter($locations, $items);
		};

		return $this;
	}

	public function initOverworldGlitches() {
		return $this->initNoGlitches();
	}

}
