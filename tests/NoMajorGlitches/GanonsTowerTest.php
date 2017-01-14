<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class GanonsTowerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItems()));
	}

	public function testCrystal1RequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItemsExcept(['Crystal1'])));
	}

	public function testCrystal2RequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItemsExcept(['Crystal2'])));
	}

	public function testCrystal3RequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItemsExcept(['Crystal3'])));
	}

	public function testCrystal4RequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItemsExcept(['Crystal4'])));
	}

	public function testCrystal5RequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItemsExcept(['Crystal5'])));
	}

	public function testCrystal6RequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItemsExcept(['Crystal6'])));
	}

	public function testCrystal7RequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItemsExcept(['Crystal7'])));
	}

	public function testMoonPearlRequiredForEntry() {
		$this->assertFalse($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->allItemsExcept(['MoonPearl'])));
	}

	// Left side
	public function testDownLeftStaircaseRequiresBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestTLRequiresHookshotOrBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestTLDoesNotRequireOnlyBoots() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestTLDoesNotRequireOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfGapRoomChestTLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestTRRequiresHookshotOrBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestTRDoesNotRequireOnlyBoots() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestTRDoesNotRequireOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfGapRoomChestTRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestBLRequiresHookshotOrBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestBLDoesNotRequireOnlyBoots() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestBLDoesNotRequireOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfGapRoomChestBLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestBRRequiresHookshotOrBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestBRDoesNotRequireOnlyBoots() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestBRDoesNotRequireOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfGapRoomChestBRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testMapRoomRequiresHookshotOrBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - map room")
			->canAccess($this->allItemsExcept(['Hookshot', 'PegasusBoots'])));
	}

	public function testNorthOfTeleportRoomRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of teleport room")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testWestOfTeleportRoomChestTLRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testWestOfTeleportRoomChestTRRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testWestOfTeleportRoomChestBLRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testWestOfTeleportRoomChestBRRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	// Right side
	public function testRightStaircaseRoomChestLOnlyRequiresCrystalsAndMoonPearl() {
		$this->addCollected(['Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]")
			->canAccess($this->collected));
	}

	public function testRightStaircaseRoomChestROnlyRequiresCrystalsAndMoonPearl() {
		$this->addCollected(['Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7', 'MoonPearl']);

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]")
			->canAccess($this->collected));
	}

	public function testFlyingTilesRoomRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrace")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestTLRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testCompassRoomChestTLRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestTRRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testCompassRoomChestTRRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestBLRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testCompassRoomChestBLRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestBRRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
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

	public function testBigChestRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testBigChestAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
	}

	public function testBigChestAccessableWithoutHookshotAndHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer'])));
	}

	public function testBigChestDoesntRequiresOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testBigChestDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBigChestDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testBigChestDoesntRequiresOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestRequiresCaneIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hookshot'])));
	}

	public function testBigChestRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testBigChestRequiresFireRodIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Hookshot'])));
	}

	public function testBigChestRequiresFireRodIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Hammer'])));
	}

	public function testAboveArmosRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testAboveArmosAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
	}

	public function testAboveArmosAccessableWithoutHookshotAndHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer'])));
	}

	public function testAboveArmosDoesntRequiresOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testAboveArmosDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testAboveArmosDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testAboveArmosDoesntRequiresOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testAboveArmosRequiresCaneIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hookshot'])));
	}

	public function testAboveArmosRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testAboveArmosRequiresFireRodIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['FireRod', 'Hookshot'])));
	}

	public function testAboveArmosRequiresFireRodIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['FireRod', 'Hammer'])));
	}

	public function testNorthOfArmosChestBRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestBAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestBAccessableWithoutHookshotAndHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer'])));
	}

	public function testNorthOfArmosChestBDoesntRequiresOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfArmosChestBDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfArmosChestBDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestBDoesntRequiresOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNorthOfArmosChestBRequiresCaneIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hookshot'])));
	}

	public function testNorthOfArmosChestBRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNorthOfArmosChestBRequiresFireRodIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Hookshot'])));
	}

	public function testNorthOfArmosChestBRequiresFireRodIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Hammer'])));
	}

	public function testNorthOfArmosChestLRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestLAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestLAccessableWithoutHookshotAndHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer'])));
	}

	public function testNorthOfArmosChestLDoesntRequiresOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfArmosChestLDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfArmosChestLDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestLDoesntRequiresOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNorthOfArmosChestLRequiresCaneIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hookshot'])));
	}

	public function testNorthOfArmosChestLRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNorthOfArmosChestLRequiresFireRodIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Hookshot'])));
	}

	public function testNorthOfArmosChestLRequiresFireRodIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Hammer'])));
	}

	public function testNorthOfArmosChestRRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestRAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestRAccessableWithoutHookshotAndHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer'])));
	}

	public function testNorthOfArmosChestRDoesntRequiresOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfArmosChestRDoesntRequiresOnlyHammer() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfArmosChestRDoesntRequiresOnlyCane() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestRDoesntRequiresOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNorthOfArmosChestRRequiresCaneIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hookshot'])));
	}

	public function testNorthOfArmosChestRRequiresCaneIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testNorthOfArmosChestRRequiresFireRodIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Hookshot'])));
	}

	public function testNorthOfArmosChestRRequiresFireRodIfNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Hammer'])));
	}

	// Climb
	public function testNothOfFallingFloorRoomChestLCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testNothOfFallingFloorRoomChestLDoesNotRequireOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNothOfFallingFloorRoomChestLDoesNotRequireOnlyLamp() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testNothOfFallingFloorRoomChestLRequiresFire() {
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

	public function testNothOfFallingFloorRoomChestRDoesNotRequireOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNothOfFallingFloorRoomChestRDoesNotRequireOnlyLamp() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testNothOfFallingFloorRoomChestRRequiresFire() {
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

	public function testBeforeMoldormDoesNotRequireOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBeforeMoldormDoesNotRequireOnlyLamp() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testBeforeMoldormRequiresFire() {
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

	public function testMoldormRoomDoesNotRequireOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMoldormRoomDoesNotRequireOnlyLamp() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testMoldormRoomRequiresFire() {
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
