<?php namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class SkullWoodsTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'OverworldGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Skull Woods')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	// Item Locations
	public function testBigChestRequiresFireRodIfBigKeyInEntrancePart2() {
		$this->world->getLocation("[dungeon-D3-B1] Skull Woods - Entrance to part 2")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestRequiresFireRodIfBigKeyAtMothula() {
		$this->world->getLocation("Heart Container - Mothula")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigKeyRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - Big Key room")
			->canAccess($this->collected));
	}

	public function testCompassRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - Compass room")
			->canAccess($this->collected));
	}

	public function testEastOfFireRodRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - east of Fire Rod room")
			->canAccess($this->collected));
	}

	public function testGibdoStalfosRoomOnlyRequiresEntry() {
		$this->addCollected(['TitansMitt', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room")
			->canAccess($this->collected));
	}

	public function testSouthOfFireRodMustBeKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - south of Fire Rod room")
			->canFill(Item::get('Key'), $this->allItems()));
	}

	public function testEntranceToPart2RequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-D3-B1] Skull Woods - Entrance to part 2")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMothulaRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("Heart Container - Mothula")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMothulaRequiresASword() {
		$this->assertFalse($this->world->getLocation("Heart Container - Mothula")
			->canAccess($this->allItemsExcept(['AnySword'])));
	}

	// Key filling
	public function testMothulaCantHaveKey() {
		$this->assertFalse($this->world->getLocation("Heart Container - Mothula")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testMothulaCanHaveBigKey() {
		$this->assertTrue($this->world->getLocation("Heart Container - Mothula")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testMothulaCantHaveBigKeyIfBigChestHasKey() {
		$this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("Heart Container - Mothula")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testSouthOfFireRodCantNotBeKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D3-B1] Skull Woods - south of Fire Rod room")
			->canFill(Item::get('Arrow'), $this->allItems()));
	}

	public function testBigChestCanBeKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigChestCannotBeKeyIfMothulaHasBigKey() {
		$this->world->getLocation("Heart Container - Mothula")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}
}
