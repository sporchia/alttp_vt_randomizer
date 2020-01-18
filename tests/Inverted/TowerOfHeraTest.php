<?php

namespace Inverted;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class TowerOfHeraTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
        $this->addCollected(['RescueZelda']);
        $this->collected->setChecksForWorld($this->world->id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    // Entry
    public function testCanEnterWithEverything()
    {
        $this->assertTrue($this->world->getRegion('Tower of Hera')->canEnter($this->world->getLocations(), $this->allItems()));
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
            ["Tower of Hera - Big Key Chest", false, [], ['Lamp', 'Flute']],
            ["Tower of Hera - Big Key Chest", false, [], ['Lamp', 'FireRod']],
            ["Tower of Hera - Big Key Chest", false, [], ['MoonPearl']],
            ["Tower of Hera - Big Key Chest", false, [], ['Hammer']],
            ["Tower of Hera - Big Key Chest", false, [], ['KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'OcarinaActive', 'Hookshot', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'ProgressiveGlove', 'Hookshot', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'PowerGlove', 'Hookshot', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'TitansMitt', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'Flute', 'DefeatAgahnim', 'Hookshot', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'Flute', 'ProgressiveGlove', 'Hookshot', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'Flute', 'PowerGlove', 'Hookshot', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP3']],
            ["Tower of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'Flute', 'TitansMitt', 'KeyP3']],

            ["Tower of Hera - Basement Cage", false, []],
            ["Tower of Hera - Basement Cage", false, [], ['Lamp', 'Flute']],
            ["Tower of Hera - Basement Cage", false, [], ['MoonPearl']],
            ["Tower of Hera - Basement Cage", true, ['ProgressiveGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower of Hera - Basement Cage", true, ['PowerGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower of Hera - Basement Cage", true, ['TitansMitt', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower of Hera - Basement Cage", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower of Hera - Basement Cage", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower of Hera - Basement Cage", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer']],
            ["Tower of Hera - Basement Cage", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer']],

            ["Tower of Hera - Map Chest", false, []],
            ["Tower of Hera - Map Chest", false, [], ['Lamp', 'Flute']],
            ["Tower of Hera - Map Chest", false, [], ['MoonPearl']],
            ["Tower of Hera - Map Chest", true, ['ProgressiveGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower of Hera - Map Chest", true, ['PowerGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower of Hera - Map Chest", true, ['TitansMitt', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower of Hera - Map Chest", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower of Hera - Map Chest", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower of Hera - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer']],
            ["Tower of Hera - Map Chest", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer']],

            ["Tower of Hera - Compass Chest", false, []],
            ["Tower of Hera - Compass Chest", false, [], ['Lamp', 'Flute']],
            ["Tower of Hera - Compass Chest", false, [], ['MoonPearl']],
            ["Tower of Hera - Compass Chest", false, [], ['BigKeyP3']],
            ["Tower of Hera - Compass Chest", true, ['ProgressiveGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Compass Chest", true, ['PowerGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Compass Chest", true, ['TitansMitt', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Compass Chest", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Compass Chest", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Compass Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Compass Chest", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],

            ["Tower of Hera - Big Chest", false, []],
            ["Tower of Hera - Big Chest", false, [], ['Lamp', 'Flute']],
            ["Tower of Hera - Big Chest", false, [], ['MoonPearl']],
            ["Tower of Hera - Big Chest", false, [], ['BigKeyP3']],
            ["Tower of Hera - Big Chest", true, ['ProgressiveGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Big Chest", true, ['PowerGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Big Chest", true, ['TitansMitt', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Big Chest", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Big Chest", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Big Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Big Chest", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
            
            ["Tower of Hera - Boss", false, []],
            ["Tower of Hera - Boss", false, [], ['Lamp', 'Flute']],
            ["Tower of Hera - Boss", false, [], ['MoonPearl']],
            ["Tower of Hera - Boss", false, [], ['BigKeyP3']],
            ["Tower of Hera - Boss", false, [], ['Hammer']],
            ["Tower of Hera - Boss", true, ['ProgressiveGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['PowerGlove', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['TitansMitt', 'Flute', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
            ["Tower of Hera - Boss", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
        ];
    }
}
