<?php namespace ALttP\Region\Inverted\LightWorld\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * East Death Mountain Region and it's Locations contained within
 */
class East extends Region\Standard\LightWorld\DeathMountain\East {
	/**
	 * Create a new Death Mountain Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations->addItem(new Location\Drop\Ether("Ether Tablet", 0x180016, null, $this));
		$this->locations->addItem(new Location\Standing("Spectacle Rock", 0x180140, null, $this));
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		$this->shops["Light World Death Mountain Shop"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		// Allow Super Bunny?
		$this->locations["Spiral Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Mimic Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hammer');
		});

		$this->locations["Paradox Cave Lower - Far Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Paradox Cave Lower - Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Paradox Cave Lower - Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Paradox Cave Lower - Far Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Paradox Cave Lower - Middle"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Paradox Cave Upper - Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Paradox Cave Upper - Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Ether Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('BookOfMudora') && $items->has('Hammer')
				&& ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword(2));
		});

		$this->locations["Spectacle Rock"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hammer');
		});

		$this->can_enter = function($locations, $items) {
			return ($items->canLiftDarkRocks() && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items))
				|| ($items->has('MoonPearl') && $items->has('Hookshot')
					&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items));
		};

		return $this;
	}

	public function initOverworldGlitches() {
		$this->initNoGlitches();

		$this->locations["Spiral Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') || ($items->has('MagicMirror') && $items->hasSword(1));
		});

		$this->locations["Ether Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('BookOfMudora')
				&& (($this->world->config('mode.weapons') == 'swordless' && $items->has('Hammer'))
					|| ($this->world->config('mode.weapons') != 'swordless' && $items->hasSword(2) && ($items->has('Hammer') || $items->has('PegasusBoots'))));
		});

		$this->locations["Spectacle Rock"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && ($items->has('Hammer') || $items->has('Boots'));
		});


		$this->can_enter = function($locations, $items) {
			return ($items->canLiftDarkRocks() && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items))
				|| ($items->has('MoonPearl') && ($items->has('Hookshot') || $items->has('PegasusBoots'))
					&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items));
		};

		return $this;
	}
}
