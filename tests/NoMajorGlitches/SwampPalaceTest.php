<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class SwampPalaceTest extends TestCase {
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
		$this->assertTrue($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testSouthDarkWorldAccessRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['TitansMitt', 'Hammer', 'Hookshot'])));
	}

	public function testMoonPearlRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MoonPearl'])));
	}

	public function testMirrorRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MagicMirror'])));
	}

	public function testFlippersRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Flippers'])));
	}

	// Item locations
	public function testFirstRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl', 'MagicMirror', 'Flippers']);

		$this->assertTrue($this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")
			->canAccess($this->collected));
	}

	public function testMapRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl', 'MagicMirror', 'Flippers']);
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - map room")
			->canAccess($this->collected));
	}

	public function testBigChestRequiresHammer() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBigChestRequiresHookshotIfBigKeyInFloodedRoomChestL() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testBigChestRequiresHookshotIfBigKeyInFloodedRoomChestR() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testBigChestRequiresHookshotIfBigKeyInHiddenWaterfallDoorRoom() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testBigChestRequiresHookshotIfBigKeyAtArrghus() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Arrghus")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testSouthOfHookshotRoomRequiresHammer() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - south of hookshot room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBigKeyRoomRequiresHammer() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big key room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testPush4BlocksRoomRequiresHammer() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - push 4 blocks room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testFloddedRoomChestLRequiresHammer() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testFloddedRoomChestLRequiresHookshot() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testFloddedRoomChestRRequiresHammer() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testFloddedRoomChestRRequiresHookshot() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testHiddenWaterfallDoorRoomRequiresHammer() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testHiddenWaterfallDoorRoomRequiresHookshot() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testArrghusDoorRoomRequiresHammer() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("Heart Container - Arrghus")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testArrghusDoorRoomRequiresHookshot() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("Heart Container - Arrghus")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	// Key filling
	public function testFirstRoomCanBeKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testFirstRoomCantBeNotKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")
			->fill(Item::get('Arrow'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	// found issues
	public function testHookshotCantBeInBigChestWithBigKeyInLateDungeon() {
		$no_hookshot = $this->allItemsExcept(['Hookshot']);

		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")->fill(Item::get('Hookshot'), $no_hookshot));
	}

	public function testHookshotCanBeInBigChest() {
		$no_hookshot = $this->allItemsExcept(['Hookshot']);

		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B1] Swamp Palace - south of hookshot room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")->fill(Item::get('Hookshot'), $no_hookshot));
	}
}
