<?php namespace SpeedRunner;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class DarkWorldTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testSuperBunnyDMAllowedTopChest() {
		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testSuperBunnyDMAllowedBottomChest() {
		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testGlovesRequiredToEnterBumperCave() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->allItemsExcept(['Gloves'])));
	}

	public function testCanAccessPyramidFairyWithMirrorAndAG1() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'MagicMirror', 'Cape', 'TitansMitt', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid")->canAccess($this->collected));
	}

	public function testCanAccessPyramidFairyWithHammer() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'PowerGlove', 'Hammer', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid")->canAccess($this->collected));
	}
}
