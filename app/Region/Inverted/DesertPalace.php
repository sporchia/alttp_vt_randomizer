<?php namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Desert Palace Region and it's Locations contained within
 */
class DesertPalace extends Region\Standard\DesertPalace {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		parent::initNoGlitches();

		// Bunny can use Book!
		$this->can_enter = function($locations, $items) {
			return ($this->world->config('canDungeonRevive', false) || $items->has('MoonPearl'))
				&& ($items->has('BookOfMudora')
					&& $this->world->getRegion('South Light World')->canEnter($locations, $items));
		};

		return $this;
	}

	public function initOverworldGlitches() {
		$this->initNoGlitches();

		$this->locations["Desert Palace - Boss"]->setRequirements(function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->canLightTorches()
				&& $items->has('BigKeyP2') && $items->has('KeyP2')
				&& $this->boss->canBeat($items, $locations)
				&& (($items->has('BookOfMudora') && $items->canLiftRocks())
					|| ($items->has('PegasusBoots')))
				&& $items->has('MoonPearl');
		});

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('South Light World')->canEnter($locations, $items)
				&& ($items->has('BookOfMudora')
					|| ($items->has('MoonPearl') && $items->has('PegasusBoots')));
		};

		return $this;
	}
}
