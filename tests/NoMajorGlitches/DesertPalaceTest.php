<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class DesertPalaceTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Desert Palace')->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testBookOrMittsAndMirrorAndFluteRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Desert Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['BookOfMudora', 'TitansMitt', 'MagicMirror', 'OcarinaActive', 'OcarinaInactive'])));
	}

	public function testNotOnlyBookRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Desert Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['BookOfMudora'])));
	}

	public function testNotOnlyMittsAndMirrorAndFluteRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Desert Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['TitansMitt', 'MagicMirror', 'OcarinaActive', 'OcarinaInactive'])));
	}

	public function testFluteRequiredForEntryIfNoBook() {
		$this->assertFalse($this->world->getRegion('Desert Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['BookOfMudora', 'OcarinaActive', 'OcarinaInactive'])));
	}

	public function testMittsRequiredForEntryIfNoBook() {
		$this->assertFalse($this->world->getRegion('Desert Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['BookOfMudora', 'TitansMitt'])));
	}

	public function testMirrorRequiredForEntryIfNoBook() {
		$this->assertFalse($this->world->getRegion('Desert Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['BookOfMudora', 'MagicMirror'])));
	}

	// Item locations
	public function testMapRoomOnlyRequiresEntry() {
		$this->addCollected(['BookOfMudora']);

		$this->assertTrue($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")
			->canAccess($this->collected));
	}

	public function testBigChestRequiresBootsIfBigKeyOnTorch() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigChestDoesNotRequireBootsIfBigKeyInMapRoom() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigChestDoesNotRequireBootsIfBigKeyInCompassRoomAndKeyInMapRoom() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigChestDoesNotRequireBootsIfBigKeyInBigKeyRoomAndKeyInMapRoom() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testSmallKeyRoomRequiresBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigKeyRoomRequiresBootsIfSmallKeyRoomHasKey() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigKeyRoomRequiresBootsIfSmallKeyRoomHasBigKeyAndBigChestHasKey() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomRequiresBootsIfSmallKeyRoomHasKey() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomRequiresBootsIfSmallKeyRoomHasBigKeyAndBigChestHasKey() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testLanmolasRequiresBootsIfBigKeyOnTorch() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Lanmolas")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testLanmolasDoesNotRequireBootsIfBigKeyInMapRoom() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("Heart Container - Lanmolas")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testLanmolasDoesNotRequireBootsIfBigKeyInCompassRoomAndKeyInMapRoom() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("Heart Container - Lanmolas")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testLanmolasDoesNotRequireBootsIfBigKeyInBigKeyRoomAndKeyInMapRoom() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("Heart Container - Lanmolas")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testLanmolasRequiresFire() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Lanmolas")
			->canAccess($this->allItemsExcept(['Lamp', 'FireRod'])));
	}

	public function testLanmolasRequiresLiftingIfNoMirror() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Lanmolas")
			->canAccess($this->allItemsExcept(['PowerGlove', 'TitansMitt', 'MagicMirror'])));
	}

	public function testLanmolasRequiresLiftingIfNoFlute() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Lanmolas")
			->canAccess($this->allItemsExcept(['PowerGlove', 'TitansMitt', 'OcarinaInactive', 'OcarinaActive'])));
	}

	// Key filling
	public function testBigKeyRoomCannotHaveKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigKeyCantBeRightSideTopIfTorchHasKeyAndNoBoots() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")
			->fill(Item::get('BigKey'), $this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigKeyCantBeRightSideTopIfKeyInBigChest() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testCompassRoomCannotHaveKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigKeyCantBeRightSideBottomIfTorchHasKeyAndNoBoots() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")
			->fill(Item::get('BigKey'), $this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigKeyCantBeRightSideBottomIfKeyInBigChest() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	// Completion
	public function testDoesntRequireBootsIfSmallKeyIsInMapChest() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getRegion('Desert Palace')
			->canComplete($this->world->getLocations(), $this->allItemsExcept(['PegasusBoots'])));
	}

	public function testDoesntRequireBootsIfSmallKeyIsInMapChestBigKeyInCompassRoom() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getRegion('Desert Palace')
			->canComplete($this->world->getLocations(), $this->allItemsExcept(['PegasusBoots'])));
	}

	public function testDoesntRequireBootsIfBigKeyIsInMapChestAndSmallKeyInBigChest() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getRegion('Desert Palace')
			->canComplete($this->world->getLocations(), $this->allItemsExcept(['PegasusBoots'])));
	}

	public function testDoesntRequiresBootsIfSmallKeyAtTorch() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getRegion('Desert Palace')
			->canComplete($this->world->getLocations(), $this->allItemsExcept(['PegasusBoots'])));
	}
}
