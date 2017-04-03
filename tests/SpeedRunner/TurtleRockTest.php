<?php namespace SpeedRunner;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class TurtleRockTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');

		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
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

	public function testEtherRequiredIfEtherIsEntryMedallion() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Ether'));

		$this->assertFalse($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Ether'])));
	}

	public function testBombosRequiredIfBombosIsEntryMedallion() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Bombos'));

		$this->assertFalse($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Bombos'])));
	}

	public function testQuakeRequiredIfQuakeIsEntryMedallion() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Quake'])));
	}

	public function testCaneRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testHammerRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Hammer'])));
	}

	public function testMoonPearlRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MoonPearl'])));
	}

	public function testMittRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['TitansMitt'])));
	}

	public function testMirrorOrHookshotRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testNotOnlyMirrorRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MagicMirror'])));
	}

	public function testNotOnlyHookshotRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Hookshot'])));
	}

	// Item Locations
	public function testChainChompRoomRequiresFireRodIfKeyNotAtCompassRoom() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testCompassRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl', 'Hammer', 'Quake', 'CaneOfSomaria', 'Hookshot', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")
			->canAccess($this->collected));
	}

	public function testMapRoomChestRRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMapRoomChestLRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestRequiresFireRodIfKeysNotInCompassAndChainChompRooms() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestRequiresFireRodIfKeyNotInChainChompRoom() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestRequiresFireRodIfKeyNotInCompassRoom() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestDoesNotRequireFireRodIfKeysInCompassAndChainChompRooms() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestRequiresFireRodIfBigKeyInMapRoomChestR() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestRequiresFireRodIfBigKeyInMapRoomChestL() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigKeyRoomRequiresFireRodIfKeysNotInCompassAndChainChompRooms() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big key room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigKeyRoomRequiresFireRodIfKeyNotInChainChompRoom() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big key room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigKeyRoomRequiresFireRodIfKeyNotInCompassRoom() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big key room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigKeyRoomDoesNotRequireFireRodIfKeysInCompassAndChainChompRooms() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big key room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testRollerSwitchRoomRequiresFireRodIfBigKeyInMapRoomChestR() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - Roller switch room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testRollerSwitchRoomRequiresFireRodIfBigKeyInMapRoomChestL() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - Roller switch room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestTRRequiresFireRodIfTwoKeysInMapRoom() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestTRDoesNotRequiresFireRodIfKeysInCompassAndChainChompRooms() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestTRRequiresFireRodIfBigKeyInMapRoomChestR() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testREyeBridgeRoomRChestTRequiresFireRodIfBigKeyInMapRoomChestL() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestTLRequiresFireRodIfTwoKeysInMapRoom() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestTLDoesNotRequiresFireRodIfKeysInCompassAndChainChompRooms() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestTLRequiresFireRodIfBigKeyInMapRoomChestR() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testREyeBridgeRoomRChestTLequiresFireRodIfBigKeyInMapRoomChestL() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestBRRequiresFireRodIfTwoKeysInMapRoom() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestBRDoesNotRequiresFireRodIfKeysInCompassAndChainChompRooms() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestBRRequiresFireRodIfBigKeyInMapRoomChestR() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testREyeBridgeRoomRChestBRequiresFireRodIfBigKeyInMapRoomChestL() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestBLRequiresFireRodIfTwoKeysInMapRoom() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestBLDoesNotRequiresFireRodIfKeysInCompassAndChainChompRooms() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testEyeBridgehRoomChestBLRequiresFireRodIfBigKeyInMapRoomChestR() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testREyeBridgeRoomRChestBLequiresFireRodIfBigKeyInMapRoomChestL() {
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Map room [left chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testTrinexxRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testTrinexxRequiresIceRod() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")
			->canAccess($this->allItemsExcept(['IceRod'])));
	}

	// Key filling
	public function testCantHaveBigKeyPastBigKeyDoorRollerSwitch() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - Roller switch room")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorBridge1() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorBridge2() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorBridge3() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCantHaveBigKeyPastBigKeyDoorBridge4() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testTrinexCantHaveKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testTrinexCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

}
