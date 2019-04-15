<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class LightWorldTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = World::factory('standard', 'test_rules', 'MajorGlitches');
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
			["Master Sword Pedestal", false, []],
			["Master Sword Pedestal", false, [], ['PendantOfCourage']],
			["Master Sword Pedestal", false, [], ['PendantOfWisdom']],
			["Master Sword Pedestal", false, [], ['PendantOfPower']],
			["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower']],

			["Link's Uncle", true, []],

			["Secret Passage", true, ['L1Sword']],

			["King's Tomb", false, []],
			["King's Tomb", false, [], ['PegasusBoots']],
			["King's Tomb", true, ['PegasusBoots', 'ProgressiveGlove', 'ProgressiveGlove']],
			["King's Tomb", true, ['PegasusBoots', 'TitansMitt']],
			["King's Tomb", true, ['PegasusBoots', 'ProgressiveGlove', 'Hammer', 'MoonPearl', 'MagicMirror']],
			["King's Tomb", true, ['PegasusBoots', 'PowerGlove', 'Hammer', 'MoonPearl', 'MagicMirror']],
			["King's Tomb", true, ['PegasusBoots', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MoonPearl', 'MagicMirror']],
			["King's Tomb", true, ['PegasusBoots', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MoonPearl', 'MagicMirror']],
			["King's Tomb", true, ['PegasusBoots', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'MoonPearl', 'MagicMirror']],
			["King's Tomb", true, ['PegasusBoots', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MoonPearl', 'MagicMirror']],

			["Floodgate Chest", true, []],

			["Link's House", true, []],

			["Kakariko Tavern", true, []],

			["Chicken House", true, []],

			["Aginah's Cave", true, []],

			["Sahasrahla's Hut - Left", true, []],

			["Sahasrahla's Hut - Middle", true, []],

			["Sahasrahla's Hut - Right", true, []],

			["Kakariko Well - Top", true, []],

			["Kakariko Well - Left", true, []],

			["Kakariko Well - Middle", true, []],

			["Kakariko Well - Right", true, []],

			["Kakariko Well - Bottom", true, []],

			["Blind's Hideout - Top", true, []],

			["Blind's Hideout - Left", true, []],

			["Blind's Hideout - Right", true, []],

			["Blind's Hideout - Far Left", true, []],

			["Blind's Hideout - Far Right", true, []],

			["Pegasus Rocks", false, []],
			["Pegasus Rocks", false, [], ['PegasusBoots']],
			["Pegasus Rocks", true, ['PegasusBoots']],

			["Mini Moldorm Cave - Far Left", true, []],

			["Mini Moldorm Cave - Left", true, []],

			["Mini Moldorm Cave - Right", true, []],

			["Mini Moldorm Cave - Far Right", true, []],

			["Ice Rod Cave", true, []],

			["Bottle Merchant", true, []],

			["Sahasrahla", false, []],
			["Sahasrahla", false, [], ['PendantOfCourage']],
			["Sahasrahla", true, ['PendantOfCourage']],

			["Magic Bat", false, []],
			["Magic Bat", false, [], ['Powder']],
			["Magic Bat", true, ['Powder', 'Hammer']],
			["Magic Bat", true, ['Powder', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'MagicMirror']],
			["Magic Bat", true, ['Powder', 'TitansMitt', 'MoonPearl', 'MagicMirror']],

			["Sick Kid", false, []],
			["Sick Kid", false, [], ['AnyBottle']],
			["Sick Kid", true, ['BottleWithBee']],
			["Sick Kid", true, ['BottleWithFairy']],
			["Sick Kid", true, ['BottleWithRedPotion']],
			["Sick Kid", true, ['BottleWithGreenPotion']],
			["Sick Kid", true, ['BottleWithBluePotion']],
			["Sick Kid", true, ['Bottle']],
			["Sick Kid", true, ['BottleWithGoldBee']],

			["Hobo", true, []],

			["Bombos Tablet", false, []],
			["Bombos Tablet", false, [], ['UpgradedSword']],
			["Bombos Tablet", false, [], ['BookOfMudora']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'TitansMitt']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'TitansMitt']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'TitansMitt']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'TitansMitt']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'ProgressiveGlove', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'ProgressiveGlove', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'ProgressiveGlove', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'ProgressiveGlove', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'PowerGlove', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'PowerGlove', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'PowerGlove', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'PowerGlove', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'DefeatAgahnim', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'DefeatAgahnim', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'DefeatAgahnim', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'DefeatAgahnim', 'Hammer']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'DefeatAgahnim', 'Flippers', 'Hookshot']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'DefeatAgahnim', 'Flippers', 'Hookshot']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'DefeatAgahnim', 'Flippers', 'Hookshot']],
			["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["King Zora", true, []],

			["Lost Woods Hideout", true, []],

			["Lumberjack Tree", false, []],
			["Lumberjack Tree", false, [], ['PegasusBoots']],
			["Lumberjack Tree", false, [], ['DefeatAgahnim']],
			["Lumberjack Tree", true, ['PegasusBoots', 'DefeatAgahnim']],

			["Cave 45", false, []],
			["Cave 45", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Cave 45", true, ['MoonPearl', 'MagicMirror', 'TitansMitt']],
			["Cave 45", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
			["Cave 45", true, ['MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
			["Cave 45", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Hammer']],
			["Cave 45", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Cave 45", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Graveyard Ledge", false, []],
			["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'TitansMitt']],
			["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
			["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
			["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Checkerboard Cave", false, []],
			["Checkerboard Cave", false, [], ['Gloves']],
			["Checkerboard Cave", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Checkerboard Cave", true, ['Flute', 'MagicMirror', 'TitansMitt']],

			["Mini Moldorm Cave - NPC", true, []],

			["Library", false, []],
			["Library", false, [], ['PegasusBoots']],
			["Library", true, ['PegasusBoots']],

			["Mushroom", true, []],

			["Potion Shop", false, []],
			["Potion Shop", false, [], ['Mushroom']],
			["Potion Shop", true, ['Mushroom']],

			["Maze Race", true, []],

			["Desert Ledge", false, []],
			["Desert Ledge", true, ['BookOfMudora']],
			["Desert Ledge", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Desert Ledge", true, ['Flute', 'MagicMirror', 'TitansMitt']],

			["Lake Hylia Island", false, []],
			["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'TitansMitt']],
			["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
			["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
			["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'DefeatAgahnim']],

			["Sunken Treasure", true, []],

			["Zora's Ledge", false, []],
			["Zora's Ledge", true, ['Flippers']],
			["Zora's Ledge", true, ['PegasusBoots']],

			["Flute Spot", false, []],
			["Flute Spot", false, [], ['Shovel']],
			["Flute Spot", true, ['Shovel']],

			["Waterfall Fairy - Left", false, []],
			["Waterfall Fairy - Left", false, [], ['Flippers', 'MoonPearl', 'PegasusBoots']],
			["Waterfall Fairy - Left", true, ['Flippers']],
			["Waterfall Fairy - Left", true, ['MoonPearl']],
			["Waterfall Fairy - Left", true, ['PegasusBoots']],

			["Waterfall Fairy - Right", false, []],
			["Waterfall Fairy - Right", false, [], ['Flippers', 'MoonPearl', 'PegasusBoots']],
			["Waterfall Fairy - Right", true, ['Flippers']],
			["Waterfall Fairy - Right", true, ['MoonPearl']],
			["Waterfall Fairy - Right", true, ['PegasusBoots']],
		];
	}
}
