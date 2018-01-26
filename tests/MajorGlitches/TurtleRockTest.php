<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class TurtleRockTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');

		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testCanEnterWithEverything() {
		$this->assertTrue($this->world->getRegion('Turtle Rock')
			->canEnter($this->world->getLocations(), $this->allItems()));
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
			["Turtle Rock - Chain Chomps", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Compass Chest", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Roller Room - Left", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Roller Room - Right", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Big Chest", false, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Big Key Chest", true, 'BigKeyD7', ['KeyD7', 'KeyD7'], ['BigKeyD7']],

			["Turtle Rock - Crystaroller Room", false, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Eye Bridge - Bottom Left", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Eye Bridge - Bottom Right", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Eye Bridge - Top Left", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Eye Bridge - Top Right", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Trinexx", false, 'BigKeyD7', [], ['BigKeyD7']],
			["Turtle Rock - Trinexx", false, 'KeyD7', [], ['KeyD7']],
		];
	}

	public function accessPool() {
		return [
			["Turtle Rock - Chain Chomps", false, []],
			["Turtle Rock - Chain Chomps", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],

			["Turtle Rock - Compass Chest", false, []],
			["Turtle Rock - Compass Chest", false, [], ['CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],

			["Turtle Rock - Roller Room - Left", false, []],
			["Turtle Rock - Roller Room - Left", false, [], ['CaneOfSomaria']],
			["Turtle Rock - Roller Room - Left", false, [], ['FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],

			["Turtle Rock - Roller Room - Right", false, []],
			["Turtle Rock - Roller Room - Right", false, [], ['CaneOfSomaria']],
			["Turtle Rock - Roller Room - Right", false, [], ['FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],

			["Turtle Rock - Big Chest", false, []],
			["Turtle Rock - Big Chest", false, [], ['BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Big Key Chest", false, []],
			["Turtle Rock - Big Key Chest", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],

			["Turtle Rock - Crystaroller Room", false, []],
			["Turtle Rock - Crystaroller Room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Flute', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Flute', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Eye Bridge - Bottom Left", false, []],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Eye Bridge - Bottom Right", false, []],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Eye Bridge - Top Left", false, []],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Eye Bridge - Top Right", false, []],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Trinexx", false, []],
			["Turtle Rock - Trinexx", false, [], ['CaneOfSomaria']],
			["Turtle Rock - Trinexx", false, [], ['IceRod']],
			["Turtle Rock - Trinexx", false, [], ['FireRod']],
			["Turtle Rock - Trinexx", false, [], ['BigKeyD7']],
			["Turtle Rock - Trinexx", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Trinexx", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Trinexx", true, ['IceRod', 'FireRod', 'Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Trinexx", true, ['IceRod', 'FireRod', 'Lamp', 'Hookshot', 'MoonPearl', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
		];
	}
}
