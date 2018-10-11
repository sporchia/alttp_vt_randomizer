<?php namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Hyrule Castle Escape Region and it's Locations contained within
 */
class HyruleCastleEscape extends Region\Open\HyruleCastleEscape {
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
				&& $this->world->getRegion('North East Light World')->canEnter($locations, $items);
		};

		return $this;
	}

	public function initOverworldGlitches() {
		$this->initNoGlitches();

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('North East Light World')->canEnter($locations, $items);
		};

		$this->locations["Sanctuary"]->setRequirements(function($locations, $items) {
			return ($items->canKillMostThings() && $items->has('KeyH2') && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)))
				|| $items->has('MagicMirror')
				|| $items->has('MoonPearl');
		});

		$this->locations["Sewers - Secret Room - Left"]->setRequirements(function($locations, $items) {
			return ($items->canLiftRocks() && $items->has('MoonPearl')) || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
		});

		$this->locations["Sewers - Secret Room - Middle"]->setRequirements(function($locations, $items) {
			return ($items->canLiftRocks() && $items->has('MoonPearl')) || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
		});

		$this->locations["Sewers - Secret Room - Right"]->setRequirements(function($locations, $items) {
			return ($items->canLiftRocks() && $items->has('MoonPearl')) || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
		});

		$this->locations["Secret Passage"]->setRequirements(function($locations, $items) {
			return $items->canKillMostThings() && $items->has('MoonPearl');
		})

		$this->locations["Link's Uncle"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		})

		return $this;
	}

}
