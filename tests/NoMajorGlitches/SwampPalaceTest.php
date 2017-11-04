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
			["Swamp Palace - Entrance", false, 'BigKeyD2', [], ['BigKeyD2']],
			["Swamp Palace - Entrance", true, 'KeyD2', [], ['KeyD2']],

			["Swamp Palace - Big Chest", false, 'BigKeyD2', [], ['BigKeyD2']],

			["Swamp Palace - Big Key Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

			["Swamp Palace - Map Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

			["Swamp Palace - West Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

			["Swamp Palace - Compass Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

			["Swamp Palace - Flooded Room - Left", true, 'BigKeyD2', [], ['BigKeyD2']],

			["Swamp Palace - Flooded Room - Right", true, 'BigKeyD2', [], ['BigKeyD2']],

			["Swamp Palace - Waterfall Room", true, 'BigKeyD2', [], ['BigKeyD2']],

			["Swamp Palace - Arrghus", true, 'BigKeyD2', [], ['BigKeyD2']],
		];
	}

	public function accessPool() {
		return [
			["Swamp Palace - Entrance", false, []],
			["Swamp Palace - Entrance", false, [], ['MagicMirror']],
			["Swamp Palace - Entrance", false, [], ['MoonPearl']],
			["Swamp Palace - Entrance", false, [], ['Flippers']],
			["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],
			["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hookshot']],

			["Swamp Palace - Big Chest", false, []],
			["Swamp Palace - Big Chest", false, [], ['MagicMirror']],
			["Swamp Palace - Big Chest", false, [], ['MoonPearl']],
			["Swamp Palace - Big Chest", false, [], ['Flippers']],
			["Swamp Palace - Big Chest", false, [], ['Hammer']],
			["Swamp Palace - Big Chest", false, [], ['BigKeyD2']],
			["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
			["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

			["Swamp Palace - Big Key Chest", false, []],
			["Swamp Palace - Big Key Chest", false, [], ['MagicMirror']],
			["Swamp Palace - Big Key Chest", false, [], ['MoonPearl']],
			["Swamp Palace - Big Key Chest", false, [], ['Flippers']],
			["Swamp Palace - Big Key Chest", false, [], ['Hammer']],
			["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
			["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

			["Swamp Palace - Map Chest", false, []],
			["Swamp Palace - Map Chest", false, [], ['MagicMirror']],
			["Swamp Palace - Map Chest", false, [], ['MoonPearl']],
			["Swamp Palace - Map Chest", false, [], ['Flippers']],
			["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],
			["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hookshot']],

			["Swamp Palace - West Chest", false, []],
			["Swamp Palace - West Chest", false, [], ['MagicMirror']],
			["Swamp Palace - West Chest", false, [], ['MoonPearl']],
			["Swamp Palace - West Chest", false, [], ['Flippers']],
			["Swamp Palace - West Chest", false, [], ['Hammer']],
			["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
			["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

			["Swamp Palace - Compass Chest", false, []],
			["Swamp Palace - Compass Chest", false, [], ['MagicMirror']],
			["Swamp Palace - Compass Chest", false, [], ['MoonPearl']],
			["Swamp Palace - Compass Chest", false, [], ['Flippers']],
			["Swamp Palace - Compass Chest", false, [], ['Hammer']],
			["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
			["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
			["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
			["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

			["Swamp Palace - Flooded Room - Left", false, []],
			["Swamp Palace - Flooded Room - Left", false, [], ['MagicMirror']],
			["Swamp Palace - Flooded Room - Left", false, [], ['MoonPearl']],
			["Swamp Palace - Flooded Room - Left", false, [], ['Flippers']],
			["Swamp Palace - Flooded Room - Left", false, [], ['Hammer']],
			["Swamp Palace - Flooded Room - Left", false, [], ['Hookshot']],
			["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
			["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
			["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
			["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

			["Swamp Palace - Flooded Room - Right", false, []],
			["Swamp Palace - Flooded Room - Right", false, [], ['MagicMirror']],
			["Swamp Palace - Flooded Room - Right", false, [], ['MoonPearl']],
			["Swamp Palace - Flooded Room - Right", false, [], ['Flippers']],
			["Swamp Palace - Flooded Room - Right", false, [], ['Hammer']],
			["Swamp Palace - Flooded Room - Right", false, [], ['Hookshot']],
			["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
			["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
			["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
			["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

			["Swamp Palace - Waterfall Room", false, []],
			["Swamp Palace - Waterfall Room", false, [], ['MagicMirror']],
			["Swamp Palace - Waterfall Room", false, [], ['MoonPearl']],
			["Swamp Palace - Waterfall Room", false, [], ['Flippers']],
			["Swamp Palace - Waterfall Room", false, [], ['Hammer']],
			["Swamp Palace - Waterfall Room", false, [], ['Hookshot']],
			["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
			["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
			["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
			["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

			["Swamp Palace - Arrghus", false, []],
			["Swamp Palace - Arrghus", false, [], ['MagicMirror']],
			["Swamp Palace - Arrghus", false, [], ['MoonPearl']],
			["Swamp Palace - Arrghus", false, [], ['Flippers']],
			["Swamp Palace - Arrghus", false, [], ['Hammer']],
			["Swamp Palace - Arrghus", false, [], ['Hookshot']],
			["Swamp Palace - Arrghus", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
			["Swamp Palace - Arrghus", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
			["Swamp Palace - Arrghus", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
			["Swamp Palace - Arrghus", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
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

			[true, Item::get('Map'), false, 'region.wildMaps'],
			[true, Item::get('Map'), true, 'region.wildMaps'],
			[false, Item::get('MapH2'), false, 'region.wildMaps'],
			[true, Item::get('MapH2'), true, 'region.wildMaps'],
			[false, Item::get('MapH1'), false, 'region.wildMaps'],
			[true, Item::get('MapH1'), true, 'region.wildMaps'],
			[false, Item::get('MapP1'), false, 'region.wildMaps'],
			[true, Item::get('MapP1'), true, 'region.wildMaps'],
			[false, Item::get('MapP2'), false, 'region.wildMaps'],
			[true, Item::get('MapP2'), true, 'region.wildMaps'],
			[false, Item::get('MapA1'), false, 'region.wildMaps'],
			[true, Item::get('MapA1'), true, 'region.wildMaps'],
			[true, Item::get('MapD2'), false, 'region.wildMaps'],
			[true, Item::get('MapD2'), true, 'region.wildMaps'],
			[false, Item::get('MapD1'), false, 'region.wildMaps'],
			[true, Item::get('MapD1'), true, 'region.wildMaps'],
			[false, Item::get('MapD6'), false, 'region.wildMaps'],
			[true, Item::get('MapD6'), true, 'region.wildMaps'],
			[false, Item::get('MapD3'), false, 'region.wildMaps'],
			[true, Item::get('MapD3'), true, 'region.wildMaps'],
			[false, Item::get('MapD5'), false, 'region.wildMaps'],
			[true, Item::get('MapD5'), true, 'region.wildMaps'],
			[false, Item::get('MapP3'), false, 'region.wildMaps'],
			[true, Item::get('MapP3'), true, 'region.wildMaps'],
			[false, Item::get('MapD4'), false, 'region.wildMaps'],
			[true, Item::get('MapD4'), true, 'region.wildMaps'],
			[false, Item::get('MapD7'), false, 'region.wildMaps'],
			[true, Item::get('MapD7'), true, 'region.wildMaps'],
			[false, Item::get('MapA2'), false, 'region.wildMaps'],
			[true, Item::get('MapA2'), true, 'region.wildMaps'],

			[true, Item::get('Compass'), false, 'region.wildCompasses'],
			[true, Item::get('Compass'), true, 'region.wildCompasses'],
			[false, Item::get('CompassH2'), false, 'region.wildCompasses'],
			[true, Item::get('CompassH2'), true, 'region.wildCompasses'],
			[false, Item::get('CompassH1'), false, 'region.wildCompasses'],
			[true, Item::get('CompassH1'), true, 'region.wildCompasses'],
			[false, Item::get('CompassP1'), false, 'region.wildCompasses'],
			[true, Item::get('CompassP1'), true, 'region.wildCompasses'],
			[false, Item::get('CompassP2'), false, 'region.wildCompasses'],
			[true, Item::get('CompassP2'), true, 'region.wildCompasses'],
			[false, Item::get('CompassA1'), false, 'region.wildCompasses'],
			[true, Item::get('CompassA1'), true, 'region.wildCompasses'],
			[true, Item::get('CompassD2'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD2'), true, 'region.wildCompasses'],
			[false, Item::get('CompassD1'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD1'), true, 'region.wildCompasses'],
			[false, Item::get('CompassD6'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD6'), true, 'region.wildCompasses'],
			[false, Item::get('CompassD3'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD3'), true, 'region.wildCompasses'],
			[false, Item::get('CompassD5'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD5'), true, 'region.wildCompasses'],
			[false, Item::get('CompassP3'), false, 'region.wildCompasses'],
			[true, Item::get('CompassP3'), true, 'region.wildCompasses'],
			[false, Item::get('CompassD4'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD4'), true, 'region.wildCompasses'],
			[false, Item::get('CompassD7'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD7'), true, 'region.wildCompasses'],
			[false, Item::get('CompassA2'), false, 'region.wildCompasses'],
			[true, Item::get('CompassA2'), true, 'region.wildCompasses'],
		];
	}
}
