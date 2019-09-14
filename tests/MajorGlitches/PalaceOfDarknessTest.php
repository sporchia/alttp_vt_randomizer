<?php

namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class PalaceOfDarknessTest extends TestCase
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
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - The Arena - Ledge", false, []],
            ["Palace of Darkness - The Arena - Ledge", false, [], ['AnyBow']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - The Arena - Bridge", false, []],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'PowerGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'ProgressiveGlove']],

            ["Palace of Darkness - Big Chest", false, []],
            ["Palace of Darkness - Big Chest", false, [], ['Lamp']],
            ["Palace of Darkness - Big Chest", false, [], ['BigKeyD1']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'DefeatAgahnim']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Compass Chest", false, []],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Harmless Hellway", false, []],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Stalfos Basement", false, []],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Stalfos Basement", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'PowerGlove']],
            ["Palace of Darkness - Stalfos Basement", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'ProgressiveGlove']],

            ["Palace of Darkness - Dark Basement - Left", false, []],
            ["Palace of Darkness - Dark Basement - Left", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Dark Basement - Right", false, []],
            ["Palace of Darkness - Dark Basement - Right", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Map Chest", false, []],
            ["Palace of Darkness - Map Chest", false, [], ['AnyBow']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'DefeatAgahnim']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Dark Maze - Top", false, []],
            ["Palace of Darkness - Dark Maze - Top", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'DefeatAgahnim']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Dark Maze - Bottom", false, []],
            ["Palace of Darkness - Dark Maze - Bottom", false, [], ['Lamp']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'DefeatAgahnim']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Shooter Room", true, []],

            ["Palace of Darkness - Boss", false, []],
            ["Palace of Darkness - Boss", false, [], ['Lamp']],
            ["Palace of Darkness - Boss", false, [], ['Hammer']],
            ["Palace of Darkness - Boss", false, [], ['AnyBow']],
            ["Palace of Darkness - Boss", false, [], ['BigKeyD1']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'DefeatAgahnim']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'PowerGlove']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'TitansMitt']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'ProgressiveGlove']],
        ];
    }
}
