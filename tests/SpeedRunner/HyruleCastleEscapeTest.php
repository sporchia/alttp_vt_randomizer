<?php namespace SpeedRunner;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class HyruleCastleEscapeTest extends TestCase {
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
		$this->assertTrue($this->world->getRegion('Escape')
			->canEnter($this->world->getLocations(), $this->collected));
	}

	// Item locations
	public function testSancturaryRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-C-1F] Sanctuary")
			->canAccess($this->collected));
	}

	public function testBoomerangRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-C-B1] Hyrule Castle - boomerang room")
			->canAccess($this->collected));
	}

	public function testMapRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-C-B1] Hyrule Castle - map room")
			->canAccess($this->collected));
	}

	public function testZeldaRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-C-B3] Hyrule Castle - next to Zelda")
			->canAccess($this->collected));
	}

	public function testSewersFinalRoomChestLRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-C-B1] Escape - final basement room [left chest]")
			->canAccess($this->collected));
	}

	public function testSewersFinalRoomChestMRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-C-B1] Escape - final basement room [middle chest]")
			->canAccess($this->collected));
	}

	public function testSewersFinalRoomChestRRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-C-B1] Escape - final basement room [right chest]")
			->canAccess($this->collected));
	}

	// Key filling
	public function testSancturaryCannotBeKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-C-1F] Sanctuary")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testSewersFinalRoomChestLCannotBeKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-C-B1] Escape - final basement room [left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testSewersFinalRoomChestMCannotBeKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-C-B1] Escape - final basement room [middle chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testSewersFinalRoomChestRCannotBeKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-C-B1] Escape - final basement room [right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}
}
