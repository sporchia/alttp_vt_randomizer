<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Skull Woods Region and it's Locations contained within
 */
class SkullWoods extends Region {
	protected $name = 'Skull Woods';

	/**
	 * Create a new Skull Woods Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\BigChest("[dungeon-D3-B1] Skull Woods - big chest", 0xE998, null, $this),
			new Location\Chest("[dungeon-D3-B1] Skull Woods - Big Key room", 0xE99E, null, $this),
			new Location\Chest("[dungeon-D3-B1] Skull Woods - Compass room", 0xE992, null, $this),
			new Location\Chest("[dungeon-D3-B1] Skull Woods - east of Fire Rod room", 0xE99B, null, $this),
			new Location\Chest("[dungeon-D3-B1] Skull Woods - Entrance to part 2", 0xE9FE, null, $this),
			new Location\Chest("[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", 0xE9A1, null, $this),
			new Location\Chest("[dungeon-D3-B1] Skull Woods - south of Fire Rod room", 0xE9C8, null, $this),
			new Location\Drop("Heart Container - Mothula", 0x180155, null, $this),
		]);
	}

	/**
	 * Place Keys, Map, and Compass in Region. Skull Woods has: Big Key, Map, Compass, 3 Keys
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Mothula";
		});

		$locations["[dungeon-D3-B1] Skull Woods - south of Fire Rod room"]->fill(Item::get('Key'), $my_items);

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[dungeon-D3-B1] Skull Woods - big chest"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('BigKey'), [
				"[dungeon-D3-B1] Skull Woods - Big Key room",
				"[dungeon-D3-B1] Skull Woods - Compass room",
				"[dungeon-D3-B1] Skull Woods - east of Fire Rod room",
				"[dungeon-D3-B1] Skull Woods - Entrance to part 2",
				"[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room",
				"[dungeon-D3-B1] Skull Woods - south of Fire Rod room",
				"Heart Container - Mothula",
			]);
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - Big Key room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - Compass room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - east of Fire Rod room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - Entrance to part 2"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - south of Fire Rod room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Heart Container - Mothula"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('FireRod');
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $items->canAccessNorthWestDarkWorld();
		};

		return $this;
	}
}
