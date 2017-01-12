<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class PalaceOfDarknessTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function testKeyCantBeAtHelmasaur() {
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - spike statue room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->assertFalse($this->world->getLocation("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]")->fill(Item::get('Key'), $this->allItems()));
	}

	public function testKeys() {
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - spike statue room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->fill(Item::get('Key'), $this->allItems()));
	}

	public function testCanHaveBowIfFirstChestIsKey() {
		$this->addCollected(['PowerGlove', 'Hammer', 'MoonPearl']);

		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->fill(Item::get('Bow'), $this->collected));
	}

	public function testCannotHaveBowIfFirstChestIsNotKey() {
		$no_bow = $this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows']);

		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Nothing'));
		$this->assertFalse($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->fill(Item::get('Bow'), $no_bow));
	}

	public function testNoBigKeyInBigChest() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big chest")->fill(Item::get('BigKey'), $this->allItems()));
	}
}
