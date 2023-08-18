<?php

namespace InvertedMajorGlitches;

use ALttP\Item;
use ALttP\Rom;
use ALttP\Support\ItemCollection;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class DesertPalaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
        $this->world_free_items = World::factory('standard', ['difficulty' => 'test_rules',
            'logic' => 'MajorGlitches',
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
            [true, []],
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
            ["Desert Palace - Map Chest", true, []],

            ["Desert Palace - Big Chest", false, []],
            ["Desert Palace - Big Chest", true, [ 'BigKeyP2']],

            ["Desert Palace - Torch", false, []],
            ["Desert Palace - Torch", false, [], ['PegasusBoots']],
            ["Desert Palace - Torch", true, ['PegasusBoots']],

            ["Desert Palace - Compass Chest", false, []],
            ["Desert Palace - Compass Chest", false, [], ['KeyP2']],
            ["Desert Palace - Compass Chest", true, ['KeyP2']],

            ["Desert Palace - Big Key Chest", false, []],
            ["Desert Palace - Big Key Chest", false, [], ['KeyP2']],
            ["Desert Palace - Big Key Chest", true, ['KeyP2']],

            ["Desert Palace - Boss", false, []],
            ["Desert Palace - Boss", false, [], ['KeyP2']],
            ["Desert Palace - Boss", false, [], ['BigKeyP2']],
            ["Desert Palace - Boss", false, [], ['Lamp', 'FireRod']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BigKeyP2', 'Lamp']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BigKeyP2', 'FireRod']],
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
            ["Desert Palace - Map Chest", "KeyP2", 0x24, false],
            ["Desert Palace - Map Chest", "BigKeyP2", 0x9C, true],
            ["Desert Palace - Map Chest", "BigKeyP2", 0x32, false],
            ["Desert Palace - Map Chest", "CompassP2", 0x8C, true],
            ["Desert Palace - Map Chest", "CompassP2", 0x25, false],
            ["Desert Palace - Map Chest", "MapP2", 0x7C, true],
            ["Desert Palace - Map Chest", "MapP2", 0x33, false],
        ];
    }
}
