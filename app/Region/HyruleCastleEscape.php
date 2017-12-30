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

	protected $region_items = [
		'BigKey',
		'BigKeyH2',
		'Compass',
		'CompassH2',
		'Key',
		'KeyH2',
		'Map',
		'MapH2',
	];

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
			new Location\Chest("Sanctuary", 0xEA79, null, $this),
			new Location\Chest("Sewers - Secret Room - Left", 0xEB5D, null, $this),
			new Location\Chest("Sewers - Secret Room - Middle", 0xEB60, null, $this),
			new Location\Chest("Sewers - Secret Room - Right", 0xEB63, null, $this),
			new Location\Chest("Sewers - Dark Cross", 0xE96E, null, $this),
			new Location\Chest("Hyrule Castle - Boomerang Chest", 0xE974, null, $this),
			new Location\Chest("Hyrule Castle - Map Chest", 0xEB0C, null, $this),
			new Location\Chest("Hyrule Castle - Zelda's Cell", 0xEB09, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Sanctuary"]->setItem(Item::get('HeartContainer'));
		$this->locations["Sewers - Secret Room - Left"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Sewers - Secret Room - Middle"]->setItem(Item::get('ThreeHundredRupees'));
		$this->locations["Sewers - Secret Room - Right"]->setItem(Item::get('TenArrows'));
		$this->locations["Sewers - Dark Cross"]->setItem(Item::get('KeyH2'));
		$this->locations["Hyrule Castle - Boomerang Chest"]->setItem(Item::get('Boomerang'));
		$this->locations["Hyrule Castle - Map Chest"]->setItem(Item::get('MapH2'));
		$this->locations["Hyrule Castle - Zelda's Cell"]->setItem(Item::get('Lamp'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Sanctuary"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return true;
			}

			return $items->canKillMostThings() && $items->has('KeyH2');
		});

		$this->locations["Sewers - Secret Room - Left"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return $items->canLiftRocks() || ($items->has('Lamp') && $items->has('KeyH2'));
			}

			return $items->canKillMostThings() && $items->has('KeyH2');
		});

		$this->locations["Sewers - Secret Room - Middle"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return $items->canLiftRocks() || ($items->has('Lamp') && $items->has('KeyH2'));
			}

			return $items->canKillMostThings() && $items->has('KeyH2');
		});

		$this->locations["Sewers - Secret Room - Right"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return $items->canLiftRocks() || ($items->has('Lamp') && $items->has('KeyH2'));
			}

			return $items->canKillMostThings() && $items->has('KeyH2');
		});

		$this->locations["Sewers - Dark Cross"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return $items->has('Lamp');
			}

			return $items->canKillMostThings();
		});

		$this->locations["Hyrule Castle - Boomerang Chest"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return $items->has('KeyH2');
			}

			return $items->canKillMostThings();
		});

		$this->locations["Hyrule Castle - Zelda's Cell"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless'])) {
				return $items->has('KeyH2');
			}

			return $items->canKillMostThings();
		});

		return $this;
	}
}
