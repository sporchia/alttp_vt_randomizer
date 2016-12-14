<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class TurtleRock extends Region {
	protected $name = 'Turtle Rock';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("[dungeon-D7-1F] Turtle Rock - Chain chomp room", 0xEA16, $this),
			new Location("[dungeon-D7-1F] Turtle Rock - compass room", 0xEA22, $this),
			new Location("[dungeon-D7-1F] Turtle Rock - Map room [left chest]", 0xEA1C, $this),
			new Location("[dungeon-D7-1F] Turtle Rock - Map room [right chest]", 0xEA1F, $this),
			new Location("[dungeon-D7-B1] Turtle Rock - big chest", 0xEA19, $this),
			new Location("[dungeon-D7-B1] Turtle Rock - big key room", 0xEA25, $this),
			new Location("[dungeon-D7-B1] Turtle Rock - Roller switch room", 0xEA34, $this),
			new Location("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", 0xEA31, $this),
			new Location("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", 0xEA2E, $this),
			new Location("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", 0xEA2B, $this),
			new Location("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", 0xEA28, $this),
			new Location("Heart Container - Trinexx", 0x180159, $this),
		]);
	}

	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Trinexx";
		});

		// Big Key, Map, Compass, 4 keys
		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
				"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
				"[dungeon-D7-1F] Turtle Rock - compass room",
			]);
		})->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
				"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
				"[dungeon-D7-1F] Turtle Rock - compass room",
				"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
			]);
		})->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
				"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
				"[dungeon-D7-1F] Turtle Rock - compass room",
				"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
				"[dungeon-D7-B1] Turtle Rock - big key room",
				"[dungeon-D7-B1] Turtle Rock - Roller switch room",
			]);
		})->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
				"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
				"[dungeon-D7-1F] Turtle Rock - compass room",
				"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
				"[dungeon-D7-B1] Turtle Rock - big key room",
			]);
		})->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));

		return $this;
	}

	public function initNoMajorGlitches() {
		$this->locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - compass room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big chest"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big key room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - Roller switch room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		});

		$this->locations["Heart Container - Trinexx"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('BigKey'), [
				"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
				"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
				"[dungeon-D7-1F] Turtle Rock - compass room",
				"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
				"[dungeon-D7-B1] Turtle Rock - big key room",
				"[dungeon-D7-B1] Turtle Rock - Roller switch room",
			])
			&& $locations->itemInLocations(Item::get('Key'), [
				"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
				"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
				"[dungeon-D7-1F] Turtle Rock - compass room",
				"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
				"[dungeon-D7-B1] Turtle Rock - big chest",
				"[dungeon-D7-B1] Turtle Rock - big key room",
				"[dungeon-D7-B1] Turtle Rock - Roller switch room",
				"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
				"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
				"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
				"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
			], 4)
			&& $items->has('FireRod') && $items->has('IceRod') && $items->has('Lamp');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('FireRod') && $items->has('IceRod') && $items->has('Lamp');
		};

		$this->can_enter = function($locations, $items) {
			return (($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
				|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
				|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
			 && $items->has('MoonPearl') && $items->has('CaneOfSomaria') && $items->canAccessEastDeathMountain()
			 && $items->has('TitansMitt') && $items->has('Hammer');
		};

		return $this;
	}
}
