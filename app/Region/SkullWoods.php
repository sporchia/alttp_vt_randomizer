<?php namespace ALttP\Region;

use ALttP\Boss;
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

	protected $map_reveal = 0x0080;

	protected $region_items = [
		'BigKey',
		'BigKeyD3',
		'Compass',
		'CompassD3',
		'Key',
		'KeyD3',
		'Map',
		'MapD3',
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

		$this->boss = Boss::get("Mothula");

		$this->locations = new LocationCollection([
			new Location\BigChest("Skull Woods - Big Chest", 0xE998, null, $this),
			new Location\Chest("Skull Woods - Big Key Chest", 0xE99E, null, $this),
			new Location\Chest("Skull Woods - Compass Chest", 0xE992, null, $this),
			new Location\Chest("Skull Woods - Map Chest", 0xE99B, null, $this),
			new Location\Chest("Skull Woods - Bridge Room", 0xE9FE, null, $this),
			new Location\Chest("Skull Woods - Pot Prison", 0xE9A1, null, $this),
			new Location\Chest("Skull Woods - Pinball Room", 0xE9C8, null, $this),
			new Location\Drop("Skull Woods - Mothula", 0x180155, null, $this),

			new Location\Prize\Crystal("Skull Woods - Prize", [null, 0x120A3, 0x53F12, 0x53F13, 0x180058, 0x18007B, 0xC704], null, $this),
		]);

		if ($this->world->config('region.forceSkullWoodsKey', true)) {
			// F this key
			$this->locations["Skull Woods - Pinball Room"]->setItem(Item::get('KeyD3'));
		}

		$this->prize_location = $this->locations["Skull Woods - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Skull Woods - Big Chest"]->setItem(Item::get('FireRod'));
		$this->locations["Skull Woods - Big Key Chest"]->setItem(Item::get('BigKeyD3'));
		$this->locations["Skull Woods - Compass Chest"]->setItem(Item::get('CompassD3'));
		$this->locations["Skull Woods - Map Chest"]->setItem(Item::get('MapD3'));
		$this->locations["Skull Woods - Bridge Room"]->setItem(Item::get('KeyD3'));
		$this->locations["Skull Woods - Pot Prison"]->setItem(Item::get('KeyD3'));
		$this->locations["Skull Woods - Pinball Room"]->setItem(Item::get('KeyD3'));
		$this->locations["Skull Woods - Mothula"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Skull Woods - Prize"]->setItem(Item::get('Crystal3'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Skull Woods - Pinball Room"]->setFillRules(function($item, $locations, $items) {
			return $item == Item::get('KeyD3');
		});

		$this->locations["Skull Woods - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD3');
		})->setAlwaysAllow(function($item, $items) {
			return $item == Item::get('BigKeyD3');
		});

		$this->locations["Skull Woods - Bridge Room"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('FireRod');
		});

		$this->can_complete = function($locations, $items) {
			return $this->locations["Skull Woods - Mothula"]->canAccess($items)
				&& (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD3'))
				&& (!$this->world->config('region.wildMaps', false) || $items->has('MapD3'));
		};

		$this->locations["Skull Woods - Mothula"]->setRequirements(function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('MoonPearl')
				&& $items->has('FireRod')
				&& ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword())
				&& $items->has('KeyD3', 3)
				&& $this->boss->canBeat($items, $locations);
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& ($item instanceof Item\Key || $item instanceof Item\BigKey
					|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
				return false;
			}

			return true;
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& $items->has('MoonPearl') && $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
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
			return $items->has('RescueZelda')
				&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		};

		return $this;
	}

}
