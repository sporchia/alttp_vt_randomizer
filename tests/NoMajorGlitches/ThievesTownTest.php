<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class ThievesTownTest extends TestCase {
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
			["Thieves' Town - Attic", false, 'BigKeyD4', [], ['BigKeyD4']],
			["Thieves' Town - Attic", false, 'KeyD4', [], ['KeyD4']],

			["Thieves' Town - Big Key Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

			["Thieves' Town - Map Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

			["Thieves' Town - Compass Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

			["Thieves' Town - Ambush Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

			["Thieves' Town - Big Chest", false, 'BigKeyD4', [], ['BigKeyD4']],
			["Thieves' Town - Big Chest", false, 'KeyD4', [], ['KeyD4']],

			["Thieves' Town - Blind's Cell", false, 'BigKeyD4', [], ['BigKeyD4']],

			["Thieves' Town - Blind", false, 'BigKeyD4', [], ['BigKeyD4']],
			["Thieves' Town - Blind", false, 'KeyD4', [], ['KeyD4']],
		];
	}

	public function accessPool() {
		return [
			["Thieves' Town - Attic", false, []],
			["Thieves' Town - Attic", false, [], ['MoonPearl']],
			["Thieves' Town - Attic", false, [], ['BigKeyD4']],
			["Thieves' Town - Attic", true, ['MoonPearl', 'TitansMitt', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Attic", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Attic", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Attic", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Attic", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Attic", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Attic", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Attic", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'KeyD4', 'BigKeyD4']],

			["Thieves' Town - Big Key Chest", false, []],
			["Thieves' Town - Big Key Chest", false, [], ['MoonPearl']],
			["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'TitansMitt']],
			["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Thieves' Town - Map Chest", false, []],
			["Thieves' Town - Map Chest", false, [], ['MoonPearl']],
			["Thieves' Town - Map Chest", true, ['MoonPearl', 'TitansMitt']],
			["Thieves' Town - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Thieves' Town - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Thieves' Town - Map Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Thieves' Town - Map Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Thieves' Town - Map Chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Thieves' Town - Map Chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Thieves' Town - Map Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Thieves' Town - Compass Chest", false, []],
			["Thieves' Town - Compass Chest", false, [], ['MoonPearl']],
			["Thieves' Town - Compass Chest", true, ['MoonPearl', 'TitansMitt']],
			["Thieves' Town - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Thieves' Town - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Thieves' Town - Compass Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Thieves' Town - Compass Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Thieves' Town - Compass Chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Thieves' Town - Compass Chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Thieves' Town - Compass Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Thieves' Town - Ambush Chest", false, []],
			["Thieves' Town - Ambush Chest", false, [], ['MoonPearl']],
			["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'TitansMitt']],
			["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Thieves' Town - Big Chest", false, []],
			["Thieves' Town - Big Chest", false, [], ['MoonPearl']],
			["Thieves' Town - Big Chest", false, [], ['BigKeyD4']],
			["Thieves' Town - Big Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Big Chest", true, ['MoonPearl', 'TitansMitt', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Big Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Big Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],
			["Thieves' Town - Big Chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],

			["Thieves' Town - Blind's Cell", false, []],
			["Thieves' Town - Blind's Cell", false, [], ['MoonPearl']],
			["Thieves' Town - Blind's Cell", false, [], ['BigKeyD4']],
			["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'TitansMitt', 'BigKeyD4']],
			["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4']],
			["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD4']],
			["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD4']],
			["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'BigKeyD4']],
			["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4']],
			["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4']],
			["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4']],

			["Thieves' Town - Blind", false, []],
			["Thieves' Town - Blind", false, [], ['MoonPearl']],
			["Thieves' Town - Blind", false, [], ['BigKeyD4']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD4']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'BigKeyD4']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD4']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'ProgressiveSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'L1Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'MasterSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'L3Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'L4Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'CaneOfByrna']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'CaneOfSomaria']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'Hammer']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'ProgressiveSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'L1Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'MasterSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'L3Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'L4Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'CaneOfByrna']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'CaneOfSomaria']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'L1Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'MasterSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'L3Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'L4Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'L1Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'MasterSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'L3Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'L4Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'L1Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'MasterSword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'L3Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'L4Sword']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
			["Thieves' Town - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'Hammer']],
		];
	}
}
