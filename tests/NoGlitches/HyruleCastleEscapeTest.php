<?php namespace NoGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NoGlitches
 */
class HyruleCastleEscapeTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = World::factory('standard', 'test_rules', 'NoGlitches');
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

			["Sanctuary", false, 'KeyH2', [], ['KeyH2']],

			["Sewers - Secret Room - Left", false, 'KeyH2', [], ['KeyH2']],

			["Sewers - Secret Room - Middle", false, 'KeyH2', [], ['KeyH2']],

			["Sewers - Secret Room - Right", false, 'KeyH2', [], ['KeyH2']],

			["Sewers - Dark Cross", true, 'KeyH2', [], ['KeyH2']],

			["Hyrule Castle - Boomerang Chest", true, 'KeyH2', [], ['KeyH2']],

			["Hyrule Castle - Map Chest", true, 'KeyH2', [], ['KeyH2']],

			["Hyrule Castle - Zelda's Cell", true, 'KeyH2', [], ['KeyH2']],
		];
	}

	public function accessPool() {
		return [
			["Sanctuary", true, ['L1Sword', 'KeyH2']],

			["Sewers - Secret Room - Left", true, ['L1Sword', 'KeyH2']],

			["Sewers - Secret Room - Middle", true, ['L1Sword', 'KeyH2']],

			["Sewers - Secret Room - Right", true, ['L1Sword', 'KeyH2']],

			["Sewers - Dark Cross", true, ['L1Sword']],

			["Hyrule Castle - Boomerang Chest", true, ['L1Sword']],

			["Hyrule Castle - Map Chest", true, ['L1Sword']],

			["Hyrule Castle - Zelda's Cell", true, ['L1Sword']],
		];
	}
}
