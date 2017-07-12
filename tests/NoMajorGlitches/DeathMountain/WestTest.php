<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class WestTest extends TestCase {
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
			["Ether Tablet", false, []],
			["Ether Tablet", false, [], ['Gloves', 'Flute']],
			["Ether Tablet", false, [], ['Lamp', 'Flute']],
			["Ether Tablet", false, [], ['MagicMirror', 'Hookshot']],
			["Ether Tablet", false, [], ['MagicMirror', 'Hammer']],
			["Ether Tablet", false, [], ['UpgradedSword']],
			["Ether Tablet", false, [], ['BookOfMudora']],
			["Ether Tablet", true, ['Flute', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
			["Ether Tablet", true, ['Flute', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
			["Ether Tablet", true, ['Flute', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
			["Ether Tablet", true, ['Flute', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
			["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
			["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
			["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
			["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
			["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
			["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
			["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
			["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
			["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
			["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
			["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
			["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
			["Ether Tablet", true, ['Flute', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
			["Ether Tablet", true, ['Flute', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
			["Ether Tablet", true, ['Flute', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
			["Ether Tablet", true, ['Flute', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
			["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
			["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
			["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
			["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
			["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
			["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
			["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
			["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
			["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
			["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
			["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
			["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],

			["Old Mountain Man", false, []],
			["Old Mountain Man", false, [], ['Gloves', 'Flute']],
			["Old Mountain Man", false, [], ['Lamp']],
			["Old Mountain Man", true, ['Flute', 'Lamp']],
			["Old Mountain Man", true, ['ProgressiveGlove', 'Lamp']],
			["Old Mountain Man", true, ['PowerGlove', 'Lamp']],
			["Old Mountain Man", true, ['TitansMitt', 'Lamp']],

			["Piece of Heart (Spectacle Rock Cave)", false, []],
			["Piece of Heart (Spectacle Rock Cave)", false, [], ['Gloves', 'Flute']],
			["Piece of Heart (Spectacle Rock Cave)", true, ['Flute']],
			["Piece of Heart (Spectacle Rock Cave)", true, ['ProgressiveGlove', 'Lamp']],
			["Piece of Heart (Spectacle Rock Cave)", true, ['PowerGlove', 'Lamp']],
			["Piece of Heart (Spectacle Rock Cave)", true, ['TitansMitt', 'Lamp']],

			["Piece of Heart (Spectacle Rock)", false, []],
			["Piece of Heart (Spectacle Rock)", false, [], ['Gloves', 'Flute']],
			["Piece of Heart (Spectacle Rock)", false, [], ['MagicMirror']],
			["Piece of Heart (Spectacle Rock)", true, ['Flute', 'MagicMirror']],
			["Piece of Heart (Spectacle Rock)", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Piece of Heart (Spectacle Rock)", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
			["Piece of Heart (Spectacle Rock)", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
		];
	}
}
