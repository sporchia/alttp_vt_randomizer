<?php namespace NoMajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class MireTest extends TestCase {
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
			["[cave-071] Misery Mire west area [left chest]", false, []],
			["[cave-071] Misery Mire west area [left chest]", false, [], ['Gloves']],
			["[cave-071] Misery Mire west area [left chest]", false, [], ['MoonPearl']],
			["[cave-071] Misery Mire west area [left chest]", false, [], ['Flute']],
			["[cave-071] Misery Mire west area [left chest]", true, ['MoonPearl', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-071] Misery Mire west area [left chest]", true, ['MoonPearl', 'Flute', 'TitansMitt']],

			["[cave-071] Misery Mire west area [right chest]", false, []],
			["[cave-071] Misery Mire west area [right chest]", false, [], ['Gloves']],
			["[cave-071] Misery Mire west area [right chest]", false, [], ['MoonPearl']],
			["[cave-071] Misery Mire west area [right chest]", false, [], ['Flute']],
			["[cave-071] Misery Mire west area [right chest]", true, ['MoonPearl', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[cave-071] Misery Mire west area [right chest]", true, ['MoonPearl', 'Flute', 'TitansMitt']],
		];
	}
}
