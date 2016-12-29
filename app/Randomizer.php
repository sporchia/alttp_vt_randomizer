<?php namespace ALttP;

use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use Log;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

/**
 * Main class for randomization. All the magic happens here. We use mt_rand as it is much faster than rand. Not all PHP
 * functions support mt_rand (e.g. array_shuffle), so those had to be cloned to maintain seed integrity.
 */
class Randomizer {
	/**
	 * This represents the logic for the Randmizer, if any locations logic gets changed this should change as well, so
	 * one knows that if they got the same seed, items will probably not be in the same locations.
	 */
	const LOGIC = 3;
	protected $seed;
	protected $world;
	protected $rules;

	/**
	 * Create a new Randomizer
	 *
	 * @param string $rules rules from config to apply to randomization
	 *
	 * @return void
	 */
	public function __construct($rules = 'v8') {
		$this->rules = $rules;
		$this->world = new World($rules);
	}

	/**
	 * Get the current seed number
	 *
	 * @return int
	 */
	public function getSeed() {
		return $this->seed;
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
	 * @param int|null $seed Seed to create, or random if null
	 *
	 * @return $this
	 */
	public function makeSeed(int $seed = null) {
		$seed = $seed ?: mt_rand(1, 999999999);
		$this->seed = $seed % 1000000000;
		mt_srand($seed);

		Log::info(sprintf("Seed: %s", $this->seed));

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
			$prizes = $this->mt_shuffle($prizes);
		}

		while (count($prizes) > 3) {
			$item = array_shift($prizes);
			while(!$regions['Crystals']->getEmptyLocations()->random()->fill($item, Item::all()));
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
			while(!$regions['Pendants']->getEmptyLocations()->random()->fill($item, Item::all()));
		}

		if (!$this->config('prize.shufflePendants', true)) {
			$pendant_locations = $this->world->getRegion('Pendants')->getLocations();
			$pendant_locations["Eastern Palace Pendant"]->setItem(Item::get('PendantOfCourage'));
			$pendant_locations["Desert Palace Pendant"]->setItem(Item::get('PendantOfPower'));
			$pendant_locations["Tower of Hera Pendant"]->setItem(Item::get('PendantOfWisdom'));
		}

		$required = $this->getAdvancementItems();

		$medallions = [
			Item::get('Ether'),
			Item::get('Bombos'),
			Item::get('Quake'),
		];

		foreach ($regions['Medallions']->getLocations() as $medallion_location) {
			$medallion = $medallions[mt_rand(0, 2)];
			array_push($required, $medallion);
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

		while (count($swords) > 0) {
			$item = array_shift($swords);
			while(!$regions['Swords']->getEmptyLocations()->random()->fill($item, Item::all()));
		}
		$locations['Uncle']->setItem(Item::get('L1SwordAndShield'));

		if (!$this->config('region.swordShuffle', true)) {
			$locations["Pyramid"]->setItem(Item::get('L4Sword'));
			$locations["Blacksmiths"]->setItem(Item::get('L3Sword'));
			$locations["Alter"]->setItem(Item::get('MasterSword'));
		}

		// for filling base (Maps/Compasses/Keys) items assume you have everything
		foreach ($regions as $region) {
			$region->fillBaseItems(Item::all());
		}

		$my_items = new ItemCollection;
		$my_items->setWorld($this->world);

		$base_locations = $locations->getEmptyLocations()->filter(function($location) use ($my_items) {
			return $location->canAccess($my_items);
		});

		// fill advancement items
		$advancement_items = $this->getAdvancementItems();
		$cycle = count($advancement_items);
		while (count($advancement_items)) {
			$item = array_shift($advancement_items);
			Log::debug(sprintf("Item: %s [%s]", $item->getNiceName(), $item->getName()));

			$available_locations = $locations->getEmptyLocations()->filter(function($location) use ($item, $my_items) {
				return $location->canFill($item, $my_items);
			});

			$my_new_items = $my_items->tempAdd($item);

			$available_after_placement = $locations->getEmptyLocations()->filter(function($location) use ($my_new_items) {
				return $location->canAccess($my_new_items);
			});

			if ($cycle > 0 && $available_after_placement->count() == $available_locations->count()) {
				$cycle--;
				Log::debug(sprintf("Skipping Item: %s [%s]", $item->getNiceName(), $item->getName()));
				array_push($advancement_items, $item);
				continue;
			}
			$cycle = count($advancement_items);

			// prioritize new locations for branching paths, saves from too many advancement items showing up early
			$diff = $available_locations->diff($base_locations);
			Log::debug("DIFF: " . $diff->count());
			if ($diff->count() > 0) {
				$available_locations = $diff->merge($available_locations->randomCollection(ceil($diff->count() / 4)));
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
				throw new \Exception(sprintf('Unable to put Item: "%s" in a Location', $item->getNiceName()));
			}

			$my_items->addItem($item);
		}

		$items_to_find = $this->getItemPool();

		// Remaining Items
		while (count($items_to_find) > 0 && $locations->getEmptyLocations()->count()) {
			$item = array_shift($items_to_find);
			Log::debug(sprintf("Item: %s [%s]", $item->getNiceName(), $item->getName()));

			$available_locations = $locations->getEmptyLocations()->filter(function($location) use ($item, $my_items) {
				return $location->canFill($item, $my_items);
			});

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
				throw new \Exception(sprintf('Unable to put Item: "%s" in a Location', $item->getNiceName()));
			}

			$my_items->addItem($item);
		}

		Log::info('Important Items:');
		$locations->filter(function($location) use ($required) {
			return in_array($location->getItem(), $required);
		})->each(function($location) {
			Log::info(sprintf("%-'.90s%s", $location->getName(), $location->getItem()->getNiceName()));
		});

		$this->getSpoiler();

		return $this;
	}

