<?php

namespace InvertedMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class SwampPalaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
        $this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether', $this->world));
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

        $this->assertEquals($access, $this->world->getRegion('Swamp Palace')
            ->canEnter($this->world->getLocations(), $this->collected));
    }

    public function entryPool()
    {
        return [
            [false, []],
            [false, [], ['Flippers']],
            [false, [], ['MagicMirror', 'Ether']],
            [false, [], ['MagicMirror', 'MoonPearl']],
            [true, ['Flippers', 'MagicMirror']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
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
            ["Swamp Palace - Entrance", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Entrance", true, 'KeyD2', [], ['KeyD2']],

            ["Swamp Palace - Big Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Big Chest", true, 'KeyD2', [], ['KeyD2']],

            ["Swamp Palace - Big Key Chest", true, 'KeyD2', [], ['KeyD2']],
            ["Swamp Palace - Big Key Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
            
            ["Swamp Palace - Map Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Map Chest", true, 'KeyD2', [], ['KeyD2']],
            
            ["Swamp Palace - West Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - West Chest", true, 'KeyD2', [], ['KeyD2']],
            
            ["Swamp Palace - Compass Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Compass Chest", true, 'KeyD2', [], ['KeyD2']],
            
            ["Swamp Palace - Flooded Room - Left", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Flooded Room - Left", true, 'KeyD2', [], ['KeyD2']],
            
            ["Swamp Palace - Flooded Room - Right", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Flooded Room - Right", true, 'KeyD2', [], ['KeyD2']],
            
            ["Swamp Palace - Waterfall Room", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Waterfall Room", true, 'KeyD2', [], ['KeyD2']],

            ["Swamp Palace - Boss", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Boss", true, 'KeyD2', [], ['KeyD2']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Swamp Palace - Entrance", false, []],
            ["Swamp Palace - Entrance", false, [], ['Flippers']],
            ["Swamp Palace - Entrance", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Entrance", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'MagicMirror']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Big Chest", false, []],
            ["Swamp Palace - Big Chest", false, [], ['Flippers']],
            ["Swamp Palace - Big Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Big Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Big Chest", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Big Chest", false, [], ['BigKeyD2', 'BigKeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'Hammer', 'KeyD2', 'BigKeyD2']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],

            ["Swamp Palace - Big Key Chest", false, []],
            ["Swamp Palace - Big Key Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Big Key Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Big Key Chest", false, [], ['Flippers']],
            ["Swamp Palace - Big Key Chest", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'Hammer', 'KeyD2', 'BigKeyD2']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Map Chest", false, []],
            ["Swamp Palace - Map Chest", false, [], ['Flippers']],
            ["Swamp Palace - Map Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Map Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Map Chest", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'MagicMirror', 'KeyD2']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - West Chest", false, []],
            ["Swamp Palace - West Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - West Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - West Chest", false, [], ['Flippers']],
            ["Swamp Palace - West Chest", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - West Chest", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'Hammer', 'KeyD2', 'BigKeyD2']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Compass Chest", false, []],
            ["Swamp Palace - Compass Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Compass Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Compass Chest", false, [], ['Flippers']],
            ["Swamp Palace - Compass Chest", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'Hammer', 'KeyD2', 'BigKeyD2']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'MagicMirror', 'KeyD2', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Flooded Room - Left", false, []],
            ["Swamp Palace - Flooded Room - Left", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Hookshot']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Flippers']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'Hammer', 'KeyD2', 'BigKeyD2']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Flooded Room - Right", false, []],
            ["Swamp Palace - Flooded Room - Right", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Hookshot']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Flippers']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'Hammer', 'KeyD2', 'BigKeyD2']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Waterfall Room", false, []],
            ["Swamp Palace - Waterfall Room", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Waterfall Room", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Waterfall Room", false, [], ['Hookshot']],
            ["Swamp Palace - Waterfall Room", false, [], ['Flippers']],
            ["Swamp Palace - Waterfall Room", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'Hammer', 'KeyD2', 'BigKeyD2']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Boss", false, []],
            ["Swamp Palace - Boss", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Boss", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Boss", false, [], ['Hookshot']],
            ["Swamp Palace - Boss", false, [], ['Flippers']],
            ["Swamp Palace - Boss", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - Boss", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Boss", false, [], ['Hammer', 'AnySword', 'IceRod', 'FireRod']],
            //["Swamp Palace - Boss", false, [], ['Hammer', 'AnySword', 'AnyBottle', 'HalfMagic', 'QuarterMagic', 'AnyBow']],
                        // AnyBottle Seems to not work with the code for canExtendMagic() right now. 
                        // Testing Instead via the Test below with both allowed Magical Weapons.
            ["Swamp Palace - Boss", false, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'FireRod', 'IceRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'Hammer', 'KeyD2']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BowAndArrows', 'FireRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'HalfMagic', 'FireRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'QuarterMagic', 'FireRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'FireRod', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'FireRod', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'FireRod', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'FireRod', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'FireRod', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'FireRod', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'FireRod', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'BowAndArrows', 'IceRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'HalfMagic', 'IceRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'QuarterMagic', 'IceRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'IceRod', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'IceRod', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'IceRod', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'IceRod', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'IceRod', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'IceRod', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'IceRod', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'Flippers', 'MagicMirror', 'KeyD2', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Hookshot', 'MoonPearl', 'Flippers', 'Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
        ];
    }
}
