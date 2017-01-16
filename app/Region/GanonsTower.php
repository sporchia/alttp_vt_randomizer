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
			new Location\Chest("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace", 0xEAE2, null, $this),
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
		]);
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
					"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace",
				]);
			})->random()->fill(Item::get("Key"), $my_items));
		} else {
			$locations["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance"]->setItem(Item::get('Key'));
		}

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
				"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace",
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
				"[dungeon-A2-1F] Ganon's Tower - big chest",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]",
				"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]",
				"[dungeon-A2-1F] Ganon's Tower - above Armos",
				"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace",
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
				"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]",
				"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]",
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
				"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
				"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]",
				"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]",
			]);
		})->random()->fill(Item::get("BigKey"), $my_items));

		if ($this->world->config('region.CompassesMaps', true)) {
			while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

			while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));
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
			return $items->has('Hammer') && ($items->has('PegasusBoots') || $items->has('Hookshot'));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && ($items->has('PegasusBoots') || $items->has('Hookshot'));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && ($items->has('PegasusBoots') || $items->has('Hookshot'));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && ($items->has('PegasusBoots') || $items->has('Hookshot'));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - north of teleport room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Hookshot');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - map room"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && ($items->has('PegasusBoots') || $items->has('Hookshot'));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - big chest"]->setRequirements(function($locations, $items) {
			return ($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - above Armos"]->setRequirements(function($locations, $items) {
			return ($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria');
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

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]"]->setRequirements(function($locations, $items) {
			return ($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]"]->setRequirements(function($locations, $items) {
			return ($items->has('Hammer') && $items->has('Hookshot'))
				||($items->has('FireRod') && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]"]->setRequirements(function($locations, $items) {
			return ($items->has('Hammer') && $items->has('Hookshot'))
				|| ($items->has('FireRod') && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->canShootArrows();
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->canShootArrows();
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - before Moldorm"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->canShootArrows();
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - Moldorm room"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->has('Hookshot') && $items->canShootArrows();
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl')
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
			return $items->has('Hammer')
				|| ($items->canLightTorches() && $items->has('CaneOfSomaria'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - above Armos"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				|| ($items->canLightTorches() && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				|| ($items->canLightTorches() && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				|| ($items->canLightTorches() && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				|| ($items->canLightTorches() && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (($this->bigKeyRequiresHammer() && $items->has('Hammer'))
					|| ($this->bigKeyRequiresCaneOfSomaria() && $items->has('CaneOfSomaria'))
					|| (!$this->bigKeyRequiresHammer() && !$this->bigKeyRequiresCaneOfSomaria()));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});


		$this->locations["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (($this->bigKeyRequiresHammer() && $items->has('Hammer'))
					|| ($this->bigKeyRequiresCaneOfSomaria() && $items->has('CaneOfSomaria'))
					|| (!$this->bigKeyRequiresHammer() && !$this->bigKeyRequiresCaneOfSomaria()));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});


		$this->locations["[dungeon-A2-6F] Ganon's Tower - before Moldorm"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches()
				&& (($this->bigKeyRequiresHammer() && $items->has('Hammer'))
					|| ($this->bigKeyRequiresCaneOfSomaria() && $items->has('CaneOfSomaria'))
					|| (!$this->bigKeyRequiresHammer() && !$this->bigKeyRequiresCaneOfSomaria()));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});


		$this->locations["[dungeon-A2-6F] Ganon's Tower - Moldorm room"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->canLightTorches() && $items->has('Hookshot')
				&& (($this->bigKeyRequiresHammer() && $items->has('Hammer'))
					|| ($this->bigKeyRequiresCaneOfSomaria() && $items->has('CaneOfSomaria'))
					|| (!$this->bigKeyRequiresHammer() && !$this->bigKeyRequiresCaneOfSomaria()));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});


		return $this;
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
			"[dungeon-A2-1F] Ganon's Tower - above Armos",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]",
		]);
	}

	protected function bigKeyRequiresCaneOfSomaria() {
		return $this->locations->itemInLocations(Item::get('BigKey'), [
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]",
			"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace",
			"[dungeon-A2-1F] Ganon's Tower - above Armos",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]",
		]);
	}
}
