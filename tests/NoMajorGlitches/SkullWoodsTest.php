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
			["[dungeon-D3-B1] Skull Woods - big chest", false, 'BigKeyD3', [], ['BigKeyD3']],

			["[dungeon-D3-B1] Skull Woods - Big Key room", true, 'BigKeyD3', [], ['BigKeyD3']],

			["[dungeon-D3-B1] Skull Woods - Compass room", true, 'BigKeyD3', [], ['BigKeyD3']],

			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, 'BigKeyD3', [], ['BigKeyD3']],

			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, 'BigKeyD3', [], ['BigKeyD3']],

			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, 'BigKeyD3', [], ['BigKeyD3']],

			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", false, 'BigKeyD3', [], ['BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, 'KeyD3', [], ['KeyD3']],

			["Heart Container - Mothula", true, 'BigKeyD3', [], ['BigKeyD3']],
			["Heart Container - Mothula", false, 'KeyD3', [], ['KeyD3']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-D3-B1] Skull Woods - big chest", false, []],
			["[dungeon-D3-B1] Skull Woods - big chest", false, [], ['MoonPearl']],
			["[dungeon-D3-B1] Skull Woods - big chest", false, [], ['BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - big chest", true, ['MoonPearl', 'TitansMitt', 'BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - big chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - big chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - big chest", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - big chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - big chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - big chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD3']],
			["[dungeon-D3-B1] Skull Woods - big chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD3']],

			["[dungeon-D3-B1] Skull Woods - Big Key room", false, []],
			["[dungeon-D3-B1] Skull Woods - Big Key room", false, [], ['MoonPearl']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D3-B1] Skull Woods - Compass room", false, []],
			["[dungeon-D3-B1] Skull Woods - Compass room", false, [], ['MoonPearl']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", false, []],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", false, [], ['MoonPearl']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", false, []],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", false, [], ['MoonPearl']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", false, [], ['FireRod']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, ['MoonPearl', 'TitansMitt', 'FireRod']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'FireRod']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod']],
			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod']],

			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", false, []],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", false, [], ['MoonPearl']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", false, []],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", false, [], ['MoonPearl']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Heart Container - Mothula", false, []],
			["Heart Container - Mothula", false, [], ['MoonPearl']],
			["Heart Container - Mothula", false, [], ['FireRod']],
			["Heart Container - Mothula", false, [], ['AnySword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L1Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'MasterSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L3Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L4Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'ProgressiveSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L1Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'MasterSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L3Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L4Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'ProgressiveSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L1Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'MasterSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L3Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L4Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'ProgressiveSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L1Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'MasterSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L3Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L4Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'ProgressiveSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L1Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'MasterSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L3Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'L4Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L1Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'MasterSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L3Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L4Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L1Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'MasterSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L3Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'L4Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'FireRod', 'ProgressiveSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L1Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'MasterSword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L3Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'L4Sword']],
			["Heart Container - Mothula", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'FireRod', 'ProgressiveSword']],
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
			[false, Item::get('MapD2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD1'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD6'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD6'), false, 'region.mapsInDungeons'],
			[true, Item::get('MapD3'), true, 'region.mapsInDungeons'],
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
			[false, Item::get('CompassD2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD1'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD6'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD6'), false, 'region.compassesInDungeons'],
			[true, Item::get('CompassD3'), true, 'region.compassesInDungeons'],
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
