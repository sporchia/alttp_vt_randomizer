<?php namespace ALttP;

use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use Log;

/**
 * Main class for randomization. All the magic happens here. We use mt_rand as it is much faster than rand. Not all PHP
 * functions support mt_rand (e.g. array_shuffle), so those had to be cloned to maintain seed integrity.
 */
class Randomizer {
	/**
	 * This represents the logic for the Randmizer, if any locations logic gets changed this should change as well, so
	 * one knows that if they got the same seed, items will probably not be in the same locations.
	 */
	const LOGIC = 30;
	protected $rng_seed;
	protected $seed;
	protected $world;
	protected $difficulty;
	protected $variation;
	protected $logic;
	protected $config = [];
	protected $starting_equipment;
	static protected $logic_array = [
		0x25, 0x62, 0x19, 0x0E, 0xF0, 0xDB, 0x14, 0xC1,0x0D, 0x1C, 0x2F, 0xAE, 0x2D, 0x86, 0x2E, 0xD9,
		0x3A, 0x91, 0x8D, 0x59, 0x55, 0xEE, 0xC8, 0xE6,0xE1, 0x98, 0x94, 0xBA, 0xDE, 0x21, 0x4E, 0x9B,
		0x7C, 0xBF, 0x8B, 0x01, 0xD0, 0xCC, 0x13, 0x4D,0xD3, 0x77, 0xAF, 0x82, 0x6F, 0xA1, 0x2A, 0xA2,
		0x36, 0x47, 0xFB, 0x69, 0x32, 0xC9, 0xCA, 0xA8,0xE5, 0x09, 0x31, 0x5E, 0x16, 0x6D, 0xE4, 0xED,
		0xC5, 0x8A, 0x1B, 0x44, 0xC2, 0xD2, 0xCD, 0x28,0x53, 0x58, 0x54, 0x15, 0x64, 0x99, 0xD8, 0x52,
		0x67, 0xF2, 0x9C, 0x49, 0x56, 0xE7, 0xC4, 0x17,0x6C, 0xFE, 0x30, 0x93, 0x4B, 0xC7, 0xB9, 0x23,
		0xA7, 0x0B, 0x63, 0xA0, 0x6B, 0x5B, 0xF3, 0x03,0x29, 0x2C, 0x3C, 0xE3, 0xBB, 0x73, 0xFF, 0x78,
		0x9A, 0x8E, 0xFA, 0xCF, 0x79, 0x22, 0x90, 0xB6,0xD4, 0x70, 0xB2, 0xB0, 0x71, 0x5A, 0x88, 0x46,
		0x97, 0xD6, 0x75, 0x96, 0x81, 0x68, 0xB5, 0x7E,0xF7, 0x9E, 0x3E, 0xE0, 0x10, 0x5C, 0x50, 0x0A,
		0x26, 0x65, 0x18, 0xCB, 0xAD, 0x0C, 0x42, 0x76,0x02, 0xEB, 0x9D, 0xAA, 0x7D, 0xCE, 0x60, 0xE9,
		0x7A, 0x39, 0xBE, 0x8C, 0xA3, 0xEC, 0x9F, 0x40,0x33, 0x57, 0xBC, 0x6A, 0x41, 0x48, 0xB8, 0xF8,
		0x3B, 0x24, 0xC6, 0x4C, 0xB4, 0x34, 0x7F, 0x7B,0x35, 0xF5, 0x4A, 0xD1, 0x5F, 0x04, 0x45, 0xA4,
		0x06, 0xAB, 0xF6, 0xFC, 0x72, 0xC3, 0xDD, 0x1F,0xB3, 0x43, 0x95, 0xDC, 0xF9, 0x51, 0xEA, 0xB7,
		0xD7, 0xC0, 0x11, 0x4F, 0xD5, 0x74, 0x1E, 0x27,0x5D, 0x37, 0x00, 0x05, 0x8F, 0x1A, 0x84, 0xE2,
		0x20, 0xF1, 0x3F, 0xFD, 0x61, 0x92, 0xE8, 0x80,0xAC, 0x2B, 0x07, 0x87, 0xA5, 0x3D, 0xA9, 0xDA,
		0x85, 0x0F, 0x89, 0xF4, 0x38, 0x83, 0xA6, 0xEF,0x1D, 0x6E, 0xB1, 0xDF, 0x08, 0x66, 0xBD, 0x12,
	];

	/**
	 * Create a new Randomizer
	 *
	 * @param string $difficulty difficulty from config to apply to randomization
	 * @param string $logic Ruleset to use when deciding if Locations can be reached
	 * @param string $goal Goal of the game
	 * @param string $variation modifications to difficulty
	 *
	 * @return void
	 */
	public function __construct($difficulty = 'normal', $logic = 'NoMajorGlitches', $goal = 'ganon', $variation = 'none') {
		$this->difficulty = $difficulty;
		$this->variation = $variation;
		$this->logic = $logic;
		$this->goal = $goal;
		$this->world = new World($difficulty, $logic, $goal, $variation);
		$this->seed = new Seed;
		$this->starting_equipment = new ItemCollection([
			Item::get('BombUpgrade10'),
			Item::get('ArrowUpgrade10'),
			Item::get('ArrowUpgrade10'),
			Item::get('ArrowUpgrade10'),
		], $this->world);
		$this->world->setPreCollectedItems($this->starting_equipment);
	}

	/**
	 * Get the current RNG seed number
	 *
	 * @return int
	 */
	public function getSeed() {
		return $this->rng_seed;
	}

	/**
	 * Get the current Logic identifier
	 *
	 * @return string
	 */
	public function getLogic() {
		switch ($this->logic) {
			case 'None': return 'none-' . static::LOGIC;
			case 'NoMajorGlitches': return 'no-glitches-' . static::LOGIC;
			case 'OverworldGlitches': return 'overworld-glitches-' . static::LOGIC;
			case 'MajorGlitches': return 'major-glitches-' . static::LOGIC;
		}
		return 'unknown-' . static::LOGIC;
	}

	/**
	 * Get the current Logic identifier's nice name
	 *
	 * @return string
	 */
	public function getLogicNiceName() {
		switch ($this->logic) {
			case 'None': return 'None';
			case 'NoMajorGlitches': return 'No Glitches';
			case 'OverworldGlitches': return 'Overworld Glitches';
			case 'Glitched': return 'Major Glitches';
		}
		return 'Unknown';
	}

