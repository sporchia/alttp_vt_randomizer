<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class MiseryMireTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');

		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether'));
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
			["[dungeon-D6-B1] Misery Mire - big chest", false, 'BigKeyD6', [], ['BigKeyD6']],

			["[dungeon-D6-B1] Misery Mire - big hub room", true, 'BigKeyD6', [], ['BigKeyD6']],

			["[dungeon-D6-B1] Misery Mire - big key", true, 'BigKeyD6', [], ['BigKeyD6']],

			["[dungeon-D6-B1] Misery Mire - compass", true, 'BigKeyD6', [], ['BigKeyD6']],

			["[dungeon-D6-B1] Misery Mire - end of bridge", true, 'BigKeyD6', [], ['BigKeyD6']],

			["[dungeon-D6-B1] Misery Mire - map room", true, 'BigKeyD6', [], ['BigKeyD6']],

			["[dungeon-D6-B1] Misery Mire - spike room", true, 'BigKeyD6', [], ['BigKeyD6']],

			["Heart Container - Vitreous", false, 'BigKeyD6', [], ['BigKeyD6']],
		];
	}

	public function accessPool() {
		return [
			["[dungeon-D6-B1] Misery Mire - big chest", false, []],
			["[dungeon-D6-B1] Misery Mire - big chest", false, [], ['BigKeyD6']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

			["[dungeon-D6-B1] Misery Mire - big hub room", false, []],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big hub room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

			["[dungeon-D6-B1] Misery Mire - big key", false, []],
			["[dungeon-D6-B1] Misery Mire - big key", false, [], ['FireRod', 'Lamp']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - big key", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

			["[dungeon-D6-B1] Misery Mire - compass", false, []],
			["[dungeon-D6-B1] Misery Mire - compass", false, [], ['FireRod', 'Lamp']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - compass", true, ['KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

			["[dungeon-D6-B1] Misery Mire - end of bridge", false, []],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - end of bridge", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

			["[dungeon-D6-B1] Misery Mire - map room", false, []],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["[dungeon-D6-B1] Misery Mire - map room", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

			["[dungeon-D6-B1] Misery Mire - spike room", false, []],
			["[dungeon-D6-B1] Misery Mire - spike room", false, [], ['Cape', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot', 'CaneOfByrna']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots', 'Cape']],
			["[dungeon-D6-B1] Misery Mire - spike room", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot', 'Cape']],

			["Heart Container - Vitreous", false, []],
			["Heart Container - Vitreous", false, [], ['Lamp']],
			["Heart Container - Vitreous", false, [], ['CaneOfSomaria']],
			["Heart Container - Vitreous", false, [], ['BigKeyD6']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'PegasusBoots']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L1Sword', 'Hookshot']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
			["Heart Container - Vitreous", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

		];
	}
}
