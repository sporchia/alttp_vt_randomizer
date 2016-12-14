<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class EasternPalace extends Region {
	protected $name = 'Eastern Palace';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("[dungeon-L1-1F] Eastern Palace - compass room", 0xE977, $this),
			new Location("[dungeon-L1-1F] Eastern Palace - big chest", 0xE97D, $this),
			new Location("[dungeon-L1-1F] Eastern Palace - big ball room", 0xE9B3, $this),
			new Location("[dungeon-L1-1F] Eastern Palace - Big key", 0xE9B9, $this),
			new Location("[dungeon-L1-1F] Eastern Palace - map room", 0xE9F5, $this),
			new Location("Heart Container - Armos Knights", 0x180150, $this),
		]);
	}

	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Armos Knights";
		});

		// Big Key, Map, Compass
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));

		return $this;
	}

	public function initNoMajorGlitches() {
		$this->locations["[dungeon-L1-1F] Eastern Palace - compass room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L1-1F] Eastern Palace - big chest"]->setRequirements(function($locations, $items) {
			return ($locations->itemInLocations(Item::get("BigKey"), [
					"[dungeon-L1-1F] Eastern Palace - compass room",
					"[dungeon-L1-1F] Eastern Palace - big ball room",
					"[dungeon-L1-1F] Eastern Palace - Big key",
					"[dungeon-L1-1F] Eastern Palace - map room",
				]));
		});

		$this->locations["[dungeon-L1-1F] Eastern Palace - big ball room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L1-1F] Eastern Palace - Big key"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L1-1F] Eastern Palace - map room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Heart Container - Armos Knights"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get("BigKey"), [
					"[dungeon-L1-1F] Eastern Palace - compass room",
					"[dungeon-L1-1F] Eastern Palace - big ball room",
					"[dungeon-L1-1F] Eastern Palace - Big key",
					"[dungeon-L1-1F] Eastern Palace - map room",
				])
				&& $items->has('Bow');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('Bow');
		};

		return $this;
	}
}
