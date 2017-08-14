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
			["[cave-055] Spike cave", false, [], ['Cape', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Flute', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'Flute', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'Flute', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Flute', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Flute', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Flute', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Flute', 'Cape']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Flute', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Flute', 'CaneOfByrna']],
			["[cave-055] Spike cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Flute', 'CaneOfByrna']],
		];
	}
}
