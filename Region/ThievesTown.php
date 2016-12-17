<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class ThievesTown extends Region {
	protected $name = 'Thieves Town';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-D4-1F] Thieves' Town - Room above boss", 0xEA0D, null, $this),
			new Location\Chest("[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", 0xEA04, null, $this),
			new Location\Chest("[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", 0xEA01, null, $this),
			new Location\Chest("[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", 0xEA07, null, $this),
			new Location\Chest("[dungeon-D4-B1] Thieves' Town - Top left of huge room", 0xEA0A, null, $this),
			new Location\BigChest("[dungeon-D4-B2] Thieves' Town - big chest", 0xEA10, null, $this),
			new Location\Chest("[dungeon-D4-B2] Thieves' Town - next to Blind", 0xEA13, null, $this),
			new Location\Drop("Heart Container - Blind", 0x180156, null, $this),
		]);
	}

	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Blind";
		});

		// Big Key, Map, Compass, 1 key
		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]",
				"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]",
				"[dungeon-D4-B1] Thieves' Town - Bottom right of huge room",
				"[dungeon-D4-B1] Thieves' Town - Top left of huge room",
				"[dungeon-D4-1F] Thieves' Town - Room above boss",
				"[dungeon-D4-B2] Thieves' Town - next to Blind",
				"Heart Container - Blind",
			]);
		})->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]",
				"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]",
				"[dungeon-D4-B1] Thieves' Town - Bottom right of huge room",
				"[dungeon-D4-B1] Thieves' Town - Top left of huge room",
			]);
		})->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));

		return $this;
	}

	public function initNoMajorGlitches() {
		$this->locations["[dungeon-D4-1F] Thieves' Town - Room above boss"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D4-B1] Thieves' Town - Top left of huge room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D4-B2] Thieves' Town - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-D4-B2] Thieves' Town - next to Blind"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Heart Container - Blind"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items);
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $items->canAccessNorthWestDarkWorld();
		};

		return $this;
	}
}
