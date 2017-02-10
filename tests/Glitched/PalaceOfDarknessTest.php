<?php namespace Glitched;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class PalaceOfDarknessTest extends TestCase {
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
		$this->assertTrue($this->world->getRegion('Palace of Darkness')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testCanEnterWithNothing() {
		$this->assertTrue($this->world->getRegion('Palace of Darkness')
			->canEnter($this->world->getLocations(), $this->collected));
	}

	// Item Locations
	public function testShooterRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")
			->canAccess($this->collected));
	}

	public function testStatuePushRoomRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")
			->canAccess($this->allItemsExcept(['AnyBow'])));
	}

	public function testJumpRoomChestRRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")
			->canAccess($this->allItemsExcept(['AnyBow'])));
	}

	public function testJumpRoomChestLRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")
			->canAccess($this->collected));
	}

	public function testRoomLeadingToHelmasaurChestLRequresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]")
			->canAccess($this->collected));
	}

	public function testRoomLeadingToHelmasaurChestRRequresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]")
			->canAccess($this->collected));
	}

	public function testDarkMazeChestTRequresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - maze room [top chest]")
			->canAccess($this->collected));
	}

	public function testDarkMazeChestBRequresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - maze room [bottom chest]")
			->canAccess($this->collected));
	}

	public function testBigChestRequresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big chest")
			->canAccess($this->collected));
	}

	public function testCompassRoomRequresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - compass room")
			->canAccess($this->collected));
	}

	public function testSpikeStatueRoomRequresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - spike statue room")
			->canAccess($this->collected));
	}

	public function testHelmasaurRequiresHammer() {
		$this->assertFalse($this->world->getLocation("Heart Container - Helmasaur King")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testHelmasaurRequiresBow() {
		$this->assertFalse($this->world->getLocation("Heart Container - Helmasaur King")
			->canAccess($this->allItemsExcept(['AnyBow'])));
	}

	public function testTurtleStalfosRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")
			->canAccess($this->collected));
	}

	// Key filling
	public function testBigKeyCantBeInBigChest() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigKeyCantBeAtHelmasaur() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("Heart Container - Helmasaur King")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testKeyCanBeAtHelmasaur() {
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - spike statue room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("Heart Container - Helmasaur King")
			->fill(Item::get('Key'), $this->allItems()));
	}
}
