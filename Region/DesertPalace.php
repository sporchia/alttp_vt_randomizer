<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class DesertPalace extends Region {
	protected $name = 'Desert Palace';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("[dungeon-L2-B1] Desert Palace - big chest", 0xE98F, $this),
			new Location("[dungeon-L2-B1] Desert Palace - Map room", 0xE9B6, $this),
			new Location("[dungeon-L2-B1] Desert Palace - Big key room", 0xE9C2, $this),
			new Location("[dungeon-L2-B1] Desert Palace - compass room", 0xE9CB, $this),
			new Location("Heart Container - Lanmolas", 0x180151, $this),
		]);
	}

	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Lanmolas";
		});

		// Big Key, Map, Compass
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("BigKey"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Map"), $my_items));

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Compass"), $my_items));

		return $this;
	}

	public function initNoMajorGlitches() {
		$this->locations["[dungeon-L2-B1] Desert Palace - big chest"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get("BigKey"))
				|| $locations["[dungeon-L2-B1] Desert Palace - Big key room"]->hasItem(Item::get("BigKey"))
				|| $locations["[dungeon-L2-B1] Desert Palace - compass room"]->hasItem(Item::get("BigKey")));
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - Map room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - Big key room"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["[dungeon-L2-B1] Desert Palace - compass room"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Heart Container - Lanmolas"]->setRequirements(function($locations, $items) {
			return ($locations["[dungeon-L2-B1] Desert Palace - Map room"]->hasItem(Item::get("BigKey"))
				|| ($locations["[dungeon-L2-B1] Desert Palace - Big key room"]->hasItem(Item::get("BigKey")) && $items->has('PegasusBoots'))
				|| ($locations["[dungeon-L2-B1] Desert Palace - compass room"]->hasItem(Item::get("BigKey")) && $items->has('PegasusBoots')))
				&& $items->canLiftRocks() && $items->canLightTorches();
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->canLiftRocks() && $items->canLightTorches();
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('BookOfMudora')
				|| ($items->has('MagicMirror') && $items->has('TitansMitt') && $items->canFly());
		};

		return $this;
	}
}
