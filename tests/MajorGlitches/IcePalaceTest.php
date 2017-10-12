<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class IcePalaceTest extends TestCase {
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
			["Ice Palace - Big Key Chest", true, 'BigKeyD5', [], ['BigKeyD5']],

			["Ice Palace - Compass Chest", true, 'BigKeyD5', [], ['BigKeyD5']],

			["Ice Palace - Map Chest", true, 'BigKeyD5', [], ['BigKeyD5']],

			["Ice Palace - Spike Room", true, 'BigKeyD5', [], ['BigKeyD5']],

			["Ice Palace - Freezor Chest", true, 'BigKeyD5', [], ['BigKeyD5']],

			["Ice Palace - Iced T Room", true, 'BigKeyD5', [], ['BigKeyD5']],

			["Ice Palace - Big Chest", false, 'BigKeyD5', [], ['BigKeyD5']],

			["Ice Palace - Kholdstare", false, 'BigKeyD5', [], ['BigKeyD5']],
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
			["Ice Palace - Big Key Chest", false, []],
			["Ice Palace - Big Key Chest", false, [], ['Gloves']],
			["Ice Palace - Big Key Chest", false, [], ['Hammer']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Big Key Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],

			["Ice Palace - Compass Chest", false, []],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],
			["Ice Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],

			["Ice Palace - Map Chest", false, []],
			["Ice Palace - Map Chest", false, [], ['Gloves']],
			["Ice Palace - Map Chest", false, [], ['Hammer']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Map Chest", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],

			["Ice Palace - Spike Room", false, []],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['Cape', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],
			["Ice Palace - Spike Room", true, ['CaneOfByrna', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],

			["Ice Palace - Freezor Chest", false, []],
			["Ice Palace - Freezor Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],
			["Ice Palace - Freezor Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],

			["Ice Palace - Iced T Room", false, []],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],
			["Ice Palace - Iced T Room", true, ['MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],

			["Ice Palace - Big Chest", false, []],
			["Ice Palace - Big Chest", false, [], ['BigKeyD5']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],
			["Ice Palace - Big Chest", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword']],

			["Ice Palace - Kholdstare", false, []],
			["Ice Palace - Kholdstare", false, [], ['Gloves']],
			["Ice Palace - Kholdstare", false, [], ['Hammer']],
			//["Ice Palace - Kholdstare", false, [], ['BigKeyD5']],
			["Ice Palace - Kholdstare", false, [], ['FireRod', 'Bombos', 'AnySword']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L1Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L1Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
			["Ice Palace - Kholdstare", true, ['BigKeyD5', 'MoonPearl', 'Flippers', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
		];
	}
}
