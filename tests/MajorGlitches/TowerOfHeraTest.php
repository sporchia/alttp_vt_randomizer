<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class TowerOfHeraTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = World::factory('standard', 'test_rules', 'MajorGlitches');
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
			["Tower of Hera - Big Key Chest", true, 'BigKeyP3', [], ['BigKeyP3']],
			["Tower of Hera - Big Key Chest", true, 'KeyP3', [], ['KeyP3']],

			["Tower of Hera - Basement Cage", true, 'BigKeyP3', [], ['BigKeyP3']],

			["Tower of Hera - Map Chest", true, 'BigKeyP3', [], ['BigKeyP3']],

			["Tower of Hera - Compass Chest", false, 'BigKeyP3', [], ['BigKeyP3']],

			["Tower of Hera - Big Chest", false, 'BigKeyP3', [], ['BigKeyP3']],

			["Tower of Hera - Boss", false, 'BigKeyP3', [], ['BigKeyP3']],
		];
	}

	public function accessPool() {
		return [
			["Tower of Hera - Big Key Chest", false, []],
			["Tower of Hera - Big Key Chest", true, ['Lamp', 'Flute', 'MagicMirror', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['Lamp', 'ProgressiveGlove', 'MagicMirror', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['Lamp', 'PowerGlove', 'MagicMirror', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['Lamp', 'TitansMitt', 'MagicMirror', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['Lamp', 'Flute', 'Hookshot', 'Hammer', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['Lamp', 'ProgressiveGlove', 'Hookshot', 'Hammer', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['Lamp', 'PowerGlove', 'Hookshot', 'Hammer', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['Lamp', 'TitansMitt', 'Hookshot', 'Hammer', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['FireRod', 'Flute', 'MagicMirror', 'KeyP3']],
			["Tower of Hera - Big Key Chest", true, ['FireRod', 'Flute', 'Hookshot', 'Hammer', 'KeyP3']],

			["Tower of Hera - Basement Cage", false, []],
			["Tower of Hera - Basement Cage", true, ['Flute', 'MagicMirror']],
			["Tower of Hera - Basement Cage", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Tower of Hera - Basement Cage", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
			["Tower of Hera - Basement Cage", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
			["Tower of Hera - Basement Cage", true, ['Flute', 'Hookshot', 'Hammer']],
			["Tower of Hera - Basement Cage", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer']],
			["Tower of Hera - Basement Cage", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer']],
			["Tower of Hera - Basement Cage", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer']],

			["Tower of Hera - Map Chest", false, []],
			["Tower of Hera - Map Chest", true, ['Flute', 'MagicMirror']],
			["Tower of Hera - Map Chest", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Tower of Hera - Map Chest", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
			["Tower of Hera - Map Chest", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
			["Tower of Hera - Map Chest", true, ['Flute', 'Hookshot', 'Hammer']],
			["Tower of Hera - Map Chest", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer']],
			["Tower of Hera - Map Chest", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer']],
			["Tower of Hera - Map Chest", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer']],

			["Tower of Hera - Compass Chest", false, []],
			["Tower of Hera - Compass Chest", true, ['Flute', 'MagicMirror', 'BigKeyP3']],
			["Tower of Hera - Compass Chest", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["Tower of Hera - Compass Chest", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["Tower of Hera - Compass Chest", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["Tower of Hera - Compass Chest", true, ['Flute', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Compass Chest", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Compass Chest", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Compass Chest", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],

			["Tower of Hera - Big Chest", false, []],
			["Tower of Hera - Big Chest", true, ['Flute', 'MagicMirror', 'BigKeyP3']],
			["Tower of Hera - Big Chest", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["Tower of Hera - Big Chest", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["Tower of Hera - Big Chest", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["Tower of Hera - Big Chest", true, ['Flute', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Big Chest", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Big Chest", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Big Chest", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],

			["Tower of Hera - Boss", false, []],
			["Tower of Hera - Boss", false, [], ['AnySword', 'Hammer']],
			["Tower of Hera - Boss", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
			["Tower of Hera - Boss", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'L1Sword']],
			["Tower of Hera - Boss", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
			["Tower of Hera - Boss", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
			["Tower of Hera - Boss", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
			["Tower of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L1Sword']],
			["Tower of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
			["Tower of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
			["Tower of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
			["Tower of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
			["Tower of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L1Sword']],
			["Tower of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
			["Tower of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
			["Tower of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
			["Tower of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
			["Tower of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L1Sword']],
			["Tower of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
			["Tower of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
			["Tower of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
			["Tower of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
			["Tower of Hera - Boss", true, ['Flute', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Boss", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Tower of Hera - Boss", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
		];
	}
}
