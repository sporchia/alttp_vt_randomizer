<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Thieves Town Region and it's Locations contained within
 */
class ThievesTown extends Region {
	protected $name = 'Thieves Town';

	/**
	 * Create a new Thieves Town Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
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

	/**
	 * Place Keys, Map, and Compass in Region. Thieves Town has: Big Key, Map, Compass, 1 Key
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Blind";
		});

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]",
				"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]",
				"[dungeon-D4-B1] Thieves' Town - Bottom right of huge room",
				"[dungeon-D4-B1] Thieves' Town - Top left of huge room",
				"[dungeon-D4-B2] Thieves' Town - next to Blind",
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
		$this->locations["[dungeon-D4-1F] Thieves' Town - Room above boss"]->setRequirements(function($locations, $items) {
			return true;
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
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
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->locations["[dungeon-D4-B2] Thieves' Town - next to Blind"]->setRequirements(function($locations, $items) {
			return true;
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["Heart Container - Blind"]->setRequirements(function($locations, $items) {
			return true;
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items);
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Glitched Mode.
	 *
	 * @return $this
	 */
	public function initGlitched() {
		$this->initNoMajorGlitches();

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		};
		return $this;
	}
}
