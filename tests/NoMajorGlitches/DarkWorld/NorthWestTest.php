<?php namespace NoMajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class NorthWestTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Item Locations
	public function testDoorlessHutRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDoorlessHutRequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testDoorlessHutRequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testDoorlessHutRequiresCapeAndHookshotAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testDoorlessHutRequiresUpgradedSwordAndHookshotAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testDoorlessHutRequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testDoorlessHutRequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testDoorlessHutRequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testDoorlessHutRequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-063] doorless hut")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testCShapedHouseRequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresCapeAndHookshotAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresUpgradedSwordAndHookshotAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testCShapedHouseRequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-062] C-shaped house")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testTreasureChestGameRequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresCapeAndHookshotAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresUpgradedSwordAndHookshotAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testTreasureChestGameRequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Treasure Chest Game)")
			->canAccess($this->collected));
	}

	public function testBlacksmithPegsRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World blacksmith pegs)")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testBlacksmithPegsRequiresHammer() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World blacksmith pegs)")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBlacksmithPegsRequiresTitansMitt() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World blacksmith pegs)")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testBlacksmithPegsRequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'Hammer', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Dark World blacksmith pegs)")
			->canAccess($this->collected));
	}

	public function testBumperCaveRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testBumperCaveRequiresCape() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->allItemsExcept(['Cape'])));
	}

	public function testBumperCaveRequiresGloves() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->allItemsExcept(['Gloves'])));
	}

	public function testBumperCaveRequiresAccessWithCapeAndHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Cape', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->collected));
	}

	public function testBumperCaveRequiresAccessWithCapeAndTitansMitt() {
		$this->addCollected(['MoonPearl', 'Cape', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->collected));
	}

	public function testBumperCaveRequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'Cape', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->collected));
	}
}
