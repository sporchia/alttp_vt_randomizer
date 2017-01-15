<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class SkullWoodsTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testBigKeyInLateDungeonShouldStopFireRodInBigChest() {
		$no_firerod = $this->allItemsExcept(['FireRod']);

		$this->world->getLocation("[dungeon-D3-B1] Skull Woods - Entrance to part 2")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")->fill(Item::get('FireRod'), $no_firerod));
	}

	public function testBigKeyNotInLateDungeonShouldAllowFireRodInBigChest() {
		$no_firerod = $this->allItemsExcept(['FireRod']);

		$this->world->getLocation("[dungeon-D3-B1] Skull Woods - south of Fire Rod room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")->fill(Item::get('FireRod'), $no_firerod));
	}

	public function testBigKeyInLateDungeonShouldNotStopFireRodInChest() {
		$no_firerod = $this->allItemsExcept(['FireRod']);

		$this->world->getLocation("[dungeon-D3-B1] Skull Woods - Entrance to part 2")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - south of Fire Rod room")->fill(Item::get('FireRod'), $no_firerod));
	}
}
