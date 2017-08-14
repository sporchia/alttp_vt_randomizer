<?php

use ALttP\Item;
use ALttP\Region;
use ALttP\World;

class RegionTest extends TestCase {
	public function setUp() {
		parent::setUp();

		$this->region = new Region(new World('test_rules', 'NoMajorGlitches'));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->region);
	}

	 /**
	 * @dataProvider dungeonItemsPool
	 */
	public function testRegionLockedItems(bool $access, Item $item, bool $free = null, string $config = null) {
		if ($config) {
			config(["alttp.test_rules.$config" => $free]);
		}

		$this->assertEquals($access, $this->region->canFill($item));
	}

	public function dungeonItemsPool() {
		return [
			[false, Item::get('Key')],
			[false, Item::get('KeyH2')],
			[false, Item::get('KeyH1')],
			[false, Item::get('KeyP1')],
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

			[false, Item::get('BigKey')],
			[false, Item::get('BigKeyH2')],
			[false, Item::get('BigKeyH1')],
			[false, Item::get('BigKeyP1')],
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

			[false, Item::get('Map'), true, 'region.mapsInDungeons'],
			[true, Item::get('Map'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapH2'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapH2'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapH1'), true, 'region.mapsInDungeons'],
			[true, Item::get('MapH1'), false, 'region.mapsInDungeons'],
			[false, Item::get('MapP1'), true, 'region.mapsInDungeons'],
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

			[false, Item::get('Compass'), true, 'region.compassesInDungeons'],
			[true, Item::get('Compass'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassH2'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassH2'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassH1'), true, 'region.compassesInDungeons'],
			[true, Item::get('CompassH1'), false, 'region.compassesInDungeons'],
			[false, Item::get('CompassP1'), true, 'region.compassesInDungeons'],
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
