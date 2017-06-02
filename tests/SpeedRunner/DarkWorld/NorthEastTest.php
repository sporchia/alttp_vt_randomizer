<?php namespace SpeedRunner\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class NorthEastTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Item Locations
	public function testCatfishRequiresGloves() {
		$this->assertFalse($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Gloves'])));
	}

	public function testCatfishRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testCatfishRequiresAG1OrHammerOrFlippers() {
		$this->assertFalse($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['DefeatAgahnim', 'Hammer', 'Flippers'])));
	}

	public function testCatfishRequiresTitansMittIfHasFlippersAndNotAG1OrHammer() {
		$this->assertFalse($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['DefeatAgahnim', 'Hammer', 'TitansMitt'])));
	}

	public function testCatfishDoesNotRequireAG1IfHasFlippers() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['DefeatAgahnim', 'Hammer'])));
	}

	public function testCatfishDoesNotRequireAG1IfHasHammer() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['DefeatAgahnim', 'Flippers'])));
	}

	public function testCatfishDoesNotRequireFlippersIfHasHammer() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Flippers', 'DefeatAgahnim'])));
	}

	public function testCatfishDoesNotRequireFlippersIfHasCape() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Flippers', 'Hammer', 'UpgradedSword'])));
	}

	public function testCatfishDoesNotRequireFlippersIfHasUpgradedSword() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Flippers', 'Hammer', 'Cape'])));
	}

	public function testCatfishDoesNotRequireHammerIfHasFlippers() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Hammer', 'DefeatAgahnim'])));
	}

	public function testCatfishDoesNotRequireHammerIfHasCape() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Hammer', 'Flippers', 'UpgradedSword'])));
	}

	public function testCatfishDoesNotRequireHammerIfHasUpgradedSword() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Hammer', 'Flippers', 'Cape'])));
	}

	public function testPyramidDoesNotRequireMoonPearl() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testPyramidRequiresAG1OrHammerOrFlippers() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['DefeatAgahnim', 'Hammer', 'Flippers'])));
	}

	public function testPyramidRequiresTitansMittIfHasFlippersAndNotAG1OrHammer() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['DefeatAgahnim', 'Hammer', 'TitansMitt'])));
	}

	public function testPyramidDoesNotRequireAG1IfHasFlippers() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['DefeatAgahnim', 'Hammer'])));
	}

	public function testPyramidDoesNotRequireAG1IfHasHammer() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['DefeatAgahnim', 'Flippers'])));
	}

	public function testPyramidDoesNotRequireFlippersIfHasHammer() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Flippers', 'DefeatAgahnim'])));
	}

	public function testPyramidDoesNotRequireFlippersIfHasCape() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Flippers', 'Hammer', 'UpgradedSword'])));
	}

	public function testPyramidDoesNotRequireFlippersIfHasUpgradedSword() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Flippers', 'Hammer', 'Cape'])));
	}

	public function testPyramidDoesNotRequireHammerIfHasFlippers() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Hammer', 'DefeatAgahnim'])));
	}

	public function testPyramidDoesNotRequireHammerIfHasCape() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Hammer', 'Flippers', 'UpgradedSword'])));
	}

	public function testPyramidDoesNotRequireHammerIfHasUpgradedSword() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Hammer', 'Flippers', 'Cape'])));
	}
}
