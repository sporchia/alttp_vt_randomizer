<?php

use ALttP\Item;
use ALttP\World;

class WorldTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->world = new World('test_rules', 'NoMajorGlitches');
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
		$this->assertArraySubset(['longest_item_chain' => 31, 'regions_visited' => 44], $this->world->getPlaythrough());
	}
}
