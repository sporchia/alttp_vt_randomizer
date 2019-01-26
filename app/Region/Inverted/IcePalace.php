<?php namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Ice Palace Region and it's Locations contained within
 */
class IcePalace extends Region\Standard\IcePalace {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		parent::initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->canMeltThings()
				&& (($items->has('Flippers') || ($this->world->config('canWaterFairyRevive', false) && $items->has('BugCatchingNet') && $items->hasBottle())
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items))
					|| ($this->world->config('canFakeFlipper', false) && $items->canFly())
					|| ((($this->world->config('canFakeFlipper', false) && ($items->has('Hammer') || $items->canLiftRocks()))
						|| ($this->world->config('canBombJump', false) && $items->canBombThings()))
						&& $this->world->getRegion('North East Dark World')->canEnter($locations, $items))
					|| ($this->world->config('canFakeFlipper', false) && $items->has('MagicMirror') && $items->has('MoonPearl')
						&& $this->world->getRegion('South Light World')->canEnter($locations, $items))
					|| ($this->world->config('canWaterWalk', false) && $items->has('PegasusBoots')
						&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items)));
		};

		return $this;
	}

	public function initOverworldGlitches() {
		$this->initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->canMeltThings()
				&& ($items->has('Flippers')
					|| $items->has('PegasusBoots')
					|| ($this->world->getRegion('South Light World')->canEnter($locations, $items) && $items->has('MagicMirror'))
					|| ($items->canFly())
					|| ($this->world->getRegion('North East Dark World')->canEnter($locations, $items) && $items->has('Hammer'))
					|| ($this->world->getRegion('North East Dark World')->canEnter($locations, $items) && $items->canLiftRocks()));
		};

		return $this;
	}
}
