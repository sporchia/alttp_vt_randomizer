<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class IcePalaceTest extends TestCase {
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
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, 'BigKeyD5', [], ['BigKeyD5']],

			["[dungeon-D5-B1] Ice Palace - compass room", true, 'BigKeyD5', [], ['BigKeyD5']],

			["[dungeon-D5-B2] Ice Palace - map room", true, 'BigKeyD5', [], ['BigKeyD5']],

			["[dungeon-D5-B3] Ice Palace - spike room", true, 'BigKeyD5', [], ['BigKeyD5']],

			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, 'BigKeyD5', [], ['BigKeyD5']],

			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, 'BigKeyD5', [], ['BigKeyD5']],

			["[dungeon-D5-B5] Ice Palace - big chest", false, 'BigKeyD5', [], ['BigKeyD5']],

			["Heart Container - Kholdstare", false, 'BigKeyD5', [], ['BigKeyD5']],
		];
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

	public function accessPool() {
		return [
			["[dungeon-D5-B1] Ice Palace - Big Key room", false, []],
			["[dungeon-D5-B1] Ice Palace - Big Key room", false, [], ['TitansMitt']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", false, [], ['MoonPearl']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", false, [], ['Flippers']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", false, [], ['Hammer']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B1] Ice Palace - Big Key room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],

			["[dungeon-D5-B1] Ice Palace - compass room", false, []],
			["[dungeon-D5-B1] Ice Palace - compass room", false, [], ['TitansMitt']],
			["[dungeon-D5-B1] Ice Palace - compass room", false, [], ['MoonPearl']],
			["[dungeon-D5-B1] Ice Palace - compass room", false, [], ['Flippers']],
			["[dungeon-D5-B1] Ice Palace - compass room", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B1] Ice Palace - compass room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],

			["[dungeon-D5-B2] Ice Palace - map room", false, []],
			["[dungeon-D5-B2] Ice Palace - map room", false, [], ['TitansMitt']],
			["[dungeon-D5-B2] Ice Palace - map room", false, [], ['MoonPearl']],
			["[dungeon-D5-B2] Ice Palace - map room", false, [], ['Flippers']],
			["[dungeon-D5-B2] Ice Palace - map room", false, [], ['Hammer']],
			["[dungeon-D5-B2] Ice Palace - map room", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B2] Ice Palace - map room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],

			["[dungeon-D5-B3] Ice Palace - spike room", false, []],
			["[dungeon-D5-B3] Ice Palace - spike room", false, [], ['TitansMitt']],
			["[dungeon-D5-B3] Ice Palace - spike room", false, [], ['MoonPearl']],
			["[dungeon-D5-B3] Ice Palace - spike room", false, [], ['Flippers']],
			["[dungeon-D5-B3] Ice Palace - spike room", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],
			["[dungeon-D5-B3] Ice Palace - spike room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],


			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", false, []],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", false, [], ['TitansMitt']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", false, [], ['MoonPearl']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", false, [], ['Flippers']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B4] Ice Palace - above Blue Mail room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],

			["[dungeon-D5-B5] Ice Palace - b5 up staircase", false, []],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", false, [], ['TitansMitt']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", false, [], ['MoonPearl']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", false, [], ['Flippers']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B5] Ice Palace - b5 up staircase", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],

			["[dungeon-D5-B5] Ice Palace - big chest", false, []],
			["[dungeon-D5-B5] Ice Palace - big chest", false, [], ['TitansMitt']],
			["[dungeon-D5-B5] Ice Palace - big chest", false, [], ['MoonPearl']],
			["[dungeon-D5-B5] Ice Palace - big chest", false, [], ['Flippers']],
			["[dungeon-D5-B5] Ice Palace - big chest", false, [], ['BigKeyD5']],
			["[dungeon-D5-B5] Ice Palace - big chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],
			["[dungeon-D5-B5] Ice Palace - big chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],

			["Heart Container - Kholdstare", false, []],
			["Heart Container - Kholdstare", false, [], ['TitansMitt']],
			["Heart Container - Kholdstare", false, [], ['MoonPearl']],
			["Heart Container - Kholdstare", false, [], ['Flippers']],
			["Heart Container - Kholdstare", false, [], ['Hammer']],
			["Heart Container - Kholdstare", false, [], ['BigKeyD5']],
			["Heart Container - Kholdstare", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Heart Container - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
		];
	}
}
