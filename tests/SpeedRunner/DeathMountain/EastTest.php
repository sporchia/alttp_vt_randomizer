<?php namespace SpeedRunner\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class EastTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testSpiralCaveRequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("[cave-012-1F] Death Mountain - wall of caves - left cave")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testSpiralCaveRequiresMirrorAndHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-012-1F] Death Mountain - wall of caves - left cave")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer', 'Hookshot'])));
	}

	public function testSpiralCaveRequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-012-1F] Death Mountain - wall of caves - left cave")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testSpiralCaveRequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-012-1F] Death Mountain - wall of caves - left cave")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testMimicCaveRequiresGlovesOrFlute() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
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

	public function testMimicCaveRequiresMagicMoonPearl() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testMimicCaveRequiresEtherIfEtherIsTurtleRockEntryMedallion() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Ether'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['Ether'])));
	}

	public function testMimicCaveRequiresBombosIfBombosIsTurtleRockEntryMedallion() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Bombos'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['Bombos'])));
	}

	public function testMimicCaveRequiresQuakeIfQuakeIsTurtleRockEntryMedallion() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['Quake'])));
	}

	public function testMimicCaveRequiresCane() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testMimicCaveRequiresFireRodIfKeysNotInTurtleRockCompassAndChainChompRooms() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveRequiresFireRodIfKeyNotInTurtleRockChainChompRoom() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveRequiresFireRodIfKeyNotInTurtleRockCompassRoom() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveDoesNotRequireFireRodIfKeysInTurtleRockCompassAndChainChompRooms() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testRightCaveTopChest1RequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testRightCaveTopChest1RequiresMirrorAndHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest1RequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testRightCaveTopChest1RequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest2RequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testRightCaveTopChest2RequiresMirrorAndHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest2RequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testRightCaveTopChest2RequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest3RequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testRightCaveTopChest3RequiresMirrorAndHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest3RequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testRightCaveTopChest3RequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest4RequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testRightCaveTopChest4RequiresMirrorAndHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest4RequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testRightCaveTopChest4RequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest5RequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testRightCaveTopChest5RequiresMirrorAndHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer', 'Hookshot'])));
	}

	public function testRightCaveTopChest5RequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testRightCaveTopChest5RequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testRightCaveBottomChest1RequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testRightCaveBottomChest1RequiresMirrorAndHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer', 'Hookshot'])));
	}

	public function testRightCaveBottomChest1RequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testRightCaveBottomChest1RequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testRightCaveBottomChest2RequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testRightCaveBottomChest2RequiresMirrorAndHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hammer', 'Hookshot'])));
	}

	public function testRightCaveBottomChest2RequresMirrorIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]")
			->canAccess($this->allItemsExcept(['MagicMirror', 'Hookshot'])));
	}

	public function testRightCaveBottomChest2RequresHammerIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}

	public function testFloatingIslandRequiresGlovesOrFlute() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Death Mountain - floating island)")
			->canAccess($this->allItemsExcept(['Gloves', 'Flute'])));
	}

	public function testFloatingIslandRequresMirror() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Death Mountain - floating island)")
			->canAccess($this->allItemsExcept(['MagicMirror'])));
	}

	public function testFloatingIslandRequresMoonPearl() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Death Mountain - floating island)")
			->canAccess($this->allItemsExcept(['MoonPearl'])));
	}

	public function testFloatingIslandRequresMitts() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Death Mountain - floating island)")
			->canAccess($this->allItemsExcept(['TitansMitt'])));
	}

	public function testFloatingIslandRequresHammerOrHookshot() {
		$this->assertFalse($this->world->getLocation("Piece of Heart (Death Mountain - floating island)")
			->canAccess($this->allItemsExcept(['Hammer', 'Hookshot'])));
	}
}