	/**
	 * Fill all empty Locations with Items using logic from the World. This is achieved by first setting up base
	 * portions of the world. Then taking the remaining empty locations we order them, and try to fill them in
	 * order in a way that opens more locations.
	 *
	 * @param int|null $rng_seed Seed to create, or random if null
	 *
	 * @return $this
	 */
	public function makeSeed(int $rng_seed = null) {
		$rng_seed = $rng_seed ?: random_int(1, 999999999); // cryptographic pRNG for seeding
		$this->rng_seed = $rng_seed % 1000000000;
		// http://php.net/manual/en/migration72.incompatible.php#migration72.incompatible.rand-mt_rand-output
		mt_srand($this->rng_seed);
		$this->seed->seed = $this->rng_seed;

		Log::info(sprintf("Seed: %s", $this->rng_seed));

		$regions = $this->world->getRegions();

		switch ($this->goal) {
			case 'pedestal':
				$this->world->getLocation("Master Sword Pedestal")->setItem(Item::get('Triforce'));
				break;
			case 'ganon':
			case 'dungeons':
				$this->world->getLocation("Ganon")->setItem(Item::get('Triforce'));
				break;
		}

		// Set up World before we fill dungeons
		$this->setShops();
		$this->setMedallions($regions);
		$this->placeBosses($this->world);
		$this->fillPrizes($this->world);

		$regions['Fountains']->getLocations()->each(function($fountain) {
			if ($fountain->hasItem()) {
				return;
			}
			$fountain->setItem($this->getBottle(true));
		});

		$locations = $this->world->getLocations()->filter(function($location) {
			return !is_a($location, Location\Prize::class)
				&& !is_a($location, Location\Medallion::class);
		});

		$locations["Pyramid Fairy - Bow"]->setItem($this->config('region.pyramidBowUpgrade', false)
			? Item::get('BowAndSilverArrows')
			: Item::get('BowAndArrows'));

		// fill boss hearts before anything else if we need to
		if ($this->config('region.bossesHaveItem', false) || !$this->config('region.bossHeartsInPool', true)) {
			$boss_item = !$this->config('region.bossHeartsInPool', true)
				 ? Item::get('BossHeartContainer')
				 : Item::get($this->config('region.bossesHaveItem'));
			$locations["Desert Palace - Lanmolas'"]->setItem($boss_item);
			$locations["Eastern Palace - Armos Knights"]->setItem($boss_item);
			$locations["Ice Palace - Kholdstare"]->setItem($boss_item);
			$locations["Misery Mire - Vitreous"]->setItem($boss_item);
			$locations["Palace of Darkness - Helmasaur King"]->setItem($boss_item);
			$locations["Skull Woods - Mothula"]->setItem($boss_item);
			$locations["Swamp Palace - Arrghus"]->setItem($boss_item);
			$locations["Thieves' Town - Blind"]->setItem($boss_item);
			$locations["Turtle Rock - Trinexx"]->setItem($boss_item);
			$locations["Tower of Hera - Moldorm"]->setItem($boss_item);
		}

		$dungeon_items = $this->getDungeonPool();
		$advancement_items = $this->getAdvancementItems();
		$nice_items = $this->getNiceItems();
		$trash_items = ($this->config('rng_items'))
			? array_fill(0, count($this->getItemPool()), Item::get('singleRNG'))
			: $this->getItemPool();

		if (in_array($this->logic, ['MajorGlitches', 'OverworldGlitches']) && $this->difficulty !== 'custom') {
			$this->starting_equipment->addItem(Item::get('PegasusBoots'));
			foreach ($advancement_items as $key => $item) {
				if ($item == Item::get('PegasusBoots')) {
					unset($advancement_items[$key]);
					array_push($trash_items, Item::get('TwentyRupees'));
					break;
				}
			}
		}

		// Easy starts with
		if ($this->difficulty == 'easy') {
			$this->starting_equipment->addItem(Item::get('BossHeartContainer'));
			$this->starting_equipment->addItem(Item::get('BossHeartContainer'));
			$this->starting_equipment->addItem(Item::get('BossHeartContainer'));
		}

		if ($this->config('mode.state') == 'open') {
			$this->starting_equipment->addItem(Item::get('RescueZelda'));
		}

		// take out all the swords and silver arrows
		$nice_items_swords = [];
		$nice_items_bottles = [];
		foreach ($advancement_items as $key => $item) {
			if ($item == Item::get('SilverArrowUpgrade')) {
				$nice_items[] = $item;
				unset($advancement_items[$key]);
				continue;
			}
			if ($item instanceof Item\Sword) {
				$nice_items_swords[] = $item;
				unset($advancement_items[$key]);
				continue;
			}
			if ($item instanceof Item\Bottle) {
				$nice_items_bottles[] = $item;
				unset($advancement_items[$key]);
				continue;
			}
		}
		if ($this->config('mode.weapons') == 'swordless') {
			// In swordless we need to catch all swords
			foreach ($nice_items as $key => $item) {
				if ($item instanceof Item\Sword) {
					unset($nice_items[$key]);
					$nice_items_swords[] = $item;
				}
			}
			// In swordless mode silvers are 100% required
			config(['alttp.region.requireBetterBow' => true]);
			foreach ($nice_items_swords as $unneeded) {
				$nice_items[] = Item::get('TwentyRupees2');
			}
			$world_items = $this->world->collectItems()->values();
			if (!in_array(Item::get('SilverArrowUpgrade'), $world_items) && !in_array(Item::get('BowAndSilverArrows'), $world_items)) {
				if (array_search(Item::get('SilverArrowUpgrade'), $nice_items) === false && $this->difficulty !== 'custom') {
					$advancement_items[] = Item::get('SilverArrowUpgrade');
				}
			}
		} else {
			// put 1 sword back
			if (count($nice_items_swords)) {
				$uncle_sword = Item::get('UncleSword')->setTarget(array_pop($nice_items_swords));
				if ($this->config('mode.weapons') == 'uncle' && !$this->world->getLocation("Link's Uncle")->hasItem()) {
					$this->world->getLocation("Link's Uncle")->setItem($uncle_sword);
				} else {
					array_push($advancement_items, $uncle_sword);
				}
			}

			if (count($nice_items_swords)) {
				if ($this->config('mode.weapons') == 'uncle') {
					$uncle_item = $this->world->getLocation("Link's Uncle")->getItem();
					if ($uncle_item !== null && !$uncle_item->getTarget() instanceof Item\Sword) {
						throw new \Exception("Uncle must have a sword item when Uncle Assured is selected");
					}
					if ($uncle_item === null) {
						$this->world->getLocation("Link's Uncle")->setItem(array_pop($nice_items_swords));
					}
				} else {
					array_push($advancement_items, array_pop($nice_items_swords));
				}
			}

			if (count($nice_items_swords)) {
				if ($this->config('region.takeAnys', false)) {
					array_pop($nice_items_swords);
					array_push($trash_items, Item::get('TwentyRupees'));
				}
			}

			$nice_items = array_merge($nice_items, $nice_items_swords);
		}
		// put 1 bottle back
		if (count($nice_items_bottles)) {
			array_push($advancement_items, array_pop($nice_items_bottles));
		}
		$nice_items = array_merge($nice_items, $nice_items_bottles);

		if ($this->config('rom.rupeeBow', false)) {
			$trash_items_replace = [];
			foreach ($trash_items as $key => $item) {
				if ($item instanceof Item\Arrow || $item instanceof Item\Upgrade\Arrow) {
					unset($trash_items[$key]);
					$trash_items_replace[] = Item::get('FiveRupees');
				}
			}
			$trash_items = array_merge($trash_items, $trash_items_replace);
		}

		if ($this->world->config('region.wildBigKeys', false)) {
			foreach ($dungeon_items as $key => $item) {
				if ($item instanceof Item\BigKey) {
					unset($dungeon_items[$key]);
					$advancement_items[] = $item;
				}
			}
		}
		if ($this->world->config('region.wildKeys', false)) {
			foreach ($dungeon_items as $key => $item) {
				if ($item instanceof Item\Key && ($this->config('mode.state') == 'open' || $item != Item::get('KeyH2'))) {
					unset($dungeon_items[$key]);
					$advancement_items[] = $item;
				}
			}
		}
		if ($this->world->config('region.wildMaps', false)) {
			foreach ($dungeon_items as $key => $item) {
				if ($item instanceof Item\Map) {
					unset($dungeon_items[$key]);
					$advancement_items[] = $item;
				}
			}
		}
		if ($this->world->config('region.wildCompasses', false)) {
			foreach ($dungeon_items as $key => $item) {
				if ($item instanceof Item\Compass) {
					unset($dungeon_items[$key]);
					$advancement_items[] = $item;
				}
			}
		}

		$advancement_items = fy_shuffle($advancement_items);

		$filler = Filler::factory('RandomAssumed', $this->world);

		// mess with the junk fill
		if ($this->goal == 'triforce-hunt' || $this->goal == 'pedestal') {
			$filler->setGanonJunkLimits(15, 50);
		}
		if (in_array($this->logic, ['OverworldGlitches', 'MajorGlitches'])) {
			$filler->setGanonJunkLimits(0, 0);
		}

		$filler->fill($dungeon_items, $advancement_items, $nice_items, $trash_items);

		return $this;
	}

	/**
	 * Place the bosses for each region.
	 *
	 * @param World $world world to place bosses in.
	 *
	 * @return $this
	 */
	public function placeBosses(World $world) : self {
		$this->world->getRegion('Eastern Palace')->setBoss(Boss::get("Armos Knights"));
		$this->world->getRegion('Desert Palace')->setBoss(Boss::get("Lanmolas"));
		$this->world->getRegion('Tower of Hera')->setBoss(Boss::get("Moldorm"));
		$this->world->getRegion('Hyrule Castle Tower')->setBoss(Boss::get("Agahnim"));
		$this->world->getRegion('Palace of Darkness')->setBoss(Boss::get("Helmasaur King"));
		$this->world->getRegion('Swamp Palace')->setBoss(Boss::get("Arrghus"));
		$this->world->getRegion('Skull Woods')->setBoss(Boss::get("Mothula"));
		$this->world->getRegion('Thieves Town')->setBoss(Boss::get("Blind"));
		$this->world->getRegion('Ice Palace')->setBoss(Boss::get("Kholdstare"));
		$this->world->getRegion('Misery Mire')->setBoss(Boss::get("Vitreous"));
		$this->world->getRegion('Turtle Rock')->setBoss(Boss::get("Trinexx"));
		$this->world->getRegion('Ganons Tower')->setBoss(Boss::get("Armos Knights"), 'bottom');
		$this->world->getRegion('Ganons Tower')->setBoss(Boss::get("Lanmolas"), 'middle');
		$this->world->getRegion('Ganons Tower')->setBoss(Boss::get("Moldorm"), 'top');
		$this->world->getRegion('Ganons Tower')->setBoss(Boss::get("Agahnim2"));

		return $this;
	}

