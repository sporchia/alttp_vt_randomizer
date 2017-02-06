<?php namespace SpeedRunner;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class DeathMountainTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testEtherTabletRequiresLiftingOrFlying() {
		$this->assertFalse($this->world->getLocation("Ether Tablet")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testEtherTabletRequiresUpgradedSword() {
		$this->assertFalse($this->world->getLocation("Ether Tablet")
			->canAccess($this->allItemsExcept(['UpgradedSword'])));
	}

	public function testEtherTabletRequiresBook() {
		$this->assertFalse($this->world->getLocation("Ether Tablet")
			->canAccess($this->allItemsExcept(['BookOfMudora'])));
	}

	public function testEtherRequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("Ether Tablet")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testEtherRequresMirrorIfNoHammer() {
		$this->assertFalse($this->world->getLocation("Ether Tablet")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer'])));
	}

	public function testOldMountainManRequiresLiftingOrFlying() {
		$this->assertFalse($this->world->getLocation("Old Mountain Man")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testSpectacleRockCaveRequiresLiftingOrFlying() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Spectacle Rock Cave)")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testSpectacleRockRequiresLiftingOrFlying() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Spectacle Rock)")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testSpectacleRockRequiresMirror() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Spectacle Rock)")
			->canAccess($this->allItemsExcept(['MagicMirror'])));
	}

}
