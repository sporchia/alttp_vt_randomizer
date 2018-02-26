<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Ganons Tower Region and it's Locations contained within
 */
class GanonsTower extends Region {
	protected $name = 'Ganons Tower';
	protected $boss_bottom = null;
	protected $boss_middle = null;
	protected $boss_top = null;
	public $music_addresses = [
		0x155C9,
	];

	protected $region_items = [
		'BigKey',
		'BigKeyA2',
		'Compass',
		'CompassA2',
		'Key',
		'KeyA2',
		'Map',
		'MapA2',
	];

	/**
	 * Create a new Ganons Tower Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Dash("Ganon's Tower - Bob's Torch", 0x180161, null, $this),
			new Location\Chest("Ganon's Tower - DMs Room - Top Left", 0xEAB8, null, $this),
			new Location\Chest("Ganon's Tower - DMs Room - Top Right", 0xEABB, null, $this),
			new Location\Chest("Ganon's Tower - DMs Room - Bottom Left", 0xEABE, null, $this),
			new Location\Chest("Ganon's Tower - DMs Room - Bottom Right", 0xEAC1, null, $this),
			new Location\Chest("Ganon's Tower - Randomizer Room - Top Left", 0xEAC4, null, $this),
			new Location\Chest("Ganon's Tower - Randomizer Room - Top Right", 0xEAC7, null, $this),
			new Location\Chest("Ganon's Tower - Randomizer Room - Bottom Left", 0xEACA, null, $this),
			new Location\Chest("Ganon's Tower - Randomizer Room - Bottom Right", 0xEACD, null, $this),
			new Location\Chest("Ganon's Tower - Firesnake Room", 0xEAD0, null, $this),
			new Location\Chest("Ganon's Tower - Map Chest", 0xEAD3, null, $this),
			new Location\BigChest("Ganon's Tower - Big Chest", 0xEAD6, null, $this),
			new Location\Chest("Ganon's Tower - Hope Room - Left", 0xEAD9, null, $this),
			new Location\Chest("Ganon's Tower - Hope Room - Right", 0xEADC, null, $this),
			new Location\Chest("Ganon's Tower - Bob's Chest", 0xEADF, null, $this),
			new Location\Chest("Ganon's Tower - Tile Room", 0xEAE2, null, $this),
			new Location\Chest("Ganon's Tower - Compass Room - Top Left", 0xEAE5, null, $this),
			new Location\Chest("Ganon's Tower - Compass Room - Top Right", 0xEAE8, null, $this),
			new Location\Chest("Ganon's Tower - Compass Room - Bottom Left", 0xEAEB, null, $this),
			new Location\Chest("Ganon's Tower - Compass Room - Bottom Right", 0xEAEE, null, $this),
			new Location\Chest("Ganon's Tower - Big Key Chest", 0xEAF1, null, $this),
			new Location\Chest("Ganon's Tower - Big Key Room - Left", 0xEAF4, null, $this),
			new Location\Chest("Ganon's Tower - Big Key Room - Right", 0xEAF7, null, $this),
			new Location\Chest("Ganon's Tower - Mini Helmasaur Room - Left", 0xEAFD, null, $this),
			new Location\Chest("Ganon's Tower - Mini Helmasaur Room - Right", 0xEB00, null, $this),
			new Location\Chest("Ganon's Tower - Pre-Moldorm Chest", 0xEB03, null, $this),
			new Location\Chest("Ganon's Tower - Moldorm Chest", 0xEB06, null, $this),
			new Location\Prize\Event("Agahnim 2", null, null, $this),
		]);

		$this->prize_location = $this->locations["Agahnim 2"];
		$this->prize_location->setItem(Item::get('DefeatAgahnim2'));
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Ganon's Tower - Bob's Torch"]->setItem(Item::get('KeyA2'));
		$this->locations["Ganon's Tower - DMs Room - Top Left"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Ganon's Tower - DMs Room - Top Right"]->setItem(Item::get('TenArrows'));
		$this->locations["Ganon's Tower - DMs Room - Bottom Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Ganon's Tower - DMs Room - Bottom Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Ganon's Tower - Randomizer Room - Top Left"]->setItem(Item::get('TenArrows'));
		$this->locations["Ganon's Tower - Randomizer Room - Top Right"]->setItem(Item::get('TenArrows'));
		$this->locations["Ganon's Tower - Randomizer Room - Bottom Left"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Ganon's Tower - Randomizer Room - Bottom Right"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Ganon's Tower - Firesnake Room"]->setItem(Item::get('KeyA2'));
		$this->locations["Ganon's Tower - Map Chest"]->setItem(Item::get('MapA2'));
		$this->locations["Ganon's Tower - Big Chest"]->setItem(Item::get('RedMail'));
		$this->locations["Ganon's Tower - Hope Room - Left"]->setItem(Item::get('TenArrows'));
		$this->locations["Ganon's Tower - Hope Room - Right"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Ganon's Tower - Bob's Chest"]->setItem(Item::get('TenArrows'));
		$this->locations["Ganon's Tower - Tile Room"]->setItem(Item::get('KeyA2'));
		$this->locations["Ganon's Tower - Compass Room - Top Left"]->setItem(Item::get('Compass'));
		$this->locations["Ganon's Tower - Compass Room - Top Right"]->setItem(Item::get('OneRupee'));
		$this->locations["Ganon's Tower - Compass Room - Bottom Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Ganon's Tower - Compass Room - Bottom Right"]->setItem(Item::get('TenArrows'));
		$this->locations["Ganon's Tower - Big Key Chest"]->setItem(Item::get('BigKeyA2'));
		$this->locations["Ganon's Tower - Big Key Room - Left"]->setItem(Item::get('TenArrows'));
		$this->locations["Ganon's Tower - Big Key Room - Right"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Ganon's Tower - Mini Helmasaur Room - Left"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Ganon's Tower - Mini Helmasaur Room - Right"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Ganon's Tower - Pre-Moldorm Chest"]->setItem(Item::get('KeyA2'));
		$this->locations["Ganon's Tower - Moldorm Chest"]->setItem(Item::get('TwentyRupees'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Ganon's Tower - Bob's Torch"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Ganon's Tower - DMs Room - Top Left"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["Ganon's Tower - DMs Room - Top Right"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["Ganon's Tower - DMs Room - Bottom Left"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["Ganon's Tower - DMs Room - Bottom Right"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["Ganon's Tower - Randomizer Room - Top Left"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& (($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Randomizer Room - Top Right",
						"Ganon's Tower - Randomizer Room - Bottom Left",
						"Ganon's Tower - Randomizer Room - Bottom Right",
					]) && $items->has('KeyA2', 3))
				|| $items->has('KeyA2', 4));
		});

		$this->locations["Ganon's Tower - Randomizer Room - Top Right"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& (($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Randomizer Room - Top Left",
						"Ganon's Tower - Randomizer Room - Bottom Left",
						"Ganon's Tower - Randomizer Room - Bottom Right",
					]) && $items->has('KeyA2', 3))
				|| $items->has('KeyA2', 4));
		});

		$this->locations["Ganon's Tower - Randomizer Room - Bottom Left"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& (($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Randomizer Room - Top Right",
						"Ganon's Tower - Randomizer Room - Top Left",
						"Ganon's Tower - Randomizer Room - Bottom Right",
					]) && $items->has('KeyA2', 3))
				|| $items->has('KeyA2', 4));
		});

		$this->locations["Ganon's Tower - Randomizer Room - Bottom Right"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& (($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Randomizer Room - Top Right",
						"Ganon's Tower - Randomizer Room - Top Left",
						"Ganon's Tower - Randomizer Room - Bottom Left",
					]) && $items->has('KeyA2', 3))
				|| $items->has('KeyA2', 4));
		});

		$this->locations["Ganon's Tower - Firesnake Room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& ((($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Randomizer Room - Top Right",
						"Ganon's Tower - Randomizer Room - Top Left",
						"Ganon's Tower - Randomizer Room - Bottom Left",
						"Ganon's Tower - Randomizer Room - Bottom Right",
					]) || $locations["Ganon's Tower - Firesnake Room"]->hasItem(Item::get('KeyA2'))) && $items->has('KeyA2', 2))
				|| $items->has('KeyA2', 3));
		});

		$this->locations["Ganon's Tower - Map Chest"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && ($items->has('PegasusBoots') || $items->has('Hookshot'))
				&& (in_array($locations["Ganon's Tower - Map Chest"]->getItem(), [Item::get('BigKeyA2'), Item::get('KeyA2')])
					? $items->has('KeyA2', 3) : $items->has('KeyA2', 4));
		})->setAlwaysAllow(function($item, $items) {
			return $item == Item::get('KeyA2') && $items->has('KeyA2', 3);
		});

		$this->locations["Ganon's Tower - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyA2') && $items->has('KeyA2', 3)
				&& (($items->has('Hammer') && $items->has('Hookshot')) || ($items->has('FireRod') && $items->has('CaneOfSomaria')));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyA2');
		});

		$this->locations["Ganon's Tower - Bob's Chest"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $items->has('KeyA2', 3);
		});

		$this->locations["Ganon's Tower - Tile Room"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria');
		});

		$this->locations["Ganon's Tower - Compass Room - Top Left"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& (($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Compass Room - Top Right",
						"Ganon's Tower - Compass Room - Bottom Left",
						"Ganon's Tower - Compass Room - Bottom Right",
					]) && $items->has('KeyA2', 3))
				|| $items->has('KeyA2', 4));
		});

		$this->locations["Ganon's Tower - Compass Room - Top Right"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& (($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Compass Room - Top Left",
						"Ganon's Tower - Compass Room - Bottom Left",
						"Ganon's Tower - Compass Room - Bottom Right",
					]) && $items->has('KeyA2', 3))
				|| $items->has('KeyA2', 4));
		});

		$this->locations["Ganon's Tower - Compass Room - Bottom Left"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& (($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Compass Room - Top Right",
						"Ganon's Tower - Compass Room - Top Left",
						"Ganon's Tower - Compass Room - Bottom Right",
					]) && $items->has('KeyA2', 3))
				|| $items->has('KeyA2', 4));
		});

		$this->locations["Ganon's Tower - Compass Room - Bottom Right"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& (($locations->itemInLocations(Item::get('BigKeyA2'), [
						"Ganon's Tower - Compass Room - Top Right",
						"Ganon's Tower - Compass Room - Top Left",
						"Ganon's Tower - Compass Room - Bottom Left",
					]) && $items->has('KeyA2', 3))
				|| $items->has('KeyA2', 4));
		});

		$this->locations["Ganon's Tower - Big Key Chest"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $items->has('KeyA2', 3);
		});

		$this->locations["Ganon's Tower - Big Key Room - Left"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot'))
				||($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $items->has('KeyA2', 3);
		});

		$this->locations["Ganon's Tower - Big Key Room - Right"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $items->has('KeyA2', 3);
		});

		$this->locations["Ganon's Tower - Mini Helmasaur Room - Left"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& $items->has('BigKeyA2') && $items->has('KeyA2', 3);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyA2');
		});

		$this->locations["Ganon's Tower - Mini Helmasaur Room - Right"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& $items->has('BigKeyA2') && $items->has('KeyA2', 3);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyA2');
		});

		$this->locations["Ganon's Tower - Pre-Moldorm Chest"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& $items->has('BigKeyA2') && $items->has('KeyA2', 3);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyA2');
		});

		$this->locations["Ganon's Tower - Moldorm Chest"]->setRequirements(function($locations, $items) {
			return $items->has('Hookshot')
				&& $items->canShootArrows() && $items->canLightTorches()
				&& ($items->has('Hammer') || $items->hasSword())
				&& $items->has('BigKeyA2') && $items->has('KeyA2', 4);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('KeyA2') && $item != Item::get('BigKeyA2');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $this->locations["Ganon's Tower - Moldorm Chest"]->canAccess($items)
				&& ($items->hasSword() || $items->has('BugCatchingNet') || $items->has('Hammer'));
		};

		$this->prize_location->setRequirements($this->can_complete);

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& $items->has('MoonPearl')
				&& $items->has('Crystal1')
				&& $items->has('Crystal2')
				&& $items->has('Crystal3')
				&& $items->has('Crystal4')
				&& $items->has('Crystal5')
				&& $items->has('Crystal6')
				&& $items->has('Crystal7')
				&& $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items);
		};

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
			return $this->world->getRegion('West Death Mountain')->canEnter($locations, $items);
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
			return $items->has('PegasusBoots') && $items->has('MoonPearl');
		};

		return $this;
	}
}