	/**
	 * Place the prizes for dungeon completion. This is non-destructive.
	 *
	 * @param World $world world to fill prizes on.
	 *
	 * @return $this
	 */
	public function fillPrizes(World $world, $attempts = 5) : self {
		$prize_locations = $world->getLocations()->filter(function($location) {
			return is_a($location, Location\Prize::class);
		})->randomCollection(15);

		$crystal_locations = $prize_locations->filter(function($location) {
			return is_a($location, Location\Prize\Crystal::class);
		});

		$pendant_locations = $prize_locations->filter(function($location) {
			return is_a($location, Location\Prize\Pendant::class);
		});

		if (!$this->config('prize.shuffleCrystals', true)) {
			$crystal_locations["Palace of Darkness - Prize"]->setItem(Item::get('Crystal1'));
			$crystal_locations["Swamp Palace - Prize"]->setItem(Item::get('Crystal2'));
			$crystal_locations["Skull Woods - Prize"]->setItem(Item::get('Crystal3'));
			$crystal_locations["Thieves' Town - Prize"]->setItem(Item::get('Crystal4'));
			$crystal_locations["Ice Palace - Prize"]->setItem(Item::get('Crystal5'));
			$crystal_locations["Misery Mire - Prize"]->setItem(Item::get('Crystal6'));
			$crystal_locations["Turtle Rock - Prize"]->setItem(Item::get('Crystal7'));
		}

		if (!$this->config('prize.shufflePendants', true)) {
			$pendant_locations["Eastern Palace - Prize"]->setItem(Item::get('PendantOfCourage'));
			$pendant_locations["Desert Palace - Prize"]->setItem(Item::get('PendantOfPower'));
			$pendant_locations["Tower of Hera - Prize"]->setItem(Item::get('PendantOfWisdom'));
		}

		$placed_prizes = $prize_locations->getItems();

		$remaining_prizes = fy_shuffle(array_diff([
			Item::get('Crystal1'),
			Item::get('Crystal2'),
			Item::get('Crystal3'),
			Item::get('Crystal4'),
			Item::get('Crystal5'),
			Item::get('Crystal6'),
			Item::get('Crystal7'),
			Item::get('PendantOfCourage'),
			Item::get('PendantOfPower'),
			Item::get('PendantOfWisdom'),
		], $placed_prizes->values()));

		$place_prizes = ($this->config('prize.crossWorld', true))
			? $remaining_prizes
			: array_filter($remaining_prizes, function($item) {
				return is_a($item, Item\Crystal::class);
			});

		$empty_crystal_locations = $crystal_locations->getEmptyLocations();
		foreach ($empty_crystal_locations as $location) {
			$total_prizes = count($place_prizes);
			for ($i = 0; $i < $total_prizes; ++$i) {
				$place_prize = array_pop($place_prizes);
				$assumed_items = $world->collectItems(new ItemCollection(array_merge(
					$this->getDungeonPool(),
					$this->getAdvancementItems(),
					$place_prizes), $world));
				if ($location->canAccess($assumed_items)) {
					break;
				}
				array_unshift($place_prizes, $place_prize);
			}
			if ($total_prizes == count($place_prizes)) {
				continue;
			}

			$location->setItem($place_prize);
			Log::debug(sprintf("Placing: %s in %s", $location->getItem()->getNiceName(), $location->getName()));

			if (!$world->checkWinCondition($assumed_items)) {
				if ($attempts > 0) {
					$empty_crystal_locations->each(function($location) {
						$location->setItem();
					});
					Log::debug(sprintf("Unwinnable Prize Placement (reset %s)", $attempts));
					return $this->fillPrizes($world, $attempts - 1);
				}
				throw new \Exception("Cannot Place Prize: " . $location->getName());
			}
		}
		if ($crystal_locations->getEmptyLocations()->count()) {
			if ($attempts > 0) {
				$empty_crystal_locations->each(function($location) {
					$location->setItem();
				});
				Log::debug(sprintf("Unwinnable Prize Placement (reset %s)", $attempts));
				return $this->fillPrizes($world, $attempts - 1);
			}
			throw new \Exception("Cannot Place Prize: " . $crystal_locations->getEmptyLocations()->first()->getName());
		}

		$place_prizes = ($this->config('prize.crossWorld', true))
			? $place_prizes
			: array_filter($remaining_prizes, function($item) {
				return is_a($item, Item\Pendant::class);
			});

		$empty_pendant_locations = $pendant_locations->getEmptyLocations();
		foreach ($empty_pendant_locations as $location) {
			$total_prizes = count($place_prizes);
			for ($i = 0; $i < $total_prizes; ++$i) {
				$place_prize = array_pop($place_prizes);
				$assumed_items = $world->collectItems(new ItemCollection(array_merge(
					$this->getDungeonPool(),
					$this->getAdvancementItems(),
					$place_prizes), $world));
				if ($location->canAccess($assumed_items)) {
					break;
				}
				array_unshift($place_prizes, $place_prize);
			}
			if ($total_prizes == count($place_prizes)) {
				continue;
			}

			$location->setItem($place_prize);
			Log::debug(sprintf("Placing: %s in %s", $location->getItem()->getNiceName(), $location->getName()));

			if (!$world->checkWinCondition($assumed_items)) {
				if ($attempts > 0) {
					$empty_pendant_locations->each(function($location) {
						$location->setItem();
					});
					Log::debug(sprintf("Unwinnable Prize Placement (reset %s)", $attempts));
					return $this->fillPrizes($world, $attempts - 1);
				}
				throw new \Exception("Cannot Place Prize: " . $location->getName());
			}
		}
		if ($pendant_locations->getEmptyLocations()->count()) {
			if ($attempts > 0) {
				$empty_pendant_locations->each(function($location) {
					$location->setItem();
				});
				Log::debug(sprintf("Unwinnable Prize Placement (reset %s)", $attempts));
				return $this->fillPrizes($world, $attempts - 1);
			}
			throw new \Exception("Cannot Place Prize: " . $pendant_locations->getEmptyLocations()->first()->getName());
		}

		return $this;
	}

	protected function setMedallions($regions) {
		$medallions = [
			Item::get('Ether'),
			Item::get('Bombos'),
			Item::get('Quake'),
		];

		foreach ($regions['Medallions']->getLocations() as $medallion_location) {
			if ($medallion_location->hasItem()) {
				continue;
			}

			$medallion = $medallions[get_random_int(0, 2)];
			$medallion_location->setItem($medallion);
		}
	}

	protected function setShops() {
		if (!$this->config('rom.genericKeys', false)
			|| !$this->config('rom.rupeeBow', false)
			|| !$this->config('region.takeAnys', false)) {
			return;
		}

		$shops = $this->world->getShops();

		if ($this->config('region.takeAnys', false)) {
			$shops->filter(function($shop) {
				return $shop instanceof Shop\TakeAny;
			})->randomCollection(4)->each(function($shop) {
				$shop->setActive(true);
				$shop->setShopkeeper('old_man');
				$shop->addInventory(0, Item::get('BluePotion'), 0);
				$shop->addInventory(1, Item::get('BossHeartContainer'), 0);
			});

			$old_man = $shops->filter(function($shop) {
				return $shop instanceof Shop\TakeAny
					&& !$shop->getActive();
			})->random();

			$old_man->setActive(true);
			$old_man->setShopkeeper('old_man');
			$old_man->addInventory(0, ($this->config('mode.weapons') == 'swordless') ? Item::get('ThreeHundredRupees')
				: Item::get('ProgressiveSword'), 0);
		}

		$shops->filter(function($shop) {
			return !$shop instanceof Shop\TakeAny;
		})->randomCollection(5)->each(function($shop) {
			$shop->setActive(true);
			if ($this->config('rom.rupeeBow', false)) {
				$shop->addInventory(0, Item::get('Arrow'), 80);
			}
			if ($this->config('rom.genericKeys', false)) {
				$shop->addInventory(1, Item::get('KeyGK'), 100);
			}
			$shop->addInventory(2, Item::get('TenBombs'), 50);
		});

		if ($this->config('rom.rupeeBow', false)) {
			// One shop has arrows for sale, we need to set the price correct for
			$dw_shop = $this->world->getShop("Dark World Forest Shop");
			if ($this->config('rom.rupeeBow') && !$dw_shop->getActive()) {
				$dw_shop->setActive(true);
				$dw_shop->addInventory(2, Item::get('Arrow'), 80);
			}
		}
	}

