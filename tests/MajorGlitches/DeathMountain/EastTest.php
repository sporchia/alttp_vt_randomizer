<?php namespace MajorGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class EastTest extends TestCase {
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
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, []],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['PegasusBoots']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['Flute', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, ['ProgressiveGlove', 'Hookshot']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", false, []],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", false, []],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
		];
	}
}
