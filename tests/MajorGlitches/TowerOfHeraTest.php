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
			["[dungeon-L3-1F] Tower of Hera - first floor", true, 'BigKeyP3', [], ['BigKeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", false, 'KeyP3', [], ['KeyP3']],

			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, 'BigKeyP3', [], ['BigKeyP3']],

			["[dungeon-L3-2F] Tower of Hera - Entrance", true, 'BigKeyP3', [], ['BigKeyP3']],

			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", false, 'BigKeyP3', [], ['BigKeyP3']],

			["[dungeon-L3-4F] Tower of Hera - big chest", false, 'BigKeyP3', [], ['BigKeyP3']],

			["Heart Container - Moldorm", false, 'BigKeyP3', [], ['BigKeyP3']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-L3-1F] Tower of Hera - first floor", false, []],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['Lamp', 'Flute', 'MagicMirror', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['Lamp', 'ProgressiveGlove', 'MagicMirror', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['Lamp', 'PowerGlove', 'MagicMirror', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['Lamp', 'TitansMitt', 'MagicMirror', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['Lamp', 'Flute', 'Hookshot', 'Hammer', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['Lamp', 'ProgressiveGlove', 'Hookshot', 'Hammer', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['Lamp', 'PowerGlove', 'Hookshot', 'Hammer', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['Lamp', 'TitansMitt', 'Hookshot', 'Hammer', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['FireRod', 'Flute', 'MagicMirror', 'KeyP3']],
			["[dungeon-L3-1F] Tower of Hera - first floor", true, ['FireRod', 'Flute', 'Hookshot', 'Hammer', 'KeyP3']],

			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, []],
			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, ['Flute', 'MagicMirror']],
			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, ['Flute', 'Hookshot', 'Hammer']],
			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer']],
			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer']],
			["[dungeon-L3-1F] Tower of Hera - freestanding key", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer']],

			["[dungeon-L3-2F] Tower of Hera - Entrance", true, []],
			["[dungeon-L3-2F] Tower of Hera - Entrance", true, ['Flute', 'MagicMirror']],
			["[dungeon-L3-2F] Tower of Hera - Entrance", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[dungeon-L3-2F] Tower of Hera - Entrance", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
			["[dungeon-L3-2F] Tower of Hera - Entrance", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
			["[dungeon-L3-2F] Tower of Hera - Entrance", true, ['Flute', 'Hookshot', 'Hammer']],
			["[dungeon-L3-2F] Tower of Hera - Entrance", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer']],
			["[dungeon-L3-2F] Tower of Hera - Entrance", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer']],
			["[dungeon-L3-2F] Tower of Hera - Entrance", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer']],

			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", false, []],
			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", true, ['Flute', 'MagicMirror', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", true, ['Flute', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - 4F [small chest]", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],

			["[dungeon-L3-4F] Tower of Hera - big chest", false, []],
			["[dungeon-L3-4F] Tower of Hera - big chest", true, ['Flute', 'MagicMirror', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - big chest", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - big chest", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - big chest", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - big chest", true, ['Flute', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - big chest", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - big chest", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["[dungeon-L3-4F] Tower of Hera - big chest", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],

			["Heart Container - Moldorm", false, []],
			["Heart Container - Moldorm", false, [], ['AnySword', 'Hammer']],
			["Heart Container - Moldorm", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
			["Heart Container - Moldorm", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'L1Sword']],
			["Heart Container - Moldorm", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
			["Heart Container - Moldorm", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
			["Heart Container - Moldorm", true, ['Flute', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
			["Heart Container - Moldorm", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L1Sword']],
			["Heart Container - Moldorm", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
			["Heart Container - Moldorm", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
			["Heart Container - Moldorm", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
			["Heart Container - Moldorm", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
			["Heart Container - Moldorm", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L1Sword']],
			["Heart Container - Moldorm", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
			["Heart Container - Moldorm", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
			["Heart Container - Moldorm", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
			["Heart Container - Moldorm", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
			["Heart Container - Moldorm", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L1Sword']],
			["Heart Container - Moldorm", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
			["Heart Container - Moldorm", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
			["Heart Container - Moldorm", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
			["Heart Container - Moldorm", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
			["Heart Container - Moldorm", true, ['Flute', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Heart Container - Moldorm", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Heart Container - Moldorm", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
			["Heart Container - Moldorm", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
		];
	}
}
