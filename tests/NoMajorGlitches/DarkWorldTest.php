<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class DarkWorldTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testSuperBunnyDMNotAllowedTopChest() {
		$no_moonpearl = $this->allItemsExcept(['MoonPearl']);

		config(['alttp.test_rules.region.superBunnyDM' => false]);
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")->canAccess($no_moonpearl));
	}

	public function testSuperBunnyDMNotAllowedBottomChest() {
		$no_moonpearl = $this->allItemsExcept(['MoonPearl']);

		config(['alttp.test_rules.region.superBunnyDM' => false]);
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")->canAccess($no_moonpearl));
	}

	public function testSuperBunnyDMAllowedTopChest() {
		$no_moonpearl = $this->allItemsExcept(['MoonPearl']);

		config(['alttp.test_rules.region.superBunnyDM' => true]);
		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")->canAccess($no_moonpearl));
	}

	public function testSuperBunnyDMAllowedBottomChest() {
		$no_moonpearl = $this->allItemsExcept(['MoonPearl']);

		config(['alttp.test_rules.region.superBunnyDM' => true]);
		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")->canAccess($no_moonpearl));
	}

	public function testGlovesRequiredToEnterBumperCave() {
		$no_lifting = $this->allItemsExcept(['PowerGlove', 'TitansMitt']);

		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")->canAccess($no_lifting));
	}

	public function testCanAccessPyramidFairyWithMirrorAndAG1() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'MagicMirror', 'Cape', 'TitansMitt', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid")->canAccess($this->collected));
	}

	public function testCanAccessPyramidFairyWithHammer() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'PowerGlove', 'Hammer', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid")->canAccess($this->collected));
	}
}
