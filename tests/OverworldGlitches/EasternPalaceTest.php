<?php namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class EasternPalaceTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'OverworldGlitches');
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
			["Eastern Palace - Compass Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

			["Eastern Palace - Cannonball Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

			["Eastern Palace - Big Chest", false, 'BigKeyP1', [], ['BigKeyP1']],

			["Eastern Palace - Map Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

			["Eastern Palace - Big Key Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

			["Eastern Palace - Armos Knights", false, 'BigKeyP1', [], ['BigKeyP1']],
		];
	}

	public function accessPool() {
		return [
			["Eastern Palace - Compass Chest", true, []],

			["Eastern Palace - Cannonball Chest", true, []],

			["Eastern Palace - Big Chest", false, []],
			["Eastern Palace - Big Chest", false, [], ['BigKeyP1']],
			["Eastern Palace - Big Chest", true, ['BigKeyP1']],

			["Eastern Palace - Map Chest", true, []],

			["Eastern Palace - Big Key Chest", false, []],
			["Eastern Palace - Big Key Chest", false, [], ['Lamp']],
			["Eastern Palace - Big Key Chest", true, ['Lamp']],


			["Eastern Palace - Armos Knights", false, []],
			["Eastern Palace - Armos Knights", false, [], ['Lamp']],
			["Eastern Palace - Armos Knights", false, [], ['AnyBow']],
			["Eastern Palace - Armos Knights", false, [], ['BigKeyP1']],
			["Eastern Palace - Armos Knights", true, ['Lamp', 'Bow', 'BigKeyP1']],
		];
	}
}
