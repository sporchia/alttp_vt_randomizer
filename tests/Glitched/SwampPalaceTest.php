<?php namespace Glitched;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class SwampPalaceTest extends TestCase {
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
		$this->assertTrue($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testMoonPearlRequiredForEntryIfMireInaccessible() {
		$this->assertFalse($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MoonPearl', 'Ether'])));
	}

	public function testMirrorRequiredForEntryIfMireInaccessible() {
		$this->assertFalse($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MagicMirror', 'Ether'])));
	}

	public function testFlippersRequiredForEntryIfMireInaccessible() {
		$this->assertFalse($this->world->getRegion('Swamp Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Flippers', 'Ether'])));
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

	public function testBigChestRequiresHammerIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->canAccess($this->allItemsExcept(['Hammer', 'Ether'])));
	}

	public function testBigChestRequiresHookshotIfBigKeyInFloodedRoomChestLAndMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->canAccess($this->allItemsExcept(['Hookshot', 'Ether'])));
	}

	public function testBigChestRequiresHookshotIfBigKeyInFloodedRoomChestRAndMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->canAccess($this->allItemsExcept(['Hookshot', 'Ether'])));
	}

	public function testBigChestRequiresHookshotIfBigKeyInHiddenWaterfallDoorRoomAndMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->canAccess($this->allItemsExcept(['Hookshot', 'Ether'])));
	}

	public function testBigChestRequiresHookshotIfBigKeyAtArrghus() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Arrghus")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testSouthOfHookshotRoomRequiresHammerIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - south of hookshot room")
			->canAccess($this->allItemsExcept(['Hammer', 'Ether'])));
	}

	public function testBigKeyRoomRequiresHammerIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big key room")
			->canAccess($this->allItemsExcept(['Hammer', 'Ether'])));
	}

	public function testPush4BlocksRoomRequiresHammerIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - push 4 blocks room")
			->canAccess($this->allItemsExcept(['Hammer', 'Ether'])));
	}

	public function testFloddedRoomChestLRequiresHammerIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Ether'])));
	}

	public function testFloddedRoomChestLRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testFloddedRoomChestRRequiresHammerIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Ether'])));
	}

	public function testFloddedRoomChestRRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testHiddenWaterfallDoorRoomRequiresHammerIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room")
			->canAccess($this->allItemsExcept(['Hammer', 'Ether'])));
	}

	public function testHiddenWaterfallDoorRoomRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-D2-B2] Swamp Palace - hidden waterfall door room")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testArrghusRequiresHammerIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("Heart Container - Arrghus")
			->canAccess($this->allItemsExcept(['Hammer', 'Ether'])));
	}

	public function testArrghusRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("Heart Container - Arrghus")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	// Key filling
	public function testFirstRoomCanBeKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testFirstRoomCanBeNotKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")
			->fill(Item::get('Arrow'), $this->allItems()));
	}

	// found issues
	public function testHookshotCantBeInBigChestWithBigKeyInLateDungeonIfMireInaccessible() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->fill(Item::get('Hookshot'), $this->allItemsExcept(['Hookshot', 'Ether'])));
	}

	public function testHookshotCanBeInBigChest() {
		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B1] Swamp Palace - south of hookshot room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")
			->fill(Item::get('Hookshot'), $this->allItemsExcept(['Hookshot'])));
	}
}
