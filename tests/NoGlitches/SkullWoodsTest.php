<?php namespace NoGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NoGlitches
 */
class SkullWoodsTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = World::factory('standard', 'test_rules', 'NoGlitches');
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
	 * @param array $keys
	 * @param string $big_key
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
			["Skull Woods - Big Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Big Key Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Compass Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Map Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Bridge Room", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Pot Prison", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Pinball Room", false, 'BigKeyD3', [], ['BigKeyD3']],
			["Skull Woods - Pinball Room", true, 'KeyD3', [], ['KeyD3']],

			["Skull Woods - Boss", true, 'BigKeyD3', [], ['BigKeyD3']],
			["Skull Woods - Boss", false, 'KeyD3', [], ['KeyD3']],
		];
	}

	public function accessPool() {
		return [
			["Skull Woods - Big Chest", false, []],
			["Skull Woods - Big Chest", false, [], ['MoonPearl']],
			["Skull Woods - Big Chest", false, [], ['BigKeyD3']],
			["Skull Woods - Big Chest", true, ['MoonPearl', 'TitansMitt', 'BigKeyD3']],
			["Skull Woods - Big Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD3']],
			["Skull Woods - Big Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD3']],
			["Skull Woods - Big Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD3']],
			["Skull Woods - Big Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'BigKeyD3']],
			["Skull Woods - Big Chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD3']],
			["Skull Woods - Big Chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD3']],
			["Skull Woods - Big Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD3']],

			["Skull Woods - Big Key Chest", false, []],
			["Skull Woods - Big Key Chest", false, [], ['MoonPearl']],
			["Skull Woods - Big Key Chest", true, ['MoonPearl', 'TitansMitt']],
			["Skull Woods - Big Key Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Skull Woods - Big Key Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Skull Woods - Big Key Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Skull Woods - Big Key Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Skull Woods - Big Key Chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Skull Woods - Big Key Chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Skull Woods - Big Key Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Skull Woods - Compass Chest", false, []],
			["Skull Woods - Compass Chest", false, [], ['MoonPearl']],
			["Skull Woods - Compass Chest", true, ['MoonPearl', 'TitansMitt']],
			["Skull Woods - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Skull Woods - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Skull Woods - Compass Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Skull Woods - Compass Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Skull Woods - Compass Chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Skull Woods - Compass Chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Skull Woods - Compass Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Skull Woods - Map Chest", false, []],
			["Skull Woods - Map Chest", false, [], ['MoonPearl']],
			["Skull Woods - Map Chest", true, ['MoonPearl', 'TitansMitt']],
			["Skull Woods - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Skull Woods - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Skull Woods - Map Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Skull Woods - Map Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Skull Woods - Map Chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Skull Woods - Map Chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Skull Woods - Map Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Skull Woods - Bridge Room", false, []],
			["Skull Woods - Bridge Room", false, [], ['MoonPearl']],
			["Skull Woods - Bridge Room", false, [], ['FireRod']],
			["Skull Woods - Bridge Room", true, ['MoonPearl', 'TitansMitt', 'FireRod']],
			["Skull Woods - Bridge Room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Skull Woods - Bridge Room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod']],
			["Skull Woods - Bridge Room", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'FireRod']],
			["Skull Woods - Bridge Room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod']],
			["Skull Woods - Bridge Room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod']],
			["Skull Woods - Bridge Room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod']],
			["Skull Woods - Bridge Room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod']],

			["Skull Woods - Pot Prison", false, []],
			["Skull Woods - Pot Prison", false, [], ['MoonPearl']],
			["Skull Woods - Pot Prison", true, ['MoonPearl', 'TitansMitt']],
			["Skull Woods - Pot Prison", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Skull Woods - Pot Prison", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Skull Woods - Pot Prison", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Skull Woods - Pot Prison", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Skull Woods - Pot Prison", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Skull Woods - Pot Prison", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Skull Woods - Pot Prison", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Skull Woods - Pinball Room", false, []],
			["Skull Woods - Pinball Room", false, [], ['MoonPearl']],
			["Skull Woods - Pinball Room", true, ['MoonPearl', 'TitansMitt']],
			["Skull Woods - Pinball Room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Skull Woods - Pinball Room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Skull Woods - Pinball Room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Skull Woods - Pinball Room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Skull Woods - Pinball Room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Skull Woods - Pinball Room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Skull Woods - Pinball Room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Skull Woods - Boss", false, []],
			["Skull Woods - Boss", false, [], ['MoonPearl']],
			["Skull Woods - Boss", false, [], ['FireRod']],
			["Skull Woods - Boss", false, [], ['AnySword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L1Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'MasterSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L3Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L4Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L1Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'MasterSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L3Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L4Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L1Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'MasterSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L3Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L4Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L1Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'MasterSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L3Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L4Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L1Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'MasterSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L3Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L4Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L1Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'MasterSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L3Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L4Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L1Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'MasterSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L3Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L4Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L1Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'MasterSword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L3Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L4Sword']],
			["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'ProgressiveSword']],
		];
	}

	 /**
	 * @dataProvider dungeonItemsPool
	 */
	public function testRegionLockedItems(bool $access, string $item_name, bool $free = null, string $config = null) {
		if ($config) {
			config(["alttp.test_rules.$config" => $free]);
		}

		$this->assertEquals($access, $this->world->getRegion('Skull Woods')->canFill(Item::get($item_name)));
	}

	public function dungeonItemsPool() {
		return [
			[true, 'Key'],
			[false, 'KeyH2'],
			[false, 'KeyH1'],
			[false, 'KeyP1'],
			[false, 'KeyP2'],
			[false, 'KeyA1'],
			[false, 'KeyD2'],
			[false, 'KeyD1'],
			[false, 'KeyD6'],
			[true, 'KeyD3'],
			[false, 'KeyD5'],
			[false, 'KeyP3'],
			[false, 'KeyD4'],
			[false, 'KeyD7'],
			[false, 'KeyA2'],

			[true, 'BigKey'],
			[false, 'BigKeyH2'],
			[false, 'BigKeyH1'],
			[false, 'BigKeyP1'],
			[false, 'BigKeyP2'],
			[false, 'BigKeyA1'],
			[false, 'BigKeyD2'],
			[false, 'BigKeyD1'],
			[false, 'BigKeyD6'],
			[true, 'BigKeyD3'],
			[false, 'BigKeyD5'],
			[false, 'BigKeyP3'],
			[false, 'BigKeyD4'],
			[false, 'BigKeyD7'],
			[false, 'BigKeyA2'],

			[true, 'Map', false, 'region.wildMaps'],
			[true, 'Map', true, 'region.wildMaps'],
			[false, 'MapH2', false, 'region.wildMaps'],
			[true, 'MapH2', true, 'region.wildMaps'],
			[false, 'MapH1', false, 'region.wildMaps'],
			[true, 'MapH1', true, 'region.wildMaps'],
			[false, 'MapP1', false, 'region.wildMaps'],
			[true, 'MapP1', true, 'region.wildMaps'],
			[false, 'MapP2', false, 'region.wildMaps'],
			[true, 'MapP2', true, 'region.wildMaps'],
			[false, 'MapA1', false, 'region.wildMaps'],
			[true, 'MapA1', true, 'region.wildMaps'],
			[false, 'MapD2', false, 'region.wildMaps'],
			[true, 'MapD2', true, 'region.wildMaps'],
			[false, 'MapD1', false, 'region.wildMaps'],
			[true, 'MapD1', true, 'region.wildMaps'],
			[false, 'MapD6', false, 'region.wildMaps'],
			[true, 'MapD6', true, 'region.wildMaps'],
			[true, 'MapD3', false, 'region.wildMaps'],
			[true, 'MapD3', true, 'region.wildMaps'],
			[false, 'MapD5', false, 'region.wildMaps'],
			[true, 'MapD5', true, 'region.wildMaps'],
			[false, 'MapP3', false, 'region.wildMaps'],
			[true, 'MapP3', true, 'region.wildMaps'],
			[false, 'MapD4', false, 'region.wildMaps'],
			[true, 'MapD4', true, 'region.wildMaps'],
			[false, 'MapD7', false, 'region.wildMaps'],
			[true, 'MapD7', true, 'region.wildMaps'],
			[false, 'MapA2', false, 'region.wildMaps'],
			[true, 'MapA2', true, 'region.wildMaps'],

			[true, 'Compass', false, 'region.wildCompasses'],
			[true, 'Compass', true, 'region.wildCompasses'],
			[false, 'CompassH2', false, 'region.wildCompasses'],
			[true, 'CompassH2', true, 'region.wildCompasses'],
			[false, 'CompassH1', false, 'region.wildCompasses'],
			[true, 'CompassH1', true, 'region.wildCompasses'],
			[false, 'CompassP1', false, 'region.wildCompasses'],
			[true, 'CompassP1', true, 'region.wildCompasses'],
			[false, 'CompassP2', false, 'region.wildCompasses'],
			[true, 'CompassP2', true, 'region.wildCompasses'],
			[false, 'CompassA1', false, 'region.wildCompasses'],
			[true, 'CompassA1', true, 'region.wildCompasses'],
			[false, 'CompassD2', false, 'region.wildCompasses'],
			[true, 'CompassD2', true, 'region.wildCompasses'],
			[false, 'CompassD1', false, 'region.wildCompasses'],
			[true, 'CompassD1', true, 'region.wildCompasses'],
			[false, 'CompassD6', false, 'region.wildCompasses'],
			[true, 'CompassD6', true, 'region.wildCompasses'],
			[true, 'CompassD3', false, 'region.wildCompasses'],
			[true, 'CompassD3', true, 'region.wildCompasses'],
			[false, 'CompassD5', false, 'region.wildCompasses'],
			[true, 'CompassD5', true, 'region.wildCompasses'],
			[false, 'CompassP3', false, 'region.wildCompasses'],
			[true, 'CompassP3', true, 'region.wildCompasses'],
			[false, 'CompassD4', false, 'region.wildCompasses'],
			[true, 'CompassD4', true, 'region.wildCompasses'],
			[false, 'CompassD7', false, 'region.wildCompasses'],
			[true, 'CompassD7', true, 'region.wildCompasses'],
			[false, 'CompassA2', false, 'region.wildCompasses'],
			[true, 'CompassA2', true, 'region.wildCompasses'],
		];
	}
}
