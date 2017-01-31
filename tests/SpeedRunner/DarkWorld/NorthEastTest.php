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

	public function testCatfishRequiresCapeOrUpgradedSwordOrHammerOrFlippers() {
		$this->assertFalse($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Cape', 'UpgradedSword', 'Hammer', 'Flippers'])));
	}

	public function testCatfishRequiresTitansMittIfHasFlippersAndNotCapeOrUpgradedSwordOrHammer() {
		$this->assertFalse($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Cape', 'UpgradedSword', 'Hammer', 'TitansMitt'])));
	}

	public function testCatfishDoesNotRequireCapeOrUpgradedSwordIfHasFlippers() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Cape', 'UpgradedSword', 'Hammer'])));
	}

	public function testCatfishDoesNotRequireCapeOrUpgradedSwordIfHasHammer() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Cape', 'UpgradedSword', 'Flippers'])));
	}

	public function testCatfishDoesNotRequireFlippersIfHasHammer() {
		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['Flippers', 'Cape', 'UpgradedSword'])));
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
			->canAccess($this->allItemsExcept(['Hammer', 'Cape', 'UpgradedSword'])));
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

	public function testPyramidRequiresCapeOrUpgradedSwordOrHammerOrFlippers() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Cape', 'UpgradedSword', 'Hammer', 'Flippers'])));
	}

	public function testPyramidRequiresTitansMittIfHasFlippersAndNotCapeOrUpgradedSwordOrHammer() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Cape', 'UpgradedSword', 'Hammer', 'TitansMitt'])));
	}

	public function testPyramidDoesNotRequireCapeOrUpgradedSwordIfHasFlippers() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Cape', 'UpgradedSword', 'Hammer'])));
	}

	public function testPyramidDoesNotRequireCapeOrUpgradedSwordIfHasHammer() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Cape', 'UpgradedSword', 'Flippers'])));
	}

	public function testPyramidDoesNotRequireFlippersIfHasHammer() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['Flippers', 'Cape', 'UpgradedSword'])));
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
			->canAccess($this->allItemsExcept(['Hammer', 'Cape', 'UpgradedSword'])));
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
