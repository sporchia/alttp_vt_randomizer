<?php namespace Glitched;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class TurtleRockTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'Glitched');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	// Item Locations


	// Key filling
	public function testCanHaveBigKeyPastBigKeyDoorRollerSwitch() {
		$this->assertTrue($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - Roller switch room")
			->fill(Item::get('BigKeyD7'), $this->allItems()));
	}

	public function testCanHaveBigKeyPastBigKeyDoorBridge1() {
		$this->assertTrue($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")
			->fill(Item::get('BigKeyD7'), $this->allItems()));
	}

	public function testCanHaveBigKeyPastBigKeyDoorBridge2() {
		$this->assertTrue($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")
			->fill(Item::get('BigKeyD7'), $this->allItems()));
	}

	public function testCanHaveBigKeyPastBigKeyDoorBridge3() {
		$this->assertTrue($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")
			->fill(Item::get('BigKeyD7'), $this->allItems()));
	}

	public function testCanHaveBigKeyPastBigKeyDoorBridge4() {
		$this->assertTrue($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")
			->fill(Item::get('BigKeyD7'), $this->allItems()));
	}

	public function testTrinexCantHaveKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")
			->fill(Item::get('KeyD7'), $this->allItems()));
	}

	public function testTrinexCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")
			->fill(Item::get('BigKeyD7'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")
			->fill(Item::get('BigKeyD7'), $this->allItems()));
	}
}