	/**
	 * Get the current spoiler for this seed
	 *
	 * @param array $meta passthrough data to add to meta
	 *
	 * @return array
	 */
	public function getSpoiler(array $meta = []) {
		$spoiler = [];

		if (count($this->starting_equipment)) {
			$i = 0;
			foreach ($this->starting_equipment as $item) {
				if ($item instanceof Item\Upgrade\Arrow
					|| $item instanceof Item\Upgrade\Bomb
					|| $item instanceof Item\Event) {
					continue;
				}

				$location = sprintf("Equipment Slot %s", ++$i);
				$spoiler['Equipped'][$location] = $item->getNiceName();
			}
		}

		foreach ($this->world->getRegions() as $region) {
			$name = $region->getName();
			if (!isset($spoiler[$name])) {
				$spoiler[$name] = [];
			}
			$region->getLocations()->each(function($location) use (&$spoiler, $name) {
				if ($location instanceof Location\Prize\Event
					|| $location instanceof Location\Trade) {
					return;
				}
				if ($location->hasItem()) {
					$item = $location->getItem();
					$spoiler[$name][$location->getName()] = $this->config('rom.genericKeys', false) && $item instanceof Item\Key
						? 'Key'
						: $item->getNiceName();
				} else {
					$spoiler[$name][$location->getName()] = 'Nothing';
				}
			});
		}
		foreach ($this->world->getShops() as $shop) {
			if ($shop->getActive()) {
				$shop_data = [
					'location' => $shop->getName(),
					'type' => $shop instanceof Shop\TakeAny ? 'Take Any' : 'Shop',
				];
				foreach ($shop->getInventory() as $slot => $item) {
					$shop_data["item_$slot"] = $item['price'] ? $item['item']->getNiceName() . ' (' . $item['price'] . ')' : $item['item']->getNiceName();
				}
				$spoiler['Shops'][] = $shop_data;
			}
		}
		$spoiler['playthrough'] = $this->world->getPlayThrough();
		$spoiler['meta'] = array_merge($meta, [
			'difficulty' => $this->difficulty,
			'variation' => $this->variation,
			'logic' => $this->getLogic(),
			'rom_mode' => $this->config('rom.logicMode', $this->logic),
			'seed' => $this->rng_seed,
			'goal' => $this->goal,
			'build' => Rom::BUILD,
			'mode' => $this->config('mode.state', 'standard'),
			'weapons' => $this->config('mode.weapons', 'randomized')
		]);

		if ($this->config('rom.HardMode') !== null) {
			$spoiler['meta']['difficulty_mode'] = $this->config('randomizer.item.difficulty_adjustments.' . $this->config('rom.HardMode', 0));
		}

		$this->seed->spoiler = json_encode($spoiler);

		return $spoiler;
	}

	/**
	 * Get config value based on the currently set difficulty/variation
	 *
	 * @param string $key dot notation key of config
	 * @param mixed|null $default value to return if $key is not found
	 *
	 * @return mixed
	 */
	public function config(string $key, $default = null) {
		return $this->world->config($key, $default);
	}

	/**
	 * write the current generated data to the Rom
	 *
	 * @param Rom $rom Rom to write data to
	 *
	 * @return Rom
	 */
	public function writeToRom(Rom $rom) {
		$this->setTexts($rom);

		foreach ($this->world->getRegions() as $name => $region) {
			$region->getLocations()->getNonEmptyLocations()->each(function($location) use ($rom) {
				$location->writeItem($rom);
			});
			// Clear out remaining locations if the pool was smaller than number of locations
			$region->getLocations()->getEmptyLocations()->each(function($location) use ($rom) {
				$location->setItem(Item::get('Nothing'));
				$location->writeItem($rom);
			});
		}

		if ($this->config('rng_items')) {
			$rom->setSingleRNGTable(new ItemCollection($this->getItemPool()));
		}

		$rom->setGoalRequiredCount($this->config('item.Goal.Required', 0) ?: 0);
		$rom->setGoalIcon($this->config('item.Goal.Icon', 'triforce'));

		$rom->setHardMode($this->config('rom.HardMode', 0));

		$rom->setRupoorValue($this->config('item.value.Rupoor', 0) ?: 0);

		$rom->setGanonAgahnimRng($this->config('rom.GanonAgRNG', 'table'));

		// testing features
		$rom->setGenericKeys($this->config('rom.genericKeys', false));
		if ($this->config('rom.genericKeys', false)) {
			$rom->setupCustomShops($this->world->getShops());
		}
		$rom->setRupeeArrow($this->config('rom.rupeeBow', false));
		$rom->setLockAgahnimDoorInEscape(true);
		$rom->setWishingWellChests(true);
		$rom->setWishingWellUpgrade(false);
		$rom->setRestrictFairyPonds(true);
		$rom->setLimitProgressiveSword($this->config('item.overflow.count.Sword', 4),
			Item::get($this->config('item.overflow.replacement.Sword', 'TwentyRupees'))->getBytes()[0]);
		$rom->setLimitProgressiveShield($this->config('item.overflow.count.Shield', 3),
			Item::get($this->config('item.overflow.replacement.Shield', 'TwentyRupees'))->getBytes()[0]);
		$rom->setLimitProgressiveArmor($this->config('item.overflow.count.Armor', 2),
			Item::get($this->config('item.overflow.replacement.Armor', 'TwentyRupees'))->getBytes()[0]);
		$rom->setLimitBottle($this->config('item.overflow.count.Bottle', 4),
			Item::get($this->config('item.overflow.replacement.Bottle', 'TwentyRupees'))->getBytes()[0]);

		switch ($this->difficulty) {
			case 'easy':
				$rom->setSilversEquip('both');
				$rom->setSubstitutions([
					0x12, 0x01, 0x35, 0xFF, // lamp -> 5 rupees
					0x58, 0x01, 0x43, 0xFF, // silver arrows -> 1 arrow
					0x3E, 0x07, 0x36, 0xFF, // 7 boss hearts -> 20 rupees
				]);
				break;
			default:
				$rom->setSilversEquip('collection');
				$rom->setSubstitutions([
					0x12, 0x01, 0x35, 0xFF, // lamp -> 5 rupees
				]);
		}

		switch ($this->goal) {
			case 'triforce-hunt':
			case 'pedestal':
				$rom->setGanonInvincible('yes');
				break;
			case 'dungeons':
				$rom->setGanonInvincible('dungeons');
				break;
			default:
				$rom->setGanonInvincible('crystals');
		}

		if ($this->config('rom.mapOnPickup', false)) {
			$green_pendant_region = $this->world->getLocationsWithItem(Item::get('PendantOfCourage'))->first()->getRegion();

			$rom->setMapRevealSahasrahla($green_pendant_region->getMapReveal());

			$crystal5_region = $this->world->getLocationsWithItem(Item::get('Crystal5'))->first()->getRegion();
			$crystal6_region = $this->world->getLocationsWithItem(Item::get('Crystal6'))->first()->getRegion();

			$rom->setMapRevealBombShop($crystal5_region->getMapReveal() | $crystal6_region->getMapReveal());
		}

		$rom->setMapMode($this->config('rom.mapOnPickup', false));
		$rom->setCompassMode($this->config('rom.compassOnPickup', 'off'));
		$rom->setFreeItemTextMode($this->config('rom.freeItemText', false));
		$rom->setFreeItemMenu($this->config('rom.freeItemMenu', 0x00));
		$rom->setDiggingGameRng(get_random_int(1, 30));

		$rom->writeRNGBlock(function() {
			return get_random_int(0, 0x100);
		});

		$this->writePrizePacksToRom($rom);

		if ($this->config('sprite.shuffleOverworldBonkPrizes', false)) {
			$this->writeOverworldBonkPrizeToRom($rom);
		}

		$rom->setPyramidFairyChests($this->config('region.swordsInPool', true));
		$rom->setSmithyQuickItemGive($this->config('region.swordsInPool', true));

		$rom->setOpenMode($this->config('mode.state') == 'open');
		$rom->setSwordlessMode($this->config('mode.weapons') == 'swordless');

		if (!$this->world->getLocation("Link's Uncle")->getItem() instanceof Item\Sword) {
			$rom->removeUnclesSword();
		}
		if (!$this->world->getLocation("Link's Uncle")->getItem() instanceof Item\Shield
			|| !$this->world->getLocation("Link's Uncle")->hasItem(Item::get('L1SwordAndShield'))) {
			$rom->removeUnclesShield();
		}

		$this->randomizeCredits($rom);

		$rom->setStartingEquipment($this->starting_equipment);
		$rom->setCapacityUpgradeFills([
			$this->config('item.value.BombUpgrade5', 0),
			$this->config('item.value.BombUpgrade10', 0),
			$this->config('item.value.ArrowUpgrade5', 0),
			$this->config('item.value.ArrowUpgrade10', 0),
		]);

		// currently has to be after compass mode, as this will override compass mode.
		$rom->setClockMode($this->config('rom.timerMode', 'off'));

		$rom->setBlueClock($this->config('item.value.BlueClock', 0) ?: 0);
		$rom->setRedClock($this->config('item.value.RedClock', 0) ?: 0);
		$rom->setGreenClock($this->config('item.value.GreenClock', 0) ?: 0);
		$rom->setStartingTime($this->config('rom.timerStart', 0) ?: 0);

		switch ($this->config('rom.logicMode', $this->logic)) {
			case 'MajorGlitches':
				$type_flag = 'G';
				$rom->setSwampWaterLevel(false);
				$rom->setPreAgahnimDarkWorldDeathInDungeon(false);
				$rom->setSaveAndQuitFromBossRoom(true);
				$rom->setWorldOnAgahnimDeath(false);
				$rom->setRandomizerSeedType('MajorGlitches');
				$rom->setWarningFlags(bindec('01100000'));
				break;
			case 'OverworldGlitches':
				$type_flag = 'S';
				$rom->setPreAgahnimDarkWorldDeathInDungeon(false);
				$rom->setSaveAndQuitFromBossRoom(true);
				$rom->setWorldOnAgahnimDeath(true);
				$rom->setRandomizerSeedType('OverworldGlitches');
				$rom->setWarningFlags(bindec('01000000'));
				break;
			case 'NoMajorGlitches':
			default:
				$type_flag = 'C';
				$rom->setSaveAndQuitFromBossRoom(true);
				$rom->setWorldOnAgahnimDeath(true);
				break;
		}

		$rom->setGameType('item');

		$rom->writeRandomizerLogicHash(self::$logic_array);
		$rom->setSeedString(str_pad(sprintf("VT%s%'.09d%'.03s%s", $type_flag, $this->rng_seed, static::LOGIC, $this->difficulty), 21, ' '));

		if (static::class == self::class) {
			$rom->writeCredits();
		}

		$this->seed->patch = json_encode($rom->getWriteLog());
		$this->seed->build = Rom::BUILD;

		return $rom;
	}

