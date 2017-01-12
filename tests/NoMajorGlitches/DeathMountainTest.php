<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class DeathMountainTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function testDarkWorldEastDeathMountainCanNeverHaveTitansMittTopChest() {
		$no_mitt = $this->allItemsExcept(['TitansMitt']);

		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")->fill(Item::get('TitansMitt'), $no_mitt));
	}

	public function testDarkWorldEastDeathMountainCanNeverHaveTitansMittBottomChest() {
		$no_mitt = $this->allItemsExcept(['TitansMitt']);

		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")->fill(Item::get('TitansMitt'), $no_mitt));
	}
}
