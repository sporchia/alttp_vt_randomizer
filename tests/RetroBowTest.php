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
            ["Eastern Palace - Compass Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Cannonball Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Big Chest", false, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Map Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Big Key Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Boss", false, 'BigKeyP1', [], ['BigKeyP1']],

            ["Palace of Darkness - Big Key Chest", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - The Arena - Ledge", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - The Arena - Bridge", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Big Chest", false, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Compass Chest", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Harmless Hellway", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Stalfos Basement", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Dark Basement - Left", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Dark Basement - Right", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Map Chest", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Dark Maze - Top", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Dark Maze - Bottom", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Shooter Room", true, 'BigKeyD1', [], ['BigKeyD1']],

            ["Palace of Darkness - Boss", false, 'BigKeyD1', [], ['BigKeyD1']],
			
            ["Ganon's Tower - Bob's Torch", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - DMs Room - Top Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - DMs Room - Top Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - DMs Room - Bottom Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - DMs Room - Bottom Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Randomizer Room - Top Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Randomizer Room - Top Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Randomizer Room - Bottom Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Randomizer Room - Bottom Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Firesnake Room", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Map Chest", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Big Chest", false, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Hope Room - Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Hope Room - Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Bob's Chest", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Tile Room", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Compass Room - Top Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Compass Room - Top Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Compass Room - Bottom Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Compass Room - Bottom Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Big Key Chest", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Big Key Room - Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Big Key Room - Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Mini Helmasaur Room - Left", false, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Mini Helmasaur Room - Right", false, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Pre-Moldorm Chest", false, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Moldorm Chest", false, 'BigKeyA2', [], ['BigKeyA2']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Eastern Palace - Boss", false, ['ProgressiveBow']],
            ["Eastern Palace - Boss", true, ['ProgressiveBow', 'ProgressiveBow']],
            ["Eastern Palace - Boss", true, ['ProgressiveBow', 'ShopArrow']],

            ["Palace of Darkness - Boss", false, ['ProgressiveBow']],
            ["Palace of Darkness - Boss", true, ['ProgressiveBow', 'ProgressiveBow']],
            ["Palace of Darkness - Boss", true, ['ProgressiveBow', 'ShopArrow']],

            ["Palace of Darkness - The Arena - Ledge", false, ['ProgressiveBow']],
            ["Palace of Darkness - The Arena - Ledge", true, ['ProgressiveBow', 'ProgressiveBow']],
            ["Palace of Darkness - The Arena - Ledge", true, ['ProgressiveBow', 'ShopArrow']],

            ["Palace of Darkness - Map Chest", false, ['ProgressiveBow']],
            ["Palace of Darkness - Map Chest", true, ['ProgressiveBow', 'ProgressiveBow']],
            ["Palace of Darkness - Map Chest", true, ['ProgressiveBow', 'ShopArrow']],

            ["Ganon's Tower - Mini Helmasaur Room - Left", false, ['ProgressiveBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['ProgressiveBow', 'ProgressiveBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['ProgressiveBow', 'ShopArrow']],

            ["Ganon's Tower - Mini Helmasaur Room - Right", false, ['ProgressiveBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['ProgressiveBow', 'ProgressiveBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['ProgressiveBow', 'ShopArrow']],

            ["Ganon's Tower - Pre-Moldorm Chest", false, ['ProgressiveBow']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['ProgressiveBow', 'ProgressiveBow']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['ProgressiveBow', 'ShopArrow']],
			
            ["Ganon's Tower - Moldorm Chest", false, ['ProgressiveBow']],
            ["Ganon's Tower - Moldorm Chest", true, ['ProgressiveBow', 'ProgressiveBow']],
            ["Ganon's Tower - Moldorm Chest", true, ['ProgressiveBow', 'ShopArrow']],
        ];
    }
}
