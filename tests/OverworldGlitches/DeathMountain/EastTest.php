<?php namespace OverworldGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use ALttP\Support\ItemCollection as Items;
use TestCase;

/**
 * @group OverworldGlitches
 */
class EastTest extends TestCase {
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
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, []],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['PegasusBoots']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['Flute', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, [], ['Gloves', 'Flute', 'PegasusBoots']],
		];
	}
}
