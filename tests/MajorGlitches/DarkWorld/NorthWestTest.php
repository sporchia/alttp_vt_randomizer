<?php namespace MajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class NorthWestTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Item Locations
	public function testDoorlessHutRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testDoorlessHutRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testDoorlessHutRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresMoonPearlOrBottleOrMirror() {
		$this->assertFalse($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl', 'MagicMirror'])));
	}

	public function testCShapedHouseRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresOnlyMirror() {
		$this->addCollected(['MagicMirror']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresMoonPearlOrBottleOrMirror() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl', 'MagicMirror'])));
	}

	public function testTreasureChestGameRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresOnlyMirror() {
		$this->addCollected(['MagicMirror']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testBlacksmithPegsRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World blacksmith pegs)")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testBlacksmithPegsRequiresHammer() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World blacksmith pegs)")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBlacksmithPegsRequiresOnlyHammerAndBottle() {
		$this->addCollected(['Hammer', 'Bottle']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Dark World blacksmith pegs)")
			->canAccess($this->collected));
	}

	public function testBlacksmithPegsRequiresOnlyHammerAndMoonPearl() {
		$this->addCollected(['Hammer', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Dark World blacksmith pegs)")
			->canAccess($this->collected));
	}

	public function testBumperCaveRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testBumperCaveRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->collected));
	}

	public function testBumperCaveRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->collected));
	}
}
