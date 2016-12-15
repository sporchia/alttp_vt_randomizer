<?php namespace Randomizer\Region;

use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class DarkWorld extends Region {
	protected $name = 'Dark World';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[cave-055] Spike cave", 0xEA8B, null, $this),
			new Location\Chest("[cave-063] doorless hut", 0xE9EC, null, $this),
			new Location\Chest("[cave-062] C-shaped house", 0xE9EF, null, $this),
			new Location\Chest("[cave-071] Misery Mire west area [left chest]", 0xEA73, null, $this),
			new Location\Chest("[cave-071] Misery Mire west area [right chest]", 0xEA76, null, $this),
			new Location\Chest("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", 0xEA7C, null, $this),
			new Location\Chest("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", 0xEA7F, null, $this),
			new Location\Chest("[cave-073] cave northeast of swamp palace [top chest]", 0xEB1E, null, $this),
			new Location\Chest("[cave-073] cave northeast of swamp palace [top middle chest]", 0xEB21, null, $this),
			new Location\Chest("[cave-073] cave northeast of swamp palace [bottom middle chest]", 0xEB24, null, $this),
			new Location\Chest("[cave-073] cave northeast of swamp palace [bottom chest]", 0xEB27, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", 0xEB51, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", 0xEB54, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", 0xEB57, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", 0xEB5A, null, $this),
			new Location\Chest("Piece of Heart (Treasure Chest Game)", 0xEDA8, null, $this),
			new Location\Npc("Flute Boy", 0x330C7, null, $this),
			new Location\Standing("Catfish", 0xEE185, null, $this),
			new Location\Standing("Piece of Heart (Dark World blacksmith pegs)", 0x180006, null, $this),
			new Location\Npc("[cave-073] cave northeast of swamp palace - generous guy", 0x180011, null, $this),
			new Location\Standing("Piece of Heart (Dark World - bumper cave)", 0x180146, null, $this),
			new Location\Standing("Piece of Heart (Pyramid)", 0x180147, null, $this),
			new Location\Dig("Piece of Heart (Digging Game)", 0x180148, null, $this),
		]);
	}

	public function initNoMajorGlitches() {
		$this->locations["[cave-055] Spike cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hammer') && $items->canLiftRocks()
				&& $items->canAccessWestDeathMountain();
		});

		$this->locations["[cave-063] doorless hut"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessNorthWestDarkWorld();
		});

		$this->locations["[cave-062] C-shaped house"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessNorthWestDarkWorld();;
		});

		$this->locations["[cave-071] Misery Mire west area [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canFly() && $items->has('TitansMitt');
		});

		$this->locations["[cave-071] Misery Mire west area [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canFly() && $items->has('TitansMitt');
		});

		// Super Bunny
		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		// Super Bunny
		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-073] cave northeast of swamp palace [top chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessSouthDarkWorld();
		});

		$this->locations["[cave-073] cave northeast of swamp palace [top middle chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessSouthDarkWorld();
		});

		$this->locations["[cave-073] cave northeast of swamp palace [bottom middle chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessSouthDarkWorld();
		});

		$this->locations["[cave-073] cave northeast of swamp palace [bottom chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessSouthDarkWorld();
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks() && $items->has('Hookshot')
				&& $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks() && $items->has('Hookshot')
				&& $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks() && $items->has('Hookshot')
				&& $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks()
				&& $items->canAccessEastDeathMountain();
		});

		$this->locations["Piece of Heart (Treasure Chest Game)"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessNorthWestDarkWorld();
		});

		$this->locations["Flute Boy"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessSouthDarkWorld();
		});

		$this->locations["Catfish"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks()
				&& $items->canAccessPyramid();
		});

		$this->locations["Piece of Heart (Dark World blacksmith pegs)"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('TitansMitt') && $items->has('Hammer')
				&& $items->canAccessNorthWestDarkWorld();
		});

		$this->locations["[cave-073] cave northeast of swamp palace - generous guy"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessSouthDarkWorld();
		});

		$this->locations["Piece of Heart (Dark World - bumper cave)"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Cape')
				&& $items->canAccessNorthWestDarkWorld();
		});

		$this->locations["Piece of Heart (Pyramid)"]->setRequirements(function($locations, $items) {
			return $items->canAccessPyramid();
		});

		$this->locations["Piece of Heart (Digging Game)"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canAccessSouthDarkWorld();
		});

		return $this;
	}
}
