<?php namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Ganons Tower Region and it's Locations contained within
 */
class GanonsTower extends Region\Standard\GanonsTower {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		parent::initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return ($this->world->config('canDungeonRevive', false) || $items->has('MoonPearl'))
				&& $items->has('Crystal1')
				&& $items->has('Crystal2')
				&& $items->has('Crystal3')
				&& $items->has('Crystal4')
				&& $items->has('Crystal5')
				&& $items->has('Crystal6')
				&& $items->has('Crystal7')
				&& $this->world->getRegion('North East Light World')->canEnter($locations, $items);
		};

		return $this;
	}

	public function initOverworldGlitches() {
		$this->initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->has('Crystal1')
				&& $items->has('Crystal2')
				&& $items->has('Crystal3')
				&& $items->has('Crystal4')
				&& $items->has('Crystal5')
				&& $items->has('Crystal6')
				&& $items->has('Crystal7')
				&& $this->world->getRegion('North East Light World')->canEnter($locations, $items);
		};

		return $this;
	}
}
