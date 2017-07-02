<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Turtle Rock Region and it's Locations contained within
 */
class TurtleRock extends Region {
	protected $name = 'Turtle Rock';
	public $music_addresses = [
		0x155C7,
		0x155A7,
		0x155AA,
		0x155AB,
	];
	private $key_fill_1 = [
		"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
		"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
		"[dungeon-D7-1F] Turtle Rock - compass room",
	];
	private $key_fill_2 = [
		"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
		"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
		"[dungeon-D7-1F] Turtle Rock - compass room",
		"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
	];
	private $key_fill_3 = [
		"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
		"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
		"[dungeon-D7-1F] Turtle Rock - compass room",
		"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
		"[dungeon-D7-B1] Turtle Rock - big key room",
		"[dungeon-D7-B1] Turtle Rock - Roller switch room",
		"[dungeon-D7-B1] Turtle Rock - big chest",
	];

	private $big_key_fill = [
		"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
		"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
		"[dungeon-D7-1F] Turtle Rock - compass room",
		"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
		"[dungeon-D7-B1] Turtle Rock - big key room",
	];

	/**
	 * Create a new Turtle Rock Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-D7-1F] Turtle Rock - Chain chomp room", 0xEA16, null, $this),
			new Location\Chest("[dungeon-D7-1F] Turtle Rock - compass room", 0xEA22, null, $this),
			new Location\Chest("[dungeon-D7-1F] Turtle Rock - Map room [left chest]", 0xEA1C, null, $this),
			new Location\Chest("[dungeon-D7-1F] Turtle Rock - Map room [right chest]", 0xEA1F, null, $this),
			new Location\BigChest("[dungeon-D7-B1] Turtle Rock - big chest", 0xEA19, null, $this),
			new Location\Chest("[dungeon-D7-B1] Turtle Rock - big key room", 0xEA25, null, $this),
			new Location\Chest("[dungeon-D7-B1] Turtle Rock - Roller switch room", 0xEA34, null, $this),
			new Location\Chest("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", 0xEA31, null, $this),
			new Location\Chest("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", 0xEA2E, null, $this),
			new Location\Chest("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", 0xEA2B, null, $this),
			new Location\Chest("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", 0xEA28, null, $this),
			new Location\Drop("Heart Container - Trinexx", 0x180159, null, $this),

			new Location\Prize\Crystal("Turtle Rock Crystal", [null, 0x120A7, 0x53F24, 0x53F25, 0x18005C, 0x180079, 0xC708], null, $this),
		]);

		$this->prize_location = $this->locations["Turtle Rock Crystal"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D7-1F] Turtle Rock - compass room"]->setItem(Item::get('Compass'));
		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->setItem(Item::get('Map'));
		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D7-B1] Turtle Rock - big chest"]->setItem(Item::get('MirrorShield'));
		$this->locations["[dungeon-D7-B1] Turtle Rock - big key room"]->setItem(Item::get('BigKey'));
		$this->locations["[dungeon-D7-B1] Turtle Rock - Roller switch room"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]"]->setItem(Item::get('FiveRupees'));
		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]"]->setItem(Item::get('OneRupee'));
		$this->locations["Heart Container - Trinexx"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Turtle Rock Crystal"]->setItem(Item::get('Crystal7'));

		return $this;
	}


	/**
	 * Place Keys, Map, and Compass in Region. Turtle Rock has: Big Key, Map, Compass, and 4 keys
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Trinexx";
		});

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), $this->big_key_fill);
		})->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), $this->key_fill_1);
		})->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), $this->key_fill_2);
		})->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->filter(function($location) {
			return in_array($location->getName(), $this->key_fill_3);
		})->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

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
		$this->locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->setRequirements(function($locations, $items) {
			return $locations["[dungeon-D7-1F] Turtle Rock - compass room"]->hasItem(Item::get('Key'))
				|| $items->has('FireRod');
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - compass room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big chest"]->setRequirements(function($locations, $items) {
			return (!($locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->hasItem(Item::get('BigKey'))
					|| $locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->hasItem(Item::get('BigKey')))
				&& ($locations["[dungeon-D7-1F] Turtle Rock - compass room"]->hasItem(Item::get('Key'))
					&& $locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->hasItem(Item::get('Key'))))
				|| $items->has('FireRod');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big key room"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-D7-1F] Turtle Rock - compass room"]->hasItem(Item::get('Key'))
				&& $locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->hasItem(Item::get('Key')))
					|| $items->has('FireRod');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - Roller switch room"]->setRequirements(function($locations, $items) {
			return (!($locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->hasItem(Item::get('BigKey'))
					|| $locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->hasItem(Item::get('BigKey')))
				&& ($locations["[dungeon-D7-1F] Turtle Rock - compass room"]->hasItem(Item::get('Key'))
					&& $locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->hasItem(Item::get('Key'))))
				|| $items->has('FireRod');
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& ((!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					])
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D7-1F] Turtle Rock - compass room",
						"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
					], 2)
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D7-B1] Turtle Rock - big key room",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
						"[dungeon-D7-B1] Turtle Rock - big chest",
					]))
				|| $items->has('FireRod'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& ((!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					])
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D7-1F] Turtle Rock - compass room",
						"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
					], 2)
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D7-B1] Turtle Rock - big key room",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
						"[dungeon-D7-B1] Turtle Rock - big chest",
					]))
				|| $items->has('FireRod'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& ((!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					])
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D7-1F] Turtle Rock - compass room",
						"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
					], 2)
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D7-B1] Turtle Rock - big key room",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
						"[dungeon-D7-B1] Turtle Rock - big chest",
					]))
				|| $items->has('FireRod'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& ((!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					])
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D7-1F] Turtle Rock - compass room",
						"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
					], 2)
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D7-B1] Turtle Rock - big key room",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
						"[dungeon-D7-B1] Turtle Rock - big chest",
					]))
				|| $items->has('FireRod'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["Heart Container - Trinexx"]->setRequirements(function($locations, $items) {
			return  $items->has('FireRod') && $items->has('IceRod') && $items->has('Lamp');
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('FireRod') && $items->has('IceRod') && $items->has('Lamp');
		};

		$this->can_enter = function($locations, $items) {
			return ((($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
				&& (config('game-mode') == 'swordless' || $items->hasSword()))
			&& $items->has('MoonPearl') && $items->has('CaneOfSomaria')
			&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items)
			&& $items->canLiftDarkRocks() && $items->has('Hammer');
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
		$this->key_fill_1 = [
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
			"[dungeon-D7-B1] Turtle Rock - Roller switch room",
		];
		$this->key_fill_2 = [
			"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
			"[dungeon-D7-B1] Turtle Rock - big key room",
		];
		$this->key_fill_3 = [
			"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
			"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
			"[dungeon-D7-1F] Turtle Rock - compass room",
			"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
			"[dungeon-D7-B1] Turtle Rock - big key room",
			"[dungeon-D7-B1] Turtle Rock - Roller switch room",
			"[dungeon-D7-B1] Turtle Rock - big chest",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
		];

		$this->big_key_fill = [
			"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
			"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
			"[dungeon-D7-1F] Turtle Rock - compass room",
			"[dungeon-D7-1F] Turtle Rock - Chain chomp room",
			"[dungeon-D7-B1] Turtle Rock - big key room",
			"[dungeon-D7-B1] Turtle Rock - Roller switch room",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
		];

		$lower = function($locations, $items) {
			return $items->has('MagicMirror') && ($items->has('MoonPearl') || $items->hasABottle());
		};

		$middle = function($locations, $items) {
			return $items->has('MagicMirror') || $items->has('MoonPearl') || $items->hasABottle();
		};

		$upper = function($locations, $items) {
			return (($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
				|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
				|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
			&& $items->has('Hammer') && $items->has('MoonPearl') && $items->has('CaneOfSomaria') && $items->hasSword();
		};

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - compass room"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big chest"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return ($lower($locations, $items) && $items->has('CaneOfSomaria')
					&& (!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					]) || $items->has('FireRod')))
				|| ($middle($locations, $items)
					&& !$locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
							"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
							"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
							"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
							"[dungeon-D7-B1] Turtle Rock - Roller switch room",
						])
						&& ((!$locations["[dungeon-D7-1F] Turtle Rock - compass room"]->hasItem(Item::get('BigKey')) || $items->has('CaneOfSomaria'))
						&& (!$locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
							"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
						]) || ($items->has('CaneOfSomaria') && $items->has('FireRod')))));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big key room"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $middle($locations, $items) || ($lower($locations, $items) && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $middle($locations, $items) || ($lower($locations, $items) && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - Roller switch room"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return ($lower($locations, $items) && $items->has('CaneOfSomaria'))
				|| ($middle($locations, $items)
					&& !$locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
							"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
							"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
							"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
							"[dungeon-D7-B1] Turtle Rock - Roller switch room",
						])
						&& ((!$locations["[dungeon-D7-1F] Turtle Rock - compass room"]->hasItem(Item::get('BigKey')) || $items->has('CaneOfSomaria'))
						&& (!$locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
							"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
						]) || ($items->has('CaneOfSomaria') && $items->has('FireRod')))));
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items)
				|| ($middle($locations, $items) && $items->has('CaneOfSomaria')
					&& !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
					]) && (!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					]) || $items->has('FireRod')));
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items)
				|| ($middle($locations, $items) && $items->has('CaneOfSomaria')
					&& !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
					]) && (!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					]) || $items->has('FireRod')));
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items)
				|| ($middle($locations, $items) && $items->has('CaneOfSomaria')
					&& !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
					]) && (!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					]) || $items->has('FireRod')));
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items)
				|| ($middle($locations, $items) && $items->has('CaneOfSomaria')
					&& !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
					]) && (!$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-1F] Turtle Rock - Map room [left chest]",
						"[dungeon-D7-1F] Turtle Rock - Map room [right chest]",
					]) || $items->has('FireRod')));
		});

		$this->locations["Heart Container - Trinexx"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return ($items->hasUpgradedSword() || $items->has('Hammer'))
				&& $items->has('CaneOfSomaria') && $items->has('FireRod') && $items->has('IceRod')
				&& ($lower($locations, $items)
				|| ($middle($locations, $items) && !$locations->itemInLocations(Item::get('BigKey'), [
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]",
						"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]",
						"[dungeon-D7-B1] Turtle Rock - Roller switch room",
					]))
				);
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('FireRod') && $items->has('IceRod') && $items->has('CaneOfSomaria');
		};

		$this->can_enter = function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items) || $middle($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
