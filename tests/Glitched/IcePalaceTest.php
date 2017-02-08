<?php namespace Glitched;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class IcePalaceTest extends TestCase {
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
		$this->assertTrue($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testMittRequiredForEntryIfNoMoonPearlOrBottle() {
		$this->assertFalse($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['TitansMitt', 'MoonPearl', 'AnyBottle'])));
	}

	public function testMittRequiredForEntryIfNoMirror() {
		$this->assertFalse($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['TitansMitt', 'MagicMirror'])));
	}


	// Item Locations
	public function testCompassRoomOnlyRequiresEntryWithMitt() {
		$this->addCollected(['TitansMitt']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B1] Ice Palace - compass room")
			->canAccess($this->collected));
	}

	public function testCompassRoomOnlyRequiresEntryWithMirrorAndBottle() {
		$this->addCollected(['MagicMirror', 'Bottle']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B1] Ice Palace - compass room")
			->canAccess($this->collected));
	}

	public function testCompassRoomOnlyRequiresEntryWithMirrorAndMoonPearl() {
		$this->addCollected(['MagicMirror', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B1] Ice Palace - compass room")
			->canAccess($this->collected));
	}

	public function testB5UpStaircaseRoomOnlyRequiresEntryWithMitt() {
		$this->addCollected(['TitansMitt']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B5] Ice Palace - b5 up staircase")
			->canAccess($this->collected));
	}

	public function testB5UpStaircaseRoomOnlyRequiresEntryWithMirrorAndBottle() {
		$this->addCollected(['MagicMirror', 'Bottle']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B5] Ice Palace - b5 up staircase")
			->canAccess($this->collected));
	}

	public function testB5UpStaircaseRoomOnlyRequiresEntryWithMirrorAndMoonPearl() {
		$this->addCollected(['MagicMirror', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B5] Ice Palace - b5 up staircase")
			->canAccess($this->collected));
	}

	public function testSpikeRoomOnlyRequiresEntryWithMitt() {
		$this->addCollected(['TitansMitt']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B3] Ice Palace - spike room")
			->canAccess($this->collected));
	}

	public function testSpikeRoomOnlyRequiresEntryWithMirrorAndBottle() {
		$this->addCollected(['MagicMirror', 'Bottle']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B3] Ice Palace - spike room")
			->canAccess($this->collected));
	}

	public function testSpikeRoomOnlyRequiresEntryWithMirrorAndMoonPearl() {
		$this->addCollected(['MagicMirror', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B3] Ice Palace - spike room")
			->canAccess($this->collected));
	}

	public function testAboveBlueMailRequiresMelting() {
		$this->assertFalse($this->world->getLocation("[dungeon-D5-B4] Ice Palace - above Blue Mail room")
			->canAccess($this->allItemsExcept(['FireRod', 'Bombos'])));
	}

	public function testAboveBlueMailNotOnlyRequiresFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-D5-B4] Ice Palace - above Blue Mail room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testAboveBlueMailNotOnlyRequiresBombos() {
		$this->assertTrue($this->world->getLocation("[dungeon-D5-B4] Ice Palace - above Blue Mail room")
			->canAccess($this->allItemsExcept(['Bombos'])));
	}

	public function testMapRoomRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-D5-B2] Ice Palace - map room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testMapRoomRequiresLiftingRocks() {
		$this->assertFalse($this->world->getLocation("[dungeon-D5-B2] Ice Palace - map room")
			->canAccess($this->allItemsExcept(['PowerGlove', 'TitansMitt'])));
	}

	public function testBigKeyRoomRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-D5-B1] Ice Palace - Big Key room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBigKeyRoomRequiresLiftingRocks() {
		$this->assertFalse($this->world->getLocation("[dungeon-D5-B1] Ice Palace - Big Key room")
			->canAccess($this->allItemsExcept(['PowerGlove', 'TitansMitt'])));
	}

	public function testBigChestRequiresHammerIfBigKeyAtBigKey() {
		$this->world->getLocation("[dungeon-D5-B1] Ice Palace - Big Key room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D5-B5] Ice Palace - big chest")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBigChestRequiresHammerIfBigKeyAtMap() {
		$this->world->getLocation("[dungeon-D5-B2] Ice Palace - map room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D5-B5] Ice Palace - big chest")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBigChestRequiresRockLiftingIfBigKeyAtBigKey() {
		$this->world->getLocation("[dungeon-D5-B1] Ice Palace - Big Key room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D5-B5] Ice Palace - big chest")
			->canAccess($this->allItemsExcept(['PowerGlove', 'TitansMitt'])));
	}

	public function testBigChestRequiresRockLiftingIfBigKeyAtMap() {
		$this->world->getLocation("[dungeon-D5-B2] Ice Palace - map room")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D5-B5] Ice Palace - big chest")
			->canAccess($this->allItemsExcept(['PowerGlove', 'TitansMitt'])));
	}

	public function testKholdstareRequiresMelting() {
		$this->assertFalse($this->world->getLocation("Heart Container - Kholdstare")
			->canAccess($this->allItemsExcept(['FireRod', 'Bombos'])));
	}

	public function testKholdstareNotOnlyRequiresFireRod() {
		$this->assertTrue($this->world->getLocation("Heart Container - Kholdstare")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testKholdstareNotOnlyRequiresBombos() {
		$this->assertTrue($this->world->getLocation("Heart Container - Kholdstare")
			->canAccess($this->allItemsExcept(['Bombos'])));
	}

	public function testKholdstareRequiresHammer() {
		$this->assertFalse($this->world->getLocation("Heart Container - Kholdstare")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testKholdstareRequiresLiftingRocks() {
		$this->assertFalse($this->world->getLocation("Heart Container - Kholdstare")
			->canAccess($this->allItemsExcept(['PowerGlove', 'TitansMitt'])));
	}

	// Key filling
	public function testKholdstareCanHaveKey() {
		$this->assertTrue($this->world->getLocation("Heart Container - Kholdstare")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D5-B5] Ice Palace - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

}
