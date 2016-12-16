<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class MiseryMire extends Region {
	protected $name = 'Misery Mire';

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

	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Vitreous";
		});

		// Big Key, Map, Compass, 3 Keys
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));

		return $this;
	}

	public function initNoMajorGlitches() {
		$this->locations["[dungeon-D6-B1] Misery Mire - big chest"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					])
				|| ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
					]) && $items->canLightTorches());
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - big hub room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - big key"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches();
		});

		$this->locations["[dungeon-D6-B1] Misery Mire - compass"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches();
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
			return ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big hub room",
					"[dungeon-D6-B1] Misery Mire - end of bridge",
					"[dungeon-D6-B1] Misery Mire - map room",
					"[dungeon-D6-B1] Misery Mire - spike room",
					])
				|| ($locations->itemInLocations(Item::get('BigKey'), [
					"[dungeon-D6-B1] Misery Mire - big key",
					"[dungeon-D6-B1] Misery Mire - compass",
					]) && $items->canLightTorches())
			&& $locations->itemInLocations(Item::get('Key'), [
				"[dungeon-D6-B1] Misery Mire - big hub room",
				"[dungeon-D6-B1] Misery Mire - big key",
				"[dungeon-D6-B1] Misery Mire - compass",
				"[dungeon-D6-B1] Misery Mire - end of bridge",
				"[dungeon-D6-B1] Misery Mire - map room",
				"[dungeon-D6-B1] Misery Mire - spike room",
				"[dungeon-D6-B1] Misery Mire - big chest",
			], 3))
			&& $items->has('CaneOfSomaria') && $items->has('Lamp');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('CaneOfSomaria') && $items->has('Lamp');
		};

		$this->can_enter = function($locations, $items) {
			return (($locations["Misery Mire Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
				|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
				|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
			&& $items->has('TitansMitt') && $items->has('MoonPearl') && $items->canFly()
			&& ($items->has('PegasusBoots') || $items->has('Hookshot'));
		};

		return $this;
	}
}
