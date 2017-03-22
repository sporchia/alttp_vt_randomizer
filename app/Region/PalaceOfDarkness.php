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
	public $music_addresses = [
		0x155B8,
	];

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
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[dungeon-D1-1F] Dark Palace - big key room"]->setItem(Item::get('BigKey'));
		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [right chest]"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [left chest]"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D1-1F] Dark Palace - big chest"]->setItem(Item::get('Hammer'));
		$this->locations["[dungeon-D1-1F] Dark Palace - compass room"]->setItem(Item::get('Compass'));
		$this->locations["[dungeon-D1-1F] Dark Palace - spike statue room"]->setItem(Item::get('FiveRupees'));
		$this->locations["[dungeon-D1-B1] Dark Palace - turtle stalfos room"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]"]->setItem(Item::get('Arrow'));
		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D1-1F] Dark Palace - statue push room"]->setItem(Item::get('Map'));
		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [top chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]"]->setItem(Item::get('Key'));
		$this->locations["[dungeon-D1-B1] Dark Palace - shooter room"]->setItem(Item::get('Key'));
		$this->locations["Heart Container - Helmasaur King"]->setItem(Item::get('BossHeartContainer'));

		return $this;
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

		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));
		while(!$locations->getEmptyLocations()->random()->fill(Item::get("Key"), $my_items));

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
		$four_accessable_keys_before_bridge = function($locations, $items) {
			return
				($locations["[dungeon-D1-B1] Dark Palace - shooter room"]->hasItem(Item::get('Key'))
					&& (
					$locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
						"[dungeon-D1-1F] Dark Palace - big key room",
					], 3)
					||
					($items->canShootArrows()
						&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
					]))
					||
					($items->canShootArrows() && $items->has('Hammer') && $items->has('Lamp')
						&& $locations["Heart Container - Helmasaur King"]->hasItem(Item::get('Key'))
						&& $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-D1-1F] Dark Palace - statue push room",
							"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
							"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
							"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
							"[dungeon-D1-B1] Dark Palace - shooter room",
							]))
				))
			|| ($items->canShootArrows()
				&& ($locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D1-1F] Dark Palace - statue push room",
					"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
					"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
					"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
					"[dungeon-D1-1F] Dark Palace - big key room",
				], 4)
				||
				($items->has('Hammer') && $items->has('Lamp') && $locations["Heart Container - Helmasaur King"]->hasItem(Item::get('Key'))
					&& $locations->itemInLocations(Item::get('Key'), [
					"[dungeon-D1-1F] Dark Palace - statue push room",
					"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
					"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
					"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
					"[dungeon-D1-1F] Dark Palace - big key room",
				], 3) && $locations->itemInLocations(Item::get('BigKey'), [
							"[dungeon-D1-1F] Dark Palace - statue push room",
							"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
							"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
							"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
							"[dungeon-D1-B1] Dark Palace - shooter room",
							])
					)
				));
		};

		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - big key room"]->setRequirements($four_accessable_keys_before_bridge)
		->setFillRules(function($item, $locations, $items) {
			return ($locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
						"[dungeon-D1-B1] Dark Palace - shooter room",
						"[dungeon-D1-1F] Dark Palace - big key room",
						"Heart Container - Helmasaur King",
					], 4) || $item == Item::get('Key'))
				&& !($item == Item::get('BigKey') && $locations["Heart Container - Helmasaur King"]->hasItem(Item::get('Key')));
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [left chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
				|| ($items->canShootArrows() && $items->has('Hammer'))
				|| ($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]"])
						&& $items->canShootArrows());
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - big chest"]->setRequirements(function($locations, $items) use ($four_accessable_keys_before_bridge) {
			return $items->has('Lamp') && $four_accessable_keys_before_bridge($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - compass room"]->setRequirements($four_accessable_keys_before_bridge)
		->setFillRules(function($item, $locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
						"[dungeon-D1-B1] Dark Palace - shooter room",
						"[dungeon-D1-1F] Dark Palace - big key room",
						"Heart Container - Helmasaur King",
					], 4)
				&& !($item == Item::get('BigKey') && $locations["Heart Container - Helmasaur King"]->hasItem(Item::get('Key')));
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - spike statue room"]->setRequirements(function($locations, $items) use ($four_accessable_keys_before_bridge) {
			return $four_accessable_keys_before_bridge($locations, $items)
				&& (!$locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]",
						"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]",
					], 2) || $items->has('Lamp'));
		})->setFillRules(function($item, $locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
						"[dungeon-D1-B1] Dark Palace - shooter room",
						"[dungeon-D1-1F] Dark Palace - big key room",
						"Heart Container - Helmasaur King",
					], 4)
				&& !($item == Item::get('BigKey') && $locations["Heart Container - Helmasaur King"]->hasItem(Item::get('Key')));
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - turtle stalfos room"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
				|| ($items->canShootArrows() && $items->has('Hammer'))
				|| ($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]"])
						&& $items->canShootArrows());
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]"]->setRequirements(function($locations, $items) use ($four_accessable_keys_before_bridge) {
			return $items->has('Lamp') && $four_accessable_keys_before_bridge($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
						"[dungeon-D1-B1] Dark Palace - shooter room",
						"[dungeon-D1-1F] Dark Palace - big key room",
						"Heart Container - Helmasaur King",
					], 4)
				&& !($item == Item::get('BigKey') && $locations["Heart Container - Helmasaur King"]->hasItem(Item::get('Key')));
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]"]->setRequirements(function($locations, $items) use ($four_accessable_keys_before_bridge) {
			return $items->has('Lamp') && $four_accessable_keys_before_bridge($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
						"[dungeon-D1-B1] Dark Palace - shooter room",
						"[dungeon-D1-1F] Dark Palace - big key room",
						"Heart Container - Helmasaur King",
					], 4)
				&& !($item == Item::get('BigKey') && $locations["Heart Container - Helmasaur King"]->hasItem(Item::get('Key')));
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - statue push room"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [top chest]"]->setRequirements(function($locations, $items) use ($four_accessable_keys_before_bridge) {
			return $items->has('Lamp') && $four_accessable_keys_before_bridge($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key')
				|| ($locations->itemInLocations(Item::get('Hammer'), ["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", "[dungeon-D1-1F] Dark Palace - big chest"])
					&& !$locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", "[dungeon-D1-1F] Dark Palace - big chest"]));
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]"]->setRequirements(function($locations, $items) use ($four_accessable_keys_before_bridge) {
			return $items->has('Lamp') && $four_accessable_keys_before_bridge($locations, $items);
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('Key')
				|| ($locations->itemInLocations(Item::get('Hammer'), ["[dungeon-D1-1F] Dark Palace - maze room [top chest]", "[dungeon-D1-1F] Dark Palace - big chest"])
					&& !$locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - maze room [top chest]", "[dungeon-D1-1F] Dark Palace - big chest"]));
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
		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - statue push room"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["Heart Container - Helmasaur King"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canShootArrows();
		})->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - big chest"]->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->can_complete = function($locations, $items) {
			return $items->has('Hammer') && $items->canShootArrows();
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Minor Glitched Mode
	 *
	 * @return $this
	 */
	public function initSpeedRunner() {
		$access_post_bridge = function($locations, $items) {
			return ($locations["[dungeon-D1-B1] Dark Palace - shooter room"]->hasItem(Item::get('Key'))
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
					]))
				|| ($items->canShootArrows()
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
					])
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
					], 2))
				|| ($items->canShootArrows() && $items->has('Hammer')
					&& $locations->itemInLocations(Item::get('Key'), [
						"[dungeon-D1-1F] Dark Palace - statue push room",
						"[dungeon-D1-1F] Dark Palace - jump room [right chest]",
						"[dungeon-D1-1F] Dark Palace - jump room [left chest]",
						"[dungeon-D1-B1] Dark Palace - turtle stalfos room",
					], 2));
		};

		$this->locations["[dungeon-D1-1F] Dark Palace - statue push room"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [right chest]"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows();
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - compass room"]->setRequirements($access_post_bridge);
		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]"]->setRequirements($access_post_bridge);
		$this->locations["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]"]->setRequirements($access_post_bridge);

		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]"]->setRequirements($access_post_bridge);
		$this->locations["[dungeon-D1-1F] Dark Palace - maze room [top chest]"]->setRequirements($access_post_bridge);
		$this->locations["[dungeon-D1-1F] Dark Palace - big chest"]->setRequirements($access_post_bridge)->setFillRules(function($item, $locations, $items) {
			return $item != Item::get('BigKey');
		});

		$this->locations["[dungeon-D1-1F] Dark Palace - big key room"]->setRequirements($access_post_bridge);
		$this->locations["[dungeon-D1-1F] Dark Palace - spike statue room"]->setRequirements($access_post_bridge);

		$this->locations["[dungeon-D1-1F] Dark Palace - jump room [left chest]"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
				|| ($items->canShootArrows() && $items->has('Hammer'))
				|| ($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]"])
						&& $items->canShootArrows());
		});

		$this->locations["[dungeon-D1-B1] Dark Palace - turtle stalfos room"]->setRequirements(function($locations, $items) {
			return $locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-B1] Dark Palace - shooter room"])
				|| ($items->canShootArrows() && $items->has('Hammer'))
				|| ($locations->itemInLocations(Item::get('Key'), ["[dungeon-D1-1F] Dark Palace - statue push room", "[dungeon-D1-1F] Dark Palace - jump room [right chest]"])
						&& $items->canShootArrows());
		});

		$this->locations["Heart Container - Helmasaur King"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canShootArrows();
		})->setFillRules(function($item, $locations, $items) {
			return !in_array($item, [Item::get('Key'), Item::get('BigKey')]);
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('Hammer') && $items->canShootArrows();
		};

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('North East Dark World')->canEnter($locations, $items);
		};

		return $this;
	}
}
