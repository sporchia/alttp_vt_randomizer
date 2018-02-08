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
	const LOGIC = 29;
	protected $rng_seed;
	protected $seed;
	protected $world;
	protected $difficulty;
	protected $variation;
	protected $logic;
	protected $starting_equipment;
	static protected $logic_array = [
		0x23, 0xCD, 0xB6, 0xA5, 0xEC, 0xF8, 0xC1, 0x80,0x8B, 0x53, 0x88, 0xA8, 0xB9, 0x22, 0xD9, 0x29,
		0xC4, 0x52, 0xBA, 0xD7, 0xC2, 0xE0, 0x43, 0x2B,0x0D, 0x9F, 0x66, 0x7A, 0x98, 0xDA, 0xBC, 0x05,
		0xB2, 0xF0, 0xA9, 0xFE, 0x27, 0x4C, 0x31, 0x9E,0xFD, 0x3F, 0xEA, 0x72, 0x2E, 0x39, 0xF3, 0x94,
		0x7C, 0x44, 0xA3, 0x60, 0x42, 0x5C, 0x84, 0x50,0xCE, 0x38, 0x6C, 0x03, 0xDF, 0xC9, 0x58, 0xD5,
		0x7F, 0x55, 0x54, 0x33, 0x12, 0x0E, 0x59, 0xA1,0x7B, 0xCC, 0x3C, 0xAE, 0x90, 0x01, 0xAA, 0xA4,
		0x76, 0xEE, 0xE9, 0x17, 0x4A, 0xB1, 0xFB, 0x77,0xE3, 0x16, 0xF7, 0x1E, 0x1D, 0xFC, 0x0B, 0x8A,
		0x3A, 0x10, 0x24, 0x5A, 0xCB, 0x19, 0x2C, 0x11,0xB4, 0xF6, 0x8F, 0x70, 0xDD, 0xF2, 0xF1, 0x7E,
		0x9B, 0x0F, 0x5D, 0x32, 0xBD, 0xC7, 0x07, 0x4E,0x20, 0x47, 0x69, 0x34, 0x74, 0x0A, 0x89, 0x92,
		0x82, 0xE6, 0x9A, 0xD8, 0x06, 0xB0, 0xF4, 0x67,0xD0, 0x4D, 0x64, 0x6E, 0x83, 0x6A, 0x61, 0x09,
		0x37, 0x71, 0x45, 0x49, 0xFF, 0x57, 0xA7, 0x91,0x97, 0xAB, 0x40, 0x08, 0x46, 0x00, 0xFA, 0xB5,
		0x8D, 0x1B, 0x79, 0xD1, 0x30, 0x13, 0x68, 0xAC,0xE2, 0x21, 0x87, 0x02, 0xAD, 0x75, 0x14, 0x96,
		0xA6, 0x65, 0xDC, 0xD3, 0x28, 0x6D, 0x5F, 0x86,0x2D, 0xF5, 0x15, 0x3D, 0xB7, 0x99, 0xD6, 0x04,
		0xBE, 0x73, 0x51, 0x35, 0xE7, 0x8C, 0xBB, 0x36,0x0C, 0x95, 0xC8, 0x25, 0xCF, 0x1C, 0xA0, 0xB3,
		0x7D, 0x78, 0x4F, 0x18, 0x9D, 0x56, 0xA2, 0xCA,0xEB, 0xE8, 0x93, 0xC0, 0xDB, 0x81, 0x62, 0xED,
		0xE1, 0x6B, 0x63, 0x2A, 0xF9, 0x8E, 0xDE, 0xB8,0x26, 0x1F, 0xC3, 0xEF, 0x4B, 0x6F, 0x48, 0x85,
		0xAF, 0xC5, 0x41, 0x2F, 0x5E, 0xD2, 0x9C, 0xD4,0x3E, 0xC6, 0xE5, 0x1A, 0x5B, 0x3B, 0xE4, 0xBF,
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
		]);
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
		mt_srand($rng_seed);
		$this->seed->seed = $rng_seed;

		// BIG NOTE!!! in php 7.1 mt_srand changes how it seeds, so versions > 7.1 will create different results -_-
		if (defined('MT_RAND_PHP')) {
			mt_srand($rng_seed, MT_RAND_PHP);
		}

		Log::info(sprintf("Seed: %s", $this->rng_seed));

		$regions = $this->world->getRegions();

		// Set up World before we fill dungeons
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

		// Pedestal is the goal
		if ($this->goal == 'pedestal') {
			$locations["Master Sword Pedestal"]->setItem(Item::get('Triforce'));
		}

		if ($this->logic == 'MajorGlitches') {
			// MajorGlitches always has 4 bottles, no matter what
			config(["alttp.{$this->difficulty}.variations.{$this->variation}.item.overflow.count.Bottle" => 4]);
			$this->starting_equipment->addItem(Item::get('PegasusBoots'));
		}

		if ($this->logic == 'OverworldGlitches') {
			$this->starting_equipment->addItem(Item::get('PegasusBoots'));
		}

		// at this point we have filled all the base locations that will affect the rest of the actual item placements
		$advancement_items = $this->getAdvancementItems();

		// take out all the swords and silver arrows
		$nice_items = $this->getNiceItems();
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
		if (config('game-mode') != 'swordless') {
			// put 1 sword back
			if (count($nice_items_swords)) {
				array_push($advancement_items, array_pop($nice_items_swords));
			}
			// 2 in open mode
			if (config('game-mode') == 'open' && count($nice_items_swords)) {
				array_push($advancement_items, array_pop($nice_items_swords));
			} elseif ($this->config('region.forceUncleSword', true)) {
				$this->world->getLocation("Link's Uncle")->setItem(array_pop($nice_items_swords));
			}

			$nice_items = array_merge($nice_items, $nice_items_swords);
		} else {
			// In swordless we need to catch all swords
			foreach ($nice_items as $key => $item) {
				if (is_a($item, Item\Sword::class)) {
					unset($nice_items[$key]);
					$nice_items_swords[] = $item;
				}
			}
			// In swordless mode silvers are 100% required
			foreach ($nice_items_swords as $unneeded) {
				array_push($nice_items, Item::get('TwentyRupees2'));
			}
			$world_items = $this->world->collectItems()->values();
			if (!in_array(Item::get('SilverArrowUpgrade'), $world_items) && !in_array(Item::get('BowAndSilverArrows'), $world_items)) {
				if (array_search(Item::get('SilverArrowUpgrade'), $nice_items) === false && $this->difficulty !== 'custom') {
					$nice_items[] = Item::get('SilverArrowUpgrade');
				}
			}
		}
		// put 1 bottle back
		if (count($nice_items_bottles)) {
			array_push($advancement_items, array_pop($nice_items_bottles));
		}
		$nice_items = array_merge($nice_items, $nice_items_bottles);

		// Remaining Items
		$trash_items = ($this->config('rng_items'))
			? array_fill(0, count($this->getItemPool()), Item::get('singleRNG'))
			: $this->getItemPool();

		$dungeon_items = $this->getDungeonPool();

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
				if ($item instanceof Item\Key && (in_array(config('game-mode'), ['open', 'swordless']) || $item != Item::get('KeyH2'))) {
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

		$advancement_items = mt_shuffle($advancement_items);

		Filler::factory('RandomAssumed', $this->world)->fill($dungeon_items, $advancement_items, $nice_items, $trash_items);

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

		$remaining_prizes = mt_shuffle(array_diff([
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
					$place_prizes)));
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
					$place_prizes)));
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

			$medallion = $medallions[mt_rand(0, 2)];
			$medallion_location->setItem($medallion);
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
					|| $item instanceof Item\Upgrade\Bomb) {
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
					$spoiler[$name][$location->getName()] = $location->getItem()->getNiceName();
				} else {
					$spoiler[$name][$location->getName()] = 'Nothing';
				}
			});
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
			'mode' => config('game-mode', 'standard'),
		]);

		if ($this->config('rom.HardMode', 0)) {
			$spoiler['meta']['difficulty_mode'] = config('alttp.randomizer.item.difficulty_adjustments.' . $this->config('rom.HardMode', 0));
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
	public function config($key, $default = null) {
		return config("alttp.{$this->difficulty}.variations.{$this->variation}.$key",
			config("alttp.goals.{$this->goal}.$key",
				config("alttp.{$this->difficulty}.$key", $default)));
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
		$rom->setLockAgahnimDoorInEscape(false);
		$rom->setWishingWellChests(true);
		$rom->setWishingWellUpgrade(false);
		$rom->setLimitProgressiveSword($this->config('item.overflow.count.Sword', 4),
			Item::get($this->config('item.overflow.replacement.Sword', 'TwentyRupees'))->getBytes()[0]);
		$rom->setLimitProgressiveShield($this->config('item.overflow.count.Shield', 3),
			Item::get($this->config('item.overflow.replacement.Shield', 'TwentyRupees'))->getBytes()[0]);
		$rom->setLimitProgressiveArmor($this->config('item.overflow.count.Armor', 2),
			Item::get($this->config('item.overflow.replacement.Armor', 'TwentyRupees'))->getBytes()[0]);
		$rom->setLimitBottle($this->config('item.overflow.count.Bottle', 4),
			Item::get($this->config('item.overflow.replacement.Bottle', 'TwentyRupees'))->getBytes()[0]);

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

		$rom->setMapMode($this->config('rom.mapOnPickup', false));
		$rom->setCompassMode($this->config('rom.compassOnPickup', 'off'));
		$rom->setFreeItemTextMode($this->config('rom.freeItemText', false));
		$rom->setFreeItemMenu($this->config('rom.freeItemMenu', false));
		$rom->setDiggingGameRng(mt_rand(1, 30));

		$rom->writeRNGBlock(function() {
			return mt_rand(0, 0x100);
		});

		if ($this->config('sprite.shufflePrizePack', true)) {
			$this->writePrizeShuffleToRom($rom);
		}

		if ($this->config('sprite.shuffleOverworldBonkPrizes', false)) {
			$this->writeOverworldBonkPrizeToRom($rom);
		}

		$rom->setPyramidFairyChests($this->config('region.swordsInPool', true));
		$rom->setSmithyQuickItemGive($this->config('region.swordsInPool', true));

		$rom->setOpenMode(in_array(config('game-mode'), ['open', 'swordless']));
		$rom->setSwordlessMode(config('game-mode') == 'swordless');

		if (in_array(config('game-mode'), ['open', 'swordless'])) {
			$rom->removeUnclesSword();
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

		$rom->removeUnclesShield();

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
		$rom->setKingsReturnCredits(array_first(mt_shuffle([
			"the return of the king",
			"fellowship of the ring",
			"the two towers",
		])));

		$rom->setSanctuaryCredits(array_first(mt_shuffle([
			"the loyal priest",
			"read a book",
			"sits in own pew",
		])));

		$name = array_first(mt_shuffle([
			"sahasralah", "sabotaging", "sacahuista", "sacahuiste", "saccharase", "saccharide", "saccharify",
			"saccharine", "saccharins", "sacerdotal", "sackcloths", "salmonella", "saltarelli", "saltarello",
			"saltations", "saltbushes", "saltcellar", "saltshaker", "salubrious", "sandgrouse", "sandlotter",
			"sandstorms", "sandwiched", "sauerkraut", "schipperke", "schismatic", "schizocarp", "schmalzier",
			"schmeering", "schmoosing", "shibboleth", "shovelnose", "sahananana", "sarararara", "salamander",
			"sharshalah", "shahabadoo", "sassafrass",
		]));
		$rom->setKakarikoTownCredits("$name's homecoming");

		$rom->setWoodsmansHutCredits(array_first(mt_shuffle([
			"twin lumberjacks",
			"fresh flapjacks",
			"two woodchoppers",
			"double lumberman",
			"lumberclones",
			"woodfellas",
		])));

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setSwordsmithsCredits("the dwarven breadsmiths");
				break;
		}

		$rom->setDeathMountainCredits(array_first(mt_shuffle([
			"the lost old man",
			"gary the old man",
			"Your ad here",
		])));

		$rom->setLostWoodsCredits(array_first(mt_shuffle([
			"the forest thief",
			"dancing pickles",
			"flying vultures",
		])));

		$rom->setWishingWellCredits(array_first(mt_shuffle([
			"venus. queen of faeries",
			"Venus was her name",
			"I'm your Venus",
			"Yeah, baby, shes got it",
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
		$boots_location = $this->world->getLocationsWithItem(Item::get('PegasusBoots'))->first();

		if ($this->config('spoil.BootsLocation', false) && mt_rand() % 20 == 0 && $boots_location) {
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
			$rom->setUncleTextString(array_first(mt_shuffle([
				"We're out of\nWeetabix. To\nthe store!",
				"This seed is\nbootless\nuntil boots.",
				"Why do we only\nhave one bed?",
				"This is the\nonly textbox.",
				"I'm going to\ngo watch the\nMoth tutorial.",
				"This seed is\nthe worst.",
				"Chasing tail.\nFly ladies.\nDo not follow.",
				"I feel like\nI've done this\nbefore...",
				"Magic cape can\npass through\nthe barrier!",
				"If this is a\nKanzeon seed,\nI'm quitting.",
				"I am not your\nreal uncle.",
				"You're going\nto have a very\nbad time.",
				"Today you\nwill have\nbad luck.",
				"I am leaving\nforever.\nGoodbye.",
				"Don't worry.\nI got this\ncovered.",
				"Race you to\nthe castle!",
				"\n      hi",
				"I'M JUST GOING\nOUT FOR A\nPACK OF SMOKES",
				"It's dangerous\nto go alone.\nSee ya!",
				"ARE YOU A BAD\nENOUGH DUDE TO\nRESCUE ZELDA?",
				"\n\n    I AM ERROR",
				"This seed is\nsub 2 hours,\nguaranteed.",
				"The chest is\na secret to\neverybody.",
				"I'm off to\nfind the\nwind fish.",
				"The shortcut\nto Ganon\nis this way!",
				"THE MOON IS\nCRASHING! RUN\nFOR YOUR LIFE!",
				"Time to fight\nhe who must\nnot be named.",
				"RED MAIL\nIS FOR\nCOWARDS.",
				"HEY!\n\nLISTEN!",
				"Well\nexcuuuuuse me,\nprincess!",
				"5,000 Rupee\nreward for >\nYou're boned",
				"Welcome to\nStoops Lonk's\nHoose",
				"Erreur de\ntraduction.\nsvp reessayer",
				"I could beat\nit in an hour\nand one life",
				"I thought this\nwas open mode?",
			])));
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

		$rom->setBlindTextString(array_first(mt_shuffle([
			"I hate insect\npuns, they\nreally bug me.",
			"I haven't seen\nthe eye doctor\nin years",
			"I don't see\nyou having a\nbright future",
			"Are you doing\na blind run\nof this game?",
			"pizza joke? no\nI think it's a\nbit too cheesy",
			"A novice skier\noften jumps to\ncontusions.",
			"the beach?\nI'm not shore\nI can make it.",
			"Rental agents\noffer quarters\nfor dollars.",
			"I got my tires\nfixed for a\nflat rate.",
			"New lightbulb\ninvented?\nEnlighten me.",
			"A baker's job\nis a piece of\ncake.",
			"My optometrist\nsaid I have\nvision!",
			"when you're a\nbaker, don't\nloaf around",
			"mire requires\nether quake,\nor bombos",
			"Broken pencils\nare pointless.",
			"The food they\nserve guards\nlasts sentries",
			"being crushed\nby big objects\nis depressing.",
			"A tap dancer's\nroutine runs\nhot and cold.",
			"A weeknight is\na tiny\nnobleman",
			"The chimney\nsweep wore a\nsoot and tye.",
			"Gardeners like\nto spring into\naction.",
			"bad at nuclear\nphysics. I\nGot no fission",
		])));

		$rom->setTavernManTextString(array_first(mt_shuffle([
			"What do you\ncall a blind\ndinosaur?\nadoyouthink-\nhesaurus\n",
			"A blind man\nwalks into\na bar.\nAnd a table.\nAnd a chair.\n",
			"What do ducks\nlike to eat?\n\nQuackers!\n",
			"How do you\nset up a party\nin space?\n\nYou planet!\n",
			"I'm glad I\nknow sign\nlanguage,\nit's pretty\nhandy.\n",
			"What did Zelda\nsay to Link at\na secure door?\n\nTRIFORCE!\n",
			"I am on a\nseafood diet.\n\nEvery time\nI see food,\nI eat it.",
			"I've decided\nto sell my\nvacuum.\nIt was just\ngathering\ndust.",
			"Whats the best\ntime to go to\nthe dentist?\n\nTooth-hurtie!\n",
			"Why can't a\nbike stand on\nits own?\n\nIt's two-tired!\n",
			"If you haven't\nfound Quake\nyet…\nit's not your\nfault.",
			"Why is Peter\nPan always\nflying?\nBecause he\nNeverlands!",
			"I once told a\njoke to Armos.\n\nBut he\nremained\nstone-faced!",
			"Lanmola was\nlate to our\ndinner party.\nHe just came\nfor the desert",
			"Moldorm is\nsuch a\nprankster.\nAnd I fall for\nit every time!",
			"Helmasaur is\nthrowing a\nparty.\nI hope it's\na masquerade!",
			"I'd like to\nknow Arrghus\nbetter.\nBut he won't\ncome out of\nhis shell!",
			"Mothula didn't\nhave much fun\nat the party.\nHe's immune to\nspiked punch!",
			"Don't set me\nup with that\nchick from\nSteve's Town.\n\n\nI'm not\ninterested in\na Blind date!",
			"Kholdstare is\nafraid to go\nto the circus.\nHungry kids\nthought he was\ncotton candy!",
			"I asked who\nVitreous' best\nfriends are.\nHe said,\n'Me, Myself,\nand Eye!'",
			"Trinexx can be\na hothead or\nhe can be an\nice guy. In\nthe end, he's\na solid\nindividual!",
			"Bari thought I\nhad moved out\nof town.\nHe was shocked\nto see me!",
			"I can only get\nWeetabix\naround here.\nI have to go\nto Steve's\nTown for Count\nChocula!",
			"Don't argue\nwith a frozen\nDeadrock.\nHe'll never\nchange his\nposition!",
			"I offered a\ndrink to a\nself-loathing\nGhini.\nHe said he\ndidn't like\nspirits!",
			"I was supposed\nto meet Gibdo\nfor lunch.\nBut he got\nwrapped up in\nsomething!",
			"Goriya sure\nhas changed\nin this game.\nI hope he\ncomes back\naround!",
			"Hinox actually\nwants to be a\nlawyer.\nToo bad he\nbombed the\nBar exam!",
			"I'm surprised\nMoblin's tusks\nare so gross.\nHe always has\nhis Trident\nwith him!",
			"Don’t tell\nStalfos I’m\nhere.\nHe has a bone\nto pick with\nme!",
			"I got\nWallmaster to\nhelp me move\nfurniture.\nHe was really\nhandy!",
			"Wizzrobe was\njust here.\nHe always\nvanishes right\nbefore we get\nthe check!",
			"I shouldn't\nhave picked up\nZora's tab.\nThat guy\ndrinks like\na fish!",
			"I was sharing\na drink with\nPoe.\nFor no reason,\nhe left in a\nheartbeat!",
			"Don’t trust\nhorsemen on\nDeath Mountain\nThey’re Lynel\nthe time!",
			"Today's\nspecial is\nbattered bat.\nGot slapped\nfor offering a\nlady a Keese!",
			"Don’t walk\nunder\npropellered\npineapples.\nYou may end up\nwearing\na pee hat!",
			"My girlfriend\nburrowed under\nthe sand.\nSo I decided\nto Leever!",
			"Geldman wants\nto be a\nBroadway star.\nHe’s always\npracticing\nJazz Hands!",
			"Octoballoon\nmust be mad\nat me.\nHe blows up\nat the sight\nof me!",
			"Toppo is a\ntotal pothead.\n\nHe hates it\nwhen you take\naway his grass",
			"I lost my\nshield by\nthat house.\nWhy did they\nput up a\nPikit fence?!",
			"Know that fox\nin Steve’s\nTown?\nHe’ll Pikku\npockets if you\naren't careful",
			"Dash through\nDark World\nbushes.\nYou’ll see\nGanon is tryin\nto Stal you!",
			"Eyegore!\n\nYou gore!\nWe all gore\nthose jerks\nwith arrows!",
			"I like my\nwhiskey neat.\n\nSome prefer it\nOctoroks!",
			"I consoled\nFreezor over a\ncup of coffee.\nHis problems\njust seemed to\nmelt away!",
			"Magic droplets\nof water don’t\nshut up.\nThey just\nKyameron!",
			"I bought hot\nwings for\nSluggula.\nThey gave him\nexplosive\ndiarrhea!",
			"Hardhat Beetle\nwon’t\nLet It Be?\nTell it to Get\nBack or give\nit a Ticket to\nRide down\na hole!",
		])));

		$rom->setGanon1TextString(array_first(mt_shuffle([
			"Start your day\nsmiling with a\ndelicious\nwholegrain\nbreakfast\ncreated for\nyour\nincredible\ninsides.",
			"You drove\naway my other\nself, Agahnim\ntwo times…\nBut, I won't\ngive you the\nTriforce.\nI'll defeat\nyou!",
			"Impa says that\nthe mark on\nyour hand\nmeans that you\nare the hero\nchosen to\nawaken Zelda.\nyour blood can\nresurrect me.",
			"Don't stand,\n\ndon't stand so\nDon't stand so\n\nclose to me\nDon't stand so\nclose to me\nback off buddy",
			"So ya\nThought ya\nMight like to\ngo to the show\nTo feel the\nwarm thrill of\nconfusion\nThat space\ncadet glow.",
			"Like other\npulmonate land\ngastropods,\nthe majority\nof land slugs\nhave two pairs\nof 'feelers'\nor tentacles\non their head.",
			"If you were a\nburrito, what\nkind of a\nburrito would\nyou be?\nMe, I fancy I\nwould be a\nspicy barbacoa\nburrito.",
			"I am your\nfather's\nbrother's\nnephew's\ncousin's\nformer\nroommate. What\ndoes that make\nus, you ask?",
			"I'll be more\neager about\nencouraging\nthinking\noutside the\nbox when there\nis evidence of\nany thinking\ninside it.",
			"If we're not\nmeant to have\nmidnight\nsnacks, then\nwhy is there\na light in the\nfridge?\n",
			"I feel like we\nkeep ending up\nhere.\n\nDon't you?\n\nIt's like\ndeja vu\nall over again",
			"Did you know?\nThe biggest\nand heaviest\ncheese ever\nproduced\nweighed\n57,518 pounds\nand was 32\nfeet long.",
			"Now there was\na time, When\nyou loved me\nso. I couldn't\ndo wrong,\nAnd now you\nneed to know.\nSo How you\nlike me now?",
			"Did you know?\nNutrition\nexperts\nrecommend that\nat least half\nof our daily\ngrains come\nfrom whole\ngrain products",
			"The Hemiptera\nor true bugs\nare an order\nof insects\ncovering 50k\nto 80k species\nlike aphids,\ncicadas, and\nshield bugs.",
			"Thanks for\ndropping in,\nthe first\npassengers\nin a hot\nair balloon.\nwere a duck,\na sheep,\nand a rooster.",
			"You think you\nare so smart?\n\nI bet you\ndidn't know\nYou can't hum\nwhile holding\nyour nose\nclosed.",
		])));

		switch ($this->goal) {
			case 'pedestal':
				$rom->setGanon1InvincibleTextString("You cannot\nkill me. You\nshould go for\nyour real goal\nit's on the\npedestal.\n\nYou dingus\n");
				break;
			case 'triforce-hunt':
				$rom->setGanon1InvincibleTextString("So you thought\nyou could come\nhere and beat\nme? I have\nhidden the\ntriforce\npieces well.\nWithout them\nyou can't win!");
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
			$rom->setGanon2TextString("Did you find\nthe arrows on\nPlanet Zebes");
		} else {
			switch ($silver_arrows_location->getRegion()->getName()) {
				case "Ganons Tower":
					$rom->setGanon2TextString("Did you find\nthe arrows in\nMy tower?");
					break;
				default:
					$rom->setGanon2TextString("Did you find\nthe arrows in\n" . $silver_arrows_location->getRegion()->getName());
			}

		}

		$rom->setTriforceTextString(array_first(mt_shuffle([
			"\n     G G",
			"All your base\nare belong\nto us.",
			"You have ended\nthe domination\nof dr. wily",
			"  thanks for\n  playing!!!",
			"\n   You Win!",
			"  Thank you!\n  your quest\n   is over.",
			"   A winner\n      is\n     you!",
			"\n   WINNER!!",
			"\n  I'm  sorry\n\nbut your\nprincess is in\nanother castle",
			"\n   success!",
			"    Whelp…\n  that  just\n   happened",
			"   Oh  hey…\n   it's you",
			"\n  Wheeeeee!!",
			"   Time for\n another one?",
			"and\n\n         scene",
			"\n   GOT EM!!",
			"\nTHE VALUUUE!!!",
			"Cool seed,\n\nright?",
			"\n  We did it!",
			"  Spam those\n  emotes in\n  wilds chat",
			"\n   O  M  G",
			" Hello.  Will\n  you be my\n   friend?",
			"   Beetorp\n     was\n    here!",
			"The Wind Fish\nwill wake\nsoon.    Hoot!",
			"meow meow meow\nmeow meow meow\n  oh my god!",
			"Ahhhhhhhhh\nYa ya yaaaah\nYa ya yaaah",
			".done\n\n.comment lol",
			"You get to\ndrink from\nthe firehose",
		])));

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

		for ($i = 0; $i < $this->config('item.count.HalfMagicUpgrade', 1); $i++) {
			array_push($advancement_items, Item::get('HalfMagic'));
		}

		for ($i = 0; $i < $this->config('item.count.QuarterMagicUpgrade', 0); $i++) {
			array_push($advancement_items, Item::get('QuarterMagic'));
		}

		for ($i = 0; $i < $this->config('item.count.MagicUpgrade', 0); $i++) {
			array_push($advancement_items, (mt_rand(0, 3) == 0) ? Item::get('QuarterMagic') : Item::get('HalfMagic'));
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
		for ($i = 0; $i < $this->config('item.count.BombUpgrade50', 0); $i++) {
			array_push($items_to_find, Item::get('BombUpgrade50'));
		}
		for ($i = 0; $i < $this->config('item.count.ArrowUpgrade5', 6); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade5'));
		}
		for ($i = 0; $i < $this->config('item.count.ArrowUpgrade10', 1); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade10'));
		}
		for ($i = 0; $i < $this->config('item.count.ArrowUpgrade70', 0); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade70'));
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
		for ($i = 0; $i < $this->config('item.count.ThreeBombs', 10); $i++) {
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
	 * This is a quick hack to get prizes shuffled, will adjust later when we model sprites.
	 * this now also handles prize pull trees.
	 *
	 * @TODO: create sprite classes
	 * @TODO: create prize pack classes
	 * @TODO: move remaining writes to Rom class
	 */
	public function writePrizeShuffleToRom(Rom $rom) {
		// Pack shuffle
		$prizes = [
			0xD8, 0xD8, 0xD8, 0xD8, 0xD9, 0xD8, 0xD8, 0xD9, // pack 1
			0xDA, 0xD9, 0xDA, 0xDB, 0xDA, 0xD9, 0xDA, 0xDA, // pack 2
			0xE0, 0xDF, 0xDF, 0xDA, 0xE0, 0xDF, 0xD8, 0xDF, // pack 3
			0xDC, 0xDC, 0xDC, 0xDD, 0xDC, 0xDC, 0xDE, 0xDC, // pack 4
			0xE1, 0xD8, 0xE1, 0xE2, 0xE1, 0xD8, 0xE1, 0xE2, // pack 5
			0xDF, 0xD9, 0xD8, 0xE1, 0xDF, 0xDC, 0xD9, 0xD8, // pack 6
			0xD8, 0xE3, 0xE0, 0xDB, 0xDE, 0xD8, 0xDB, 0xE2, // pack 7
			0xD9, 0xDA, 0xDB, // from pull trees
			0xD9, 0xDB, // from prize crab
			0xD9, // stunned prize
			0xDB, // saved fish prize
		];
		$shuffled = mt_shuffle($prizes);

		if ($this->config('bees', false)) {
			// you asked for it
			$shuffled = mt_shuffle(array_merge($shuffled, array_fill(0, 25, 0x79)));
			$rom->setOverworldDigPrizes([
				0xB2, 0xD8, 0xD8, 0xD8,
				0xD8, 0xD8, 0xD8, 0xB2, 0xB2,
				0xD9, 0xD9, 0xD9, 0xB2, 0xB2,
				0xDA, 0xDA, 0xDA, 0xB2, 0xB2,
				0xDB, 0xDB, 0xDB, 0xB2, 0xB2,
				0xDC, 0xDC, 0xDC, 0xB2, 0xB2,
				0xDD, 0xDD, 0xDD, 0xB2, 0xB2,
				0xDE, 0xDE, 0xDE, 0xB2, 0xB2,
				0xDF, 0xDF, 0xDF, 0xB2, 0xB2,
				0xE0, 0xE0, 0xE0, 0xB2, 0xB2,
				0xE1, 0xE1, 0xE1, 0xB2, 0xB2,
				0xE2, 0xE2, 0xE2, 0xB2, 0xB2,
				0xE3, 0xE3, 0xE3, 0xB2, 0xB2,
			]);
		}

		// write to trees
		$rom->setPullTreePrizes(array_pop($shuffled), array_pop($shuffled), array_pop($shuffled));

		// write to prize crab
		$rom->setRupeeCrabPrizes(array_pop($shuffled), array_pop($shuffled));

		// write to stunned
		$rom->setStunnedSpritePrize(array_pop($shuffled));

		// write to saved fish
		$rom->setFishSavePrize(array_pop($shuffled));

		// write to prize packs
		$rom->write(0x37A78, pack('C*', ...array_slice($shuffled, 0, 56)));

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
			$rom->write($offset + $i, pack('C*', ($bytes[$i] >> 4 << 4) + mt_rand(1, 7)));
		}

		// Pack drop chance
		switch ($this->config('rom.HardMode', 0)) {
			case 3:
			case 2:
				list($low, $high) = [3, 4]; // 12.5%, 6.25%
				break;
			case 1:
				list($low, $high) = [2, 3]; // 25%, 12.5%
				break;
			default:
				list($low, $high) = [1, 1]; // 50%
		}
		$offset = 0x37A62;
		for ($i = 0; $i < 7; $i++) {
			$rom->write($offset + $i, pack('C*', pow(2, mt_rand($low, $high)) - 1));
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
		$shuffled = mt_shuffle($prizes);

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

		if ($this->config('bees', false)) {
			return $bottles[mt_rand(4, 5)];
		}

		return $bottles[mt_rand($filled ? 1 : 0, count($bottles) - (($this->config('rom.HardMode', 0) > 0) ? 2 : 1))];
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
