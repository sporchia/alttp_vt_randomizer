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

	/**
	 * Create a new world and initialize all of the Regions within it
	 *
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
			case 'NoMajorGlitches':
			default:
				$this->win_condition = function($items) {
					return $this->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")->canAccess($items);
				};
				break;
		}
	}

	/**
	 * Determine the absolute minimum items required to complete the game. we do this by cycling through the items until
	 * we can't remove any more items.
	 * @TODO: sometimes Cape doesn't get listed as this is strictly based on items, might be better to use playthough to
	 * determine items and remove this function entirely
	 *
	 * @return array
	 */
	public function getRequiredItems(ItemCollection $items = null) {
		$items = $items ?? $this->getLocations()->filter(function($location) {
			return !is_a($location, Location\Medallion::class)
				&& !is_a($location, Location\Fountain::class);
		})->getItems();
		$original_items = $items->copy();

		$cycle = $items->count();

		do {
			$item = $items->shift();
			$cycle--;
			Log::debug(sprintf("Required: Pulling: %s", $item->getNiceName()));

			if (!$this->getWinCondition()($items)) {
				Log::debug(sprintf("Required: Putting: %s", $item->getNiceName()));
				$items->addItem($item);
			} else {
				foreach ($items as $check_access) {
					$secondary = $items->diff([$check_access]);
					foreach ($this->getLocationsWithItem($check_access) as $check_location) {
						if (!$check_location->canAccess($secondary)) {
							Log::debug(sprintf("Required: Putting (chain): %s", $item->getNiceName()));
							$items->addItem($item);
							continue 3;
						}
					}
				}

				$cycle = $items->count();
			}
		} while ($cycle > 0);

		return $items->toArray();
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
	 * Return an array of Locations to collect all Advancement Items in the game in order.
	 *
	 * @return array
	 */
	public function getPlayThrough(ItemCollection $items = null) {
		$my_items = new ItemCollection;
		$locations = $this->getLocations()->filter(function($location) {
			return !is_a($location, Location\Medallion::class)
				&& !is_a($location, Location\Fountain::class);
		});

		$location_order = [];
		$location_round = [];

		if ($items === null) {
			$items = $this->getRequiredItems();
		} else  {
			$items = $items->toArray();
		}

		// @TODO: if Prizes become part of the region locations this can be simplified.
		$progression_items = array_merge($items, [
			Item::get('Crystal1'),
			Item::get('Crystal2'),
			Item::get('Crystal3'),
			Item::get('Crystal4'),
			Item::get('Crystal5'),
			Item::get('Crystal6'),
			Item::get('Crystal7'),
			Item::get('PendantOfCourage'),
		]);

		$bottle_needed = false;
		foreach ($progression_items as $item) {
			if (is_a($item, Item\Bottle::class)) {
				$bottle_needed = true;
				break;
			}
		}

		$complexity = 0;
		do {
			$complexity++;
			$location_round[$complexity] = [];
			$available_locations = $locations->filter(function($location) use ($my_items) {
				return $location->canAccess($my_items);
			});

			$found_items = $available_locations->getItems();

			$available_locations->each(function($location) use (&$location_order, &$location_round, &$bottle_needed, $progression_items, $complexity) {
				if ((in_array($location->getItem(), $progression_items) || ($bottle_needed && is_a($location->getItem(), Item\Bottle::class)))
						&& !in_array($location, $location_order)) {
					if (is_a($location->getItem(), Item\Bottle::class)) {
						if (!$bottle_needed) {
							return;
						}
						$bottle_needed = false;
					}
					array_push($location_order, $location);
					array_push($location_round[$complexity], $location);
				}
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
