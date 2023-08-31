<?php

namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class SkullWoodsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
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
            ["Skull Woods - Bridge Room", false, [], ['MoonPearl', 'MagicMirror', 'AnyBottle']],
            ["Skull Woods - Bridge Room", false, [], ['MoonPearl', 'PegasusBoots']],
            ["Skull Woods - Bridge Room", true, ['FireRod', 'MoonPearl']],

            ["Skull Woods - Pot Prison", true, []],

            ["Skull Woods - Pinball Room", true, []],

            ["Skull Woods - Boss", false, []],
            ["Skull Woods - Boss", false, [], ['FireRod']],
            ["Skull Woods - Boss", false, [], ['AnySword']],
            ["Skull Woods - Boss", false, [], ['MoonPearl', 'MagicMirror', 'AnyBottle']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'ProgressiveSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MagicMirror', 'UncleSword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MagicMirror', 'MasterSword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MagicMirror', 'L3Sword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MagicMirror', 'L4Sword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MagicMirror', 'ProgressiveSword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'Bottle', 'UncleSword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'Bottle', 'MasterSword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'Bottle', 'L3Sword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'Bottle', 'L4Sword', 'PegasusBoots']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'Bottle', 'ProgressiveSword', 'PegasusBoots']],
        ];
    }
}
