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

	protected function allItemsExcept(array $remove_items) {
		$items = Item::all()->copy();
		foreach ($remove_items as $item) {
			$items->removeItem($item);
		}
		return $items;
	}

	public function testSwampPalaceHookshotCantBeInBigChestWithBigKeyInLateDungeon() {
		$no_hookshot = $this->allItemsExcept(['Hookshot']);

		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B2] Swamp Palace - flooded room [right chest]")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")->fill(Item::get('Hookshot'), $no_hookshot));
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

	public function testDarkWorldEastDeathMountainCanNeverHaveTitansMitt() {
		$no_mitt = $this->allItemsExcept(['TitansMitt']);

		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")->fill(Item::get('TitansMitt'), $no_mitt));
		$this->assertFalse($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")->fill(Item::get('TitansMitt'), $no_mitt));
	}
}
