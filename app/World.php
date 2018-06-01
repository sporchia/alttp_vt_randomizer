<?php namespace ALttP;

use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use Closure;
use Log;

/**
 * This is the container for all the regions and locations one can find items in the game.
 */
class World {
	protected $difficulty;
	protected $variation;
	protected $logic;
	protected $goal;
	protected $regions = [];
	protected $locations;
	protected $shops;
	protected $win_condition;
	protected $collectable_locations;
	protected $pre_collected_items;
	protected $currently_filling_items;
	private $config = [];

	/**
	 * Create a new world and initialize all of the Regions within it
	 *
	 * @param string $difficulty difficulty from config to apply to randomization
	 * @param string $logic Ruleset to use when deciding if Locations can be reached
	 * @param string $goal Goal of the game
	 * @param string $variation modifications to difficulty
	 *
	 * @return void
	 */
	public function __construct($difficulty = 'normal', $logic = 'NoMajorGlitches', $goal = 'ganon', $variation = 'none', $sm_logic = 'Tournament') {
		$this->difficulty = $difficulty;
		$this->variation = $variation;
		$this->logic = $logic;
		$this->sm_logic = $sm_logic;
		$this->goal = $goal;
		$this->pre_collected_items = new ItemCollection([], $this);

		$this->regions = [
			'North East Light World' => new Region\LightWorld\NorthEast($this),
			'North West Light World' => new Region\LightWorld\NorthWest($this),
			'South Light World' => new Region\LightWorld\South($this),
			'Escape' => new Region\HyruleCastleEscape($this),
			'Eastern Palace' => new Region\EasternPalace($this),
			'Desert Palace' => new Region\DesertPalace($this),
			'West Death Mountain' => new Region\DeathMountain\West($this),
			'East Death Mountain' => new Region\DeathMountain\East($this),
			'Tower of Hera' => new Region\TowerOfHera($this),
			'Hyrule Castle Tower' => new Region\HyruleCastleTower($this),
			'East Dark World Death Mountain' => new Region\DarkWorld\DeathMountain\East($this),
			'West Dark World Death Mountain' => new Region\DarkWorld\DeathMountain\West($this),
			'North East Dark World' => new Region\DarkWorld\NorthEast($this),
			'North West Dark World' => new Region\DarkWorld\NorthWest($this),
			'South Dark World' => new Region\DarkWorld\South($this),
			'Mire' => new Region\DarkWorld\Mire($this),
			'Palace of Darkness' => new Region\PalaceOfDarkness($this),
			'Swamp Palace' => new Region\SwampPalace($this),
			'Skull Woods' => new Region\SkullWoods($this),
			'Thieves Town' => new Region\ThievesTown($this),
			'Ice Palace' => new Region\IcePalace($this),
			'Misery Mire' => new Region\MiseryMire($this),
			'Turtle Rock' => new Region\TurtleRock($this),
			'Ganons Tower' => new Region\GanonsTower($this),
			'Medallions' => new Region\Medallions($this),
			'Fountains' => new Region\Fountains($this),

			'Central Crateria' => new Region\SuperMetroid\Crateria\Central($this),
			'West Crateria' => new Region\SuperMetroid\Crateria\West($this),
			'East Crateria' => new Region\SuperMetroid\Crateria\East($this),

			'Green Brinstar' => new Region\SuperMetroid\Brinstar\Green($this),
			'Pink Brinstar' => new Region\SuperMetroid\Brinstar\Pink($this),
			'Blue Brinstar' => new Region\SuperMetroid\Brinstar\Blue($this),
			'Red Brinstar' => new Region\SuperMetroid\Brinstar\Red($this),
			'Kraids Lair Brinstar' => new Region\SuperMetroid\Brinstar\Kraid($this),

			'West Norfair' => new Region\SuperMetroid\Norfair\West($this),
			'East Norfair' => new Region\SuperMetroid\Norfair\East($this),
			'Crocomires Lair Norfair' => new Region\SuperMetroid\Norfair\Crocomire($this),

			'West Lower Norfair' => new Region\SuperMetroid\LowerNorfair\West($this),
			'East Lower Norfair' => new Region\SuperMetroid\LowerNorfair\East($this),

			'Wrecked Ship' => new Region\SuperMetroid\WreckedShip\WreckedShip($this),

			'Outer Maridia' => new Region\SuperMetroid\Maridia\Outer($this),
			'Inner Maridia' => new Region\SuperMetroid\Maridia\Inner($this),

			'Tourian' => new Region\SuperMetroid\Tourian($this),
		];

		$this->locations = new LocationCollection;
		$this->shops = new ShopCollection;

		// Initialize the Logic and Prizes for each Region that has them and fill our LocationsCollection
		foreach ($this->regions as $name => $region) {
			$region->init(($region->getGame() == 'ALTTP' ? $logic : $sm_logic));
			$this->locations = $this->locations->merge($region->getLocations());
			$this->shops = $this->shops->merge($region->getShops());
		}

		$this->win_condition = function($collected_items) {
			return ($collected_items->has('Triforce')
				|| $collected_items->has('TriforcePiece', $this->config('item.Goal.Required')));
		};
	}

