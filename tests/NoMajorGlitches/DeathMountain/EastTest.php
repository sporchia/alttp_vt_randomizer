<?php namespace NoMajorGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class EastTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testMimicCaveRequiresMagicMirror() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['MagicMirror'])));
	}

	public function testMimicCaveRequiresFireRodIfKeysNotInTurtleRockCompassAndChainChompRooms() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveRequiresFireRodIfKeyNotInTurtleRockChainChompRoom() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveRequiresFireRodIfKeyNotInTurtleRockCompassRoom() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveDoesNotRequireFireRodIfKeysInTurtleRockCompassAndChainChompRooms() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}
}
