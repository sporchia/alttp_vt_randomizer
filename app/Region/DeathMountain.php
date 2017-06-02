<?php namespace ALttP\Region;

use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\Item;
use ALttP\World;

/**
 * Death Mountain Region and it's Locations contained within
 */
class DeathMountain extends Region {
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
			new Location\Drop("Ether Tablet", 0x180016, null, $this),
			new Location\Npc("Old Mountain Man", 0xF69FA, null, $this),
			new Location\Standing("Piece of Heart (Spectacle Rock Cave)", 0x180002, null, $this),
			new Location\Standing("Piece of Heart (Spectacle Rock)", 0x180140, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Ether Tablet"]->setItem(Item::get('Ether'));
		$this->locations["Old Mountain Man"]->setItem(Item::get('MagicMirror'));
		$this->locations["Piece of Heart (Spectacle Rock Cave)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (Spectacle Rock)"]->setItem(Item::get('PieceOfHeart'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Ether Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora')
				&& $items->hasUpgradedSword()
				&& ($items->has('MagicMirror')
					|| ($this->world->getRegion('East Death Mountain')->canEnter($locations, $items) && $items->has('Hammer')));
		});

		$this->locations["Old Mountain Man"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return $items->has('Lamp');
			}
			return true;
		});

		$this->locations["Piece of Heart (Spectacle Rock Cave)"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Piece of Heart (Spectacle Rock)"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror');
		});

		$this->can_enter = function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return $items->canFly() || ($items->canLiftRocks() && $items->has('Lamp'));
			}
			return $items->canFly() || $items->canLiftRocks();
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Glitched Mode
	 *
	 * @return $this
	 */
	public function initGlitched() {
		$this->locations["Ether Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && $items->hasUpgradedSword();
		});

		return $this;
	}
}
