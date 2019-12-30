<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class PalaceOfDarknessTest extends TestCase
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

        $this->assertEquals($access, $this->world->getRegion('Palace of Darkness')
            ->canEnter($this->world->getLocations(), $this->collected));
    }

    public function entryPool()
    {
        return [
            [false, []],
            [false, ['MoonPearl']],
            [false, ['PegasusBoots']],
            [true, ['MoonPearl', 'PegasusBoots']],
            [true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            [true, ['MoonPearl', 'TitansMitt']],
        ];
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

    public function accessPool()
    {
        return [
            ["Palace of Darkness - Big Key Chest", false, []],
            ["Palace of Darkness - Big Key Chest", false, [], ['MoonPearl']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - The Arena - Ledge", false, []],
            ["Palace of Darkness - The Arena - Ledge", false, [], ['MoonPearl']],
            ["Palace of Darkness - The Arena - Ledge", false, [], ['AnyBow']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - The Arena - Bridge", false, []],
            ["Palace of Darkness - The Arena - Bridge", false, [], ['MoonPearl']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'PegasusBoots']],

            ["Palace of Darkness - Big Chest", false, []],
            ["Palace of Darkness - Big Chest", false, [], ['MoonPearl']],
            ["Palace of Darkness - Big Chest", false, [], ['Lamp']],
            ["Palace of Darkness - Big Chest", false, [], ['BigKeyD1']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'TitansMitt']],

            ["Palace of Darkness - Compass Chest", false, []],
            ["Palace of Darkness - Compass Chest", false, [], ['MoonPearl']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Harmless Hellway", false, []],
            ["Palace of Darkness - Harmless Hellway", false, [], ['MoonPearl']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Stalfos Basement", false, []],
            ["Palace of Darkness - Stalfos Basement", false, [], ['MoonPearl']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'PegasusBoots']],

            ["Palace of Darkness - Dark Basement - Left", false, []],
            ["Palace of Darkness - Dark Basement - Left", false, [], ['MoonPearl']],
            ["Palace of Darkness - Dark Basement - Left", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Dark Basement - Right", false, []],
            ["Palace of Darkness - Dark Basement - Right", false, [], ['MoonPearl']],
            ["Palace of Darkness - Dark Basement - Right", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Map Chest", false, []],
            ["Palace of Darkness - Map Chest", false, [], ['MoonPearl']],
            ["Palace of Darkness - Map Chest", false, [], ['AnyBow']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Dark Maze - Top", false, []],
            ["Palace of Darkness - Dark Maze - Top", false, [], ['MoonPearl']],
            ["Palace of Darkness - Dark Maze - Top", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'TitansMitt']],

            ["Palace of Darkness - Dark Maze - Bottom", false, []],
            ["Palace of Darkness - Dark Maze - Bottom", false, [], ['MoonPearl']],
            ["Palace of Darkness - Dark Maze - Bottom", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'TitansMitt']],

            ["Palace of Darkness - Shooter Room", false, []],
            ["Palace of Darkness - Shooter Room", false, [], ['MoonPearl']],
            ["Palace of Darkness - Shooter Room", true, ['MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Shooter Room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Shooter Room", true, ['MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Boss", false, []],
            ["Palace of Darkness - Boss", false, [], ['MoonPearl']],
            ["Palace of Darkness - Boss", false, [], ['Lamp']],
            ["Palace of Darkness - Boss", false, [], ['Hammer']],
            ["Palace of Darkness - Boss", false, [], ['AnyBow']],
            ["Palace of Darkness - Boss", false, [], ['BigKeyD1']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'PegasusBoots']],
        ];
    }
}
