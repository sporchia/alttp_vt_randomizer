<?php namespace ALttP\Region\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * South Dark World Region and it's Locations contained within
 */
class South extends Region {
	protected $name = 'Dark World';

	/**
	 * Create a new South Dark World Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[cave-073] cave northeast of swamp palace [top chest]", 0xEB1E, null, $this),
			new Location\Chest("[cave-073] cave northeast of swamp palace [top middle chest]", 0xEB21, null, $this),
			new Location\Chest("[cave-073] cave northeast of swamp palace [bottom middle chest]", 0xEB24, null, $this),
			new Location\Chest("[cave-073] cave northeast of swamp palace [bottom chest]", 0xEB27, null, $this),
			new Location\Npc("Flute Boy", 0x330C7, null, $this),
			new Location\Npc("[cave-073] cave northeast of swamp palace - generous guy", 0x180011, null, $this),
			new Location\Dig("Piece of Heart (Digging Game)", 0x180148, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[cave-073] cave northeast of swamp palace [top chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-073] cave northeast of swamp palace [top middle chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-073] cave northeast of swamp palace [bottom middle chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-073] cave northeast of swamp palace [bottom chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Flute Boy"]->setItem(Item::get('Shovel'));
		$this->locations["[cave-073] cave northeast of swamp palace - generous guy"]->setItem(Item::get('ThreeHundredRupees'));
		$this->locations["Piece of Heart (Digging Game)"]->setItem(Item::get('PieceOfHeart'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[cave-073] cave northeast of swamp palace [top chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-073] cave northeast of swamp palace [top middle chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-073] cave northeast of swamp palace [bottom middle chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-073] cave northeast of swamp palace [bottom chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Flute Boy"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-073] cave northeast of swamp palace - generous guy"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Piece of Heart (Digging Game)"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl')
				&& (($this->world->getRegion('North East Dark World')->canEnter($locations, $items) && ($items->has('Hammer')
					|| ($items->has('Hookshot') && ($items->has('Flippers') || $items->canLiftRocks()))))
					|| ($items->has('Hammer') && $items->canLiftRocks())
					|| $items->has('TitansMitt'));
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
		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') || $items->hasABottle();
		};

		return $this;
	}
}
