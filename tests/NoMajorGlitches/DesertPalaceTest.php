<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class DesertPalaceTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function testBigKeyCantBeRightSideTopIfTorchHasKeyAndNoBoots() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->fill(Item::get('BigKey'), $no_boots));
	}

	public function testBigKeyCantBeRightSideBottomIfTorchHasKeyAndNoBoots() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")->fill(Item::get('BigKey'), $no_boots));
	}

	public function testDoesntRequireBootsIfSmallKeyIsInMapChest() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $no_boots));
	}

	public function testDoesntRequireBootsIfSmallKeyIsInMapChestBigKeyInCompassRoom() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $no_boots));
	}

	public function testDoesntRequireBootsIfBigKeyIsInMapChestAndSmallKeyInBigChest() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Map room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('BigKey'));

		$this->assertTrue($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $no_boots));
	}

	public function testDoesntRequiresBootsIfSmallKeyAtTorch() {
		$no_boots = $this->allItemsExcept(['PegasusBoots']);

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('BigKey'));

		$this->assertFalse($this->world->getRegion('Desert Palace')->canComplete($this->world->getLocations(), $no_boots));
	}
}
