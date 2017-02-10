<?php namespace SpeedRunner;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class TowerOfHeraTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Tower of Hera')->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testHookshotAndHammerOrMirrorRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Tower of Hera')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Hookshot', 'Hammer', 'MagicMirror'])));
	}

	public function testNotOnlyMirrorRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Tower of Hera')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MagicMirror'])));
	}

	public function testNotOnlyHookshotAndHammerRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Tower of Hera')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Hookshot', 'Hammer'])));
	}

	public function testHookshotRequiresHammerWithoutMirrorRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Tower of Hera')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MagicMirror', 'Hammer'])));
	}

	public function testHammerRequiresHookshotWithoutMirrorRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Tower of Hera')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testLiftingRocksOrFluteRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Tower of Hera')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['PowerGlove', 'TitansMitt', 'OcarinaActive', 'OcarinaInactive'])));
	}

	public function testNotOnlyLiftingRocksRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Tower of Hera')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['PowerGlove', 'TitansMitt'])));
	}

	public function testNotOnlyFluteRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Tower of Hera')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['OcarinaActive', 'OcarinaInactive'])));
	}

	// Item Locations
	public function testFreestandingKeyOnlyRequiresEntry() {
		$this->addCollected(['PowerGlove', 'MagicMirror']);

		$this->assertTrue($this->world->getLocation("[dungeon-L3-1F] Tower of Hera - freestanding key")
			->canAccess($this->collected));
	}

	public function testEntranceOnlyRequiresEntry() {
		$this->addCollected(['Hookshot', 'Hammer', 'OcarinaInactive']);

		$this->assertTrue($this->world->getLocation("[dungeon-L3-2F] Tower of Hera - Entrance")
			->canAccess($this->collected));
	}

	public function testFisrtFloorChestRequiresFire() {
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - freestanding key")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")
			->canAccess($this->allItemsExcept(['Lamp', 'FireRod'])));
	}

	public function testFisrtFloorChestRequiresAccessToKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")
			->canAccess($this->allItems()));
	}

	public function testFisrtFloorChestRequiresAccessToBigKeyIfKeyIsUpstairs() {
		$this->world->getLocation("[dungeon-L3-4F] Tower of Hera - 4F [small chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")
			->canAccess($this->allItems()));
	}

	public function test4FRequiresFireIfFirstFloorChestHasBigKey() {
		$this->world->getLocation("[dungeon-L3-2F] Tower of Hera - Entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-L3-4F] Tower of Hera - 4F [small chest]")
			->canAccess($this->allItemsExcept(['Lamp', 'FireRod'])));
	}

	public function test4FDoesntRequireFireIfEntranceHasBigKey() {
		$this->world->getLocation("[dungeon-L3-2F] Tower of Hera - Entrance")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-L3-4F] Tower of Hera - 4F [small chest]")
			->canAccess($this->allItemsExcept(['Lamp', 'FireRod'])));
	}

	public function testBigChestRequiresFireIfFirstFloorChestHasBigKey() {
		$this->world->getLocation("[dungeon-L3-2F] Tower of Hera - Entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-L3-4F] Tower of Hera - big chest")
			->canAccess($this->allItemsExcept(['Lamp', 'FireRod'])));
	}

	public function testBigChestDoesntRequireFireIfEntranceHasBigKey() {
		$this->world->getLocation("[dungeon-L3-2F] Tower of Hera - Entrance")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-L3-4F] Tower of Hera - big chest")
			->canAccess($this->allItemsExcept(['Lamp', 'FireRod'])));
	}

	public function testMoldormRequiresFireIfFirstFloorChestHasBigKey() {
		$this->world->getLocation("[dungeon-L3-2F] Tower of Hera - Entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Moldorm")
			->canAccess($this->allItemsExcept(['Lamp', 'FireRod'])));
	}

	public function testMoldormDoesntRequireFireIfEntranceHasBigKey() {
		$this->world->getLocation("[dungeon-L3-2F] Tower of Hera - Entrance")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("Heart Container - Moldorm")
			->canAccess($this->allItemsExcept(['Lamp', 'FireRod'])));
	}

	// Key filling
	public function testFirstFloorChestCannotBeKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testFirstFloorChestCannotBeBigKeyIfMoldormHasKey() {
		$this->world->getLocation("Heart Container - Moldorm")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testFirstFloorChestCannotBeBigKeyIfBigChestHasKey() {
		$this->world->getLocation("[dungeon-L3-4F] Tower of Hera - big chest")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testFirstFloorChestCannotBeBigKeyIf4FHasKey() {
		$this->world->getLocation("[dungeon-L3-4F] Tower of Hera - 4F [small chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-L3-4F] Tower of Hera - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function test4FCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-L3-4F] Tower of Hera - 4F [small chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testMoldormCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Moldorm")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	// found issues
	public function testMoldormCantHaveFireRodIfLampUnobtainableWithoutIt() {
		$no_lighting = $this->allItemsExcept(['Lamp', 'FireRod']);

		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->setItem(Item::get('Lamp'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Moldorm")->fill(Item::get('FireRod'), $no_lighting));
	}
}
