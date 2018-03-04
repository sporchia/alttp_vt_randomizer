<?php namespace ALttP\Region\DeathMountain;

use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\Item;
use ALttP\World;

/**
 * Death Mountain Region and it's Locations contained within
 */
class West extends Region {
	protected $name = 'Death Mountain';

	/**
	 * Create a new Death Mountain Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Npc("Old Man", 0xF69FA, null, $this),
			new Location\Standing("Spectacle Rock Cave", 0x180002, null, $this),
			new Location\Drop\Ether("Ether Tablet", 0x180016, null, $this),
			new Location\Standing("Spectacle Rock", 0x180140, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Old Man"]->setItem(Item::get('MagicMirror'));
		$this->locations["Spectacle Rock Cave"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Ether Tablet"]->setItem(Item::get('Ether'));
		$this->locations["Spectacle Rock"]->setItem(Item::get('PieceOfHeart'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Old Man"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp', $this->world->config('item.require.Lamp', 1));
		});

		$this->locations["Ether Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && ($items->hasUpgradedSword()
					|| ($this->world->config('mode.weapons')== 'swordless' && $items->has('Hammer')))
				&& ($items->has('MagicMirror') || ($items->has('Hammer') && $items->has('Hookshot')));
		});

		$this->locations["Spectacle Rock"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror');
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& ($items->canFly()
					|| ($items->canLiftRocks() && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))));
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for MajorGlitches Mode
	 *
	 * @return $this
	 */
	public function initMajorGlitches() {
		$this->initOverworldGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& ($items->has('PegasusBoots') || $items->hasABottle()
					|| $items->canFly() || ($items->canLiftRocks() && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))));
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->initNoMajorGlitches();

		$this->locations["Ether Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && ($items->hasUpgradedSword()
					|| ($this->world->config('mode.weapons')== 'swordless' && $items->has('Hammer')))
				&& $this->world->getRegion('Tower of Hera')->canEnter($locations, $items);
		});

		$this->locations["Spectacle Rock"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| $items->has('MagicMirror');
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& ($items->has('PegasusBoots')
					|| $items->canFly() || ($items->canLiftRocks() && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))));
		};

		return $this;
	}
}
