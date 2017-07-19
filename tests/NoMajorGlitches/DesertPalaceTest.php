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

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Key filling
	public function testBigKeyCantBeRightSideTopIfTorchHasKeyAndNoBoots() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")
			->fill(Item::get('BigKey'), $this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigKeyCantBeRightSideTopIfKeyInBigChest() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	public function testBigKeyCantBeRightSideBottomIfTorchHasKeyAndNoBoots() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")
			->fill(Item::get('BigKey'), $this->allItemsExcept(['PegasusBoots'])));
	}

	public function testBigKeyCantBeRightSideBottomIfKeyInBigChest() {
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[dungeon-L2-B1] Desert Palace - compass room")
			->fill(Item::get('BigKey'), $this->allItems()));
	}

	/**
	 * @param bool $access
	 * @param array $items
	 * @param array $except
	 *
	 * @dataProvider entryPool
	 */
	public function testEntry(bool $access, array $items, array $except = []) {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}

		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getRegion('Desert Palace')
			->canEnter($this->world->getLocations(), $this->collected));
	}

	public function entryPool() {
		return [
			[false, []],
			[true, ['BookOfMudora']],
			[true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			[true, ['Flute', 'MagicMirror', 'TitansMitt']],
		];
	}

	/**
	 * @param bool $access
	 * @param array $items
	 * @param array $except
	 * @param array $keys
	 * @param string $big_key
	 *
	 * @dataProvider completionPool
	 */
	public function testCompletion(bool $access, array $items = [], array $except = [], array $keys = [], string $big_key = "[dungeon-L2-B1] Desert Palace - Big key room") {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}

		foreach ($keys as $key_location) {
			$this->world->getLocation($key_location)->setItem(Item::get('Key'));
		}

		$this->world->getLocation($big_key)->setItem(Item::get('BigKey'));

		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getRegion('Desert Palace')
			->canComplete($this->world->getLocations(), $this->collected));
	}

	public function completionPool() {
		return [
			// Test Boots requirements based on key placement
			[false, [], [], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Big key room"],
			[true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Big key room"],
			[false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			[true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - compass room"],
			[false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - Big key room"],
			[false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - Map room"],
			[false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - compass room"],
			[true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - big chest"], "[dungeon-L2-B1] Desert Palace - Map room"],
			[false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - big chest"], "[dungeon-L2-B1] Desert Palace - Small key room"],
		];
	}

	/**
	 * @param string $location
	 * @param bool $access
	 * @param string $item
	 * @param array $items
	 * @param array $except
	 * @param array $keys
	 * @param string $big_key
	 *
	 * @dataProvider fillPool
	 */
	public function testFillLocation(string $location, bool $access, string $item, array $items = [], array $except = [], array $keys = [], string $big_key = "[dungeon-L2-B1] Desert Palace - Big key room") {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}
	
		foreach ($keys as $key_location) {
			$this->world->getLocation($key_location)->setItem(Item::get('Key'));
		}

		$this->world->getLocation($big_key)->setItem(Item::get('BigKey'));

		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getLocation($location)
			->fill(Item::get($item), $this->collected));
	}

	public function fillPool() {
		return [
			["[dungeon-L2-B1] Desert Palace - Big key room", false, 'Key', [], ['Key'], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - compass room", false, 'Key', [], ['Key'], ["[dungeon-L2-B1] Desert Palace - Map room"]],

			["[dungeon-L2-B1] Desert Palace - big chest", false, 'BigKey', [], ['BigKey'], ["[dungeon-L2-B1] Desert Palace - Map room"]],

			["Heart Container - Lanmolas", false, 'BigKey', [], ['BigKey'], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", false, 'Key', [], ['Key'], ["[dungeon-L2-B1] Desert Palace - Map room"]],
		];
	}

	/**
	 * @param string $location
	 * @param bool $access
	 * @param array $items
	 * @param array $except
	 * @param array $keys
	 * @param string $big_key
	 *
	 * @dataProvider accessPool
	 */
	public function testLocation(string $location, bool $access, array $items, array $except = [], array $keys = [], string $big_key = "[dungeon-L2-B1] Desert Palace - Big key room") {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}
	
		foreach ($keys as $key_location) {
			$this->world->getLocation($key_location)->setItem(Item::get('Key'));
		}

		$this->world->getLocation($big_key)->setItem(Item::get('BigKey'));

		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getLocation($location)
			->canAccess($this->collected));
	}

	public function accessPool() {
		return [
			["[dungeon-L2-B1] Desert Palace - Map room", false, [], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - Map room", true, ['BookOfMudora'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - Map room", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - Map room", true, ['Flute', 'MagicMirror', 'TitansMitt'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],

			["[dungeon-L2-B1] Desert Palace - big chest", false, [], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - big chest", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			["[dungeon-L2-B1] Desert Palace - big chest", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['BookOfMudora'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['BookOfMudora', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['Flute', 'MagicMirror', 'TitansMitt'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],

			["[dungeon-L2-B1] Desert Palace - Small key room", false, [], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - Small key room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["[dungeon-L2-B1] Desert Palace - Small key room", true, ['BookOfMudora', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			["[dungeon-L2-B1] Desert Palace - Small key room", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			["[dungeon-L2-B1] Desert Palace - Small key room", true, ['Flute', 'MagicMirror', 'TitansMitt', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],

			["[dungeon-L2-B1] Desert Palace - compass room", true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Big key room"],
			["[dungeon-L2-B1] Desert Palace - compass room", true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			["[dungeon-L2-B1] Desert Palace - compass room", true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - compass room"],
			["[dungeon-L2-B1] Desert Palace - compass room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - Big key room"],
			["[dungeon-L2-B1] Desert Palace - compass room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - Map room"],
			["[dungeon-L2-B1] Desert Palace - compass room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - compass room"],
			["[dungeon-L2-B1] Desert Palace - compass room", true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - big chest"], "[dungeon-L2-B1] Desert Palace - Map room"],
			["[dungeon-L2-B1] Desert Palace - compass room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - big chest"], "[dungeon-L2-B1] Desert Palace - Small key room"],

			["[dungeon-L2-B1] Desert Palace - Big key room", true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Big key room"],
			["[dungeon-L2-B1] Desert Palace - Big key room", true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			["[dungeon-L2-B1] Desert Palace - Big key room", true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Map room"], "[dungeon-L2-B1] Desert Palace - compass room"],
			["[dungeon-L2-B1] Desert Palace - Big key room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - Big key room"],
			["[dungeon-L2-B1] Desert Palace - Big key room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - Map room"],
			["[dungeon-L2-B1] Desert Palace - Big key room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"], "[dungeon-L2-B1] Desert Palace - compass room"],
			["[dungeon-L2-B1] Desert Palace - Big key room", true, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - big chest"], "[dungeon-L2-B1] Desert Palace - Map room"],
			["[dungeon-L2-B1] Desert Palace - Big key room", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - big chest"], "[dungeon-L2-B1] Desert Palace - Small key room"],

			["Heart Container - Lanmolas", false, [], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", false, [], ['Gloves'], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", false, [], ['Lamp', 'FireRod'], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", false, [], ['PegasusBoots'], ["[dungeon-L2-B1] Desert Palace - big chest"], "[dungeon-L2-B1] Desert Palace - Small key room"],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'ProgressiveGlove'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'PowerGlove'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'TitansMitt'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'ProgressiveGlove'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'PowerGlove'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'TitansMitt'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'ProgressiveGlove', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'PowerGlove', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'TitansMitt', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'ProgressiveGlove', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'PowerGlove', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'TitansMitt', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'Lamp', 'TitansMitt'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'FireRod', 'ProgressiveGlove', 'ProgressiveGlove'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'FireRod', 'TitansMitt'], [], ["[dungeon-L2-B1] Desert Palace - Map room"]],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'Lamp', 'TitansMitt', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'FireRod', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'FireRod', 'TitansMitt', 'PegasusBoots'], [], ["[dungeon-L2-B1] Desert Palace - Small key room"]],
		];
	}
}
