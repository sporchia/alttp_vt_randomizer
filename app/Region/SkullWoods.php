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

			new Location\Prize\Crystal("Skull Woods Crystal", [null, 0x120A3, 0x53F12, 0x53F13, 0x180058, 0x18007B, 0xC704], null, $this),
		]);

		// F this key
		$this->locations["[dungeon-D3-B1] Skull Woods - south of Fire Rod room"]->setItem(Item::get('KeyD3'));

		$this->prize_location = $this->locations["Skull Woods Crystal"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-D3-B1] Skull Woods - big chest"]->setItem(Item::get('FireRod'));
		$this->locations["[dungeon-D3-B1] Skull Woods - Big Key room"]->setItem(Item::get('BigKey'));
		$this->locations["[dungeon-D3-B1] Skull Woods - Compass room"]->setItem(Item::get('Compass'));
		$this->locations["[dungeon-D3-B1] Skull Woods - east of Fire Rod room"]->setItem(Item::get('Map'));
		$this->locations["[dungeon-D3-B1] Skull Woods - Entrance to part 2"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D3-B1] Skull Woods - south of Fire Rod room"]->setItem(Item::get('Key'));
		$this->locations["Heart Container - Mothula"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Skull Woods Crystal"]->setItem(Item::get('Crystal3'));

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
		if ($item instanceof Item\Key && !in_array($item, [Item::get('Key'), Item::get('KeyD3')])) {
			return false;
		}

		if ($item instanceof Item\BigKey && !in_array($item, [Item::get('BigKey'), Item::get('BigKeyD3')])) {
			return false;
		}

		if ($item instanceof Item\Map
			&& (!$this->world->config('region.mapsInDungeons', true)
				|| !in_array($item, [Item::get('Map'), Item::get('MapD3')]))) {
			return false;
		}

		if ($item instanceof Item\Compass
			&& (!$this->world->config('region.compassesInDungeons', true)
				|| !in_array($item, [Item::get('Compass'), Item::get('CompassD3')]))) {
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
		$this->locations["[dungeon-D3-B1] Skull Woods - south of Fire Rod room"]->setFillRules(function($item, $locations, $items) {
			return $item == Item::get('KeyD3');
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD3');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD3');
		});

		$this->locations["[dungeon-D3-B1] Skull Woods - Entrance to part 2"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->locations["Heart Container - Mothula"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && (config('game-mode') == 'swordless' || $items->hasSword());
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& ($item instanceof Item\Key || $item instanceof Item\BigKey
					|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
				return false;
			}

			if ($this->world->config('region.bossHaveKey', true)) {
				return $item != Item::get('KeyD3');
			}

			return !in_array($item, [Item::get('KeyD3'), Item::get('BigKeyD3')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('FireRod') && (config('game-mode') == 'swordless' || $items->hasSword());
		};

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
			return $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Glitched Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->initNoMajorGlitches();

		// P2: CanAccessNWDW && Moon Pearl && Fire Rod
		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		};

		return $this;
	}

}
