<?php namespace Glitched;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class MiseryMireTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'Glitched');

		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether'));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Misery Mire')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testEtherRequiredIfEtherIsEntryMedallion() {
		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether'));

		$this->assertFalse($this->world->getRegion('Misery Mire')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Ether'])));
	}

	public function testBombosRequiredIfBombosIsEntryMedallion() {
		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Bombos'));

		$this->assertFalse($this->world->getRegion('Misery Mire')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Bombos'])));
	}

	public function testQuakeRequiredIfQuakeIsEntryMedallion() {
		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getRegion('Misery Mire')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Quake'])));
	}

	public function testMoonPearlRequiredForEntryIfNoBottle() {
		$this->assertFalse($this->world->getRegion('Misery Mire')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testBootsOrHookshotRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Misery Mire')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['PegasusBoots', 'Hookshot'])));
	}

	public function testNotOnlyBootsRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Misery Mire')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNotOnlyHookshotRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Misery Mire')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Hookshot'])));
	}

	// Item Locations
	public function testBigChestRequiresFireIfBigKeyInBigKeyRoom() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big key")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testBigChestRequiresFireIfBigKeyInCompassRoom() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testBigChestDoesNotRequireFireIfBigKeyInBigHubRoom() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - end of bridge")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - spike room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - map room")->setItem(Item::get('Key'));

		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big hub room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testBigHubRoomOnlyRequiresEntry() {
		$this->addCollected(['Ether', 'OcarinaInactive', 'TitansMitt', 'Hookshot', 'MoonPearl', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big hub room")
			->canAccess($this->collected));
	}

	public function testEndOfBridgeOnlyRequiresEntry() {
		$this->addCollected(['Ether', 'OcarinaInactive', 'TitansMitt', 'Hookshot', 'MoonPearl', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - end of bridge")
			->canAccess($this->collected));
	}

	public function testMapRoomOnlyRequiresEntry() {
		$this->addCollected(['Ether', 'OcarinaInactive', 'TitansMitt', 'Hookshot', 'MoonPearl', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - map room")
			->canAccess($this->collected));
	}

	public function testSpikeRoomOnlyRequiresEntry() {
		$this->addCollected(['Ether', 'OcarinaInactive', 'TitansMitt', 'Hookshot', 'MoonPearl', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - spike room")
			->canAccess($this->collected));
	}

	public function testBigKeyRoomRequiresFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big key")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testCompassRoomRequiresFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testVitreousCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Vitreous")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testVitreousRequiresCane() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big key")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Vitreous")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	// Key filling
	public function testItemCanBeInBigChestIfBigKeyInCompassRoomAndKeyInBigKeyRoom() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big key")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - end of bridge")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - spike room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->fill(Item::get('Arrow'), $this->allItems()));
	}

	public function testItemCanBeInBigChestIfKeyInCompassRoomAndBigKeyInBigKeyRoom() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big key")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - end of bridge")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - spike room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->fill(Item::get('Arrow'), $this->allItems()));
	}

	public function testBigKeyCanBeInCompassRoom() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big hub room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - end of bridge")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigKeyCanBeInBigKeyRoom() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big hub room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - end of bridge")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big key")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	// Soft Locks
	public function testCompassRoomCantHaveLampIfFirerodUnobtainableWithoutIt() {
		$no_lighting = $this->allItemsExcept(['Lamp', 'FireRod']);

		$this->world->getLocation("Heart Container - Moldorm")->setItem(Item::get('FireRod'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('Lamp'), $no_lighting));
	}
}
