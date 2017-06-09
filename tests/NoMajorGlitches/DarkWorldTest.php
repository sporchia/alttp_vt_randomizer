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

	public function testSpikeCaveRequiresGloves() {
		$this->assertFalse($this->world->getLocation("[cave-055] Spike cave")
			->canAccess($this->allItemsExcept(['Gloves'])));
	}

	public function testSpikeCaveRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-055] Spike cave")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testSpikeCaveRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[cave-055] Spike cave")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfMireChestLRequiresFlute() {
		$this->assertFalse($this->world->getLocation("[cave-071] Misery Mire west area [left chest]")
			->canAccess($this->allItemsExcept(['Flute'])));
	}

	public function testWestOfMireChestLRequiresMitt() {
		$this->assertFalse($this->world->getLocation("[cave-071] Misery Mire west area [left chest]")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testWestOfMireChestLRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-071] Misery Mire west area [left chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testWestOfMireChestRRequiresFlute() {
		$this->assertFalse($this->world->getLocation("[cave-071] Misery Mire west area [right chest]")
			->canAccess($this->allItemsExcept(['Flute'])));
	}

	public function testWestOfMireChestRRequiresMitt() {
		$this->assertFalse($this->world->getLocation("[cave-071] Misery Mire west area [right chest]")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testWestOfMireChestRRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-071] Misery Mire west area [right chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDeathMountainChestTRequiresMitt() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testDeathMountainChestTRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDeathMountainChestTRequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testDeathMountainChestTRequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testDeathMountainChestBRequiresMitt() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testDeathMountainChestBRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDeathMountainChestBRequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testDeathMountainChestBRequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestBRRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDeathMountainHookshotCaveChestBRRequiresMitt() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testDeathMountainHookshotCaveChestBRRequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestBRRequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestBRRequresBootsIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestBLRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDeathMountainHookshotCaveChestBLRequiresMitt() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testDeathMountainHookshotCaveChestBLRequresHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestTLRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDeathMountainHookshotCaveChestTLRequiresMitt() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testDeathMountainHookshotCaveChestTLRequresHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestTRRequiresMoonPearl() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testDeathMountainHookshotCaveChestTRRequiresMitt() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testDeathMountainHookshotCaveChestTRRequresHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testCanAccessPyramidFairyWithMirrorAndAG1() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'TitansMitt', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid - Sword")
			->canAccess($this->collected));
	}

	public function testCanAccessPyramidFairyWithHammer() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'PowerGlove', 'Hammer', 'DefeatAgahnim', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid - Sword")
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
