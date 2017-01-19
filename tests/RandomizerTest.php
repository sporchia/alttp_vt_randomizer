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

		$this->assertEquals($loc_item_array, [
			"Uncle" => "L1SwordAndShield",
			"[cave-034] Hyrule Castle secret entrance" => "OcarinaInactive",
			"[cave-018] Graveyard - top right grave" => "BookOfMudora",
			"[cave-047] Dam" => "PieceOfHeart",
			"[cave-040] Link's House" => "TwentyRupees",
			"[cave-031] Tavern" => "ThreeBombs",
			"[cave-026] chicken house" => "TwentyRupees",
			"[cave-044] Aginah's cave" => "BottleWithRedPotion",
			"[cave-035] Sahasrahla's Hut [left chest]" => "PieceOfHeart",
			"[cave-035] Sahasrahla's Hut [center chest]" => "BossHeartContainer",
			"[cave-035] Sahasrahla's Hut [right chest]" => "PieceOfHeart",
			"[cave-021] Kakariko well [top chest]" => "PieceOfHeart",
			"[cave-021] Kakariko well [left chest row of 3]" => "Arrow",
			"[cave-021] Kakariko well [center chest row of 3]" => "PieceOfHeart",
			"[cave-021] Kakariko well [right chest row of 3]" => "PieceOfHeart",
			"[cave-021] Kakariko well [bottom chest]" => "BossHeartContainer",
			"[cave-022-B1] Thief's hut [top chest]" => "TwentyRupees",
			"[cave-022-B1] Thief's hut [top left chest]" => "TwentyRupees",
			"[cave-022-B1] Thief's hut [top right chest]" => "TwentyRupees",
			"[cave-022-B1] Thief's hut [bottom left chest]" => "Ether",
			"[cave-022-B1] Thief's hut [bottom right chest]" => "BossHeartContainer",
			"[cave-016] cave under rocks west of Santuary" => "Mushroom",
			"[cave-050] cave southwest of Lake Hylia [bottom left chest]" => "PegasusBoots",
			"[cave-050] cave southwest of Lake Hylia [top left chest]" => "FiftyRupees",
			"[cave-050] cave southwest of Lake Hylia [top right chest]" => "ArrowUpgrade10",
			"[cave-050] cave southwest of Lake Hylia [bottom right chest]" => "PieceOfHeart",
			"[cave-051] Ice Cave" => "ThreeBombs",
			"Bottle Vendor" => "TwentyRupees",
			"Sahasrahla" => "PieceOfHeart",
			"Magic Bat" => "ArrowUpgrade5",
			"Sick Kid" => "OneHundredRupees",
			"Purple Chest" => "Quake",
			"Hobo" => "RedBoomerang",
			"Bombos Tablet" => "TwentyRupees",
			"King Zora" => "StaffOfByrna",
			"Piece of Heart (Thieves' Forest Hideout)" => "Shovel",
			"Piece of Heart (Lumberjack Tree)" => "FiftyRupees",
			"Piece of Heart (south of Haunted Grove)" => "HeartContainer",
			"Piece of Heart (Graveyard)" => "FiftyRupees",
			"Piece of Heart (Desert - northeast corner)" => "PieceOfHeart",
			"[cave-050] cave southwest of Lake Hylia - generous guy" => "PieceOfHeart",
			"Library" => "BombUpgrade5",
			"Mushroom" => "TenArrows",
			"Witch" => "TenArrows",
			"Piece of Heart (Maze Race)" => "ThreeBombs",
			"Piece of Heart (Desert - west side)" => "MirrorShield",
			"Piece of Heart (Lake Hylia)" => "FiftyRupees",
			"Piece of Heart (Dam)" => "PieceOfHeart",
			"Piece of Heart (Zora's River)" => "TenArrows",
			"Haunted Grove item" => "ArrowUpgrade5",
			"[dungeon-C-1F] Sanctuary" => "OneHundredRupees",
			"[dungeon-C-B1] Escape - final basement room [left chest]" => "Flippers",
			"[dungeon-C-B1] Escape - final basement room [middle chest]" => "TwentyRupees",
			"[dungeon-C-B1] Escape - final basement room [right chest]" => "Map",
			"[dungeon-C-B1] Escape - first B1 room" => "Key",
			"[dungeon-C-B1] Hyrule Castle - boomerang room" => "ThreeBombs",
			"[dungeon-C-B1] Hyrule Castle - map room" => "ThreeBombs",
			"[dungeon-C-B3] Hyrule Castle - next to Zelda" => "Hookshot",
			"[dungeon-L1-1F] Eastern Palace - compass room" => "Compass",
			"[dungeon-L1-1F] Eastern Palace - big chest" => "TwentyRupees",
			"[dungeon-L1-1F] Eastern Palace - big ball room" => "BossHeartContainer",
			"[dungeon-L1-1F] Eastern Palace - Big key" => "Map",
			"[dungeon-L1-1F] Eastern Palace - map room" => "BigKey",
			"Heart Container - Armos Knights" => "Hammer",
			"[dungeon-L2-B1] Desert Palace - big chest" => "Lamp",
			"[dungeon-L2-B1] Desert Palace - Map room" => "Compass",
			"[dungeon-L2-B1] Desert Palace - Small key room" => "Key",
			"[dungeon-L2-B1] Desert Palace - Big key room" => "BigKey",
			"[dungeon-L2-B1] Desert Palace - compass room" => "Map",
			"Heart Container - Lanmolas" => "PieceOfHeart",
			"Ether Tablet" => "BombUpgrade5",
			"Old Mountain Man" => "TitansMitt",
			"Piece of Heart (Spectacle Rock Cave)" => "Bow",
			"Piece of Heart (Spectacle Rock)" => "MoonPearl",
			"[cave-012-1F] Death Mountain - wall of caves - left cave" => "BossHeartContainer",
			"[cave-013] Mimic cave (from Turtle Rock)" => "IceRod",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]" => "Cape",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]" => "TenArrows",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]" => "PowerGlove",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]" => "TwentyRupees",
			"[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]" => "FireRod",
			"[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]" => "ArrowUpgrade5",
			"[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]" => "MagicMirror",
			"Piece of Heart (Death Mountain - floating island)" => "TwentyRupees",
			"[dungeon-L3-1F] Tower of Hera - first floor" => "BombUpgrade5",
			"[dungeon-L3-2F] Tower of Hera - Entrance" => "BigKey",
			"[dungeon-L3-4F] Tower of Hera - 4F [small chest]" => "OneHundredRupees",
			"[dungeon-L3-4F] Tower of Hera - big chest" => "Map",
			"Heart Container - Moldorm" => "Compass",
			"[dungeon-A1-2F] Hyrule Castle Tower - 2 knife guys room" => "Key",
			"[dungeon-A1-3F] Hyrule Castle Tower - maze room" => "Key",
			"[cave-055] Spike cave" => "FiftyRupees",
			"[cave-071] Misery Mire west area [left chest]" => "PieceOfHeart",
			"[cave-071] Misery Mire west area [right chest]" => "PieceOfHeart",
			"[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]" => "BombUpgrade5",
			"[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]" => "CaneOfSomaria",
			"[cave-056] Dark World Death Mountain - cave under boulder [top right chest]" => "BottleWithGreenPotion",
			"[cave-056] Dark World Death Mountain - cave under boulder [top left chest]" => "BombUpgrade10",
			"[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]" => "ThreeHundredRupees",
			"[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]" => "TenArrows",
			"Catfish" => "FiftyRupees",
			"Piece of Heart (Pyramid)" => "ThreeBombs",
			"[cave-063] doorless hut" => "BossHeartContainer",
			"[cave-062] C-shaped house" => "PieceOfHeart",
			"Piece of Heart (Treasure Chest Game)" => "TenArrows",
			"Piece of Heart (Dark World blacksmith pegs)" => "ThreeHundredRupees",
			"Piece of Heart (Dark World - bumper cave)" => "ThreeBombs",
			"[cave-073] cave northeast of swamp palace [top chest]" => "PieceOfHeart",
			"[cave-073] cave northeast of swamp palace [top middle chest]" => "ArrowUpgrade5",
			"[cave-073] cave northeast of swamp palace [bottom middle chest]" => "PieceOfHeart",
			"[cave-073] cave northeast of swamp palace [bottom chest]" => "FiveRupees",
			"Flute Boy" => "PieceOfHeart",
			"[cave-073] cave northeast of swamp palace - generous guy" => "FiftyRupees",
			"Piece of Heart (Digging Game)" => "RedShield",
			"[dungeon-D1-1F] Dark Palace - big key room" => "Key",
			"[dungeon-D1-1F] Dark Palace - jump room [right chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - jump room [left chest]" => "Key",
			"[dungeon-D1-1F] Dark Palace - big chest" => "ArrowUpgrade5",
			"[dungeon-D1-1F] Dark Palace - compass room" => "Key",
			"[dungeon-D1-1F] Dark Palace - spike statue room" => "TwentyRupees",
			"[dungeon-D1-B1] Dark Palace - turtle stalfos room" => "Key",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]" => "Key",
			"[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]" => "OneHundredRupees",
			"[dungeon-D1-1F] Dark Palace - statue push room" => "Compass",
			"[dungeon-D1-1F] Dark Palace - maze room [top chest]" => "Bottle",
			"[dungeon-D1-1F] Dark Palace - maze room [bottom chest]" => "PieceOfHeart",
			"[dungeon-D1-B1] Dark Palace - shooter room" => "BigKey",
			"Heart Container - Helmasaur King" => "Map",
			"[dungeon-D2-1F] Swamp Palace - first room" => "Key",
			"[dungeon-D2-B1] Swamp Palace - big chest" => "TwentyRupees",
			"[dungeon-D2-B1] Swamp Palace - big key room" => "Compass",
			"[dungeon-D2-B1] Swamp Palace - map room" => "ThreeBombs",
			"[dungeon-D2-B1] Swamp Palace - push 4 blocks room" => "PieceOfHeart",
			"[dungeon-D2-B1] Swamp Palace - south of hookshot room" => "Map",
			"[dungeon-D2-B2] Swamp Palace - flooded room [left chest]" => "BossHeartContainer",
			"[dungeon-D2-B2] Swamp Palace - flooded room [right chest]" => "Powder",
			"[dungeon-D2-B2] Swamp Palace - hidden waterfall door room" => "BigKey",
			"Heart Container - Arrghus" => "PieceOfHeart",
			"[dungeon-D3-B1] Skull Woods - big chest" => "Compass",
			"[dungeon-D3-B1] Skull Woods - Big Key room" => "Key",
			"[dungeon-D3-B1] Skull Woods - Compass room" => "ThreeBombs",
			"[dungeon-D3-B1] Skull Woods - east of Fire Rod room" => "BigKey",
			"[dungeon-D3-B1] Skull Woods - Entrance to part 2" => "Key",
			"[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room" => "Map",
			"[dungeon-D3-B1] Skull Woods - south of Fire Rod room" => "Key",
			"Heart Container - Mothula" => "RedMail",
			"[dungeon-D4-1F] Thieves' Town - Room above boss" => "BossHeartContainer",
			"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]" => "TwentyRupees",
			"[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]" => "BigKey",
			"[dungeon-D4-B1] Thieves' Town - Bottom right of huge room" => "Bombos",
			"[dungeon-D4-B1] Thieves' Town - Top left of huge room" => "Map",
			"[dungeon-D4-B2] Thieves' Town - big chest" => "OneHundredRupees",
			"[dungeon-D4-B2] Thieves' Town - next to Blind" => "Key",
			"Heart Container - Blind" => "Compass",
			"[dungeon-D5-B1] Ice Palace - Big Key room" => "Key",
			"[dungeon-D5-B1] Ice Palace - compass room" => "ThreeBombs",
			"[dungeon-D5-B2] Ice Palace - map room" => "Compass",
			"[dungeon-D5-B3] Ice Palace - spike room" => "BigKey",
			"[dungeon-D5-B4] Ice Palace - above Blue Mail room" => "ThreeHundredRupees",
			"[dungeon-D5-B5] Ice Palace - b5 up staircase" => "Key",
			"[dungeon-D5-B5] Ice Palace - big chest" => "BottleWithFairy",
			"Heart Container - Kholdstare" => "Map",
			"[dungeon-D6-B1] Misery Mire - big chest" => "Key",
			"[dungeon-D6-B1] Misery Mire - big hub room" => "Key",
			"[dungeon-D6-B1] Misery Mire - big key" => "BigKey",
			"[dungeon-D6-B1] Misery Mire - compass" => "ArrowUpgrade70",
			"[dungeon-D6-B1] Misery Mire - end of bridge" => "BossHeartContainer",
			"[dungeon-D6-B1] Misery Mire - map room" => "Key",
			"[dungeon-D6-B1] Misery Mire - spike room" => "Compass",
			"Heart Container - Vitreous" => "Map",
			"[dungeon-D7-1F] Turtle Rock - Chain chomp room" => "Key",
			"[dungeon-D7-1F] Turtle Rock - compass room" => "BigKey",
			"[dungeon-D7-1F] Turtle Rock - Map room [left chest]" => "Key",
			"[dungeon-D7-1F] Turtle Rock - Map room [right chest]" => "Key",
			"[dungeon-D7-B1] Turtle Rock - big chest" => "TwentyRupees",
			"[dungeon-D7-B1] Turtle Rock - big key room" => "Key",
			"[dungeon-D7-B1] Turtle Rock - Roller switch room" => "TwentyRupees",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]" => "HalfMagic",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]" => "Compass",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]" => "BombUpgrade5",
			"[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]" => "BombUpgrade5",
			"Heart Container - Trinexx" => "Map",
			"[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance" => "Map",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]" => "OneHundredRupees",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]" => "ThreeHundredRupees",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]" => "PieceOfHeart",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]" => "Compass",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]" => "BlueMail",
			"[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]" => "OneRupee",
			"[dungeon-A2-1F] Ganon's Tower - north of teleport room" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - map room" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - big chest" => "BossHeartContainer",
			"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]" => "TwentyRupees",
			"[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - above Armos" => "ThreeBombs",
			"[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace" => "Key",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]" => "ArrowUpgrade5",
			"[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]" => "BigKey",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]" => "BugCatchingNet",
			"[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]" => "PieceOfHeart",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]" => "TenArrows",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]" => "Boomerang",
			"[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]" => "TwentyRupees",
			"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]" => "OneRupee",
			"[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]" => "ThreeBombs",
			"[dungeon-A2-6F] Ganon's Tower - before Moldorm" => "TwentyRupees",
			"[dungeon-A2-6F] Ganon's Tower - Moldorm room" => "FiveRupees",
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
		]);
	}
}
