<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Hyrule Castle Escape Region and it's Locations contained within
 */
class HyruleCastleEscape extends Region {
	protected $name = 'Hyrule Castle';

	/**
	 * Create a new Hyrule Castle Escape Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-C-1F] Sanctuary", 0xEA79, null, $this),
			new Location\Chest("[dungeon-C-B1] Escape - final basement room [left chest]", 0xEB5D, null, $this),
			new Location\Chest("[dungeon-C-B1] Escape - final basement room [middle chest]", 0xEB60, null, $this),
			new Location\Chest("[dungeon-C-B1] Escape - final basement room [right chest]", 0xEB63, null, $this),
			new Location\Chest("[dungeon-C-B1] Escape - first B1 room", 0xE96E, null, $this),
			new Location\Chest("[dungeon-C-B1] Hyrule Castle - boomerang room", 0xE974, null, $this),
			new Location\Chest("[dungeon-C-B1] Hyrule Castle - map room", 0xEB0C, null, $this),
			new Location\Chest("[dungeon-C-B3] Hyrule Castle - next to Zelda", 0xEB09, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-C-1F] Sanctuary"]->setItem(Item::get('HeartContainer'));
		$this->locations["[dungeon-C-B1] Escape - final basement room [left chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-C-B1] Escape - final basement room [middle chest]"]->setItem(Item::get('ThreeHundredRupees'));
		$this->locations["[dungeon-C-B1] Escape - final basement room [right chest]"]->setItem(Item::get('TenArrows'));
		$this->locations["[dungeon-C-B1] Escape - first B1 room"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-C-B1] Hyrule Castle - boomerang room"]->setItem(Item::get('Boomerang'));
		$this->locations["[dungeon-C-B1] Hyrule Castle - map room"]->setItem(Item::get('Map'));
		$this->locations["[dungeon-C-B3] Hyrule Castle - next to Zelda"]->setItem(Item::get('Lamp'));

		return $this;
	}

	/**
	 * Place Keys, Map, and Compass in Region. Hyrule Castle Escape has: Map, Key
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		while(!$this->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

		if ($this->world->config('region.CompassesMaps', true)) {
			while(!$this->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));
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
		$this->initSpeedRunner();

		$this->locations["[dungeon-C-B1] Escape - first B1 room"]->setRequirements(function($locations, $items) {
			if (config('game-mode') == 'open') {
				return $items->canLiftRocks() && $items->has('Lamp');
			}

			return $items->canLiftRocks();
		});


		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Glitched Mode
	 *
	 * @return $this
	 */
	public function initGlitched() {
		if (config('game-mode') != 'open') {
			$this->locations["[dungeon-C-1F] Sanctuary"]->setFillRules(function($item, $locations, $items) {
				return $item != Item::get('Key');
			});

			$this->locations["[dungeon-C-B1] Escape - final basement room [left chest]"]->setFillRules(function($item, $locations, $items) {
				return $item != Item::get('Key');
			});

			$this->locations["[dungeon-C-B1] Escape - final basement room [middle chest]"]->setFillRules(function($item, $locations, $items) {
				return $item != Item::get('Key');
			});

			$this->locations["[dungeon-C-B1] Escape - final basement room [right chest]"]->setFillRules(function($item, $locations, $items) {
				return $item != Item::get('Key');
			});
		}

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Minor Glitched Mode. Everything is free.
	 *
	 * @return $this
	 */
	function initSpeedRunner() {
		$this->initGlitched();

		$this->locations["[dungeon-C-B1] Escape - final basement room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Escape - final basement room [middle chest]"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Escape - final basement room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks();
		});

		return $this;
	}
}
