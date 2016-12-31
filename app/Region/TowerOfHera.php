<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Tower of Hera Region and it's Locations contained within
 */
class TowerOfHera extends Region {
	protected $name = 'Tower Of Hera';

	/**
	 * Create a new Tower of Hera Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-L3-1F] Tower of Hera - first floor", 0xE9E6, null, $this),
			new Location\Chest("[dungeon-L3-2F] Tower of Hera - Entrance", 0xE9AD, null, $this),
			new Location\Chest("[dungeon-L3-4F] Tower of Hera - 4F [small chest]", 0xE9FB, null, $this),
			new Location\BigChest("[dungeon-L3-4F] Tower of Hera - big chest", 0xE9F8, null, $this),
			new Location\Drop("Heart Container - Moldorm", 0x180152, null, $this),
		]);
	}

	/**
	 * Place Keys, Map, and Compass in Region. Tower of Hera has: Big Key, Map, Compass
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Moldorm";
		});

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

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
		$this->locations["[dungeon-L3-1F] Tower of Hera - first floor"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches();
		});

		$this->locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L3-4F] Tower of Hera - 4F [small chest]"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches())
				|| $locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->hasItem(Item::get("BigKey"));
		});

		$this->locations["[dungeon-L3-4F] Tower of Hera - big chest"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches())
				|| $locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->hasItem(Item::get("BigKey"));
		});

		$this->locations["Heart Container - Moldorm"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches())
				|| $locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->hasItem(Item::get("BigKey"));
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
