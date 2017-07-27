<?php namespace NoMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class EasternPalaceTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	// Entry
	public function testNothingRequiredToEnter() {
		$this->assertTrue($this->world->getRegion('Eastern Palace')
			->canEnter($this->world->getLocations(), $this->collected));
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

	/**
	 * @param string $location
	 * @param bool $access
	 * @param string $item
	 * @param array $items
	 * @param array $except
	 * @param array $keys
	 * @param string $big_key
	 *
	 * @dataProvider fillPool
	 */
	public function testFillLocation(string $location, bool $access, string $item, array $items = [], array $except = []) {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}

		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getLocation($location)
			->fill(Item::get($item), $this->collected));
	}

	public function fillPool() {
		return [
			["[dungeon-L1-1F] Eastern Palace - compass room", true, 'BigKeyP1', [], ['BigKeyP1']],

			["[dungeon-L1-1F] Eastern Palace - big ball room", true, 'BigKeyP1', [], ['BigKeyP1']],

			["[dungeon-L1-1F] Eastern Palace - big chest", false, 'BigKeyP1', [], ['BigKeyP1']],

			["[dungeon-L1-1F] Eastern Palace - map room", true, 'BigKeyP1', [], ['BigKeyP1']],

			["[dungeon-L1-1F] Eastern Palace - Big key", true, 'BigKeyP1', [], ['BigKeyP1']],

			["Heart Container - Armos Knights", false, 'BigKeyP1', [], ['BigKeyP1']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-L1-1F] Eastern Palace - compass room", true, []],

			["[dungeon-L1-1F] Eastern Palace - big ball room", true, []],

			["[dungeon-L1-1F] Eastern Palace - big chest", false, []],
			["[dungeon-L1-1F] Eastern Palace - big chest", false, [], ['BigKeyP1']],
			["[dungeon-L1-1F] Eastern Palace - big chest", true, ['BigKeyP1']],

			["[dungeon-L1-1F] Eastern Palace - map room", true, []],

			["[dungeon-L1-1F] Eastern Palace - Big key", false, []],
			["[dungeon-L1-1F] Eastern Palace - Big key", false, [], ['Lamp']],
			["[dungeon-L1-1F] Eastern Palace - Big key", true, ['Lamp']],


			["Heart Container - Armos Knights", false, []],
			["Heart Container - Armos Knights", false, [], ['Lamp']],
			["Heart Container - Armos Knights", false, [], ['AnyBow']],
			["Heart Container - Armos Knights", false, [], ['BigKeyP1']],
			["Heart Container - Armos Knights", true, ['Lamp', 'Bow', 'BigKeyP1']],
		];
	}
}
