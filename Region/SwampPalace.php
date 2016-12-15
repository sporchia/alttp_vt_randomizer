<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class SwampPalace extends Region {
	protected $name = 'Swamp Palace';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("[dungeon-D2-1F] Swamp Palace - first room", 0xEA9D, null, $this),
			new Location("[dungeon-D2-B1] Swamp Palace - big chest", 0xE989, null, $this),
			new Location("[dungeon-D2-B1] Swamp Palace - big key room", 0xEAA6, null, $this),
			new Location("[dungeon-D2-B1] Swamp Palace - map room", 0xE986, null, $this),
			new Location("[dungeon-D2-B1] Swamp Palace - push 4 blocks room", 0xEAA3, null, $this),
			new Location("[dungeon-D2-B1] Swamp Palace - south of hookshot room", 0xEAA0, null, $this),
			new Location("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", 0xEAA9, null, $this),
			new Location("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", 0xEAAC, null, $this),
			new Location("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", 0xEAAF, null, $this),
			new Location("Heart Container - Arrghus", 0x180154, null, $this),
		]);
	}

	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Arrghus";
		});

		// Big Key, Map, Compass, 1 key
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));

		return $this;
	}

	public function initNoMajorGlitches() {
		$this->locations["[dungeon-D2-1F] Swamp Palace - first room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - big chest"]->setRequirements(function($locations, $items) {
				return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"])
				&& $items->has('Hammer')
				&& ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D2-B1] Swamp Palace - map room",
					"[dungeon-D2-B1] Swamp Palace - south of hookshot room",
					"[dungeon-D2-B1] Swamp Palace - big key room",
					"[dungeon-D2-B1] Swamp Palace - push 4 blocks room",
					])
				||
				($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D2-B2] Swamp Palace - flooded room [left chest]",
					"[dungeon-D2-B2] Swamp Palace - flooded room [right chest]",
					"[dungeon-D2-B2] Swamp Palace - hidden waterfall door room",
					"Heart Container - Arrghus",
					]) && $items->has('Hookshot')));
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - big key room"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"])
				&& $items->has('Hammer');
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - map room"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"]);
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - push 4 blocks room"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"])
				&& $items->has('Hammer');
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - south of hookshot room"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"])
				&& $items->has('Hammer');
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"])
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"])
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"])
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["Heart Container - Arrghus"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D2-1F] Swamp Palace - first room"])
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});


		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('Hammer')
				&& $items->has('Hookshot');
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $items->canAccessSouthDarkWorld()
				&& $items->has('MagicMirror') && $items->has('Flippers');
		};

		return $this;
	}
}
