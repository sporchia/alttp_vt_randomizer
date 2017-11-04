<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class HyruleCastleEscapeTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testNothingRequiredToEnter() {
		$this->assertTrue($this->world->getRegion('Escape')
			->canEnter($this->world->getLocations(), $this->collected));
	}

	// Item locations
	public function testSancturaryRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Sanctuary")
			->canAccess($this->collected));
	}

	public function testBoomerangRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Hyrule Castle - Boomerang Chest")
			->canAccess($this->collected));
	}

	public function testMapRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Hyrule Castle - Map Chest")
			->canAccess($this->collected));
	}

	public function testZeldaRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Hyrule Castle - Zelda's Cell")
			->canAccess($this->collected));
	}

	public function testSewersFirstRoomRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Sewers - Dark Cross")
			->canAccess($this->collected));
	}

	public function testSewersFinalRoomChestLRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Sewers - Secret Room - Left")
			->canAccess($this->collected));
	}

	public function testSewersFinalRoomChestMRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Sewers - Secret Room - Middle")
			->canAccess($this->collected));
	}

	public function testSewersFinalRoomChestRRequiresNothing() {
		$this->assertTrue($this->world->getLocation("Sewers - Secret Room - Right")
			->canAccess($this->collected));
	}

	// Key filling
	// @TODO: determine if key filling requirements matter
}
