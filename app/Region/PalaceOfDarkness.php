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
			new Location\Chest("[dungeon-D1-B1] Dark Palace - shooter room", 0xEA5B, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - big key room", 0xEA37, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - jump room [right chest]", 0xEA3A, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - jump room [left chest]", 0xEA3D, null, $this),
			new Location\Chest("[dungeon-D1-B1] Dark Palace - turtle stalfos room", 0xEA49, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - statue push room", 0xEA52, null, $this),
			new Location\BigChest("[dungeon-D1-1F] Dark Palace - big chest", 0xEA40, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - compass room", 0xEA43, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - spike statue room", 0xEA46, null, $this),
			new Location\Chest("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", 0xEA4C, null, $this),
			new Location\Chest("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", 0xEA4F, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - maze room [top chest]", 0xEA55, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", 0xEA58, null, $this),
			new Location\Drop("Heart Container - Helmasaur King", 0x180153, null, $this),

			new Location\Prize\Crystal("Palace of Darkness Crystal", [null, 0x120A1, 0x53F00, 0x53F01, 0x180056, 0x18007D, 0xC702], null, $this),
		]);

		$this->prize_location = $this->locations["Palace of Darkness Crystal"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-D1-1F] Dark Palace - big key room"]->setItem(Item::get('BigKeyD1'));
		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [right chest]"]->setItem(Item::get('KeyD1'));
		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [left chest]"]->setItem(Item::get('KeyD1'));
		$this->locations["[dungeon-D1-1F] Dark Palace - big chest"]->setItem(Item::get('Hammer'));
		$this->locations["[dungeon-D1-1F] Dark Palace - compass room"]->setItem(Item::get('CompassD1'));
		$this->locations["[dungeon-D1-1F] Dark Palace - spike statue room"]->setItem(Item::get('FiveRupees'));
		$this->locations["[dungeon-D1-B1] Dark Palace - turtle stalfos room"]->setItem(Item::get('KeyD1'));
		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]"]->setItem(Item::get('Arrow'));
		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]"]->setItem(Item::get('KeyD1'));
		$this->locations["[dungeon-D1-1F] Dark Palace - statue push room"]->setItem(Item::get('MapD1'));
		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [top chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]"]->setItem(Item::get('KeyD1'));
		$this->locations["[dungeon-D1-B1] Dark Palace - shooter room"]->setItem(Item::get('KeyD1'));
		$this->locations["Heart Container - Helmasaur King"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Palace of Darkness Crystal"]->setItem(Item::get('Crystal1'));

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
		if ($item instanceof Item\Key && !in_array($item, [Item::get('Key'), Item::get('KeyD1')])) {
			return false;
		}

		if ($item instanceof Item\BigKey && !in_array($item, [Item::get('BigKey'), Item::get('BigKeyD1')])) {
			return false;
		}

		if ($item instanceof Item\Map
			&& (!$this->world->config('region.mapsInDungeons', true)
				|| !in_array($item, [Item::get('Map'), Item::get('MapD1')]))) {
			return false;
		}

		if ($item instanceof Item\Compass
			&& (!$this->world->config('region.compassesInDungeons', true)
				|| !in_array($item, [Item::get('Compass'), Item::get('CompassD1')]))) {
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
		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - big key room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD1', 5);
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD1')
				|| ($items->canShootArrows() && $items->has('Hammer'));
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('BigKeyD1') && $items->has('KeyD1', 5);
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('KeyD1'), Item::get('BigKeyD1')]);
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - compass room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD1', 4);
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - spike statue room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD1', 5);
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - turtle stalfos room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD1')
				|| ($items->canShootArrows() && $items->has('Hammer'));
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('KeyD1', 4);
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('KeyD1', 4);
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - statue push room"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [top chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('KeyD1', 5);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('KeyD1');
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('KeyD1', 5);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('KeyD1');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('Hammer') && $items->has('Lamp') && $items->canShootArrows()
				&& $items->has('BigKeyD1') && $items->has('KeyD1', 6);
		};

		$this->locations["Heart Container - Helmasaur King"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& ($item instanceof Item\Key || $item instanceof Item\BigKey
						|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
					return false;
				}

				return !in_array($item, [Item::get('KeyD1'), Item::get('BigKeyD1')]);
			});

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('North East Dark World')->canEnter($locations, $items);
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

		$this->can_enter = null;
	}
}
