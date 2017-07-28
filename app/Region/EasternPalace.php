<?php namespace ALttP\Region;

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

	/**
	 * Create a new Eastern Palace Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-L1-1F] Eastern Palace - compass room", 0xE977, null, $this),
			new Location\BigChest("[dungeon-L1-1F] Eastern Palace - big chest", 0xE97D, null, $this),
			new Location\Chest("[dungeon-L1-1F] Eastern Palace - big ball room", 0xE9B3, null, $this),
			new Location\Chest("[dungeon-L1-1F] Eastern Palace - Big key", 0xE9B9, null, $this),
			new Location\Chest("[dungeon-L1-1F] Eastern Palace - map room", 0xE9F5, null, $this),
			new Location\Drop("Heart Container - Armos Knights", 0x180150, null, $this),

			new Location\Prize\Pendant("Eastern Palace Pendant", [null, 0x1209D, 0x53EF8, 0x53EF9, 0x180052, 0x18007C, 0xC6FE], null, $this),
		]);

		$this->prize_location = $this->locations["Eastern Palace Pendant"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-L1-1F] Eastern Palace - compass room"]->setItem(Item::get('CompassP1'));
		$this->locations["[dungeon-L1-1F] Eastern Palace - big chest"]->setItem(Item::get('Bow'));
		$this->locations["[dungeon-L1-1F] Eastern Palace - big ball room"]->setItem(Item::get('OneHundredRupees'));
		$this->locations["[dungeon-L1-1F] Eastern Palace - Big key"]->setItem(Item::get('BigKeyP1'));
		$this->locations["[dungeon-L1-1F] Eastern Palace - map room"]->setItem(Item::get('MapP1'));
		$this->locations["Heart Container - Armos Knights"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Eastern Palace Pendant"]->setItem(Item::get('PendantOfCourage'));

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
		if ($item instanceof Item\Key && !in_array($item, [Item::get('Key'), Item::get('KeyP1')])) {
			return false;
		}

		if ($item instanceof Item\BigKey && !in_array($item, [Item::get('BigKey'), Item::get('BigKeyP1')])) {
			return false;
		}

		if ($item instanceof Item\Map
			&& (!$this->world->config('region.mapsInDungeons', true)
				|| !in_array($item, [Item::get('Map'), Item::get('MapP1')]))) {
			return false;
		}

		if ($item instanceof Item\Compass
			&& (!$this->world->config('region.compassesInDungeons', true)
				|| !in_array($item, [Item::get('Compass'), Item::get('CompassP1')]))) {
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
		$this->locations["[dungeon-L1-1F] Eastern Palace - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyP1');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyP1');
		});

		$this->locations["[dungeon-L1-1F] Eastern Palace - Big key"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->canShootArrows()
				&& $items->has('Lamp') && $items->has('BigKeyP1');
		};

		$this->locations["Heart Container - Armos Knights"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& ($item instanceof Item\Key || $item instanceof Item\BigKey
						|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
					return false;
				}

				return $item != Item::get('BigKeyP1');
			});

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
