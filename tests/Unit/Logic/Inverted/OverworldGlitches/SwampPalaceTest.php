<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group OverworldGlitches
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
            'mode.state' => 'inverted',
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
            ["Swamp Palace - Entrance Chest", false, []],
            ["Swamp Palace - Entrance Chest", true, ['MagicMirror', 'Flippers', 'PegasusBoots']],
            ["Swamp Palace - Entrance Chest", true, ['MagicMirror', 'Flippers', 'DefeatAgahnim']],

            ["Swamp Palace - Big Chest", false, []],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots', 'Hammer']],
            ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - Big Key Chest", false, []],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots', 'Hammer']],
            ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - Map Chest", false, []],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'ProgressiveGlove']],
            ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - West Chest", false, []],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots', 'Hammer']],
            ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - Compass Chest", false, []],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots', 'Hammer']],
            ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer']],

            ["Swamp Palace - Flooded Room - Left", false, []],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Flooded Room - Right", false, []],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Waterfall Room", false, []],
            ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],

            ["Swamp Palace - Boss", false, []],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'Flippers', 'PegasusBoots', 'Hammer', 'Hookshot']],
            ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'Flippers', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
        ];
    }
}
