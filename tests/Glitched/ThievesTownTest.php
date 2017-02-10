<?php namespace Glitched;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class ThievesTownTest extends TestCase {
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
		$this->assertTrue($this->world->getRegion('Thieves Town')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testMoonPearlOrBottleRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Thieves Town')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	// Item Locations
	public function testBLHugeRoomChestBROnlyRequiresEntry() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testBLHugeRoomChestTLOnlyRequiresEntry() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testBRHugeRoomOnlyRequiresEntry() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Bottom right of huge room")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testTLHugeRoomOnlyRequiresEntry() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Top left of huge room")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testAboveBlindOnlyRequiresEntry() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-1F] Thieves' Town - Room above boss")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testBigChestRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - big chest")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNextToBlindOnlyRequiresEntry() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - next to Blind")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testBlindOnlyRequiresEntry() {
		$this->assertFalse($this->world->getLocation("Heart Container - Blind")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	// Key filling
	public function testAboveBlindCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-1F] Thieves' Town - Room above boss")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testNextToBlindCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - next to Blind")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBlindCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Blind")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}
}
