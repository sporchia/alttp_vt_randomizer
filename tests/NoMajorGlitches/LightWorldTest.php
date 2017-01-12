<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class LightWorldTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function testLinksHouseCannotHavePowerGloves() {
		$this->assertFalse($this->world->getLocation("[cave-040] Link's House")->fill(Item::get('PowerGlove'), $this->allItems()));
	}

	public function testLinksHouseCannotHaveTitanMitts() {
		$this->assertFalse($this->world->getLocation("[cave-040] Link's House")->fill(Item::get('TitansMitt'), $this->allItems()));
	}

	// Shields seems to all downgrade on S&Q to Fighters Shield, lets just avoid that
	public function testLinksHouseCannotHaveRedShield() {
		$this->assertFalse($this->world->getLocation("[cave-040] Link's House")->fill(Item::get('RedShield'), $this->allItems()));
	}

	public function testLinksHouseCannotHaveMirrorShield() {
		$this->assertFalse($this->world->getLocation("[cave-040] Link's House")->fill(Item::get('MirrorShield'), $this->allItems()));
	}
}
