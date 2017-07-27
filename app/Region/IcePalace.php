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

			new Location\Prize\Crystal("Ice Palace Crystal", [null, 0x120A4, 0x53F5A, 0x53F5B, 0x180059, 0x180073, 0xC705], null, $this),
		]);

		$this->prize_location = $this->locations["Ice Palace Crystal"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-D5-B1] Ice Palace - Big Key room"]->setItem(Item::get('BigKey'));
		$this->locations["[dungeon-D5-B1] Ice Palace - compass room"]->setItem(Item::get('Compass'));
		$this->locations["[dungeon-D5-B2] Ice Palace - map room"]->setItem(Item::get('Map'));
		$this->locations["[dungeon-D5-B3] Ice Palace - spike room"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D5-B4] Ice Palace - above Blue Mail room"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-D5-B5] Ice Palace - b5 up staircase"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D5-B5] Ice Palace - big chest"]->setItem(Item::get('BlueMail'));
		$this->locations["Heart Container - Kholdstare"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Ice Palace Crystal"]->setItem(Item::get('Crystal5'));

		return $this;
	}

	/**
	 * Determine if the item being placed in this region can be placed here.
	 *
	 * @param Item $item item to test
	 *
	 * @return bool
	 */
	public function canFill(Item $item) : bool {
		if (is_a($item, Item\Key::class) && !in_array($item, [Item::get('Key'), Item::get('KeyD5')])) {
			return false;
		}

		if (is_a($item, Item\BigKey::class) && !in_array($item, [Item::get('BigKey'), Item::get('BigKeyD5')])) {
			return false;
		}

		if (is_a($item, Item\Map::class)
			&& (!$this->world->config('region.mapsInDungeons', true)
				|| !in_array($item, [Item::get('Map'), Item::get('MapD5')]))) {
			return false;
		}

		if (is_a($item, Item\Compass::class)
			&& (!$this->world->config('region.compassesInDungeons', true)
				|| !in_array($item, [Item::get('Compass'), Item::get('CompassD5')]))) {
			return false;
		}

		return true;
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
				&& ($items->has('Hookshot')
					|| $items->has('KeyD5', 2));
		});

		$this->locations["[dungeon-D5-B2] Ice Palace - map room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canLiftRocks()
				&& ($items->has('Hookshot')
					|| $items->has('KeyD5', 2));
		});

		$this->locations["[dungeon-D5-B3] Ice Palace - spike room"]->setRequirements(function($locations, $items) {
			return $items->has('Hookshot')
					|| $items->has('KeyD5', 2);
		});

		$this->locations["[dungeon-D5-B4] Ice Palace - above Blue Mail room"]->setRequirements(function($locations, $items) {
			return $items->canMeltThings();
		});

		$this->locations["[dungeon-D5-B5] Ice Palace - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD5');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD5');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('Hammer') && $items->canMeltThings() && $items->canLiftRocks()
				&& $items->has('BigKeyD5') && (
					($items->has('CaneOfSomaria') && $items->has('KeyD5'))
					|| $items->has('KeyD5', 2)
				);
		};

		$this->locations["Heart Container - Kholdstare"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& (is_a($item, Item\Key::class) || is_a($item, Item\BigKey::class)
						|| is_a($item, Item\Map::class) || is_a($item, Item\Compass::class))) {
					return false;
				}

				if ($this->world->config('region.bossHaveKey', true)) {
					return $item != Item::get('BigKeyD5');
				}

				return !in_array($item, [Item::get('KeyD5'), Item::get('BigKeyD5')]);
			});


		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers')
				&& $items->canLiftDarkRocks() && $items->canMeltThings();
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Glitched Mode.
	 *
	 * @return $this
	 */
	public function initGlitched() {
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
				|| !$locations->itemInLocations(Item::get('BigKeyD5'), [
						"[dungeon-D5-B1] Ice Palace - Big Key room",
						"[dungeon-D5-B2] Ice Palace - map room",
						"Heart Container - Kholdstare",
				]);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD5');
		});

		$this->locations["Heart Container - Kholdstare"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canMeltThings() && $items->canLiftRocks();
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& (is_a($item, Item\Key::class) || is_a($item, Item\BigKey::class)
					|| is_a($item, Item\Map::class) || is_a($item, Item\Compass::class))) {
				return false;
			}

			return true;
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->canMeltThings() && $items->canLiftRocks() && $items->has('Hammer');
		};

		$this->can_enter = function($locations, $items) {
			return $items->canLiftDarkRocks() || ($items->has('MagicMirror') && ($items->has('MoonPearl') || $items->hasABottle()));
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->initNoMajorGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->canLiftDarkRocks() && $items->canMeltThings();
		};

		return $this;
	}
}
