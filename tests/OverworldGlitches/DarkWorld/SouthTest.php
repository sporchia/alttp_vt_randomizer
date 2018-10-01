<?php namespace OverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class SouthTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = World::factory('standard', 'test_rules', 'OverworldGlitches');
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
			["Hype Cave - Top", false, []],
			["Hype Cave - Top", false, [], ['MoonPearl']],
			["Hype Cave - Top", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Hype Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Hype Cave - Top", true, ['MoonPearl', 'TitansMitt']],
			["Hype Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Hype Cave - Top", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Hype Cave - Top", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Hype Cave - Top", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Hype Cave - Top", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Hype Cave - Middle Right", false, []],
			["Hype Cave - Middle Right", false, [], ['MoonPearl']],
			["Hype Cave - Middle Right", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Hype Cave - Middle Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Hype Cave - Middle Right", true, ['MoonPearl', 'TitansMitt']],
			["Hype Cave - Middle Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Hype Cave - Middle Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Hype Cave - Middle Right", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Hype Cave - Middle Right", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Hype Cave - Middle Right", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Hype Cave - Middle Left", false, []],
			["Hype Cave - Middle Left", false, [], ['MoonPearl']],
			["Hype Cave - Middle Left", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Hype Cave - Middle Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Hype Cave - Middle Left", true, ['MoonPearl', 'TitansMitt']],
			["Hype Cave - Middle Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Hype Cave - Middle Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Hype Cave - Middle Left", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Hype Cave - Middle Left", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Hype Cave - Middle Left", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Hype Cave - Bottom", false, []],
			["Hype Cave - Bottom", false, [], ['MoonPearl']],
			["Hype Cave - Bottom", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Hype Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Hype Cave - Bottom", true, ['MoonPearl', 'TitansMitt']],
			["Hype Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Hype Cave - Bottom", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Hype Cave - Bottom", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Hype Cave - Bottom", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Hype Cave - Bottom", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Hype Cave - NPC", false, []],
			["Hype Cave - NPC", false, [], ['MoonPearl']],
			["Hype Cave - NPC", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Hype Cave - NPC", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Hype Cave - NPC", true, ['MoonPearl', 'TitansMitt']],
			["Hype Cave - NPC", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Hype Cave - NPC", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Hype Cave - NPC", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Hype Cave - NPC", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Hype Cave - NPC", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Stumpy", false, []],
			["Stumpy", false, [], ['MoonPearl']],
			["Stumpy", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Stumpy", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Stumpy", true, ['MoonPearl', 'TitansMitt']],
			["Stumpy", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Stumpy", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Stumpy", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Stumpy", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Stumpy", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

			["Digging Game", false, []],
			["Digging Game", false, [], ['MoonPearl']],
			["Digging Game", true, ['MoonPearl', 'DefeatAgahnim', 'Hammer']],
			["Digging Game", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
			["Digging Game", true, ['MoonPearl', 'TitansMitt']],
			["Digging Game", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
			["Digging Game", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
			["Digging Game", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
			["Digging Game", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
			["Digging Game", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],
		];
	}
}