	/**
	 * Save a seed record to DB
	 *
	 * @return string hash of record
	 */
	public function saveSeedRecord() {
		$this->seed->logic = static::LOGIC;
		$this->seed->rules = $this->difficulty;
		$this->seed->game_mode = $this->logic;
		$this->seed->save();

		return $this->seed->hash;
	}

	public function getSeedRecord() {
		return $this->seed;
	}

	/**
	 * Update patch of seed record to DB
	 *
	 * @param array $patch new patch that will be applies
	 *
	 * @return $this
	 */
	public function updateSeedRecordPatch($patch) {
		$this->seed->patch = json_encode($patch);
		$this->seed->save();

		return $this;
	}

	/**
	 * Randomize portions of the ending credits sequence
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return $this
	 */
	public function randomizeCredits(Rom $rom) {
		$rom->setKingsReturnCredits(array_first(fy_shuffle([
			"the return of the king",
			"fellowship of the ring",
			"the two towers",
		])));

		$rom->setSanctuaryCredits(array_first(fy_shuffle([
			"the loyal priest",
			"read a book",
			"sits in own pew",
		])));

		$name = array_first(fy_shuffle([
			"sahasralah", "sabotaging", "sacahuista", "sacahuiste", "saccharase", "saccharide", "saccharify",
			"saccharine", "saccharins", "sacerdotal", "sackcloths", "salmonella", "saltarelli", "saltarello",
			"saltations", "saltbushes", "saltcellar", "saltshaker", "salubrious", "sandgrouse", "sandlotter",
			"sandstorms", "sandwiched", "sauerkraut", "schipperke", "schismatic", "schizocarp", "schmalzier",
			"schmeering", "schmoosing", "shibboleth", "shovelnose", "sahananana", "sarararara", "salamander",
			"sharshalah", "shahabadoo", "sassafrass", "saddlebags", "sandalwood", "shagadelic", "sandcastle",
			"saltpeters", "shabbiness", "shlrshlrsh",
		]));
		$rom->setKakarikoTownCredits("$name's homecoming");

		$rom->setWoodsmansHutCredits(array_first(fy_shuffle([
			"twin lumberjacks",
			"fresh flapjacks",
			"two woodchoppers",
			"double lumberman",
			"lumberclones",
			"woodfellas",
			"dos axes",
		])));

		switch (get_random_int(0, 1)) {
			case 1:
				$rom->setSwordsmithsCredits("the dwarven breadsmiths");
				break;
		}

		$rom->setDeathMountainCredits(array_first(fy_shuffle([
			"the lost old man",
			"gary the old man",
			"Your ad here",
		])));

		$rom->setLostWoodsCredits(array_first(fy_shuffle([
			"the forest thief",
			"dancing pickles",
			"flying vultures",
		])));

		$rom->setWishingWellCredits(array_first(fy_shuffle([
			"venus. queen of faeries",
			"Venus was her name",
			"I'm your Venus",
			"Yeah, baby, she's got it",
			"Venus, I'm your fire",
			"Venus, At your desire",
		])));

		return $this;
	}

	/**
	 * Set all texts for this randomization
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return $this
	 */
	public function setTexts(Rom $rom) {
		$strings = cache()->rememberForever('strings', function() {
			return [
				'uncle' => array_filter(explode("\n-\n", preg_replace('/^-\n/', '', file_get_contents(base_path('strings/uncle.txt'))))),
				'tavern_man' => array_filter(explode("\n-\n", preg_replace('/^-\n/', '', file_get_contents(base_path('strings/tavern_man.txt'))))),
				'blind' => array_filter(explode("\n-\n", preg_replace('/^-\n/', '', file_get_contents(base_path('strings/blind.txt'))))),
				'ganon_1' => array_filter(explode("\n-\n", preg_replace('/^-\n/', '', file_get_contents(base_path('strings/ganon_1.txt'))))),
				'triforce' => array_filter(explode("\n-\n", preg_replace('/^-\n/', '', file_get_contents(base_path('strings/triforce.txt'))))),
			];
		});

		$boots_location = $this->world->getLocationsWithItem(Item::get('PegasusBoots'))->first();

		if ($this->config('spoil.BootsLocation', false) && get_random_int() % 20 == 0 && $boots_location) {
			Log::info('Boots revealed');
			switch ($boots_location->getName()) {
				case "Link's House":
					$rom->setUncleTextString("Lonk!\nYou'll never\nfind the boots");
					break;
				case "Maze Race":
					$rom->setUncleTextString("Boots at race?\nSeed confirmed\nimpossible.");
					break;
				default:
					$rom->setUncleTextString("Lonk! Boots\nare in the\n" . $boots_location->getRegion()->getName());
			}
		} else {
			$rom->setUncleTextString(array_first(fy_shuffle($strings['uncle'])));
		}

		$green_pendant_location = $this->world->getLocationsWithItem(Item::get('PendantOfCourage'))->first();

		$rom->setSahasrahla1TextString("Want something\nfor free? Go\nearn the green\npendant in\n"
			. $green_pendant_location->getRegion()->getName()
			. "\nand I'll give\nyou something.");

		$crystal5_location = $this->world->getLocationsWithItem(Item::get('Crystal5'))->first();
		$crystal6_location = $this->world->getLocationsWithItem(Item::get('Crystal6'))->first();

		$rom->setBombShop1TextString("bring me the\ncrystals from\n"
			. $crystal5_location->getRegion()->getName()
			. "\nand\n"
			. $crystal6_location->getRegion()->getName()
			. "\nso I can make\na big bomb!");

		$rom->setBlindTextString(array_first(fy_shuffle($strings['blind'])));

		$rom->setTavernManTextString(array_first(fy_shuffle($strings['tavern_man'])));

		$rom->setGanon1TextString(array_first(fy_shuffle($strings['ganon_1'])));

		switch ($this->goal) {
			case 'pedestal':
				$rom->setGanon1InvincibleTextString("You cannot\nkill me. You\nshould go for\nyour real goal\nIt's on the\npedestal.\n\nYou dingus!\n");
				break;
			case 'triforce-hunt':
				$rom->setGanon1InvincibleTextString("So you thought\nyou could come\nhere and beat\nme? I have\nhidden the\nTriforce\npieces well.\nWithout them,\nyou can't win!");
				break;
			default:
				$rom->setGanon1InvincibleTextString("You think you\nare ready to\nface me?\n\nI will not die\n\nunless you\ncomplete your\ngoals. Dingus!");
		}

		$rom->setGanon2InvincibleTextString("Got wax in\nyour ears?\nI cannot die!");

		$silver_arrows_location = $this->world->getLocationsWithItem(Item::get('SilverArrowUpgrade'))->first();
		if (!$silver_arrows_location) {
			$silver_arrows_location = $this->world->getLocationsWithItem(Item::get('BowAndSilverArrows'))->first();
		}

		if (!$silver_arrows_location) {
			$rom->setGanon2TextString("Did you find\nthe arrows on\nPlanet Zebes?");
		} else {
			switch ($silver_arrows_location->getRegion()->getName()) {
				case "Ganons Tower":
					$rom->setGanon2TextString("Did you find\nthe arrows in\nMy tower?");
					break;
				default:
					$rom->setGanon2TextString("Did you find\nthe arrows in\n" . $silver_arrows_location->getRegion()->getName());
			}

		}

		$rom->setTriforceTextString(array_first(fy_shuffle($strings['triforce'])));

		return $this;
	}