	/**
	 * Set the world to the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		foreach ($this->regions as $name => $region) {
			$region->setVanilla();
		}

		return $this;
	}

	/**
	 * Get the collection of items left to be filled in this world
	 *
	 * @return ItemCollection
	 */
	public function getCurrentlyFillingItems() : ItemCollection {
		return $this->currently_filling_items ?? new ItemCollection([], $this);
	}

	/**
	 * Set the collection of items left to be filled in this world
	 *
	 * @param ItemCollection $items collection of items that are being filled
	 *
	 * @return $this
	 */
	public function setCurrentlyFillingItems(ItemCollection $items = null) : self {
		$this->currently_filling_items = $items;

		return $this;
	}

	/**
	 * Get the collection for pre-collected items
	 *
	 * @return ItemCollection
	 */
	public function getPreCollectedItems() : ItemCollection {
		return $this->pre_collected_items;
	}

	/**
	 * Set the collection for pre-collected items
	 *
	 * @param ItemCollection $items collection of items that have been pre-collected
	 *
	 * @return $this
	 */
	public function setPreCollectedItems(ItemCollection $items) : self {
		$this->pre_collected_items = $items;

		return $this;
	}

	/**
	 * Add a pre-collected Item
	 *
	 * @param Item $item item to add
	 *
	 * @return $this
	 */
	public function addPreCollectedItem(Item $item) : self {
		$this->pre_collected_items->addItem($item);

		return $this;
	}

	/**
	 * Remove a pre-collected Item
	 *
	 * @param Item $item item to remove
	 *
	 * @return $this
	 */
	public function removePreCollectedItem(Item $item) : self {
		$this->pre_collected_items->removeItem($item->getName());

		return $this;
	}

