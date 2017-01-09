<?php

use ALttP\World;
use ALttP\Item;
use ALttP\Support\ItemCollection;

class NoMajorGlitchesTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
		$this->collected = new ItemCollection;

		// need to set an items for entry
		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
	}

	protected function addCollected(array $items) {
		foreach ($items as $item) {
			$this->collected->addItem(Item::get($item));
		}
	}

	protected function allItems() {
		return Item::all()->copy();
	}

	protected function allItemsExcept(array $remove_items) {
		$items = $this->allItems();
		foreach ($remove_items as $item) {
			$items->removeItem($item);
		}
		return $items;
	}

	// Light World
	public function testLinksHouseCannotHaveGloves() {
		$this->assertFalse($this->world->getLocation("[cave-040] Link's House")->fill(Item::get('PowerGlove'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("[cave-040] Link's House")->fill(Item::get('TitansMitt'), $this->allItems()));
	}

	// Shields seems to all downgrade on S&Q to Fighters Shield, lets just avoid that
	public function testLinksHouseCannotHaveShields() {
		$this->assertFalse($this->world->getLocation("[cave-040] Link's House")->fill(Item::get('RedShield'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("[cave-040] Link's House")->fill(Item::get('MirrorShield'), $this->allItems()));
	}

	// Dark World
	public function testSuperBunnyDMNotAllowed() {
		$no_moonpearl = $this->allItemsExcept(['MoonPearl']);

		config(['alttp.test_rules.region.superBunnyDM' => false]);
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")->canAccess($no_moonpearl));
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")->canAccess($no_moonpearl));
	}

	public function testSuperBunnyDMAllowed() {
		$no_moonpearl = $this->allItemsExcept(['MoonPearl']);

		config(['alttp.test_rules.region.superBunnyDM' => true]);
		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")->canAccess($no_moonpearl));
		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")->canAccess($no_moonpearl));
	}

	public function testGlovesRequiredToEnterBumperCave() {
		$no_lifting = $this->allItemsExcept(['PowerGlove', 'TitansMitt']);

		$this->assertFalse($this->world->getLocation("Piece of Heart (Dark World - bumper cave)")->canAccess($no_lifting));
	}

	// Death Mountain
	public function testDarkWorldEastDeathMountainCanNeverHaveTitansMitt() {
		$no_mitt = $this->allItemsExcept(['TitansMitt']);

		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")->fill(Item::get('TitansMitt'), $no_mitt));
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")->fill(Item::get('TitansMitt'), $no_mitt));
	}

	// Desert Palace
	public function testDesertPalaceBigKeyCantBeRightSideIfTorchHasKeyAndNoBoots() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->fill(Item::get('BigKey'), $no_boots));
		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")->fill(Item::get('BigKey'), $no_boots));
	}

	public function testDesertPalaceDoesntRequireBootsIfSmallKeyIsInMapChest() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $no_boots));
	}

	public function testDesertPalaceDoesntRequireBootsIfSmallKeyIsInMapChestBigKeyInCompassRoom() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $no_boots));
	}

	public function testDesertPalaceDoesntRequireBootsIfBigKeyIsInMapChestAndSmallKeyInBigChest() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $no_boots));
	}

	public function testDesertPalaceDoesntRequiresBootsIfSmallKeyAtTorch() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $no_boots));
	}


	// Tower of Hera
	public function testMoldormCantHaveFireRodIfLampUnobtainableWithoutIt() {
		$no_lighting = $this->allItemsExcept(['Lamp', 'FireRod']);

		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->setItem(Item::get('Lamp'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Moldorm")->fill(Item::get('FireRod'), $no_lighting));
	}

	// Palace of Darkness
	public function testPalaceOfDarknessKeys() {
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - spike statue room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->assertFalse($this->world->getLocation("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]")->fill(Item::get('Key'), $this->allItems()));
		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->fill(Item::get('Key'), $this->allItems()));
	}

	public function testPalaceOfDarknessCanHaveBowIfFirstChestIsKey() {
		$this->addCollected(['PowerGlove', 'Hammer', 'MoonPearl']);

		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->fill(Item::get('Bow'), $this->collected));
	}

	public function testPalaceOfDarknessCannotHaveBowIfFirstChestIsNotKey() {
		$no_bow = $this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows']);

		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Nothing'));
		$this->assertFalse($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->fill(Item::get('Bow'), $no_bow));
	}

	// Swamp Palace
	public function testSwampPalaceHookshotCantBeInBigChestWithBigKeyInLateDungeon() {
		$no_hookshot = $this->allItemsExcept(['Hookshot']);

		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")->fill(Item::get('Hookshot'), $no_hookshot));
	}

	public function testSwampPalaceHookshotCanBeInBigChest() {
		$no_hookshot = $this->allItemsExcept(['Hookshot']);

		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B1] Swamp Palace - south of hookshot room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")->fill(Item::get('Hookshot'), $no_hookshot));
	}

	// Misery Mire
	public function testCompassRoomCantHaveLampIfFirerodUnobtainableWithoutIt() {
		$no_lighting = $this->allItemsExcept(['Lamp', 'FireRod']);


		$this->world->getLocation("Heart Container - Moldorm")->setItem(Item::get('FireRod'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('Lamp'), $no_lighting));
	}

	public function testBigKeyCantBeInCompassRoomIfKeyInBigChest() {
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->setItem(Item::get('Key'));
		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testKeyCantBeInBigChestIfBigKeyInCompassRoom() {
		$this->assertTrue($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('BigKey'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->fill(Item::get('Key'), $this->allItems()));
	}

	// Turtle Rock
	public function testTurtleRockCantHaveBigKeyPastBigKeyDoor() {
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B1] Turtle Rock - Roller switch room")->fill(Item::get('BigKey'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")->fill(Item::get('BigKey'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")->fill(Item::get('BigKey'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")->fill(Item::get('BigKey'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")->fill(Item::get('BigKey'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testTurtleRockCantHaveLampPastDarkRoom() {
		$no_lamp = $this->allItemsExcept(['Lamp']);

		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]")->fill(Item::get('Lamp'), $no_lamp));
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]")->fill(Item::get('Lamp'), $no_lamp));
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]")->fill(Item::get('Lamp'), $no_lamp));
		$this->assertFalse($this->world->getLocation("[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]")->fill(Item::get('Lamp'), $no_lamp));
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")->fill(Item::get('Lamp'), $no_lamp));
	}

	public function testTurtleRockTrinexCantHaveKeys() {
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")->fill(Item::get('Key'), $this->allItems()));
		$this->assertFalse($this->world->getLocation("Heart Container - Trinexx")->fill(Item::get('BigKey'), $this->allItems()));
	}
}
