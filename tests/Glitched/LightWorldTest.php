<?php namespace Glitched;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class LightWorldTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'Glitched');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testAltarRequiresPendantOfCourage() {
		$this->assertFalse($this->world->getLocation("Altar")
			->canAccess($this->allItemsExcept(['PendantOfCourage'])));
	}

	public function testAltarRequiresPendantOfPower() {
		$this->assertFalse($this->world->getLocation("Altar")
			->canAccess($this->allItemsExcept(['PendantOfPower'])));
	}

	public function testAltarRequiresPendantOfWisdom() {
		$this->assertFalse($this->world->getLocation("Altar")
			->canAccess($this->allItemsExcept(['PendantOfWisdom'])));
	}

	public function testBlacksmithsRequiresMirror() {
		$this->assertFalse($this->world->getLocation("Blacksmiths")
			->canAccess($this->allItemsExcept(['MagicMirror'])));
	}

	public function testBlacksmithsRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("Blacksmiths")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testUncleRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Uncle")
			->canAccess($this->collected));
	}

	public function testSecretEntranceRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-034] Hyrule Castle secret entrance")
			->canAccess($this->collected));
	}

	public function testGraveyardGraveRequiresNothing() {
		$this->assertFalse($this->world->getLocation("[cave-018] Graveyard - top right grave")
			->canAccess($this->collected));
	}

	public function testGraveyardGraveRequiresBootsAndMitts() {
		$this->addCollected(['PegasusBoots', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-018] Graveyard - top right grave")
			->canAccess($this->collected));
	}

	public function testGraveyardGraveRequiresBootsMirrorMoonPearlAndAccessToNWDW() {
		$this->addCollected(['PegasusBoots', 'Cape', 'Hookshot', 'Hammer', 'MagicMirror', 'MoonPearl', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("[cave-018] Graveyard - top right grave")
			->canAccess($this->collected));
	}

	public function testDamRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-047] Dam")
			->canAccess($this->collected));
	}

	public function testLinksHouseRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-040] Link's House")
			->canAccess($this->collected));
	}

	public function testTavernRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-031] Tavern")
			->canAccess($this->collected));
	}

	public function testChickenHouseRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-026] chicken house")
			->canAccess($this->collected));
	}

	public function testAgiahsCaveRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-044] Aginah's cave")
			->canAccess($this->collected));
	}

	public function testSahasrahlasHutChest1RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-035] Sahasrahla's Hut [left chest]")
			->canAccess($this->collected));
	}

	public function testSahasrahlasHutChest2RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-035] Sahasrahla's Hut [center chest]")
			->canAccess($this->collected));
	}

	public function testSahasrahlasHutChest3RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-035] Sahasrahla's Hut [right chest]")
			->canAccess($this->collected));
	}

	public function testKakarikoWellChest1RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-021] Kakariko well [top chest]")
			->canAccess($this->collected));
	}

	public function testKakarikoWellChest2RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-021] Kakariko well [left chest row of 3]")
			->canAccess($this->collected));
	}

	public function testKakarikoWellChest3RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-021] Kakariko well [center chest row of 3]")
			->canAccess($this->collected));
	}

	public function testKakarikoWellChest4RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-021] Kakariko well [right chest row of 3]")
			->canAccess($this->collected));
	}

	public function testKakarikoWellChest5RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-021] Kakariko well [bottom chest]")
			->canAccess($this->collected));
	}

	public function testThievesHutChest1RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-022-B1] Thief's hut [top chest]")
			->canAccess($this->collected));
	}

	public function testThievesHutChest2RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-022-B1] Thief's hut [top left chest]")
			->canAccess($this->collected));
	}

	public function testThievesHutChest3RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-022-B1] Thief's hut [top right chest]")
			->canAccess($this->collected));
	}

	public function testThievesHutChest4RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-022-B1] Thief's hut [bottom left chest]")
			->canAccess($this->collected));
	}

	public function testThievesHutChest5RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-022-B1] Thief's hut [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testCaveUnderRocksRequiresNothing() {
		$this->assertFalse($this->world->getLocation("[cave-016] cave under rocks west of Santuary")
			->canAccess($this->collected));
	}

	public function testCaveUnderRocksRequiresBoots() {
		$this->addCollected(['PegasusBoots']);

		$this->assertTrue($this->world->getLocation("[cave-016] cave under rocks west of Santuary")
			->canAccess($this->collected));
	}

	public function testCaveSWLakeHyliaChest1RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-050] cave southwest of Lake Hylia [bottom left chest]")
			->canAccess($this->collected));
	}

	public function testCaveSWLakeHyliaChest2RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-050] cave southwest of Lake Hylia [top left chest]")
			->canAccess($this->collected));
	}

	public function testCaveSWLakeHyliaChest3RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-050] cave southwest of Lake Hylia [top right chest]")
			->canAccess($this->collected));
	}

	public function testCaveSWLakeHyliaChest4RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-050] cave southwest of Lake Hylia [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testIceCaveRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-051] Ice Cave")
			->canAccess($this->collected));
	}

	public function testBottleVendorRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Bottle Vendor")
			->canAccess($this->collected));
	}

	public function testSahasrahlaRequiresNothing() {
		$this->assertFalse($this->world->getLocation("Sahasrahla")
			->canAccess($this->collected));
	}

	public function testSahasrahlaRequiresPendantOfCourage() {
		$this->addCollected(['PendantOfCourage']);

		$this->assertTrue($this->world->getLocation("Sahasrahla")
			->canAccess($this->collected));
	}

	public function testMagicBatRequiresNothing() {
		$this->assertFalse($this->world->getLocation("Magic Bat")
			->canAccess($this->collected));
	}

	public function testMagicBatRequiresPowderAndHammer() {
		$this->addCollected(['Powder', 'Hammer']);

		$this->assertTrue($this->world->getLocation("Magic Bat")
			->canAccess($this->collected));
	}

	public function testMagicBatRequiresPowderMirrorMoonPearlAndMitts() {
		$this->addCollected(['Powder', 'MagicMirror', 'MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Magic Bat")
			->canAccess($this->collected));
	}

	public function testSickKidRequiresNothing() {
		$this->assertFalse($this->world->getLocation("Sick Kid")
			->canAccess($this->collected));
	}

	public function testSickKidRequiresBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("Sick Kid")
			->canAccess($this->collected));
	}

	public function testPurpleChestRequiresNothing() {
		$this->assertFalse($this->world->getLocation("Purple Chest")
			->canAccess($this->collected));
	}

	public function testPurpleChestRequiresMoonPearlMirrorAndMitts() {
		$this->addCollected(['MoonPearl', 'MagicMirror', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Purple Chest")
			->canAccess($this->collected));
	}

	public function testHoboRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Hobo")
			->canAccess($this->collected));
	}

	public function testBombosTabletRequiresNothing() {
		$this->assertFalse($this->world->getLocation("Bombos Tablet")
			->canAccess($this->collected));
	}

	public function testBombosTabletRequiresSwordBookMirrorMoonPearlAndAccesstoSDW() {
		$this->addCollected(['BookOfMudora', 'MoonPearl', 'L2Sword', 'TitansMitt', 'MagicMirror']);

		$this->assertTrue($this->world->getLocation("Bombos Tablet")
			->canAccess($this->collected));
	}

	public function testKingZoraRequiresNothing() {
		$this->assertTrue($this->world->getLocation("King Zora")
			->canAccess($this->collected));
	}

	public function testForestHideoutRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Thieves' Forest Hideout)")
			->canAccess($this->collected));
	}

	public function testLumberjackTreeRequiresNothing() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Lumberjack Tree)")
			->canAccess($this->collected));
	}

	public function testLumberjackTreeRequiresBootsAndAgahnimDestruction() {
		$this->addCollected(['PegasusBoots', 'Cape', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Lumberjack Tree)")
			->canAccess($this->collected));
	}

	public function testSouthOfHauntedGroveRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (south of Haunted Grove)")
			->canAccess($this->collected));
	}

	public function testAboveGraveyardRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Graveyard)")
			->canAccess($this->collected));
	}

	public function testNorthEastDesertRequiresGloves() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Desert - northeast corner)")
			->canAccess($this->allItemsExcept(['Gloves'])));
	}

	public function testCaveSWLakeHyliaGenerousGuyRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-050] cave southwest of Lake Hylia - generous guy")
			->canAccess($this->collected));
	}

	public function testLibraryRequiresNothing() {
		$this->assertFalse($this->world->getLocation("Library")
			->canAccess($this->collected));
	}

	public function testLibraryRequiresBoots() {
		$this->addCollected(['PegasusBoots']);

		$this->assertTrue($this->world->getLocation("Library")
			->canAccess($this->collected));
	}

	public function testMushroomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Mushroom")
			->canAccess($this->collected));
	}

	public function testWitchRequiresNothing() {
		$this->assertFalse($this->world->getLocation("Witch")
			->canAccess($this->collected));
	}

	public function testWitchRequiresMushroom() {
		$this->addCollected(['Mushroom']);

		$this->assertTrue($this->world->getLocation("Witch")
			->canAccess($this->collected));
	}

	public function testMazeRaceRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Maze Race)")
			->canAccess($this->collected));
	}

	public function testDesertWestRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Desert - west side)")
			->canAccess($this->collected));
	}

	public function testRageRodIslandRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Lake Hylia)")
			->canAccess($this->collected));
	}

	public function testDrainedDamRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Dam)")
			->canAccess($this->collected));
	}

	public function testZorasHeartRequiresFlippersIfNoBoots() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Zora's River)")
			->canAccess($this->allItemsExcept(['Flippers', 'PegasusBoots'])));
	}

	public function testZorasHeartRequiresFlippersIfNoMoonPearl() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Zora's River)")
			->canAccess($this->allItemsExcept(['Flippers', 'MoonPearl'])));
	}

	public function testHauntedGroveRequiresShovel() {
		$this->assertFalse($this->world->getLocation("Haunted Grove item")
			->canAccess($this->allItemsExcept(['Shovel'])));
	}
}
