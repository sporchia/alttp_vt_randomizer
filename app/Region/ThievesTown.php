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
	public $music_addresses = [
		0x155C6,
	];

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

			new Location\Prize\Crystal("Thieves Town Crystal", [null, 0x120A6, 0x53F36, 0x53F37, 0x18005B, 0x180077, 0xC707], null, $this),
		]);

		$this->prize_location = $this->locations["Thieves Town Crystal"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-D4-1F] Thieves' Town - Room above boss"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]"]->setItem(Item::get('BigKeyD4'));
		$this->locations["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]"]->setItem(Item::get('MapD4'));
		$this->locations["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room"]->setItem(Item::get('CompassD4'));
		$this->locations["[dungeon-D4-B1] Thieves' Town - Top left of huge room"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-D4-B2] Thieves' Town - big chest"]->setItem(Item::get('TitansMitt'));
		$this->locations["[dungeon-D4-B2] Thieves' Town - next to Blind"]->setItem(Item::get('KeyD4'));
		$this->locations["Heart Container - Blind"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Thieves Town Crystal"]->setItem(Item::get('Crystal4'));

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
		if ($item instanceof Item\Key && !in_array($item, [Item::get('Key'), Item::get('KeyD4')])) {
			return false;
		}

		if ($item instanceof Item\BigKey && !in_array($item, [Item::get('BigKey'), Item::get('BigKeyD4')])) {
			return false;
		}

		if ($item instanceof Item\Map
			&& (!$this->world->config('region.mapsInDungeons', true)
				|| !in_array($item, [Item::get('Map'), Item::get('MapD4')]))) {
			return false;
		}

		if ($item instanceof Item\Compass
			&& (!$this->world->config('region.compassesInDungeons', true)
				|| !in_array($item, [Item::get('Compass'), Item::get('CompassD4')]))) {
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
		$this->locations["[dungeon-D4-1F] Thieves' Town - Room above boss"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD4') && $items->has('BigKeyD4');
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('KeyD4'), Item::get('BigKeyD4')]);
		});

		$this->locations["[dungeon-D4-B2] Thieves' Town - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('KeyD4') && $items->has('BigKeyD4');
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('KeyD4'), Item::get('BigKeyD4')]);
		});

		$this->locations["[dungeon-D4-B2] Thieves' Town - next to Blind"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD4');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD4');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('BigKeyD4')
				&& ($items->hasSword() || $items->has('Hammer')
				|| $items->has('CaneOfSomaria') || $items->has('CaneOfByrna'));
		};

		$this->locations["Heart Container - Blind"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& ($item instanceof Item\Key || $item instanceof Item\BigKey
						|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
					return false;
				}

				return !in_array($item, [Item::get('KeyD4'), Item::get('BigKeyD4')]);
			});

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
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
		$this->initNoMajorGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') || $items->hasABottle();
		};

		return $this;
	}
}
