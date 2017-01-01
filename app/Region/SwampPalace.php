<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Swamp Palace Region and it's Locations contained within
 */
class SwampPalace extends Region {
	protected $name = 'Swamp Palace';

	/**
	 * Create a new Swamp Palace Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-D2-1F] Swamp Palace - first room", 0xEA9D, null, $this),
			new Location\BigChest("[dungeon-D2-B1] Swamp Palace - big chest", 0xE989, null, $this),
			new Location\Chest("[dungeon-D2-B1] Swamp Palace - big key room", 0xEAA6, null, $this),
			new Location\Chest("[dungeon-D2-B1] Swamp Palace - map room", 0xE986, null, $this),
			new Location\Chest("[dungeon-D2-B1] Swamp Palace - push 4 blocks room", 0xEAA3, null, $this),
			new Location\Chest("[dungeon-D2-B1] Swamp Palace - south of hookshot room", 0xEAA0, null, $this),
			new Location\Chest("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", 0xEAA9, null, $this),
			new Location\Chest("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", 0xEAAC, null, $this),
			new Location\Chest("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", 0xEAAF, null, $this),
			new Location\Drop("Heart Container - Arrghus", 0x180154, null, $this),
		]);
	}

	/**
	 * Place Keys, Map, and Compass in Region. Swamp Palace has: Big Key, Map, Compass, 1 Key
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Arrghus";
		});

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

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
		})->setFillRules(function($item, $locations, $items) {
			if ($this->world->config('region.bossHaveKey', true)) {
				return true;
			}
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});


		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('Hammer')
				&& $items->has('Hookshot');
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('South Dark World')->canEnter($locations, $items)
				&& $items->has('MagicMirror') && $items->has('Flippers');
		};

		return $this;
	}
}