	/**
	 * Get a shuffled array of Item's necessary for giving access to more locations as well as completing the game.
	 *
	 * @return array
	 */
	public function getAdvancementItems() {
		$advancement_items = [];

		for ($i = 0; $i < $this->config('item.count.L1Sword', 0); $i++) {
			array_push($advancement_items, Item::get('L1Sword'));
		}
		for ($i = 0; $i < $this->config('item.count.MasterSword', 0); $i++) {
			array_push($advancement_items, Item::get('MasterSword'));
		}

		for ($i = 0; $i < $this->config('item.count.ProgressiveSword', 4); $i++) {
			array_push($advancement_items, Item::get('ProgressiveSword'));
		}

		for ($i = 0; $i < $this->config('item.count.Bottles', 4); $i++) {
			array_push($advancement_items, $this->getBottle());
		}
		for ($i = 0; $i < $this->config('item.count.Bombos', 1); $i++) {
			array_push($advancement_items, Item::get('Bombos'));
		}
		for ($i = 0; $i < $this->config('item.count.BookOfMudora', 1); $i++) {
			array_push($advancement_items, Item::get('BookOfMudora'));
		}
		for ($i = 0; $i < $this->config('item.count.Bow', 1); $i++) {
			array_push($advancement_items, Item::get('Bow'));
		}
		for ($i = 0; $i < $this->config('item.count.CaneOfSomaria', 1); $i++) {
			array_push($advancement_items, Item::get('CaneOfSomaria'));
		}
		for ($i = 0; $i < $this->config('item.count.Cape', 1); $i++) {
			array_push($advancement_items, Item::get('Cape'));
		}
		for ($i = 0; $i < $this->config('item.count.Ether', 1); $i++) {
			array_push($advancement_items, Item::get('Ether'));
		}
		for ($i = 0; $i < $this->config('item.count.FireRod', 1); $i++) {
			array_push($advancement_items, Item::get('FireRod'));
		}
		for ($i = 0; $i < $this->config('item.count.Flippers', 1); $i++) {
			array_push($advancement_items, Item::get('Flippers'));
		}
		for ($i = 0; $i < $this->config('item.count.Hammer', 1); $i++) {
			array_push($advancement_items, Item::get('Hammer'));
		}
		for ($i = 0; $i < $this->config('item.count.Hookshot', 1); $i++) {
			array_push($advancement_items, Item::get('Hookshot'));
		}
		for ($i = 0; $i < $this->config('item.count.IceRod', 1); $i++) {
			array_push($advancement_items, Item::get('IceRod'));
		}
		for ($i = 0; $i < $this->config('item.count.Lamp', 1); $i++) {
			array_push($advancement_items, Item::get('Lamp'));
		}
		for ($i = 0; $i < $this->config('item.count.MagicMirror', 1); $i++) {
			array_push($advancement_items, Item::get('MagicMirror'));
		}
		for ($i = 0; $i < $this->config('item.count.MoonPearl', 1); $i++) {
			array_push($advancement_items, Item::get('MoonPearl'));
		}
		for ($i = 0; $i < $this->config('item.count.Mushroom', 1); $i++) {
			array_push($advancement_items, Item::get('Mushroom'));
		}
		for ($i = 0; $i < $this->config('item.count.OcarinaInactive', 1); $i++) {
			array_push($advancement_items, Item::get('OcarinaInactive'));
		}
		for ($i = 0; $i < $this->config('item.count.OcarinaActive', 0); $i++) {
			array_push($advancement_items, Item::get('OcarinaActive'));
		}
		for ($i = 0; $i < $this->config('item.count.PegasusBoots', 1); $i++) {
			array_push($advancement_items, Item::get('PegasusBoots'));
		}
		for ($i = 0; $i < $this->config('item.count.Powder', 1); $i++) {
			array_push($advancement_items, Item::get('Powder'));
		}
		for ($i = 0; $i < $this->config('item.count.PowerGlove', 0); $i++) {
			array_push($advancement_items, Item::get('PowerGlove'));
		}
		for ($i = 0; $i < $this->config('item.count.Quake', 1); $i++) {
			array_push($advancement_items, Item::get('Quake'));
		}
		for ($i = 0; $i < $this->config('item.count.Shovel', 1); $i++) {
			array_push($advancement_items, Item::get('Shovel'));
		}
		for ($i = 0; $i < $this->config('item.count.TitansMitt', 0); $i++) {
			array_push($advancement_items, Item::get('TitansMitt'));
		}

		for ($i = 0; $i < $this->config('item.count.BowAndSilverArrows', 0); $i++) {
			array_push($advancement_items, Item::get('BowAndSilverArrows'));
		}
		for ($i = 0; $i < $this->config('item.count.SilverArrowUpgrade', 1); $i++) {
			array_push($advancement_items, Item::get('SilverArrowUpgrade'));
		}

		for ($i = 0; $i < $this->config('item.count.ProgressiveGlove', 2); $i++) {
			array_push($advancement_items, Item::get('ProgressiveGlove'));
		}

		for ($i = 0; $i < $this->config('item.count.TriforcePiece', 0); $i++) {
			array_push($advancement_items, Item::get('TriforcePiece'));
		}

		for ($i = 0; $i < $this->config('item.count.PowerStar', 0); $i++) {
			array_push($advancement_items, Item::get('PowerStar'));
		}

		for ($i = 0; $i < $this->config('item.count.BugCatchingNet', 1); $i++) {
			array_push($advancement_items, Item::get('BugCatchingNet'));
		}

		for ($i = 0; $i < $this->config('item.count.MirrorShield', 0); $i++) {
			array_push($advancement_items, Item::get('MirrorShield'));
		}

		for ($i = 0; $i < $this->config('item.count.ProgressiveShield', 3); $i++) {
			array_push($advancement_items, Item::get('ProgressiveShield'));
		}

		for ($i = 0; $i < $this->config('item.count.CaneOfByrna', 1); $i++) {
			array_push($advancement_items, Item::get('CaneOfByrna'));
		}

		for ($i = 0; $i < $this->config('item.count.TenBombs', 1); $i++) {
			array_push($advancement_items, Item::get('TenBombs'));
		}

		for ($i = 0; $i < $this->config('item.count.HalfMagic', 1); $i++) {
			array_push($advancement_items, Item::get('HalfMagic'));
		}

		for ($i = 0; $i < $this->config('item.count.QuarterMagic', 0); $i++) {
			array_push($advancement_items, Item::get('QuarterMagic'));
		}

		return $advancement_items;
	}

