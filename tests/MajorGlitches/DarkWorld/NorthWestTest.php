<?php namespace MajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class NorthWestTest extends TestCase {
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

	public function accessPool() {
		return [
			["Brewery", false, []],
			["Brewery", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Brewery", true, ['MoonPearl', 'TitansMitt']],
			["Brewery", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Brewery", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Brewery", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Brewery", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Brewery", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["C-Shaped House", false, []],
			["C-Shaped House", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["C-Shaped House", true, ['MoonPearl', 'TitansMitt']],
			["C-Shaped House", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["C-Shaped House", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["C-Shaped House", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["C-Shaped House", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["C-Shaped House", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Chest Game", false, []],
			["Chest Game", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Chest Game", true, ['MoonPearl', 'TitansMitt']],
			["Chest Game", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Chest Game", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Chest Game", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Chest Game", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Chest Game", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Hammer Pegs", false, []],
			["Hammer Pegs", false, [], ['Hammer']],
			["Hammer Pegs", true, ['MoonPearl', 'Hammer', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Hammer Pegs", true, ['MoonPearl', 'Hammer', 'TitansMitt']],

			["Bumper Cave", false, []],
			["Bumper Cave", true, ['MoonPearl', 'Cape', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Bumper Cave", true, ['MoonPearl', 'Cape', 'TitansMitt']],
			["Bumper Cave", true, ['MoonPearl', 'Cape', 'ProgressiveGlove', 'Hammer']],
			["Bumper Cave", true, ['MoonPearl', 'Cape', 'PowerGlove', 'Hammer']],
			["Bumper Cave", true, ['MoonPearl', 'Cape', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Bumper Cave", true, ['MoonPearl', 'Cape', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],

			["Blacksmith", false, []],
			["Blacksmith", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Blacksmith", true, ['MoonPearl', 'TitansMitt']],

			["Purple Chest", false, []],
			["Purple Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Purple Chest", true, ['MoonPearl', 'TitansMitt']],
		];
	}
}
