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
		$this->locations["[dungeon-L1-1F] Eastern Palace - compass room"]->setItem(Item::get('Compass'));
		$this->locations["[dungeon-L1-1F] Eastern Palace - big chest"]->setItem(Item::get('Bow'));
		$this->locations["[dungeon-L1-1F] Eastern Palace - big ball room"]->setItem(Item::get('OneHundredRupees'));
		$this->locations["[dungeon-L1-1F] Eastern Palace - Big key"]->setItem(Item::get('BigKey'));
		$this->locations["[dungeon-L1-1F] Eastern Palace - map room"]->setItem(Item::get('Map'));
		$this->locations["Heart Container - Armos Knights"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Eastern Palace Pendant"]->setItem(Item::get('PendantOfCourage'));

		return $this;
	}

	/**
	 * Place Keys, Map, and Compass in Region. Eastern Palace has: Big Key, Map, Compass
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Armos Knights";
		});

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

		if ($this->world->config('region.CompassesMaps', true)) {
			if ($this->world->config('region.mapsInDungeons', true)) {
				while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));
			}

			if ($this->world->config('region.compassesInDungeons', true)) {
				while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));
			}
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
		$this->locations["[dungeon-L1-1F] Eastern Palace - big chest"]->setRequirements(function($locations, $items) {
			if ($locations["[dungeon-L1-1F] Eastern Palace - Big key"]->hasItem(Item::get('BigKey'))) {
				return $items->has('Lamp');
			}

			return true;
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-L1-1F] Eastern Palace - Big key"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->canShootArrows() && $items->has('Lamp');
		};

		$this->locations["Heart Container - Armos Knights"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				return $item != Item::get('BigKey');
			});

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
