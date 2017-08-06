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
			new Location\Chest("[dungeon-D2-1F] Swamp Palace - first room", 0xEA9D, null, $this),
			new Location\BigChest("[dungeon-D2-B1] Swamp Palace - big chest", 0xE989, null, $this),
			new Location\Chest("[dungeon-D2-B1] Swamp Palace - big key room", 0xEAA6, null, $this),
			new Location\Chest("[dungeon-D2-B1] Swamp Palace - map room", 0xE986, null, $this),
			new Location\Chest("[dungeon-D2-B1] Swamp Palace - push 4 blocks room", 0xEAA3, null, $this),
			new Location\Chest("[dungeon-D2-B1] Swamp Palace - south of hookshot room", 0xEAA0, null, $this),
			new Location\Chest("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", 0xEAA9, null, $this),
			new Location\Chest("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", 0xEAAC, null, $this),
			new Location\Chest("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", 0xEAAF, null, $this),
			new Location\Drop("Heart Container - Arrghus", 0x180154, null, $this),

			new Location\Prize\Crystal("Swamp Palace Crystal", [null, 0x120A0, 0x53F6C, 0x53F6D, 0x180055, 0x180071, 0xC701], null, $this),
		]);

		$this->prize_location = $this->locations["Swamp Palace Crystal"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-D2-1F] Swamp Palace - first room"]->setItem(Item::get('KeyD2'));
		$this->locations["[dungeon-D2-B1] Swamp Palace - big chest"]->setItem(Item::get('Hookshot'));
		$this->locations["[dungeon-D2-B1] Swamp Palace - big key room"]->setItem(Item::get('BigKeyD2'));
		$this->locations["[dungeon-D2-B1] Swamp Palace - map room"]->setItem(Item::get('MapD2'));
		$this->locations["[dungeon-D2-B1] Swamp Palace - push 4 blocks room"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-D2-B1] Swamp Palace - south of hookshot room"]->setItem(Item::get('CompassD2'));
		$this->locations["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Heart Container - Arrghus"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Swamp Palace Crystal"]->setItem(Item::get('Crystal2'));

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
		if ($item instanceof Item\Key && !in_array($item, [Item::get('Key'), Item::get('KeyD2')])) {
			return false;
		}

		if ($item instanceof Item\BigKey && !in_array($item, [Item::get('BigKey'), Item::get('BigKeyD2')])) {
			return false;
		}

		if ($item instanceof Item\Map
			&& (!$this->world->config('region.mapsInDungeons', true)
				|| !in_array($item, [Item::get('Map'), Item::get('MapD2')]))) {
			return false;
		}

		if ($item instanceof Item\Compass
			&& (!$this->world->config('region.compassesInDungeons', true)
				|| !in_array($item, [Item::get('Compass'), Item::get('CompassD2')]))) {
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
		$this->locations["[dungeon-D2-1F] Swamp Palace - first room"]->setFillRules(function($item, $locations, $items) {
			return $item == Item::get('KeyD2');
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('BigKeyD2');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD2');
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - big key room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer');
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - map room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2');
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - push 4 blocks room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer');
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - south of hookshot room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer');
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD2')
				&& $items->has('Hammer')
				&& $items->has('Hookshot');
		});

		$this->locations["Heart Container - Arrghus"]->setRequirements(function($locations, $items) {
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
				&& $items->has('Hookshot');
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
		$this->locations["[dungeon-D2-B1] Swamp Palace - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers')
				&& (($this->world->getRegion('Misery Mire')->canEnter($locations, $items) && (!$locations->itemInLocations(Item::get('BigKeyD2'), [
						"[dungeon-D6-B1] Misery Mire - big key",
						"[dungeon-D6-B1] Misery Mire - compass",
					])
					|| $items->canLightTorches()))
				|| (($items->has('Hammer')
						&& $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2')))
					&& (!$locations->itemInLocations(Item::get('BigKeyD2'), [
						"[dungeon-D2-B2] Swamp Palace - flooded room [left chest]",
						"[dungeon-D2-B2] Swamp Palace - flooded room [right chest]",
						"[dungeon-D2-B2] Swamp Palace - hidden waterfall door room",
						"Heart Container - Arrghus",
					]) || $items->has('Hookshot'))));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD2');
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - big key room"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers')
				&& ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					|| ($items->has('Hammer') && $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2'))));
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - push 4 blocks room"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers')
				&& ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					|| ($items->has('Hammer') && $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2'))));
		});

		$this->locations["[dungeon-D2-B1] Swamp Palace - south of hookshot room"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers')
				&& ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					|| ($items->has('Hammer') && $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2'))));
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hookshot') && $items->has('Flippers')
				&& ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					|| ($items->has('Hammer') && $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2'))));
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hookshot') && $items->has('Flippers')
				&& ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					|| ($items->has('Hammer') && $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2'))));
		});

		$this->locations["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room"]->setRequirements(function($locations, $items) {
			return $items->has('Hookshot') && $items->has('Flippers')
				&& ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					|| ($items->has('Hammer') && $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2'))));
		});

		$this->locations["Heart Container - Arrghus"]->setRequirements(function($locations, $items) {
			return ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					|| ($items->has('Hammer') && $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2'))))
				&& $items->has('MoonPearl') && $items->has('MagicMirror')
				&& $items->has('Flippers') && $items->has('Hookshot')
				&& ($items->has('FireRod') || $items->has('IceRod') || $items->canShootArrows());
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
			return $this->canEnter($locations, $items)
				&& ($this->world->getRegion('Misery Mire')->canEnter($locations, $items)
					|| ($items->has('Hammer') && $locations["[dungeon-D2-1F] Swamp Palace - first room"]->hasItem(Item::get('KeyD2'))))
				&& $items->has('MoonPearl') && $items->has('MagicMirror')
				&& $items->has('Flippers') && $items->has('Hookshot');
		};

		$this->can_enter = function($locations, $items) {
			return ($items->has('Flippers') && $items->has('MagicMirror') && $items->has('MoonPearl'))
				|| $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
