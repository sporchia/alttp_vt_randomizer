<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Ice Palace Region and it's Locations contained within
 */
class IcePalace extends Region {
	protected $name = 'Ice Palace';
	public $music_addresses = [
		0x155BF,
	];

	/**
	 * Create a new Ice Palace Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-D5-B1] Ice Palace - Big Key room", 0xE9A4, null, $this),
			new Location\Chest("[dungeon-D5-B1] Ice Palace - compass room", 0xE9D4, null, $this),
			new Location\Chest("[dungeon-D5-B2] Ice Palace - map room", 0xE9DD, null, $this),
			new Location\Chest("[dungeon-D5-B3] Ice Palace - spike room", 0xE9E0, null, $this),
			new Location\Chest("[dungeon-D5-B4] Ice Palace - above Blue Mail room", 0xE995, null, $this),
			new Location\Chest("[dungeon-D5-B5] Ice Palace - b5 up staircase", 0xE9E3, null, $this),
			new Location\BigChest("[dungeon-D5-B5] Ice Palace - big chest", 0xE9AA, null, $this),
			new Location\Drop("Heart Container - Kholdstare", 0x180157, null, $this),
		]);
	}

	/**
	 * Place Keys, Map, and Compass in Region. Ice Palace has: Big Key, Map, Compass, 2 Keys
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Kholdstare";
		});

		// This order matters
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

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
		$this->locations["[dungeon-D5-B1] Ice Palace - Big Key room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canLiftRocks()
				&& ((!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])
				&& ($items->has('Hookshot')
				|| $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])))
			|| ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				]) && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
					"[dungeon-D5-B5] Ice Palace - big chest",
				]) && (($locations["Heart Container - Kholdstare"]->hasItem(Item::get('Key'))
				&& $items->has('Hammer') && $items->canLiftRocks() && $items->canMeltThings() && $items->has('CaneOfSomaria'))
					|| $items->has('Hookshot'))));
		});

		$this->locations["[dungeon-D5-B1] Ice Palace - compass room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D5-B2] Ice Palace - map room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canLiftRocks()
				&& ((!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])
				&& ($items->has('Hookshot')
				|| $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])))
			|| ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				]) && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
					"[dungeon-D5-B5] Ice Palace - big chest",
				]) && (($locations["Heart Container - Kholdstare"]->hasItem(Item::get('Key'))
				&& $items->has('Hammer') && $items->canLiftRocks() && $items->canMeltThings() && $items->has('CaneOfSomaria'))
					|| $items->has('Hookshot'))));
		});

		$this->locations["[dungeon-D5-B3] Ice Palace - spike room"]->setRequirements(function($locations, $items) {
			return (!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])
				&& ($items->has('Hookshot')
				|| $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])))
			|| ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				]) && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
					"[dungeon-D5-B5] Ice Palace - big chest",
				]) && (($locations["Heart Container - Kholdstare"]->hasItem(Item::get('Key'))
				&& $items->has('Hammer') && $items->canLiftRocks() && $items->canMeltThings() && $items->has('CaneOfSomaria'))
					|| $items->has('Hookshot')));
		});

		$this->locations["[dungeon-D5-B4] Ice Palace - above Blue Mail room"]->setRequirements(function($locations, $items) {
			return $items->canMeltThings();
		});

		$this->locations["[dungeon-D5-B5] Ice Palace - b5 up staircase"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D5-B5] Ice Palace - big chest"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])
				|| ($locations["[dungeon-D5-B3] Ice Palace - spike room"]->hasItem(Item::get('BigKey'))
					&& ($items->has('Hookshot')
					|| $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D5-B1] Ice Palace - compass room",
						"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
						"[dungeon-D5-B5] Ice Palace - b5 up staircase",
					])))
				|| ($locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D5-B1] Ice Palace - Big Key room",
						"[dungeon-D5-B2] Ice Palace - map room",
					])
					&& $items->has('Hammer') && $items->canLiftRocks()
					&& ($items->has('Hookshot')
					|| $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D5-B1] Ice Palace - compass room",
						"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
						"[dungeon-D5-B5] Ice Palace - b5 up staircase",
					])));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["Heart Container - Kholdstare"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canMeltThings() && $items->canLiftRocks()
				&& ((!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])
				&& ($items->has('Hookshot')
				|| $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])))
				|| ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				]) && ($locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
					"[dungeon-D5-B5] Ice Palace - big chest",
				], 2)
					|| (($items->has('Hookshot') || $items->has('CaneOfSomaria'))
						&& $locations->itemInLocations(Item::get('Key'), [
							"[dungeon-D5-B1] Ice Palace - compass room",
							"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
							"[dungeon-D5-B5] Ice Palace - b5 up staircase",
							"[dungeon-D5-B5] Ice Palace - big chest",
						])))
				));
		})->setFillRules(function($item, $locations, $items) {
			if ($this->world->config('region.bossHaveKey', true)) {
				return $item != Item::get('BigKey');
			}
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('Hammer') && $items->canMeltThings() && $items->canLiftRocks()
				&& ((!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])
				&& ($items->has('Hookshot')
				|| $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				])))
				|| ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
				]) && ($locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D5-B1] Ice Palace - compass room",
					"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
					"[dungeon-D5-B5] Ice Palace - b5 up staircase",
					"[dungeon-D5-B5] Ice Palace - big chest",
				], 2)
					|| (($items->has('Hookshot') || $items->has('CaneOfSomaria'))
						&& $locations->itemInLocations(Item::get('Key'), [
							"[dungeon-D5-B1] Ice Palace - compass room",
							"[dungeon-D5-B4] Ice Palace - above Blue Mail room",
							"[dungeon-D5-B5] Ice Palace - b5 up staircase",
							"[dungeon-D5-B5] Ice Palace - big chest",
						])))
				));
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers') && $items->has('TitansMitt') && $items->canMeltThings();
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
		$this->initSpeedRunner();

		$this->can_enter = function($locations, $items) {
			return $items->has('TitansMitt') || ($items->has('MagicMirror') && ($items->has('MoonPearl') || $items->hasABottle()));
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
		$this->locations["[dungeon-D5-B1] Ice Palace - Big Key room"]->setRequirements(function($locations, $items) {
			return  $items->has('Hammer') && $items->canLiftRocks();
		});

		$this->locations["[dungeon-D5-B2] Ice Palace - map room"]->setRequirements(function($locations, $items) {
			return  $items->has('Hammer') && $items->canLiftRocks();
		});

		$this->locations["[dungeon-D5-B4] Ice Palace - above Blue Mail room"]->setRequirements(function($locations, $items) {
			return $items->canMeltThings();
		});

		$this->locations["[dungeon-D5-B5] Ice Palace - big chest"]->setRequirements(function($locations, $items) {
			return ($items->has('Hammer') && $items->canLiftRocks())
				|| !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D5-B1] Ice Palace - Big Key room",
						"[dungeon-D5-B2] Ice Palace - map room",
						"Heart Container - Kholdstare",
				]);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["Heart Container - Kholdstare"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canMeltThings() && $items->canLiftRocks();
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->canMeltThings() && $items->canLiftRocks() && $items->has('Hammer');
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('TitansMitt') && $items->canMeltThings();
		};

		return $this;
	}
}