	/**
	 * Get all the Items to insert into the Locations Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getNiceItems() {
		$items_to_find = [];

		for ($i = 0; $i < $this->config('item.count.L3Sword', 0); $i++) {
			array_push($items_to_find, Item::get('L3Sword'));
		}
		for ($i = 0; $i < $this->config('item.count.L4Sword', 0); $i++) {
			array_push($items_to_find, Item::get('L4Sword'));
		}

		for ($i = 0; $i < $this->config('item.count.HeartContainer', 1); $i++) {
			array_push($items_to_find, Item::get('HeartContainer'));
		}
		for ($i = 0; $i < $this->config('item.count.BossHeartContainer', 10); $i++) {
			array_push($items_to_find, Item::get('BossHeartContainer'));
		}

		for ($i = 0; $i < $this->config('item.count.BlueShield', 0); $i++) {
			array_push($items_to_find, Item::get('BlueShield'));
		}

		for ($i = 0; $i < $this->config('item.count.ProgressiveArmor', 2); $i++) {
			array_push($items_to_find, Item::get('ProgressiveArmor'));
		}

		for ($i = 0; $i < $this->config('item.count.BlueMail', 0); $i++) {
			array_push($items_to_find, Item::get('BlueMail'));
		}
		for ($i = 0; $i < $this->config('item.count.Boomerang', 1); $i++) {
			array_push($items_to_find, Item::get('Boomerang'));
		}

		for ($i = 0; $i < $this->config('item.count.RedBoomerang', 1); $i++) {
			array_push($items_to_find, Item::get('RedBoomerang'));
		}
		for ($i = 0; $i < $this->config('item.count.RedShield', 0); $i++) {
			array_push($items_to_find, Item::get('RedShield'));
		}
		for ($i = 0; $i < $this->config('item.count.RedMail', 0); $i++) {
			array_push($items_to_find, Item::get('RedMail'));
		}

		for ($i = 0; $i < $this->config('item.count.BlueClock', 0); $i++) {
			array_push($items_to_find, Item::get('BlueClock'));
		}
		for ($i = 0; $i < $this->config('item.count.RedClock', 0); $i++) {
			array_push($items_to_find, Item::get('RedClock'));
		}
		for ($i = 0; $i < $this->config('item.count.GreenClock', 0); $i++) {
			array_push($items_to_find, Item::get('GreenClock'));
		}

		return $items_to_find;
	}

	/**
	 * Get all the Items to insert into the Locations Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getItemPool() {
		$items_to_find = [];

		for ($i = 0; $i < $this->config('item.count.PieceOfHeart', 24); $i++) {
			array_push($items_to_find, Item::get('PieceOfHeart'));
		}

		for ($i = 0; $i < $this->config('item.count.BombUpgrade5', 6); $i++) {
			array_push($items_to_find, Item::get('BombUpgrade5'));
		}
		for ($i = 0; $i < $this->config('item.count.BombUpgrade10', 1); $i++) {
			array_push($items_to_find, Item::get('BombUpgrade10'));
		}
		for ($i = 0; $i < $this->config('item.count.ArrowUpgrade5', 6); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade5'));
		}
		for ($i = 0; $i < $this->config('item.count.ArrowUpgrade10', 1); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade10'));
		}

		for ($i = 0; $i < $this->config('item.count.Arrow', 1); $i++) {
			array_push($items_to_find, Item::get('Arrow'));
		}
		for ($i = 0; $i < $this->config('item.count.TenArrows', 5); $i++) {
			array_push($items_to_find, Item::get('TenArrows'));
		}

		for ($i = 0; $i < $this->config('item.count.Bomb', 0); $i++) {
			array_push($items_to_find, Item::get('Bomb'));
		}
		for ($i = 0; $i < $this->config('item.count.ThreeBombs', 9); $i++) {
			array_push($items_to_find, Item::get('ThreeBombs'));
		}

		for ($i = 0; $i < $this->config('item.count.OneRupee', 2); $i++) {
			array_push($items_to_find, Item::get('OneRupee'));
		}
		for ($i = 0; $i < $this->config('item.count.FiveRupees', 4); $i++) {
			array_push($items_to_find, Item::get('FiveRupees'));
		}
		for ($i = 0; $i < $this->config('item.count.TwentyRupees', 28); $i++) {
			array_push($items_to_find, Item::get('TwentyRupees'));
		}
		for ($i = 0; $i < $this->config('item.count.FiftyRupees', 7); $i++) {
			array_push($items_to_find, Item::get('FiftyRupees'));
		}
		for ($i = 0; $i < $this->config('item.count.OneHundredRupees', 1); $i++) {
			array_push($items_to_find, Item::get('OneHundredRupees'));
		}
		for ($i = 0; $i < $this->config('item.count.ThreeHundredRupees', 5); $i++) {
			array_push($items_to_find, Item::get('ThreeHundredRupees'));
		}

		for ($i = 0; $i < $this->config('item.count.Heart', 0); $i++) {
			array_push($items_to_find, Item::get('Heart'));
		}

		for ($i = 0; $i < $this->config('item.count.Rupoor', 0); $i++) {
			array_push($items_to_find, Item::get('Rupoor'));
		}

		return $items_to_find;
	}

	public function getDungeonPool() {
		$items_to_find = [];

		for ($i = 0; $i < $this->config('item.count.BigKeyA2', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyA2'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyD1', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyD1'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyD2', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyD2'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyD3', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyD3'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyD4', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyD4'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyD5', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyD5'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyD6', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyD6'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyD7', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyD7'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyP1', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyP1'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyP2', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyP2'));
		}
		for ($i = 0; $i < $this->config('item.count.BigKeyP3', 1); $i++) {
			array_push($items_to_find, Item::get('BigKeyP3'));
		}

		for ($i = 0; $i < $this->config('item.count.KeyA2', 4); $i++) {
			array_push($items_to_find, Item::get('KeyA2'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyD1', 6); $i++) {
			array_push($items_to_find, Item::get('KeyD1'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyD2', 1); $i++) {
			array_push($items_to_find, Item::get('KeyD2'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyD3', 2); $i++) {
			array_push($items_to_find, Item::get('KeyD3'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyD4', 1); $i++) {
			array_push($items_to_find, Item::get('KeyD4'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyD5', 2); $i++) {
			array_push($items_to_find, Item::get('KeyD5'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyD6', 3); $i++) {
			array_push($items_to_find, Item::get('KeyD6'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyD7', 4); $i++) {
			array_push($items_to_find, Item::get('KeyD7'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyA1', 2); $i++) {
			array_push($items_to_find, Item::get('KeyA1'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyH2', 1); $i++) {
			array_push($items_to_find, Item::get('KeyH2'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyP2', 1); $i++) {
			array_push($items_to_find, Item::get('KeyP2'));
		}
		for ($i = 0; $i < $this->config('item.count.KeyP3', 1); $i++) {
			array_push($items_to_find, Item::get('KeyP3'));
		}

		for ($i = 0; $i < $this->config('item.count.MapA2', 1); $i++) {
			array_push($items_to_find, Item::get('MapA2'));
		}
		for ($i = 0; $i < $this->config('item.count.MapD1', 1); $i++) {
			array_push($items_to_find, Item::get('MapD1'));
		}
		for ($i = 0; $i < $this->config('item.count.MapD2', 1); $i++) {
			array_push($items_to_find, Item::get('MapD2'));
		}
		for ($i = 0; $i < $this->config('item.count.MapD3', 1); $i++) {
			array_push($items_to_find, Item::get('MapD3'));
		}
		for ($i = 0; $i < $this->config('item.count.MapD4', 1); $i++) {
			array_push($items_to_find, Item::get('MapD4'));
		}
		for ($i = 0; $i < $this->config('item.count.MapD5', 1); $i++) {
			array_push($items_to_find, Item::get('MapD5'));
		}
		for ($i = 0; $i < $this->config('item.count.MapD6', 1); $i++) {
			array_push($items_to_find, Item::get('MapD6'));
		}
		for ($i = 0; $i < $this->config('item.count.MapD7', 1); $i++) {
			array_push($items_to_find, Item::get('MapD7'));
		}
		for ($i = 0; $i < $this->config('item.count.MapH2', 1); $i++) {
			array_push($items_to_find, Item::get('MapH2'));
		}
		for ($i = 0; $i < $this->config('item.count.MapP1', 1); $i++) {
			array_push($items_to_find, Item::get('MapP1'));
		}
		for ($i = 0; $i < $this->config('item.count.MapP2', 1); $i++) {
			array_push($items_to_find, Item::get('MapP2'));
		}
		for ($i = 0; $i < $this->config('item.count.MapP3', 1); $i++) {
			array_push($items_to_find, Item::get('MapP3'));
		}

		for ($i = 0; $i < $this->config('item.count.CompassA2', 1); $i++) {
			array_push($items_to_find, Item::get('CompassA2'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassD1', 1); $i++) {
			array_push($items_to_find, Item::get('CompassD1'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassD2', 1); $i++) {
			array_push($items_to_find, Item::get('CompassD2'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassD3', 1); $i++) {
			array_push($items_to_find, Item::get('CompassD3'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassD4', 1); $i++) {
			array_push($items_to_find, Item::get('CompassD4'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassD5', 1); $i++) {
			array_push($items_to_find, Item::get('CompassD5'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassD6', 1); $i++) {
			array_push($items_to_find, Item::get('CompassD6'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassD7', 1); $i++) {
			array_push($items_to_find, Item::get('CompassD7'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassP1', 1); $i++) {
			array_push($items_to_find, Item::get('CompassP1'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassP2', 1); $i++) {
			array_push($items_to_find, Item::get('CompassP2'));
		}
		for ($i = 0; $i < $this->config('item.count.CompassP3', 1); $i++) {
			array_push($items_to_find, Item::get('CompassP3'));
		}

		return $items_to_find;
	}

	/**
	 * Get all the drops to insert into the PrizePackSlots Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getDropsPool() {
		$drops = [];

		for ($i = 0; $i < $this->config('drop.count.Heart', 13); $i++) {
			array_push($drops, Sprite::get('Heart'));
		}
		for ($i = 0; $i < $this->config('drop.count.RupeeGreen', 9); $i++) {
			array_push($drops, Sprite::get('RupeeGreen'));
		}
		for ($i = 0; $i < $this->config('drop.count.RupeeBlue', 7); $i++) {
			array_push($drops, Sprite::get('RupeeBlue'));
		}
		for ($i = 0; $i < $this->config('drop.count.RupeeRed', 6); $i++) {
			array_push($drops, Sprite::get('RupeeRed'));
		}
		for ($i = 0; $i < $this->config('drop.count.BombRefill1', 7); $i++) {
			array_push($drops, Sprite::get('BombRefill1'));
		}
		for ($i = 0; $i < $this->config('drop.count.BombRefill4', 1); $i++) {
			array_push($drops, Sprite::get('BombRefill4'));
		}
		for ($i = 0; $i < $this->config('drop.count.BombRefill8', 2); $i++) {
			array_push($drops, Sprite::get('BombRefill8'));
		}
		for ($i = 0; $i < $this->config('drop.count.MagicRefillSmall', 6); $i++) {
			array_push($drops, Sprite::get('MagicRefillSmall'));
		}
		for ($i = 0; $i < $this->config('drop.count.MagicRefillFull', 3); $i++) {
			array_push($drops, Sprite::get('MagicRefillFull'));
		}
		for ($i = 0; $i < $this->config('drop.count.ArrowRefill5', 5); $i++) {
			array_push($drops, Sprite::get('ArrowRefill5'));
		}
		for ($i = 0; $i < $this->config('drop.count.ArrowRefill10', 3); $i++) {
			array_push($drops, Sprite::get('ArrowRefill10'));
		}
		for ($i = 0; $i < $this->config('drop.count.Fairy', 1); $i++) {
			array_push($drops, Sprite::get('Fairy'));
		}
		for ($i = 0; $i < $this->config('drop.count.BeeGood', 0); $i++) {
			array_push($drops, Sprite::get('BeeGood'));
		}
		for ($i = 0; $i < $this->config('drop.count.Bee', 0); $i++) {
			array_push($drops, Sprite::get('Bee'));
		}

		return $drops;
	}

	/**
	 * This is a quick hack to get prizes shuffled, will adjust later when we model sprites.
	 * this now also handles prize pull trees.
	 *
	 * @TODO: move remaining writes to Rom class
	 */
	public function writePrizePacksToRom(Rom $rom) {
		$emptyDrops = $this->world->getEmptyDropSlots();
		$dropsPool = fy_shuffle($this->getDropsPool());

		for($i = 0; $i < count($emptyDrops); $i++) {
			$curDrop = $dropsPool[$i];
			$emptyDrops[$i]->setDrop($curDrop);
		}

		$drop_bytes = array_map(function($prize) {
			return $prize->getDrop()->getBytes()[0];
		}, $this->world->getAllDrops());

		if ($this->config('rom.rupeeBow', false)) {
			$drop_bytes = str_replace([0xE1, 0xE2], [0xDA, 0xDB], $drop_bytes);
			$rom->setOverworldDigPrizes([
					0xB2, 0xD8, 0xD8, 0xD8,
					0xD8, 0xD8, 0xD8, 0xD8, 0xD8,
					0xD9, 0xD9, 0xD9, 0xD9, 0xD9,
					0xDA, 0xDA, 0xDA, 0xDA, 0xDA,
					0xDB, 0xDB, 0xDB, 0xDB, 0xDB,
					0xDC, 0xDC, 0xDC, 0xDC, 0xDC,
					0xDD, 0xDD, 0xDD, 0xDD, 0xDD,
					0xDE, 0xDE, 0xDE, 0xDE, 0xDE,
					0xDF, 0xDF, 0xDF, 0xDF, 0xDF,
					0xE0, 0xE0, 0xE0, 0xE0, 0xE0,
					0xDA, 0xDA, 0xDA, 0xDA, 0xDA,
					0xDB, 0xDB, 0xDB, 0xDB, 0xDB,
					0xE3, 0xE3, 0xE3, 0xE3, 0xE3,
				]);
		}

		// write to prize packs
		$rom->write(0x37A78, pack('C*', ...array_slice($drop_bytes, 0, 56)));

		// write to trees
		$rom->setPullTreePrizes($drop_bytes[56], $drop_bytes[57], $drop_bytes[58]);

		// write to prize crab
		$rom->setRupeeCrabPrizes($drop_bytes[59], $drop_bytes[60]);

		// write to stunned
		$rom->setStunnedSpritePrize($drop_bytes[61]);

		// write to saved fish
		$rom->setFishSavePrize($drop_bytes[62]);

		// Sprite prize pack
		$idat = array_values(unpack('C*', base64_decode(
			"g5aEgICAgIACAAKAoIOXgICUkQcAgACAkpaAoAAAAIAEgIIGBgAAgICAgICAgICAgICAgICAgICAgIAAAICAkICRkZGXkZWVk5c" .
			"UkZKBgoKAhYCAgAQEgJGAgICAgICAgACAgIKKgICAgJKRgIKBgYCBgICAgICAgICAgJeAgICAwoAVFRcGAIAAwBNAAAIGEBQAAE" .
			"AAAAAAE0YRgIAAAAAQAAAAFhYWgYeCAICAAAAAAICAAAAAAAAAAAAAAAAAAAAAgAAAABcAEgAAAAAAEBcAQAEAAAAAAAAAAAAAA" .
			"AAAAABAAAAAAAAAAACAAAAAAAAA"
		)));
		$offset = 0x6B632;
		$bytes = $rom->read($offset, 243);
		foreach ($bytes as $i => $v) {
			$bytes[$i] = ($v == 0) ? $idat[$i] : $v;
		}
		for ($i = 0; $i < 243; $i++) {
			// skip sprites that were not in prize packs before
			if (!isset($bytes[$i]) || ($bytes[$i] & 0xF) == 0) {
				continue;
			}
			$rom->write($offset + $i, pack('C*', ($bytes[$i] >> 4 << 4) + get_random_int(1, 7)));
		}

		// Pack drop chance
		switch ($this->config('rom.HardMode', 0)) {
			case 3:
			case 2:
				list($low, $high) = [2, 2]; // 25%
				break;
			case -1:
				list($low, $high) = [0, 0]; // 100%
				break;
			case 1:
			default:
				list($low, $high) = [1, 1]; // 50%
		}
		$offset = 0x37A62;
		for ($i = 0; $i < 7; $i++) {
			$rom->write($offset + $i, pack('C*', pow(2, get_random_int($low, $high)) - 1));
		}
	}

