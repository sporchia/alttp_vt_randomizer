<?php namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Skull Woods Region and it's Locations contained within
 */
class SkullWoods extends Region\Standard\SkullWoods {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		parent::initNoGlitches();

		// @TODO: figure out a better way of the moon pearl requirement in Standard Region file.
		$this->locations["Skull Woods - Bridge Room"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->locations["Skull Woods - Boss"]->setRequirements(function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('FireRod')
				&& ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword())
				&& $items->has('KeyD3', 3)
				&& $this->boss->canBeat($items, $locations)
				&& (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD3') || $this->locations["Skull Woods - Boss"]->hasItem(Item::get('CompassD3')))
				&& (!$this->world->config('region.wildMaps', false) || $items->has('MapD3') || $this->locations["Skull Woods - Boss"]->hasItem(Item::get('MapD3')));
		});

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		};

		return $this;
	}

	public function initOverworldGlitches() {
		return $this->initNoGlitches();
	}
}
