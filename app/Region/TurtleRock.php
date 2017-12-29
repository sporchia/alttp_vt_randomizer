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
			new Location\Chest("Turtle Rock - Chain Chomps", 0xEA16, null, $this),
			new Location\Chest("Turtle Rock - Compass Chest", 0xEA22, null, $this),
			new Location\Chest("Turtle Rock - Roller Room - Left", 0xEA1C, null, $this),
			new Location\Chest("Turtle Rock - Roller Room - Right", 0xEA1F, null, $this),
			new Location\BigChest("Turtle Rock - Big Chest", 0xEA19, null, $this),
			new Location\Chest("Turtle Rock - Big Key Chest", 0xEA25, null, $this),
			new Location\Chest("Turtle Rock - Crystaroller Room", 0xEA34, null, $this),
			new Location\Chest("Turtle Rock - Eye Bridge - Bottom Left", 0xEA31, null, $this),
			new Location\Chest("Turtle Rock - Eye Bridge - Bottom Right", 0xEA2E, null, $this),
			new Location\Chest("Turtle Rock - Eye Bridge - Top Left", 0xEA2B, null, $this),
			new Location\Chest("Turtle Rock - Eye Bridge - Top Right", 0xEA28, null, $this),
			new Location\Drop("Turtle Rock - Trinexx", 0x180159, null, $this),

			new Location\Prize\Crystal("Turtle Rock - Prize", [null, 0x120A7, 0x53F24, 0x53F25, 0x18005C, 0x180079, 0xC708], null, $this),
		]);

		$this->prize_location = $this->locations["Turtle Rock - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Turtle Rock - Chain Chomps"]->setItem(Item::get('KeyD7'));
		$this->locations["Turtle Rock - Compass Chest"]->setItem(Item::get('CompassD7'));
		$this->locations["Turtle Rock - Roller Room - Left"]->setItem(Item::get('MapD7'));
		$this->locations["Turtle Rock - Roller Room - Right"]->setItem(Item::get('KeyD7'));
		$this->locations["Turtle Rock - Big Chest"]->setItem(Item::get('MirrorShield'));
		$this->locations["Turtle Rock - Big Key Chest"]->setItem(Item::get('BigKeyD7'));
		$this->locations["Turtle Rock - Crystaroller Room"]->setItem(Item::get('KeyD7'));
		$this->locations["Turtle Rock - Eye Bridge - Bottom Left"]->setItem(Item::get('KeyD7'));
		$this->locations["Turtle Rock - Eye Bridge - Bottom Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Turtle Rock - Eye Bridge - Top Left"]->setItem(Item::get('FiveRupees'));
		$this->locations["Turtle Rock - Eye Bridge - Top Right"]->setItem(Item::get('OneRupee'));
		$this->locations["Turtle Rock - Trinexx"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Turtle Rock - Prize"]->setItem(Item::get('Crystal7'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Turtle Rock - Chain Chomps"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD7');
		});

		$this->locations["Turtle Rock - Roller Room - Left"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["Turtle Rock - Roller Room - Right"]->setRequirements(function($locations, $items) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria');
		});

		$this->locations["Turtle Rock - Compass Chest"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria');
		});

		$this->locations["Turtle Rock - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD7') && $items->has('KeyD7', 2);
		});

		$this->locations["Turtle Rock - Big Key Chest"]->setRequirements(function($locations, $items) {
			if ($this->world->config('region.wildKeys', false)) {
				return $items->has('KeyD7', 4);
			}
			return $items->has('KeyD7', 2);
		});

		$this->locations["Turtle Rock - Crystaroller Room"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD7') && $items->has('KeyD7', 2);
		});

		$this->locations["Turtle Rock - Eye Bridge - Bottom Left"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Bottom Right"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Top Left"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Top Right"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('KeyD7', 4)
				&& $items->has('FireRod') && $items->has('IceRod') && $items->has('Lamp')
				&& $items->has('BigKeyD7') && $items->has('CaneOfSomaria')
				&& ($items->has('Hammer') || $items->hasUpgradedSword());
		};

		$this->locations["Turtle Rock - Trinexx"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& ($item instanceof Item\Key || $item instanceof Item\BigKey
						|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
					return false;
				}

				return true;
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
		$this->initOverworldGlitches();

		// @TODO: entry functions don't account for 2x YBA
		$lower = function($locations, $items) {
			return $items->has('MagicMirror') && ($items->has('MoonPearl')
					|| ($items->hasABottle() && $items->has('PegasusBoots')))
				&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items);
		};

		$middle = function($locations, $items) {
			return ($items->has('MagicMirror') || ($items->glitchedLinkInDarkWorld() && $items->canSpinSpeed()))
				&& ($items->has('PegasusBoots') || $items->has('CaneOfSomaria') || $items->has('Hookshot'))
				&& $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items);
		};

		$upper = function($locations, $items) {
			return ((($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
					|| ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
				&& (config('game-mode') == 'swordless' || $items->hasSword()))
			&& ($items->has('MoonPearl') || ($items->hasABottle() && $items->has('PegasusBoots')))
			&& $items->has('CaneOfSomaria') && $items->has('Hammer')
			&& ($items->canLiftDarkRocks() || $items->has('PegasusBoots'))
			&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
		};

		$this->locations["Turtle Rock - Chain Chomps"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return ($upper($locations, $items) && $items->has('KeyD7'))
				|| $middle($locations, $items)
				|| ($lower($locations, $items) && $items->has('Lamp') && $items->has('CaneOfSomaria'));
		});

		$this->locations["Turtle Rock - Roller Room - Left"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& ($upper($locations, $items)
					|| ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Right",
								"Turtle Rock - Compass Chest",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4)))
				|| ($lower($locations, $items) && $items->has('Lamp') && $items->has('KeyD7', 4)));
		});

		$this->locations["Turtle Rock - Roller Room - Right"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& ($upper($locations, $items)
					|| ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Left",
								"Turtle Rock - Compass Chest",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4)))
				|| ($lower($locations, $items) && $items->has('Lamp') && $items->has('KeyD7', 4)));
		});

		$this->locations["Turtle Rock - Compass Chest"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return $items->has('CaneOfSomaria')
				&& ($upper($locations, $items)
					|| ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Left",
								"Turtle Rock - Roller Room - Right",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4)))
					|| ($lower($locations, $items) && $items->has('Lamp') && $items->has('KeyD7', 4)));
		});

		$this->locations["Turtle Rock - Big Chest"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return $items->has('BigKeyD7')
				&& (($upper($locations, $items) && $items->has('KeyD7', 2))
					|| $middle($locations, $items)
					|| ($lower($locations, $items) && $items->has('Lamp') && $items->has('CaneOfSomaria')));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["Turtle Rock - Big Key Chest"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return (($upper($locations, $items) || $middle($locations, $items)) && $items->has('KeyD7', 2))
				|| ($lower($locations, $items) && $items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('KeyD7', 4));
		});

		$this->locations["Turtle Rock - Crystaroller Room"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return $items->has('BigKeyD7') && (($upper($locations, $items) && $items->has('KeyD7', 2))
				|| $middle($locations, $items)
				|| ($lower($locations, $items) && $items->has('Lamp') && $items->has('CaneOfSomaria')));
		});

		$this->locations["Turtle Rock - Eye Bridge - Bottom Left"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return ($lower($locations, $items)
				|| (($upper($locations, $items) || $middle($locations, $items)) &&
					$items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Bottom Right"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return ($lower($locations, $items)
				|| (($upper($locations, $items) || $middle($locations, $items)) &&
					$items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Top Left"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return ($lower($locations, $items)
				|| (($upper($locations, $items) || $middle($locations, $items)) &&
					$items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->locations["Turtle Rock - Eye Bridge - Top Right"]->setRequirements(function($locations, $items) use ($upper, $middle, $lower) {
			return ($lower($locations, $items)
				|| (($upper($locations, $items) || $middle($locations, $items)) &&
					$items->has('Lamp') && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
				&& ($items->has('Cape') || $items->has('CaneOfByrna') || $items->canBlockLasers());
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('FireRod') && $items->has('IceRod')
				&& $items->has('BigKeyD7') && $items->has('CaneOfSomaria')
				&& ($items->has('Hammer') || $items->hasUpgradedSword())
				&& $items->has('KeyD7', 4);
		};

		$this->locations["Turtle Rock - Trinexx"]->setRequirements($this->can_complete);

		$this->can_enter = function($locations, $items) use ($lower, $middle, $upper) {
			return $lower($locations, $items)
				|| $middle($locations, $items)
				|| $upper($locations, $items);
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

		$middle = function($locations, $items) {
			return ($items->has('MagicMirror') || ($items->has('MoonPearl') && $items->canSpinSpeed()))
				&& ($items->has('PegasusBoots') || $items->has('CaneOfSomaria') || $items->has('Hookshot'))
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

		$this->locations["Turtle Rock - Chain Chomps"]->setRequirements(function($locations, $items) use ($upper, $middle) {
			return ($upper($locations, $items) && $items->has('KeyD7'))
				|| $middle($locations, $items);
		});

		$this->locations["Turtle Rock - Roller Room - Left"]->setRequirements(function($locations, $items) use ($upper, $middle) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& ($upper($locations, $items)
					|| ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Right",
								"Turtle Rock - Compass Chest",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4))));
		});

		$this->locations["Turtle Rock - Roller Room - Right"]->setRequirements(function($locations, $items) use ($upper, $middle) {
			return $items->has('FireRod') && $items->has('CaneOfSomaria')
				&& ($upper($locations, $items)
					|| ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Left",
								"Turtle Rock - Compass Chest",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4))));
		});

		$this->locations["Turtle Rock - Compass Chest"]->setRequirements(function($locations, $items) use ($upper, $middle) {
			return $items->has('CaneOfSomaria')
				&& ($upper($locations, $items)
					|| ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7'), [
								"Turtle Rock - Roller Room - Left",
								"Turtle Rock - Roller Room - Right",
							]) && $items->has('KeyD7', 2))
						|| $items->has('KeyD7', 4))));
		});

		$this->locations["Turtle Rock - Big Chest"]->setRequirements(function($locations, $items) use ($upper, $middle) {
			return $items->has('BigKeyD7') && (($upper($locations, $items) && $items->has('KeyD7', 2))
				|| $middle($locations, $items));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->locations["Turtle Rock - Crystaroller Room"]->setRequirements(function($locations, $items) use ($upper, $middle) {
			return $items->has('BigKeyD7') && (($upper($locations, $items) && $items->has('KeyD7', 2))
				|| $middle($locations, $items));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKeyD7');
		});

		$this->can_enter = function($locations, $items) use ($upper, $middle) {
			return $upper($locations, $items) || $middle($locations, $items);
		};

		return $this;
	}

}
