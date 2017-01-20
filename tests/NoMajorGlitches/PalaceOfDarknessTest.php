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

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Chest("[dungeon-D1-1F] Dark Palace - big key room",
	// Chest("[dungeon-D1-1F] Dark Palace - jump room [right chest]",
	// Chest("[dungeon-D1-1F] Dark Palace - jump room [left chest]",
	// BigChest("[dungeon-D1-1F] Dark Palace - big chest",
	// Chest("[dungeon-D1-1F] Dark Palace - compass room",
	// Chest("[dungeon-D1-1F] Dark Palace - spike statue room",
	// Chest("[dungeon-D1-B1] Dark Palace - turtle stalfos room",
	// Chest("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]",
	// Chest("[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]",
	// Chest("[dungeon-D1-1F] Dark Palace - statue push room",
	// Chest("[dungeon-D1-1F] Dark Palace - maze room [top chest]",
	// Chest("[dungeon-D1-1F] Dark Palace - maze room [bottom chest]",
	// Chest("[dungeon-D1-B1] Dark Palace - shooter room",
	// Drop("Heart Container - Helmasaur King",
	// so need to find a way to test this better, and want to look at each location and actually solve the logic for each place individually
	// like
	// So basically all doors that have no doors behind them and more than one chest behind them can not have keys behind them
	//
	public function testShooterRoomRequiresOnlyEntry() {
		$this->addCollected(['MoonPearl', 'Cape']);

		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")
			->canAccess($this->collected));
	}

	public function testStatuePushRoomRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testJumpRoomChestRRequiresBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	// three chests that require a key early, or bow and hammer, or bow and key in bowable place

	// Can go through front door, or around with Bow and Hammer
	public function testJumpRoomChestLIfKeyInShooterRoom() {
		$this->addCollected(['MoonPearl', 'MasterSword']);
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")
			->canAccess($this->collected));
	}

	public function testJumpRoomChestLIfKeyNotInShooterRoomAndNoBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testJumpRoomChestLIfKeyNotInShooterRoomAndNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testJumpRoomChestLIfKeyNotInShooterRoomWithBowAndHammer() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Bow', 'Hammer']);

		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")
			->canAccess($this->collected));
	}

	// Can go through front door, or around with Bow and Hammer
	public function testTurtleStalfosRoomIfKeyInShooterRoom() {
		$this->addCollected(['MoonPearl', 'MasterSword']);
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")
			->canAccess($this->collected));
	}

	public function testTurtleStalfosRoomIfKeyNotInShooterRoomAndNoBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testTurtleStalfosRoomIfKeyNotInShooterRoomAndNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testTurtleStalfosRoomIfKeyNotInShooterRoomWithBowAndHammer() {
		$this->addCollected(['MoonPearl', 'PowerGlove', 'Bow', 'Hammer']);

		$this->assertTrue($this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")
			->canAccess($this->collected));
	}

	// Chest("[dungeon-D1-1F] Dark Palace - big key room",
	// Chest("[dungeon-D1-1F] Dark Palace - jump room [right chest]",
	// Chest("[dungeon-D1-1F] Dark Palace - jump room [left chest]",
	// Chest("[dungeon-D1-B1] Dark Palace - turtle stalfos room",
	// Chest("[dungeon-D1-1F] Dark Palace - statue push room",
	// Chest("[dungeon-D1-B1] Dark Palace - shooter room",

	// Can go through front door, or around with Bow and Hammer, but will need access to at least 2 more keys as they
	// use a key downstairs if they have Hammer
	// Big Key Room is locked behind a door, basically we need to guarentee 4 keys before falling bridge in all cases
	public function testBigKeyRoomMustHaveKeyIfOnly3RoomsHaveKeyBeforeBridge() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigKeyRoomCanNotBeNotKeyIfOnly3RoomsHaveKeyBeforeBridge() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigKeyRoomCanNotBeNotKeyIf4RoomsHaveKeyBeforeBridge() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigKeyRoomIfKeyNotInShooterRoomAndNoBow() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")
			->canAccess($this->allItemsExcept(['Bow', 'BowAndArrows', 'BowAndSilverArrows'])));
	}

	public function testBigKeyRoomIfKeyNotInShooterRoomAndNoHammer() {
		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}


	public function testKeyCantBeInMazeRoomChestT() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - maze room [top chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testKeyCantBeInMazeRoomChestB() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - maze room [bottom chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testKeyCanBeInMazeRoomChestBIfHammerInMaze() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));

		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - maze room [top chest]")->setItem(Item::get('Hammer'));

		$this->assertTrue($this->world->getLocation("[dungeon-D1-1F] Dark Palace - maze room [bottom chest]")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testKeyCantBeInBigChest() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big chest")
			->fill(Item::get('Key'), $this->allItems()));
	}

	public function testBigKeyCantBeInBigChest() {
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - statue push room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-D1-1F] Dark Palace - big chest")
			->fill(Item::get('BigKey'), $this->allItems()));
	}


// OLD TESTS
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
