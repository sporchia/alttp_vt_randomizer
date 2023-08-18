<?php

namespace NoGlitches;

use ALttP\Item;
use ALttP\Rom;
use ALttP\Support\ItemCollection;
use ALttP\World;
use TestCase;

/**
 * @group NoGlitches
 */
class DesertPalaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
        $this->world_free_items = World::factory('standard', ['difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
            'region.wildKeys' => true,
            'region.wildBigKeys' => true,
            'region.wildCompasses' => true,
            'region.wildMaps' => true,
        ]);
        $this->addCollected(['RescueZelda']);
        $this->collected->setChecksForWorld($this->world->id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    /**
     * @param bool $access
     * @param array $items
     * @param array $except
     *
     * @dataProvider entryPool
     */
    public function testEntry(bool $access, array $items, array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getRegion('Desert Palace')
            ->canEnter($this->world->getLocations(), $this->collected));
    }

    public function entryPool()
    {
        return [
            [false, []],
            [true, ['BookOfMudora']],
            [true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            [true, ['Flute', 'MagicMirror', 'TitansMitt']],
        ];
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
    public function testFillLocation(string $location, bool $access, string $item, array $items = [], array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getLocation($location)
            ->fill(Item::get($item, $this->world), $this->collected));
    }

    public function fillPool()
    {
        return [
            ["Desert Palace - Big Key Chest", false, 'KeyP2', [], ['KeyP2']],
            ["Desert Palace - Compass Chest", false, 'KeyP2', [], ['KeyP2']],

            ["Desert Palace - Big Chest", false, 'BigKeyP2', [], ['BigKeyP2']],

            ["Desert Palace - Boss", false, 'BigKeyP2', [], ['BigKeyP2']],
            ["Desert Palace - Boss", false, 'KeyP2', [], ['KeyP2']],
        ];
    }

    /**
     * @param string $location
     * @param bool $access
     * @param array $items
     * @param array $except
     *
     * @dataProvider accessPool
     */
    public function testLocation(string $location, bool $access, array $items, array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getLocation($location)
            ->canAccess($this->collected));
    }

    public function accessPool()
    {
        return [
            ["Desert Palace - Map Chest", false, []],
            ["Desert Palace - Map Chest", true, ['BookOfMudora']],
            ["Desert Palace - Map Chest", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Palace - Map Chest", true, ['Flute', 'MagicMirror', 'TitansMitt']],

            ["Desert Palace - Big Chest", false, []],
            ["Desert Palace - Big Chest", true, ['BookOfMudora', 'BigKeyP2']],
            ["Desert Palace - Big Chest", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Big Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'BigKeyP2']],

            ["Desert Palace - Torch", false, []],
            ["Desert Palace - Torch", false, [], ['PegasusBoots']],
            ["Desert Palace - Torch", true, ['BookOfMudora', 'PegasusBoots']],
            ["Desert Palace - Torch", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots']],
            ["Desert Palace - Torch", true, ['Flute', 'MagicMirror', 'TitansMitt', 'PegasusBoots']],

            ["Desert Palace - Compass Chest", false, []],
            ["Desert Palace - Compass Chest", false, [], ['KeyP2']],
            ["Desert Palace - Compass Chest", true, ['BookOfMudora', 'KeyP2']],
            ["Desert Palace - Compass Chest", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP2']],
            ["Desert Palace - Compass Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'KeyP2']],

            ["Desert Palace - Big Key Chest", false, []],
            ["Desert Palace - Big Key Chest", false, [], ['KeyP2']],
            ["Desert Palace - Big Key Chest", true, ['BookOfMudora', 'KeyP2']],
            ["Desert Palace - Big Key Chest", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP2']],
            ["Desert Palace - Big Key Chest", true, ['Flute', 'MagicMirror', 'TitansMitt', 'KeyP2']],

            ["Desert Palace - Boss", false, []],
            ["Desert Palace - Boss", false, [], ['KeyP2']],
            ["Desert Palace - Boss", false, [], ['BigKeyP2']],
            ["Desert Palace - Boss", false, [], ['Gloves']],
            ["Desert Palace - Boss", false, [], ['Lamp', 'FireRod']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'Lamp', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'Lamp', 'PowerGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'Lamp', 'TitansMitt', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'FireRod', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'FireRod', 'PowerGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'FireRod', 'TitansMitt', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'Flute', 'MagicMirror', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'Flute', 'MagicMirror', 'Lamp', 'TitansMitt', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'Flute', 'MagicMirror', 'FireRod', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'Flute', 'MagicMirror', 'FireRod', 'TitansMitt', 'BigKeyP2']],
        ];
    }

    /**
     * @dataProvider dungeonItemsPool
     */
    public function testRegionLockedItems(bool $access, string $item_name, bool $free = null, string $config = null)
    {
        if ($config) {
            $this->world->testSetConfig($config, $free);
        }

        $this->assertEquals($access, $this->world->getRegion('Desert Palace')->canFill(Item::get($item_name, $this->world)));
    }

    public function dungeonItemsPool()
    {
        return [
            [true, 'Key'],
            [false, 'KeyH2'],
            [false, 'KeyH1'],
            [false, 'KeyP1'],
            [true, 'KeyP2'],
            [false, 'KeyA1'],
            [false, 'KeyD2'],
            [false, 'KeyD1'],
            [false, 'KeyD6'],
            [false, 'KeyD3'],
            [false, 'KeyD5'],
            [false, 'KeyP3'],
            [false, 'KeyD4'],
            [false, 'KeyD7'],
            [false, 'KeyA2'],

            [true, 'BigKey'],
            [false, 'BigKeyH2'],
            [false, 'BigKeyH1'],
            [false, 'BigKeyP1'],
            [true, 'BigKeyP2'],
            [false, 'BigKeyA1'],
            [false, 'BigKeyD2'],
            [false, 'BigKeyD1'],
            [false, 'BigKeyD6'],
            [false, 'BigKeyD3'],
            [false, 'BigKeyD5'],
            [false, 'BigKeyP3'],
            [false, 'BigKeyD4'],
            [false, 'BigKeyD7'],
            [false, 'BigKeyA2'],

            [true, 'Map', false, 'region.wildMaps'],
            [true, 'Map', true, 'region.wildMaps'],
            [false, 'MapH2', false, 'region.wildMaps'],
            [true, 'MapH2', true, 'region.wildMaps'],
            [false, 'MapH1', false, 'region.wildMaps'],
            [true, 'MapH1', true, 'region.wildMaps'],
            [false, 'MapP1', false, 'region.wildMaps'],
            [true, 'MapP1', true, 'region.wildMaps'],
            [true, 'MapP2', false, 'region.wildMaps'],
            [true, 'MapP2', true, 'region.wildMaps'],
            [false, 'MapA1', false, 'region.wildMaps'],
            [true, 'MapA1', true, 'region.wildMaps'],
            [false, 'MapD2', false, 'region.wildMaps'],
            [true, 'MapD2', true, 'region.wildMaps'],
            [false, 'MapD1', false, 'region.wildMaps'],
            [true, 'MapD1', true, 'region.wildMaps'],
            [false, 'MapD6', false, 'region.wildMaps'],
            [true, 'MapD6', true, 'region.wildMaps'],
            [false, 'MapD3', false, 'region.wildMaps'],
            [true, 'MapD3', true, 'region.wildMaps'],
            [false, 'MapD5', false, 'region.wildMaps'],
            [true, 'MapD5', true, 'region.wildMaps'],
            [false, 'MapP3', false, 'region.wildMaps'],
            [true, 'MapP3', true, 'region.wildMaps'],
            [false, 'MapD4', false, 'region.wildMaps'],
            [true, 'MapD4', true, 'region.wildMaps'],
            [false, 'MapD7', false, 'region.wildMaps'],
            [true, 'MapD7', true, 'region.wildMaps'],
            [false, 'MapA2', false, 'region.wildMaps'],
            [true, 'MapA2', true, 'region.wildMaps'],

            [true, 'Compass', false, 'region.wildCompasses'],
            [true, 'Compass', true, 'region.wildCompasses'],
            [false, 'CompassH2', false, 'region.wildCompasses'],
            [true, 'CompassH2', true, 'region.wildCompasses'],
            [false, 'CompassH1', false, 'region.wildCompasses'],
            [true, 'CompassH1', true, 'region.wildCompasses'],
            [false, 'CompassP1', false, 'region.wildCompasses'],
            [true, 'CompassP1', true, 'region.wildCompasses'],
            [true, 'CompassP2', false, 'region.wildCompasses'],
            [true, 'CompassP2', true, 'region.wildCompasses'],
            [false, 'CompassA1', false, 'region.wildCompasses'],
            [true, 'CompassA1', true, 'region.wildCompasses'],
            [false, 'CompassD2', false, 'region.wildCompasses'],
            [true, 'CompassD2', true, 'region.wildCompasses'],
            [false, 'CompassD1', false, 'region.wildCompasses'],
            [true, 'CompassD1', true, 'region.wildCompasses'],
            [false, 'CompassD6', false, 'region.wildCompasses'],
            [true, 'CompassD6', true, 'region.wildCompasses'],
            [false, 'CompassD3', false, 'region.wildCompasses'],
            [true, 'CompassD3', true, 'region.wildCompasses'],
            [false, 'CompassD5', false, 'region.wildCompasses'],
            [true, 'CompassD5', true, 'region.wildCompasses'],
            [false, 'CompassP3', false, 'region.wildCompasses'],
            [true, 'CompassP3', true, 'region.wildCompasses'],
            [false, 'CompassD4', false, 'region.wildCompasses'],
            [true, 'CompassD4', true, 'region.wildCompasses'],
            [false, 'CompassD7', false, 'region.wildCompasses'],
            [true, 'CompassD7', true, 'region.wildCompasses'],
            [false, 'CompassA2', false, 'region.wildCompasses'],
            [true, 'CompassA2', true, 'region.wildCompasses'],
        ];
    }

    /**
     * @param string $chest_location
     * @param string $item_name
     * @param int $expected
     * @param bool $free
     *
     * @dataProvider selfDungeonItemsPool
     */
    public function testDungeonItemWrite(string $chest_location, string $item_name, int $expected, bool $free)
    {
        $rom = new Rom();
        $world = $free ? $this->world_free_items : $this->world;
        $location = $world->getLocation($chest_location);
        $location->fill(Item::get($item_name, $world), new ItemCollection(), false);
        $location->writeItem($rom, Item::get($item_name, $world));

        $this->assertEquals($expected, $rom->read($location->getAddress()[0]));
    }

    public function selfDungeonItemsPool()
    {
        return [
            ["Desert Palace - Map Chest", "KeyP2", 0xA3, true],
            ["Desert Palace - Map Chest", "KeyP2", 0xA3, false],
            ["Desert Palace - Map Chest", "BigKeyP2", 0x9C, true],
            ["Desert Palace - Map Chest", "BigKeyP2", 0x9C, false],
            ["Desert Palace - Map Chest", "CompassP2", 0x8C, true],
            ["Desert Palace - Map Chest", "CompassP2", 0x8C, false],
            ["Desert Palace - Map Chest", "MapP2", 0x7C, true],
            ["Desert Palace - Map Chest", "MapP2", 0x7C, false],
        ];
    }
}
