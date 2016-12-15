<?php namespace Randomizer\Region;

use Randomizer\Support\LocationCollection;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Item;
use Randomizer\World;

class DeathMountain extends Region {
	protected $name = 'Death Mountain';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("[cave-012-1F] Death Mountain - wall of caves - left cave", 0xE9BF, null, $this),
			new Location("[cave-013] Mimic cave (from Turtle Rock)", 0xE9C5, null, $this),
			new Location("[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", 0xEB2A, null, $this),
			new Location("[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", 0xEB2D, null, $this),
			new Location("[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", 0xEB30, null, $this),
			new Location("[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", 0xEB33, null, $this),
			new Location("[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", 0xEB36, null, $this),
			new Location("[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", 0xEB39, null, $this),
			new Location("[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", 0xEB3C, null, $this),
			new Location\Drop("Ether Tablet", 0x180016, null, $this),
			new Location\Npc("Old Mountain Man", 0xF69FA, null, $this),
			new Location("Piece of Heart (Spectacle Rock Cave)", 0x180002, null, $this),
			new Location("Piece of Heart (Spectacle Rock)", 0x180140, null, $this),
			new Location("Piece of Heart (Death Mountain - floating island)", 0x180141, null, $this),
		]);
	}

	public function initNoMajorGlitches() {
		$this->locations["[cave-012-1F] Death Mountain - wall of caves - left cave"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-013] Mimic cave (from Turtle Rock)"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('Turtle Rock')->canEnter($locations, $items)
				&& $items->has('MagicMirror');
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain();
		});

		$this->locations["Ether Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && $items->canUpgradeSword()
				&& ($items->has('MagicMirror')
					|| ($items->canAccessEastDeathMountain() && $items->has('Hammer')));
		});

		$this->locations["Old Mountain Man"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Piece of Heart (Spectacle Rock Cave)"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Piece of Heart (Spectacle Rock)"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror');
		});

		$this->locations["Piece of Heart (Death Mountain - floating island)"]->setRequirements(function($locations, $items) {
			return $items->canAccessEastDeathMountain() && $items->has('MagicMirror') && $items->has('MoonPearl')
				&& $items->has('TitansMitt');
		});

		$this->can_enter = function($locations, $items) {
			return $items->canAccessWestDeathMountain();
		};

		return $this;
	}
}
