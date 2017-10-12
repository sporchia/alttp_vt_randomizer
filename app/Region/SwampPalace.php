<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Swamp Palace Region and it's Locations contained within
 */
class SwampPalace extends Region {
	protected $name = 'Swamp Palace';
	public $music_addresses = [
		0x155B7,
	];

	protected $region_items = [
		'BigKey',
		'BigKeyD2',
		'Compass',
		'CompassD2',
		'Key',
		'KeyD2',
		'Map',
		'MapD2',
	];

	/**
	 * Create a new Swamp Palace Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Swamp Palace - Entrance", 0xEA9D, null, $this),
			new Location\BigChest("Swamp Palace - Big Chest", 0xE989, null, $this),
			new Location\Chest("Swamp Palace - Big Key Chest", 0xEAA6, null, $this),
			new Location\Chest("Swamp Palace - Map Chest", 0xE986, null, $this),
			new Location\Chest("Swamp Palace - West Chest", 0xEAA3, null, $this),
			new Location\Chest("Swamp Palace - Compass Chest", 0xEAA0, null, $this),
			new Location\Chest("Swamp Palace - Flooded Room - Left", 0xEAA9, null, $this),
			new Location\Chest("Swamp Palace - Flooded Room - Right", 0xEAAC, null, $this),
			new Location\Chest("Swamp Palace - Waterfall Room", 0xEAAF, null, $this),
			new Location\Drop("Swamp Palace - Arrghus", 0x180154, null, $this),

			new Location\Prize\Crystal("Swamp Palace - Prize", [null, 0x120A0, 0x53F6C, 0x53F6D, 0x180055, 0x180071, 0xC701], null, $this),
		]);

		$this->prize_location = $this->locations["Swamp Palace - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Swamp Palace - Entrance"]->setItem(Item::get('KeyD2'));
		$this->locations["Swamp Palace - Big Chest"]->setItem(Item::get('Hookshot'));
		$this->locations["Swamp Palace - Big Key Chest"]->setItem(Item::get('BigKeyD2'));
		$this->locations["Swamp Palace - Map Chest"]->setItem(Item::get('MapD2'));
		$this->locations["Swamp Palace - West Chest"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Swamp Palace - Compass Chest"]->setItem(Item::get('CompassD2'));
		$this->locations["Swamp Palace - Flooded Room - Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Swamp Palace - Flooded Room - Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Swamp Palace - Waterfall Room"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Swamp Palace - Arrghus"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Swamp Palace - Prize"]->setItem(Item::get('Crystal2'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Swamp Palace - Entrance"]->setFillRules(function($item, $locations, $items) {
			return $item == Item::get('KeyD2');
		});

		$this->locations["Swamp Palace - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('BigKeyD2');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD2');
		});

		$this->locations["Swamp Palace - Big Key Chest"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer');
		});

		$this->locations["Swamp Palace - Map Chest"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2');
		});

		$this->locations["Swamp Palace - West Chest"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer');
		});

		$this->locations["Swamp Palace - Compass Chest"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer');
		});

		$this->locations["Swamp Palace - Flooded Room - Left"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["Swamp Palace - Flooded Room - Right"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["Swamp Palace - Waterfall Room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["Swamp Palace - Arrghus"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& ($item instanceof Item\Key || $item instanceof Item\BigKey
					|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
				return false;
			}

			return $this->world->config('region.bossHaveKey', true)
				|| !in_array($item, [Item::get('KeyD2'), Item::get('BigKeyD2')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('Hammer')
				&& $items->has('Hookshot')
				&& $items->has('KeyD2');
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('MagicMirror') && $items->has('Flippers')
				&& $this->world->getRegion('South Dark World')->canEnter($locations, $items);
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

		$main = function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('MagicMirror') && $items->has('Flippers')
				&& $this->world->getRegion('South Dark World')->canEnter($locations, $items);
		};

		$hera = function($locations, $items) {
			return $locations["Tower of Hera - Big Chest"]->canAccess($items);
		};

		$mire = function($locations, $items) {
			return $items->has('KeyD6', 3) && $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
		};

		$this->locations["Swamp Palace - Compass Chest"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return $items->has('KeyD2') && $items->has('Flippers')
				&& ($mire($locations, $items)
					|| ($main($locations, $items) && $items->has('Hammer')));
		});

		$this->locations["Swamp Palace - Big Key Chest"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return $items->has('KeyD2') && $items->has('Flippers')
				&& ($mire($locations, $items)
					|| ($main($locations, $items) && $items->has('Hammer')));
		});

		$this->locations["Swamp Palace - West Chest"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return $items->has('KeyD2') && $items->has('Flippers')
				&& ($mire($locations, $items)
					|| ($main($locations, $items) && $items->has('Hammer')));
		});

		$this->locations["Swamp Palace - Big Chest"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return $items->has('KeyD2') && $items->has('Flippers')
				&& ($mire($locations, $items) && ($items->has('BigKeyD6') || $items->has('BigKeyD2') || $items->has('BigKeyP3'))
					|| ($main($locations, $items) && $items->has('Hammer') && $items->has('BigKeyD2')));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD2');
		});

		$this->locations["Swamp Palace - Flooded Room - Left"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return $items->has('KeyD2') && $items->has('Hookshot') && $items->has('Flippers')
				&& ($mire($locations, $items)
					|| ($main($locations, $items) && $items->has('Hammer')));
		});

		$this->locations["Swamp Palace - Flooded Room - Right"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return $items->has('KeyD2') && $items->has('Hookshot') && $items->has('Flippers')
				&& ($mire($locations, $items)
					|| ($main($locations, $items) && $items->has('Hammer')));
		});

		$this->locations["Swamp Palace - Waterfall Room"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return $items->has('KeyD2') && $items->has('Hookshot') && $items->has('Flippers')
				&& ($mire($locations, $items)
					|| ($main($locations, $items) && $items->has('Hammer')));
		});

		$this->locations["Swamp Palace - Arrghus"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return $items->has('KeyD2') && $items->has('Hookshot') && $items->has('Flippers')
				&& ($mire($locations, $items)
					|| ($main($locations, $items) && $items->has('Hammer')))
				&& ($items->hasSword() || $items->has('Hammer')
					|| (($items->canShootArrows() || $items->canExtendMagic())
						&& ($items->has('FireRod') || $items->has('IceRod'))));
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& ($item instanceof Item\Key || $item instanceof Item\BigKey
					|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
				return false;
			}

			return $this->world->config('region.bossHaveKey', true)
				|| !in_array($item, [Item::get('KeyD2'), Item::get('BigKeyD2')]);
		});

		$this->can_complete = function($locations, $items) use ($main, $mire) {
			return $main($locations, $items) && $items->has('KeyD2') && $items->has('Hookshot')
				&& ($items->has('Hammer') || $mire($locations, $items))
				&& $locations["Swamp Palace - Arrghus"]->canAccess($items);
		};

		$this->can_enter = function($locations, $items) use ($main, $mire) {
			return $main($locations, $items)
				|| $mire($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
