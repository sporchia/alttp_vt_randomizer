<?php

namespace InvertedOverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class TowerOfHeraTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
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

        $this->assertEquals($access, $this->world->getRegion('Tower of Hera')
            ->canEnter($this->world->getLocations(), $this->collected));
    }

    public function entryPool()
    {
        return [
            [false, []],
            [false, [], ['MoonPearl']],
            [true, ['PegasusBoots', 'MoonPearl']],
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
            ["Tower of Hera - Big Key Chest", true, 'BigKeyP3', [], ['BigKeyP3']],
            ["Tower of Hera - Big Key Chest", true, 'KeyP3', [], ['KeyP3']],

            ["Tower of Hera - Basement Cage", true, 'BigKeyP3', [], ['BigKeyP3']],

            ["Tower of Hera - Map Chest", true, 'BigKeyP3', [], ['BigKeyP3']],

            ["Tower of Hera - Compass Chest", false, 'BigKeyP3', [], ['BigKeyP3']],

            ["Tower of Hera - Big Chest", false, 'BigKeyP3', [], ['BigKeyP3']],

            ["Tower of Hera - Boss", false, 'BigKeyP3', [], ['BigKeyP3']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Tower of Hera - Big Key Chest", false, []],
            ["Tower of Hera - Big Key Chest", false, [], ['Lamp', 'FireRod']],
            ["Tower of Hera - Big Key Chest", false, [], ['MoonPearl']],
            ["Tower of Hera - Big Key Chest", false, [], ['KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['Lamp', 'PegasusBoots', 'MoonPearl', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['FireRod', 'PegasusBoots', 'MoonPearl', 'KeyP3']],

            ["Tower of Hera - Basement Cage", false, []],
            ["Tower of Hera - Basement Cage", false, [], ['MoonPearl']],
            ["Tower of Hera - Basement Cage", true, ['PegasusBoots', 'MoonPearl']],

            ["Tower of Hera - Map Chest", false, []],
            ["Tower of Hera - Map Chest", false, [], ['MoonPearl']],
            ["Tower of Hera - Map Chest", true, ['PegasusBoots', 'MoonPearl']],

            ["Tower of Hera - Compass Chest", false, []],
            ["Tower of Hera - Compass Chest", false, [], ['MoonPearl']],
            ["Tower of Hera - Compass Chest", false, [], ['BigKeyP3']],
            ["Tower of Hera - Compass Chest", true, ['PegasusBoots', 'MoonPearl', 'BigKeyP3']],

            ["Tower of Hera - Big Chest", false, []],
            ["Tower of Hera - Big Chest", false, [], ['MoonPearl']],
            ["Tower of Hera - Big Chest", false, [], ['BigKeyP3']],
            ["Tower of Hera - Big Chest", true, ['PegasusBoots', 'MoonPearl', 'BigKeyP3']],
            
            ["Tower of Hera - Boss", false, []],
            ["Tower of Hera - Boss", false, [], ['MoonPearl']],
            ["Tower of Hera - Boss", false, [], ['AnySword', 'Hammer']],
            ["Tower of Hera - Boss", false, [], ['BigKeyP3']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'UncleSword', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'ProgressiveSword', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'MasterSword', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'L3Sword', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'L4Sword', 'BigKeyP3']],
        ];
    }
}
