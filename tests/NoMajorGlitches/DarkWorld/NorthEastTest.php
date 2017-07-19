<?php namespace NoMajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class NorthEastTest extends TestCase {
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

	public function accessPool() {
		return [
			["Catfish", false, []],
			["Catfish", false, [], ['Gloves']],
			["Catfish", false, [], ['MoonPearl']],
			["Catfish", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove']],
			["Catfish", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove']],
			["Catfish", true, ['MoonPearl', 'DefeatAgahnim', 'TitansMitt']],
			["Catfish", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Catfish", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Catfish", true, ['MoonPearl', 'TitansMitt', 'Flippers']],

			["Piece of Heart (Pyramid)", false, []],
			["Piece of Heart (Pyramid)", true, ['DefeatAgahnim']],
			["Piece of Heart (Pyramid)", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Piece of Heart (Pyramid)", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Piece of Heart (Pyramid)", true, ['MoonPearl', 'TitansMitt', 'Flippers']],

			["Pyramid - Sword", false, []],
			["Pyramid - Sword", false, [], ['MoonPearl']],
			["Pyramid - Sword", false, [], ['Crystal5']],
			["Pyramid - Sword", false, [], ['Crystal6']],
			["Pyramid - Sword", false, [], ['AnySword']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'DefeatAgahnim', 'Hammer']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'TitansMitt', 'Hammer']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'ProgressiveGlove', 'Hammer']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'PowerGlove', 'Hammer']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'L1Sword', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'Hammer']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'TitansMitt', 'Hammer']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'ProgressiveGlove', 'Hammer']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'PowerGlove', 'Hammer']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],

			["Pyramid - Bow", false, []],
			["Pyramid - Bow", false, [], ['MoonPearl']],
			["Pyramid - Bow", false, [], ['Crystal5']],
			["Pyramid - Bow", false, [], ['Crystal6']],
			["Pyramid - Bow", false, [], ['AnyBow']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'DefeatAgahnim', 'Hammer']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'TitansMitt', 'Hammer']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'ProgressiveGlove', 'Hammer']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'PowerGlove', 'Hammer']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'Bow', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],

			["Pyramid Fairy - Left", false, []],
			["Pyramid Fairy - Left", false, [], ['MoonPearl']],
			["Pyramid Fairy - Left", false, [], ['Crystal5']],
			["Pyramid Fairy - Left", false, [], ['Crystal6']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'Hammer']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'TitansMitt', 'Hammer']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveGlove', 'Hammer']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'PowerGlove', 'Hammer']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],

			["Pyramid Fairy - Right", false, []],
			["Pyramid Fairy - Right", false, [], ['MoonPearl']],
			["Pyramid Fairy - Right", false, [], ['Crystal5']],
			["Pyramid Fairy - Right", false, [], ['Crystal6']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'Hammer']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'TitansMitt', 'Hammer']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveGlove', 'Hammer']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'PowerGlove', 'Hammer']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
			["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],

			["Ganon", false, []],
			["Ganon", false, [], ['MoonPearl']],
			["Ganon", false, [], ['DefeatAgahnim2']],
		];
	}
}
