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
		$this->assertEquals(Item::get('L2Sword'), $this->randomizer->getWorld()->getLocation("Alter")->getItem());
		$this->assertEquals(Item::get('L3Sword'), $this->randomizer->getWorld()->getLocation("Blacksmiths")->getItem());
		$this->assertEquals(Item::get('L4Sword'), $this->randomizer->getWorld()->getLocation("Pyramid")->getItem());
	}

	/**
	 * @group crystals
	 */
	public function testCrystalsNotRandomizedByConfigCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', true);
		Config::set('alttp.test_rules.prize.shuffleCrystals', false);

		$this->randomizer->makeSeed(1337);
		$this->assertEquals(Item::get('Crystal1'), $this->randomizer->getWorld()->getLocation("Palace of Darkness Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal2'), $this->randomizer->getWorld()->getLocation("Swamp Palace Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal3'), $this->randomizer->getWorld()->getLocation("Skull Woods Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal4'), $this->randomizer->getWorld()->getLocation("Thieves Town Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal5'), $this->randomizer->getWorld()->getLocation("Ice Palace Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal6'), $this->randomizer->getWorld()->getLocation("Misery Mire Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal7'), $this->randomizer->getWorld()->getLocation("Turtle Rock Crystal")->getItem());
	}

	/**
	 * @group crystals
	 */
	public function testCrystalsNotRandomizedByConfigNoCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', false);
		Config::set('alttp.test_rules.prize.shuffleCrystals', false);

		$this->randomizer->makeSeed(1337);
		$this->assertEquals(Item::get('Crystal1'), $this->randomizer->getWorld()->getLocation("Palace of Darkness Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal2'), $this->randomizer->getWorld()->getLocation("Swamp Palace Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal3'), $this->randomizer->getWorld()->getLocation("Skull Woods Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal4'), $this->randomizer->getWorld()->getLocation("Thieves Town Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal5'), $this->randomizer->getWorld()->getLocation("Ice Palace Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal6'), $this->randomizer->getWorld()->getLocation("Misery Mire Crystal")->getItem());
		$this->assertEquals(Item::get('Crystal7'), $this->randomizer->getWorld()->getLocation("Turtle Rock Crystal")->getItem());
	}


	/**
	 * @group pendants
	 */
	public function testPendantsNotRandomizedByConfigNoCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', false);
		Config::set('alttp.test_rules.prize.shufflePendants', false);

		$this->randomizer->makeSeed(1337);
		$this->assertEquals(Item::get('PendantOfCourage'), $this->randomizer->getWorld()->getLocation("Eastern Palace Pendant")->getItem());
		$this->assertEquals(Item::get('PendantOfPower'), $this->randomizer->getWorld()->getLocation("Desert Palace Pendant")->getItem());
		$this->assertEquals(Item::get('PendantOfWisdom'), $this->randomizer->getWorld()->getLocation("Tower of Hera Pendant")->getItem());
	}

	/**
	 * @group pendants
	 */
	public function testPendantsNotRandomizedByConfigCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', true);
		Config::set('alttp.test_rules.prize.shufflePendants', false);

		$this->randomizer->makeSeed(1337);
		$this->assertEquals(Item::get('PendantOfCourage'), $this->randomizer->getWorld()->getLocation("Eastern Palace Pendant")->getItem());
		$this->assertEquals(Item::get('PendantOfPower'), $this->randomizer->getWorld()->getLocation("Desert Palace Pendant")->getItem());
		$this->assertEquals(Item::get('PendantOfWisdom'), $this->randomizer->getWorld()->getLocation("Tower of Hera Pendant")->getItem());
	}

	/**
	 * Adjust this test and increment Logic on Randomizer if this fails.
	 */
	public function testLogicHasntChanged() {
		$this->randomizer->makeSeed(1337);
		$loc_item_array = $this->randomizer->getWorld()->getLocations()->map(function($loc){
			return $loc->getItem()->getName();
		});

		$this->assertEquals([
			"Uncle" => "L1Sword",
			"[cave-034] Hyrule Castle secret entrance" => "BombUpgrade5",
			"[cave-018] Graveyard - top right grave" => "MagicMirror",
			"[cave-047] Dam" => "BombUpgrade5",
			"[cave-040] Link's House" => "TenArrows",
			"[cave-031] Tavern" => "TwentyRupees",
			"[cave-026] chicken house" => "TwentyRupees",
			"[cave-044] Aginah's cave" => "ArrowUpgrade5",
			"[cave-035] Sahasrahla's Hut [left chest]" => "TenArrows",
			"[cave-035] Sahasrahla's Hut [center chest]" => "Quake",
			"[cave-035] Sahasrahla's Hut [right chest]" => "ThreeBombs",
			"[cave-021] Kakariko well [top chest]" => "BlueShield",
			"[cave-021] Kakariko well [left chest row of 3]" => "BugCatchingNet",
			"[cave-021] Kakariko well [center chest row of 3]" => "PieceOfHeart",
			"[cave-021] Kakariko well [right chest row of 3]" => "ArrowUpgrade5",
			"[cave-021] Kakariko well [bottom chest]" => "TwentyRupees",
			"[cave-022-B1] Thief's hut [top chest]" => "ArrowUpgrade5",
			"[cave-022-B1] Thief's hut [top left chest]" => "PieceOfHeart",
			"[cave-022-B1] Thief's hut [top right chest]" => "PieceOfHeart",
			"[cave-022-B1] Thief's hut [bottom left chest]" => "PieceOfHeart",
			"[cave-022-B1] Thief's hut [bottom right chest]" => "PieceOfHeart",
			"[cave-016] cave under rocks west of Santuary" => "Bottle",
			"[cave-050] cave southwest of Lake Hylia [bottom left chest]" => "RedMail",
			"[cave-050] cave southwest of Lake Hylia [top left chest]" => "PieceOfHeart",
			"[cave-050] cave southwest of Lake Hylia [top right chest]" => "MirrorShield",
			"[cave-050] cave southwest of Lake Hylia [bottom right chest]" => "TitansMitt",
			"[cave-051] Ice Cave" => "BossHeartContainer",
			"Bottle Vendor" => "PieceOfHeart",
			"Sahasrahla" => "PieceOfHeart",
			"Magic Bat" => "ThreeBombs",
			"Sick Kid" => "ThreeBombs",
			"Purple Chest" => "FireRod",
			"Hobo" => "Cape",
			"Bombos Tablet" => "PieceOfHeart",
			"King Zora" => "BottleWithFairy",
			"Piece of Heart (Thieves' Forest Hideout)" => "MoonPearl",
			"Piece of Heart (Lumberjack Tree)" => "TwentyRupees",
			"Piece of Heart (south of Haunted Grove)" => "Hammer",
			"Piece of Heart (Graveyard)" => "Bombos",
			"Piece of Heart (Desert - northeast corner)" => "TwentyRupees",
			"[cave-050] cave southwest of Lake Hylia - generous guy" => "TwentyRupees",
			"Library" => "Flippers",
			"Mushroom" => "FiveRupees",
			"Witch" => "TwentyRupees",
			"Piece of Heart (Maze Race)" => "BossHeartContainer",
			"Piece of Heart (Desert - west side)" => "ThreeBombs",
			"Piece of Heart (Lake Hylia)" => "HeartContainer",
			"Piece of Heart (Dam)" => "BossHeartContainer",
			"Piece of Heart (Zora's River)" => "ThreeHundredRupees",
			"Haunted Grove item" => "ThreeHundredRupees",
			"[dungeon-C-1F] Sanctuary" => "PowerGlove",
			"[dungeon-C-B1] Escape - final basement room [left chest]" => "PieceOfHeart",
			"[dungeon-C-B1] Escape - final basement room [middle chest]" => "Bow",
			"[dungeon-C-B1] Escape - final basement room [right chest]" => "Map",
			"[dungeon-C-B1] Escape - first B1 room" => "Key",
			"[dungeon-C-B1] Hyrule Castle - boomerang room" => "Hookshot",
			"[dungeon-C-B1] Hyrule Castle - map room" => "PegasusBoots",
			"[dungeon-C-B3] Hyrule Castle - next to Zelda" => "TwentyRupees",
			"[dungeon-L1-1F] Eastern Palace - compass room" => "Compass",
			"[dungeon-L1-1F] Eastern Palace - big chest" => "TwentyRupees",
			"[dungeon-L1-1F] Eastern Palace - big ball room" => "OneHundredRupees",
			"[dungeon-L1-1F] Eastern Palace - Big key" => "Map",
			"[dungeon-L1-1F] Eastern Palace - map room" => "BigKey",
			"Heart Container - Armos Knights" => "BossHeartContainer",
			"[dungeon-L2-B1] Desert Palace - big chest" => "ThreeHundredRupees",
			"[dungeon-L2-B1] Desert Palace - Map room" => "Compass",
			"[dungeon-L2-B1] Desert Palace - Small key room" => "Key",
			"[dungeon-L2-B1] Desert Palace - Big key room" => "BigKey",
			"[dungeon-L2-B1] Desert Palace - compass room" => "Map",
			"Heart Container - Lanmolas" => "PieceOfHeart",
			"Ether Tablet" => "TwentyRupees",
			"Old Mountain Man" => "Powder",
			"Piece of Heart (Spectacle Rock Cave)" => "ThreeBombs",
			"Piece of Heart (Spectacle Rock)" => "TenArrows",
			"[cave-012-1F] Death Mountain - wall of caves - left cave" => "QuarterMagic",
			"[cave-013] Mimic cave (from Turtle Rock)" => "Lamp",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]" => "Shovel",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]" => "PieceOfHeart",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]" => "ThreeBombs",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]" => "ThreeBombs",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]" => "OneHundredRupees",
			"[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]" => "TwentyRupees",
			"[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]" => "BookOfMudora",
			"Piece of Heart (Death Mountain - floating island)" => "ThreeBombs",
			"[dungeon-L3-1F] Tower of Hera - first floor" => "BossHeartContainer",
			"[dungeon-L3-1F] Tower of Hera - freestanding key" => "Key",
			"[dungeon-L3-2F] Tower of Hera - Entrance" => "BigKey",
			"[dungeon-L3-4F] Tower of Hera - 4F [small chest]" => "FiftyRupees",
			"[dungeon-L3-4F] Tower of Hera - big chest" => "Map",
			"Heart Container - Moldorm" => "Compass",
			"[dungeon-A1-2F] Hyrule Castle Tower - 2 knife guys room" => "Key",
			"[dungeon-A1-3F] Hyrule Castle Tower - maze room" => "Key",
			"[cave-055] Spike cave" => "BottleWithBluePotion",
			"[cave-071] Misery Mire west area [left chest]" => "FiftyRupees",
			"[cave-071] Misery Mire west area [right chest]" => "BossHeartContainer",
			"[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]" => "TenArrows",
			"[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]" => "TenArrows",
			"[cave-056] Dark World Death Mountain - cave under boulder [top right chest]" => "ThreeBombs",
			"[cave-056] Dark World Death Mountain - cave under boulder [top left chest]" => "FiftyRupees",
			"[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]" => "RedShield",
			"[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]" => "BombUpgrade5",
			"Catfish" => "OneHundredRupees",
			"Piece of Heart (Pyramid)" => "BossHeartContainer",
			"[cave-063] doorless hut" => "PieceOfHeart",
			"[cave-062] C-shaped house" => "TenArrows",
			"Piece of Heart (Treasure Chest Game)" => "Mushroom",
			"Piece of Heart (Dark World blacksmith pegs)" => "PieceOfHeart",
			"Piece of Heart (Dark World - bumper cave)" => "OneRupee",
			"[cave-073] cave northeast of swamp palace [top chest]" => "OcarinaInactive",
			"[cave-073] cave northeast of swamp palace [top middle chest]" => "ThreeHundredRupees",
			"[cave-073] cave northeast of swamp palace [bottom middle chest]" => "OneHundredRupees",
			"[cave-073] cave northeast of swamp palace [bottom chest]" => "ThreeBombs",
			"Flute Boy" => "PieceOfHeart",
			"[cave-073] cave northeast of swamp palace - generous guy" => "FiftyRupees",
			"Piece of Heart (Digging Game)" => "OneRupee",
			"[dungeon-D1-1F] Dark Palace - big key room" => "Map",
			"[dungeon-D1-1F] Dark Palace - jump room [right chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - jump room [left chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - big chest" => "Compass",
			"[dungeon-D1-1F] Dark Palace - compass room" => "StaffOfByrna",
			"[dungeon-D1-1F] Dark Palace - spike statue room" => "CaneOfSomaria",
			"[dungeon-D1-B1] Dark Palace - turtle stalfos room" => "Key",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]" => "PieceOfHeart",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - statue push room" => "Key",
			"[dungeon-D1-1F] Dark Palace - maze room [top chest]" => "FiftyRupees",
			"[dungeon-D1-1F] Dark Palace - maze room [bottom chest]" => "BigKey",
			"[dungeon-D1-B1] Dark Palace - shooter room" => "Key",
			"Heart Container - Helmasaur King" => "TwentyRupees",
			"[dungeon-D2-1F] Swamp Palace - first room" => "Key",
			"[dungeon-D2-B1] Swamp Palace - big chest" => "PieceOfHeart",
			"[dungeon-D2-B1] Swamp Palace - big key room" => "BombUpgrade5",
			"[dungeon-D2-B1] Swamp Palace - map room" => "Map",
			"[dungeon-D2-B1] Swamp Palace - push 4 blocks room" => "IceRod",
			"[dungeon-D2-B1] Swamp Palace - south of hookshot room" => "BombUpgrade10",
			"[dungeon-D2-B2] Swamp Palace - flooded room [left chest]" => "Compass",
			"[dungeon-D2-B2] Swamp Palace - flooded room [right chest]" => "Bottle",
			"[dungeon-D2-B2] Swamp Palace - hidden waterfall door room" => "BigKey",
			"Heart Container - Arrghus" => "FiveRupees",
			"[dungeon-D3-B1] Skull Woods - big chest" => "Key",
			"[dungeon-D3-B1] Skull Woods - Big Key room" => "BossHeartContainer",
			"[dungeon-D3-B1] Skull Woods - Compass room" => "Map",
			"[dungeon-D3-B1] Skull Woods - east of Fire Rod room" => "Key",
			"[dungeon-D3-B1] Skull Woods - Entrance to part 2" => "TwentyRupees",
			"[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room" => "Compass",
			"[dungeon-D3-B1] Skull Woods - south of Fire Rod room" => "Key",
			"Heart Container - Mothula" => "BigKey",
			"[dungeon-D4-1F] Thieves' Town - Room above boss" => "PieceOfHeart",
			"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]" => "Compass",
			"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]" => "BigKey",
			"[dungeon-D4-B1] Thieves' Town - Bottom right of huge room" => "Key",
			"[dungeon-D4-B1] Thieves' Town - Top left of huge room" => "PieceOfHeart",
			"[dungeon-D4-B2] Thieves' Town - big chest" => "Map",
			"[dungeon-D4-B2] Thieves' Town - next to Blind" => "BossHeartContainer",
			"Heart Container - Blind" => "PieceOfHeart",
			"[dungeon-D5-B1] Ice Palace - Big Key room" => "Compass",
			"[dungeon-D5-B1] Ice Palace - compass room" => "Key",
			"[dungeon-D5-B2] Ice Palace - map room" => "ArrowUpgrade5",
			"[dungeon-D5-B3] Ice Palace - spike room" => "BigKey",
			"[dungeon-D5-B4] Ice Palace - above Blue Mail room" => "BombUpgrade5",
			"[dungeon-D5-B5] Ice Palace - b5 up staircase" => "Key",
			"[dungeon-D5-B5] Ice Palace - big chest" => "RedBoomerang",
			"Heart Container - Kholdstare" => "Map",
			"[dungeon-D6-B1] Misery Mire - big chest" => "Map",
			"[dungeon-D6-B1] Misery Mire - big hub room" => "Key",
			"[dungeon-D6-B1] Misery Mire - big key" => "Compass",
			"[dungeon-D6-B1] Misery Mire - compass" => "FiftyRupees",
			"[dungeon-D6-B1] Misery Mire - end of bridge" => "Key",
			"[dungeon-D6-B1] Misery Mire - map room" => "Key",
			"[dungeon-D6-B1] Misery Mire - spike room" => "BigKey",
			"Heart Container - Vitreous" => "BossHeartContainer",
			"[dungeon-D7-1F] Turtle Rock - Chain chomp room" => "BigKey",
			"[dungeon-D7-1F] Turtle Rock - compass room" => "Key",
			"[dungeon-D7-1F] Turtle Rock - Map room [left chest]" => "Key",
			"[dungeon-D7-1F] Turtle Rock - Map room [right chest]" => "Compass",
			"[dungeon-D7-B1] Turtle Rock - big chest" => "Arrow",
			"[dungeon-D7-B1] Turtle Rock - big key room" => "Key",
			"[dungeon-D7-B1] Turtle Rock - Roller switch room" => "Ether",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]" => "Boomerang",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]" => "Key",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]" => "TenArrows",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]" => "Map",
			"Heart Container - Trinexx" => "ArrowUpgrade10",
			"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]" => "BombUpgrade5",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]" => "OneHundredRupees",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]" => "ArrowUpgrade5",
			"[dungeon-A2-1F] Ganon's Tower - north of teleport room" => "ThreeBombs",
			"[dungeon-A2-1F] Ganon's Tower - map room" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - big chest" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]" => "BlueMail",
			"[dungeon-A2-1F] Ganon's Tower - above Armos" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace" => "Compass",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]" => "FiftyRupees",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]" => "BigKey",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]" => "ArrowUpgrade5",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]" => "OneHundredRupees",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]" => "TwentyRupees",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]" => "TwentyRupees",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]" => "TwentyRupees",
			"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]" => "Map",
			"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]" => "Key",
			"[dungeon-A2-6F] Ganon's Tower - before Moldorm" => "TwentyRupees",
			"[dungeon-A2-6F] Ganon's Tower - Moldorm room" => "ThreeBombs",
			"Eastern Palace Pendant" => "PendantOfWisdom",
			"Desert Palace Pendant" => "Crystal7",
			"Tower of Hera Pendant" => "Crystal1",
			"Palace of Darkness Crystal" => "Crystal3",
			"Swamp Palace Crystal" => "Crystal2",
			"Skull Woods Crystal" => "PendantOfPower",
			"Thieves Town Crystal" => "PendantOfCourage",
			"Ice Palace Crystal" => "Crystal6",
			"Misery Mire Crystal" => "Crystal4",
			"Turtle Rock Crystal" => "Crystal5",
			"Pyramid" => "MasterSword",
			"Blacksmiths" => "L3Sword",
			"Alter" => "L4Sword",
			"Turtle Rock Medallion" => "Bombos",
			"Misery Mire Medallion" => "Quake",
			"Waterfall Bottle" => "BottleWithBee",
			"Pyramid Bottle" => "BottleWithBluePotion",
		], $loc_item_array);
	}
}
