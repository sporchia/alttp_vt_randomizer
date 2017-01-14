<?php namespace ALttP;

use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use Log;

/**
 * This is the container for all the regions and locations one can find items in the game.
 */
class World {
	protected $rules;
	protected $type;
	protected $regions = [];
	protected $locations;
	protected $win_condition;
	protected $collectable_locations;

	/**
	 * Create a new world and initialize all of the Regions within it
	 *
	 * @param string $rules rules from config to apply to randomization
	 * @param string $type Ruleset to use when deciding if Locations can be reached
	 *
	 * @return void
	 */
	public function __construct($rules = 'v8', $type = 'NoMajorGlitches') {
		$this->rules = $rules;
		$this->type = $type;

		$this->regions = [
			'Light World' => new Region\LightWorld($this),
			'Escape' => new Region\HyruleCastleEscape($this),
			'Eastern Palace' => new Region\EasternPalace($this),
			'Desert Palace' => new Region\DesertPalace($this),
			'Death Mountain' => new Region\DeathMountain($this),
			'East Death Mountain' => new Region\DeathMountain\East($this),
			'Tower of Hera' => new Region\TowerOfHera($this),
			'Hyrule Castle Tower' => new Region\HyruleCastleTower($this),
			'Dark World' => new Region\DarkWorld($this),
			'North East Dark World' => new Region\DarkWorld\NorthEast($this),
			'North West Dark World' => new Region\DarkWorld\NorthWest($this),
			'South Dark World' => new Region\DarkWorld\South($this),
			'Palace of Darkness' => new Region\PalaceOfDarkness($this),
			'Swamp Palace' => new Region\SwampPalace($this),
			'Skull Woods' => new Region\SkullWoods($this),
			'Thieves Town' => new Region\ThievesTown($this),
			'Ice Palace' => new Region\IcePalace($this),
			'Misery Mire' => new Region\MiseryMire($this),
			'Turtle Rock' => new Region\TurtleRock($this),
			'Ganons Tower' => new Region\GanonsTower($this),
			'Pendants' => new Region\Pendants($this),
			'Crystals' => new Region\Crystals($this),
			'Swords' => new Region\Swords($this),
			'Medallions' => new Region\Medallions($this),
			'Fountains' => new Region\Fountains($this),
		];

		$this->locations = new LocationCollection;

		// Initialize the Logic and Prizes for each Region that has them and fill our LocationsCollection
		foreach ($this->regions as $name => $region) {
			$region->init($type);
			$this->locations = $this->locations->merge($region->getLocations());
			// @TODO: make the prize just part of the Region?
			switch ($name) {
				case 'Eastern Palace':
					$region->setPrizeLocation($this->regions['Pendants']->getLocation("Eastern Palace Pendant"));
					break;
				case 'Desert Palace':
					$region->setPrizeLocation($this->regions['Pendants']->getLocation("Desert Palace Pendant"));
					break;
				case 'Tower of Hera':
					$region->setPrizeLocation($this->regions['Pendants']->getLocation("Tower of Hera Pendant"));
					break;
				case 'Palace of Darkness':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Palace of Darkness Crystal"));
					break;
				case 'Swamp Palace':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Swamp Palace Crystal"));
					break;
				case 'Skull Woods':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Skull Woods Crystal"));
					break;
				case 'Thieves Town':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Thieves Town Crystal"));
					break;
				case 'Ice Palace':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Ice Palace Crystal"));
					break;
				case 'Misery Mire':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Misery Mire Crystal"));
					break;
				case 'Turtle Rock':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Turtle Rock Crystal"));
					break;
			}
		}

		switch($this->type) {
			case 'Glitched':
				$this->win_condition = function($collected_items) {
					return $collected_items->has('Crystal1')
						&& $collected_items->has('Crystal2')
						&& $collected_items->has('Crystal3')
						&& $collected_items->has('Crystal4')
						&& $collected_items->has('Crystal5')
						&& $collected_items->has('Crystal6')
						&& $collected_items->has('Crystal7')
						&& $this->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")->canAccess($collected_items);
				};
				break;
			case 'NoMajorGlitches':
			default:
				$this->win_condition = function($collected_items) {
					return $this->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")->canAccess($collected_items);
				};
				break;
		}
	}

	/**
	 * Return Items in locations not magically filled by randomizer.
	 * This function is a HACK for dealing with specially set Items, like Pendants/Crystals/Swords
	 *
	 * @param ItemCollection $items currently collected Items
	 *
	 * @return ItemCollection
	 */
	public function collectPrizes(ItemCollection $items) {
		$prizes = new ItemCollection;
		foreach ($this->regions as $region) {
			if ($region->hasPrize() && $region->getPrizeLocation()->canAccess($items)) {
				$prizes->addItem($region->getPrize());
			}
		}
		foreach ($this->regions['Swords']->getLocations() as $location) {
			if ($location->canAccess($items) && $location->getItem()) {
				$prizes->addItem($location->getItem());
			}
		}
		return $prizes;
	}

