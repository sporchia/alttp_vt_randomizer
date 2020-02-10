<?php

namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class SwampPalaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);

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
            [true, ['Flippers', 'MagicMirror', 'MoonPearl']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            [true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
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

            ["Swamp Palace - Big Key Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Big Key Chest", true, 'KeyD2', [], ['KeyD2']],

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
            ["Swamp Palace - Entrance", true, ['Flippers', 'MagicMirror', 'MoonPearl']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Entrance", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Big Chest", false, []],
            ["Swamp Palace - Big Chest", false, [], ['Flippers']],
            ["Swamp Palace - Big Chest", false, [], ['BigKeyD2', 'BigKeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Big Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Big Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl', 'Hammer', 'BigKeyD2']],
            ["Swamp Palace - Big Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Big Key Chest", false, []],
            ["Swamp Palace - Big Key Chest", false, [], ['Flippers']],
            ["Swamp Palace - Big Key Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Big Key Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Big Key Chest", false, [], ['Ether', 'BigKeyP3', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Big Key Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Map Chest", false, []],
            ["Swamp Palace - Map Chest", false, [], ['Flippers']],
            ["Swamp Palace - Map Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Map Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Map Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - West Chest", false, []],
            ["Swamp Palace - West Chest", false, [], ['Flippers']],
            ["Swamp Palace - West Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - West Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - West Chest", false, [], ['Ether', 'BigKeyP3', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - West Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Compass Chest", false, []],
            ["Swamp Palace - Compass Chest", false, [], ['Flippers']],
            ["Swamp Palace - Compass Chest", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Compass Chest", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Compass Chest", false, [], ['Ether', 'BigKeyP3', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'Flippers', 'MagicMirror', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Compass Chest", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Flooded Room - Left", false, []],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Flippers']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Hookshot']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Ether', 'BigKeyP3', 'Hammer']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'Hammer']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Left", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Flooded Room - Right", false, []],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Flippers']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Hookshot']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Ether', 'BigKeyP3', 'Hammer']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'Hammer']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Flooded Room - Right", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Waterfall Room", false, []],
            ["Swamp Palace - Waterfall Room", false, [], ['Flippers']],
            ["Swamp Palace - Waterfall Room", false, [], ['Hookshot']],
            ["Swamp Palace - Waterfall Room", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Waterfall Room", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Waterfall Room", false, [], ['Ether', 'BigKeyP3', 'Hammer']],
            ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'Hammer']],
            ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Waterfall Room", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],

            ["Swamp Palace - Boss", false, []],
            ["Swamp Palace - Boss", false, [], ['MagicMirror', 'Lamp']],
            ["Swamp Palace - Boss", false, [], ['MagicMirror', 'Ether']],
            ["Swamp Palace - Boss", false, [], ['Hookshot']],
            ["Swamp Palace - Boss", false, [], ['Flippers']],
            ["Swamp Palace - Boss", false, [], ['Hammer', 'Ether', 'BigKeyP3']],
            ["Swamp Palace - Boss", false, [], ['KeyD2', 'Ether']],
            ["Swamp Palace - Boss", false, [], ['Hammer', 'AnySword', 'IceRod', 'FireRod']],
            ["Swamp Palace - Boss", false, ['Hookshot', 'Flippers', 'MagicMirror', 'MoonPearl', 'KeyD2', 'FireRod', 'IceRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'Hammer']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'BowAndArrows', 'FireRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'HalfMagic', 'FireRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'QuarterMagic', 'FireRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'FireRod', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'FireRod', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'FireRod', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'FireRod', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'FireRod', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'FireRod', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'FireRod', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'BowAndArrows', 'IceRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'HalfMagic', 'IceRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'QuarterMagic', 'IceRod', 'MoonPearl', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'IceRod', 'BottleWithBee', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'IceRod', 'BottleWithFairy', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'IceRod', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'IceRod', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'IceRod', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'IceRod', 'Bottle', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'IceRod', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'UncleSword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'ProgressiveSword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'MasterSword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'L3Sword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'Flippers', 'Hookshot', 'MagicMirror', 'MoonPearl', 'L4Sword', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
            ["Swamp Palace - Boss", true, ['Flippers', 'Lamp', 'Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyP3']],
        ];
    }
}
