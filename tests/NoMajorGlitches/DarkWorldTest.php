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
		config(['alttp.test_rules.region.superBunnyDM' => false]);

		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testSuperBunnyDMNotAllowedBottomChest() {
		config(['alttp.test_rules.region.superBunnyDM' => false]);

		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testSuperBunnyDMAllowedTopChest() {
		config(['alttp.test_rules.region.superBunnyDM' => true]);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testSuperBunnyDMAllowedBottomChest() {
		config(['alttp.test_rules.region.superBunnyDM' => true]);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testGlovesRequiredToEnterBumperCave() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")
			->canAccess($this->allItemsExcept(['PowerGlove', 'TitansMitt'])));
	}

	public function testCanAccessPyramidFairyWithMirrorAndAG1() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'MagicMirror', 'Cape', 'TitansMitt', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid")
			->canAccess($this->collected));
	}

	public function testCanAccessPyramidFairyWithHammer() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'PowerGlove', 'Hammer', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid")
			->canAccess($this->collected));
	}

	// Found Issues
	public function testDarkWorldEastDeathMountainCanNeverHaveTitansMittTopChest() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->fill(Item::get('TitansMitt'), $this->allItemsExcept(['TitansMitt'])));
	}

	public function testDarkWorldEastDeathMountainCanNeverHaveTitansMittBottomChest() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->fill(Item::get('TitansMitt'), $this->allItemsExcept(['TitansMitt'])));
	}
}
