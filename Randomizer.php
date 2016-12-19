<?php namespace Randomizer;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Randomizer\Support\Config;
use Randomizer\Support\ItemCollection;
use Randomizer\Support\LocationCollection;

/**
 * Main class for randomization. All the magic happens here. We use mt_rand as it is much faster than rand. Not all PHP
 * functions support mt_rand (e.g. array_shuffle), so those had to be cloned to maintain seed integrity.
 */
class Randomizer {
	protected $seed;
	protected $log;
	protected $world;
	protected $config;
	protected $debug = false;
	protected $spoiler = true;

	/**
	 * Create a new Randomizer
	 *
	 * @param array $config Options for the randomizer
	 * @param Logger|null $log Optional Logger to capture log messages
	 *
	 * @return void
	 */
	public function __construct(Config $config = null, Logger $log = null) {
		$this->log = $log ?: new Logger('randomizer');
		$this->config = $config ?: new Config;
		$this->world = new World($config);
	}

	/**
	 * Enable/Disable Spoiler Log to file.
	 *
	 * @param bool $show log to file or not
	 *
	 * @return $this
	 */
	public function setSpoilerFile(bool $show = true) {
		$this->spoiler = $show;
		return $this;
	}

	/**
	 * Fill all empty Locations with Items using logic from the World.
	 *
	 * @param int|null $seed Seed to create, or random if null
	 *
	 * @return $this
	 */
	public function makeSeed(int $seed = null) {
		$seed = $seed ?: mt_rand(1, 9999999999);
		$this->seed = $seed;
		mt_srand($seed);

		if ($this->spoiler) {
			$spoiler = sprintf('out/' . $this->config->get('output.file.spoiler', 'alttp - p.%s.txt'), $this->seed);
			if (file_exists($spoiler)) unlink($spoiler);
			$this->log->pushHandler((new StreamHandler($spoiler, Logger::INFO))->setFormatter(new LineFormatter("%message%\n")));
		}
		$this->log->info(sprintf("Seed: %s", $this->seed));

		$regions = $this->world->getRegions();

		// for filling base (Maps/Compasses/Keys) items assume you have everything
		foreach ($regions as $region) {
			$region->fillBaseItems(Item::all());
		}

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

		if ($this->config->get('prize.crossWorld', true)) {
			$prizes = $this->mt_shuffle($prizes);
		}

		while (count($prizes) > 3) {
			$item = array_shift($prizes);
			while(!$regions['Crystals']->getEmptyLocations()->random()->fill($item, Item::all()));
		}

		while (count($prizes) > 0) {
			$item = array_shift($prizes);
			while(!$regions['Pendants']->getEmptyLocations()->random()->fill($item, Item::all()));
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
			$this->log->debug(sprintf("Item: %s [%s]", $item->getNiceName(), $item->getName()));

			$available_locations = $locations->getEmptyLocations()->filter(function($location) use ($item, $my_items) {
				return $location->canFill($item, $my_items);
			});

			$my_new_items = $my_items->tempAdd($item);

			$available_after_placement = $locations->getEmptyLocations()->filter(function($location) use ($my_new_items) {
				return $location->canAccess($my_new_items);
			});

			if ($cycle > 0 && $available_after_placement->count() == $available_locations->count()) {
				$cycle--;
				$this->log->debug(sprintf("Skipping Item: %s [%s]", $item->getNiceName(), $item->getName()));
				array_push($advancement_items, $item);
				continue;
			}
			$cycle = count($advancement_items);

			// prioritize new locations for branching paths, saves from too many advancement items showing up early
			$diff = $available_locations->diff($base_locations);
			$this->log->debug("DIFF: " . $diff->count());
			if ($diff->count() > 0) {
				$available_locations = $diff->merge($available_locations->randomCollection(ceil($diff->count() / 4)));
			}

			foreach ($available_locations as $location) {
				$this->log->debug("Available Location: " . $location->getName());
			}

			$limit = 500;
			$found = false;
			while (!$found && $limit-- > 0) {
				$location = $available_locations->random();
				$this->log->debug("Placing: " . $location->getName());
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
			$this->log->debug(sprintf("Item: %s [%s]", $item->getNiceName(), $item->getName()));

			$available_locations = $locations->getEmptyLocations()->filter(function($location) use ($item, $my_items) {
				return $location->canFill($item, $my_items);
			});

			foreach ($available_locations as $location) {
				$this->log->debug("Available Location: " . $location->getName());
			}

			$limit = 500;
			$found = false;
			while (!$found && $limit-- > 0) {
				$location = $available_locations->random();
				$this->log->debug("Placing: " . $location->getName());
				$found = $location->fill($item, $my_items);
			};

			if ($limit <= 0) {
				throw new \Exception(sprintf('Unable to put Item: "%s" in a Location', $item->getNiceName()));
			}

			$my_items->addItem($item);
		}

		$this->log->info('Important Items:');
		$locations->filter(function($location) use ($required) {
			return in_array($location->getItem(), $required);
		})->each(function($location) {
			$this->log->info(sprintf("%-'.90s%s", $location->getName(), $location->getItem()->getNiceName()));
		});

		if ($locations->getEmptyLocations()->count()) {
			$this->log->info(sprintf("EXTRA ITEMS: %s  EXTRA LOCATIONS: %s", count($items_to_find), $locations->getEmptyLocations()->count()));
			foreach($locations->getEmptyLocations() as $location) {
				$this->log->debug("EMPTY: " . $location->getName());
			}
		}

		foreach ($this->world->getRegions() as $name => $region) {
			$this->log->info("");
			$this->log->info("$name:");
			$region->getLocations()->getNonEmptyLocations()->each(function($location) {
				$this->log->info(sprintf("%-'.90s%s", $location->getName(), $location->getItem()->getNiceName()));
			});
			$region->getLocations()->getEmptyLocations()->each(function($location) {
				$this->log->info(sprintf("%-'.90s%s", $location->getName(), 'Nothing'));
			});
		}

		return $this;
	}

	/**
	 * Save all changes made by this Randomizer to a new ROM file.
	 * @TODO: should really dep inject the ROM
	 *
	 * @param string $save_file filename to save the file
	 *
	 * @return bool
	 */
	public function save($save_file) {
		$rom = new ALttPRom('in/alttp-v8.sfc', $this->log);

		if ($this->debug) {
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

		return $rom->save(sprintf($save_file . $this->config->get('output.file.name', 'alttp - p.%s.sfc'), $this->seed));
	}

	/**
	 * Randomly set the starting text for the Uncle, there is a chance he will tell you the Region Pegasus Boots
	 * reside in
	 *
	 * @param ALttPRom $rom ROM to write to
	 *
	 * @return bool
	 */
	public function setStartText(ALttPRom $rom) {
		$boots_location = $this->world->getLocationsWithItem(Item::get('PegasusBoots'))->first();

		if ($this->config->get('spoil.BootsLocation', true) && mt_rand() % 7 == 0 && $boots_location) {
			$this->log->info('Boots revealed');
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

		for ($i = 0; $i < $this->config->get('item.count.BlueMail', 1); $i++) {
			array_push($items_to_find, Item::get('BlueMail'));
		}
		for ($i = 0; $i < $this->config->get('item.count.Boomerang', 1); $i++) {
			array_push($items_to_find, Item::get('Boomerang'));
		}
		for ($i = 0; $i < $this->config->get('item.count.BugCatchingNet', 1); $i++) {
			array_push($items_to_find, Item::get('BugCatchingNet'));
		}
		for ($i = 0; $i < $this->config->get('item.count.HeartContainer', 1); $i++) {
			array_push($items_to_find, Item::get('HeartContainer'));
		}
		for ($i = 0; $i < $this->config->get('item.count.MirrorShield', 1); $i++) {
			array_push($items_to_find, Item::get('MirrorShield'));
		}

		for ($i = 0; $i < $this->config->get('item.count.PieceOfHeart', 24); $i++) {
			array_push($items_to_find, Item::get('PieceOfHeart'));
		}

		for ($i = 0; $i < $this->config->get('item.count.RedBoomerang', 1); $i++) {
			array_push($items_to_find, Item::get('RedBoomerang'));
		}
		for ($i = 0; $i < $this->config->get('item.count.RedShield', 1); $i++) {
			array_push($items_to_find, Item::get('RedShield'));
		}
		for ($i = 0; $i < $this->config->get('item.count.StaffOfByrna', 1); $i++) {
			array_push($items_to_find, Item::get('StaffOfByrna'));
		}
		for ($i = 0; $i < $this->config->get('item.count.RedMail', 1); $i++) {
			array_push($items_to_find, Item::get('RedMail'));
		}
		for ($i = 0; $i < $this->config->get('item.count.BossHeartContainer', 10); $i++) {
			array_push($items_to_find, Item::get('BossHeartContainer'));
		}

		for ($i = 0; $i < $this->config->get('item.count.BombUpgrade5', 6); $i++) {
			array_push($items_to_find, Item::get('BombUpgrade5'));
		}
		for ($i = 0; $i < $this->config->get('item.count.BombUpgrade10', 1); $i++) {
			array_push($items_to_find, Item::get('BombUpgrade10'));
		}
		for ($i = 0; $i < $this->config->get('item.count.BombUpgrade50', 0); $i++) {
			array_push($items_to_find, Item::get('BombUpgrade50'));
		}
		for ($i = 0; $i < $this->config->get('item.count.ArrowUpgrade5', 6); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade5'));
		}
		for ($i = 0; $i < $this->config->get('item.count.ArrowUpgrade10', 1); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade10'));
		}
		for ($i = 0; $i < $this->config->get('item.count.ArrowUpgrade70', 1); $i++) {
			array_push($items_to_find, Item::get('ArrowUpgrade70'));
		}

		for ($i = 0; $i < $this->config->get('item.count.Arrow', 1); $i++) {
			array_push($items_to_find, Item::get('Arrow'));
		}
		for ($i = 0; $i < $this->config->get('item.count.TenArrows', 7); $i++) {
			array_push($items_to_find, Item::get('TenArrows'));
		}

		for ($i = 0; $i < $this->config->get('item.count.Bomb', 0); $i++) {
			array_push($items_to_find, Item::get('Bomb'));
		}
		for ($i = 0; $i < $this->config->get('item.count.ThreeBombs', 12); $i++) {
			array_push($items_to_find, Item::get('ThreeBombs'));
		}

		for ($i = 0; $i < $this->config->get('item.count.OneRupee', 2); $i++) {
			array_push($items_to_find, Item::get('OneRupee'));
		}
		for ($i = 0; $i < $this->config->get('item.count.FiveRupees', 2); $i++) {
			array_push($items_to_find, Item::get('FiveRupees'));
		}
		for ($i = 0; $i < $this->config->get('item.count.TwentyRupees', 21); $i++) {
			array_push($items_to_find, Item::get('TwentyRupees'));
		}
		for ($i = 0; $i < $this->config->get('item.count.FiftyRupees', 7); $i++) {
			array_push($items_to_find, Item::get('FiftyRupees'));
		}
		for ($i = 0; $i < $this->config->get('item.count.OneHundredRupees', 6); $i++) {
			array_push($items_to_find, Item::get('OneHundredRupees'));
		}
		for ($i = 0; $i < $this->config->get('item.count.ThreeHundredRupees', 4); $i++) {
			array_push($items_to_find, Item::get('ThreeHundredRupees'));
		}

		for ($i = 0; $i < $this->config->get('item.count.ExtraBottles', 3); $i++) {
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
