<?php namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class SwampPalaceTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'OverworldGlitches');
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
}
