<?php namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class HyruleCastleEscapeTest extends TestCase {
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

			["[dungeon-C-1F] Sanctuary", false, 'KeyH2', [], ['KeyH2']],

			["[dungeon-C-B1] Escape - final basement room [left chest]", false, 'KeyH2', [], ['KeyH2']],

			["[dungeon-C-B1] Escape - final basement room [middle chest]", false, 'KeyH2', [], ['KeyH2']],

			["[dungeon-C-B1] Escape - final basement room [right chest]", false, 'KeyH2', [], ['KeyH2']],

			["[dungeon-C-B1] Escape - first B1 room", true, 'KeyH2', [], ['KeyH2']],

			["[dungeon-C-B1] Hyrule Castle - boomerang room", true, 'KeyH2', [], ['KeyH2']],

			["[dungeon-C-B1] Hyrule Castle - map room", true, 'KeyH2', [], ['KeyH2']],

			["[dungeon-C-B3] Hyrule Castle - next to Zelda", true, 'KeyH2', [], ['KeyH2']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-C-1F] Sanctuary", true, []],

			["[dungeon-C-B1] Escape - final basement room [left chest]", true, []],

			["[dungeon-C-B1] Escape - final basement room [middle chest]", true, []],

			["[dungeon-C-B1] Escape - final basement room [right chest]", true, []],

			["[dungeon-C-B1] Escape - first B1 room", true, []],

			["[dungeon-C-B1] Hyrule Castle - boomerang room", true, []],

			["[dungeon-C-B1] Hyrule Castle - map room", true, []],

			["[dungeon-C-B3] Hyrule Castle - next to Zelda", true, []],
		];
	}
}
