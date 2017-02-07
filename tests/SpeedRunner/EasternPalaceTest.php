<?php namespace SpeedRunner;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class EasternPalaceTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testNothingRequiredToEnter() {
		$this->assertTrue($this->world->getRegion('Eastern Palace')
			->canEnter($this->world->getLocations(), $this->collected));
	}

	// Item locations
	public function testCompassRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-L1-1F] Eastern Palace - compass room")
			->canAccess($this->collected));
	}

	public function testBigBallRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-L1-1F] Eastern Palace - big ball room")
			->canAccess($this->collected));
	}

	public function testBigChestRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-L1-1F] Eastern Palace - big chest")
			->canAccess($this->collected));
	}

	public function testMapRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-L1-1F] Eastern Palace - map room")
			->canAccess($this->collected));
	}

	public function testBigKeyRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-L1-1F] Eastern Palace - Big key")
			->canAccess($this->collected));
	}

	public function testArmosRequiresBow() {
		$this->assertFalse($this->world->getLocation("Heart Container - Armos Knights")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	// Key filling
	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-L1-1F] Eastern Palace - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testArmosCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Armos Knights")
			->fill(Item::get('BigKey'), $this->allItems()));
	}
}