	/**
	 * Get a copy of this world with items in locations.
	 *
	 * @return static
	 */
	public function copy() {
		$copy = new static($this->difficulty, $this->logic, $this->goal, $this->variation, $this->sm_logic);
		foreach ($this->locations as $name => $location) {
			$copy->locations[$name]->setItem($location->getItem());
		}

		$copy->setPreCollectedItems($this->pre_collected_items->copy());

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
			try {
				$location->readItem($rom);
			} catch (\Exception $e) {
				continue;
			}
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
	 * @param bool $walkthrough include the play order
	 *
	 * @return array
	 */
	public function getPlayThrough($walkthrough = true) {
		$shadow_world = $this->copy();
		$junk_items = [
			Item::get('BlueShield'),
			Item::get('ProgressiveArmor'),
			Item::get('BlueMail'),
			Item::get('Boomerang'),
			Item::get('MirrorShield'),
			Item::get('PieceOfHeart'),
			Item::get('HeartContainer'),
			Item::get('BossHeartContainer'),
			Item::get('RedBoomerang'),
			Item::get('RedShield'),
			Item::get('RedMail'),
			Item::get('BombUpgrade5'),
			Item::get('BombUpgrade10'),
			Item::get('BombUpgrade50'),
			Item::get('ArrowUpgrade5'),
			Item::get('ArrowUpgrade10'),
			Item::get('ArrowUpgrade70'),
			Item::get('Arrow'),
			Item::get('TenArrows'),
			Item::get('Bomb'),
			Item::get('ThreeBombs'),
			Item::get('OneRupee'),
			Item::get('FiveRupees'),
			Item::get('TwentyRupees'),
			Item::get('FiftyRupees'),
			Item::get('OneHundredRupees'),
			Item::get('ThreeHundredRupees'),
			Item::get('Heart'),
			Item::get('Rupoor'),
			Item::get('XRay'),
			Item::get('Spazer'),
		];

		$location_sphere = $shadow_world->getLocationSpheres();
		$collectable_locations = new LocationCollection(array_flatten(array_map(function($collection) {
			return $collection->values();
		}, $location_sphere)));
		$required_locations = new LocationCollection;
		$required_locations_sphere = [];
		$reverse_location_sphere = array_reverse($location_sphere, true);
		foreach ($reverse_location_sphere as $sphere_level => $sphere) {
			if ($sphere_level == 0) {
				continue;
			}
			Log::debug("playthrough SPHERE: $sphere_level");
			foreach ($sphere as $location) {
				Log::debug(sprintf("playthrough Check: %s :: %s", $location->getName(),
					$location->getItem() ? $location->getItem()->getNiceName() : 'Nothing'));
				// pull item out (we have to pull keys as well :( as they are used in calcs for big keys see DP)
				$pulled_item = $location->getItem();
				if ($pulled_item === null) {
					continue;
				}
				$location->setItem();
				if ((!$this->config('region.wildMaps', false) && $pulled_item instanceof Item\Map)
					|| (!$this->config('region.wildCompasses', false) && $pulled_item instanceof Item\Compass)
					|| in_array($pulled_item, $junk_items)) {
					continue;
				}

				if (!$shadow_world->getWinCondition()($collectable_locations->getItems($shadow_world)->copy())) {
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
							$current_items = $collectable_locations->getItems($shadow_world)->copy();

							if (!$higher_location->canAccess($current_items, $this->getLocations())) {
								// put item back
								$location->setItem($this->locations[$location->getName()]->getItem());
								Log::debug(sprintf("playthrough Higher Location: %s :: %s", $higher_location->getName(),
									$this->locations[$higher_location->getName()]->getItem()->getNiceName()));
								$required_locations->addItem($location);
								$required_locations_sphere[$sphere_level][] = $location;
								Log::debug(sprintf("playthrough Readd: %s :: %s", $location->getName(),
									$location->getItem()->getNiceName()));
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
			Log::debug(sprintf("playthrough REQ: %s :: %s", $higher_location->getName(),
				$this->locations[$higher_location->getName()]->getItem()->getNiceName()));
		}
		if (!$walkthrough) {
			return $required_locations->values();
		}

		// RUN PLAYTHROUGH of locations found above
		$my_items = $shadow_world->pre_collected_items;
		$location_order = [];
		$location_round = [];
		$longest_item_chain = 1;
		do {
			// make sure we had something before going to the next round
			if (!empty($location_round[$longest_item_chain])) {
				$longest_item_chain++;
			}
			$location_round[$longest_item_chain] = [];
			$available_locations = $shadow_world->getCollectableLocations()->filter(function($location) use ($my_items, $location_order) {
				return !in_array($location, $location_order)
					&& $location->canAccess($my_items, $this->getLocations());
			});

			$found_items = $available_locations->getItems();

			$available_locations->each(function($location) use (&$location_order, &$location_round, $longest_item_chain) {
				$item = $location->getItem();
				if (in_array($location, $location_order)
						|| !$location->hasItem()) {
					return;
				}
				Log::debug(sprintf("Pushing: %s from %s", $item->getNiceName(), $location->getName()));
				array_push($location_order, $location);
				if ((($this->config('rom.genericKeys', false) || !$this->config('region.wildKeys', false)) && $item instanceof Item\Key)
					|| $item instanceof Item\Map
					|| $item instanceof Item\Compass
					|| $item == Item::get('RescueZelda')) {
					return;
				}
				array_push($location_round[$longest_item_chain], $location);
			});
			$my_items = $my_items->merge($found_items);
		} while ($found_items->count() > 0);

		$ret = ['longest_item_chain' => count($location_round)];
		if (count($shadow_world->pre_collected_items)) {
			$i = 0;
			foreach ($shadow_world->pre_collected_items as $item) {
				if ($item instanceof Item\Upgrade\Arrow
					|| $item instanceof Item\Upgrade\Bomb
					|| $item instanceof Item\Event) {
					continue;
				}

				$location = sprintf("Equipment Slot %s", ++$i);
				$ret[0]['Equipped'][$location] = $item->getNiceName();
			}
		}
		foreach ($location_round as $round => $locations) {
			$locations = array_filter($locations, function($location) {
				return !$location instanceof Location\Trade;
			});
			if (!count($locations)) {
				$ret['longest_item_chain']--;
			}
			foreach ($locations as $location) {
				$ret[$round][$location->getRegion()->getName()][$location->getName()] = $location->getItem()->getNiceName();
			}
		}

		$ret['regions_visited'] = array_reduce($ret, function($carry, $item) {
			return (is_array($item)) ? $carry + count($item) : $carry;
		});

		return $ret;
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
	 * Determine if this World is beatable
	 *
	 * @param ItemCollection $collected precollected items for consideration
	 *
	 * @return bool
	 */
	public function checkWinCondition(ItemCollection $collected = null) {
		return $this->getWinCondition()($this->collectItems($collected));
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
		if (!array_key_exists($key, $this->config)) {
			$this->config[$key] = config("alttp.{$this->difficulty}.variations.{$this->variation}.$key",
				config("alttp.{$this->difficulty}.$key",
					config("alttp.goals.{$this->goal}.$key",
						config("alttp.$key", null))));
		}

		return $this->config[$key] ?? $default;
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
	 * Collect the items in the world, you may pass in a set of pre-collected items.
	 *
	 * @param ItemCollection $collected precollected items for consideration in out collecting
	 *
	 * @return ItemCollection
	 */
	public function collectItems(ItemCollection $collected = null) {
		$my_items = $collected ?? new ItemCollection([], $this);
		$my_items = $my_items->merge($this->pre_collected_items);
		$available_locations = $this->getCollectableLocations()->filter(function($location) {
			return $location->hasItem();
		});

		do {
			$search_locations = $available_locations->filter(function($location) use ($my_items) {
				return $location->canAccess($my_items);
			});

			$available_locations = $available_locations->diff($search_locations);

			$found_items = $search_locations->getItems();
			$my_items = $my_items->merge($found_items);
		} while ($found_items->count() > 0);

		return $my_items;
	}

	/**
	 * Determine if an item is collectable.
	 *
	 * @param mixed $key
	 * @param int $at_least mininum number of item in collection
	 *
	 * @return bool
	 */
	public function canCollect($key, $at_least = 1) {
		switch ($key) {
			case 'anyBow': return $this->collectItems()->canShootArrows();
			default: return $this->collectItems()->has($key, $at_least);
		}
	}

	/**
	 * Determine the spheres that locations are in based on the items in the world
	 *
	 * @return array
	 */
	public function getLocationSpheres() {
		$sphere = 0;
		$location_sphere = [0 => new LocationCollection];
		$my_items = $this->pre_collected_items;
		$i = 0;
		foreach ($my_items as $item) {
			$location = new Location(sprintf("Equipment Slot %s", ++$i), null, null);
			$location->setItem($item);
			$location_sphere[0]->addItem($location);
		}
		$found_locations = new LocationCollection;
		do {
			$sphere++;
			$available_locations = $this->locations->filter(function($location) use ($my_items, $found_locations) {
				return !$location instanceof Location\Medallion
					&& !$location instanceof Location\Fountain
					&& !$found_locations->contains($location)
					&& $location->canAccess($my_items);
			});
			$location_sphere[$sphere] = $available_locations;

			$found_items = $available_locations->getItems();
			$found_locations = $found_locations->merge($available_locations);

			$my_items = $my_items->merge($found_items);
		} while ($found_items->count() > 0);

		return $location_sphere;
	}

	public function getLogic() : string {
		return $this->logic;
	}

	public function getSMLogic() : string {
		return $this->sm_logic;
	}

	/**
	 * Get Difficulty in this world
	 *
	 * @return string
	 */
	public function getDifficulty() : string {
		return $this->difficulty;
	}

	/**
	 * Get Varation in this world
	 *
	 * @return string
	 */
	public function getVariation() : string {
		return $this->variation;
	}

	/**
	 * Get Goal in this world
	 *
	 * @return string
	 */
	public function getGoal() : string {
		return $this->goal;
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
	 * Get all the Locations in this Region that do not have an Item assigned
	 *
	 * @return Support\LocationCollection
	 */
	public function getEmptyLocations() {
		return $this->locations->filter(function($location) {
			return !$location->hasItem();
		});
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

	/**
	 * Get all the Shops in all Regions in this world
	 *
	 * @return ShopCollection
	 */
	public function getShops() {
		return $this->shops;
	}

	/**
	 * Get Shop in this world by name
	 *
	 * @param string $name name of the Shop
	 *
	 * @return Shop
	 */
	public function getShop(string $name) {
		return $this->shops[$name];
	}
}
