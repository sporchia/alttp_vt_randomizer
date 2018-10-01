<?php namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Swamp Palace Region and it's Locations contained within
 */
class SwampPalace extends Region\Standard\SwampPalace {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		parent::initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('MagicMirror') && $items->has('Flippers')
				&& $this->world->getRegion('South Light World')->canEnter($locations, $items);
		};

		return $this;
	}
}
