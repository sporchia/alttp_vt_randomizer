<?php namespace ALttP\Region;

use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\Item;
use ALttP\World;

/**
 * Palace of Darkness Region and it's Locations contained within
 */
class PalaceOfDarkness extends Region {
	protected $name = 'Dark Palace';

	/**
	 * Create a new Palace of Darkness Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("[dungeon-D1-1F] Dark Palace - big key room", 0xEA37, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - jump room [right chest]", 0xEA3A, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - jump room [left chest]", 0xEA3D, null, $this),
			new Location\BigChest("[dungeon-D1-1F] Dark Palace - big chest", 0xEA40, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - compass room", 0xEA43, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - spike statue room", 0xEA46, null, $this),
			new Location\Chest("[dungeon-D1-B1] Dark Palace - turtle stalfos room", 0xEA49, null, $this),
			new Location\Chest("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", 0xEA4C, null, $this),
			new Location\Chest("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", 0xEA4F, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - statue push room", 0xEA52, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - maze room [top chest]", 0xEA55, null, $this),
			new Location\Chest("[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", 0xEA58, null, $this),
			new Location\Chest("[dungeon-D1-B1] Dark Palace - shooter room", 0xEA5B, null, $this),
			new Location\Drop("Heart Container - Helmasaur King", 0x180153, null, $this),
		]);
	}

	/**
	 * Place Keys, Map, and Compass in Region. Palace of Darkness has: Big Key, Map, Compass, 6 Keys
	 *
	 * @param ItemCollection $my_items full list of items for placement
	 *
	 * @return $this
	 */
	public function fillBaseItems($my_items) {
		$locations = $this->locations->filter(function($location) {
			return $this->boss_location_in_base || $location->getName() != "Heart Container - Helmasaur King";
		});

		$keyable_locations = [
			"[dungeon-D1-1F] Dark Palace - big key room",
			"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
			"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
			"[dungeon-D1-1F] Dark Palace - compass room",
			"[dungeon-D1-1F] Dark Palace - spike statue room",
			"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]",
			"[dungeon-D1-1F] Dark Palace - statue push room",
			"[dungeon-D1-B1] Dark Palace - shooter room",
		];

		// @TODO: this feels wrong, this means that the randomizer will never generate the base game -_-
		$this->locations["[dungeon-D1-1F] Dark Palace - big key room"]->fill(Item::get("Key"), $my_items);
		while(!$locations->getEmptyLocations()->filter(function($location) use ($keyable_locations) {
			return in_array($location->getName(), $keyable_locations);
		})->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->filter(function($location) use ($keyable_locations) {
			return in_array($location->getName(), $keyable_locations);
		})->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->filter(function($location) use ($keyable_locations) {
			return in_array($location->getName(), $keyable_locations);
		})->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->filter(function($location) use ($keyable_locations) {
			return in_array($location->getName(), $keyable_locations);
		})->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->filter(function($location) use ($keyable_locations) {
			return in_array($location->getName(), $keyable_locations);
		})->random()->fill(Item::get("Key"), $my_items));

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
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [left chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
				|| ($items->canShootArrows() && $items->has('Hammer'))
				|| ($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]"])
						&& $items->canShootArrows());
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - big chest"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& (($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"]))
				|| ($items->canShootArrows()
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]", "[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"], 3)));
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - compass room"]->setRequirements(function($locations, $items) {
			return ($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
				&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"]))
			|| ($items->canShootArrows()
				&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]", "[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"], 3));
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - spike statue room"]->setRequirements(function($locations, $items) {
			return ($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
				&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"]))
			|| ($items->canShootArrows()
				&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]", "[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"], 3));
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - turtle stalfos room"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
				|| ($items->canShootArrows() && $items->has('Hammer'))
				|| ($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]"])
						&& $items->canShootArrows());
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& (($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"]))
				|| ($items->canShootArrows()
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]", "[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"], 3)));
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& (($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"]))
				|| ($items->canShootArrows()
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]", "[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"], 3)));
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - statue push room"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [top chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& (($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"]))
				|| ($items->canShootArrows()
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]", "[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"], 3)));
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp')
				&& (($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"]))
				|| ($items->canShootArrows()
					&& $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]", "[dungeon-D1-1F] Dark Palace - jump room [left chest]", "[dungeon-D1-B1] Dark Palace - turtle stalfos room"], 3)));
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - shooter room"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Heart Container - Helmasaur King"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('Lamp') && $items->canShootArrows();
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('Hammer') && $items->has('Lamp') && $items->canShootArrows();
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('North East Dark World')->canEnter($locations, $items);
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
		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [top chest]"]->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key');
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]"]->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key');
		});

		$this->locations["Heart Container - Helmasaur King"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canShootArrows();
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $items->has('Hammer') && $items->canShootArrows();
		};

		return $this;
	}
}
