<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class SkullWoodsTest extends TestCase {
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
			["Skull Woods - Big Chest", false, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Big Key Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Compass Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Map Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Bridge Room", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Pot Prison", true, 'BigKeyD3', [], ['BigKeyD3']],

			["Skull Woods - Pinball Room", false, 'BigKeyD3', [], ['BigKeyD3']],
			["Skull Woods - Pinball Room", true, 'KeyD3', [], ['KeyD3']],

			["Skull Woods - Mothula", true, 'BigKeyD3', [], ['BigKeyD3']],
			["Skull Woods - Mothula", false, 'KeyD3', [], ['KeyD3']],
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

			["Skull Woods - Mothula", false, []],
			["Skull Woods - Mothula", false, [], ['MoonPearl']],
			["Skull Woods - Mothula", false, [], ['FireRod']],
			["Skull Woods - Mothula", false, [], ['AnySword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L1Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'MasterSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L3Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L4Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L1Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'MasterSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L3Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L4Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L1Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'MasterSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L3Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L4Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L1Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'MasterSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L3Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L4Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L1Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'MasterSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L3Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L4Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L1Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'MasterSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L3Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L4Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L1Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'MasterSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L3Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L4Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L1Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'MasterSword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L3Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L4Sword']],
			["Skull Woods - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'ProgressiveSword']],
		];
	}

	 /**
	 * @dataProvider dungeonItemsPool
	 */
	public function testRegionLockedItems(bool $access, Item $item, bool $free = null, string $config = null) {
		if ($config) {
			config(["alttp.test_rules.$config" => $free]);
		}

		$this->assertEquals($access, $this->world->getRegion('Skull Woods')->canFill($item));
	}

	public function dungeonItemsPool() {
		return [
			[true, Item::get('Key')],
			[false, Item::get('KeyH2')],
			[false, Item::get('KeyH1')],
			[false, Item::get('KeyP1')],
			[false, Item::get('KeyP2')],
			[false, Item::get('KeyA1')],
			[false, Item::get('KeyD2')],
			[false, Item::get('KeyD1')],
			[false, Item::get('KeyD6')],
			[true, Item::get('KeyD3')],
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
			[false, Item::get('BigKeyD2')],
			[false, Item::get('BigKeyD1')],
			[false, Item::get('BigKeyD6')],
			[true, Item::get('BigKeyD3')],
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
			[false, Item::get('MapD2'), false, 'region.wildMaps'],
			[true, Item::get('MapD2'), true, 'region.wildMaps'],
			[false, Item::get('MapD1'), false, 'region.wildMaps'],
			[true, Item::get('MapD1'), true, 'region.wildMaps'],
			[false, Item::get('MapD6'), false, 'region.wildMaps'],
			[true, Item::get('MapD6'), true, 'region.wildMaps'],
			[true, Item::get('MapD3'), false, 'region.wildMaps'],
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
			[false, Item::get('CompassD2'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD2'), true, 'region.wildCompasses'],
			[false, Item::get('CompassD1'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD1'), true, 'region.wildCompasses'],
			[false, Item::get('CompassD6'), false, 'region.wildCompasses'],
			[true, Item::get('CompassD6'), true, 'region.wildCompasses'],
			[true, Item::get('CompassD3'), false, 'region.wildCompasses'],
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
