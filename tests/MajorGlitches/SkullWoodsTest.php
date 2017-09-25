<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class SkullWoodsTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');
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
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Big Key room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D3-B1] Skull Woods - Compass room", false, []],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Compass room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", false, []],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - east of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D3-B1] Skull Woods - Entrance to part 2", false, []],
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
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - Gibdo/Stalfos room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", false, []],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D3-B1] Skull Woods - south of Fire Rod room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Heart Container - Mothula", false, []],
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
}
