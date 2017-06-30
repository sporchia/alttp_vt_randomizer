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
	public $music_addresses = [
		0x155C9,
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
			new Location\Dash("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", 0x180161, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", 0xEAB8, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", 0xEABB, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", 0xEABE, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", 0xEAC1, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", 0xEAC4, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", 0xEAC7, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", 0xEACA, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", 0xEACD, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - north of teleport room", 0xEAD0, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - map room", 0xEAD3, null, $this),
			new Location\BigChest("[dungeon-A2-1F] Ganon's Tower - big chest", 0xEAD6, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", 0xEAD9, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", 0xEADC, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - above Armos", 0xEADF, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", 0xEAE2, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", 0xEAE5, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", 0xEAE8, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", 0xEAEB, null, $this),
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", 0xEAEE, null, $this),
			new Location\Chest("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", 0xEAF1, null, $this),
			new Location\Chest("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", 0xEAF4, null, $this),
			new Location\Chest("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", 0xEAF7, null, $this),
			new Location\Chest("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", 0xEAFD, null, $this),
			new Location\Chest("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", 0xEB00, null, $this),
			new Location\Chest("[dungeon-A2-6F] Ganon's Tower - before Moldorm", 0xEB03, null, $this),
			new Location\Chest("[dungeon-A2-6F] Ganon's Tower - Moldorm room", 0xEB06, null, $this),
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
		$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]"]->setItem(Item::get('TenArrows'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]"]->setItem(Item::get('TenArrows'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]"]->setItem(Item::get('TenArrows'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of teleport room"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - map room"]->setItem(Item::get('Map'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - big chest"]->setItem(Item::get('RedMail'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]"]->setItem(Item::get('TenArrows'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - above Armos"]->setItem(Item::get('TenArrows'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]"]->setItem(Item::get('Compass'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]"]->setItem(Item::get('OneRupee'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]"]->setItem(Item::get('TenArrows'));
		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]"]->setItem(Item::get('BigKey'));
		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]"]->setItem(Item::get('TenArrows'));
		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-A2-6F] Ganon's Tower - before Moldorm"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-A2-6F] Ganon's Tower - Moldorm room"]->setItem(Item::get('TwentyRupees'));

		return $this;
	}

	/**
	 * Place Keys, Map, and Compass in Region. Ganons Tower has: Big Key, Map, Compass, 4 Keys
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations;

		if (!$this->world->config('region.bonkItems', true)) {
			$locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->setItem(Item::get('Key'));
		}

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of teleport room",
				"[dungeon-A2-1F] Ganon's Tower - map room",
				"[dungeon-A2-1F] Ganon's Tower - big chest",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-1F] Ganon's Tower - above Armos",
				"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			]);
		})->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of teleport room",
				"[dungeon-A2-1F] Ganon's Tower - map room",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-1F] Ganon's Tower - above Armos",
				"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]",
			]);
		})->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of teleport room",
				"[dungeon-A2-1F] Ganon's Tower - map room",
				"[dungeon-A2-1F] Ganon's Tower - big chest",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-1F] Ganon's Tower - above Armos",
				"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]",
			]);
		})->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), [
				"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - north of teleport room",
				"[dungeon-A2-1F] Ganon's Tower - map room",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance",
			]);
		})->random()->fill(Item::get("Key"), $my_items));

		if ($this->world->config('region.bonkItems', true)) {
			while(!$locations->getEmptyLocations()->filter(function($location) {
				return in_array($location->getName(), [
					"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of teleport room",
					"[dungeon-A2-1F] Ganon's Tower - map room",
					"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
					"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
					"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance",
				]);
			})->random()->fill(Item::get("Key"), $my_items));
		}

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
		$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of teleport room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - map room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && ($items->has('PegasusBoots') || $items->has('Hookshot'))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - big chest"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot')) || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresHookshot() || $items->has('Hookshot'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey')
				&& ($item != Item::get('Key') || !$locations->itemInLocations(Item::get('Key'), [
					"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
					"[dungeon-A2-1F] Ganon's Tower - big chest",
					"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
					"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
					"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
				], 2));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - above Armos"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key') || !$locations->itemInLocations(Item::get('Key'), [
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - big chest",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			], 2);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key') || !$locations->itemInLocations(Item::get('Key'), [
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - big chest",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			], 2);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key') || !$locations->itemInLocations(Item::get('Key'), [
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - big chest",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			], 2);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key') || !$locations->itemInLocations(Item::get('Key'), [
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - big chest",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			], 2);
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot'))
				||($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]"]->setRequirements(function($locations, $items) {
			return (($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (!$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('BigKey'))
					|| $items->has('PegasusBoots'))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresHookshot() || $items->has('Hookshot'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria()
					|| ($items->has('Hammer') && $items->has('Hookshot')) || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey')
				&& ($item != Item::get('Key') || !$locations->itemInLocations(Item::get('Key'), [
					"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
					"[dungeon-A2-1F] Ganon's Tower - big chest",
					"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
					"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
					"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
				], 2));
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (!$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('BigKey'))
					|| $items->has('PegasusBoots'))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresHookshot() || $items->has('Hookshot'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria()
					|| ($items->has('Hammer') && $items->has('Hookshot')) || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey')
				&& ($item != Item::get('Key') || !$locations->itemInLocations(Item::get('Key'), [
					"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
					"[dungeon-A2-1F] Ganon's Tower - big chest",
					"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
					"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
					"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
				], 2));
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - before Moldorm"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (!$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('BigKey'))
					|| $items->has('PegasusBoots'))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresHookshot() || $items->has('Hookshot'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria()
					|| ($items->has('Hammer') && $items->has('Hookshot')) || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey')
				&& ($item != Item::get('Key') || !$locations->itemInLocations(Item::get('Key'), [
					"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
					"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
					"[dungeon-A2-1F] Ganon's Tower - big chest",
					"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
					"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
					"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
				], 2));
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - Moldorm room"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches() && $items->has('Hookshot')
				&& (!$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('BigKey'))
					|| $items->has('PegasusBoots'))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresHookshot() || $items->has('Hookshot'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria()
					|| ($items->has('Hammer') && $items->has('Hookshot')) || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& $this->bootsIfKeyOnTorch($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey') && $item != Item::get('Key');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $this->locations["[dungeon-A2-6F] Ganon's Tower - Moldorm room"]->canAccess($items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canLiftDarkRocks()
				&& $items->has('Crystal1')
				&& $items->has('Crystal2')
				&& $items->has('Crystal3')
				&& $items->has('Crystal4')
				&& $items->has('Crystal5')
				&& $items->has('Crystal6')
				&& $items->has('Crystal7');
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Glitched Mode.
	 *
	 * @return $this
	 */
	public function initGlitched() {
		$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey') || $locations->itemInLocations(Item::get('Key'), [
				"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			]);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]"]->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey') || $locations->itemInLocations(Item::get('Key'), [
				"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			]);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]"]->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey') || $locations->itemInLocations(Item::get('Key'), [
				"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			]);
		});


		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of teleport room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - map room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - big chest"]->setRequirements(function($locations, $items) {
			return ($items->has('Hammer') || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - above Armos"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				|| ($items->has('FireRod')&& $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey') || $locations->itemInLocations(Item::get('Key'), [
				"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
				"[dungeon-A2-6F] Ganon's Tower - before Moldorm",
			]);
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (!$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('BigKey'))
					|| $items->has('PegasusBoots'))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria()
					|| ($items->has('Hammer') || ($items->has('FireRod') && $items->has('CaneOfSomaria'))));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});


		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (!$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('BigKey'))
					|| $items->has('PegasusBoots'))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria()
					|| ($items->has('Hammer') || ($items->has('FireRod') && $items->has('CaneOfSomaria'))));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});


		$this->locations["[dungeon-A2-6F] Ganon's Tower - before Moldorm"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (!$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('BigKey'))
					|| $items->has('PegasusBoots'))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria()
					|| ($items->has('Hammer') || ($items->has('FireRod') && $items->has('CaneOfSomaria'))));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});


		$this->locations["[dungeon-A2-6F] Ganon's Tower - Moldorm room"]->setRequirements(function($locations, $items) {
			if (in_array(config('game-mode'), ['open', 'swordless']) && !($items->hasSword() || $items->has('Hammer'))) {
				return false;
			}

			return $items->canShootArrows() && $items->canLightTorches() && $items->has('Hookshot')
				&& (!$this->locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('BigKey'))
					|| $items->has('PegasusBoots'))
				&& (!$this->bigKeyRequiresHammer() || $items->has('Hammer'))
				&& (!$this->bigKeyRequiresFireRod() || $items->has('FireRod'))
				&& (!$this->bigKeyRequiresCaneOfSomaria() || $items->has('CaneOfSomaria'))
				&& (!$this->bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria()
					|| ($items->has('Hammer') || ($items->has('FireRod') && $items->has('CaneOfSomaria'))));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->can_complete = function($locations, $items) {
			return $this->locations["[dungeon-A2-6F] Ganon's Tower - Moldorm room"]->canAccess($items)
				&& $items->has('Hookshot')
				&& ($items->has('Hammer') || $items->hasSword() || $items->has('BugCatchingNet'));
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Minor Glitched Mode
	 *
	 * @return $this
	 */
	public function initSpeedRunner() {
		$this->initGlitched();

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl')
				&& $items->canLiftDarkRocks()
				&& $items->has('Crystal1')
				&& $items->has('Crystal2')
				&& $items->has('Crystal3')
				&& $items->has('Crystal4')
				&& $items->has('Crystal5')
				&& $items->has('Crystal6')
				&& $items->has('Crystal7');
		};

		return $this;
	}

	protected function bootsIfKeyOnTorch($locations, $items) {
		return $items->has('PegasusBoots')
			|| !$locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->hasItem(Item::get('Key'))
			|| $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
					"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
					"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				], 2)
			|| ($locations["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance"]->hasItem(Item::get('Key'))
				&& $items->has('CaneOfSomaria')
				&& $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
					"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
					"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
					"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				]));
	}

	protected function bigKeyRequiresHookshot() {
		return $this->locations->itemInLocations(Item::get('BigKey'), [
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
			"[dungeon-A2-1F] Ganon's Tower - north of teleport room",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]",
		]);
	}

	protected function bigKeyRequiresHammer() {
		return $this->locations->itemInLocations(Item::get('BigKey'), [
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]",
			"[dungeon-A2-1F] Ganon's Tower - map room",
			"[dungeon-A2-1F] Ganon's Tower - north of teleport room",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]",
		]);
	}

	protected function bigKeyRequiresHammerAndHookshotOrFireRodAndCaneOfSomaria() {
		return $this->locations->itemInLocations(Item::get('BigKey'), [
			"[dungeon-A2-1F] Ganon's Tower - above Armos",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]",
			"[dungeon-A2-1F] Ganon's Tower - big chest",
		]);
	}

	protected function bigKeyRequiresCaneOfSomaria() {
		return $this->locations->itemInLocations(Item::get('BigKey'), [
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
			"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance",
		]);
	}

	protected function bigKeyRequiresFireRod() {
		return $this->locations->itemInLocations(Item::get('BigKey'), [
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
		]);
	}

}
