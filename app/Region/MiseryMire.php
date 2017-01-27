<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Misery Mire Region and it's Locations contained within
 */
class MiseryMire extends Region {
	protected $name = 'Misery Mire';

	/**
	 * Create a new Misery Mire Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\BigChest("[dungeon-D6-B1] Misery Mire - big chest", 0xEA67, null, $this),
			new Location\Chest("[dungeon-D6-B1] Misery Mire - big hub room", 0xEA5E, null, $this),
			new Location\Chest("[dungeon-D6-B1] Misery Mire - big key", 0xEA6D, null, $this),
			new Location\Chest("[dungeon-D6-B1] Misery Mire - compass", 0xEA64, null, $this),
			new Location\Chest("[dungeon-D6-B1] Misery Mire - end of bridge", 0xEA61, null, $this),
			new Location\Chest("[dungeon-D6-B1] Misery Mire - map room", 0xEA6A, null, $this),
			new Location\Chest("[dungeon-D6-B1] Misery Mire - spike room", 0xE9DA, null, $this),
			new Location\Drop("Heart Container - Vitreous", 0x180158, null, $this),
		]);
	}

	/**
	 * Place Keys, Map, and Compass in Region. Misery Mire has: Big Key, Map, Compass, 3 Keys.
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Vitreous";
		});

		// this order matters
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

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
		$this->locations["[dungeon-D6-B1] Misery Mire - big chest"]->setRequirements(function($locations, $items) {
			return ($items->canLightTorches() &&
				$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
				], 2))
			|| (!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) && ($locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					"[dungeon-D6-B1] Misery Mire - big chest",
				], 3)
				|| ($items->has('CaneOfSomaria') && $items->has('Lamp') && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					"[dungeon-D6-B1] Misery Mire - big chest",
					"Heart Container - Vitreous",
				], 3))
			));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - big hub room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - big key"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && ((
				$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
				], 2))
			|| (!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) && ($locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					"[dungeon-D6-B1] Misery Mire - big chest",
				], 3)
				|| ($items->has('CaneOfSomaria') && $items->has('Lamp') && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					"[dungeon-D6-B1] Misery Mire - big chest",
					"Heart Container - Vitreous",
				], 3))
			)));
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - compass"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches() && ((
				$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
				], 2))
			|| (!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) && ($locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					"[dungeon-D6-B1] Misery Mire - big chest",
				], 3)
				|| ($items->has('CaneOfSomaria') && $items->has('Lamp') && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					"[dungeon-D6-B1] Misery Mire - big chest",
					"Heart Container - Vitreous",
				], 3))
			)));
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - end of bridge"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - map room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - spike room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Heart Container - Vitreous"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria') && $items->has('Lamp')
				&& (($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
				], 2))
			|| (!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) && $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					"[dungeon-D6-B1] Misery Mire - big chest",
					"Heart Container - Vitreous",
				], 3)));
		})->setFillRules(function($item, $locations, $items) {
			if ($this->world->config('region.bossHaveKey', true)) {
				return $item != Item::get('BigKey');
			}
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('CaneOfSomaria') && $items->has('Lamp');
		};

		$this->can_enter = function($locations, $items) {
			return (($locations["Misery Mire Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
				|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
				|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
			&& $items->hasSword()
			&& $items->has('TitansMitt') && $items->has('MoonPearl') && $items->canFly()
			&& ($items->has('PegasusBoots') || $items->has('Hookshot'));
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
		$this->initSpeedRunner();

		$this->can_enter = function($locations, $items) {
			return (($locations["Misery Mire Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
				|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
				|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
			&& ($items->has('PegasusBoots') || $items->has('Hookshot'))
			&& ($items->has('MoonPearl') || $items->hasABottle());
		};

		$this->can_complete = $this->can_enter;

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Minor Glitched Mode
	 *
	 * @return $this
	 */
	public function initSpeedRunner() {
		$this->initNoMajorGlitches();

		$this->locations["[dungeon-D6-B1] Misery Mire - big chest"]->setRequirements(function($locations, $items) {
			return !$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				]) || $items->canLightTorches();
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - big key"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches();
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - compass"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches();
		});

		$this->locations["Heart Container - Vitreous"]->setRequirements(function($locations, $items) {
			return $items->has('CaneOfSomaria')
				&& (!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				])
					|| $items->canLightTorches());
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('CaneOfSomaria')
				&& (!$locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
				])
					|| $items->canLightTorches());
		};

		$this->can_enter = function($locations, $items) {
			return (($locations["Misery Mire Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
				|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
				|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
			&& ($items->has('TitansMitt') && $items->canFly() && ($items->has('MoonPearl')
				|| ($items->has('Flippers') && $items->has('MagicMirror') && $items->hasABottle() && $items->has('BugCatchingNet'))))
			&& ($items->has('PegasusBoots') || $items->has('Hookshot'));
		};

		return $this;
	}
}
