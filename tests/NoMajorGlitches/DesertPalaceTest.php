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
	 * @param string $location
	 * @param bool $access
	 * @param string $item
	 * @param array $items
	 * @param array $except
	 *
	 * @dataProvider fillPool
	 */
	public function testFillLocation(string $location, bool $access, string $item, array $items = [], array $except = []) {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}

		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getLocation($location)
			->fill(Item::get($item), $this->collected));
	}

	public function fillPool() {
		return [
			["[dungeon-L2-B1] Desert Palace - Big key room", false, 'KeyP2', [], ['KeyP2']],
			["[dungeon-L2-B1] Desert Palace - compass room", false, 'KeyP2', [], ['KeyP2']],

			["[dungeon-L2-B1] Desert Palace - big chest", false, 'BigKeyP2', [], ['BigKeyP2']],

			["Heart Container - Lanmolas", false, 'BigKeyP2', [], ['BigKeyP2']],
			["Heart Container - Lanmolas", false, 'KeyP2', [], ['KeyP2']],
		];
	}

	/**
	 * @param string $location
	 * @param bool $access
	 * @param array $items
	 * @param array $except
	 *
	 * @dataProvider accessPool
	 */
	public function testLocation(string $location, bool $access, array $items, array $except = []) {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}

		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getLocation($location)
			->canAccess($this->collected));
	}

	public function accessPool() {
		return [
			["[dungeon-L2-B1] Desert Palace - Map room", false, []],
			["[dungeon-L2-B1] Desert Palace - Map room", true, ['BookOfMudora']],
			["[dungeon-L2-B1] Desert Palace - Map room", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-L2-B1] Desert Palace - Map room", true, ['Flute', 'MagicMirror', 'TitansMitt']],

			["[dungeon-L2-B1] Desert Palace - big chest", false, []],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['BookOfMudora', 'BigKeyP2']],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
			["[dungeon-L2-B1] Desert Palace - big chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'BigKeyP2']],

			["[dungeon-L2-B1] Desert Palace - Small key room", false, []],
			["[dungeon-L2-B1] Desert Palace - Small key room", false, [], ['PegasusBoots']],
			["[dungeon-L2-B1] Desert Palace - Small key room", true, ['BookOfMudora', 'PegasusBoots']],
			["[dungeon-L2-B1] Desert Palace - Small key room", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots']],
			["[dungeon-L2-B1] Desert Palace - Small key room", true, ['Flute', 'MagicMirror', 'TitansMitt', 'PegasusBoots']],

			["[dungeon-L2-B1] Desert Palace - compass room", false, []],
			["[dungeon-L2-B1] Desert Palace - compass room", false, [], ['KeyP2']],
			["[dungeon-L2-B1] Desert Palace - compass room", true, ['BookOfMudora', 'KeyP2']],
			["[dungeon-L2-B1] Desert Palace - compass room", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP2']],
			["[dungeon-L2-B1] Desert Palace - compass room", true, ['Flute', 'MagicMirror', 'TitansMitt', 'KeyP2']],

			["[dungeon-L2-B1] Desert Palace - Big key room", false, []],
			["[dungeon-L2-B1] Desert Palace - Big key room", false, [], ['KeyP2']],
			["[dungeon-L2-B1] Desert Palace - Big key room", true, ['BookOfMudora', 'KeyP2']],
			["[dungeon-L2-B1] Desert Palace - Big key room", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP2']],
			["[dungeon-L2-B1] Desert Palace - Big key room", true, ['Flute', 'MagicMirror', 'TitansMitt', 'KeyP2']],

			["Heart Container - Lanmolas", false, []],
			["Heart Container - Lanmolas", false, [], ['BigKeyP2']],
			["Heart Container - Lanmolas", false, [], ['Gloves']],
			["Heart Container - Lanmolas", false, [], ['Lamp', 'FireRod']],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'ProgressiveGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'PowerGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'Lamp', 'TitansMitt', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'ProgressiveGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'PowerGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['BookOfMudora', 'FireRod', 'TitansMitt', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'Lamp', 'TitansMitt', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'FireRod', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['Flute', 'MagicMirror', 'FireRod', 'TitansMitt', 'BigKeyP2']],
		];
	}
}
