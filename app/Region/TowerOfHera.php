<?php namespace ALttP\Region;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Tower of Hera Region and it's Locations contained within
 */
class TowerOfHera extends Region {
	protected $name = 'Tower Of Hera';
	public $music_addresses = [
		0x155C5,
		0x1107A,
		0x10B8C,
	];

	protected $region_items = [
		'BigKey',
		'BigKeyP3',
		'Compass',
		'CompassP3',
		'Key',
		'KeyP3',
		'Map',
		'MapP3',
	];

	/**
	 * Create a new Tower of Hera Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		// set a default boss
		$this->boss = Boss::get("Moldorm");

		$this->locations = new LocationCollection([
			new Location\Chest("Tower of Hera - Big Key Chest", 0xE9E6, null, $this),
			new Location\Standing\HeraBasement("Tower of Hera - Basement Cage", 0x180162, null, $this),
			new Location\Chest("Tower of Hera - Map Chest", 0xE9AD, null, $this),
			new Location\Chest("Tower of Hera - Compass Chest", 0xE9FB, null, $this),
			new Location\BigChest("Tower of Hera - Big Chest", 0xE9F8, null, $this),
			new Location\Drop("Tower of Hera - Moldorm", 0x180152, null, $this),

			new Location\Prize\Pendant("Tower of Hera - Prize", [null, 0x120A5, 0x53F0A, 0x53F0B, 0x18005A, 0x18007A, 0xC706], null, $this),
		]);

		$this->prize_location = $this->locations["Tower of Hera - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Tower of Hera - Big Key Chest"]->setItem(Item::get('BigKeyP3'));
		$this->locations["Tower of Hera - Basement Cage"]->setItem(Item::get('KeyP3'));
		$this->locations["Tower of Hera - Map Chest"]->setItem(Item::get('MapP3'));
		$this->locations["Tower of Hera - Compass Chest"]->setItem(Item::get('CompassP3'));
		$this->locations["Tower of Hera - Big Chest"]->setItem(Item::get('MoonPearl'));
		$this->locations["Tower of Hera - Moldorm"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Tower of Hera - Prize"]->setItem(Item::get('PendantOfPower'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Tower of Hera - Big Key Chest"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->has('KeyP3');
		})->setAlwaysAllow(function($item, $items) {
			return $item == Item::get('KeyP3');
		});

		$this->locations["Tower of Hera - Compass Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyP3');
		});

		$this->locations["Tower of Hera - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyP3');
		});

		$this->can_complete = function($locations, $items) {
			return $this->locations["Tower of Hera - Moldorm"]->canAccess($items)
				&& (!$this->world->config('region.wildCompasses', false) || $items->has('CompassP3'))
				&& (!$this->world->config('region.wildMaps', false) || $items->has('MapP3'));
		};

		$this->locations["Tower of Hera - Moldorm"]->setRequirements(function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $this->boss->canBeat($items, $locations)
				&& $items->has('BigKeyP3');
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& ($item instanceof Item\Key || $item instanceof Item\BigKey
					|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
				return false;
			}

			return true;
		});

		$this->can_enter = function($locations, $items) {
			return ($items->has('MagicMirror') || ($items->has('Hookshot') && $items->has('Hammer')))
				&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items);
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
		$this->initOverworldGlitches();

		$main = function($locations, $items) {
			return $items->has('PegasusBoots')
				|| (($items->has('MagicMirror') || ($items->has('Hookshot') && $items->has('Hammer')))
					&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items));
		};

		$mire = function($locations, $items) {
			return (($locations->itemInLocations(Item::get('BigKeyD6'), [
						"Misery Mire - Compass Chest",
						"Misery Mire - Big Key Chest",
					]) && $items->has('KeyD6', 2))
				|| $items->has('KeyD6', 3))
			&& $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
		};

		$this->locations["Tower of Hera - Big Key Chest"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->has('KeyP3');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('KeyP3');
		});

		$this->locations["Tower of Hera - Compass Chest"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return ($main($locations, $items) && $items->has('BigKeyP3'))
				|| $mire($locations, $items);
		});

		$this->locations["Tower of Hera - Big Chest"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return ($main($locations, $items) && $items->has('BigKeyP3'))
				|| ($mire($locations, $items) && ($items->has('BigKeyP3') || $items->has('BigKeyD6')));
		});

		$this->locations["Tower of Hera - Moldorm"]->setRequirements(function($locations, $items) use ($main, $mire) {
			return (($main($locations, $items) && $items->has('BigKeyP3'))
					|| $mire($locations, $items))
				&& $this->boss->canBeat($items, $locations);
		});

		// @TODO: this function is probably wrong -_-
		$this->can_complete = function($locations, $items) use ($main, $mire) {
			return ((($main($locations, $items) && $items->has('BigKeyP3'))
					|| ($mire($locations, $items) && ($items->has('BigKeyP3') || $items->has('BigKeyD6'))))
				&& ($items->hasSword() || $items->has('Hammer')))
			|| ($locations["Tower of Hera - Big Chest"]->canAccess($items)
				&& $locations["Swamp Palace - Arrghus"]->canAccess($items));
		};

		$this->can_enter = function($locations, $items) use ($main, $mire) {
			return $main($locations, $items)
				|| $mire($locations, $items);
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->initNoMajorGlitches();

		$this->can_enter = function($locations, $items) {
			return $items->has('PegasusBoots')
				|| (($items->has('MagicMirror') || ($items->has('Hookshot') && $items->has('Hammer')))
					&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items));
		};

		return $this;
	}
}
