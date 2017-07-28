<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class TurtleRockTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');

		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
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
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-1F] Turtle Rock - compass room", true, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-B1] Turtle Rock - big chest", false, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-B1] Turtle Rock - big key room", true, 'BigKeyD7', ['KeyD7', 'KeyD7'], ['BigKeyD7']],

			["[dungeon-D7-B1] Turtle Rock - Roller switch room", false, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", false, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", false, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", false, 'BigKeyD7', [], ['BigKeyD7']],

			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", false, 'BigKeyD7', [], ['BigKeyD7']],

			["Heart Container - Trinexx", false, 'BigKeyD7', [], ['BigKeyD7']],
			["Heart Container - Trinexx", false, 'KeyD7', [], ['KeyD7']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", false, []],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", false, [], ['MoonPearl']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", false, [], ['TitansMitt']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", false, [], ['Hammer']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["[dungeon-D7-1F] Turtle Rock - Chain chomp room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],

			["[dungeon-D7-1F] Turtle Rock - compass room", false, []],
			["[dungeon-D7-1F] Turtle Rock - compass room", false, [], ['MoonPearl']],
			["[dungeon-D7-1F] Turtle Rock - compass room", false, [], ['TitansMitt']],
			["[dungeon-D7-1F] Turtle Rock - compass room", false, [], ['Hammer']],
			["[dungeon-D7-1F] Turtle Rock - compass room", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - compass room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - compass room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - compass room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - compass room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - compass room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - compass room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - compass room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - compass room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],

			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", false, []],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", false, [], ['MoonPearl']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", false, [], ['TitansMitt']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", false, [], ['Hammer']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", false, [], ['FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [left chest]", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],

			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", false, []],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", false, [], ['MoonPearl']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", false, [], ['TitansMitt']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", false, [], ['Hammer']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", false, [], ['FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["[dungeon-D7-1F] Turtle Rock - Map room [right chest]", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],

			["[dungeon-D7-B1] Turtle Rock - big chest", false, []],
			["[dungeon-D7-B1] Turtle Rock - big chest", false, [], ['MoonPearl']],
			["[dungeon-D7-B1] Turtle Rock - big chest", false, [], ['TitansMitt']],
			["[dungeon-D7-B1] Turtle Rock - big chest", false, [], ['Hammer']],
			["[dungeon-D7-B1] Turtle Rock - big chest", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-B1] Turtle Rock - big chest", false, [], ['BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big chest", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big chest", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big chest", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big chest", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big chest", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big chest", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big chest", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big chest", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["[dungeon-D7-B1] Turtle Rock - big key room", false, []],
			["[dungeon-D7-B1] Turtle Rock - big key room", false, [], ['MoonPearl']],
			["[dungeon-D7-B1] Turtle Rock - big key room", false, [], ['TitansMitt']],
			["[dungeon-D7-B1] Turtle Rock - big key room", false, [], ['Hammer']],
			["[dungeon-D7-B1] Turtle Rock - big key room", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-B1] Turtle Rock - big key room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big key room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big key room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big key room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big key room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big key room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big key room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["[dungeon-D7-B1] Turtle Rock - big key room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],

			["[dungeon-D7-B1] Turtle Rock - Roller switch room", false, []],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", false, [], ['MoonPearl']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", false, [], ['TitansMitt']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", false, [], ['Hammer']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", false, [], ['BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B1] Turtle Rock - Roller switch room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", false, []],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", false, [], ['MoonPearl']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", false, [], ['TitansMitt']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", false, [], ['Hammer']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", false, [], ['Lamp']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", false, [], ['BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom left chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", false, []],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", false, [], ['MoonPearl']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", false, [], ['TitansMitt']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", false, [], ['Hammer']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", false, [], ['Lamp']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", false, [], ['BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [bottom right chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", false, []],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", false, [], ['MoonPearl']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", false, [], ['TitansMitt']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", false, [], ['Hammer']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", false, [], ['Lamp']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", false, [], ['BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top left chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", false, []],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", false, [], ['MoonPearl']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", false, [], ['TitansMitt']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", false, [], ['Hammer']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", false, [], ['CaneOfSomaria']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", false, [], ['Lamp']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", false, [], ['BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["[dungeon-D7-B2] Turtle Rock - Eye bridge room [top right chest]", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Heart Container - Trinexx", false, []],
			["Heart Container - Trinexx", false, [], ['MoonPearl']],
			["Heart Container - Trinexx", false, [], ['TitansMitt']],
			["Heart Container - Trinexx", false, [], ['Hammer']],
			["Heart Container - Trinexx", false, [], ['CaneOfSomaria']],
			["Heart Container - Trinexx", false, [], ['IceRod']],
			["Heart Container - Trinexx", false, [], ['FireRod']],
			["Heart Container - Trinexx", false, [], ['Lamp']],
			["Heart Container - Trinexx", false, [], ['BigKeyD7']],
			["Heart Container - Trinexx", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Heart Container - Trinexx", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Heart Container - Trinexx", true, ['IceRod', 'FireRod', 'Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Heart Container - Trinexx", true, ['IceRod', 'FireRod', 'Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
		];
	}
}
