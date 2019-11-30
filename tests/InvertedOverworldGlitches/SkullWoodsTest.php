<?php

namespace InvertedOverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class SkullWoodsTest extends TestCase
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
            ["Skull Woods - Big Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

            ["Skull Woods - Big Key Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

            ["Skull Woods - Compass Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

            ["Skull Woods - Map Chest", true, 'BigKeyD3', [], ['BigKeyD3']],

            ["Skull Woods - Bridge Room", true, 'BigKeyD3', [], ['BigKeyD3']],

            ["Skull Woods - Pot Prison", true, 'BigKeyD3', [], ['BigKeyD3']],

            ["Skull Woods - Pinball Room", true, 'KeyD3', [], ['KeyD3']],

            ["Skull Woods - Boss", true, 'BigKeyD3', [], ['BigKeyD3']],
            ["Skull Woods - Boss", false, 'KeyD3', [], ['KeyD3']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Skull Woods - Big Chest", false, []],
            ["Skull Woods - Big Chest", false, [], ['BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['BigKeyD3']],

            ["Skull Woods - Big Key Chest", true, []],

            ["Skull Woods - Compass Chest", true, []],

            ["Skull Woods - Map Chest", true, []],

            ["Skull Woods - Bridge Room", false, []],
            ["Skull Woods - Bridge Room", false, [], ['FireRod']],
            ["Skull Woods - Bridge Room", true, ['FireRod']],

            ["Skull Woods - Pot Prison", true, []],

            ["Skull Woods - Pinball Room", true, []],

            ["Skull Woods - Boss", false, []],
            ["Skull Woods - Boss", false, [], ['FireRod']],
            ["Skull Woods - Boss", false, [], ['AnySword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'L4Sword']],
        ];
    }
}
