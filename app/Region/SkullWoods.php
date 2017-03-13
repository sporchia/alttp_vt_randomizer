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
	public $music_addresses = [
		0x155BA,
		0x155BB,
		0x155BC,
		0x155BD,
		0x15608,
		0x15609,
		0x1560A,
		0x1560B,
	];

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

		// @TODO: this is wrong for SpeedRunner, we want to allow this to not be a key
		$locations["[dungeon-D3-B1] Skull Woods - south of Fire Rod room"]->fill(Item::get('Key'), $my_items);

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
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
		$this->locations["[dungeon-D3-B1] Skull Woods - big chest"]->setRequirements(function($locations, $items) {
			return !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D3-B1] Skull Woods - Entrance to part 2",
						"Heart Container - Mothula",
					]) || $items->has('FireRod');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey')
				&& ($item != Item::get('Key') || !$locations["Heart Container - Mothula"]->hasItem(Item::get('BigKey')));
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
		})->setFillRules(function($item, $locations, $items) {
			return $item == Item::get('Key');
		});

		$this->locations["Heart Container - Mothula"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->hasSword();
		})->setFillRules(function($item, $locations, $items) {
			if ($this->world->config('region.bossHaveKey', true)) {
				return $item != Item::get('Key')
					&& ($item != Item::get('BigKey') || !$locations["[dungeon-D3-B1] Skull Woods - big chest"]->hasItem(Item::get('Key')));
			}
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('FireRod') && $items->hasSword();
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
		$this->locations["[dungeon-D3-B1] Skull Woods - big chest"]->setRequirements(function($locations, $items) {
			return !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D3-B1] Skull Woods - Entrance to part 2",
						"Heart Container - Mothula",
					]) || $items->has('FireRod');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - Entrance to part 2"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->locations["Heart Container - Mothula"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->hasSword();
		})->setFillRules(function($item, $locations, $items) {
			if ($this->world->config('region.bossHaveKey', true)) {
				return true;
			}
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $items->has('FireRod') && $items->hasSword();
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Minor Glitched Mode
	 *
	 * @return $this
	 */
	public function initSpeedRunner() {
		$this->initNoMajorGlitches();

		$this->locations["Heart Container - Mothula"]->setFillRules(function($item, $locations, $items) {
			if ($this->world->config('region.bossHaveKey', true)) {
				return true;
			}
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		return $this;
	}
}
