<?php namespace OverworldGlitches\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class WestTest extends TestCase {
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
			["[cave-055] Spike cave", false, []],
			["[cave-055] Spike cave", false, [], ['Gloves']],
			["[cave-055] Spike cave", false, [], ['MoonPearl']],
			["[cave-055] Spike cave", false, [], ['Hammer']],
			["[cave-055] Spike cave", true, ['MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp']],
			["[cave-055] Spike cave", true, ['MoonPearl', 'Hammer', 'PowerGlove', 'Lamp']],
			["[cave-055] Spike cave", true, ['MoonPearl', 'Hammer', 'TitansMitt', 'Lamp']],
			["[cave-055] Spike cave", true, ['MoonPearl', 'Hammer', 'ProgressiveGlove', 'Flute']],
			["[cave-055] Spike cave", true, ['MoonPearl', 'Hammer', 'PowerGlove', 'Flute']],
			["[cave-055] Spike cave", true, ['MoonPearl', 'Hammer', 'TitansMitt', 'Flute']],
		];
	}
}
