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
	const LOGIC = 19;
	protected $rng_seed;
	protected $seed;
	protected $world;
	protected $rules;
	protected $type;
	static protected $logic_array = [
		0xE6, 0x6D, 0xC2, 0x96, 0x3E, 0xB6, 0x22, 0x42,0xA9, 0xAC, 0xEC, 0xF5, 0xA8, 0x1C, 0xCE, 0x01,
		0x05, 0x07, 0x5C, 0x98, 0xCA, 0x29, 0x72, 0x89,0x75, 0x0E, 0x3C, 0xB9, 0xE3, 0x45, 0x7F, 0x65,
		0x28, 0x24, 0x8A, 0x87, 0x63, 0x30, 0xB3, 0x7C,0x5F, 0x59, 0xF3, 0x73, 0x39, 0x64, 0x9F, 0xBA,
		0x66, 0x23, 0x58, 0xFA, 0xBF, 0xAF, 0xC5, 0x16,0xBC, 0x9D, 0xB8, 0xCD, 0xEF, 0xD3, 0x4C, 0x46,
		0x74, 0x13, 0x8F, 0xE5, 0x55, 0x5E, 0xD7, 0xAD,0x76, 0xA7, 0x0C, 0xAA, 0x2D, 0x33, 0xBB, 0xD4,
		0xF8, 0x44, 0x12, 0x9A, 0x02, 0xE9, 0xFF, 0x2E,0x95, 0x10, 0xD5, 0xC1, 0x5A, 0x3D, 0x21, 0xDF,
		0x8C, 0xA2, 0xF9, 0x9C, 0xDD, 0xFC, 0xB4, 0x0D,0x17, 0x34, 0x14, 0xA1, 0xEE, 0xDB, 0x51, 0x3F,
		0xF0, 0xDA, 0x81, 0xE4, 0x6E, 0xB2, 0x08, 0x93,0xD8, 0x35, 0xCB, 0xF7, 0xB1, 0xCF, 0x09, 0x79,
		0xE1, 0x69, 0xD0, 0x61, 0x62, 0xC9, 0x92, 0x1D,0xCC, 0x56, 0x83, 0x4D, 0x38, 0xB5, 0x6B, 0xFE,
		0xDC, 0xE0, 0xC4, 0xFB, 0x00, 0x85, 0x40, 0x53,0x1E, 0xA5, 0x27, 0x20, 0xED, 0xAB, 0x5D, 0xA3,
		0x91, 0x4B, 0xA0, 0x97, 0x57, 0xF2, 0xE7, 0x43,0x0B, 0x94, 0x77, 0x48, 0xB7, 0xC8, 0x8D, 0x47,
		0xAE, 0x90, 0x4F, 0x15, 0x86, 0x36, 0x06, 0x9B,0x67, 0x80, 0x11, 0x2C, 0xEA, 0x25, 0xC6, 0x31,
		0x49, 0xE2, 0x88, 0x99, 0xD2, 0x18, 0xEB, 0x19,0x2B, 0x82, 0xC7, 0xDE, 0x8B, 0x03, 0x50, 0x2F,
		0xFD, 0xC3, 0xF4, 0x4E, 0x52, 0xD1, 0xD6, 0x6F,0x4A, 0x7E, 0x7D, 0x1F, 0xBD, 0x78, 0x41, 0x6A,
		0xF6, 0xB0, 0x32, 0xA4, 0xBE, 0x3A, 0x1A, 0x68,0xF1, 0x0F, 0xA6, 0x1B, 0x3B, 0x8E, 0xC0, 0x2A,
		0x9E, 0x54, 0x26, 0x0A, 0x71, 0x7B, 0x04, 0x5B,0x84, 0xE8, 0x6C, 0xD9, 0x70, 0x37, 0x60, 0x7A,
	];

	/**
	 * Create a new Randomizer
	 *
	 * @param string $rules rules from config to apply to randomization
	 * @param string $type Ruleset to use when deciding if Locations can be reached
	 *
	 * @return void
	 */
	public function __construct($rules = 'normal', $type = 'NoMajorGlitches') {
		$this->rules = $rules;
		$this->type = $type;
		$this->world = new World($rules, $type);
		$this->seed = new Seed;
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
		switch ($this->type) {
			case 'NoMajorGlitches': return 'no-glitches-' . static::LOGIC;
			case 'SpeedRunner': return 'minor-glitches-' . static::LOGIC;
			case 'Glitched': return 'major-glitches-' . static::LOGIC;
		}
		return 'unknown-' . static::LOGIC;
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
		$rng_seed = $rng_seed ?: mt_rand(1, 999999999);
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
		$this->fillPrizes($regions);
		$this->setMedallions($regions);

		$regions['Fountains']->getLocations()->each(function($fountain) {
			$fountain->setItem($this->getBottle(true));
		});

		$locations = $this->world->getLocations()->filter(function($location) {
			return !is_a($location, Location\Prize::class)
				&& !is_a($location, Location\Medallion::class);
		});

		$my_items = new ItemCollection();

		$locations["Pyramid - Bow"]->setItem($this->config('region.pyramidBowUpgrade', false)
			? Item::get('BowAndSilverArrows')
			: Item::get('BowAndArrows'));

		// @TODO: this swords stuff is getting silly, break it out into a managable function or something.
		$sword_locations = new LocationCollection([
			$locations["Pyramid - Sword"],
			$locations["Blacksmiths"],
			$locations["Altar"],
		]);

		if (!$this->config('region.swordsInPool', true) || !$this->config('region.swordShuffle', true)) {
			$locations["Uncle"]->setItem(Item::get('L1Sword'));
			$my_items->addItem(Item::get('L1Sword'));

			$swords = [Item::get('MasterSword')];

			switch ($this->config('rom.HardMode', 0)) {
				case 2:
					array_push($swords, Item::get('L1Sword'));
					array_push($swords, Item::get('L1Sword'));
					break;
				case 1:
					array_push($swords, Item::get('L1Sword'));
					array_push($swords, Item::get('L3Sword'));
					break;
				default:
					array_push($swords, Item::get('L3Sword'));
					array_push($swords, Item::get('L4Sword'));
					break;
			}

			if ($this->config('item.progressiveSwords', true)) {
				$swords = [Item::get('ProgressiveSword')];
				switch ($this->config('rom.HardMode', 0)) {
					case 2:
						array_push($swords, Item::get('L1Sword'));
						array_push($swords, Item::get('L1Sword'));
						break;
					case 1:
						array_push($swords, Item::get('L1Sword'));
						array_push($swords, Item::get('ProgressiveSword'));
						break;
					default:
						array_push($swords, Item::get('ProgressiveSword'));
						array_push($swords, Item::get('ProgressiveSword'));
						break;
				}
			}

			while (count($swords) > 0) {
				$item = array_shift($swords);
				$sword_locations->getEmptyLocations()->random()->setItem($item);
			}

			if (!$this->config('region.swordShuffle', true)) {
				$locations["Pyramid - Sword"]->setItem(Item::get('L4Sword'));
				$locations["Blacksmiths"]->setItem(Item::get('L3Sword'));
				$locations["Altar"]->setItem(Item::get('MasterSword'));
			}
			config(["alttp.{$this->rules}.item.count.MasterSword" => 0]);
			config(["alttp.{$this->rules}.item.count.L3Sword" => 0]);
			config(["alttp.{$this->rules}.item.count.L4Sword" => 0]);
		} else {
			$locations["Pyramid - Sword"]->setItem(Item::get('L1Sword'));
			if (config('game-mode') == 'open') {
				if ($this->config('item.progressiveSwords', true)) {
					$l1 = $this->config('item.count.L1Sword', 1);
					$l2 = $this->config('item.count.MasterSword', 1);
					$l3 = $this->config('item.count.L3Sword', 1);
					$l4 = $this->config('item.count.L4Sword', 1);

					config(["alttp.{$this->rules}.item.count.L1Sword" => 0]);
					config(["alttp.{$this->rules}.item.count.MasterSword" => 0]);
					config(["alttp.{$this->rules}.item.count.L3Sword" => 0]);
					config(["alttp.{$this->rules}.item.count.L4Sword" => 0]);

					config(["alttp.{$this->rules}.item.count.ProgressiveSword"
						=> $this->config('item.count.ProgressiveSword', 0) + $l1 + $l2 + $l3 + $l4]);
				} else {
					config(["alttp.{$this->rules}.item.count.L1Sword" => 1]);
				}
			} else {
				if ($this->config('item.progressiveSwords', true)) {
					$l2 = $this->config('item.count.MasterSword', 1);
					$l3 = $this->config('item.count.L3Sword', 1);
					$l4 = $this->config('item.count.L4Sword', 1);

					config(["alttp.{$this->rules}.item.count.MasterSword" => 0]);
					config(["alttp.{$this->rules}.item.count.L3Sword" => 0]);
					config(["alttp.{$this->rules}.item.count.L4Sword" => 0]);

					config(["alttp.{$this->rules}.item.count.ProgressiveSword"
						=> $this->config('item.count.ProgressiveSword', 0) + $l2 + $l3 + $l4]);

					$locations["Uncle"]->setItem(Item::get('ProgressiveSword'));
					$my_items->addItem(Item::get('ProgressiveSword'));
				}  else {
					$locations["Uncle"]->setItem(Item::get('L1Sword'));
					$my_items->addItem(Item::get('L1Sword'));
				}
			}
		}

		if ($this->config('item.progressiveArmor', true)) {
			$blue = $this->config('item.count.BlueMail', 1);
			$red = $this->config('item.count.RedMail', 1);

			config(["alttp.{$this->rules}.item.count.BlueMail" => 0]);
			config(["alttp.{$this->rules}.item.count.RedMail" => 0]);

			config(["alttp.{$this->rules}.item.count.ProgressiveArmor"
				=> $this->config('item.count.ProgressiveArmor', 0) + $blue + $red]);
		}

		if ($this->config('item.progressiveShields', true)) {
			$blue = $this->config('item.count.BlueShield', 1);
			$red = $this->config('item.count.RedShield', 1);
			$mirror = $this->config('item.count.MirrorShield', 1);

			config(["alttp.{$this->rules}.item.count.BlueShield" => 0]);
			config(["alttp.{$this->rules}.item.count.RedShield" => 0]);
			config(["alttp.{$this->rules}.item.count.MirrorShield" => 0]);

			config(["alttp.{$this->rules}.item.count.ProgressiveShield"
				=> $this->config('item.count.ProgressiveShield', 0) + $blue + $red + $mirror]);
		}

		if ($this->config('item.progressiveGloves', true)) {
			$glove = $this->config('item.count.PowerGlove', 1);
			$mitt = $this->config('item.count.TitansMitt', 1);

			config(["alttp.{$this->rules}.item.count.PowerGlove" => 0]);
			config(["alttp.{$this->rules}.item.count.TitansMitt" => 0]);

			config(["alttp.{$this->rules}.item.count.ProgressiveGlove"
				=> $this->config('item.count.ProgressiveGlove', 0) + $glove + $mitt]);
		}

		// fill boss hearts before anything else if we need to
		if (!$this->config('region.bossHeartsInPool', true)) {
			$locations["Heart Container - Lanmolas"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Armos Knights"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Kholdstare"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Vitreous"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Helmasaur King"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Mothula"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Arrghus"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Blind"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Trinexx"]->setItem(Item::get('BossHeartContainer'));
			$locations["Heart Container - Moldorm"]->setItem(Item::get('BossHeartContainer'));
		}

		// for filling base (Maps/Compasses/Keys) items assume you have everything
		foreach ($regions as $region) {
			$region->fillBaseItems(Item::all());
		}

		// at this point we have filled all the base locations that will affect the rest of the actual item placements
		$randomized_order_locations = $locations->getEmptyLocations()->randomCollection($locations->count());

		$advancement_items = $this->getAdvancementItems();

		if ($this->type == 'Glitched') {
			$this->world->getLocation("[dungeon-C-1F] Sanctuary")->setItem(Item::get('PegasusBoots'));
			$key = array_search(Item::get('PegasusBoots'), $advancement_items);
			$my_items->addItem(Item::get('PegasusBoots'));
			unset($advancement_items[$key]);

			// Glitched always has 3 extra bottles, no matter what
			config(["alttp.{$this->rules}.item.count.ExtraBottles" => 3]);
		}

		$this->fillItemsInLocations($advancement_items, $my_items, $randomized_order_locations, true);

		// Remaining Items
		$this->fillItemsInLocations($this->getItemPool(), $my_items, $randomized_order_locations);

		// Inaccessible Locations
		$locations->filter(function($location) use ($my_items) {
			return !$location->canAccess($my_items);
		})->each(function($location) {
			$location->setItem(new Item('ChocoboEgg', 'Chocobo Egg', null));
		});

		return $this;
	}

	protected function fillItemsInLocations($fill_items, $my_items, $locations, $check_for_new_locations = false) {
		reset($fill_items);
		while (count($fill_items) && $locations->getEmptyLocations()->count()) {
			$item = current($fill_items);

			// we can speed this up by just taking the first available location?
			$available_locations = $locations->getEmptyLocations()->filter(function($location) use ($item, $my_items) {
				return $location->canFill($item, $my_items);
			});

			if ($available_locations->count() == 0) {
				foreach ($locations->getEmptyLocations() as $log_loc) {
					Log::error("SOFT LOCK LOCATION: " . $log_loc->getName());
				}
				throw new \Exception(sprintf('No Available Locations: "%s [seed:%s]"', $item->getNiceName(), $this->rng_seed));
			}

			Log::debug(sprintf("Item: %s [%s] Locations: %s of %s",
				$item->getNiceName(), $item->getName(), $locations->getEmptyLocations()->count(), $available_locations->count()));

			if ($check_for_new_locations) {
				$my_new_items = $my_items->tempAdd($item);

				$available_after_placement = $locations->getEmptyLocations()->filter(function($location) use ($my_new_items) {
					return $location->canAccess($my_new_items);
				});

				if ($available_after_placement->count() == $available_locations->count()) {
					if (next($fill_items) !== false) {
						Log::debug(sprintf("Skipping Item: %s [%s]", $item->getNiceName(), $item->getName()));
						continue;
					} else {
						end($fill_items);
					}
				}
			}

			$found = false;
			foreach ($available_locations as $location) {
				Log::debug("Available Location: " . $location->getName());
				if ($found = $location->fill($item, $my_items)) {
					Log::debug("Placing: " . $location->getName());
					break;
				}
			}

			if (!$found) {
				throw new \Exception(sprintf('Unable to put Item: "%s" in a Location [seed:%s]', $item->getNiceName(), $this->rng_seed));
			}

			unset($fill_items[key($fill_items)]);
			reset($fill_items);

			$my_items->addItem($item);

			// HACK to allow us to use Item::has logic when checking access to locations.
			// @TODO: remove methed from World class and have this just collect any non-randomly placed items.
			foreach ($this->world->collectPrizes($my_items) as $prize) {
				if (!$my_items->has($prize->getName())) {
					$my_items->addItem($prize);
				}
			}
		}
		Log::debug(sprintf("Extra Items: %s", count($fill_items)));
	}

	protected function fillPrizes($regions) {
		$prizes = [
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
		];

		if ($this->config('prize.crossWorld', true) && $this->config('prize.shufflePendants', true) && $this->config('prize.shuffleCrystals', true)) {
			$prizes = mt_shuffle($prizes);
		}

		while (count($prizes) > 3) {
			$item = array_shift($prizes);
			$regions['Crystals']->getEmptyLocations()->random()->setItem($item);
		}

		if (!$this->config('prize.shuffleCrystals', true)) {
			$crystal_locations = $this->world->getRegion('Crystals')->getLocations();
			$crystal_locations["Palace of Darkness Crystal"]->setItem(Item::get('Crystal1'));
			$crystal_locations["Swamp Palace Crystal"]->setItem(Item::get('Crystal2'));
			$crystal_locations["Skull Woods Crystal"]->setItem(Item::get('Crystal3'));
			$crystal_locations["Thieves Town Crystal"]->setItem(Item::get('Crystal4'));
			$crystal_locations["Ice Palace Crystal"]->setItem(Item::get('Crystal5'));
			$crystal_locations["Misery Mire Crystal"]->setItem(Item::get('Crystal6'));
			$crystal_locations["Turtle Rock Crystal"]->setItem(Item::get('Crystal7'));
		}

		while (count($prizes) > 0) {
			$item = array_shift($prizes);
			$regions['Pendants']->getEmptyLocations()->random()->setItem($item);
		}

		if (!$this->config('prize.shufflePendants', true)) {
			$pendant_locations = $this->world->getRegion('Pendants')->getLocations();
			$pendant_locations["Eastern Palace Pendant"]->setItem(Item::get('PendantOfCourage'));
			$pendant_locations["Desert Palace Pendant"]->setItem(Item::get('PendantOfPower'));
			$pendant_locations["Tower of Hera Pendant"]->setItem(Item::get('PendantOfWisdom'));
		}
	}

	protected function setMedallions($regions) {
		$medallions = [
			Item::get('Ether'),
			Item::get('Bombos'),
			Item::get('Quake'),
		];

		foreach ($regions['Medallions']->getLocations() as $medallion_location) {
			$medallion = $medallions[mt_rand(0, 2)];
			$medallion_location->setItem($medallion);
		}
	}

	/**
	 * Get the current spoiler for this seed
	 *
	 * @return array
	 */
	public function getSpoiler() {
		$spoiler = [];

		foreach ($this->world->getRegions() as $name => $region) {
			$spoiler[$name] = [];
			Log::info("");
			Log::info("$name:");
			$region->getLocations()->each(function($location) use (&$spoiler, $name) {
				if ($location->hasItem()) {
					$spoiler[$name][$location->getName()] = $location->getItem()->getNiceName();
					Log::info(sprintf("%-'.90s%s", $location->getName(), $location->getItem()->getNiceName()));
				} else {
					$spoiler[$name][$location->getName()] = 'Nothing';
					Log::info(sprintf("%-'.90s%s", $location->getName(), 'Nothing'));
				}
			});
		}
		$spoiler['playthrough'] = $this->world->getPlayThrough();
		$spoiler['meta'] = [
			'difficulty' => $this->rules,
			'logic' => $this->getLogic(),
			'seed' => $this->rng_seed,
			'build' => Rom::BUILD,
			'mode' => config('game-mode', 'Standard'),
		];

		$this->seed->spoiler = json_encode($spoiler);

		return $spoiler;
	}

	/**
	 * Get config value based on the currently set rules
	 *
	 * @param string $key dot notation key of config
	 * @param mixed|null $default value to return if $key is not found
	 *
	 * @return mixed
	 */
	public function config($key, $default = null) {
		return config("alttp.{$this->rules}.$key", $default);
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

		$rom->setClockMode($this->config('rom.timerMode', 'off'));

		$rom->setHardMode($this->config('rom.HardMode', 0), in_array($this->type, ['Glitched']));

		$rom->writeRNGBlock(function() {
			return mt_rand(0, 0x100);
		});

		if ($this->config('sprite.shufflePrizePack', true)) {
			$this->writePrizeShuffleToRom($rom);
		}

		$rom->setPyramidFairyChests($this->config('region.swordsInPool', true));
		$rom->setSmithyQuickItemGive($this->config('region.swordsInPool', true));

		$rom->setOpenMode(config('game-mode') == 'open');

		if (config('game-mode') == 'open') {
			$rom->removeUnclesSword();
		}

		$this->randomizeCredits($rom);

		$rom->skipZeldaSwordCheck();
		$rom->setMaxArrows();
		$rom->setMaxBombs();
		$rom->setCapacityUpgradeFills([
			$this->config('item.value.BombUpgrade5', 0),
			$this->config('item.value.BombUpgrade10', 0),
			$this->config('item.value.ArrowUpgrade5', 0),
			$this->config('item.value.ArrowUpgrade10', 0),
		]);

		$rom->setBlueClock($this->config('item.value.BlueClock', 0));
		$rom->setRedClock($this->config('item.value.RedClock', 0));
		$rom->setGreenClock($this->config('item.value.GreenClock', 0));
		$rom->setStartingTime($this->config('rom.timerStart', 0));

		$rom->removeUnclesShield();

		switch ($this->type) {
			case 'Glitched':
				$type_flag = 'G';
				$rom->setSwampWaterLevel(false);
				$rom->setPreAgahnimDarkWorldDeathInDungeon(false);
				$rom->setRandomizerSeedType('Glitched');
				$rom->setLightWorldLampCone(false);
				$rom->setWarningFlags(bindec('01100000'));
				break;
			case 'SpeedRunner':
				$type_flag = 'S';
				$rom->setSwampWaterLevel(false);
				$rom->setLightWorldLampCone(false);
				$rom->setWarningFlags(bindec('01000000'));
				break;
			case 'NoMajorGlitches':
			default:
				$type_flag = 'C';
				break;
		}

		$rom->writeRandomizerLogicHash(self::$logic_array);
		$rom->setSeedString(str_pad(sprintf("VT%s%'.09d%'.03s%s", $type_flag, $this->rng_seed, static::LOGIC, $this->rules), 21, ' '));

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
		$this->seed->rules = $this->rules;
		$this->seed->game_mode = $this->type;
		$this->seed->save();

		return $this->seed->hash;
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
		switch (mt_rand(0, 2)) {
			case 1:
				$rom->setKingsReturnCredits("fellowship of the ring");
				break;
			case 2:
				$rom->setKingsReturnCredits("the two towers");
				break;
		}

		switch (mt_rand(0, 2)) {
			case 1:
				$rom->setSanctuaryCredits("read a book");
				break;
			case 2:
				$rom->setSanctuaryCredits("sits in own pew");
				break;
		}

		$name = array_first(mt_shuffle([
			"sahasralah", "sabotaging", "sacahuista", "sacahuiste", "saccharase", "saccharide", "saccharify",
			"saccharine", "saccharins", "sacerdotal", "sackcloths", "salmonella", "saltarelli", "saltarello",
			"saltations", "saltbushes", "saltcellar", "saltshaker", "salubrious", "sandgrouse", "sandlotter",
			"sandstorms", "sandwiched", "sauerkraut", "schipperke", "schismatic", "schizocarp", "schmalzier",
			"schmeering", "schmoosing", "shibboleth", "shovelnose", "sahananana", "sarararara",
		]));
		$rom->setKakarikoTownCredits("$name's homecoming");

		switch (mt_rand(0, 3)) {
			case 1:
				$rom->setWoodsmansHutCredits("fresh flapjacks");
				break;
			case 2:
				$rom->setWoodsmansHutCredits("two woodchoppers");
				break;
			case 3:
				$rom->setWoodsmansHutCredits("double lumberman");
				break;
		}

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setSwordsmithsCredits("the dwarven breadsmiths");
				break;
		}

		switch (mt_rand(0, 2)) {
			case 1:
				$rom->setLostWoodsCredits("dancing pickles");
				break;
			case 2:
				$rom->setLostWoodsCredits("flying vultures");
				break;
		}

		switch (mt_rand(0, 5)) {
			case 1:
				$rom->setWishingWellCredits("Venus was her name");
				break;
			case 2:
				$rom->setWishingWellCredits("I'm your Venus");
				break;
			case 3:
				$rom->setWishingWellCredits("Yeah, baby, shes got it");
				break;
			case 4:
				$rom->setWishingWellCredits("Venus, I'm your fire");
				break;
			case 5:
				$rom->setWishingWellCredits("Venus, At your desire");
				break;
		}

		return $this;
	}

	/**
	 * Randomly set the starting text for the Uncle, there is a chance he will tell you the Region Pegasus Boots
	 * reside in.
	 * as well as Ganon Texts
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return $this
	 */
	public function setTexts(Rom $rom) {
		$boots_location = $this->world->getLocationsWithItem(Item::get('PegasusBoots'))->first();

		if ($this->config('spoil.BootsLocation', true) && mt_rand() % 20 == 0 && $boots_location) {
			Log::info('Boots revealed');
			switch ($boots_location->getName()) {
				case "Piece of Heart (Maze Race)":
					$rom->setUncleTextString("Boots at race?\nSeed confirmed\nimpossible.");
					break;
				default:
					$rom->setUncleTextString("Lonk! Boots\nare in the\n" . $boots_location->getRegion()->getName());
			}
		} else {
			$rom->setUncleText(mt_rand(0, 32));
		}

		if (!config('tournament-mode', false)) {
			$green_pendant_location = $this->world->getLocationsWithItem(Item::get('PendantOfCourage'))->first();

			$rom->setSahasrahla1TextString("Want something\nfor free? Go\nearn the green\npendant in\n"
				. $green_pendant_location->getRegion()->getName()
				. "\nand I'll give\nyou something.");
		}

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
			"I offered to a\ndrink to a\nself-loathing\nGhini.\nHe said he\ndidn't like\nspirits!",
			"I was supposed\nto meet Gibdo\nfor lunch.\nBut he got\nwrapped up in\nsomething!",
			"Goriya sure\nhas changed\nin this game.\nI hope he\ncomes back\naround!",
			"Hinox actually\nwants to be a\nlawyer.\nToo bad he\nbombed the\nbar exam!",
			"I'm surprised\nMoblin's tusks\nare so gross.\nHe always has\nhis Trident\nwith him!",
			"Don’t tell\nStalfos I’m\nhere.\nHe has a bone\nto pick with\nme!",
			"I got\nWallmaster to\nhelp me move\nfurniture.\nHe was really\nhandy!",
			"Wizzrobe was\njust here.\nHe always\nvanishes right\nbefore we get\nthe check!",
			"I shouldn't\nhave picked up\nZora's tab.\nThat guy\ndrinks like\na fish!",
		])));

		$rom->setGanon1TextString(array_first(mt_shuffle([
			"Start your day\nsmiling with a\ndelicious\nwholegrain\nbreakfast\ncreated for\nyour\nincredible\ninsides.",
			"You drove\naway my other\nself, Agahnim\ntwo times…\nBut, I won't\ngive you the\nTriforce.\nI'll defeat\nyou!",
			"Impa says that\nthe mark on\nyour hand\nmeans that you\nare the hero\nchosen to\nawaken Zelda.\nyour blood can\nresurect me.",
			"Don't stand,\n\ndon't stand so\nDon't stand so\n\nclose to me\nDon't stand so\nclose to me\nback off buddy",
			"So ya\nThought ya\nMight like to\ngo to the show\nTo feel the\nwarm thrill of\nconfusion\nThat space\ncadet glow.",
			"Like other\npulmonate land\ngastropods,\nthe majority\nof land slugs\nhave two pairs\nof 'feelers'\nor tentacles\non their head.",
			"If you were a\nburrito, what\nkind of a\nburrito would\nyou be?\nMe, I fancy I\nwould be a\nspicy barbacoa\nburrito.",
			"I am your\nfather's\nbrother's\nnephew's\ncousin's\nformer\nroommate. What\ndoes that make\nus, you ask?",
		])));

		$silver_arrows_location = $this->world->getLocationsWithItem(Item::get('SilverArrowUpgrade'))->first();

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
			"\n     G G",
			"All your base\nare belong\nto us.",
			"You have ended\nthe domination\nof dr. wily",
			"  thanks for\n  playing!!!",
			"\n   You Win!",
			"  Thank you!\n  your quest\n   is over.",
			"   A winner\n      is\n     you!",
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
		for ($i = 0; $i < $this->config('item.count.MasterSword', 1); $i++) {
			array_push($advancement_items, Item::get('MasterSword'));
		}
		for ($i = 0; $i < $this->config('item.count.L3Sword', 1); $i++) {
			array_push($advancement_items, Item::get('L3Sword'));
		}
		for ($i = 0; $i < $this->config('item.count.L4Sword', 1); $i++) {
			array_push($advancement_items, Item::get('L4Sword'));
		}

		for ($i = 0; $i < $this->config('item.count.ProgressiveSword', 0); $i++) {
			array_push($advancement_items, Item::get('ProgressiveSword'));
		}

		for ($i = 0; $i < $this->config('item.count.Bottles', 1); $i++) {
			array_push($advancement_items, $this->getBottle());
		}
		for ($i = 0; $i < max(1, $this->config('item.count.Bombos', 1)); $i++) {
			array_push($advancement_items, Item::get('Bombos'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.BookOfMudora', 1)); $i++) {
			array_push($advancement_items, Item::get('BookOfMudora'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.Bow', 1)); $i++) {
			array_push($advancement_items, Item::get('Bow'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.CaneOfSomaria', 1)); $i++) {
			array_push($advancement_items, Item::get('CaneOfSomaria'));
		}
		for ($i = 0; $i < $this->config('item.count.Cape', 1); $i++) {
			array_push($advancement_items, Item::get('Cape'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.Ether', 1)); $i++) {
			array_push($advancement_items, Item::get('Ether'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.FireRod', 1)); $i++) {
			array_push($advancement_items, Item::get('FireRod'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.Flippers', 1)); $i++) {
			array_push($advancement_items, Item::get('Flippers'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.Hammer', 1)); $i++) {
			array_push($advancement_items, Item::get('Hammer'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.Hookshot', 1)); $i++) {
			array_push($advancement_items, Item::get('Hookshot'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.IceRod', 1)); $i++) {
			array_push($advancement_items, Item::get('IceRod'));
		}
		for ($i = 0; $i < $this->config('item.count.Lamp', 1); $i++) {
			array_push($advancement_items, Item::get('Lamp'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.MagicMirror', 1)); $i++) {
			array_push($advancement_items, Item::get('MagicMirror'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.MoonPearl', 1)); $i++) {
			array_push($advancement_items, Item::get('MoonPearl'));
		}
		for ($i = 0; $i < $this->config('item.count.Mushroom', 1); $i++) {
			array_push($advancement_items, Item::get('Mushroom'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.OcarinaInactive', 1)); $i++) {
			array_push($advancement_items, Item::get('OcarinaInactive'));
		}
		for ($i = 0; $i < $this->config('item.count.OcarinaActive', 0); $i++) {
			array_push($advancement_items, Item::get('OcarinaActive'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.PegasusBoots', 1)); $i++) {
			array_push($advancement_items, Item::get('PegasusBoots'));
		}
		for ($i = 0; $i < $this->config('item.count.Powder', 1); $i++) {
			array_push($advancement_items, Item::get('Powder'));
		}
		for ($i = 0; $i < $this->config('item.count.PowerGlove', 1); $i++) {
			array_push($advancement_items, Item::get('PowerGlove'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.Quake', 1)); $i++) {
			array_push($advancement_items, Item::get('Quake'));
		}
		for ($i = 0; $i < $this->config('item.count.Shovel', 1); $i++) {
			array_push($advancement_items, Item::get('Shovel'));
		}
		for ($i = 0; $i < $this->config('item.count.TitansMitt', 1); $i++) {
			array_push($advancement_items, Item::get('TitansMitt'));
		}

		for ($i = 0; $i < $this->config('item.count.BowAndSilverArrows', 0); $i++) {
			array_push($advancement_items, Item::get('BowAndSilverArrows'));
		}
		for ($i = 0; $i < $this->config('item.count.SilverArrowUpgrade', 1); $i++) {
			array_push($advancement_items, Item::get('SilverArrowUpgrade'));
		}

		for ($i = 0; $i < $this->config('item.count.ProgressiveGlove', 0); $i++) {
			array_push($advancement_items, Item::get('ProgressiveGlove'));
		}

		return mt_shuffle($advancement_items);
	}

	/**
	 * Get all the Items to insert into the Locations Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getItemPool() {
		$items_to_find = [];

		for ($i = 0; $i < $this->config('item.count.BlueShield', 1); $i++) {
			array_push($items_to_find, Item::get('BlueShield'));
		}

		for ($i = 0; $i < $this->config('item.count.ProgressiveShield', 0); $i++) {
			array_push($items_to_find, Item::get('ProgressiveShield'));
		}

		for ($i = 0; $i < $this->config('item.count.ProgressiveArmor', 0); $i++) {
			array_push($items_to_find, Item::get('ProgressiveArmor'));
		}

		for ($i = 0; $i < $this->config('item.count.BlueMail', 1); $i++) {
			array_push($items_to_find, Item::get('BlueMail'));
		}
		for ($i = 0; $i < $this->config('item.count.Boomerang', 1); $i++) {
			array_push($items_to_find, Item::get('Boomerang'));
		}
		for ($i = 0; $i < $this->config('item.count.BugCatchingNet', 1); $i++) {
			array_push($items_to_find, Item::get('BugCatchingNet'));
		}
		for ($i = 0; $i < $this->config('item.count.HeartContainer', 1); $i++) {
			array_push($items_to_find, Item::get('HeartContainer'));
		}
		for ($i = 0; $i < $this->config('item.count.MirrorShield', 1); $i++) {
			array_push($items_to_find, Item::get('MirrorShield'));
		}

		for ($i = 0; $i < $this->config('item.count.PieceOfHeart', 24); $i++) {
			array_push($items_to_find, Item::get('PieceOfHeart'));
		}

		for ($i = 0; $i < $this->config('item.count.RedBoomerang', 1); $i++) {
			array_push($items_to_find, Item::get('RedBoomerang'));
		}
		for ($i = 0; $i < $this->config('item.count.RedShield', 1); $i++) {
			array_push($items_to_find, Item::get('RedShield'));
		}
		for ($i = 0; $i < $this->config('item.count.CaneOfByrna', 1); $i++) {
			array_push($items_to_find, Item::get('CaneOfByrna'));
		}
		for ($i = 0; $i < $this->config('item.count.RedMail', 1); $i++) {
			array_push($items_to_find, Item::get('RedMail'));
		}
		for ($i = 0; $i < $this->config('item.count.BossHeartContainer', 10); $i++) {
			array_push($items_to_find, Item::get('BossHeartContainer'));
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
		for ($i = 0; $i < $this->config('item.count.TenArrows', 4); $i++) {
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
		for ($i = 0; $i < $this->config('item.count.ThreeHundredRupees', 4); $i++) {
			array_push($items_to_find, Item::get('ThreeHundredRupees'));
		}

		for ($i = 0; $i < $this->config('item.count.Heart', 0); $i++) {
			array_push($items_to_find, Item::get('Heart'));
		}

		for ($i = 0; $i < $this->config('item.count.Rupoor', 0); $i++) {
			array_push($items_to_find, Item::get('Rupoor'));
		}

		for ($i = 0; $i < $this->config('item.count.ExtraBottles', 3); $i++) {
			array_push($items_to_find, $this->getBottle());
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

		for ($i = 0; $i < $this->config('item.count.HalfMagicUpgrade', 0); $i++) {
			array_push($items_to_find, Item::get('HalfMagic'));
		}

		for ($i = 0; $i < $this->config('item.count.QuarterMagicUpgrade', 0); $i++) {
			array_push($items_to_find, Item::get('QuarterMagic'));
		}

		for ($i = 0; $i < $this->config('item.count.MagicUpgrade', 1); $i++) {
			array_push($items_to_find, (mt_rand(0, 3) == 0) ? Item::get('QuarterMagic') : Item::get('HalfMagic'));
		}

		return mt_shuffle($items_to_find);
	}

	/**
	 * This is a quick hack to get prizes shuffled, will adjust later when we model sprites.
	 * this now also handles prize pull trees.
	 *
	 * @TODO: create sprite classes
	 * @TODO: create prize pack classes
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
		];
		$shuffled = mt_shuffle($prizes);

		// write to trees
		$rom->write(0xEFBD4, pack('C*', array_pop($shuffled), array_pop($shuffled), array_pop($shuffled)));
		// write to prize packs
		$rom->write(0x37A78, pack('C*', ...$shuffled));

		// Sprite prize pack
		$offset = 0x6B632;
		$bytes = $rom->read($offset, 243);
		for ($i = 0; $i < 243; $i++) {
			// skip sprites that were not in prize packs before
			if (!isset($bytes[$i]) || ($bytes[$i] & 0xF) == 0) {
				continue;
			}
			$rom->write($offset + $i, pack('C*', ($bytes[$i] >> 4 << 4) + mt_rand(1, 7)));
		}

		// Pack drop chance
		switch ($this->config('rom.HardMode', 0)) {
			case 2:
				list($low, $high) = [3, 4]; // 12.5%, 6.25%
				break;
			case 1:
				list($low, $high) = [2, 3]; // 25%, 12.5%
				break;
			default:
				list($low, $high) = [1, 2]; // 50%, 25%
		}
		$offset = 0x37A62;
		for ($i = 0; $i < 7; $i++) {
			$rom->write($offset + $i, pack('C*', pow(2, mt_rand($low, $high)) - 1));
		}
	}

	/**
	 * Get a random bottle item
	 *
	 * @param boolean $filled return only a filled bottle
	 *
	 * @return Item
	 */
	public function getBottle($filled = false) {
		if ($this->config('rom.HardMode', 0) > 0) {
			return Item::get('BottleWithBee');
		}

		$bottles = [
			Item::get('Bottle'),
			Item::get('BottleWithRedPotion'),
			Item::get('BottleWithGreenPotion'),
			Item::get('BottleWithBluePotion'),
			Item::get('BottleWithBee'),
			Item::get('BottleWithFairy'),
			Item::get('BottleWithGoldBee'),
		];

		return $bottles[mt_rand($filled ? 1 : 0, count($bottles) - 1)];
	}

	/**
	 * Get the World associated with the Randomizer
	 *
	 * @return World
	 */
	public function getWorld() {
		return $this->world;
	}
}
