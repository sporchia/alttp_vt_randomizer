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
			new Location\Npc("Old Mountain Man", 0xF69FA, null, $this),
			new Location\Standing("Piece of Heart (Spectacle Rock Cave)", 0x180002, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Old Mountain Man"]->setItem(Item::get('MagicMirror'));
		$this->locations["Piece of Heart (Spectacle Rock Cave)"]->setItem(Item::get('PieceOfHeart'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Old Mountain Man"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		});

		$this->can_enter = function($locations, $items) {
			return $items->canFly() || ($items->canLiftRocks() && $items->has('Lamp'));
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
		$this->locations["Old Mountain Man"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		});

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

		$this->can_enter = function($locations, $items) {
			return $items->has('PegasusBoots')
				|| $items->canFly() || ($items->canLiftRocks() && $items->has('Lamp'));
		};

		return $this;
	}
}
