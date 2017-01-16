<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class TowerOfHeraTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testMoldormCantHaveFireRodIfLampUnobtainableWithoutIt() {
		$no_lighting = $this->allItemsExcept(['Lamp', 'FireRod']);

		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->setItem(Item::get('Lamp'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Moldorm")->fill(Item::get('FireRod'), $no_lighting));
	}

	public function testNoBigKeyInBigChest() {
		$this->assertFalse($this->world->getLocation("[dungeon-L3-4F] Tower of Hera - big chest")->fill(Item::get('BigKey'), $this->allItems()));
	}
}
