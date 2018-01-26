<?php namespace ALttP\Region;

use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\Item;
use ALttP\World;

/**
 * Palace of Darkness Region and it's Locations contained within
 */
class PalaceOfDarkness extends Region {
	protected $name = 'Dark Palace';
	public $music_addresses = [
		0x155B8,
	];

	protected $region_items = [
		'BigKey',
		'BigKeyD1',
		'Compass',
		'CompassD1',
		'Key',
		'KeyD1',
		'Map',
		'MapD1',
	];

	/**
	 * Create a new Palace of Darkness Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Palace of Darkness - Shooter Room", 0xEA5B, null, $this),
			new Location\Chest("Palace of Darkness - Big Key Chest", 0xEA37, null, $this),
			new Location\Chest("Palace of Darkness - The Arena - Ledge", 0xEA3A, null, $this),
			new Location\Chest("Palace of Darkness - The Arena - Bridge", 0xEA3D, null, $this),
			new Location\Chest("Palace of Darkness - Stalfos Basement", 0xEA49, null, $this),
			new Location\Chest("Palace of Darkness - Map Chest", 0xEA52, null, $this),
			new Location\BigChest("Palace of Darkness - Big Chest", 0xEA40, null, $this),
			new Location\Chest("Palace of Darkness - Compass Chest", 0xEA43, null, $this),
			new Location\Chest("Palace of Darkness - Harmless Hellway", 0xEA46, null, $this),
			new Location\Chest("Palace of Darkness - Dark Basement - Left", 0xEA4C, null, $this),
			new Location\Chest("Palace of Darkness - Dark Basement - Right", 0xEA4F, null, $this),
			new Location\Chest("Palace of Darkness - Dark Maze - Top", 0xEA55, null, $this),
			new Location\Chest("Palace of Darkness - Dark Maze - Bottom", 0xEA58, null, $this),
			new Location\Drop("Palace of Darkness - Helmasaur King", 0x180153, null, $this),

			new Location\Prize\Crystal("Palace of Darkness - Prize", [null, 0x120A1, 0x53F00, 0x53F01, 0x180056, 0x18007D, 0xC702], null, $this),
		]);

		$this->prize_location = $this->locations["Palace of Darkness - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Palace of Darkness - Big Key Chest"]->setItem(Item::get('BigKeyD1'));
		$this->locations["Palace of Darkness - The Arena - Ledge"]->setItem(Item::get('KeyD1'));
		$this->locations["Palace of Darkness - The Arena - Bridge"]->setItem(Item::get('KeyD1'));
		$this->locations["Palace of Darkness - Big Chest"]->setItem(Item::get('Hammer'));
		$this->locations["Palace of Darkness - Compass Chest"]->setItem(Item::get('CompassD1'));
		$this->locations["Palace of Darkness - Harmless Hellway"]->setItem(Item::get('FiveRupees'));
		$this->locations["Palace of Darkness - Stalfos Basement"]->setItem(Item::get('KeyD1'));
		$this->locations["Palace of Darkness - Dark Basement - Left"]->setItem(Item::get('Arrow'));
		$this->locations["Palace of Darkness - Dark Basement - Right"]->setItem(Item::get('KeyD1'));
		$this->locations["Palace of Darkness - Map Chest"]->setItem(Item::get('MapD1'));
		$this->locations["Palace of Darkness - Dark Maze - Top"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Palace of Darkness - Dark Maze - Bottom"]->setItem(Item::get('KeyD1'));
		$this->locations["Palace of Darkness - Shooter Room"]->setItem(Item::get('KeyD1'));
		$this->locations["Palace of Darkness - Helmasaur King"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Palace of Darkness - Prize"]->setItem(Item::get('Crystal1'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Palace of Darkness - The Arena - Ledge"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["Palace of Darkness - Big Key Chest"]->setRequirements(function($locations, $items) {
			if ($locations["Palace of Darkness - Big Key Chest"]->hasItem(Item::get('KeyD1'))) {
				return (($items->has('Hammer') && $items->canShootArrows() && $items->has('Lamp')) ? $items->has('KeyD1', 3) : $items->has('KeyD1', 2));
			}

			return (($items->has('Hammer') && $items->canShootArrows() && $items->has('Lamp')) ? $items->has('KeyD1', 6) : $items->has('KeyD1', 5));
		})->setAlwaysAllow(function($item, $items) {
			return $item == Item::get('KeyD1') && $items->has('KeyD1', 5);
		});

		$this->locations["Palace of Darkness - The Arena - Bridge"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD1')
				|| ($items->canShootArrows() && $items->has('Hammer'));
		});

		$this->locations["Palace of Darkness - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('BigKeyD1')
				&& (($items->has('Hammer') && $items->canShootArrows()) ? $items->has('KeyD1', 6) : $items->has('KeyD1', 5));
		});

		$this->locations["Palace of Darkness - Compass Chest"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->canShootArrows() && $items->has('Lamp')) ? $items->has('KeyD1', 4) : $items->has('KeyD1', 3));
		});

		$this->locations["Palace of Darkness - Harmless Hellway"]->setRequirements(function($locations, $items) {
			if ($locations["Palace of Darkness - Harmless Hellway"]->hasItem(Item::get('KeyD1'))) {
				return (($items->has('Hammer') && $items->canShootArrows() && $items->has('Lamp')) ? $items->has('KeyD1', 4) : $items->has('KeyD1', 3));
			}

			return (($items->has('Hammer') && $items->canShootArrows() && $items->has('Lamp')) ? $items->has('KeyD1', 6) : $items->has('KeyD1', 5));
		})->setAlwaysAllow(function($item, $items) {
			return $item == Item::get('KeyD1') && $items->has('KeyD1', 5);
		});

		$this->locations["Palace of Darkness - Stalfos Basement"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD1')
				|| ($items->canShootArrows() && $items->has('Hammer'));
		});

		$this->locations["Palace of Darkness - Dark Basement - Left"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && (($items->has('Hammer') && $items->canShootArrows()) ? $items->has('KeyD1', 4) : $items->has('KeyD1', 3));
		});

		$this->locations["Palace of Darkness - Dark Basement - Right"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && (($items->has('Hammer') && $items->canShootArrows()) ? $items->has('KeyD1', 4) : $items->has('KeyD1', 3));
		});

		$this->locations["Palace of Darkness - Map Chest"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["Palace of Darkness - Dark Maze - Top"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && (($items->has('Hammer') && $items->canShootArrows()) ? $items->has('KeyD1', 6) : $items->has('KeyD1', 5));
		});

		$this->locations["Palace of Darkness - Dark Maze - Bottom"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && (($items->has('Hammer') && $items->canShootArrows()) ? $items->has('KeyD1', 6) : $items->has('KeyD1', 5));
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('Hammer') && $items->has('Lamp') && $items->canShootArrows()
				&& $items->has('BigKeyD1') && $items->has('KeyD1', 6);
		};

		$this->locations["Palace of Darkness - Helmasaur King"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& ($item instanceof Item\Key || $item instanceof Item\BigKey
						|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
					return false;
				}

				return true;
			});

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('North East Dark World')->canEnter($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for MajorGlitches Mode.
	 *
	 * @return $this
	 */
	public function initMajorGlitches() {
		$this->initNoMajorGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->glitchedLinkInDarkWorld()
				&& $this->world->getRegion('North East Dark World')->canEnter($locations, $items)
				|| $this->world->getRegion('West Death Mountain')->canEnter($locations, $items);
		};
	}
}
