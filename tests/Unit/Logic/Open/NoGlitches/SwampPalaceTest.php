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
final class SwampPalaceTest extends TestCase
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
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Swamp Palace - Entrance Chest", false, []],
            ["Swamp Palace - Entrance Chest", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Swamp Palace - Entrance Chest", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Swamp Palace - Entrance Chest", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Entrance Chest", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Entrance Chest", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer']],
            ["Swamp Palace - Entrance Chest", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hookshot']],

            ["Swamp Palace - Big Chest", false, []],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer']],

            ["Swamp Palace - Big Key Chest", false, []],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer']],

            ["Swamp Palace - Map Chest", false, []],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hookshot']],

            ["Swamp Palace - West Chest", false, []],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer']],

            ["Swamp Palace - Compass Chest", false, []],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer']],

            ["Swamp Palace - Flooded Room - Left", false, []],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Flooded Room - Right", false, []],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Waterfall Room Chest", false, []],
            ["Swamp Palace - Waterfall Room Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Waterfall Room Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Waterfall Room Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Waterfall Room Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Boss", false, []],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'TitansMitt', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
        ];
    }
}
