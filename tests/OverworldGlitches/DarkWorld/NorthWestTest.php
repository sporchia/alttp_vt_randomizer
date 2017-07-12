<?php namespace OverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class NorthWestTest extends TestCase {
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

	public function accessPool() {
		return [
			["[cave-063] doorless hut", false, []],
			["[cave-063] doorless hut", false, [], ['MoonPearl']],
			["[cave-063] doorless hut", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-063] doorless hut", true, ['MoonPearl', 'TitansMitt']],
			["[cave-063] doorless hut", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[cave-063] doorless hut", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[cave-063] doorless hut", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[cave-063] doorless hut", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[cave-063] doorless hut", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[cave-062] C-shaped house", false, []],
			["[cave-062] C-shaped house", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-062] C-shaped house", true, ['MoonPearl', 'TitansMitt']],
			["[cave-062] C-shaped house", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[cave-062] C-shaped house", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[cave-062] C-shaped house", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[cave-062] C-shaped house", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[cave-062] C-shaped house", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Piece of Heart (Treasure Chest Game)", false, []],
			["Piece of Heart (Treasure Chest Game)", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (Treasure Chest Game)", true, ['MoonPearl', 'TitansMitt']],
			["Piece of Heart (Treasure Chest Game)", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Piece of Heart (Treasure Chest Game)", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Piece of Heart (Treasure Chest Game)", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Piece of Heart (Treasure Chest Game)", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Piece of Heart (Treasure Chest Game)", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Piece of Heart (Dark World blacksmith pegs)", false, []],
			["Piece of Heart (Dark World blacksmith pegs)", false, [], ['MoonPearl']],
			["Piece of Heart (Dark World blacksmith pegs)", false, [], ['Hammer']],
			["Piece of Heart (Dark World blacksmith pegs)", false, [], ['Gloves']],
			["Piece of Heart (Dark World blacksmith pegs)", true, ['MoonPearl', 'Hammer', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (Dark World blacksmith pegs)", true, ['MoonPearl', 'Hammer', 'TitansMitt']],

			["Piece of Heart (Dark World - bumper cave)", false, []],
			["Piece of Heart (Dark World - bumper cave)", true, ['MoonPearl', 'Cape', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (Dark World - bumper cave)", true, ['MoonPearl', 'Cape', 'TitansMitt']],
			["Piece of Heart (Dark World - bumper cave)", true, ['MoonPearl', 'Cape', 'ProgressiveGlove', 'Hammer']],
			["Piece of Heart (Dark World - bumper cave)", true, ['MoonPearl', 'Cape', 'PowerGlove', 'Hammer']],
			["Piece of Heart (Dark World - bumper cave)", true, ['MoonPearl', 'Cape', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Piece of Heart (Dark World - bumper cave)", true, ['MoonPearl', 'Cape', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
		];
	}
}
