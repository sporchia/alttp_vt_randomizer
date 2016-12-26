<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Hyrule Castle Escape Region and it's Locations contained within
 */
class HyruleCastleEscape extends Region {
	protected $name = 'Hyrule Castle';

	/**
	 * Create a new Hyrule Castle Escape Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-C-1F] Sanctuary", 0xEA79, null, $this),
			new Location\Chest("[dungeon-C-B1] Escape - final basement room [left chest]", 0xEB5D, null, $this),
			new Location\Chest("[dungeon-C-B1] Escape - final basement room [middle chest]", 0xEB60, null, $this),
			new Location\Chest("[dungeon-C-B1] Escape - final basement room [right chest]", 0xEB63, null, $this),
			new Location\Chest("[dungeon-C-B1] Escape - first B1 room", 0xE96E, null, $this),
			new Location\Chest("[dungeon-C-B1] Hyrule Castle - boomerang room", 0xE974, null, $this),
			new Location\Chest("[dungeon-C-B1] Hyrule Castle - map room", 0xEB0C, null, $this),
			new Location\Chest("[dungeon-C-B3] Hyrule Castle - next to Zelda", 0xEB09, null, $this),
		]);
	}

	/**
	 * Place Keys, Map, and Compass in Region. Hyrule Castle Escape has: Map, Key
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		while(!$this->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

		if ($this->world->config('region.CompassesMaps', true)) {
			while(!$this->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));
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
		$this->locations["[dungeon-C-1F] Sanctuary"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-C-B1] Escape - first B1 room",
					"[dungeon-C-B1] Hyrule Castle - boomerang room",
					"[dungeon-C-B1] Hyrule Castle - map room",
					"[dungeon-C-B3] Hyrule Castle - next to Zelda",
				]);
		});

		$this->locations["[dungeon-C-B1] Escape - final basement room [left chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-C-B1] Escape - first B1 room",
					"[dungeon-C-B1] Hyrule Castle - boomerang room",
					"[dungeon-C-B1] Hyrule Castle - map room",
					"[dungeon-C-B3] Hyrule Castle - next to Zelda",
				]) && $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Escape - final basement room [middle chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-C-B1] Escape - first B1 room",
					"[dungeon-C-B1] Hyrule Castle - boomerang room",
					"[dungeon-C-B1] Hyrule Castle - map room",
					"[dungeon-C-B3] Hyrule Castle - next to Zelda",
				]) && $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Escape - final basement room [right chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-C-B1] Escape - first B1 room",
					"[dungeon-C-B1] Hyrule Castle - boomerang room",
					"[dungeon-C-B1] Hyrule Castle - map room",
					"[dungeon-C-B3] Hyrule Castle - next to Zelda",
				]) && $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Escape - first B1 room"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Hyrule Castle - boomerang room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-C-B1] Hyrule Castle - map room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-C-B3] Hyrule Castle - next to Zelda"]->setRequirements(function($locations, $items) {
			return true;
		});

		return $this;
	}
}
