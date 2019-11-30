<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class TowerOfHeraTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
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
            [true, ['PegasusBoots']],
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
            ["Tower of Hera - Big Key Chest", true, ['Lamp', 'PegasusBoots', 'KeyP3']],

            ["Tower of Hera - Basement Cage", false, []],
            ["Tower of Hera - Basement Cage", true, ['PegasusBoots']],

            ["Tower of Hera - Map Chest", false, []],
            ["Tower of Hera - Map Chest", true, ['PegasusBoots']],

            ["Tower of Hera - Compass Chest", false, []],
            ["Tower of Hera - Compass Chest", true, ['PegasusBoots', 'BigKeyP3']],

            ["Tower of Hera - Big Chest", false, []],
            ["Tower of Hera - Big Chest", true, ['PegasusBoots', 'BigKeyP3']],

            ["Tower of Hera - Boss", false, []],
            ["Tower of Hera - Boss", false, [], ['AnySword', 'Hammer']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'ProgressiveSword']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'UncleSword']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'MasterSword']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'L3Sword']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'L4Sword']],
            ["Tower of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'Hammer']],
        ];
    }
}
