<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class MiseryMireTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');

		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether'));
	}

	public function testCompassRoomCantHaveLampIfFirerodUnobtainableWithoutIt() {
		$no_lighting = $this->allItemsExcept(['Lamp', 'FireRod']);


		$this->world->getLocation("Heart Container - Moldorm")->setItem(Item::get('FireRod'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('Lamp'), $no_lighting));
	}

	public function testBigKeyCantBeInCompassRoomIfKeyInBigChest() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->setItem(Item::get('Key'));
		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testKeyCantBeInBigChestIfBigKeyInCompassRoom() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->setItem(Item::get('BigKey'));
		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigKeyCanBeInCompassRoom() {
		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testNoBigKeyInBigChest() {
		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->fill(Item::get('BigKey'), $this->allItems()));
	}
}
