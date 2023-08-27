<?php

namespace NoGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NoGlitches
 */
class SwampPalaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
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
            ["Swamp Palace - Entrance", false, 'BigKeyD2', [], ['BigKeyD2']],
            ["Swamp Palace - Entrance", true, 'KeyD2', [], ['KeyD2']],

            ["Swamp Palace - Big Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

            ["Swamp Palace - Big Key Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

            ["Swamp Palace - Map Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

            ["Swamp Palace - West Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

            ["Swamp Palace - Compass Chest", true, 'BigKeyD2', [], ['BigKeyD2']],

            ["Swamp Palace - Flooded Room - Left", true, 'BigKeyD2', [], ['BigKeyD2']],

            ["Swamp Palace - Flooded Room - Right", true, 'BigKeyD2', [], ['BigKeyD2']],

            ["Swamp Palace - Waterfall Room", true, 'BigKeyD2', [], ['BigKeyD2']],

            ["Swamp Palace - Boss", true, 'BigKeyD2', [], ['BigKeyD2']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Swamp Palace - Entrance", false, []],
            ["Swamp Palace - Entrance", false, [], ['MagicMirror']],
            ["Swamp Palace - Entrance", false, [], ['MoonPearl']],
            ["Swamp Palace - Entrance", false, [], ['Flippers']],
            ["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],
            ["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hookshot']],

            ["Swamp Palace - Big Chest", false, []],
            ["Swamp Palace - Big Chest", false, [], ['MagicMirror']],
            ["Swamp Palace - Big Chest", false, [], ['MoonPearl']],
            ["Swamp Palace - Big Chest", false, [], ['Flippers']],
            ["Swamp Palace - Big Chest", false, [], ['Hammer']],
            ["Swamp Palace - Big Chest", false, [], ['BigKeyD2']],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - Big Key Chest", false, []],
            ["Swamp Palace - Big Key Chest", false, [], ['MagicMirror']],
            ["Swamp Palace - Big Key Chest", false, [], ['MoonPearl']],
            ["Swamp Palace - Big Key Chest", false, [], ['Flippers']],
            ["Swamp Palace - Big Key Chest", false, [], ['Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - Map Chest", false, []],
            ["Swamp Palace - Map Chest", false, [], ['MagicMirror']],
            ["Swamp Palace - Map Chest", false, [], ['MoonPearl']],
            ["Swamp Palace - Map Chest", false, [], ['Flippers']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hookshot']],

            ["Swamp Palace - West Chest", false, []],
            ["Swamp Palace - West Chest", false, [], ['MagicMirror']],
            ["Swamp Palace - West Chest", false, [], ['MoonPearl']],
            ["Swamp Palace - West Chest", false, [], ['Flippers']],
            ["Swamp Palace - West Chest", false, [], ['Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - Compass Chest", false, []],
            ["Swamp Palace - Compass Chest", false, [], ['MagicMirror']],
            ["Swamp Palace - Compass Chest", false, [], ['MoonPearl']],
            ["Swamp Palace - Compass Chest", false, [], ['Flippers']],
            ["Swamp Palace - Compass Chest", false, [], ['Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - Flooded Room - Left", false, []],
            ["Swamp Palace - Flooded Room - Left", false, [], ['MagicMirror']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['MoonPearl']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Flippers']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Hammer']],
            ["Swamp Palace - Flooded Room - Left", false, [], ['Hookshot']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Flooded Room - Right", false, []],
            ["Swamp Palace - Flooded Room - Right", false, [], ['MagicMirror']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['MoonPearl']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Flippers']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Hammer']],
            ["Swamp Palace - Flooded Room - Right", false, [], ['Hookshot']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Waterfall Room", false, []],
            ["Swamp Palace - Waterfall Room", false, [], ['MagicMirror']],
            ["Swamp Palace - Waterfall Room", false, [], ['MoonPearl']],
            ["Swamp Palace - Waterfall Room", false, [], ['Flippers']],
            ["Swamp Palace - Waterfall Room", false, [], ['Hammer']],
            ["Swamp Palace - Waterfall Room", false, [], ['Hookshot']],
            ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Boss", false, []],
            ["Swamp Palace - Boss", false, [], ['MagicMirror']],
            ["Swamp Palace - Boss", false, [], ['MoonPearl']],
            ["Swamp Palace - Boss", false, [], ['Flippers']],
            ["Swamp Palace - Boss", false, [], ['Hammer']],
            ["Swamp Palace - Boss", false, [], ['Hookshot']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
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

        $this->assertEquals($access, $this->world->getRegion('Swamp Palace')->canFill(Item::get($item_name, $this->world)));
    }

    public function dungeonItemsPool()
    {
        return [
            [true, 'Key'],
            [false, 'KeyH2'],
            [false, 'KeyH1'],
            [false, 'KeyP1'],
            [false, 'KeyP2'],
            [false, 'KeyA1'],
            [true, 'KeyD2'],
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
            [false, 'BigKeyP2'],
            [false, 'BigKeyA1'],
            [true, 'BigKeyD2'],
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
            [false, 'MapP2', false, 'region.wildMaps'],
            [true, 'MapP2', true, 'region.wildMaps'],
            [false, 'MapA1', false, 'region.wildMaps'],
            [true, 'MapA1', true, 'region.wildMaps'],
            [true, 'MapD2', false, 'region.wildMaps'],
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
            [false, 'CompassP2', false, 'region.wildCompasses'],
            [true, 'CompassP2', true, 'region.wildCompasses'],
            [false, 'CompassA1', false, 'region.wildCompasses'],
            [true, 'CompassA1', true, 'region.wildCompasses'],
            [true, 'CompassD2', false, 'region.wildCompasses'],
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
}
