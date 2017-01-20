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
			while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));
			while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));
		}

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * Notes: Key placement
	 * * Big Key can be anywhere in P1, except the big chest
	 * * Small Key can be in Big chest, on Torch, or in Map room
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[dungeon-L2-B1] Desert Palace - big chest"]->setRequirements(function($locations, $items) {
			return ($items->has('PegasusBoots')
					&& ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
						&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-L2-B1] Desert Palace - Big key room",
							"[dungeon-L2-B1] Desert Palace - compass room",
						]))))
				|| $locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('BigKey'))
				|| ($locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('Key'))
					&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-L2-B1] Desert Palace - Big key room",
							"[dungeon-L2-B1] Desert Palace - compass room",
						]));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - Map room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - Big key room"]->setRequirements(function($locations, $items) {
			return ($items->has('PegasusBoots')
					&& ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
					|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
						&& $locations["[dungeon-L2-B1] Desert Palace - big chest"]->hasItem(Item::get('Key')))))
				|| $locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('Key'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key')
				&& !($locations["[dungeon-L2-B1] Desert Palace - big chest"]->hasItem(Item::get('Key')) && $item == Item::get('BigKey'));
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - compass room"]->setRequirements(function($locations, $items) {
			return ($items->has('PegasusBoots')
					&& ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
					|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
						&& $locations["[dungeon-L2-B1] Desert Palace - big chest"]->hasItem(Item::get('Key')))))
				|| $locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('Key'));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key')
				&& !($locations["[dungeon-L2-B1] Desert Palace - big chest"]->hasItem(Item::get('Key')) && $item == Item::get('BigKey'));
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - Small key room"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Heart Container - Lanmolas"]->setRequirements(function($locations, $items) {
			return (($items->has('PegasusBoots')
					&& ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
						&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-L2-B1] Desert Palace - Big key room",
							"[dungeon-L2-B1] Desert Palace - compass room",
						]))))
				|| $locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('BigKey'))
				|| ($locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('Key'))
					&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-L2-B1] Desert Palace - Big key room",
							"[dungeon-L2-B1] Desert Palace - compass room",
						])))
				&& $items->canLiftRocks() && $items->canLightTorches();
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& (($items->has('PegasusBoots')
					&& ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
						&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-L2-B1] Desert Palace - Big key room",
							"[dungeon-L2-B1] Desert Palace - compass room",
						]))))
				|| $locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('BigKey'))
				|| ($locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('Key'))
					&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-L2-B1] Desert Palace - Big key room",
							"[dungeon-L2-B1] Desert Palace - compass room",
						])))
				&& $items->canLiftRocks() && $items->canLightTorches();
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('BookOfMudora')
				|| ($items->has('MagicMirror') && $items->has('TitansMitt') && $items->canFly());
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

		$this->locations["Heart Container - Lanmolas"]->setRequirements(function($locations, $items) {
			return (($items->has('PegasusBoots')
					&& ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
						&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-L2-B1] Desert Palace - Big key room",
							"[dungeon-L2-B1] Desert Palace - compass room",
						]))))
				|| $locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('BigKey')))
				&& $items->canLightTorches();
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& (($items->has('PegasusBoots')
					&& ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('BigKey'))
					|| ($locations["[dungeon-L2-B1] Desert Palace - Small key room"]->hasItem(Item::get('Key'))
						&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-L2-B1] Desert Palace - Big key room",
							"[dungeon-L2-B1] Desert Palace - compass room",
						]))))
				|| $locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get('BigKey')))
				&& $items->canLightTorches();
		};

		$this->can_enter = function($locations, $items) {
			return true;
		};

		return $this;
	}
}
