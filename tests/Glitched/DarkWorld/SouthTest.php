<?php namespace Glitched\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class SouthTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'Glitched');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Item Locations
	public function testHypeCaveChest1RequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testHypeCaveChest1RequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest1RequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testHypeCaveChest2RequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest2RequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [top middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testHypeCaveChest3RequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest3RequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom middle chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testHypeCaveChest4RequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveChest4RequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace [bottom chest]")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testHypeCaveGenerousGuyRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testHypeCaveGenerousGuyRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-073] cave northeast of swamp palace - generous guy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("Flute Boy")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testFluteBoyRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testFluteBoyRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("Flute Boy")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->allItemsExcept(['AnyBottle', 'MoonPearl'])));
	}

	public function testDiggingGameRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}

	public function testDiggingGameRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("Piece of Heart (Digging Game)")
			->canAccess($this->collected));
	}
}
