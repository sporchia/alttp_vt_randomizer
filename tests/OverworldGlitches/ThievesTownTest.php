<?php namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class ThievesTownTest extends TestCase {
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
			["[dungeon-D4-1F] Thieves' Town - Room above boss", false, 'BigKeyD4', [], ['BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", false, 'KeyD4', [], ['KeyD4']],

			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, 'BigKeyD4', [], ['BigKeyD4']],

			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, 'BigKeyD4', [], ['BigKeyD4']],

			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, 'BigKeyD4', [], ['BigKeyD4']],

			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, 'BigKeyD4', [], ['BigKeyD4']],

			["[dungeon-D4-B2] Thieves' Town - big chest", false, 'BigKeyD4', [], ['BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - big chest", false, 'KeyD4', [], ['KeyD4']],

			["[dungeon-D4-B2] Thieves' Town - next to Blind", false, 'BigKeyD4', [], ['BigKeyD4']],

			["Heart Container - Blind", false, 'BigKeyD4', [], ['BigKeyD4']],
			["Heart Container - Blind", false, 'KeyD4', [], ['KeyD4']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-D4-1F] Thieves' Town - Room above boss", false, []],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", false, [], ['MoonPearl']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", false, [], ['BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", true, ['MoonPearl', 'TitansMitt', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-1F] Thieves' Town - Room above boss", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'KeyD4', 'BigKeyD4']],

			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", false, []],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", false, [], ['MoonPearl']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", false, []],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", false, [], ['MoonPearl']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [top left chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", false, []],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", false, [], ['MoonPearl']],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Bottom right of huge room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", false, []],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", false, [], ['MoonPearl']],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, ['MoonPearl', 'TitansMitt']],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[dungeon-D4-B1] Thieves' Town - Top left of huge room", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[dungeon-D4-B2] Thieves' Town - big chest", false, []],
			["[dungeon-D4-B2] Thieves' Town - big chest", false, [], ['MoonPearl']],
			["[dungeon-D4-B2] Thieves' Town - big chest", false, [], ['BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - big chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - big chest", true, ['MoonPearl', 'TitansMitt', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - big chest", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - big chest", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - big chest", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],

			["[dungeon-D4-B2] Thieves' Town - next to Blind", false, []],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", false, [], ['MoonPearl']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", false, [], ['BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", true, ['MoonPearl', 'TitansMitt', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4']],
			["[dungeon-D4-B2] Thieves' Town - next to Blind", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4']],

			["Heart Container - Blind", false, []],
			["Heart Container - Blind", false, [], ['MoonPearl']],
			["Heart Container - Blind", false, [], ['BigKeyD4']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD4']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'BigKeyD4']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD4']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'ProgressiveSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'L1Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'MasterSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'L3Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'L4Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'CaneOfByrna']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'CaneOfSomaria']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'Hammer']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'ProgressiveSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'L1Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'MasterSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'L3Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'L4Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'CaneOfByrna']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'CaneOfSomaria']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'L1Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'MasterSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'L3Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'L4Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'L1Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'MasterSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'L3Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'L4Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'L1Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'MasterSword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'L3Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'L4Sword']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
			["Heart Container - Blind", true, ['KeyD4', 'MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'BigKeyD4', 'Hammer']],
		];
	}
}