	/**
	 * Get a copy of this world with items in locations.
	 *
	 * @return static
	 */
	public function copy() {
		$copy = new static($this->rules, $this->type);
		foreach ($this->locations as $name => $location) {
			$copy->locations[$name]->setItem($location->getItem());
		}

		return $copy;
	}

	/**
	 * Create world based on ROM file we read. Might only function with newer v7+ ROMs.
	 * TODO: is this better here or on the Rom object?
	 *
	 * @param Rom $rom Rom object to read from.
	 *
	 * @return $this
	 */
	public function modelFromRom(Rom $rom) {
		foreach ($this->locations as $location) {
			$location->readItem($rom);
		}
		return $this;
	}

	/**
	 * Return an array of Locations to collect all Advancement Items in the game in order. This works by cloning the
	 * current world (new Locations and all). Then it groups the locations into collection spheres (all reachable
	 * locations based on the items in the previous sphere). It then attempts to remove each item (starting from the
	 * outer most sphere [latest game locations]), checking the win condition after each removal. If the removed item
	 * makes it impossile to achieve the win condition, it is placed back at the location (and marked as a required
	 * location). If the item is safe to remove, we then take all the items out of the higher spheres and see if we can
	 * still access them with the items available in the lower spheres. If we cannot reach a required item from a higher
	 * sphere we put it back (and mark the location as required). We repeat this process until all spheres have been
	 * pruned. We then take that list of locations with items and run a playthrough of them so we know collection order.
	 *
	 * @return array
	 */
	public function getPlayThrough() {
		$shadow_world = $this->copy();
		$sphere = 0;
		$location_sphere = [];
		$my_items = new ItemCollection;
		$found_locations = new LocationCollection;
		do {
			$sphere++;
			$available_locations = $shadow_world->locations->filter(function($location) use ($my_items) {
				return !is_a($location, Location\Medallion::class)
					&& !is_a($location, Location\Fountain::class)
					&& !in_array($location->getItem(), [Item::get('BigKey'), Item::get('Key')])
					&& $location->canAccess($my_items);
			});
			$location_sphere[$sphere] = $available_locations->diff($found_locations);

			$found_items = $available_locations->getItems();
			$found_locations = $available_locations;

			$new_items = $found_items->diff($my_items);
			$my_items = $found_items;
		} while ($new_items->count() > 0);

		$required_locations = new LocationCollection;
		$required_locations_sphere = [];
		$reverse_location_sphere = array_reverse($location_sphere, true);
		foreach ($reverse_location_sphere as $sphere_level => $sphere) {
			Log::debug("playthrough SPHERE: $sphere_level");
			foreach ($sphere as $location) {
				Log::debug(sprintf("playthrough Check: %s :: %s", $location->getName(), $location->getItem() ? $location->getItem()->getNiceName() : 'Nothing'));
				// pull item out
				$pulled_item = $location->getItem();
				$location->setItem();

				if (!$shadow_world->getWinCondition()($shadow_world->getCollectableLocations()->getItems())) {
					// put item back
					$location->setItem($this->locations[$location->getName()]->getItem());
					$required_locations->addItem($location);
					$required_locations_sphere[$sphere_level][] = $location;
					Log::debug(sprintf("playthrough Keep: %s :: %s", $location->getName(), $location->getItem()->getNiceName()));
					continue;
				}

				// Itterate all spheres bubbling up -_-
				foreach (array_reverse(array_keys($required_locations_sphere)) as $check_sphere) {
					// don't check the current sphere (thats a waste of time).
					if ($check_sphere == $sphere_level || $required_locations->has($location->getName())) {
						continue;
					}
					Log::debug("CHECKING: $check_sphere");
					// remove all higher sphere items from their locations
					foreach ($required_locations_sphere as $higher_sphere => $higher_locations) {
						if ($higher_sphere < $check_sphere) {
							continue;
						}
						foreach ($higher_locations as $higher_location) {
							$higher_location->setItem();
						}
					}

					// test access of items in the outer sphere
					foreach ($required_locations_sphere as $higher_sphere => $higher_locations) {
						if ($higher_sphere != $check_sphere) {
							continue;
						}
						foreach ($higher_locations as $higher_location) {
							// remove the item we are trying to get
							$temp_pull = $higher_location->getItem();
							$higher_location->setItem();
							$current_items = $shadow_world->getCollectableLocations()->getItems();

							if (!$higher_location->canAccess($current_items)) {
								// put item back
								$location->setItem($this->locations[$location->getName()]->getItem());
								Log::debug(sprintf("playthrough Higher Location: %s :: %s", $higher_location->getName(), $this->locations[$higher_location->getName()]->getItem()->getNiceName()));
								$required_locations->addItem($location);
								$required_locations_sphere[$sphere_level][] = $location;
								Log::debug(sprintf("playthrough Readd: %s :: %s", $location->getName(), $location->getItem()->getNiceName()));
								break 2;
							}
							$higher_location->setItem($temp_pull);
						}
					}
					// put all higher items back
					foreach ($required_locations as $higher_location) {
						$higher_location->setItem($this->locations[$higher_location->getName()]->getItem());
					}
				}
			}
		}

		foreach ($required_locations as $higher_location) {
			Log::debug(sprintf("playthrough REQ: %s :: %s", $higher_location->getName(), $this->locations[$higher_location->getName()]->getItem()->getNiceName()));
		}

		// RUN PLAYTHROUGH of locations found above
		$my_items = new ItemCollection;
		$location_order = [];
		$location_round = [];
		$complexity = 0;
		do {
			$complexity++;
			$location_round[$complexity] = [];
			$available_locations = $shadow_world->getCollectableLocations()->filter(function($location) use ($my_items) {
				return $location->canAccess($my_items);
			});

			$found_items = $available_locations->getItems();

			$available_locations->each(function($location) use (&$location_order, &$location_round, $complexity) {
				if (in_array($location, $location_order)
						|| !$location->hasItem()
						|| in_array($location->getItem(), [Item::get('BigKey'), Item::get('Key')])) {
					return;
				}
				array_push($location_order, $location);
				array_push($location_round[$complexity], $location);
			});

			$new_items = $found_items->diff($my_items);
			$my_items = $found_items;
		} while ($new_items->count() > 0);

		$ret = ['complexity' => count($location_round)];
		foreach ($location_round as $round => $locations) {
			if (!count($locations)) {
				$ret['complexity']--;
			}
			foreach ($locations as $location) {
				$ret[$round][$location->getRegion()->getName()][$location->getName()] = $location->getItem()->getNiceName();
			}
		}

		$ret['sub_complexity'] = array_reduce($ret, function($carry, $item) {
			return (is_array($item)) ? $carry + count($item) : $carry;
		});

		return $ret;
	}

