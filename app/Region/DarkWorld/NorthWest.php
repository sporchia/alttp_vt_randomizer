<?php namespace ALttP\Region\DarkWorld;

use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * North West Dark World Region and it's Locations contained within
 */
class NorthWest extends Region {
	protected $name = 'Dark World';

	/**
	 * Create a new North West Dark World Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[cave-063] doorless hut", 0xE9EC, null, $this),
			new Location\Chest("[cave-062] C-shaped house", 0xE9EF, null, $this),
			new Location\Chest("Piece of Heart (Treasure Chest Game)", 0xEDA8, null, $this),
			new Location\Standing("Piece of Heart (Dark World blacksmith pegs)", 0x180006, null, $this),
			new Location\Standing("Piece of Heart (Dark World - bumper cave)", 0x180146, null, $this),
		]);
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[cave-063] doorless hut"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-062] C-shaped house"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Piece of Heart (Treasure Chest Game)"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Piece of Heart (Dark World blacksmith pegs)"]->setRequirements(function($locations, $items) {
			return $items->has('TitansMitt') && $items->has('Hammer');
		});

		$this->locations["Piece of Heart (Dark World - bumper cave)"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('Cape');
		});

		$this->can_enter = function($locations, $items) {
			return ($this->world->getRegion('North East Dark World')->canEnter($locations, $items)
				&& ($items->has('Hookshot')
					&& ($items->has('Hammer')
						|| $items->canLiftRocks()
						|| $items->has('Flippers')))
				|| ($items->has('Hammer')
					&& $items->canLiftRocks())
				|| $items->has("TitansMitt"))
			&& $items->has('MoonPearl');
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
		$this->locations["Piece of Heart (Dark World blacksmith pegs)"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') || $items->hasBottle();
		};

		return $this;
	}
}
