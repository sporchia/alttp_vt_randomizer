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

	/**
	 * @dataProvider dungeonItemsPool
	 */
	public function testRegionLockedItems(bool $access, Item $item, bool $free = null, string $config = null) {
		if ($config) {
			config(["alttp.test_rules.$config" => $free]);
		}

		$this->assertEquals($access, $this->world->getRegion('Eastern Palace')->canFill($item));
	}

	public function dungeonItemsPool() {
		return [
			[true, Item::get('Key')],
			[false, Item::get('KeyH2')],
			[false, Item::get('KeyH1')],
			[true, Item::get('KeyP1')],
			[false, Item::get('KeyP2')],
			[false, Item::get('KeyA1')],
			[false, Item::get('KeyD2')],
			[false, Item::get('KeyD1')],
			[false, Item::get('KeyD6')],
			[false, Item::get('KeyD3')],
			[false, Item::get('KeyD5')],
			[false, Item::get('KeyP3')],
			[false, Item::get('KeyD4')],
			[false, Item::get('KeyD7')],
			[false, Item::get('KeyA2')],

			[true, Item::get('BigKey')],
			[false, Item::get('BigKeyH2')],
			[false, Item::get('BigKeyH1')],
			[true, Item::get('BigKeyP1')],
			[false, Item::get('BigKeyP2')],
			[false, Item::get('BigKeyA1')],
			[false, Item::get('BigKeyD2')],
			[false, Item::get('BigKeyD1')],
			[false, Item::get('BigKeyD6')],
			[false, Item::get('BigKeyD3')],
			[false, Item::get('BigKeyD5')],
			[false, Item::get('BigKeyP3')],
			[false, Item::get('BigKeyD4')],
			[false, Item::get('BigKeyD7')],
			[false, Item::get('BigKeyA2')],

			[true, Item::get('Map'), true, 'region.mapsInDungeons'],
			[true, Item::get('Map'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapH2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapH2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapH1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapH1'), false, 'region.mapsInDungeons'],
			[true, Item::get('MapP1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapP1'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapP2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapP2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapA1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapA1'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD1'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD6'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD6'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD3'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD3'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD5'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD5'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapP3'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapP3'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD4'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD4'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapD7'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapD7'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapA2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapA2'), false, 'region.mapsInDungeons'],

			[true, Item::get('Compass'), true, 'region.compassesInDungeons'],
			[true, Item::get('Compass'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassH2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassH2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassH1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassH1'), false, 'region.compassesInDungeons'],
			[true, Item::get('CompassP1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassP1'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassP2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassP2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassA1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassA1'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD1'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD6'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD6'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD3'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD3'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD5'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD5'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassP3'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassP3'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD4'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD4'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassD7'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassD7'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassA2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassA2'), false, 'region.compassesInDungeons'],
		];
	}
}
