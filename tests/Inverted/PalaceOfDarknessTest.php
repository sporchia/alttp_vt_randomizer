<?php

namespace Inverted;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class PalaceOfDarknessTest extends TestCase
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
            [true, ['Hammer']],
            [true, ['Flippers']],
            [true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            [true, ['Flute', 'MoonPearl', 'TitansMitt']],
            [true, ['MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            [true, ['MagicMirror', 'DefeatAgahnim']],
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
            ["Palace of Darkness - Big Key Chest", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Hammer']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - The Arena - Ledge", false, []],
            ["Palace of Darkness - The Arena - Ledge", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - The Arena - Ledge", false, [], ['AnyBow']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'Flippers']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'Hammer']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - The Arena - Bridge", false, []],
            ["Palace of Darkness - The Arena - Bridge", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'Flippers']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'Hammer']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MagicMirror', 'DefeatAgahnim']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer']],

            ["Palace of Darkness - Big Chest", false, []],
            ["Palace of Darkness - Big Chest", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Big Chest", false, [], ['Lamp']],
            ["Palace of Darkness - Big Chest", false, [], ['BigKeyD1']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Compass Chest", false, []],
            ["Palace of Darkness - Compass Chest", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Hammer']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Harmless Hellway", false, []],
            ["Palace of Darkness - Harmless Hellway", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Hammer']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Stalfos Basement", false, []],
            ["Palace of Darkness - Stalfos Basement", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'Flippers']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'Hammer']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MagicMirror', 'DefeatAgahnim']],
            ["Palace of Darkness - Stalfos Basement", true, ['BowAndArrows', 'Hammer']],

            ["Palace of Darkness - Dark Basement - Left", false, []],
            ["Palace of Darkness - Dark Basement - Left", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Dark Basement - Left", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Dark Basement - Right", false, []],
            ["Palace of Darkness - Dark Basement - Right", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Dark Basement - Right", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Map Chest", false, []],
            ["Palace of Darkness - Map Chest", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Map Chest", false, [], ['AnyBow']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'Flippers']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'Hammer']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Dark Maze - Top", false, []],
            ["Palace of Darkness - Dark Maze - Top", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Dark Maze - Top", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Dark Maze - Bottom", false, []],
            ["Palace of Darkness - Dark Maze - Bottom", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Dark Maze - Bottom", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Shooter Room", false, []],
            ["Palace of Darkness - Shooter Room", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Shooter Room", true, ['Flippers']],
            ["Palace of Darkness - Shooter Room", true, ['Hammer']],
            ["Palace of Darkness - Shooter Room", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Shooter Room", true, ['Flute', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Shooter Room", true, ['Flute', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Shooter Room", true, ['MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Shooter Room", true, ['MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Shooter Room", true, ['MagicMirror', 'DefeatAgahnim']],

            ["Palace of Darkness - Boss", false, []],
            ["Palace of Darkness - Boss", false, [], ['Hammer', 'Flippers', 'Flute', 'MagicMirror']],
            ["Palace of Darkness - Boss", false, [], ['Lamp']],
            ["Palace of Darkness - Boss", false, [], ['Hammer']],
            ["Palace of Darkness - Boss", false, [], ['AnyBow']],
            ["Palace of Darkness - Boss", false, [], ['BigKeyD1']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Hammer', 'BowAndArrows']],
        ];
    }
}
