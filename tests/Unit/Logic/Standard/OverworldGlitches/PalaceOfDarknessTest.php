<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group OverworldGlitches
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
            'mode.state' => 'standard',
            'difficulty' => 'test_rules',
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Palace of Darkness - Big Key Chest", false, []],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Key Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - The Arena - Ledge", false, []],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Ledge", true, ['BowAndArrows', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - The Arena - Bridge", false, []],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - The Arena - Bridge", true, ['KeyD1', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - The Arena - Bridge", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'PegasusBoots']],

            ["Palace of Darkness - Big Chest", false, []],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Big Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'TitansMitt']],

            ["Palace of Darkness - Compass Chest", false, []],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Compass Chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Harmless Hellway", false, []],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Harmless Hellway", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Stalfos Basement", false, []],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Stalfos Basement", true, ['KeyD1', 'MoonPearl', 'TitansMitt']],
            ["Palace of Darkness - Stalfos Basement", true, ['BowAndArrows', 'Hammer', 'MoonPearl', 'PegasusBoots']],

            ["Palace of Darkness - Dark Basement - Left", false, []],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Left", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Dark Basement - Right", false, []],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Basement - Right", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Map Chest", false, []],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Map Chest", true, ['BowAndArrows', 'MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Dark Maze - Top", false, []],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Top", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'TitansMitt']],

            ["Palace of Darkness - Dark Maze - Bottom", false, []],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Dark Maze - Bottom", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'TitansMitt']],

            ["Palace of Darkness - Shooter Room", false, []],
            ["Palace of Darkness - Shooter Room", true, ['MoonPearl', 'PegasusBoots']],
            ["Palace of Darkness - Shooter Room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Palace of Darkness - Shooter Room", true, ['MoonPearl', 'TitansMitt']],

            ["Palace of Darkness - Boss", false, []],
            ["Palace of Darkness - Boss", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'BowAndArrows', 'PegasusBoots']],
        ];
    }
}
