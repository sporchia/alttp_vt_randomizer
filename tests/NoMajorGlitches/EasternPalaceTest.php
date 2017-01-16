<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class EasternPalaceTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

    public function tearDown() {
        parent::tearDown();
        unset($this->world);
    }

	public function testNoBigKeyInBigChest() {
		$this->assertFalse($this->world->getLocation("[dungeon-L1-1F] Eastern Palace - big chest")->fill(Item::get('BigKey'), $this->allItems()));
	}
}
