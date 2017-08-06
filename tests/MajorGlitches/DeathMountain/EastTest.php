<?php namespace MajorGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class EastTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testSpiralCaveRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-012-1F] Death Mountain - wall of caves - left cave")
			->canAccess($this->collected));
	}

	public function testMimicCaveRequresHammer() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testMimicCaveRequiresMagicMirror() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['MagicMirror'])));
	}

	public function testRightCaveTopChest1RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]")
			->canAccess($this->collected));
	}

	public function testRightCaveTopChest2RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]")
			->canAccess($this->collected));
	}

	public function testRightCaveTopChest3RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]")
			->canAccess($this->collected));
	}

	public function testRightCaveTopChest4RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]")
			->canAccess($this->collected));
	}

	public function testRightCaveTopChest5RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]")
			->canAccess($this->collected));
	}

	public function testRightCaveBottomChest1RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]")
			->canAccess($this->collected));
	}

	public function testRightCaveBottomChest2RequiresNothing() {
		$this->assertTrue($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]")
			->canAccess($this->collected));
	}

	public function testFloatingIslandRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Piece of Heart (Death Mountain - floating island)")
			->canAccess($this->collected));
	}
}
