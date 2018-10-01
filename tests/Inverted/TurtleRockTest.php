<?php namespace Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class TurtleRockTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = World::factory('inverted', 'test_rules', 'NoGlitches');
		$this->world->getRegion('Turtle Rock')->setBoss(new Boss("Dummy Boss"));
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
			["Turtle Rock - Chain Chomps", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Compass Chest", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Roller Room - Left", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Roller Room - Right", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Big Chest", false, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Big Key Chest", true, 'BigKeyD7', ['KeyD7', 'KeyD7'], ['BigKeyD7']],

			["Turtle Rock - Crystaroller Room", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Eye Bridge - Bottom Left", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Eye Bridge - Bottom Right", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Eye Bridge - Top Left", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Eye Bridge - Top Right", true, 'BigKeyD7', [], ['BigKeyD7']],

			["Turtle Rock - Boss", false, 'BigKeyD7', [], ['BigKeyD7']],
			["Turtle Rock - Boss", false, 'KeyD7', [], ['KeyD7']],
		];
	}

	public function accessPool() {
		return [
			["Turtle Rock - Chain Chomps", false, []],
			["Turtle Rock - Chain Chomps", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
			["Turtle Rock - Chain Chomps", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],

			["Turtle Rock - Compass Chest", false, []],
			["Turtle Rock - Compass Chest", false, [], ['CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
			["Turtle Rock - Compass Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],

			["Turtle Rock - Roller Room - Left", false, []],
			["Turtle Rock - Roller Room - Left", false, [], ['CaneOfSomaria']],
			["Turtle Rock - Roller Room - Left", false, [], ['FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Left", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],

			["Turtle Rock - Roller Room - Right", false, []],
			["Turtle Rock - Roller Room - Right", false, [], ['CaneOfSomaria']],
			["Turtle Rock - Roller Room - Right", false, [], ['FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
			["Turtle Rock - Roller Room - Right", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],

			["Turtle Rock - Big Chest", false, []],
			["Turtle Rock - Big Chest", false, [], ['BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Big Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Big Key Chest", false, []],
			["Turtle Rock - Big Key Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
			["Turtle Rock - Big Key Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],

			["Turtle Rock - Crystaroller Room", false, []],
			["Turtle Rock - Crystaroller Room", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Flute', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Flute', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Crystaroller Room", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Eye Bridge - Bottom Left", false, []],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Eye Bridge - Bottom Right", false, []],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Eye Bridge - Top Left", false, []],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Eye Bridge - Top Right", false, []],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

			["Turtle Rock - Boss", false, []],
			["Turtle Rock - Boss", false, [], ['CaneOfSomaria']],
			["Turtle Rock - Boss", false, [], ['BigKeyD7']],
			["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'L1Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
			["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
		];
	}
}