	/**
	 * This is a quick hack to get prizes shuffled, will adjust later when we model sprites.
	 * this now also handles prize pull trees.
	 *
	 * @TODO: create sprite classes
	 * @TODO: create prize pack classes
	 * @TODO: move remaining writes to Rom class
	 */
	public function writeOverworldBonkPrizeToRom(Rom $rom) {
		// over world bonk things
		$prizes = [
			0x79, 0xE3, 0x79, 0xAC, 0xAC, 0xE0, 0xDC, 0xAC,
			0xE3, 0xE3, 0xDA, 0xE3, 0xDA, 0xD8, 0xAC, 0xAC,
			0xE3, 0xD8, 0xE3, 0xE3, 0xE3, 0xE3, 0xE3, 0xE3,
			0xDC, 0xDB, 0xE3, 0xDA, 0x79, 0x79, 0xE3, 0xE3,
			0xDA, 0x79, 0xAC, 0xAC, 0x79, 0xE3, 0x79, 0xAC,
			0xAC, 0xE0, 0xDC, 0xE3, 0x79, 0xDE, 0xE3, 0xAC,
			0xDB, 0x79, 0xE3, 0xD8, 0xAC, 0x79, 0xE3, 0xDB,
			0xDB, 0xE3, 0xE3, 0x79, 0xD8, 0xDD
		];
		$shuffled = fy_shuffle($prizes);

		$rom->setOverworldBonkPrizes($shuffled);
	}

	/**
	 * Get a random bottle item
	 *
	 * @param boolean $filled return only a filled bottle
	 *
	 * @return Item
	 */
	public function getBottle($filled = false) {
		$bottles = [
			Item::get('Bottle'),
			Item::get('BottleWithRedPotion'),
			Item::get('BottleWithGreenPotion'),
			Item::get('BottleWithBluePotion'),
			Item::get('BottleWithBee'),
			Item::get('BottleWithGoldBee'),
			Item::get('BottleWithFairy'),
		];

		return $bottles[get_random_int($filled ? 1 : 0, count($bottles) - (($this->config('rom.HardMode', 0) > 0) ? 2 : 1))];
	}

	/**
	 * Get the World associated with the Randomizer
	 *
	 * @return World
	 */
	public function getWorld() {
		return $this->world;
	}

	/**
	 * Set the World associated with the Randomizer. Of note the world can be different rules that the Randomizer.
	 * Use this "feature" with caution.
	 *
	 * @param World $world World to assocate to Randomizer
	 *
	 * @return $this
	 */
	public function setWorld(World $world) : self {
		$this->world = $world;

		$this->starting_equipment = $this->starting_equipment->merge($world->getPreCollectedItems());
		$this->world->setPreCollectedItems($this->starting_equipment);

		return $this;
	}
}
