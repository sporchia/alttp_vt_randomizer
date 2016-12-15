<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class TowerOfHera extends Region {
	protected $name = 'Tower Of Hera';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("[dungeon-L3-1F] Tower of Hera - first floor", 0xE9E6, null, $this),
			new Location("[dungeon-L3-2F] Tower of Hera - Entrance", 0xE9AD, null, $this),
			new Location("[dungeon-L3-4F] Tower of Hera - 4F [small chest]", 0xE9FB, null, $this),
			new Location("[dungeon-L3-4F] Tower of Hera - big chest", 0xE9F8, null, $this),
			new Location("Heart Container - Moldorm", 0x180152, null, $this),
		]);
	}

	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Moldorm";
		});

		// Big Key, Map, Compass
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));

		return $this;
	}

	public function initNoMajorGlitches() {
		$this->locations["[dungeon-L3-1F] Tower of Hera - first floor"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches();
		});

		$this->locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L3-4F] Tower of Hera - 4F [small chest]"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches()
				|| $locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->hasItem(Item::get("BigKey")));
		});

		$this->locations["[dungeon-L3-4F] Tower of Hera - big chest"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches()
				|| $locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->hasItem(Item::get("BigKey")));
		});

		$this->locations["Heart Container - Moldorm"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches()
				|| $locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->hasItem(Item::get("BigKey")));
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& ($this->locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->hasItem(Item::get("BigKey"))
					|| $items->canLightTorches());
		};

		$this->can_enter = function($locations, $items) {
			return $items->canAccessWestDeathMountain()
				&& ($items->has('MagicMirror')
					|| ($items->has('Hammer') && $items->has('Hookshot')));
		};

		return $this;
	}
}
