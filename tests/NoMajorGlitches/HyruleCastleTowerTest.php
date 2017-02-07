<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class HyruleCastleTowerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCapeOrUpgradedSwordRequiredToEnter() {
		$this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
			->canEnter($this->world->getLocations(), $this->allItemsExcept(['Cape', 'UpgradedSword'])));
	}

	// Completion
	public function testSwordRequiredToComplete() {
		$this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
			->canComplete($this->world->getLocations(), $this->allItemsExcept(['AnySword'])));
	}
}
