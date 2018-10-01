<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class HyruleCastleTowerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = World::factory('standard', 'test_rules', 'MajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry

	// Completion
	public function testSwordRequiredToComplete() {
		$this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
			->canComplete($this->world->getLocations(), $this->allItemsExcept(['AnySword'])));
	}
}
