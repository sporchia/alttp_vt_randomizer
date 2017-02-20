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
	const LOGIC = 15;
	protected $rng_seed;
	protected $seed;
	protected $world;
	protected $rules;
	protected $type;

	/**
	 * Create a new Randomizer
	 *
	 * @param string $rules rules from config to apply to randomization
	 * @param string $type Ruleset to use when deciding if Locations can be reached
	 *
	 * @return void
	 */
	public function __construct($rules = 'v8', $type = 'NoMajorGlitches') {
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
		return 'web-' . static::LOGIC;
	}

	/**
	 * Fill all empty Locations with Items using logic from the World.
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

		$medallions = [
			Item::get('Ether'),
			Item::get('Bombos'),
			Item::get('Quake'),
		];

		foreach ($regions['Medallions']->getLocations() as $medallion_location) {
			$medallion = $medallions[mt_rand(0, 2)];
			$medallion_location->setItem($medallion);
		}

		$regions['Fountains']->getLocations()->each(function($fountain) {
			$fountain->setItem($this->getBottle(true));
		});

		$locations = $this->world->getLocations()->filter(function($location) {
			return !is_a($location, Location\Prize::class)
				&& !is_a($location, Location\Medallion::class);
		});

		$swords = [
			Item::get('MasterSword'),
			Item::get('L3Sword'),
			Item::get('L4Sword'),
		];

		if ($this->config('rom.HardMode', false)) {
			$swords = [
				Item::get('MasterSword'),
				Item::get('MasterSword'),
				Item::get('MasterSword'),
			];
		}

		while (count($swords) > 0) {
			$item = array_shift($swords);
			$regions['Swords']->getEmptyLocations()->random()->setItem($item);
		}
		$locations['Uncle']->setItem(Item::get('L1Sword'));

		if (!$this->config('region.swordShuffle', true)) {
			$locations["Pyramid"]->setItem(Item::get('L4Sword'));
			$locations["Blacksmiths"]->setItem(Item::get('L3Sword'));
			$locations["Altar"]->setItem(Item::get('MasterSword'));
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

		$my_items = new ItemCollection([Item::get('L1SwordAndShield')]);

		$advancement_items = $this->getAdvancementItems();

		if ($this->type == 'Glitched') {
			$this->world->getLocation("[dungeon-C-1F] Sanctuary")->setItem(Item::get('PegasusBoots'));
			$key = array_search(Item::get('PegasusBoots'), $advancement_items);
			$my_items->addItem(Item::get('PegasusBoots'));
			unset($advancement_items[$key]);

			// Glitched always has 4 bottles, no matter what
			config(["alttp.{$this->rules}.item.count.ExtraBottles" => 3]);
		}

		// @TODO: consider using hard mode for this? and not having it be red mail
		if ($this->config('region.RedMailByrnaCave', false)) {
			$this->world->getLocation("[cave-055] Spike cave")->setItem(Item::get('RedMail'));
		}

		$base_locations = $locations->getEmptyLocations()->filter(function($location) use ($my_items) {
			return $location->canAccess($my_items);
		})->merge($this->world->getRegion('Escape')->getLocations());

		$this->fillItemsInLocations($advancement_items, $my_items, $locations, $base_locations);

		// Remaining Items
		$this->fillItemsInLocations($this->getItemPool(), $my_items, $locations);

		// Inaccessible Locations
		$locations->filter(function($location) use ($my_items) {
			return !$location->canAccess($my_items);
		})->each(function($location) {
			$location->setItem(new Item('ChocoboEgg', 'Chocobo Egg', null));
		});

		return $this;
	}

	protected function fillItemsInLocations($fill_items, $my_items, $locations, $base_locations = null) {
		$cycle = count($fill_items);
		while (count($fill_items) && $locations->getEmptyLocations()->count()) {
			$item = array_shift($fill_items);
			Log::debug(sprintf("Item: %s [%s] Locations: %s", $item->getNiceName(), $item->getName(), $locations->getEmptyLocations()->count()));

			$available_locations = $locations->getEmptyLocations()->filter(function($location) use ($item, $my_items) {
				return $location->canFill($item, $my_items);
			});

			if ($base_locations) {
				$my_new_items = $my_items->tempAdd($item);

				$available_after_placement = $locations->getEmptyLocations()->filter(function($location) use ($my_new_items) {
					return $location->canAccess($my_new_items);
				});

				if ($cycle > 0 && $available_after_placement->count() == $available_locations->count()) {
					$cycle--;
					Log::debug(sprintf("Skipping Item: %s [%s]", $item->getNiceName(), $item->getName()));
					array_push($fill_items, $item);
					continue;
				}
				$cycle = count($fill_items);

				// prioritize new locations for branching paths, saves from too many advancement items showing up early
				$diff = $available_locations->diff($base_locations);
				Log::debug("DIFF: " . $diff->count());
				if ($diff->count() > 0) {
					$available_locations = $diff->merge($available_locations->randomCollection(ceil($diff->count() / 4)));
				}
			}

			if ($available_locations->count() == 0) {
				foreach ($locations->getEmptyLocations() as $log_loc) {
					Log::error("SOFT LOCK LOCATION: " . $log_loc->getName());
				}
				throw new \Exception(sprintf('No Available Locations: "%s [seed:%s]"', $item->getNiceName(), $this->rng_seed));
			}

			foreach ($available_locations as $location) {
				Log::debug("Available Location: " . $location->getName());
			}

			$limit = 500;
			$found = false;
			while (!$found && $limit-- > 0) {
				$location = $available_locations->random();
				Log::debug("Placing: " . $location->getName());
				$found = $location->fill($item, $my_items);
			};

			if ($limit <= 0) {
				throw new \Exception(sprintf('Unable to put Item: "%s" in a Location [seed:%s]', $item->getNiceName(), $this->rng_seed));
			}

			$my_items->addItem($item);

			// HACK to allow us to use Item::has logic when checking access to locations.
			// @TODO: remove methed from World class and have this just collect any non-randomly placed items.
			foreach ($this->world->collectPrizes($my_items) as $prize) {
				if (!$my_items->has($prize->getName())) {
					$my_items->addItem($prize);
				}
			}
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
			'rules' => $this->rules,
			'logic' => $this->getLogic(),
			'seed' => $this->rng_seed,
			'build' => Rom::BUILD,
			'mode' => trim(preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $this->type)),
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
		if (config('debug', false)) {
			$rom->setDebugMode(true);
			$rom->setUncleTextCustom("Test Seed\n\n" . $this->rng_seed);
		} else {
			$this->setStartText($rom);
		}

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

		if ($this->config('rom.HardMode', false)) {
			$rom->setHardMode(true, in_array($this->type, ['Glitched']));

			// @TODO: currently Empty magic bat gives 1/2 magic, this fixes that for time being
			// basically setting item to 0xFF reverts Magic Bat to old behavior, we can remove this once we have a
			// proper 'Nothing' item.
			$magic_bat = $this->world->getLocation("Magic Bat");
			if ($magic_bat->hasItem(Item::get('Nothing'))) {
				$magic_bat->writeItem($rom, Item::get('Arrow'));
			}
		}

		$rom->writeRNGBlock(function() {
			return mt_rand(0, 0x100);
		});

		if ($this->config('sprite.shufflePrizePack', true)) {
			$this->writePrizeShuffleToRom($rom);
		}

		$this->randomizeCredits($rom);

		$rom->setMaxArrows();
		$rom->setMaxBombs();
		$rom->setCapacityUpgradeFills([1, 2, 0, 0]);

		$rom->removeUnclesShield();

		switch ($this->type) {
			case 'Glitched':
				$type_flag = 'G';
				$rom->setSwampWaterLevel(false);
				$rom->setPreAgahnimDarkWorldDeathInDungeon(false);
				$rom->setRandomizerSeedType('Glitched');
				break;
			case 'SpeedRunner':
				$type_flag = 'S';
				$rom->setSwampWaterLevel(false);
				break;
			case 'NoMajorGlitches':
			default:
				$type_flag = 'C';
				break;
		}

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
	 * Randomize portions of the ending credits sequence
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return $this
	 */
	public function randomizeCredits(Rom $rom) {
		switch (mt_rand(0, 2)) {
			case 1:
				$rom->setKingsReturnCredits('fellowship of the ring');
				break;
			case 2:
				$rom->setKingsReturnCredits('the two towers');
				break;
		}

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setWoodsmansHutCredits('fresh flapjacks');
				break;
		}

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setSwordsmithsCredits('the dwarven breadsmiths');
				break;
		}

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setLostWoodsCredits('dancing pickles');
				break;
		}


		return $this;
	}

	/**
	 * Randomly set the starting text for the Uncle, there is a chance he will tell you the Region Pegasus Boots
	 * reside in
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return $this
	 */
	public function setStartText(Rom $rom) {
		$boots_location = $this->world->getLocationsWithItem(Item::get('PegasusBoots'))->first();

		if ($this->config('spoil.BootsLocation', true) && mt_rand() % 20 == 0 && $boots_location) {
			Log::info('Boots revealed');
			$rom->setUncleTextCustom("Lonk! Boots\nare in the\n" . $boots_location->getRegion()->getName());
		} else {
			$rom->setUncleText(mt_rand(0, 32));
		}

		return $this;
	}

	/**
	 * Get a shuffled array of Item's necessary for giving access to more locations as well as completing the game.
	 *
	 * @return array
	 */
	public function getAdvancementItems() {
		$advancement_items = [];

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
		for ($i = 0; $i < max(1, $this->config('item.count.PowerGlove', 1)); $i++) {
			array_push($advancement_items, Item::get('PowerGlove'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.Quake', 1)); $i++) {
			array_push($advancement_items, Item::get('Quake'));
		}
		for ($i = 0; $i < $this->config('item.count.Shovel', 1); $i++) {
			array_push($advancement_items, Item::get('Shovel'));
		}
		for ($i = 0; $i < max(1, $this->config('item.count.TitansMitt', 1)); $i++) {
			array_push($advancement_items, Item::get('TitansMitt'));
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
		for ($i = 0; $i < $this->config('item.count.StaffOfByrna', 1); $i++) {
			array_push($items_to_find, Item::get('StaffOfByrna'));
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

		for ($i = 0; $i < $this->config('item.count.BowAndSilverArrows', 0); $i++) {
			array_push($items_to_find, Item::get('BowAndSilverArrows'));
		}
		for ($i = 0; $i < $this->config('item.count.SilverArrowUpgrade', 0); $i++) {
			array_push($items_to_find, Item::get('SilverArrowUpgrade'));
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


		for ($i = 0; $i < $this->config('item.count.ExtraBottles', 3); $i++) {
			array_push($items_to_find, $this->getBottle());
		}

		for ($i = 0; $i < $this->config('item.count.MagicUpgrade', 1); $i++) {
			array_push($items_to_find, (mt_rand(0, 3) == 0) ? Item::get('QuarterMagic') : Item::get('HalfMagic'));
		}

		return mt_shuffle($items_to_find);
	}

	/**
	 * This is a quick hack to get prizes shuffled, will adjust later when we model sprites
	 *
	 * @TODO: create sprite classes
	 * @TODO: create prize pack classes
	 */
	public function writePrizeShuffleToRom(Rom $rom) {
		// Pack shuffle
		$offset = 0x37A78;
		$prizes = [
			0xD8, 0xD8, 0xD8, 0xD8, 0xD9, 0xD8, 0xD8, 0xD9,
			0xDA, 0xD9, 0xDA, 0xDB, 0xDA, 0xD9, 0xDA, 0xDA,
			0xE0, 0xDF, 0xDF, 0xDA, 0xE0, 0xDF, 0xD8, 0xDF,
			0xDC, 0xDC, 0xDC, 0xDD, 0xDC, 0xDC, 0xDE, 0xDC,
			0xE1, 0xD8, 0xE1, 0xE2, 0xE1, 0xD8, 0xE1, 0xE2,
			0xDF, 0xD9, 0xD8, 0xE1, 0xDF, 0xDC, 0xD9, 0xD8,
			0xD8, 0xE3, 0xE0, 0xDB, 0xDE, 0xD8, 0xDB, 0xE2,
		];
		$shuffled = mt_shuffle($prizes);
		$rom->write($offset, pack('C*', ...$shuffled));
	}

	/**
	 * Get a random bottle item
	 *
	 * @param boolean $filled return only a filled bottle
	 *
	 * @return Item
	 */
	public function getBottle($filled = false) {
		if ($this->config('rom.HardMode', false)) {
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
