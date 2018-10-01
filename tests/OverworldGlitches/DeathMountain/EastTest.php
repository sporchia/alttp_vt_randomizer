<?php namespace OverworldGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class EastTest extends TestCase {
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
			["Spiral Cave", false, []],
			["Spiral Cave", true, ['PegasusBoots']],
			["Spiral Cave", true, ['Flute', 'Hookshot']],
			["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Spiral Cave", false, ['ProgressiveGlove', 'Hookshot']],
			["Spiral Cave", false, [], ['Gloves', 'Flute', 'PegasusBoots']],

			["Paradox Cave Lower - Far Left", false, []],
			["Paradox Cave Lower - Far Left", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Left", false, []],
			["Paradox Cave Lower - Left", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Middle", false, []],
			["Paradox Cave Lower - Middle", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Middle", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Middle", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Middle", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Middle", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Right", false, []],
			["Paradox Cave Lower - Right", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Far Right", false, []],
			["Paradox Cave Lower - Far Right", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["Paradox Cave Upper - Left", false, []],
			["Paradox Cave Upper - Left", true, ['Flute', 'Hookshot']],
			["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["Paradox Cave Upper - Right", false, []],
			["Paradox Cave Upper - Right", true, ['Flute', 'Hookshot']],
			["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
		];
	}
}
