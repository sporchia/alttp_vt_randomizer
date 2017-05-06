<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Desert Palace Region and it's Locations contained within
 */
class DesertPalace extends Region {
	protected $name = 'Desert Palace';
	public $music_addresses = [
		0x1559B,
		0x1559C,
		0x1559D,
		0x1559E,
	];

	/**
	 * Create a new Desert Palace Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\BigChest("[dungeon-L2-B1] Desert Palace - big chest", 0xE98F, null, $this),
			new Location\Chest("[dungeon-L2-B1] Desert Palace - Map room", 0xE9B6, null, $this),
			new Location\Dash("[dungeon-L2-B1] Desert Palace - Small key room", 0x180160, null, $this),
			new Location\Chest("[dungeon-L2-B1] Desert Palace - Big key room", 0xE9C2, null, $this),
			new Location\Chest("[dungeon-L2-B1] Desert Palace - compass room", 0xE9CB, null, $this),
			new Location\Drop("Heart Container - Lanmolas", 0x180151, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-L2-B1] Desert Palace - big chest"]->setItem(Item::get('PowerGlove'));
		$this->locations["[dungeon-L2-B1] Desert Palace - Map room"]->setItem(Item::get('Map'));
		$this->locations["[dungeon-L2-B1] Desert Palace - Small key room"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-L2-B1] Desert Palace - Big key room"]->setItem(Item::get('BigKey'));
		$this->locations["[dungeon-L2-B1] Desert Palace - compass room"]->setItem(Item::get('Compass'));
		$this->locations["Heart Container - Lanmolas"]->setItem(Item::get('BossHeartContainer'));

		return $this;
	}

	/**
	 * Place Keys, Map, and Compass in Region. Desert Palace has: Big Key, Map, Compass, Key
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Lanmolas";
		});

		if ($this->world->config('region.bonkItems', true)) {
			while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		} else {
			$locations["[dungeon-L2-B1] Desert Palace - Small key room"]->setItem(Item::get('Key'));
		}

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

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
		$this->locations["[dungeon-L2-B1] Desert Palace - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| !($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
						&& $locations->itemInLocations(Item::get('BigKey'), [
								"[dungeon-L2-B1] Desert Palace - Big key room",
								"[dungeon-L2-B1] Desert Palace - compass room",
							])));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - Map room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - Big key room"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| !($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
				|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					&& $locations["[dungeon-L2-B1] Desert Palace - big chest"]->hasItem(Item::get('Key'))));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key')
				&& !($locations["[dungeon-L2-B1] Desert Palace - big chest"]->hasItem(Item::get('Key')) && $item == Item::get('BigKey'));
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - compass room"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| !($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
				|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					&& $locations["[dungeon-L2-B1] Desert Palace - big chest"]->hasItem(Item::get('Key'))));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key')
				&& !($locations["[dungeon-L2-B1] Desert Palace - big chest"]->hasItem(Item::get('Key')) && $item == Item::get('BigKey'));
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - Small key room"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->can_complete = function($locations, $items) {
			if (config('game-mode') == 'open' && !($items->hasSword() || $items->has('Hammer')
					|| $items->canShootArrows() || $items->has('FireRod') || $items->has('IceRod')
					|| $items->has('CaneOfByrna') || $items->has('CaneOfSomaria'))) {
				return false;
			}

			return $this->canEnter($locations, $items)
				&& $items->canLiftRocks() && $items->canLightTorches()
				&& ($items->has('PegasusBoots')
				|| !($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					|| $locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))));
		};

		$this->locations["Heart Container - Lanmolas"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
			});

		$this->can_enter = function($locations, $items) {
			return $items->has('BookOfMudora')
				|| ($items->has('MagicMirror') && $items->canLiftDarkRocks() && $items->canFly());
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
		$this->initNoMajorGlitches();

		$this->can_complete = function($locations, $items) {
			if (config('game-mode') == 'open' && !($items->hasSword() || $items->has('Hammer')
					|| $items->canShootArrows() || $items->has('FireRod') || $items->has('IceRod')
					|| $items->has('CaneOfByrna') || $items->has('CaneOfSomaria'))) {
				return false;
			}

			return $this->canEnter($locations, $items)
				&& $items->canLightTorches()
				&& ($items->has('PegasusBoots')
				|| !($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					|| $locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))));
		};

		$this->locations["Heart Container - Lanmolas"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
			});


		$this->can_enter = function($locations, $items) {
			return true;
		};

		return $this;
	}
}
