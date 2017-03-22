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
	public $music_addresses = [
		0x155C5,
		0x1107A,
	];

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
			new Location\Standing\HeraBasement("[dungeon-L3-1F] Tower of Hera - freestanding key", 0x180162, null, $this),
			new Location\Chest("[dungeon-L3-2F] Tower of Hera - Entrance", 0xE9AD, null, $this),
			new Location\Chest("[dungeon-L3-4F] Tower of Hera - 4F [small chest]", 0xE9FB, null, $this),
			new Location\BigChest("[dungeon-L3-4F] Tower of Hera - big chest", 0xE9F8, null, $this),
			new Location\Drop("Heart Container - Moldorm", 0x180152, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-L3-1F] Tower of Hera - first floor"]->setItem(Item::get('BigKey'));
		$this->locations["[dungeon-L3-1F] Tower of Hera - freestanding key"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->setItem(Item::get('Map'));
		$this->locations["[dungeon-L3-4F] Tower of Hera - 4F [small chest]"]->setItem(Item::get('Compass'));
		$this->locations["[dungeon-L3-4F] Tower of Hera - big chest"]->setItem(Item::get('MoonPearl'));
		$this->locations["Heart Container - Moldorm"]->setItem(Item::get('BossHeartContainer'));

		return $this;
	}

	/**
	 * Place Keys, Map, and Compass in Region. Tower of Hera has: Big Key, Map, Compass, Key
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Moldorm";
		});

		// since key logic requires placement of Big Key for checks we temporaily set it in a room the Key cannot be in
		// then unset it for actual placement.
		$locations["[dungeon-L3-1F] Tower of Hera - first floor"]->setItem(Item::get('BigKey'));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		$locations["[dungeon-L3-1F] Tower of Hera - first floor"]->setItem();

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
			return $items->canLightTorches()
				&& ($locations->itemInLocations(Item::get('Key'), [
					"[dungeon-L3-1F] Tower of Hera - freestanding key",
					"[dungeon-L3-2F] Tower of Hera - Entrance",
				])
				|| $locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-L3-1F] Tower of Hera - freestanding key",
					"[dungeon-L3-2F] Tower of Hera - Entrance",
				]));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key');
		});

		$this->locations["[dungeon-L3-1F] Tower of Hera - freestanding key"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L3-2F] Tower of Hera - Entrance"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L3-4F] Tower of Hera - 4F [small chest]"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches())
				|| $locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-L3-1F] Tower of Hera - freestanding key",
					"[dungeon-L3-2F] Tower of Hera - Entrance",
				]);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-L3-4F] Tower of Hera - big chest"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches())
				|| $locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-L3-1F] Tower of Hera - freestanding key",
					"[dungeon-L3-2F] Tower of Hera - Entrance",
				]);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["Heart Container - Moldorm"]->setRequirements(function($locations, $items) {
			return ($items->hasSword() || $items->has('Hammer'))
				&& ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches())
				|| $locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-L3-1F] Tower of Hera - freestanding key",
					"[dungeon-L3-2F] Tower of Hera - Entrance",
				]);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get("BigKey")) && $items->canLightTorches())
					|| $locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-L3-1F] Tower of Hera - freestanding key",
						"[dungeon-L3-2F] Tower of Hera - Entrance",
					]);
		};

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('Death Mountain')->canEnter($locations, $items)
				&& ($items->has('MagicMirror')
					|| ($items->has('Hammer') && $items->has('Hookshot')));
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
		$this->locations["[dungeon-L3-1F] Tower of Hera - first floor"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches()
				&& ($locations->itemInLocations(Item::get('Key'), [
					"[dungeon-L3-1F] Tower of Hera - freestanding key",
					"[dungeon-L3-2F] Tower of Hera - Entrance",
				])
				|| $locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-L3-1F] Tower of Hera - freestanding key",
					"[dungeon-L3-2F] Tower of Hera - Entrance",
				])
				|| $this->world->getRegion('Misery Mire')->canEnter($locations, $items));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key');
		});

		$this->locations["[dungeon-L3-4F] Tower of Hera - 4F [small chest]"]->setRequirements(function($locations, $items) {
			return $this->canComplete($locations, $items);
		});

		$this->locations["[dungeon-L3-4F] Tower of Hera - big chest"]->setRequirements(function($locations, $items) {
			return $this->canComplete($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["Heart Container - Moldorm"]->setRequirements(function($locations, $items) {
			return ($items->hasSword() || $items->has('Hammer')) && $this->canComplete($locations, $items);
		});

		$this->can_complete = function($locations, $items) {
			return ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-L3-1F] Tower of Hera - freestanding key",
					"[dungeon-L3-2F] Tower of Hera - Entrance",
				]) || ($locations["[dungeon-L3-1F] Tower of Hera - first floor"]->hasItem(Item::get('BigKey')) && $items->canLightTorches()))
				|| ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					&& (!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-L3-4F] Tower of Hera - big chest",
						"Heart Container - Moldorm",
					])
					|| !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D6-B1] Misery Mire - big key",
						"[dungeon-D6-B1] Misery Mire - compass",
					])
					|| $items->canLightTorches()));
		};

		return $this;
	}
}
