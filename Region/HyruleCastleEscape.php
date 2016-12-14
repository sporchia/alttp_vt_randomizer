<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class HyruleCastleEscape extends Region {
	protected $name = 'Hyrule Castle';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("[dungeon-C-1F] Sanctuary", 0xEA79, $this),
			new Location("[dungeon-C-B1] Escape - final basement room [left chest]", 0xEB5D, $this),
			new Location("[dungeon-C-B1] Escape - final basement room [middle chest]", 0xEB60, $this),
			new Location("[dungeon-C-B1] Escape - final basement room [right chest]", 0xEB63, $this),
			new Location("[dungeon-C-B1] Escape - first B1 room", 0xE96E, $this),
			new Location("[dungeon-C-B1] Hyrule Castle - boomerang room", 0xE974, $this),
			new Location("[dungeon-C-B1] Hyrule Castle - map room", 0xEB0C, $this),
			new Location("[dungeon-C-B3] Hyrule Castle - next to Zelda", 0xEB09, $this),
		]);
	}

	public function fillBaseItems($my_items) {
		// 1 Key, Map
		while(!$this->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

		while(!$this->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		return $this;
	}

	public function initNoMajorGlitches() {
		$this->locations["[dungeon-C-1F] Sanctuary"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-C-B1] Escape - first B1 room",
					"[dungeon-C-B1] Hyrule Castle - boomerang room",
					"[dungeon-C-B1] Hyrule Castle - map room",
					"[dungeon-C-B3] Hyrule Castle - next to Zelda",
				]);
		});

		$this->locations["[dungeon-C-B1] Escape - final basement room [left chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-C-B1] Escape - first B1 room",
					"[dungeon-C-B1] Hyrule Castle - boomerang room",
					"[dungeon-C-B1] Hyrule Castle - map room",
					"[dungeon-C-B3] Hyrule Castle - next to Zelda",
				]) && $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Escape - final basement room [middle chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-C-B1] Escape - first B1 room",
					"[dungeon-C-B1] Hyrule Castle - boomerang room",
					"[dungeon-C-B1] Hyrule Castle - map room",
					"[dungeon-C-B3] Hyrule Castle - next to Zelda",
				]) && $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Escape - final basement room [right chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-C-B1] Escape - first B1 room",
					"[dungeon-C-B1] Hyrule Castle - boomerang room",
					"[dungeon-C-B1] Hyrule Castle - map room",
					"[dungeon-C-B3] Hyrule Castle - next to Zelda",
				]) && $items->canLiftRocks();
		});

		$this->locations["[dungeon-C-B1] Escape - first B1 room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-C-B1] Hyrule Castle - boomerang room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-C-B1] Hyrule Castle - map room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-C-B3] Hyrule Castle - next to Zelda"]->setRequirements(function($locations, $items) {
			return true;
		});

		return $this;
	}
}
