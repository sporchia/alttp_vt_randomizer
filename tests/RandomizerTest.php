<?php

use ALttP\Randomizer;
use ALttP\Item;

/**
 * These test may have to be updated on any Logic change that adjusts the pooling of the RNG
 */
class RandomizerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->randomizer = new Randomizer('test_rules');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->randomizer);
	}

	public function testGetSeedIsNullBeforeRandomization() {
		$this->assertNull($this->randomizer->getSeed());
	}

	public function testGetSeedIsNotNullAfterRandomization() {
		$this->randomizer->makeSeed();

		$this->assertNotNull($this->randomizer->getSeed());
	}

	/**
	 * @group swords
	 */
	public function testSwordsNotRandomizedByConfig() {
		Config::set('alttp.test_rules.region.swordShuffle', false);

		$this->randomizer->makeSeed(1337);

		$this->assertEquals([
			Item::get('L2Sword'),
			Item::get('L3Sword'),
			Item::get('L4Sword'),
		], [
			$this->randomizer->getWorld()->getLocation("Altar")->getItem(),
			$this->randomizer->getWorld()->getLocation("Blacksmiths")->getItem(),
			$this->randomizer->getWorld()->getLocation("Pyramid - Sword")->getItem(),
		]);
	}

	/**
	 * @group crystals
	 */
	public function testCrystalsNotRandomizedByConfigCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', true);
		Config::set('alttp.test_rules.prize.shuffleCrystals', false);

		$this->randomizer->makeSeed(1337);
		$this->assertEquals([
			Item::get('Crystal1'),
			Item::get('Crystal2'),
			Item::get('Crystal3'),
			Item::get('Crystal4'),
			Item::get('Crystal5'),
			Item::get('Crystal6'),
			Item::get('Crystal7'),
		], [
			$this->randomizer->getWorld()->getLocation("Palace of Darkness Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Swamp Palace Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Skull Woods Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Thieves Town Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Ice Palace Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Misery Mire Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Turtle Rock Crystal")->getItem(),
		]);
	}

	/**
	 * @group crystals
	 */
	public function testCrystalsNotRandomizedByConfigNoCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', false);
		Config::set('alttp.test_rules.prize.shuffleCrystals', false);

		$this->randomizer->makeSeed(1337);

		$this->assertEquals([
			Item::get('Crystal1'),
			Item::get('Crystal2'),
			Item::get('Crystal3'),
			Item::get('Crystal4'),
			Item::get('Crystal5'),
			Item::get('Crystal6'),
			Item::get('Crystal7'),
		], [
			$this->randomizer->getWorld()->getLocation("Palace of Darkness Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Swamp Palace Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Skull Woods Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Thieves Town Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Ice Palace Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Misery Mire Crystal")->getItem(),
			$this->randomizer->getWorld()->getLocation("Turtle Rock Crystal")->getItem(),
		]);
	}


	/**
	 * @group pendants
	 */
	public function testPendantsNotRandomizedByConfigNoCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', false);
		Config::set('alttp.test_rules.prize.shufflePendants', false);

		$this->randomizer->makeSeed(1337);

		$this->assertEquals([
			Item::get('PendantOfCourage'),
			Item::get('PendantOfPower'),
			Item::get('PendantOfWisdom'),
		], [
			$this->randomizer->getWorld()->getLocation("Eastern Palace Pendant")->getItem(),
			$this->randomizer->getWorld()->getLocation("Desert Palace Pendant")->getItem(),
			$this->randomizer->getWorld()->getLocation("Tower of Hera Pendant")->getItem(),
		]);
	}

	/**
	 * @group pendants
	 */
	public function testPendantsNotRandomizedByConfigCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', true);
		Config::set('alttp.test_rules.prize.shufflePendants', false);

		$this->randomizer->makeSeed(1337);

		$this->assertEquals([
			Item::get('PendantOfCourage'),
			Item::get('PendantOfPower'),
			Item::get('PendantOfWisdom'),
		], [
			$this->randomizer->getWorld()->getLocation("Eastern Palace Pendant")->getItem(),
			$this->randomizer->getWorld()->getLocation("Desert Palace Pendant")->getItem(),
			$this->randomizer->getWorld()->getLocation("Tower of Hera Pendant")->getItem(),
		]);
	}

	/**
	 * Adjust this test and increment Logic on Randomizer if this fails.
	 *
	 * @group logic
	 */
	public function testLogicHasntChangedNoMajorGlitches() {
		$this->randomizer->makeSeed(1337);
		$loc_item_array = $this->randomizer->getWorld()->getLocations()->map(function($loc){
			return $loc->getItem()->getName();
		});

		$this->assertEquals([
			"Altar" => "BombUpgrade5",
			"Uncle" => "ProgressiveSword",
			"[cave-034] Hyrule Castle secret entrance" => "MoonPearl",
			"[cave-018] Graveyard - top right grave" => "TwentyRupees",
			"[cave-047] Dam" => "Hammer",
			"[cave-040] Link's House" => "TwentyRupees",
			"[cave-031] Tavern" => "TwentyRupees",
			"[cave-026] chicken house" => "TwentyRupees",
			"[cave-044] Aginah's cave" => "BombUpgrade10",
			"[cave-035] Sahasrahla's Hut [left chest]" => "Powder",
			"[cave-035] Sahasrahla's Hut [center chest]" => "ThreeBombs",
			"[cave-035] Sahasrahla's Hut [right chest]" => "TwentyRupees",
			"[cave-021] Kakariko well [top chest]" => "ProgressiveArmor",
			"[cave-021] Kakariko well [left chest row of 3]" => "TwentyRupees",
			"[cave-021] Kakariko well [center chest row of 3]" => "TwentyRupees",
			"[cave-021] Kakariko well [right chest row of 3]" => "PieceOfHeart",
			"[cave-021] Kakariko well [bottom chest]" => "BombUpgrade5",
			"[cave-022-B1] Thief's hut [top chest]" => "BossHeartContainer",
			"[cave-022-B1] Thief's hut [top left chest]" => "ProgressiveArmor",
			"[cave-022-B1] Thief's hut [top right chest]" => "PieceOfHeart",
			"[cave-022-B1] Thief's hut [bottom left chest]" => "PieceOfHeart",
			"[cave-022-B1] Thief's hut [bottom right chest]" => "BossHeartContainer",
			"Blacksmiths" => "FiveRupees",
			"[cave-016] cave under rocks west of Santuary" => "PieceOfHeart",
			"[cave-050] cave southwest of Lake Hylia [bottom left chest]" => "TwentyRupees",
			"[cave-050] cave southwest of Lake Hylia [top left chest]" => "PieceOfHeart",
			"[cave-050] cave southwest of Lake Hylia [top right chest]" => "PieceOfHeart",
			"[cave-050] cave southwest of Lake Hylia [bottom right chest]" => "TwentyRupees",
			"[cave-051] Ice Cave" => "ThreeHundredRupees",
			"Bottle Vendor" => "OcarinaInactive",
			"Sahasrahla" => "TwentyRupees",
			"Magic Bat" => "ThreeBombs",
			"Sick Kid" => "FiftyRupees",
			"Purple Chest" => "BombUpgrade5",
			"Hobo" => "BossHeartContainer",
			"Bombos Tablet" => "TwentyRupees",
			"King Zora" => "ProgressiveSword",
			"Piece of Heart (Thieves' Forest Hideout)" => "TenArrows",
			"Piece of Heart (Lumberjack Tree)" => "BottleWithBluePotion",
			"Piece of Heart (south of Haunted Grove)" => "TwentyRupees",
			"Piece of Heart (Graveyard)" => "PieceOfHeart",
			"Piece of Heart (Desert - northeast corner)" => "PieceOfHeart",
			"[cave-050] cave southwest of Lake Hylia - generous guy" => "BossHeartContainer",
			"Library" => "TwentyRupees",
			"Mushroom" => "ProgressiveGlove",
			"Witch" => "HalfMagic",
			"Piece of Heart (Maze Race)" => "TwentyRupees",
			"Piece of Heart (Desert - west side)" => "PieceOfHeart",
			"Piece of Heart (Lake Hylia)" => "BottleWithRedPotion",
			"Piece of Heart (Dam)" => "FiftyRupees",
			"Piece of Heart (Zora's River)" => "BossHeartContainer",
			"Haunted Grove item" => "ThreeBombs",
			"[dungeon-C-1F] Sanctuary" => "FiftyRupees",
			"[dungeon-C-B1] Escape - final basement room [left chest]" => "ArrowUpgrade5",
			"[dungeon-C-B1] Escape - final basement room [middle chest]" => "ThreeHundredRupees",
			"[dungeon-C-B1] Escape - final basement room [right chest]" => "PieceOfHeart",
			"[dungeon-C-B1] Escape - first B1 room" => "PieceOfHeart",
			"[dungeon-C-B1] Hyrule Castle - boomerang room" => "Key",
			"[dungeon-C-B1] Hyrule Castle - map room" => "Map",
			"[dungeon-C-B3] Hyrule Castle - next to Zelda" => "ProgressiveShield",
			"[dungeon-L1-1F] Eastern Palace - compass room" => "BigKey",
			"[dungeon-L1-1F] Eastern Palace - big chest" => "PieceOfHeart",
			"[dungeon-L1-1F] Eastern Palace - big ball room" => "BombUpgrade5",
			"[dungeon-L1-1F] Eastern Palace - Big key" => "Compass",
			"[dungeon-L1-1F] Eastern Palace - map room" => "ThreeBombs",
			"Heart Container - Armos Knights" => "Map",
			"Eastern Palace Pendant" => "Crystal2",
			"[dungeon-L2-B1] Desert Palace - big chest" => "Compass",
			"[dungeon-L2-B1] Desert Palace - Map room" => "BigKey",
			"[dungeon-L2-B1] Desert Palace - Small key room" => "Key",
			"[dungeon-L2-B1] Desert Palace - Big key room" => "OneHundredRupees",
			"[dungeon-L2-B1] Desert Palace - compass room" => "TenArrows",
			"Heart Container - Lanmolas" => "Map",
			"Desert Palace Pendant" => "Crystal6",
			"Old Mountain Man" => "TwentyRupees",
			"Piece of Heart (Spectacle Rock Cave)" => "FireRod",
			"[cave-012-1F] Death Mountain - wall of caves - left cave" => "Boomerang",
			"[cave-013] Mimic cave (from Turtle Rock)" => "BottleWithGoldBee",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]" => "TwentyRupees",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]" => "ThreeBombs",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]" => "FiftyRupees",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]" => "FiftyRupees",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]" => "PegasusBoots",
			"[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]" => "BugCatchingNet",
			"[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]" => "BossHeartContainer",
			"Piece of Heart (Death Mountain - floating island)" => "TwentyRupees",
			"Ether Tablet" => "OneRupee",
			"Piece of Heart (Spectacle Rock)" => "CaneOfByrna",
			"[dungeon-L3-1F] Tower of Hera - first floor" => "ProgressiveGlove",
			"[dungeon-L3-1F] Tower of Hera - freestanding key" => "BigKey",
			"[dungeon-L3-2F] Tower of Hera - Entrance" => "Compass",
			"[dungeon-L3-4F] Tower of Hera - 4F [small chest]" => "Key",
			"[dungeon-L3-4F] Tower of Hera - big chest" => "FiftyRupees",
			"Heart Container - Moldorm" => "Map",
			"Tower of Hera Pendant" => "PendantOfCourage",
			"[dungeon-A1-2F] Hyrule Castle Tower - 2 knife guys room" => "Key",
			"[dungeon-A1-3F] Hyrule Castle Tower - maze room" => "Key",
			"Agahnim" => "DefeatAgahnim",
			"[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]" => "BombUpgrade5",
			"[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]" => "Bottle",
			"[cave-056] Dark World Death Mountain - cave under boulder [top right chest]" => "Shovel",
			"[cave-056] Dark World Death Mountain - cave under boulder [top left chest]" => "TwentyRupees",
			"[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]" => "TwentyRupees",
			"[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]" => "TwentyRupees",
			"[cave-055] Spike cave" => "TwentyRupees",
			"Catfish" => "ThreeHundredRupees",
			"Piece of Heart (Pyramid)" => "ProgressiveShield",
			"Pyramid - Sword" => "L1Sword",
			"Pyramid - Bow" => "BowAndArrows",
			"Ganon" => "DefeatGanon",
			"Pyramid Fairy - Left" => "OneRupee",
			"Pyramid Fairy - Right" => "PieceOfHeart",
			"[cave-063] doorless hut" => "BookOfMudora",
			"[cave-062] C-shaped house" => "PieceOfHeart",
			"Piece of Heart (Treasure Chest Game)" => "TenArrows",
			"Piece of Heart (Dark World blacksmith pegs)" => "FiftyRupees",
			"Piece of Heart (Dark World - bumper cave)" => "RedBoomerang",
			"[cave-073] cave northeast of swamp palace [top chest]" => "ThreeBombs",
			"[cave-073] cave northeast of swamp palace [top middle chest]" => "ThreeBombs",
			"[cave-073] cave northeast of swamp palace [bottom middle chest]" => "Hookshot",
			"[cave-073] cave northeast of swamp palace [bottom chest]" => "Flippers",
			"Flute Boy" => "ArrowUpgrade5",
			"[cave-073] cave northeast of swamp palace - generous guy" => "Bow",
			"Piece of Heart (Digging Game)" => "PieceOfHeart",
			"[cave-071] Misery Mire west area [left chest]" => "CaneOfSomaria",
			"[cave-071] Misery Mire west area [right chest]" => "Lamp",
			"[dungeon-D1-1F] Dark Palace - big key room" => "TwentyRupees",
			"[dungeon-D1-1F] Dark Palace - jump room [right chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - jump room [left chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - big chest" => "Compass",
			"[dungeon-D1-1F] Dark Palace - compass room" => "Bombos",
			"[dungeon-D1-1F] Dark Palace - spike statue room" => "ThreeBombs",
			"[dungeon-D1-B1] Dark Palace - turtle stalfos room" => "Key",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]" => "Key",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]" => "BigKey",
			"[dungeon-D1-1F] Dark Palace - statue push room" => "Key",
			"[dungeon-D1-1F] Dark Palace - maze room [top chest]" => "Quake",
			"[dungeon-D1-1F] Dark Palace - maze room [bottom chest]" => "ArrowUpgrade5",
			"[dungeon-D1-B1] Dark Palace - shooter room" => "Key",
			"Heart Container - Helmasaur King" => "Map",
			"Palace of Darkness Crystal" => "Crystal1",
			"[dungeon-D2-1F] Swamp Palace - first room" => "Key",
			"[dungeon-D2-B1] Swamp Palace - big chest" => "BombUpgrade5",
			"[dungeon-D2-B1] Swamp Palace - big key room" => "Compass",
			"[dungeon-D2-B1] Swamp Palace - map room" => "IceRod",
			"[dungeon-D2-B1] Swamp Palace - push 4 blocks room" => "FiveRupees",
			"[dungeon-D2-B1] Swamp Palace - south of hookshot room" => "Map",
			"[dungeon-D2-B2] Swamp Palace - flooded room [left chest]" => "TwentyRupees",
			"[dungeon-D2-B2] Swamp Palace - flooded room [right chest]" => "PieceOfHeart",
			"[dungeon-D2-B2] Swamp Palace - hidden waterfall door room" => "BigKey",
			"Heart Container - Arrghus" => "PieceOfHeart",
			"Swamp Palace Crystal" => "Crystal7",
			"[dungeon-D3-B1] Skull Woods - big chest" => "Compass",
			"[dungeon-D3-B1] Skull Woods - Big Key room" => "Key",
			"[dungeon-D3-B1] Skull Woods - Compass room" => "PieceOfHeart",
			"[dungeon-D3-B1] Skull Woods - east of Fire Rod room" => "Key",
			"[dungeon-D3-B1] Skull Woods - Entrance to part 2" => "BigKey",
			"[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room" => "Map",
			"[dungeon-D3-B1] Skull Woods - south of Fire Rod room" => "Key",
			"Heart Container - Mothula" => "ProgressiveShield",
			"Skull Woods Crystal" => "PendantOfWisdom",
			"[dungeon-D4-1F] Thieves' Town - Room above boss" => "TwentyRupees",
			"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]" => "ThreeHundredRupees",
			"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]" => "BigKey",
			"[dungeon-D4-B1] Thieves' Town - Bottom right of huge room" => "PieceOfHeart",
			"[dungeon-D4-B1] Thieves' Town - Top left of huge room" => "Map",
			"[dungeon-D4-B2] Thieves' Town - big chest" => "HeartContainer",
			"[dungeon-D4-B2] Thieves' Town - next to Blind" => "Key",
			"Heart Container - Blind" => "Compass",
			"Thieves Town Crystal" => "Crystal4",
			"[dungeon-D5-B1] Ice Palace - Big Key room" => "ProgressiveSword",
			"[dungeon-D5-B1] Ice Palace - compass room" => "Key",
			"[dungeon-D5-B2] Ice Palace - map room" => "Compass",
			"[dungeon-D5-B3] Ice Palace - spike room" => "Key",
			"[dungeon-D5-B4] Ice Palace - above Blue Mail room" => "ArrowUpgrade5",
			"[dungeon-D5-B5] Ice Palace - b5 up staircase" => "BigKey",
			"[dungeon-D5-B5] Ice Palace - big chest" => "TwentyRupees",
			"Heart Container - Kholdstare" => "Map",
			"Ice Palace Crystal" => "Crystal5",
			"[dungeon-D6-B1] Misery Mire - big chest" => "Map",
			"[dungeon-D6-B1] Misery Mire - big hub room" => "Key",
			"[dungeon-D6-B1] Misery Mire - big key" => "Compass",
			"[dungeon-D6-B1] Misery Mire - compass" => "PieceOfHeart",
			"[dungeon-D6-B1] Misery Mire - end of bridge" => "Cape",
			"[dungeon-D6-B1] Misery Mire - map room" => "Key",
			"[dungeon-D6-B1] Misery Mire - spike room" => "BigKey",
			"Heart Container - Vitreous" => "Key",
			"Misery Mire Crystal" => "Crystal3",
			"[dungeon-D7-1F] Turtle Rock - Chain chomp room" => "Mushroom",
			"[dungeon-D7-1F] Turtle Rock - compass room" => "BigKey",
			"[dungeon-D7-1F] Turtle Rock - Map room [left chest]" => "Key",
			"[dungeon-D7-1F] Turtle Rock - Map room [right chest]" => "Key",
			"[dungeon-D7-B1] Turtle Rock - big chest" => "PieceOfHeart",
			"[dungeon-D7-B1] Turtle Rock - big key room" => "MagicMirror",
			"[dungeon-D7-B1] Turtle Rock - Roller switch room" => "Key",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]" => "Map",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]" => "Compass",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]" => "Key",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]" => "Arrow",
			"Heart Container - Trinexx" => "BossHeartContainer",
			"Turtle Rock Crystal" => "PendantOfPower",
			"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance" => "BigKey",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]" => "ArrowUpgrade5",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]" => "FiveRupees",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]" => "BossHeartContainer",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]" => "Compass",
			"[dungeon-A2-1F] Ganon's Tower - north of teleport room" => "BossHeartContainer",
			"[dungeon-A2-1F] Ganon's Tower - map room" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - big chest" => "Ether",
			"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]" => "ProgressiveSword",
			"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - above Armos" => "ThreeBombs",
			"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]" => "Map",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]" => "ArrowUpgrade5",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]" => "ArrowUpgrade10",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]" => "TenArrows",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]" => "SilverArrowUpgrade",
			"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]" => "FiveRupees",
			"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]" => "TwentyRupees",
			"[dungeon-A2-6F] Ganon's Tower - before Moldorm" => "BossHeartContainer",
			"[dungeon-A2-6F] Ganon's Tower - Moldorm room" => "ThreeBombs",
			"Agahnim 2" => "DefeatAgahnim2",
			"Turtle Rock Medallion" => "Bombos",
			"Misery Mire Medallion" => "Bombos",
			"Waterfall Bottle" => "BottleWithGreenPotion",
			"Pyramid Bottle" => "BottleWithBluePotion",
		], $loc_item_array);
	}

	/**
	 * Adjust this test and increment Logic on Randomizer if this fails.
	 *
	 * @group logic
	 */
	public function testLogicHasntChangedGlitched() {
		$this->randomizer = new Randomizer('test_rules', 'Glitched');
		$this->randomizer->makeSeed(1337);
		$loc_item_array = $this->randomizer->getWorld()->getLocations()->map(function($loc){
			return $loc->getItem()->getName();
		});

		$this->assertEquals([
			"Altar" => "BugCatchingNet",
			"Uncle" => "ProgressiveSword",
			"[cave-034] Hyrule Castle secret entrance" => "BombUpgrade5",
			"[cave-018] Graveyard - top right grave" => "IceRod",
			"[cave-047] Dam" => "ArrowUpgrade5",
			"[cave-040] Link's House" => "ProgressiveSword",
			"[cave-031] Tavern" => "ArrowUpgrade5",
			"[cave-026] chicken house" => "TwentyRupees",
			"[cave-044] Aginah's cave" => "PieceOfHeart",
			"[cave-035] Sahasrahla's Hut [left chest]" => "Shovel",
			"[cave-035] Sahasrahla's Hut [center chest]" => "PieceOfHeart",
			"[cave-035] Sahasrahla's Hut [right chest]" => "Bow",
			"[cave-021] Kakariko well [top chest]" => "ThreeBombs",
			"[cave-021] Kakariko well [left chest row of 3]" => "TenArrows",
			"[cave-021] Kakariko well [center chest row of 3]" => "BombUpgrade5",
			"[cave-021] Kakariko well [right chest row of 3]" => "ArrowUpgrade5",
			"[cave-021] Kakariko well [bottom chest]" => "PieceOfHeart",
			"[cave-022-B1] Thief's hut [top chest]" => "TwentyRupees",
			"[cave-022-B1] Thief's hut [top left chest]" => "SilverArrowUpgrade",
			"[cave-022-B1] Thief's hut [top right chest]" => "ArrowUpgrade5",
			"[cave-022-B1] Thief's hut [bottom left chest]" => "TwentyRupees",
			"[cave-022-B1] Thief's hut [bottom right chest]" => "Flippers",
			"Blacksmiths" => "FiftyRupees",
			"[cave-016] cave under rocks west of Santuary" => "PieceOfHeart",
			"[cave-050] cave southwest of Lake Hylia [bottom left chest]" => "Mushroom",
			"[cave-050] cave southwest of Lake Hylia [top left chest]" => "PieceOfHeart",
			"[cave-050] cave southwest of Lake Hylia [top right chest]" => "TwentyRupees",
			"[cave-050] cave southwest of Lake Hylia [bottom right chest]" => "ProgressiveArmor",
			"[cave-051] Ice Cave" => "ProgressiveShield",
			"Bottle Vendor" => "PieceOfHeart",
			"Sahasrahla" => "PieceOfHeart",
			"Magic Bat" => "Ether",
			"Sick Kid" => "PieceOfHeart",
			"Purple Chest" => "TwentyRupees",
			"Hobo" => "TwentyRupees",
			"Bombos Tablet" => "BossHeartContainer",
			"King Zora" => "Hammer",
			"Piece of Heart (Thieves' Forest Hideout)" => "ThreeBombs",
			"Piece of Heart (Lumberjack Tree)" => "PieceOfHeart",
			"Piece of Heart (south of Haunted Grove)" => "BossHeartContainer",
			"Piece of Heart (Graveyard)" => "FiveRupees",
			"Piece of Heart (Desert - northeast corner)" => "ProgressiveSword",
			"[cave-050] cave southwest of Lake Hylia - generous guy" => "HeartContainer",
			"Library" => "Arrow",
			"Mushroom" => "Quake",
			"Witch" => "ThreeBombs",
			"Piece of Heart (Maze Race)" => "FiftyRupees",
			"Piece of Heart (Desert - west side)" => "ProgressiveGlove",
			"Piece of Heart (Lake Hylia)" => "TwentyRupees",
			"Piece of Heart (Dam)" => "PieceOfHeart",
			"Piece of Heart (Zora's River)" => "TenArrows",
			"Haunted Grove item" => "BombUpgrade5",
			"[dungeon-C-1F] Sanctuary" => "PegasusBoots",
			"[dungeon-C-B1] Escape - final basement room [left chest]" => "ThreeHundredRupees",
			"[dungeon-C-B1] Escape - final basement room [middle chest]" => "TwentyRupees",
			"[dungeon-C-B1] Escape - final basement room [right chest]" => "FiveRupees",
			"[dungeon-C-B1] Escape - first B1 room" => "Cape",
			"[dungeon-C-B1] Hyrule Castle - boomerang room" => "Map",
			"[dungeon-C-B1] Hyrule Castle - map room" => "Key",
			"[dungeon-C-B3] Hyrule Castle - next to Zelda" => "PieceOfHeart",
			"[dungeon-L1-1F] Eastern Palace - compass room" => "BigKey",
			"[dungeon-L1-1F] Eastern Palace - big chest" => "ThreeBombs",
			"[dungeon-L1-1F] Eastern Palace - big ball room" => "PieceOfHeart",
			"[dungeon-L1-1F] Eastern Palace - Big key" => "Compass",
			"[dungeon-L1-1F] Eastern Palace - map room" => "OneHundredRupees",
			"Heart Container - Armos Knights" => "Map",
			"Eastern Palace Pendant" => "Crystal2",
			"[dungeon-L2-B1] Desert Palace - big chest" => "Compass",
			"[dungeon-L2-B1] Desert Palace - Map room" => "BigKey",
			"[dungeon-L2-B1] Desert Palace - Small key room" => "Key",
			"[dungeon-L2-B1] Desert Palace - Big key room" => "TwentyRupees",
			"[dungeon-L2-B1] Desert Palace - compass room" => "ProgressiveShield",
			"Heart Container - Lanmolas" => "Map",
			"Desert Palace Pendant" => "Crystal6",
			"Old Mountain Man" => "TwentyRupees",
			"Piece of Heart (Spectacle Rock Cave)" => "TenArrows",
			"[cave-012-1F] Death Mountain - wall of caves - left cave" => "FiftyRupees",
			"[cave-013] Mimic cave (from Turtle Rock)" => "ThreeBombs",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]" => "BombUpgrade5",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]" => "PieceOfHeart",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]" => "Lamp",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]" => "TwentyRupees",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]" => "FireRod",
			"[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]" => "ProgressiveGlove",
			"[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]" => "CaneOfByrna",
			"Piece of Heart (Death Mountain - floating island)" => "TwentyRupees",
			"Ether Tablet" => "PieceOfHeart",
			"Piece of Heart (Spectacle Rock)" => "TwentyRupees",
			"[dungeon-L3-1F] Tower of Hera - first floor" => "MoonPearl",
			"[dungeon-L3-1F] Tower of Hera - freestanding key" => "FiftyRupees",
			"[dungeon-L3-2F] Tower of Hera - Entrance" => "Compass",
			"[dungeon-L3-4F] Tower of Hera - 4F [small chest]" => "Key",
			"[dungeon-L3-4F] Tower of Hera - big chest" => "Map",
			"Heart Container - Moldorm" => "BigKey",
			"Tower of Hera Pendant" => "PendantOfCourage",
			"[dungeon-A1-2F] Hyrule Castle Tower - 2 knife guys room" => "Key",
			"[dungeon-A1-3F] Hyrule Castle Tower - maze room" => "Key",
			"Agahnim" => "DefeatAgahnim",
			"[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]" => "ThreeHundredRupees",
			"[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]" => "TwentyRupees",
			"[cave-056] Dark World Death Mountain - cave under boulder [top right chest]" => "ProgressiveArmor",
			"[cave-056] Dark World Death Mountain - cave under boulder [top left chest]" => "MagicMirror",
			"[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]" => "TenArrows",
			"[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]" => "OneRupee",
			"[cave-055] Spike cave" => "FiftyRupees",
			"Catfish" => "BossHeartContainer",
			"Piece of Heart (Pyramid)" => "PieceOfHeart",
			"Pyramid - Sword" => "L1Sword",
			"Pyramid - Bow" => "BowAndArrows",
			"Ganon" => "DefeatGanon",
			"Pyramid Fairy - Left" => "FiveRupees",
			"Pyramid Fairy - Right" => "ArrowUpgrade5",
			"[cave-063] doorless hut" => "BossHeartContainer",
			"[cave-062] C-shaped house" => "ArrowUpgrade10",
			"Piece of Heart (Treasure Chest Game)" => "CaneOfSomaria",
			"Piece of Heart (Dark World blacksmith pegs)" => "ThreeBombs",
			"Piece of Heart (Dark World - bumper cave)" => "PieceOfHeart",
			"[cave-073] cave northeast of swamp palace [top chest]" => "PieceOfHeart",
			"[cave-073] cave northeast of swamp palace [top middle chest]" => "FiftyRupees",
			"[cave-073] cave northeast of swamp palace [bottom middle chest]" => "ThreeBombs",
			"[cave-073] cave northeast of swamp palace [bottom chest]" => "Bombos",
			"Flute Boy" => "PieceOfHeart",
			"[cave-073] cave northeast of swamp palace - generous guy" => "BottleWithGreenPotion",
			"Piece of Heart (Digging Game)" => "BottleWithBee",
			"[cave-071] Misery Mire west area [left chest]" => "ArrowUpgrade5",
			"[cave-071] Misery Mire west area [right chest]" => "HalfMagic",
			"[dungeon-D1-1F] Dark Palace - big key room" => "Hookshot",
			"[dungeon-D1-1F] Dark Palace - jump room [right chest]" => "Compass",
			"[dungeon-D1-1F] Dark Palace - jump room [left chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - big chest" => "TwentyRupees",
			"[dungeon-D1-1F] Dark Palace - compass room" => "Key",
			"[dungeon-D1-1F] Dark Palace - spike statue room" => "Key",
			"[dungeon-D1-B1] Dark Palace - turtle stalfos room" => "Map",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]" => "Key",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - statue push room" => "BigKey",
			"[dungeon-D1-1F] Dark Palace - maze room [top chest]" => "BossHeartContainer",
			"[dungeon-D1-1F] Dark Palace - maze room [bottom chest]" => "TwentyRupees",
			"[dungeon-D1-B1] Dark Palace - shooter room" => "BossHeartContainer",
			"Heart Container - Helmasaur King" => "Key",
			"Palace of Darkness Crystal" => "Crystal1",
			"[dungeon-D2-1F] Swamp Palace - first room" => "ThreeBombs",
			"[dungeon-D2-B1] Swamp Palace - big chest" => "ThreeBombs",
			"[dungeon-D2-B1] Swamp Palace - big key room" => "OcarinaInactive",
			"[dungeon-D2-B1] Swamp Palace - map room" => "ThreeBombs",
			"[dungeon-D2-B1] Swamp Palace - push 4 blocks room" => "Map",
			"[dungeon-D2-B1] Swamp Palace - south of hookshot room" => "PieceOfHeart",
			"[dungeon-D2-B2] Swamp Palace - flooded room [left chest]" => "Key",
			"[dungeon-D2-B2] Swamp Palace - flooded room [right chest]" => "Compass",
			"[dungeon-D2-B2] Swamp Palace - hidden waterfall door room" => "BigKey",
			"Heart Container - Arrghus" => "FiveRupees",
			"Swamp Palace Crystal" => "Crystal7",
			"[dungeon-D3-B1] Skull Woods - big chest" => "Key",
			"[dungeon-D3-B1] Skull Woods - Big Key room" => "BossHeartContainer",
			"[dungeon-D3-B1] Skull Woods - Compass room" => "Key",
			"[dungeon-D3-B1] Skull Woods - east of Fire Rod room" => "Map",
			"[dungeon-D3-B1] Skull Woods - Entrance to part 2" => "BigKey",
			"[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room" => "Compass",
			"[dungeon-D3-B1] Skull Woods - south of Fire Rod room" => "Key",
			"Heart Container - Mothula" => "TwentyRupees",
			"Skull Woods Crystal" => "PendantOfWisdom",
			"[dungeon-D4-1F] Thieves' Town - Room above boss" => "Compass",
			"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]" => "Key",
			"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]" => "BigKey",
			"[dungeon-D4-B1] Thieves' Town - Bottom right of huge room" => "BombUpgrade5",
			"[dungeon-D4-B1] Thieves' Town - Top left of huge room" => "Map",
			"[dungeon-D4-B2] Thieves' Town - big chest" => "TwentyRupees",
			"[dungeon-D4-B2] Thieves' Town - next to Blind" => "RedBoomerang",
			"Heart Container - Blind" => "TwentyRupees",
			"Thieves Town Crystal" => "Crystal4",
			"[dungeon-D5-B1] Ice Palace - Big Key room" => "Map",
			"[dungeon-D5-B1] Ice Palace - compass room" => "PieceOfHeart",
			"[dungeon-D5-B2] Ice Palace - map room" => "OneRupee",
			"[dungeon-D5-B3] Ice Palace - spike room" => "Key",
			"[dungeon-D5-B4] Ice Palace - above Blue Mail room" => "Compass",
			"[dungeon-D5-B5] Ice Palace - b5 up staircase" => "TwentyRupees",
			"[dungeon-D5-B5] Ice Palace - big chest" => "Key",
			"Heart Container - Kholdstare" => "BigKey",
			"Ice Palace Crystal" => "Crystal5",
			"[dungeon-D6-B1] Misery Mire - big chest" => "Key",
			"[dungeon-D6-B1] Misery Mire - big hub room" => "BigKey",
			"[dungeon-D6-B1] Misery Mire - big key" => "Compass",
			"[dungeon-D6-B1] Misery Mire - compass" => "PieceOfHeart",
			"[dungeon-D6-B1] Misery Mire - end of bridge" => "Map",
			"[dungeon-D6-B1] Misery Mire - map room" => "PieceOfHeart",
			"[dungeon-D6-B1] Misery Mire - spike room" => "Key",
			"Heart Container - Vitreous" => "Key",
			"Misery Mire Crystal" => "Crystal3",
			"[dungeon-D7-1F] Turtle Rock - Chain chomp room" => "Key",
			"[dungeon-D7-1F] Turtle Rock - compass room" => "PieceOfHeart",
			"[dungeon-D7-1F] Turtle Rock - Map room [left chest]" => "Compass",
			"[dungeon-D7-1F] Turtle Rock - Map room [right chest]" => "BookOfMudora",
			"[dungeon-D7-B1] Turtle Rock - big chest" => "BossHeartContainer",
			"[dungeon-D7-B1] Turtle Rock - big key room" => "Key",
			"[dungeon-D7-B1] Turtle Rock - Roller switch room" => "BigKey",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]" => "Key",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]" => "Key",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]" => "FiftyRupees",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]" => "Map",
			"Heart Container - Trinexx" => "Powder",
			"Turtle Rock Crystal" => "PendantOfPower",
			"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]" => "ProgressiveShield",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]" => "BottleWithGreenPotion",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - north of teleport room" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - map room" => "Compass",
			"[dungeon-A2-1F] Ganon's Tower - big chest" => "Boomerang",
			"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]" => "ThreeHundredRupees",
			"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - above Armos" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance" => "ProgressiveSword",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]" => "ThreeHundredRupees",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]" => "BombUpgrade10",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]" => "BottleWithRedPotion",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]" => "BossHeartContainer",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]" => "TwentyRupees",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]" => "BigKey",
			"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]" => "TwentyRupees",
			"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]" => "Map",
			"[dungeon-A2-6F] Ganon's Tower - before Moldorm" => "BossHeartContainer",
			"[dungeon-A2-6F] Ganon's Tower - Moldorm room" => "BombUpgrade5",
			"Agahnim 2" => "DefeatAgahnim2",
			"Turtle Rock Medallion" => "Bombos",
			"Misery Mire Medallion" => "Bombos",
			"Waterfall Bottle" => "BottleWithGreenPotion",
			"Pyramid Bottle" => "BottleWithBluePotion",
		], $loc_item_array);
	}
}
