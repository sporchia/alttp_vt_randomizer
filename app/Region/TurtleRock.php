<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Turtle Rock Region and it's Locations contained within
 */
class TurtleRock extends Region {
	protected $name = 'Turtle Rock';

	/**
	 * Create a new Turtle Rock Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-D7-1F] Turtle Rock - Chain chomp room", 0xEA16, null, $this),
			new Location\Chest("[dungeon-D7-1F] Turtle Rock - compass room", 0xEA22, null, $this),
			new Location\Chest("[dungeon-D7-1F] Turtle Rock - Map room [left chest]", 0xEA1C, null, $this),
			new Location\Chest("[dungeon-D7-1F] Turtle Rock - Map room [right chest]", 0xEA1F, null, $this),
			new Location\BigChest("[dungeon-D7-B1] Turtle Rock - big chest", 0xEA19, null, $this),
			new Location\Chest("[dungeon-D7-B1] Turtle Rock - big key room", 0xEA25, null, $this),
			new Location\Chest("[dungeon-D7-B1] Turtle Rock - Roller switch room", 0xEA34, null, $this),
			new Location\Chest("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", 0xEA31, null, $this),
			new Location\Chest("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", 0xEA2E, null, $this),
			new Location\Chest("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", 0xEA2B, null, $this),
			new Location\Chest("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", 0xEA28, null, $this),
			new Location\Drop("Heart Container - Trinexx", 0x180159, null, $this),
		]);
	}

	/**
	 * Place Keys, Map, and Compass in Region. Turtle Rock has: Big Key, Map, Compass, and 4 keys
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Trinexx";
		});

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

		if ($this->world->config('region.CompassesMaps', true)) {
			while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

			while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));
		}

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - compass room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big chest"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big key room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - Roller switch room"]->setRequirements(function($locations, $items) {
			return true;
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["Heart Container - Trinexx"]->setRequirements(function($locations, $items) {
			return  $items->has('FireRod') && $items->has('IceRod') && $items->has('Lamp');
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('FireRod') && $items->has('IceRod') && $items->has('Lamp');
		};

		$this->can_enter = function($locations, $items) {
			return (($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
				|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
				|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
			 && $items->has('MoonPearl') && $items->has('CaneOfSomaria')
			 && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items)
			 && $items->has('TitansMitt') && $items->has('Hammer');
		};

		return $this;
	}
}
