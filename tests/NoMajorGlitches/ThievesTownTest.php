<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class ThievesTownTest extends TestCase {
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
		$this->assertTrue($this->world->getRegion('Thieves Town')->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testMoonPearlRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Thieves Town')->canEnter($this->world->getLocations(), $this->allItemsExcept(['MoonPearl'])));
	}

	public function testNorthWestDarkWorldAccessRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Thieves Town')->canEnter($this->world->getLocations(), $this->allItemsExcept(['TitansMitt', 'PowerGlove', 'Hookshot'])));
	}

	// Item Locations
	public function testBLHugeRoomChestBROnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testBLHugeRoomChestTLOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]")
			->canAccess($this->collected));
	}

	public function testBRHugeRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Bottom right of huge room")
			->canAccess($this->collected));
	}

	public function testTLHugeRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Top left of huge room")
			->canAccess($this->collected));
	}

	public function testAboveBlindOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D4-1F] Thieves' Town - Room above boss")
			->canAccess($this->collected));
	}

	public function testBigChestRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - big chest")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNextToBlindOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - next to Blind")
			->canAccess($this->collected));
	}

	public function testBlindOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("Heart Container - Blind")
			->canAccess($this->collected));
	}

	// Key filling
	public function testAboveBlindCantHaveKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-1F] Thieves' Town - Room above boss")->fill(Item::get('Key'), $this->allItems()));
	}

	public function testAboveBlindCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-1F] Thieves' Town - Room above boss")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testNextToBlindCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - next to Blind")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBlindCantHaveKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Blind")->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBlindCantHaveBigKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Blind")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigChestCannotBeKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - big chest")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}
}
