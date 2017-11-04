<?php namespace NoMajorGlitches\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class EastTest extends TestCase {
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
			["Superbunny Cave - Top", false, []],
			["Superbunny Cave - Top", false, [], ['Gloves']],
			["Superbunny Cave - Top", false, [], ['MoonPearl']],
			["Superbunny Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["Superbunny Cave - Top", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["Superbunny Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Flute']],
			["Superbunny Cave - Top", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Flute']],
			["Superbunny Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["Superbunny Cave - Top", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
			["Superbunny Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp']],
			["Superbunny Cave - Top", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp']],

			["Superbunny Cave - Bottom", false, []],
			["Superbunny Cave - Bottom", false, [], ['Gloves']],
			["Superbunny Cave - Bottom", false, [], ['MoonPearl']],
			["Superbunny Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["Superbunny Cave - Bottom", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["Superbunny Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Flute']],
			["Superbunny Cave - Bottom", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Flute']],
			["Superbunny Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["Superbunny Cave - Bottom", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
			["Superbunny Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp']],
			["Superbunny Cave - Bottom", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp']],

			["Hookshot Cave - Bottom Right", false, []],
			["Hookshot Cave - Bottom Right", false, [], ['Gloves']],
			["Hookshot Cave - Bottom Right", false, [], ['MoonPearl']],
			["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Flute', 'PegasusBoots']],
			["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Flute', 'PegasusBoots']],
			["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
			["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp', 'PegasusBoots']],
			["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp', 'PegasusBoots']],

			["Hookshot Cave - Bottom Left", false, []],
			["Hookshot Cave - Bottom Left", false, [], ['Gloves']],
			["Hookshot Cave - Bottom Left", false, [], ['MoonPearl']],
			["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],

			["Hookshot Cave - Top Left", false, []],
			["Hookshot Cave - Top Left", false, [], ['Gloves']],
			["Hookshot Cave - Top Left", false, [], ['MoonPearl']],
			["Hookshot Cave - Top Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["Hookshot Cave - Top Left", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["Hookshot Cave - Top Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["Hookshot Cave - Top Left", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],

			["Hookshot Cave - Top Right", false, []],
			["Hookshot Cave - Top Right", false, [], ['Gloves']],
			["Hookshot Cave - Top Right", false, [], ['MoonPearl']],
			["Hookshot Cave - Top Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["Hookshot Cave - Top Right", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["Hookshot Cave - Top Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["Hookshot Cave - Top Right", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
		];
	}
}
