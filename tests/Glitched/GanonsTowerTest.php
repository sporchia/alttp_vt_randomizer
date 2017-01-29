<?php namespace Glitched;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Glitched
 */
class GanonsTowerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'Glitched');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testCanEnterWithNothing() {
		$this->assertTrue($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->collected));
	}

	// Left side
	public function testDownLeftStaircaseRequiresBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestTLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestTRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestBLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestBRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfTeleportRoomRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of teleport room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfTeleportRoomChestTLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfTeleportRoomChestTRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfTeleportRoomChestBLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfTeleportRoomChestBRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	// Right side
	public function testRightStaircaseRoomChestLRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]")
			->canAccess($this->collected));
	}

	public function testRightStaircaseRoomChestRRequiresNothing() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]")
			->canAccess($this->collected));
	}

	public function testFlyingTilesRoomRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestTLRequiresFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testCompassRoomChestTLRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestTRRequiresFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testCompassRoomChestTRRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestBLRequiresFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testCompassRoomChestBLRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestBRRequiresFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testCompassRoomChestBRRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	// Convergence
	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigChestRequiresHammerOrCaneAndFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hammer', 'CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testBigChestAccessableWithoutCaneAndFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testBigChestDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBigChestDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testBigChestDoesntRequiresOnlyFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testBigChestRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testBigChestRequiresFireIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp', 'Hammer'])));
	}

	public function testAboveArmosRequiresHammerOrCaneAndFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['Hammer', 'CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testAboveArmosAccessableWithoutCaneAndFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testAboveArmosDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testAboveArmosDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testAboveArmosDoesntRequiresOnlyFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testAboveArmosRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testAboveArmosRequiresFireIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp', 'Hammer'])));
	}

	public function testNorthOfArmosChestBRequiresHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testNorthOfArmosChestBAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestBDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfArmosChestBDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestBDoesntRequiresOnlyFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testNorthOfArmosChestBRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNorthOfArmosChestBRequiresFireIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp', 'Hammer'])));
	}

	public function testNorthOfArmosChestLRequiresHammerOrCaneAndFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testNorthOfArmosChestLAccessableWithoutCaneAndFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testNorthOfArmosChestLDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfArmosChestLDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestLDoesntRequiresOnlyFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testNorthOfArmosChestLRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNorthOfArmosChestLRequiresFireIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp', 'Hammer'])));
	}

	public function testNorthOfArmosChestRRequiresHammerOrCaneAndFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['Hammer', 'CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testNorthOfArmosChestRAccessableWithoutCaneAndFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod', 'Lamp'])));
	}

	public function testNorthOfArmosChestRDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfArmosChestRDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestRDoesntRequiresOnlyFire() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testNorthOfArmosChestRRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNorthOfArmosChestRRequiresFireIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp', 'Hammer'])));
	}

	// Climb
	public function testNothOfFallingFloorRoomChestLCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testNothOfFallingFloorRoomChestLDoesNotRequireCaneOrHammerIfBigKeyIsFree() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNothOfFallingFloorRoomChestLRequiresCaneOrHammerIfBigKeyIsNotFree() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNothOfFallingFloorRoomChestLDoesNotRequireOnlyFireRod() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNothOfFallingFloorRoomChestLDoesNotRequireOnlyLamp() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testNothOfFallingFloorRoomChestLRequiresFire() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testNothOfFallingFloorRoomChestLRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testNothOfFallingFloorRoomChestRCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testNothOfFallingFloorRoomChestRDoesNotRequireCaneOrHammerIfBigKeyIsFree() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNothOfFallingFloorRoomChestRRequiresCaneOrHammerIfBigKeyIsNotFree() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNothOfFallingFloorRoomChestRDoesNotRequireOnlyFireRod() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNothOfFallingFloorRoomChestRDoesNotRequireOnlyLamp() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testNothOfFallingFloorRoomChestRRequiresFire() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testNothOfFallingFloorRoomChestRRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testBeforeMoldormCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBeforeMoldormDoesNotRequireCaneOrHammerIfBigKeyIsFree() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testBeforeMoldormRequiresCaneOrHammerIfBigKeyIsNotFree() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testBeforeMoldormDoesNotRequireOnlyFireRod() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBeforeMoldormDoesNotRequireOnlyLamp() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testBeforeMoldormRequiresFire() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testBeforeMoldormRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testMoldormRoomCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testMoldormRoomDoesNotRequireCaneOrHammerIfBigKeyIsFree() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testMoldormRoomRequiresCaneOrHammerIfBigKeyIsNotFree() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testMoldormRoomDoesNotRequireOnlyFireRod() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMoldormRoomDoesNotRequireOnlyLamp() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testMoldormRoomRequiresFire() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testMoldormRoomRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testMoldormRoomRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}
}