	/**
	 * Set the rules to use for this world
	 *
	 * @param string $rules rules set to use from config('alttp.{$rules}')
	 *
	 * @return $this
	 */
	public function setRules(string $rules) {
		$this->rules = $rules;
		return $this;
	}

	/**
	 * Get the rules currently used for this world
	 *
	 * @return string
	 */
	public function getRules() {
		return $this->rules;
	}

	/**
	 * Get the function that determines the win condition for this world.
	 *
	 * @return Closure
	 */
	public function getWinCondition() {
		return $this->win_condition;
	}

	/**
	 * Get config value based on the currently set rules
	 *
	 * @param string $key dot notation key of config
	 * @param mixed|null $default value to return if $key is not found
	 *
	 * @return mixed
	 */
	public function config(string $key, $default = null) {
		return config("alttp.{$this->rules}.$key", $default);
	}

	/**
	 * Get a region by Key name
	 *
	 * @param string $name Name of region to return
	 *
	 * @return Region|null
	 */
	public function getRegion(string $name) {
		return $this->regions[$name] ?? null;
	}

	/**
	 * Get all the Regions in this world
	 *
	 * @return array
	 */
	public function getRegions() {
		return $this->regions;
	}

	/**
	 * Get all the Locations in all Regions in this world
	 *
	 * @return LocationCollection
	 */
	public function getLocations() {
		return $this->locations;
	}

	/**
	 * Get Locations considered collectable. I.E. can contain items that Link can have.
	 * This is cached for faster retrevial
	 *
	 * @return LocationCollection
	 */
	public function getCollectableLocations() {
		if (!$this->collectable_locations) {
			$this->collectable_locations = $this->locations->filter(function($location) {
				return !is_a($location, Location\Medallion::class)
					&& !is_a($location, Location\Fountain::class);
			});
		}
		return $this->collectable_locations;
	}

	/**
	 * Get Location in this world by name
	 *
	 * @param string $name name of the Location
	 *
	 * @return Location
	 */
	public function getLocation(string $name) {
		return $this->locations[$name];
	}

	/**
	 * Get all the Locations that contain the requested Item
	 *
	 * @param Item|null $item item we are looking for
	 *
	 * @return LocationCollection
	 */
	public function getLocationsWithItem(Item $item = null) {
		return $this->locations->locationsWithItem($item);
	}

	/**
	 * Get all the Regions that contain the requested Item
	 *
	 * @param Item|null $item item we are looking for
	 *
	 * @return array
	 */
	public function getRegionsWithItem(Item $item = null) {
		return $this->getLocationsWithItem($item)->getRegions();
	}
}
