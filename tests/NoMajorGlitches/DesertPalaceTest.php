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
			["Heart Container - Lanmolas", false, [], ['KeyP2']],
			["Heart Container - Lanmolas", false, [], ['BigKeyP2']],
			["Heart Container - Lanmolas", false, [], ['Gloves']],
			["Heart Container - Lanmolas", false, [], ['Lamp', 'FireRod']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'BookOfMudora', 'Lamp', 'ProgressiveGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'BookOfMudora', 'Lamp', 'PowerGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'BookOfMudora', 'Lamp', 'TitansMitt', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'BookOfMudora', 'FireRod', 'ProgressiveGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'BookOfMudora', 'FireRod', 'PowerGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'BookOfMudora', 'FireRod', 'TitansMitt', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'Flute', 'MagicMirror', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'Flute', 'MagicMirror', 'Lamp', 'TitansMitt', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'Flute', 'MagicMirror', 'FireRod', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
			["Heart Container - Lanmolas", true, ['KeyP2', 'Flute', 'MagicMirror', 'FireRod', 'TitansMitt', 'BigKeyP2']],
		];
	}

	/**
	 * @dataProvider dungeonItemsPool
	 */
	public function testRegionLockedItems(bool $access, Item $item, bool $free = null, string $config = null) {
		if ($config) {
			config(["alttp.test_rules.$config" => $free]);
		}

		$this->assertEquals($access, $this->world->getRegion('Desert Palace')->canFill($item));
	}

	public function dungeonItemsPool() {
		return [
			[true, Item::get('Key')],
			[false, Item::get('KeyH2')],
			[false, Item::get('KeyH1')],
			[false, Item::get('KeyP1')],
			[true, Item::get('KeyP2')],
			[false, Item::get('KeyA1')],
			[false, Item::get('KeyD2')],
			[false, Item::get('KeyD1')],
			[false, Item::get('KeyD6')],
			[false, Item::get('KeyD3')],
			[false, Item::get('KeyD5')],
			[false, Item::get('KeyP3')],
			[false, Item::get('KeyD4')],
			[false, Item::get('KeyD7')],
			[false, Item::get('KeyA2')],

			[true, Item::get('BigKey')],
			[false, Item::get('BigKeyH2')],
			[false, Item::get('BigKeyH1')],
			[false, Item::get('BigKeyP1')],
			[true, Item::get('BigKeyP2')],
			[false, Item::get('BigKeyA1')],
			[false, Item::get('BigKeyD2')],
			[false, Item::get('BigKeyD1')],
			[false, Item::get('BigKeyD6')],
			[false, Item::get('BigKeyD3')],
			[false, Item::get('BigKeyD5')],
			[false, Item::get('BigKeyP3')],
			[false, Item::get('BigKeyD4')],
			[false, Item::get('BigKeyD7')],
			[false, Item::get('BigKeyA2')],

			[true, Item::get('Map'), true, 'region.mapsInDungeons'],
			[true, Item::get('Map'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapH2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapH2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapH1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapH1'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapP1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapP1'), false, 'region.mapsInDungeons'],
			[true, Item::get('MapP2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapP2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapA1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapA1'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD1'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD6'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD6'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD3'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD3'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD5'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD5'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapP3'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapP3'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD4'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD4'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD7'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD7'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapA2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapA2'), false, 'region.mapsInDungeons'],

			[true, Item::get('Compass'), true, 'region.compassesInDungeons'],
			[true, Item::get('Compass'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassH2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassH2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassH1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassH1'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassP1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassP1'), false, 'region.compassesInDungeons'],
			[true, Item::get('CompassP2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassP2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassA1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassA1'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD1'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD6'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD6'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD3'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD3'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD5'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD5'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassP3'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassP3'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD4'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD4'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD7'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD7'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassA2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassA2'), false, 'region.compassesInDungeons'],
		];
	}
}
