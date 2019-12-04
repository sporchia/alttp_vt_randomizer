<?php

namespace NoGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NoGlitches
 */
class RetroBowTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('retro', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
        $this->addCollected(['RescueZelda', 'Lamp', 'BigKeyP1', 'MoonPearl',
            'UncleSword', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod',
            'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7',
            'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1',
            'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'BigKeyA2']);
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

    public function accessPool()
    {
        return [
            ["Eastern Palace - Boss", false, ['ProgressiveBow']],
            ["Eastern Palace - Boss", false, ['ProgressiveBow', 'ProgressiveBow']],
            ["Eastern Palace - Boss", true, ['ProgressiveBow', 'SilverArrowUpgrade']],
            ["Eastern Palace - Boss", true, ['ProgressiveBow', 'ShopArrow']],

            ["Palace of Darkness - Boss", false, ['ProgressiveBow']],
            ["Palace of Darkness - Boss", false, ['ProgressiveBow', 'ProgressiveBow']],
            ["Palace of Darkness - Boss", true, ['ProgressiveBow', 'SilverArrowUpgrade']],
            ["Palace of Darkness - Boss", true, ['ProgressiveBow', 'ShopArrow']],

            ["Palace of Darkness - The Arena - Ledge", false, ['ProgressiveBow']],
            ["Palace of Darkness - The Arena - Ledge", false, ['ProgressiveBow', 'ProgressiveBow']],
            ["Palace of Darkness - The Arena - Ledge", true, ['ProgressiveBow', 'SilverArrowUpgrade']],
            ["Palace of Darkness - The Arena - Ledge", true, ['ProgressiveBow', 'ShopArrow']],

            ["Palace of Darkness - Map Chest", false, ['ProgressiveBow']],
            ["Palace of Darkness - Map Chest", false, ['ProgressiveBow', 'ProgressiveBow']],
            ["Palace of Darkness - Map Chest", true, ['ProgressiveBow', 'SilverArrowUpgrade']],
            ["Palace of Darkness - Map Chest", true, ['ProgressiveBow', 'ShopArrow']],

            ["Ganon's Tower - Mini Helmasaur Room - Left", false, ['ProgressiveBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", false, ['ProgressiveBow', 'ProgressiveBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['ProgressiveBow', 'SilverArrowUpgrade']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['ProgressiveBow', 'ShopArrow']],

            ["Ganon's Tower - Mini Helmasaur Room - Right", false, ['ProgressiveBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", false, ['ProgressiveBow', 'ProgressiveBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['ProgressiveBow', 'SilverArrowUpgrade']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['ProgressiveBow', 'ShopArrow']],

            ["Ganon's Tower - Pre-Moldorm Chest", false, ['ProgressiveBow']],
            ["Ganon's Tower - Pre-Moldorm Chest", false, ['ProgressiveBow', 'ProgressiveBow']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['ProgressiveBow', 'SilverArrowUpgrade']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['ProgressiveBow', 'ShopArrow']],
            
            ["Ganon's Tower - Moldorm Chest", false, ['ProgressiveBow']],
            ["Ganon's Tower - Moldorm Chest", false, ['ProgressiveBow', 'ProgressiveBow']],
            ["Ganon's Tower - Moldorm Chest", true, ['ProgressiveBow', 'SilverArrowUpgrade']],
            ["Ganon's Tower - Moldorm Chest", true, ['ProgressiveBow', 'ShopArrow']],
        ];
    }
}
