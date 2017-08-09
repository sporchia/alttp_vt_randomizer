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

	protected $region_items = [
		'BigKey',
		'BigKeyD7',
		'Compass',
		'CompassD7',
		'Key',
		'KeyD7',
		'Map',
		'MapD7',
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
		$this->locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->setItem(Item::get('KeyD7'));
		$this->locations["[dungeon-D7-1F] Turtle Rock - compass room"]->setItem(Item::get('CompassD7'));
		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->setItem(Item::get('MapD7'));
		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->setItem(Item::get('KeyD7'));
		$this->locations["[dungeon-D7-B1] Turtle Rock - big chest"]->setItem(Item::get('MirrorShield'));
		$this->locations["[dungeon-D7-B1] Turtle Rock - big key room"]->setItem(Item::get('BigKeyD7'));
		$this->locations["[dungeon-D7-B1] Turtle Rock - Roller switch room"]->setItem(Item::get('KeyD7'));
		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]"]->setItem(Item::get('KeyD7'));
		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]"]->setItem(Item::get('FiveRupees'));
		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]"]->setItem(Item::get('OneRupee'));
		$this->locations["Heart Container - Trinexx"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Turtle Rock Crystal"]->setItem(Item::get('Crystal7'));

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
			return $items->has('KeyD7');
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Map room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - compass room"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD7') && $items->has('KeyD7', 2);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big key room"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD7', 2);
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - Roller switch room"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD7') && $items->has('KeyD7', 2);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('FireRod') && $items->has('IceRod') && $items->has('Lamp')
				&& $items->has('BigKeyD7') && $items->has('CaneOfSomaria');
		};

		$this->locations["Heart Container - Trinexx"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& ($item instanceof Item\Key || $item instanceof Item\BigKey
						|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
					return false;
				}

				return !in_array($item, [Item::get('KeyD7'), Item::get('BigKeyD7')]);
			});

		$this->can_enter = function($locations, $items) {
			return ((($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
				&& (config('game-mode') == 'swordless' || $items->hasSword()))
			&& $items->has('MoonPearl') && $items->has('CaneOfSomaria')
			&& $items->canLiftDarkRocks() && $items->has('Hammer')
			&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
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
			return ($lower($locations, $items) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7'))
				|| ($middle($locations, $items) && $items->has('BigKeyD7'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - big key room"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $middle($locations, $items) || ($lower($locations, $items) && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $middle($locations, $items) || ($lower($locations, $items) && $items->has('CaneOfSomaria'));
		});

		$this->locations["[dungeon-D7-B1] Turtle Rock - Roller switch room"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return ($lower($locations, $items) && $items->has('CaneOfSomaria'))
				|| ($middle($locations, $items) && $items->has('BigKeyD7'));
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items)
				|| ($middle($locations, $items) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7'));
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items)
				|| ($middle($locations, $items) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7'));
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items)
				|| ($middle($locations, $items) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7'));
		});

		$this->locations["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items)
				|| ($middle($locations, $items) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7'));		});

		$this->locations["Heart Container - Trinexx"]->setRequirements(function($locations, $items) use ($lower, $middle) {
			return $items->has('BigKeyD7')
				&& ($items->hasUpgradedSword() || $items->has('Hammer'))
				&& $items->has('CaneOfSomaria') && $items->has('FireRod') && $items->has('IceRod');
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('KeyD7'), Item::get('BigKeyD7')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('FireRod')
				&& $items->has('IceRod') && $items->has('CaneOfSomaria')
				&& $items->has('BigKeyD7');
		};

		$this->can_enter = function($locations, $items) use ($lower, $middle) {
			return $lower($locations, $items) || $middle($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

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

		$middle = function($locations, $items) {
			return ($items->has('MagicMirror') || ($items->has('MoonPearl') && $items->canSpinSpeed()))
				&& $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items);
		};

		$upper = function($locations, $items) {
			return ((($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
				&& (config('game-mode') == 'swordless' || $items->hasSword()))
			&& $items->has('MoonPearl') && $items->has('CaneOfSomaria')
			&& $items->has('Hammer') && ($items->canLiftDarkRocks() || $items->has('PegasusBoots'))
			&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
		};

		$this->can_enter = function($locations, $items) use ($upper, $middle) {
			return $upper($locations, $items) || $middle($locations, $items);
		};

		return $this;
	}

}
