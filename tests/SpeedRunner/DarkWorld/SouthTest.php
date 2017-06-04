<?php namespace SpeedRunner\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class SouthTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Item Locations
	public function testHypeCaveChest1RequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testHypeCaveChest1RequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest1RequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest1RequiresCapeAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest1RequiresUpgradedSwordAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest1RequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest1RequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest1RequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest1RequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testHypeCaveChest2RequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresCapeAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresUpgradedSwordAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testHypeCaveChest3RequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresCapeAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresUpgradedSwordAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testHypeCaveChest4RequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresCapeAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresUpgradedSwordAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testHypeCaveGenerousGuyRequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresCapeAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresUpgradedSwordAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("Flute Boy")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testFluteBoyRequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresCapeAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresUpgradedSwordAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDiggingGameRequiresAccessWithHammerAndGlove() {
		$this->addCollected(['MoonPearl', 'Hammer', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresAccessWithTitansMitt() {
		$this->addCollected(['MoonPearl', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresCapeAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresUpgradedSwordAndHammer() {
		$this->addCollected(['MoonPearl', 'Hammer', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresCapeAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresUpgradedSwordAndHookshotAndGlove() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresCapeAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresUpgradedSwordAndHookshotAndFlippers() {
		$this->addCollected(['MoonPearl', 'Flippers', 'Hookshot', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}
}
