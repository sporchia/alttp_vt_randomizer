<?php namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class GanonsTowerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'OverworldGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Ganons Tower')
			->canEnter($this->world->getLocations(), $this->allItems()));
	}

	// Left side
	public function testDownLeftStaircaseRequiresBoots() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfGapRoomChestTLRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfGapRoomChestTLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestTRRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfGapRoomChestTRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestBLRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfGapRoomChestBLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfGapRoomChestBRRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]")
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

	public function testMapDoesNotRequireOnlyBoots() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - map room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testMapDoesNotRequireOnlyHookshot() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - map room")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testMapRoomRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - map room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testMapRoomDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - map room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testMapRoomRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - map room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testMapRoomDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - map room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testMapRoomRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - map room")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testNorthOfTeleportRoomRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of teleport room")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testNorthOfTeleportRoomRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of teleport room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testNorthOfTeleportRoomDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of teleport room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfTeleportRoomRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of teleport room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfTeleportRoomDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of teleport room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfTeleportRoomRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of teleport room")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testWestOfTeleportRoomChestTLRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testWestOfTeleportRoomChestTLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfTeleportRoomChestTLDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestTLRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestTLDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestTLRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testWestOfTeleportRoomChestTRRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testWestOfTeleportRoomChestTRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfTeleportRoomChestTRDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestTRRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestTRDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestTRRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testWestOfTeleportRoomChestBLRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testWestOfTeleportRoomChestBLRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfTeleportRoomChestBLDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestBLRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestBLDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestBLRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testWestOfTeleportRoomChestBRRequiresHookshot() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testWestOfTeleportRoomChestBRRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfTeleportRoomChestBRDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestBRRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestBRDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testWestOfTeleportRoomChestBRRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	// Right side
	public function testRightStaircaseRoomChestLOnlyRequiresCrystalsAndMoonPearl() {
		$this->addCollected(['Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7',
			'MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']);

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]")
			->canAccess($this->collected));
	}

	public function testRightStaircaseRoomChestROnlyRequiresCrystalsAndMoonPearl() {
		$this->addCollected(['Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7',
			'MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']);

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]")
			->canAccess($this->collected));
	}

	public function testFlyingTilesRoomRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")
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

	public function testCompassRoomChestTLDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestTLRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestTLDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestTRRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testCompassRoomChestTRRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestTRDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestTRRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestTRDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestBLRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testCompassRoomChestBLRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestBLDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestBLRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestBLDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestBRRequiresFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testCompassRoomChestBRRequiresCane() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testCompassRoomChestBRDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestBRRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testCompassRoomChestBRDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	// Convergence
	public function testBigChestCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigChestRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testBigChestAccessableWithoutCaneAndFireRod() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
	}

	public function testBigChestDoesntRequiresOnlyHookshot() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testBigChestDoesntRequiresOnlyHammer() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testBigChestDoesntRequiresOnlyCane() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria'])));
	}

	public function testBigChestDoesntRequiresOnlyFireRod() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testBigChestRequiresCaneIfNoHookshot() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hookshot'])));
	}

	public function testBigChestRequiresCaneIfNoHammer() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'Hammer'])));
	}

	public function testBigChestRequiresFireRodIfNoHookshot() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Hookshot'])));
	}

	public function testBigChestRequiresFireRodIfNoHammer() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['FireRod', 'Hammer'])));
	}

	public function testBigChestDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigChestRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigChestDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigChestRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testAboveArmosRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testAboveArmosAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
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

	public function testAboveArmosDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testAboveArmosRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testAboveArmosDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testAboveArmosRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - above Armos")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestBRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestBAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
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

	public function testNorthOfArmosChestBDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestBRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestBDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestBRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestLRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestLAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
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

	public function testNorthOfArmosChestLDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestLRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestLDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestLRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testNorthOfArmosChestRRequiresHookshotAndHammerOrCaneAndFireRod() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['Hookshot', 'Hammer', 'CaneOfSomaria', 'FireRod'])));
	}

	public function testNorthOfArmosChestRAccessableWithoutCaneAndFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['CaneOfSomaria', 'FireRod'])));
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

	public function testNorthOfArmosChestRDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestRRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestRDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfArmosChestRRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	// Climb
	public function testNorthOfFallingFloorRoomChestLCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testNorthOfFallingFloorRoomChestLDoesNotRequireOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNorthOfFallingFloorRoomChestLDoesNotRequireOnlyLamp() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testNorthOfFallingFloorRoomChestLRequiresFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testNorthOfFallingFloorRoomChestLRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testNorthOfFallingFloorRoomChestLRequiresBootsIfBigKeyOnTorch() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfFallingFloorRoomChestLDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfFallingFloorRoomChestLRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfFallingFloorRoomChestLDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfFallingFloorRoomChestLRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	public function testNorthOfFallingFloorRoomChestRCannotBeBigKey() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testNorthOfFallingFloorRoomChestRDoesNotRequireOnlyFireRod() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testNorthOfFallingFloorRoomChestRDoesNotRequireOnlyLamp() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['Lamp'])));
	}

	public function testNorthOfFallingFloorRoomChestRRequiresFire() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['FireRod', 'Lamp'])));
	}

	public function testNorthOfFallingFloorRoomChestRRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testNorthOfFallingFloorRoomChestRRequiresBootsIfBigKeyOnTorch() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfFallingFloorRoomChestRDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfFallingFloorRoomChestRRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfFallingFloorRoomChestRDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testNorthOfFallingFloorRoomChestRRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
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

	public function testBeforeMoldormRoomRequiresBootsIfBigKeyOnTorch() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBeforeMoldormRoomDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBeforeMoldormRoomRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBeforeMoldormRoomDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBeforeMoldormRoomRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - before Moldorm")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
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

	public function testMoldormRoomRequiresBootsIfBigKeyOnTorch() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testMoldormRoomDoesNotRequireBootsIfNotBonkKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testMoldormRoomRequiresBootsIfBonkKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testMoldormRoomDoesNotRequireBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['PegasusBoots'])));
	}

	public function testMoldormRoomRequiresSomariaButNotRequiresBootsIfBonkKeyAndMoreKeys() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-6F] Ganon's Tower - Moldorm room")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'CaneOfSomaria'])));
	}

	// Key fill
	public function testCompassRoomChestBRCanBeKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestBRCannotBeKeyIfChestTRHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestBRCannotBeKeyIfChestTLHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestBRCannotBeKeyIfChestBLHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestTRCanBeKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestTRCannotBeKeyIfChestBRHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestTRCannotBeKeyIfChestTLHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestTRCannotBeKeyIfChestBLHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestBLCanBeKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestBLCannotBeKeyIfChestTRHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestBLCannotBeKeyIfChestTLHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestBLCannotBeKeyIfChestBRHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestTLCanBeKey() {
		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestTLCannotBeKeyIfChestBRHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestTLCannotBeKeyIfChestBLHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCompassRoomChestTLCannotBeKeyIfChestTRHasKey() {
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}
}
