<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class IcePalaceTest extends TestCase {
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
		$this->assertTrue($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testMoonPearlRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['MoonPearl'])));
	}

	public function testFlippersRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Flippers'])));
	}

	public function testMittRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['TitansMitt'])));
	}

	public function testMeltingRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['FireRod', 'Bombos'])));
	}

	public function testNotOnlyFireRodRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['FireRod'])));
	}

	public function testNotOnlyBombosRequiredForEntry() {
		$this->assertTrue($this->world->getRegion('Ice Palace')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Bombos'])));
	}

	// Item Locations
	public function testCompassRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl', 'Hammer', 'FireRod', 'Flippers']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B1] Ice Palace - compass room")
			->canAccess($this->collected));
	}

	public function testB5UpStaircaseRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl', 'Hammer', 'FireRod', 'Flippers']);

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B5] Ice Palace - b5 up staircase")
			->canAccess($this->collected));
	}

	public function testSpikeRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl', 'Hookshot', 'FireRod', 'Flippers']);

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

	public function testKholdstareCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Kholdstare")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D5-B5] Ice Palace - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

}
