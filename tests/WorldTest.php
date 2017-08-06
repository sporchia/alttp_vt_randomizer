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
		//dd($this->world->getPlaythrough());
		$this->assertArraySubset(['longest_item_chain' => 29, 'regions_visited' => 45], $this->world->getPlaythrough());
	}
}
