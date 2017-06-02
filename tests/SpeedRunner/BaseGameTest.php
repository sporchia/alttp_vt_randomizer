<?php namespace SpeedRunner;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group SpeedRunner
 */
class BaseGameTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'SpeedRunner');

		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether'));
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testEasternPalace() {
		$this->addCollected(['L1Sword', 'Lamp']);

		$this->world->getLocation("[dungeon-L1-1F] Eastern Palace - Big key")->setItem(Item::get('BigKey'));
		$this->assertTrue($this->world->getLocation("[dungeon-L1-1F] Eastern Palace - big chest")->fill(Item::get('Bow'), $this->collected));
	}

	public function testEasternPalaceAccessable() {
		$this->addCollected(['L1Sword', 'Lamp']);

		$this->assertTrue($this->world->getRegion('Eastern Palace')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testEasternPalaceCompletable() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow']);

		$this->assertTrue($this->world->getRegion('Eastern Palace')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testEasternCantCollectPendant() {
		$this->world->getRegion('Eastern Palace')->getPrizeLocation()->setItem(Item::get('PendantOfCourage'));

		$this->addCollected(['L1Sword', 'Lamp']);

		$this->assertNotContains(Item::get('PendantOfCourage'), $this->world->collectPrizes($this->collected));
	}

	public function testEasternCollectPendant() {
		$this->world->getRegion('Eastern Palace')->getPrizeLocation()->setItem(Item::get('PendantOfCourage'));

		$this->addCollected(['L1Sword', 'Lamp', 'Bow']);

		$this->assertContains(Item::get('PendantOfCourage'), $this->world->collectPrizes($this->collected));
	}

	public function testDesertPalace() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));
		$this->assertTrue($this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->fill(Item::get('PowerGlove'), $this->collected));
	}

	public function testDesertPalaceAccessable() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora']);

		$this->assertTrue($this->world->getRegion('Desert Palace')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testDesertPalaceCompletable() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));
		$this->assertTrue($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testOldMan() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove']);

		$this->assertTrue($this->world->getLocation("Old Mountain Man")->fill(Item::get('MagicMirror'), $this->collected));
	}

	public function testTowerOfHera() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror']);

		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));
		$this->assertTrue($this->world->getLocation("[dungeon-L3-4F] Tower of Hera - big chest")->fill(Item::get('MoonPearl'), $this->collected));
	}

	public function testTowerOfHeraAccessable() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror']);

		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));
		$this->assertTrue($this->world->getRegion('Tower of Hera')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testTowerOfHeraCompletable() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl']);

		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));
		$this->assertTrue($this->world->getRegion('Tower of Hera')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testGetMasterSword() {
		$this->addCollected(['L1Sword', 'Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower']);

		$this->assertTrue($this->world->getLocation("Altar")->canAccess($this->collected));
	}

	public function testAgahnim1() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword']);

		$this->assertTrue($this->world->getRegion('Hyrule Castle Tower')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testPalaceOfDarkness() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'DefeatAgahnim']);

		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big chest")->fill(Item::get('Hammer'), $this->collected));
	}

	public function testPalaceOfDarknessAccessable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'DefeatAgahnim']);

		$this->assertTrue($this->world->getRegion('Palace of Darkness')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testPalaceOfDarknessCompletable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer']);

		$this->assertTrue($this->world->getRegion('Palace of Darkness')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testZoraHasFlippers() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer']);

		$this->assertTrue($this->world->getLocation("King Zora")->fill(Item::get('Flippers'), $this->collected));
	}

	public function testSwampPalace() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers']);

		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")->fill(Item::get('Hookshot'), $this->collected));
	}

	public function testSwampPalaceAccessable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers']);

		$this->assertTrue($this->world->getRegion('Swamp Palace')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testSwampPalaceCompletable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot']);

		$this->assertTrue($this->world->getRegion('Swamp Palace')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testSkullWoods() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot']);

		$this->world->getLocation("[dungeon-D3-B1] Skull Woods - Big Key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")->fill(Item::get('FireRod'), $this->collected));
	}

	public function testSkullWoodsAccessable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot']);

		$this->assertTrue($this->world->getRegion('Skull Woods')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testSkullWoodsCompletable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod']);

		$this->assertTrue($this->world->getRegion('Skull Woods')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testThievesTown() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod']);

		$this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D4-B2] Thieves' Town - big chest")->fill(Item::get('TitansMitt'), $this->collected));
	}

	public function testThievesTownAccessable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod']);

		$this->assertTrue($this->world->getRegion('Thieves Town')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testThievesTownCompletable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt']);

		$this->assertTrue($this->world->getRegion('Thieves Town')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testIcePalace() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt']);

		$this->world->getLocation("[dungeon-D5-B1] Ice Palace - Big Key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D5-B5] Ice Palace - big chest")->fill(Item::get('BlueMail'), $this->collected));
	}

	public function testIcePalaceAccessable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt']);

		$this->assertTrue($this->world->getRegion('Ice Palace')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testIcePalaceCompletable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt']);

		$this->assertTrue($this->world->getRegion('Ice Palace')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testCatfish() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Catfish")->fill(Item::get('Quake'), $this->collected));
	}

	public function testEther() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Ether Tablet")->fill(Item::get('Ether'), $this->collected));
	}

	public function testFluteBoy() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt']);

		$this->assertTrue($this->world->getLocation("Flute Boy")->fill(Item::get('Shovel'), $this->collected));
	}

	public function testHauntedGrove() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel']);

		$this->assertTrue($this->world->getLocation("Haunted Grove item")->fill(Item::get('OcarinaInactive'), $this->collected));
	}

	public function testMiseryMire() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake']);

		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - end of bridge")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big hub room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big key")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->fill(Item::get('CaneOfSomaria'), $this->collected));
	}

	public function testMiseryMireAccessable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake']);

		$this->assertTrue($this->world->getRegion('Misery Mire')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testMiseryMireCompletable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake', 'CaneOfSomaria']);

		$this->assertTrue($this->world->getRegion('Misery Mire')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testIceCave() {
		$this->assertTrue($this->world->getLocation("[cave-051] Ice Cave")->fill(Item::get('IceRod'), $this->collected));
	}

	// @TODO: this needs to be set to proper location when created
	public function testSilverArrows() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'MasterSword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5',
			'Crystal6']);

		$this->assertTrue($this->world->getLocation("Pyramid - Sword")->fill(Item::get('SilverArrowUpgrade'), $this->collected));
	}

	public function testTurtleRock() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'L4Sword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake', 'CaneOfSomaria', 'IceRod', 'SilverArrowUpgrade']);

		$this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")->fill(Item::get('MirrorShield'), $this->collected));
	}

	public function testTurtleRockAccessable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'L4Sword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake', 'CaneOfSomaria', 'IceRod', 'SilverArrowUpgrade']);

		$this->assertTrue($this->world->getRegion('Turtle Rock')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testTurtleRockCompletable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'L4Sword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake', 'CaneOfSomaria', 'IceRod', 'SilverArrowUpgrade']);

		$this->assertTrue($this->world->getRegion('Turtle Rock')->canComplete($this->world->getLocations(), $this->collected));
	}

	public function testGanonsTower() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'L4Sword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake', 'CaneOfSomaria', 'IceRod', 'SilverArrowUpgrade', 'Crystal1', 'Crystal2', 'Crystal3',
			'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']);

		$this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")->fill(Item::get('RedMail'), $this->collected));
	}

	public function testGanonsTowerAccessable() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'L4Sword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake', 'CaneOfSomaria', 'IceRod', 'SilverArrowUpgrade', 'Crystal1', 'Crystal2', 'Crystal3',
			'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']);

		$this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")->setItem(Item::get('BigKey'));
		$this->assertTrue($this->world->getRegion('Ganons Tower')->canEnter($this->world->getLocations(), $this->collected));
	}

	public function testCanWin() {
		$this->addCollected(['Lamp', 'Bow', 'PegasusBoots', 'BookOfMudora', 'PowerGlove', 'MagicMirror', 'MoonPearl',
			'L4Sword', 'Hammer', 'Flippers', 'Hookshot', 'FireRod', 'TitansMitt', 'Shovel', 'OcarinaInactive',
			'Ether', 'Quake', 'CaneOfSomaria', 'IceRod', 'SilverArrowUpgrade', 'Crystal1', 'Crystal2', 'Crystal3',
			'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']);

		$this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")->setItem(Item::get('BigKey'));
		$this->assertTrue($this->world->getWinCondition()($this->collected));
	}
}
