<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class TurtleRockTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');

		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testCantHaveBigKeyPastBigKeyDoorRollerSwitch() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - Roller switch room")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorBridge1() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorBridge2() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorBridge3() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorBridge4() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorTrinexx() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveLampPastDarkRoomBridge1() {
		$no_lamp = $this->allItemsExcept(['Lamp']);

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")->fill(Item::get('Lamp'), $no_lamp));
	}

	public function testCantHaveLampPastDarkRoomBridge2() {
		$no_lamp = $this->allItemsExcept(['Lamp']);

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")->fill(Item::get('Lamp'), $no_lamp));
	}

	public function testCantHaveLampPastDarkRoomBridge3() {
		$no_lamp = $this->allItemsExcept(['Lamp']);

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")->fill(Item::get('Lamp'), $no_lamp));
	}

	public function testCantHaveLampPastDarkRoomBridge4() {
		$no_lamp = $this->allItemsExcept(['Lamp']);

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")->fill(Item::get('Lamp'), $no_lamp));
	}

	public function testCantHaveLampPastDarkRoomTrinexx() {
		$no_lamp = $this->allItemsExcept(['Lamp']);

		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")->fill(Item::get('Lamp'), $no_lamp));
	}

	public function testTrinexCantHaveKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")->fill(Item::get('Key'), $this->allItems()));
	}

	public function testTrinexCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")->fill(Item::get('BigKey'), $this->allItems()));
	}
}
