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
	const LOGIC = 17;
	protected $rng_seed;
	protected $seed;
	protected $world;
	protected $rules;
	protected $type;
	static protected $logic_array;

	/**
	 * Create a new Randomizer
	 *
	 * @param string $rules rules from config to apply to randomization
	 * @param string $type Ruleset to use when deciding if Locations can be reached
	 *
	 * @return void
	 */
	public function __construct($rules = 'normal', $type = 'NoMajorGlitches') {
		if (!self::$logic_array) {
			mt_srand(self::LOGIC);
			self::$logic_array = mt_shuffle(range(0, 255));
			mt_srand();
		}
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

		$my_items = new ItemCollection();

		$locations["Pyramid - Bow"]->setItem($this->config('region.pyramidBowUpgrade', false)
			? Item::get('BowAndSilverArrows')
			: Item::get('BowAndArrows'));

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
					array_push($swords, Item::get('MasterSword'));
					array_push($swords, Item::get('MasterSword'));
					break;
				case 1:
					array_push($swords, Item::get('MasterSword'));
					array_push($swords, Item::get('L3Sword'));
					break;
				default:
					array_push($swords, Item::get('L3Sword'));
					array_push($swords, Item::get('L4Sword'));
					break;
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
			config(["alttp.{$this->rules}.item.count.MasterSword" => $this->config('item.count.MasterSword', 1) - 1]);
			config(["alttp.{$this->rules}.item.count.L3Sword" => $this->config('item.count.L3Sword', 1) - 1]);
			config(["alttp.{$this->rules}.item.count.L4Sword" => $this->config('item.count.L4Sword', 1) - 1]);
		} else {
			$locations["Pyramid - Sword"]->setItem(Item::get('L1Sword'));
			if (config('game-mode') == 'open') {
				config(["alttp.{$this->rules}.item.count.L1Sword" => $this->config('item.count.L1Sword', 0) + 1]);
			} else {
				$locations["Uncle"]->setItem(Item::get('L1Sword'));
				$my_items->addItem(Item::get('L1Sword'));
			}
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

		$advancement_items = $this->getAdvancementItems();

		if ($this->type == 'Glitched') {
			$this->world->getLocation("[dungeon-C-1F] Sanctuary")->setItem(Item::get('PegasusBoots'));
			$key = array_search(Item::get('PegasusBoots'), $advancement_items);
			$my_items->addItem(Item::get('PegasusBoots'));
			unset($advancement_items[$key]);

			// Glitched always has 3 extra bottles, no matter what
			config(["alttp.{$this->rules}.item.count.ExtraBottles" => 3]);
		}

		if ($this->config('rom.HardMode', 0) > 0) {
			$this->world->getLocation("[cave-055] Spike cave")->setItem(Item::get('Rupoor'));
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
		Log::debug(sprintf("Extra Items: %s", count($fill_items)));
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

		$rom->setHardMode($this->config('rom.HardMode', 0), in_array($this->type, ['Glitched']));

		$rom->writeRNGBlock(function() {
			return mt_rand(0, 0x100);
		});

		if ($this->config('sprite.shufflePrizePack', true)) {
			$this->writePrizeShuffleToRom($rom);
			$this->writeTreeShuffleToRom($rom);
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
		$rom->setCapacityUpgradeFills([1, 2, 0, 0]);

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

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setSanctuaryCredits("read a book");
		}

		$name = array_first(mt_shuffle([
			"sahasralah", "sabotaging", "sacahuista", "sacahuiste", "saccharase", "saccharide", "saccharify",
			"saccharine", "saccharins", "sacerdotal", "sackcloths", "salmonella", "saltarelli", "saltarello",
			"saltations", "saltbushes", "saltcellar", "saltshaker", "salubrious", "sandgrouse", "sandlotter",
			"sandstorms", "sandwiched", "sauerkraut", "schipperke", "schismatic", "schizocarp", "schmalzier",
			"schmeering", "schmoosing", "shibboleth", "shovelnose", "sahananana", "sarararara",
		]));
		$rom->setKakarikoTownCredits("$name's homecoming");

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setWoodsmansHutCredits("fresh flapjacks");
				break;
		}

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setSwordsmithsCredits("the dwarven breadsmiths");
				break;
		}

		switch (mt_rand(0, 1)) {
			case 1:
				$rom->setLostWoodsCredits("dancing pickles");
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
			$rom->setUncleTextString("Lonk! Boots\nare in the\n" . $boots_location->getRegion()->getName());
		} else {
			$rom->setUncleText(mt_rand(0, 32));
		}

		$rom->setBlindTextString(array_first(mt_shuffle([
			"What do you\ncall a blind\ndinosaur?\nadoyouthink-\nhesaurus\n",
			"A blind man\nwalks into\na bar.\nAnd a table.\nAnd a chair.\n",
			"What do ducks\nlike to eat?\n\nQuackers!\n",
			"How do you\nset up a party\nin space?\n\nYou planet!\n",
			"I'm glad I\nknow sign\nlanguage,\nit's pretty\nhandy.\n",
			"What did Zelda\nsay to Link at\na secure door?\n\nTRIFORCE!\n",
			"I am on a\nseafood diet.\n\nEvery time\nI see food,\nI eat it.",
			"I hate insect\npuns, they\nreally bug me.",
			"I haven't seen\nthe eye doctor\nin years",
		])));

		$rom->setGanon1TextString(array_first(mt_shuffle([
			"Start your day\nsmiling with a\ndelicious\nwholegrain\nbreakfast\ncreated for\nyour\nincredible\ninsides.",
			"You drove\naway my other\nself, Agahnim\ntwo times…\nBut, I won't\ngive you the\nTriforce.\nI'll defeat\nyou!",
			"Impa says that\nthe mark on\nyour hand\nmeans that you\nare the hero\nchosen to\nawaken Zelda.\nyour blood can\nresurect me.",
		])));

		$silver_arrows_location = $this->world->getLocationsWithItem(Item::get('SilverArrowUpgrade'))->first();

		if (!$silver_arrows_location) {
			$rom->setGanon2TextString("Did you find\nthe arrows on\nPlanet Zebes");
		} else {
			$rom->setGanon2TextString("Did you find\nthe arrows in\n" . $silver_arrows_location->getRegion()->getName());
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

		for ($i = 0; $i < $this->config('item.count.BowAndSilverArrows', 0); $i++) {
			array_push($items_to_find, Item::get('BowAndSilverArrows'));
		}
		for ($i = 0; $i < $this->config('item.count.SilverArrowUpgrade', 1); $i++) {
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

		for ($i = 0; $i < $this->config('item.count.Rupoor', 0); $i++) {
			array_push($items_to_find, Item::get('Rupoor'));
		}

		for ($i = 0; $i < $this->config('item.count.ExtraBottles', 3); $i++) {
			array_push($items_to_find, $this->getBottle());
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

	public function writeTreeShuffleToRom(Rom $rom) {
		$shuffled = array_slice(mt_shuffle([
			0xD9, 0xDA, 0xDB, 0xDC, 0xDD, 0xDE, // rupees and bombs
			0xDF, 0xE0, 0xE1, 0xE2, // magic and arrows
			0xE3, 0xD8, // fairy and heart
		]), 0, 3);

		$rom->write(0xEFBD4, pack('C*', ...$shuffled));
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
