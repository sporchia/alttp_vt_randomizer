<?php

use ALttP\World;
use ALttP\Item;
use ALttP\Support\ItemCollection;

class NoMajorGlitchesTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
		$this->collected = new ItemCollection;
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

	// Death Mountain
	public function testDarkWorldEastDeathMountainCanNeverHaveTitansMitt() {
		$no_mitt = $this->allItemsExcept(['TitansMitt']);

		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")->fill(Item::get('TitansMitt'), $no_mitt));
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")->fill(Item::get('TitansMitt'), $no_mitt));
	}

	// Tower of Hera
	public function testMoldormCantHaveFireRodIfLampUnobtainableWithoutIt() {
		$no_lighting = $this->allItemsExcept(['Lamp', 'FireRod']);

		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->setItem(Item::get('Lamp'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("Heart Container - Moldorm")->fill(Item::get('FireRod'), $no_lighting));
	}

	// Swamp Palace
	public function testSwampPalaceHookshotCantBeInBigChestWithBigKeyInLateDungeon() {
		$no_hookshot = $this->allItemsExcept(['Hookshot']);

		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")->fill(Item::get('Hookshot'), $no_hookshot));
	}

	// Palace of Darkness
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

	// Misery Mire
	public function testCompassRoomCantHaveLampIfFirerodUnobtainableWithoutIt() {
		$no_lighting = $this->allItemsExcept(['Lamp', 'FireRod']);

		$this->world->getLocation("Heart Container - Moldorm")->setItem(Item::get('FireRod'));
		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D6-B1] Misery Mire - compass")->fill(Item::get('Lamp'), $no_lighting));
	}

	// Turtle Rock
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
