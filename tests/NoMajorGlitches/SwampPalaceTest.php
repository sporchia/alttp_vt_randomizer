<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class SwampPalaceTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
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
			["[dungeon-D2-1F] Swamp Palace - first room", false, 'BigKeyD2', [], ['BigKeyD2']],
			["[dungeon-D2-1F] Swamp Palace - first room", true, 'KeyD2', [], ['KeyD2']],

			["[dungeon-D2-B1] Swamp Palace - big chest", false, 'BigKeyD2', [], ['BigKeyD2']],

			["[dungeon-D2-B1] Swamp Palace - big key room", true, 'BigKeyD2', [], ['BigKeyD2']],

			["[dungeon-D2-B1] Swamp Palace - map room", true, 'BigKeyD2', [], ['BigKeyD2']],

			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", true, 'BigKeyD2', [], ['BigKeyD2']],

			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", true, 'BigKeyD2', [], ['BigKeyD2']],

			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", true, 'BigKeyD2', [], ['BigKeyD2']],

			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", true, 'BigKeyD2', [], ['BigKeyD2']],

			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", true, 'BigKeyD2', [], ['BigKeyD2']],

			["Heart Container - Arrghus", true, 'BigKeyD2', [], ['BigKeyD2']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-D2-1F] Swamp Palace - first room", false, []],
			["[dungeon-D2-1F] Swamp Palace - first room", false, [], ['MagicMirror']],
			["[dungeon-D2-1F] Swamp Palace - first room", false, [], ['MoonPearl']],
			["[dungeon-D2-1F] Swamp Palace - first room", false, [], ['Flippers']],
			["[dungeon-D2-1F] Swamp Palace - first room", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D2-1F] Swamp Palace - first room", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D2-1F] Swamp Palace - first room", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D2-1F] Swamp Palace - first room", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["[dungeon-D2-1F] Swamp Palace - first room", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],
			["[dungeon-D2-1F] Swamp Palace - first room", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hookshot']],

			["[dungeon-D2-B1] Swamp Palace - big chest", false, []],
			["[dungeon-D2-B1] Swamp Palace - big chest", false, [], ['MagicMirror']],
			["[dungeon-D2-B1] Swamp Palace - big chest", false, [], ['MoonPearl']],
			["[dungeon-D2-B1] Swamp Palace - big chest", false, [], ['Flippers']],
			["[dungeon-D2-B1] Swamp Palace - big chest", false, [], ['Hammer']],
			["[dungeon-D2-B1] Swamp Palace - big chest", false, [], ['BigKeyD2']],
			["[dungeon-D2-B1] Swamp Palace - big chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - big chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - big chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - big chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

			["[dungeon-D2-B1] Swamp Palace - big key room", false, []],
			["[dungeon-D2-B1] Swamp Palace - big key room", false, [], ['MagicMirror']],
			["[dungeon-D2-B1] Swamp Palace - big key room", false, [], ['MoonPearl']],
			["[dungeon-D2-B1] Swamp Palace - big key room", false, [], ['Flippers']],
			["[dungeon-D2-B1] Swamp Palace - big key room", false, [], ['Hammer']],
			["[dungeon-D2-B1] Swamp Palace - big key room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - big key room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - big key room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - big key room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

			["[dungeon-D2-B1] Swamp Palace - map room", false, []],
			["[dungeon-D2-B1] Swamp Palace - map room", false, [], ['MagicMirror']],
			["[dungeon-D2-B1] Swamp Palace - map room", false, [], ['MoonPearl']],
			["[dungeon-D2-B1] Swamp Palace - map room", false, [], ['Flippers']],
			["[dungeon-D2-B1] Swamp Palace - map room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D2-B1] Swamp Palace - map room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D2-B1] Swamp Palace - map room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - map room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - map room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - map room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hookshot']],

			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", false, []],
			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", false, [], ['MagicMirror']],
			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", false, [], ['MoonPearl']],
			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", false, [], ['Flippers']],
			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", false, [], ['Hammer']],
			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - push 4 blocks room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", false, []],
			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", false, [], ['MagicMirror']],
			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", false, [], ['MoonPearl']],
			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", false, [], ['Flippers']],
			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", false, [], ['Hammer']],
			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["[dungeon-D2-B1] Swamp Palace - south of hookshot room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", false, []],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", false, [], ['MagicMirror']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", false, [], ['MoonPearl']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", false, [], ['Flippers']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", false, [], ['Hammer']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", false, [], ['Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [left chest]", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", false, []],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", false, [], ['MagicMirror']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", false, [], ['MoonPearl']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", false, [], ['Flippers']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", false, [], ['Hammer']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", false, [], ['Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - flooded room [right chest]", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", false, []],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", false, [], ['MagicMirror']],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", false, [], ['MoonPearl']],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", false, [], ['Flippers']],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", false, [], ['Hammer']],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", false, [], ['Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
			["[dungeon-D2-B2] Swamp Palace - hidden waterfall door room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

			["Heart Container - Arrghus", false, []],
			["Heart Container - Arrghus", false, [], ['MagicMirror']],
			["Heart Container - Arrghus", false, [], ['MoonPearl']],
			["Heart Container - Arrghus", false, [], ['Flippers']],
			["Heart Container - Arrghus", false, [], ['Hammer']],
			["Heart Container - Arrghus", false, [], ['Hookshot']],
			["Heart Container - Arrghus", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
			["Heart Container - Arrghus", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
			["Heart Container - Arrghus", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
			["Heart Container - Arrghus", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
		];
	}

	/**
	 * @dataProvider dungeonItemsPool
	 */
	public function testRegionLockedItems(bool $access, Item $item, bool $free = null, string $config = null) {
		if ($config) {
			config(["alttp.test_rules.$config" => $free]);
		}

		$this->assertEquals($access, $this->world->getRegion('Swamp Palace')->canFill($item));
	}

	public function dungeonItemsPool() {
		return [
			[true, Item::get('Key')],
			[false, Item::get('KeyH2')],
			[false, Item::get('KeyH1')],
			[false, Item::get('KeyP1')],
			[false, Item::get('KeyP2')],
			[false, Item::get('KeyA1')],
			[true, Item::get('KeyD2')],
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
			[false, Item::get('BigKeyP2')],
			[false, Item::get('BigKeyA1')],
			[true, Item::get('BigKeyD2')],
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
			[false, Item::get('MapP2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapP2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapA1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapA1'), false, 'region.mapsInDungeons'],
			[true, Item::get('MapD2'), true, 'region.mapsInDungeons'],
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
			[false, Item::get('CompassP2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassP2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassA1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassA1'), false, 'region.compassesInDungeons'],
			[true, Item::get('CompassD2'), true, 'region.compassesInDungeons'],
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
