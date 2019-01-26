<?php namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Hyrule Castle Tower Region and it's Locations contained within
 */
class HyruleCastleTower extends Region\Standard\HyruleCastleTower {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		parent::initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->canKillMostThings(8)
				&& $this->world->getRegion('West Dark World Death Mountain')->canEnter($locations, $items);
		};

		return $this;
	}

	public function initOverworldGlitches() {
		return $this->initNoGlitches();
	}
}
