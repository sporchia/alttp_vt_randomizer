<?php namespace Glitched\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class NorthEastTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'Glitched');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Item Locations
	public function testCatfishRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("Catfish")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testCatfishRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->collected));
	}

	public function testCatfishRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("Catfish")
			->canAccess($this->collected));
	}

	public function testPyramidRequiresMoonPearlOrBottleOrSword() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl', 'AnySword'])));
	}

	public function testPyramidRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->collected));
	}

	public function testPyramidRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Pyramid)")
			->canAccess($this->collected));
	}
}
