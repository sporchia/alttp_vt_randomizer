<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
 * @group NoGlitches
 */
final class PalaceOfDarknessTest extends TestCase
{
    /**
     * @param string $location
     * @param bool $access
     * @param array $items
     *
     * @dataProvider accessPool
     */
    public function testLocation(string $location, bool $access, array $items): void
    {
        $randomizer = new Randomizer([[
            'mode.state' => 'open',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Palace of Darkness - Big Key Chest", false, []],
            ["Palace of Darkness - Big Key Chest", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'AgahnimDefeated']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - The Arena - Ledge", false, []],
            ["Palace of Darkness - The Arena - Ledge", false, ['MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - The Arena - Bridge", false, []],
            ["Palace of Darkness - The Arena - Bridge", false, ['KeyD1', 'AgahnimDefeated']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'PowerGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'ProgressiveGlove']],

            ["Palace of Darkness - Big Chest", false, []],
            ["Palace of Darkness - Big Chest", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'AgahnimDefeated']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Compass Chest", false, []],
            ["Palace of Darkness - Compass Chest", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'AgahnimDefeated']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Harmless Hellway Chest", false, []],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Stalfos Basement Chest", false, []],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'PowerGlove']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'ProgressiveGlove']],

            ["Palace of Darkness - Dark Basement - Left", false, []],
            ["Palace of Darkness - Dark Basement - Left", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Dark Basement - Right", false, []],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Map Chest", false, []],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Dark Maze - Top", false, []],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Dark Maze - Bottom", false, []],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Shooter Room Chest", false, []],
            ["Palace of Darkness - Shooter Room Chest", false, ['AgahnimDefeated']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MoonPearl', 'Hammer', 'PowerGlove']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MoonPearl', 'Hammer', 'TitansMitt']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MoonPearl', 'Flippers', 'TitansMitt']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

            ["Palace of Darkness - Boss", false, []],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'AgahnimDefeated']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'PowerGlove']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'TitansMitt']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'ProgressiveGlove']],
        ];
    }
}
