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
			new Location\Npc\Uncle("Link's Uncle", 0x2DF45, null, $this),
			new Location\Chest("Secret Passage", 0xE971, null, $this),
			new Location\Prize\Event("Zelda", null, null, $this),
		]);

		$this->prize_location = $this->locations["Zelda"];
		$this->prize_location->setItem(Item::get('RescueZelda'));
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
		$this->locations["Link's Uncle"]->setItem(Item::get('L1SwordAndShield'));
		$this->locations["Secret Passage"]->setItem(Item::get('Lamp'));

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
			if ($this->world->config('mode.state') == 'open') {
				return true;
			}

			return $items->canKillMostThings() && $items->has('KeyH2');
		});

		$this->locations["Sewers - Secret Room - Left"]->setRequirements(function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return $items->canLiftRocks() || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
			}

			return $items->canKillMostThings() && $items->has('KeyH2');
		});

		$this->locations["Sewers - Secret Room - Middle"]->setRequirements(function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return $items->canLiftRocks() || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
			}

			return $items->canKillMostThings() && $items->has('KeyH2');
		});

		$this->locations["Sewers - Secret Room - Right"]->setRequirements(function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return $items->canLiftRocks() || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
			}

			return $items->canKillMostThings() && $items->has('KeyH2');
		});

		$this->locations["Sewers - Dark Cross"]->setRequirements(function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return $items->has('Lamp', $this->world->config('item.require.Lamp', 1));
			}

			return $items->canKillMostThings();
		});

		$this->locations["Hyrule Castle - Boomerang Chest"]->setRequirements(function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return $items->has('KeyH2');
			}

			return $items->canKillMostThings();
		});

		$this->locations["Hyrule Castle - Map Chest"]->setRequirements(function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return true;
			}

			return $items->canKillMostThings();
		});

		$this->locations["Hyrule Castle - Zelda's Cell"]->setRequirements(function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return $items->has('KeyH2');
			}

			return $items->canKillMostThings();
		});

		$this->locations["Secret Passage"]->setRequirements(function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return true;
			}

			return $items->canKillMostThings();
		})->setFillRules(function($item, $locations, $items) {
			return !((!$this->world->config('region.wildKeys', false) && $item instanceof Item\Key)
				|| (!$this->world->config('region.wildBigKeys', false) && $item instanceof Item\BigKey)
				|| (!$this->world->config('region.wildMaps', false) && $item instanceof Item\Map)
				|| (!$this->world->config('region.wildCompasses', false) && $item instanceof Item\Compass));
		});

		$this->locations["Link's Uncle"]->setFillRules(function($item, $locations, $items) {
			return $this->locations["Sanctuary"]->canAccess($this->world->collectItems())
				&& !((!$this->world->config('region.wildKeys', false) && $item instanceof Item\Key)
					|| (!$this->world->config('region.wildBigKeys', false) && $item instanceof Item\BigKey)
					|| (!$this->world->config('region.wildMaps', false) && $item instanceof Item\Map)
					|| (!$this->world->config('region.wildCompasses', false) && $item instanceof Item\Compass));
		});

		$this->can_complete = function($locations, $items) {
			if ($this->world->config('mode.state') == 'open') {
				return true;
			}

			return $this->locations["Sanctuary"]->canAccess($items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
