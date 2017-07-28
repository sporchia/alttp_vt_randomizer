<?php namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class GanonsTowerTest extends TestCase {
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
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - north of teleport room", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - map room", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - big chest", false, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", false, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", false, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", false, 'BigKeyA2', [], ['BigKeyA2']],

			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", false, 'BigKeyA2', [], ['BigKeyA2']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", false, []],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", false, [], ['PegasusBoots']],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, ['MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down left staircase from entrance", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [top right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of gap room [bottom right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - west of teleport room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - north of teleport room", false, []],
			["[dungeon-A2-1F] Ganon's Tower - north of teleport room", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - north of teleport room", false, [], ['Hookshot']],
			["[dungeon-A2-1F] Ganon's Tower - north of teleport room", true, ['KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of teleport room", true, ['KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of teleport room", true, ['KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - north of teleport room", true, ['KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - map room", false, []],
			["[dungeon-A2-1F] Ganon's Tower - map room", false, [], ['Hammer']],
			["[dungeon-A2-1F] Ganon's Tower - map room", false, [], ['Hookshot', 'PegasusBoots']],
			["[dungeon-A2-1F] Ganon's Tower - map room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - map room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - map room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - map room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - map room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - map room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - map room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - map room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - big chest", false, []],
			["[dungeon-A2-1F] Ganon's Tower - big chest", false, [], ['BigKeyA2']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - big chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, ['MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, ['MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - down right staircase from entrance [right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - above Armos", false, []],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - above Armos", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", false, []],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", false, [], ['CaneOfSomaria']],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, ['MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - east of down right staircase from entrance", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", false, [], ['FireRod']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", false, [], ['FireRod']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [top right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", false, [], ['FireRod']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", false, []],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", false, [], ['FireRod']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-1F] Ganon's Tower - compass room [bottom right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", false, []],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", false, []],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [left chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", false, []],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-B1] Ganon's Tower - north of Armos room [right chest]", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", false, []],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", false, [], ['AnyBow']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", false, [], ['BigKeyA2']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top left chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", false, []],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", false, [], ['AnyBow']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", false, [], ['BigKeyA2']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - north of falling floor four torches [top right chest]", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", false, []],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", false, [], ['AnyBow']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", false, [], ['BigKeyA2']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - before Moldorm", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", false, []],
			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", false, [], ['Hookshot']],
			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", false, [], ['AnyBow']],
			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", false, [], ['BigKeyA2']],
			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
			["[dungeon-A2-6F] Ganon's Tower - Moldorm room", true, ['Bow', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
		];
	}
}
