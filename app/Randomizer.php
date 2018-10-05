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
	protected $seed;
	protected $world;
	protected $difficulty;
	protected $variation;
	protected $logic;
	protected $starting_equipment;
	protected $advancement_items = [];

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
	public function __construct($difficulty = 'normal', $logic = 'NoGlitches', $goal = 'ganon', $variation = 'none') {
		if ($logic === 'None') {
			config(['alttp.region.forceSkullWoodsKey' => false]);
		}
		$this->difficulty = $difficulty;
		$this->variation = $variation;
		$this->logic = $logic;
		$this->goal = $goal;
		$this->world = World::factory(config('alttp.mode.state'), $difficulty, $logic, $goal, $variation);
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
	 * Get the current Logic identifier
	 *
	 * @return string
	 */
	public function getLogic() {
		switch ($this->logic) {
			case 'None': return 'none-' . static::LOGIC;
			case 'NoGlitches': return 'no-glitches-' . static::LOGIC;
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
			case 'NoGlitches': return 'No Glitches';
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
	 * @return $this
	 */
	public function makeSeed() {
		Log::info("Making Seed");

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
			$locations["Desert Palace - Boss"]->setItem($boss_item);
			$locations["Eastern Palace - Boss"]->setItem($boss_item);
			$locations["Ice Palace - Boss"]->setItem($boss_item);
			$locations["Misery Mire - Boss"]->setItem($boss_item);
			$locations["Palace of Darkness - Boss"]->setItem($boss_item);
			$locations["Skull Woods - Boss"]->setItem($boss_item);
			$locations["Swamp Palace - Boss"]->setItem($boss_item);
			$locations["Thieves' Town - Boss"]->setItem($boss_item);
			$locations["Turtle Rock - Boss"]->setItem($boss_item);
			$locations["Tower of Hera - Boss"]->setItem($boss_item);
		}

		$dungeon_items = $this->getDungeonPool();
		$advancement_items = $this->getAdvancementItems();
		$nice_items = $this->getNiceItems();
		$trash_items = ($this->config('rng_items'))
			? array_fill(0, count($this->getItemPool()), Item::get('singleRNG'))
			: $this->getItemPool();

		if (in_array($this->logic, ['MajorGlitches', 'OverworldGlitches', 'None']) && $this->difficulty !== 'custom') {
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
			for ($i = 0; $i < 6; ++$i) {
				$this->starting_equipment->addItem(Item::get('BossHeartContainer'));
			}
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

			if ($this->config('mode.weapons') == 'uncle') {
				$uncle_item = $this->world->getLocation("Link's Uncle")->getItem();
				if ($uncle_item !== null && !$uncle_item->getTarget() instanceof Item\Sword) {
					throw new \Exception("Uncle must have a sword item when Uncle Assured is selected");
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

		$this->advancement_items = fy_shuffle($advancement_items);

		$filler = Filler::factory('RandomAssumed', $this->world);

		// mess with the junk fill
		if ($this->goal == 'triforce-hunt' || $this->goal == 'pedestal') {
			$filler->setGanonJunkLimits(15, 50);
		}
		if (in_array($this->logic, ['OverworldGlitches', 'MajorGlitches'])) {
			$filler->setGanonJunkLimits(0, 0);
		}

		$filler->fill($dungeon_items, $this->advancement_items, $nice_items, $trash_items);

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
		// most restrictive first
		$boss_locations = [
			['Ganons Tower', 'top'],
			['Ganons Tower', 'middle'],
			['Tower of Hera', null],
			['Skull Woods', null],
			['Eastern Palace', null],
			['Desert Palace', null],
			['Palace of Darkness', null],
			['Swamp Palace', null],
			['Thieves Town', null],
			['Ice Palace', null],
			['Misery Mire', null],
			['Turtle Rock', null],
			['Ganons Tower', 'bottom'],
		];

		if ($this->world->config('mode.weapons') == 'swordless') {
			array_splice($boss_locations, 8, 1); // remove Ice Palace
			$this->world->getRegion('Ice Palace')->setBoss(Boss::get("Kholdstare"));
		}

		$placeable_bosses = Boss::all()->filter(function($boss) {
			if ($this->world->config('mode.weapons') == 'swordless' && $boss->getName() == "Kholdstare") {
				return false;
			}
			return !in_array($boss->getName(), [
				"Agahnim",
				"Agahnim2",
				"Ganon",
			]);
		});

		switch ($this->config('boss_shuffle')) {
			case 'chaos':
				foreach ($boss_locations as $location) {
					do {
						$boss = Boss::all()->random();
					} while (!$this->world->getRegion($location[0])->canPlaceBoss($boss, $location[1]));
					logger()->debug(json_encode([$location[0], $location[1], $boss->getName()]));
					$this->world->getRegion($location[0])->setBoss($boss, $location[1]);
				}
				break;
			case 'normal': // 1 copy of each, +3 other copies
				$bosses = fy_shuffle(array_merge($placeable_bosses->values(), $placeable_bosses->randomCollection(3)->values()));
				foreach ($boss_locations as $location) {
					$boss = array_shift($bosses);
					while (!$this->world->getRegion($location[0])->canPlaceBoss($boss, $location[1])) {
						array_push($bosses, $boss);
						$boss = array_shift($bosses);
					}
					logger()->debug(json_encode([$location[0], $location[1], $boss->getName()]));
					$this->world->getRegion($location[0])->setBoss($boss, $location[1]);
				}
				break;
			case 'basic': // 1:1
				$bosses = fy_shuffle(array_merge($placeable_bosses->values(), [
					Boss::get("Armos Knights"),
					Boss::get("Lanmolas"),
					Boss::get("Moldorm"),
				]));
				foreach ($boss_locations as $location) {
					$boss = array_shift($bosses);
					while (!$this->world->getRegion($location[0])->canPlaceBoss($boss, $location[1])) {
						array_push($bosses, $boss);
						$boss = array_shift($bosses);
					}
					logger()->debug(json_encode([$location[0], $location[1], $boss->getName()]));
					$this->world->getRegion($location[0])->setBoss($boss, $location[1]);
				}
				break;
			case 'off':
			default:
				$this->world->getRegion('Eastern Palace')->setBoss(Boss::get("Armos Knights"));
				$this->world->getRegion('Desert Palace')->setBoss(Boss::get("Lanmolas"));
				$this->world->getRegion('Tower of Hera')->setBoss(Boss::get("Moldorm"));
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
		}

		$this->world->getRegion('Hyrule Castle Tower')->setBoss(Boss::get("Agahnim"));
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
			return $location instanceof Location\Prize;
		})->randomCollection(15);

		$crystal_locations = $prize_locations->filter(function($location) {
			return $location instanceof Location\Prize\Crystal;
		});

		$pendant_locations = $prize_locations->filter(function($location) {
			return $location instanceof Location\Prize\Pendant;
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
				return $item instanceof Item\Crystal;
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
				return $item instanceof Item\Pendant;
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
		$shops = $this->world->getShops();

		$shops->filter(function($shop) {
			return !$shop instanceof Shop\TakeAny;
		})->each(function($shop) {
			$shop->setActive(true);
		});

		if (!$this->config('rom.genericKeys', false)
			&& !$this->config('rom.rupeeBow', false)
			&& !$this->config('region.takeAnys', false)) {
			return;
		}

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
			return !$shop instanceof Shop\TakeAny
				&& !$shop instanceof Shop\Upgrade
				&& (!$this->world instanceof ALttP\World\Inverted || $shop->getName() != "Dark World Lake Hylia Shop");
		})->randomCollection(5)->each(function($shop) {
			$shop->setActive(true);
			if ($this->config('rom.rupeeBow', false)) {
				$shop->addInventory(0, Item::get('ShopArrow'), 80);
			}
			if ($this->config('rom.genericKeys', false)) {
				$shop->addInventory(1, Item::get('ShopKey'), 100);
			}
			$shop->addInventory(2, Item::get('TenBombs'), 50);
		});

		if ($this->config('rom.rupeeBow', false)) {
			// One shop has arrows for sale, we need to set the price correct for
			$dw_shop = $this->world->getShop("Dark World Forest Shop");
			$dw_shop->setActive(true);
			foreach ($dw_shop->getInventory() as $slot => $data) {
				if ($data['item'] instanceof Item\Arrow) {
					$dw_shop->addInventory($slot, Item::get('ShopArrow'), 80);
				}
			}

			$this->world->getShop("Capacity Upgrade")->clearInventory()
				->addInventory(0, Item::get('BombUpgrade5'), 100, 7);
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
				$spoiler['Equipped'][$location] = $item->getName();
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
						: $item->getTarget()->getName();
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
					$shop_data["item_$slot"] = [
						'item' => $item['item']->getName(),
						'price' => $item['price'],
					];
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
			'goal' => $this->goal,
			'build' => Rom::BUILD,
			'mode' => $this->config('mode.state', 'standard'),
			'weapons' => $this->config('mode.weapons', 'randomized')
		]);

		$spoiler['Bosses'] = [
			"Eastern Palace" => $this->world->getRegion('Eastern Palace')->getBoss()->getName(),
			"Desert Palace" => $this->world->getRegion('Desert Palace')->getBoss()->getName(),
			"Tower Of Hera" => $this->world->getRegion('Tower of Hera')->getBoss()->getName(),
			"Hyrule Castle" => "Agahnim",
			"Palace Of Darkness" => $this->world->getRegion('Palace of Darkness')->getBoss()->getName(),
			"Swamp Palace" => $this->world->getRegion('Swamp Palace')->getBoss()->getName(),
			"Skull Woods" => $this->world->getRegion('Skull Woods')->getBoss()->getName(),
			"Thieves Town" => $this->world->getRegion('Thieves Town')->getBoss()->getName(),
			"Ice Palace" => $this->world->getRegion('Ice Palace')->getBoss()->getName(),
			"Misery Mire" => $this->world->getRegion('Misery Mire')->getBoss()->getName(),
			"Turtle Rock" => $this->world->getRegion('Turtle Rock')->getBoss()->getName(),
			"Ganons Tower Basement" => $this->world->getRegion('Ganons Tower')->getBoss('bottom')->getName(),
			"Ganons Tower Middle" => $this->world->getRegion('Ganons Tower')->getBoss('middle')->getName(),
			"Ganons Tower Top" => $this->world->getRegion('Ganons Tower')->getBoss('top')->getName(),
			"Ganons Tower" => "Agahnim 2",
			"Ganon" => "Ganon"
		];

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
		$rom->setupCustomShops($this->world->getShops());
		$rom->setRupeeArrow($this->config('rom.rupeeBow', false));
		$rom->setLockAgahnimDoorInEscape(true);
		$rom->setWishingWellChests(true);
		$rom->setWishingWellUpgrade(false);
		$rom->setHyliaFairyShop(true);
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
					0x51, 0x06, 0x52, 0xFF, // 6 +5 bomb upgrades -> +10 bomb upgrade
					0x53, 0x06, 0x54, 0xFF, // 6 +5 arrow upgrades -> +10 arrow upgrade
				]);
				break;
			default:
				$rom->setSilversEquip('collection');
				$rom->setSubstitutions([
					0x12, 0x01, 0x35, 0xFF, // lamp -> 5 rupees
					0x51, 0x06, 0x52, 0xFF, // 6 +5 bomb upgrades -> +10 bomb upgrade
					0x53, 0x06, 0x54, 0xFF, // 6 +5 arrow upgrades -> +10 arrow upgrade
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

		$rom->setGameState($this->config('mode.state'));
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
			$this->config('item.value.BombUpgrade5', 50),
			$this->config('item.value.BombUpgrade10', 50),
			$this->config('item.value.ArrowUpgrade5', 70),
			$this->config('item.value.ArrowUpgrade10', 70),
		]);

		// currently has to be after compass mode, as this will override compass mode.
		$rom->setClockMode($this->config('rom.timerMode', 'off'));

		$rom->setBlueClock($this->config('item.value.BlueClock', 0) ?: 0);
		$rom->setRedClock($this->config('item.value.RedClock', 0) ?: 0);
		$rom->setGreenClock($this->config('item.value.GreenClock', 0) ?: 0);
		$rom->setStartingTime($this->config('rom.timerStart', 0) ?: 0);

		switch ($this->config('rom.logicMode', $this->logic)) {
			case 'MajorGlitches':
			case 'None':
				$type_flag = 'G';
				$rom->setSwampWaterLevel(false);
				$rom->setPreAgahnimDarkWorldDeathInDungeon(false);
				$rom->setSaveAndQuitFromBossRoom(true);
				$rom->setWorldOnAgahnimDeath(false);
				$rom->setRandomizerSeedType('MajorGlitches');
				$rom->setWarningFlags(bindec('01100000'));
				$rom->setPODEGfix(false);
				break;
			case 'OverworldGlitches':
				$type_flag = 'S';
				$rom->setPreAgahnimDarkWorldDeathInDungeon(false);
				$rom->setSaveAndQuitFromBossRoom(true);
				$rom->setWorldOnAgahnimDeath(true);
				$rom->setRandomizerSeedType('OverworldGlitches');
				$rom->setWarningFlags(bindec('01000000'));
				$rom->setPODEGfix(false);
				break;
			case 'NoGlitches':
			default:
				$type_flag = 'C';
				$rom->setSaveAndQuitFromBossRoom(true);
				$rom->setWorldOnAgahnimDeath(true);
				$rom->setPODEGfix(true);
				break;
		}

		$rom->setGameType('item');

		if (static::class == self::class) {
			$rom->writeCredits();
			$rom->writeText();
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
			"saltpeters", "shabbiness", "shlrshlrsh", "sassyralph", "sallyacorn",
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
			"Venus Love Chain",
			"Venus Crescent Beam",
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
				'hint' => array_filter(explode("\n-\n", preg_replace('/^-\n/', '', file_get_contents(base_path('strings/hint.txt'))))),
			];
		});

		$boots_location = $this->world->getLocationsWithItem(Item::get('PegasusBoots'))->first();

		if ($this->config('spoil.BootsLocation', false) && $boots_location) {
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

		// Hints
		$tiles = fy_shuffle([
			'telepathic_tile_eastern_palace',
			'telepathic_tile_tower_of_hera_floor_4',
			'telepathic_tile_spectacle_rock',
			'telepathic_tile_swamp_entrance',
			'telepathic_tile_thieves_town_upstairs',
			'telepathic_tile_misery_mire',
			'telepathic_tile_palace_of_darkness',
			'telepathic_tile_desert_bonk_torch_room',
			'telepathic_tile_castle_tower',
			'telepathic_tile_ice_large_room',
			'telepathic_tile_turtle_rock',
			'telepathic_tile_ice_entrace',
			'telepathic_tile_ice_stalfos_knights_room',
			'telepathic_tile_tower_of_hera_entrance',
			'telepathic_tile_south_east_darkworld_cave',
		]);
		$locations = fy_shuffle([
			"Sahasrahla",
			"Mimic Cave",
			"Catfish",
			"Graveyard Ledge",
			"Purple Chest",
			"Tower of Hera - Big Key Chest",
			"Swamp Palace - Big Chest",
			["Misery Mire - Big Key Chest", "Misery Mire - Compass Chest"],
			["Swamp Palace - Big Key Chest", "Swamp Palace - West Chest"],
			["Pyramid Fairy - Left", "Pyramid Fairy - Right"],
		]);

		if ($this->world->config('region.wildBigKeys', false)) {
			$tile = array_pop($tiles);
			$gtbk_location = $this->world->getLocationsWithItem(Item::get('BigKeyA2'))->first();

			if ($gtbk_location) {
				$gtbk_hint = $gtbk_location->getHint();

				logger()->debug("$tile: $gtbk_hint");
				$rom->setText($tile, $gtbk_hint);
			}
		}

		if ($this->config('spoil.Hints', true)) {
			// boots hint v30 testing
			$tile = array_pop($tiles);
			$boots_location = $this->world->getLocationsWithItem(Item::get('PegasusBoots'))->first();
			if ($boots_location) {
				$boots_hint = $boots_location->getHint();

				logger()->debug("$tile: $boots_hint");
				$rom->setText($tile, $boots_hint);
			}

			$picks = range(0, count($locations) - 1);
			for ($i = 0; $i < 5; ++$i) {
				$picks = fy_shuffle($picks);
				$pick = $locations[array_pop($picks)];
				$tile = array_pop($tiles);

				if (is_array($pick)) {
					$hint = $this->world->getLocations()->filter(function($location) use ($pick) {
						return in_array($location->getName(), $pick);
					})->getHint();
				} else {
					$hint = $this->world->getLocation($pick)->getHint();
				}

				if (!$hint) {
					continue;
				}

				logger()->debug("$tile: $hint");
				$rom->setText($tile, $hint);
			}

			$hintables = array_filter($this->advancement_items, function($item) {
				return !$item instanceof Item\Shield
					&& !$item instanceof Item\Key
					&& !$item instanceof Item\Map
					&& !$item instanceof Item\Compass
					&& (!$this->world->config('region.wildBigKeys', false) || !$item instanceof Item\BigKey)
					&& !$item instanceof Item\Bottle
					&& !$item instanceof Item\Sword
					&& !in_array($item->getName(), ['TenBombs', 'HalfMagic', 'BugCatchingNet', 'Powder', 'Mushroom']);
			});

			switch ($this->config('rom.HardMode', 0)) {
				case -1:
					$hints = array_slice(fy_shuffle($hintables), 0, count($tiles));
					break;
				case 0:
					$hints = array_slice(fy_shuffle($hintables), 0, min(4, count($tiles)));
					break;
				default:
					$hints = [];
			}

			$hints = array_map(function($item) {
				return $this->world->getLocationsWithItem($item)->filter(function($location) {
					return !$location instanceof Location\Medallion
						&& !$location instanceof Location\Fountain
						&& !$location instanceof Location\Prize
						&& !$location instanceof Location\Event
						&& !$location instanceof Location\Trade;
				})->random();
			}, $hints);

			$locations_with_item = $this->world->getLocationsWithItem()->filter(function($location) {
				$item = $location->getItem();
				return !$location instanceof Location\Medallion
					&& !$location instanceof Location\Fountain
					&& !$location instanceof Location\Prize
					&& !$location instanceof Location\Event
					&& !$location instanceof Location\Trade
					&& !$item instanceof Item\Key
					&& !$item instanceof Item\Map
					&& !$item instanceof Item\Compass
					&& (!$this->world->config('region.wildBigKeys', false) || !$item instanceof Item\BigKey);
			});
			$hint_locations = $locations_with_item->randomCollection(get_random_int(floor((count($tiles) - count($hints)) / 2), count($tiles) - count($hints)))->merge($hints);

			foreach ($tiles as $tile) {
				$hint = $hint_locations->pop();
				$hint_text = ($hint ? $hint->getHint() : null) ?? "{C:GREEN}\n" . array_first(fy_shuffle($strings['hint']));

				logger()->debug(str_replace("\n", " ", "$tile: $hint_text"));
				$rom->setText($tile, $hint_text);
			}
		}

		return $this;
	}

	/**
	 * Get a shuffled array of Item's necessary for giving access to more locations as well as completing the game.
	 *
	 * @return array
	 */
	public function getAdvancementItems() {
		$items = [];

		$max_items = 216 - array_sum(config('item.advancement'));
		foreach (config('item.advancement') as $item_name => $count) {
			$loop = min($this->config('item.count.' . $item_name, $count), $max_items);
			for ($i = 0; $i < $loop; ++$i) {
				$items[] = $item_name == 'BottleWithRandom' ? $this->getBottle() : Item::get($item_name);
			}
		}

		return $items;
	}

	/**
	 * Get all the Items to insert into the Locations Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getNiceItems() {
		$items = [];

		foreach (config('item.nice') as $item_name => $count) {
			$loop = min($this->config('item.count.' . $item_name, $count), 216);
			for ($i = 0; $i < $loop; ++$i) {
				$items[] = $item_name == 'BottleWithRandom' ? $this->getBottle() : Item::get($item_name);
			}
		}

		return $items;
	}

	/**
	 * Get all the Items to insert into the Locations Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getItemPool() {
		$items = [];

		foreach (config('item.junk') as $item_name => $count) {
			$loop = min($this->config('item.count.' . $item_name, $count), 216);
			for ($i = 0; $i < $loop; ++$i) {
				$items[] = $item_name == 'BottleWithRandom' ? $this->getBottle() : Item::get($item_name);
			}
		}

		return $items;
	}

	public function getDungeonPool() {
		$items = [];

		foreach (config('item.dungeon') as $item_name => $count) {
			$loop = min($this->config('item.count.' . $item_name, $count), 216);
			for ($i = 0; $i < $loop; ++$i) {
				$items[] = $item_name == 'BottleWithRandom' ? $this->getBottle() : Item::get($item_name);
			}
		}

		return $items;
	}

	/**
	 * Get all the drops to insert into the PrizePackSlots Available, should be randomly shuffled
	 *
	 * @return array
	 */
	public function getDropsPool() {
		$drops = [];

		foreach (config('item.drop') as $sprite_name => $count) {
			$loop = min($this->config('drop.count.' . $sprite_name, $count), 63);
			for ($i = 0; $i < $loop; ++$i) {
				$drops[] = Sprite::get($sprite_name);
			}
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

		// hard+ does not allow fairies/full magics
		if ($this->config('rom.HardMode', 0) >= 2) {
			$drop_bytes = str_replace([0xE0, 0xE3], [0xDF, 0xD8], $drop_bytes);
		}

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
