<?php namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class LightWorldTest extends TestCase {
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
			["Altar", false, []],
			["Altar", false, [], ['PendantOfCourage']],
			["Altar", false, [], ['PendantOfWisdom']],
			["Altar", false, [], ['PendantOfPower']],
			["Altar", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower']],

			["Blacksmiths", false, []],
			["Blacksmiths", false, [], ['MoonPearl']],
			["Blacksmiths", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Blacksmiths", true, ['MoonPearl', 'TitansMitt']],

			["Uncle", true, []],

			["[cave-034] Hyrule Castle secret entrance", true, []],

			["[cave-018] Graveyard - top right grave", false, []],
			["[cave-018] Graveyard - top right grave", false, [], ['PegasusBoots']],
			["[cave-018] Graveyard - top right grave", true, ['PegasusBoots', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-018] Graveyard - top right grave", true, ['PegasusBoots', 'TitansMitt']],
			["[cave-018] Graveyard - top right grave", true, ['PegasusBoots', 'ProgressiveGlove', 'Hammer', 'MoonPearl', 'MagicMirror']],
			["[cave-018] Graveyard - top right grave", true, ['PegasusBoots', 'PowerGlove', 'Hammer', 'MoonPearl', 'MagicMirror']],
			["[cave-018] Graveyard - top right grave", true, ['PegasusBoots', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MoonPearl', 'MagicMirror']],
			["[cave-018] Graveyard - top right grave", true, ['PegasusBoots', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MoonPearl', 'MagicMirror']],
			["[cave-018] Graveyard - top right grave", true, ['PegasusBoots', 'DefeatAgahnim', 'Hammer', 'Hookshot', 'MoonPearl', 'MagicMirror']],
			["[cave-018] Graveyard - top right grave", true, ['PegasusBoots', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MoonPearl', 'MagicMirror']],

			["[cave-047] Dam", true, []],

			["[cave-040] Link's House", true, []],

			["[cave-031] Tavern", true, []],

			["[cave-026] chicken house", true, []],

			["[cave-044] Aginah's cave", true, []],

			["[cave-035] Sahasrahla's Hut [left chest]", true, []],

			["[cave-035] Sahasrahla's Hut [center chest]", true, []],

			["[cave-035] Sahasrahla's Hut [right chest]", true, []],

			["[cave-021] Kakariko well [top chest]", true, []],

			["[cave-021] Kakariko well [left chest row of 3]", true, []],

			["[cave-021] Kakariko well [center chest row of 3]", true, []],

			["[cave-021] Kakariko well [right chest row of 3]", true, []],

			["[cave-021] Kakariko well [bottom chest]", true, []],

			["[cave-022-B1] Thief's hut [top chest]", true, []],

			["[cave-022-B1] Thief's hut [top left chest]", true, []],

			["[cave-022-B1] Thief's hut [top right chest]", true, []],

			["[cave-022-B1] Thief's hut [bottom left chest]", true, []],

			["[cave-022-B1] Thief's hut [bottom right chest]", true, []],

			["[cave-016] cave under rocks west of Santuary", false, []],
			["[cave-016] cave under rocks west of Santuary", false, [], ['PegasusBoots']],
			["[cave-016] cave under rocks west of Santuary", true, ['PegasusBoots']],

			["[cave-050] cave southwest of Lake Hylia [bottom left chest]", true, []],

			["[cave-050] cave southwest of Lake Hylia [top left chest]", true, []],

			["[cave-050] cave southwest of Lake Hylia [top right chest]", true, []],

			["[cave-050] cave southwest of Lake Hylia [bottom right chest]", true, []],

			["[cave-051] Ice Cave", true, []],

			["Bottle Vendor", true, []],

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

			["Purple Chest", false, []],
			["Purple Chest", false, [], ['MoonPearl']],
			["Purple Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Purple Chest", true, ['MoonPearl', 'TitansMitt']],

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

			["Piece of Heart (Thieves' Forest Hideout)", true, []],

			["Piece of Heart (Lumberjack Tree)", false, []],
			["Piece of Heart (Lumberjack Tree)", false, [], ['PegasusBoots']],
			["Piece of Heart (Lumberjack Tree)", false, [], ['DefeatAgahnim']],
			["Piece of Heart (Lumberjack Tree)", true, ['PegasusBoots', 'DefeatAgahnim']],

			["Piece of Heart (south of Haunted Grove)", false, []],
			["Piece of Heart (south of Haunted Grove)", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (south of Haunted Grove)", true, ['MoonPearl', 'MagicMirror', 'TitansMitt']],
			["Piece of Heart (south of Haunted Grove)", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
			["Piece of Heart (south of Haunted Grove)", true, ['MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
			["Piece of Heart (south of Haunted Grove)", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Hammer']],
			["Piece of Heart (south of Haunted Grove)", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Piece of Heart (south of Haunted Grove)", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Piece of Heart (Graveyard)", false, []],
			["Piece of Heart (Graveyard)", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (Graveyard)", true, ['MoonPearl', 'MagicMirror', 'TitansMitt']],
			["Piece of Heart (Graveyard)", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
			["Piece of Heart (Graveyard)", true, ['MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
			["Piece of Heart (Graveyard)", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
			["Piece of Heart (Graveyard)", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Piece of Heart (Graveyard)", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Piece of Heart (Desert - northeast corner)", false, []],
			["Piece of Heart (Desert - northeast corner)", false, [], ['Gloves']],
			["Piece of Heart (Desert - northeast corner)", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (Desert - northeast corner)", true, ['Flute', 'MagicMirror', 'TitansMitt']],

			["[cave-050] cave southwest of Lake Hylia - generous guy", true, []],

			["Library", false, []],
			["Library", false, [], ['PegasusBoots']],
			["Library", true, ['PegasusBoots']],

			["Mushroom", true, []],

			["Witch", false, []],
			["Witch", false, [], ['Mushroom']],
			["Witch", true, ['Mushroom']],

			["Piece of Heart (Maze Race)", true, []],

			["Piece of Heart (Desert - west side)", false, []],
			["Piece of Heart (Desert - west side)", true, ['BookOfMudora']],
			["Piece of Heart (Desert - west side)", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (Desert - west side)", true, ['Flute', 'MagicMirror', 'TitansMitt']],

			["Piece of Heart (Lake Hylia)", false, []],
			["Piece of Heart (Lake Hylia)", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Piece of Heart (Lake Hylia)", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'TitansMitt']],
			["Piece of Heart (Lake Hylia)", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
			["Piece of Heart (Lake Hylia)", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
			["Piece of Heart (Lake Hylia)", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'DefeatAgahnim']],

			["Piece of Heart (Dam)", true, []],

			["Piece of Heart (Zora's River)", false, []],
			["Piece of Heart (Zora's River)", true, ['Flippers']],
			//["Piece of Heart (Zora's River)", true, ['MoonPearl']],

			["Haunted Grove item", false, []],
			["Haunted Grove item", false, [], ['Shovel']],
			["Haunted Grove item", true, ['Shovel']],

			["Waterfall Fairy - Left", false, []],
			["Waterfall Fairy - Left", false, [], ['Flippers', 'MoonPearl']],
			["Waterfall Fairy - Left", true, ['Flippers']],
			["Waterfall Fairy - Left", true, ['MoonPearl']],

			["Waterfall Fairy - Right", false, []],
			["Waterfall Fairy - Right", false, [], ['Flippers', 'MoonPearl']],
			["Waterfall Fairy - Right", true, ['Flippers']],
			["Waterfall Fairy - Right", true, ['MoonPearl']],
		];
	}
}
