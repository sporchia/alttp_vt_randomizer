<?php

use ALttP\Item;
use ALttP\World;

class WorldTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->world = World::factory('standard', 'test_rules', 'NoGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testGetRegionDoesntExist() {
		$this->assertNull($this->world->getRegion("This Region Doesn't Exist"));
	}

	public function testSetVanillaFillsAllLocations() {
		$this->world->setVanilla();

		$this->assertEquals(0, $this->world->getEmptyLocations()->count());
	}

	public function testGetPlaythroughNormalGame() {
		$this->world->setVanilla();
		$this->assertArraySubset(['longest_item_chain' => 34, 'regions_visited' => 50], $this->world->getPlaythrough());
	}
}
