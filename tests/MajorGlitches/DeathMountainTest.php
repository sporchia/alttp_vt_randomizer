<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class DeathMountainTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testEtherTabletRequiresUpgradedSword() {
		$this->assertFalse($this->world->getLocation("Ether Tablet")
			->canAccess($this->allItemsExcept(['UpgradedSword'])));
	}

	public function testEtherTabletRequiresBook() {
		$this->assertFalse($this->world->getLocation("Ether Tablet")
			->canAccess($this->allItemsExcept(['BookOfMudora'])));
	}

	public function testSpectacleRockCaveRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Spectacle Rock Cave)")
			->canAccess($this->collected));
	}

	public function testSpectacleRockRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Spectacle Rock)")
			->canAccess($this->collected));
	}

}
