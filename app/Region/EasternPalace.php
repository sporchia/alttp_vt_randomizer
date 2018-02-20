<?php namespace ALttP\Region;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Eastern Palace Region and it's Locations contained within
 */
class EasternPalace extends Region {
	protected $name = 'Eastern Palace';
	public $music_addresses = [
		0x1559A,
	];

	protected $region_items = [
		'BigKey',
		'BigKeyP1',
		'Compass',
		'CompassP1',
		'Key',
		'KeyP1',
		'Map',
		'MapP1',
	];

	/**
	 * Create a new Eastern Palace Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		// set a default boss
		$this->boss = Boss::get("Armos Knights");

		$this->locations = new LocationCollection([
			new Location\Chest("Eastern Palace - Compass Chest", 0xE977, null, $this),
			new Location\BigChest("Eastern Palace - Big Chest", 0xE97D, null, $this),
			new Location\Chest("Eastern Palace - Cannonball Chest", 0xE9B3, null, $this),
			new Location\Chest("Eastern Palace - Big Key Chest", 0xE9B9, null, $this),
			new Location\Chest("Eastern Palace - Map Chest", 0xE9F5, null, $this),
			new Location\Drop("Eastern Palace - Armos Knights", 0x180150, null, $this),

			new Location\Prize\Pendant("Eastern Palace - Prize", [null, 0x1209D, 0x53EF8, 0x53EF9, 0x180052, 0x18007C, 0xC6FE], null, $this),
		]);

		$this->prize_location = $this->locations["Eastern Palace - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Eastern Palace - Compass Chest"]->setItem(Item::get('CompassP1'));
		$this->locations["Eastern Palace - Big Chest"]->setItem(Item::get('Bow'));
		$this->locations["Eastern Palace - Cannonball Chest"]->setItem(Item::get('OneHundredRupees'));
		$this->locations["Eastern Palace - Big Key Chest"]->setItem(Item::get('BigKeyP1'));
		$this->locations["Eastern Palace - Map Chest"]->setItem(Item::get('MapP1'));
		$this->locations["Eastern Palace - Armos Knights"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Eastern Palace - Prize"]->setItem(Item::get('PendantOfCourage'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Eastern Palace - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyP1');
		});

		$this->locations["Eastern Palace - Big Key Chest"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp', $this->world->config('item.require.Lamp', 1));
		});

		$this->can_complete = function($locations, $items) {
			return $this->locations["Eastern Palace - Armos Knights"]->canAccess($items)
				&& (!$this->world->config('region.wildCompasses', false) || $items->has('CompassP1'))
				&& (!$this->world->config('region.wildMaps', false) || $items->has('MapP1'));
		};

		$this->locations["Eastern Palace - Armos Knights"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows()
				&& $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('BigKeyP1')
				&& $this->boss->canBeat($items, $locations);
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& ($item instanceof Item\Key || $item instanceof Item\BigKey
					|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
				return false;
			}

			return true;
		});

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
