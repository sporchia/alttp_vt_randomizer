<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
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
            'mode.state' => 'inverted',
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Palace of Darkness - Big Key Chest", false, []],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Hammer']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - The Arena - Ledge", false, []],
            ["Palace of Darkness - The Arena - Ledge", false, ['Flippers']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'Flippers']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'Hammer']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - The Arena - Bridge", false, []],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'Flippers']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'Hammer']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MagicMirror', 'AgahnimDefeated']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer']],

            ["Palace of Darkness - Big Chest", false, []],
            ["Palace of Darkness - Big Chest", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Flippers']],
            ["Palace of Darkness - Big Chest", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Compass Chest", false, []],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Hammer']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Harmless Hellway Chest", false, []],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Hammer']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Harmless Hellway Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Stalfos Basement Chest", false, []],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'Flippers']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'Hammer']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['KeyD1', 'MagicMirror', 'AgahnimDefeated']],
            ["Palace of Darkness - Stalfos Basement Chest", true, ['BowAndArrows', 'Hammer']],

            ["Palace of Darkness - Dark Basement - Left", false, []],
            ["Palace of Darkness - Dark Basement - Left", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Dark Basement - Right", false, []],
            ["Palace of Darkness - Dark Basement - Right", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Map Chest", false, []],
            ["Palace of Darkness - Map Chest", false, ['Flippers']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'Flippers']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'Hammer']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Dark Maze - Top", false, []],
            ["Palace of Darkness - Dark Maze - Top", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Dark Maze - Bottom", false, []],
            ["Palace of Darkness - Dark Maze - Bottom", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Flippers']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Flippers']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Shooter Room Chest", false, []],
            ["Palace of Darkness - Shooter Room Chest", true, ['Flippers']],
            ["Palace of Darkness - Shooter Room Chest", true, ['Hammer']],
            ["Palace of Darkness - Shooter Room Chest", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Shooter Room Chest", true, ['OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Shooter Room Chest", true, ['OcarinaInactive', 'MoonPearl', 'AgahnimDefeated']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MagicMirror', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MagicMirror', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Shooter Room Chest", true, ['MagicMirror', 'AgahnimDefeated']],

            ["Palace of Darkness - Boss", false, []],
            ["Palace of Darkness - Boss", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Hammer']],
            ["Palace of Darkness - Boss", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'BowAndArrows']],
            ["Palace of Darkness - Boss", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Hammer', 'BowAndArrows']],
            ["Palace of Darkness - Boss", false, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'Hammer', 'BowAndArrows']],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'Lamp', 'Hammer', 'BowAndArrows']],
        ];
    }
}