	/**
	 * Get the current spoiler for this seed
	 *
	 * @return array
	 */
	public function getSpoiler() {
		$spoiler = [];

		$locations = $this->world->getLocations()->filter(function($location) {
			return !is_a($location, Location\Prize::class)
				&& !is_a($location, Location\Medallion::class)
				&& !is_a($location, Location\Fountain::class);
		});

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
		$spoiler['playthrough'] = $this->getPlayThrough($this->world);
		$spoiler['meta'] = [
			'rules' => $this->rules,
			'logic' => $this->getLogic(),
			'seed' => $this->seed,
		];
		return $spoiler;
	}

	/**
	 * Return an array of Locations to collect all Advancement Items in the game in order.
	 *
	 * @param World $world World with locations filled with items
	 *
	 * @return array
	 */
	public function getPlayThrough(World $world) {
		$my_items = new ItemCollection;
		$my_items->setWorld($world);
		$locations = $world->getLocations()->filter(function($location) {
			return !is_a($location, Location\Prize::class)
				&& !is_a($location, Location\Medallion::class)
				&& !is_a($location, Location\Fountain::class);
		});

		$location_order = [];
		$location_round = [];

		$progression_items = $this->getAdvancementItems();
		$required_medallions = [
			$world->getLocation("Misery Mire Medallion")->getItem(),
			$world->getLocation("Turtle Rock Medallion")->getItem(),
		];

		$complexity = 0;
		do {
			$complexity++;
			$location_round[$complexity] = [];
			$available_locations = $locations->filter(function($location) use ($my_items) {
				return $location->canAccess($my_items);
			});

			$found_items = $available_locations->getItems();
			$have_bottle = $my_items->hasABottle();

			$available_locations->each(function($location) use (&$location_order, &$location_round, $have_bottle, $progression_items, $required_medallions, $complexity) {
				if ((in_array($location->getItem(), $progression_items) || (!$have_bottle && is_a($location->getItem(), Item\Bottle::class)))
					&& (!is_a($location->getItem(), Item\Medallion::class) || in_array($location->getItem(), $required_medallions))
						&& !in_array($location, $location_order)) {
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

		return $ret;
	}

	/**
	 * get config values based on the rulesset for this Randomizer
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
			$rom->enableDebugMode();
			$rom->setUncleTextCustom("Test Seed\n\n" . $this->seed);
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

		$rom->writeRNGBlock(function() {
			return mt_rand(0, 0x100);
		});
		$rom->setSeedString(str_pad(sprintf("VT%s%'.09d%'.03s%s", 'C', $this->seed, static::LOGIC, $this->rules), 21, ' '));

		return $rom;
	}

	/**
	 * Randomly set the starting text for the Uncle, there is a chance he will tell you the Region Pegasus Boots
	 * reside in
	 *
	 * @param Rom $rom ROM to write to
	 *
	 * @return bool
	 */
	public function setStartText(Rom $rom) {
		$boots_location = $this->world->getLocationsWithItem(Item::get('PegasusBoots'))->first();

		if ($this->config('spoil.BootsLocation', true) && mt_rand() % 20 == 0 && $boots_location) {
			Log::info('Boots revealed');
			$rom->setUncleTextCustom("Lonk! Boots\nare in the\n" . $boots_location->getRegion()->getName());
		} else {
			$rom->setUncleText(mt_rand(0, 31));
		}

		return $this;
	}

	/**
	 * Get a shuffled array of Item's necessary for giving access to more locations as well as completing the game.
	 *
	 * @return array
	 */
	public function getAdvancementItems() {
		// Items that open up more locations
		return $this->mt_shuffle([
			Item::get('Bow'),
			Item::get('BookOfMudora'),
			Item::get('Hammer'),
			Item::get('Hookshot'),
			Item::get('MagicMirror'),
			Item::get('OcarinaInactive'),
			Item::get('PegasusBoots'),
			Item::get('PowerGlove'),
			Item::get('Cape'),
			Item::get('Mushroom'),
			Item::get('Shovel'),
			$this->getBottle(),
			Item::get('Lamp'),
			Item::get('Powder'),
			Item::get('MoonPearl'),
			Item::get('CaneOfSomaria'),
			Item::get('FireRod'),
			Item::get('Flippers'),
			Item::get('IceRod'),
			Item::get('TitansMitt'),
			Item::get('Ether'),
			Item::get('Bombos'),
			Item::get('Quake'),
		]);
	}

	/**
	 * Get all the Items to insert into the Locations Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getItemPool() {
		$items_to_find = [];

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
		for ($i = 0; $i < $this->config('item.count.ArrowUpgrade70', 1); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade70'));
		}

		for ($i = 0; $i < $this->config('item.count.Arrow', 1); $i++) {
			array_push($items_to_find, Item::get('Arrow'));
		}
		for ($i = 0; $i < $this->config('item.count.TenArrows', 7); $i++) {
			array_push($items_to_find, Item::get('TenArrows'));
		}

		for ($i = 0; $i < $this->config('item.count.Bomb', 0); $i++) {
			array_push($items_to_find, Item::get('Bomb'));
		}
		for ($i = 0; $i < $this->config('item.count.ThreeBombs', 12); $i++) {
			array_push($items_to_find, Item::get('ThreeBombs'));
		}

		for ($i = 0; $i < $this->config('item.count.OneRupee', 2); $i++) {
			array_push($items_to_find, Item::get('OneRupee'));
		}
		for ($i = 0; $i < $this->config('item.count.FiveRupees', 2); $i++) {
			array_push($items_to_find, Item::get('FiveRupees'));
		}
		for ($i = 0; $i < $this->config('item.count.TwentyRupees', 21); $i++) {
			array_push($items_to_find, Item::get('TwentyRupees'));
		}
		for ($i = 0; $i < $this->config('item.count.FiftyRupees', 7); $i++) {
			array_push($items_to_find, Item::get('FiftyRupees'));
		}
		for ($i = 0; $i < $this->config('item.count.OneHundredRupees', 6); $i++) {
			array_push($items_to_find, Item::get('OneHundredRupees'));
		}
		for ($i = 0; $i < $this->config('item.count.ThreeHundredRupees', 4); $i++) {
			array_push($items_to_find, Item::get('ThreeHundredRupees'));
		}

		for ($i = 0; $i < $this->config('item.count.ExtraBottles', 3); $i++) {
			array_push($items_to_find, $this->getBottle());
		}

		array_push($items_to_find, (mt_rand(0, 3) == 0) ? Item::get('QuarterMagic') : Item::get('HalfMagic'));

		return $this->mt_shuffle($items_to_find);
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

	/**
	 * Shuffle the contents of an array using mt_rand
	 *
	 * @param array $array array to shuffle
	 *
	 * @return array
	 */
	public function mt_shuffle(array $array) {
		$new_array = [];
		while(count($array)) {
			$pull_key = mt_rand(0, count($array) - 1);
			$new_array = array_merge($new_array, array_splice($array, $pull_key, 1));
		}
		return $new_array;
	}
}
