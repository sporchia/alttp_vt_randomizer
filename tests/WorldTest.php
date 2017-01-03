<?php

use ALttP\World;

class WorldTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function testSetRules() {
		$this->world->setRules('testing_rules');

		$this->assertEquals('testing_rules', $this->world->getRules());
	}

	public function testGetRegionDoesntExist() {
		$this->assertNull($this->world->getRegion("This Region Doesn't Exist"));
	}
}
