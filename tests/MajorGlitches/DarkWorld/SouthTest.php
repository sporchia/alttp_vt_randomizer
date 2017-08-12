<?php namespace MajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class SouthTest extends TestCase {
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
			["[cave-073] cave northeast of swamp palace [top chest]", false, []],
			["[cave-073] cave northeast of swamp palace [top chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [top chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-073] cave northeast of swamp palace [top chest]", true, ['MoonPearl', 'TitansMitt']],
			["[cave-073] cave northeast of swamp palace [top chest]", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [top chest]", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [top chest]", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace [top chest]", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace [top chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[cave-073] cave northeast of swamp palace [top middle chest]", false, []],
			["[cave-073] cave northeast of swamp palace [top middle chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [top middle chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-073] cave northeast of swamp palace [top middle chest]", true, ['MoonPearl', 'TitansMitt']],
			["[cave-073] cave northeast of swamp palace [top middle chest]", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [top middle chest]", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [top middle chest]", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace [top middle chest]", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace [top middle chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[cave-073] cave northeast of swamp palace [bottom middle chest]", false, []],
			["[cave-073] cave northeast of swamp palace [bottom middle chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [bottom middle chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-073] cave northeast of swamp palace [bottom middle chest]", true, ['MoonPearl', 'TitansMitt']],
			["[cave-073] cave northeast of swamp palace [bottom middle chest]", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [bottom middle chest]", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [bottom middle chest]", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace [bottom middle chest]", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace [bottom middle chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[cave-073] cave northeast of swamp palace [bottom chest]", false, []],
			["[cave-073] cave northeast of swamp palace [bottom chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [bottom chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-073] cave northeast of swamp palace [bottom chest]", true, ['MoonPearl', 'TitansMitt']],
			["[cave-073] cave northeast of swamp palace [bottom chest]", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [bottom chest]", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace [bottom chest]", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace [bottom chest]", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace [bottom chest]", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["[cave-073] cave northeast of swamp palace - generous guy", false, []],
			["[cave-073] cave northeast of swamp palace - generous guy", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["[cave-073] cave northeast of swamp palace - generous guy", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-073] cave northeast of swamp palace - generous guy", true, ['MoonPearl', 'TitansMitt']],
			["[cave-073] cave northeast of swamp palace - generous guy", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace - generous guy", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["[cave-073] cave northeast of swamp palace - generous guy", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace - generous guy", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["[cave-073] cave northeast of swamp palace - generous guy", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Flute Boy", false, []],
			["Flute Boy", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Flute Boy", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Flute Boy", true, ['MoonPearl', 'TitansMitt']],
			["Flute Boy", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Flute Boy", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Flute Boy", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Flute Boy", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Flute Boy", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Piece of Heart (Digging Game)", false, []],
			["Piece of Heart (Digging Game)", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Piece of Heart (Digging Game)", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (Digging Game)", true, ['MoonPearl', 'TitansMitt']],
			["Piece of Heart (Digging Game)", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Piece of Heart (Digging Game)", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Piece of Heart (Digging Game)", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Piece of Heart (Digging Game)", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Piece of Heart (Digging Game)", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],
		];
	}
}
