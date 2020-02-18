<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class SkullWoodsTest extends TestCase
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
            ["Skull Woods - Big Chest", true, ['MagicMirror', 'PegasusBoots', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'PegasusBoots', 'BigKeyD3']],

            ["Skull Woods - Big Key Chest", false, []],
            ["Skull Woods - Big Key Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Compass Chest", false, []],
            ["Skull Woods - Compass Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Map Chest", false, []],
            ["Skull Woods - Map Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Bridge Room", false, []],
            ["Skull Woods - Bridge Room", false, [], ['MoonPearl']],
            ["Skull Woods - Bridge Room", false, [], ['FireRod']],
            ["Skull Woods - Bridge Room", true, ['MoonPearl', 'PegasusBoots', 'FireRod']],

            ["Skull Woods - Pot Prison", false, []],
            ["Skull Woods - Pot Prison", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Pinball Room", false, []],
            ["Skull Woods - Pinball Room", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Pinball Room", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Boss", false, []],
            ["Skull Woods - Boss", false, [], ['MoonPearl']],
            ["Skull Woods - Boss", false, [], ['FireRod']],
            ["Skull Woods - Boss", false, [], ['AnySword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'ProgressiveSword']],
        ];
    }
}
