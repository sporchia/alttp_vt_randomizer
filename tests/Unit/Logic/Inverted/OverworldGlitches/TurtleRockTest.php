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
final class TurtleRockTest extends TestCase
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
        $randomizer->assumeItems(array_merge(['TurtleRockEntryQuake:0'], array_map(fn ($i) => "$i:0", $items)));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Turtle Rock - Chain Chomps", false, []],
            ["Turtle Rock - Chain Chomps", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Compass Chest", false, []],
            ["Turtle Rock - Compass Chest", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Roller Room - Left", false, []],
            ["Turtle Rock - Roller Room - Left", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'CaneOfSomaria', 'FireRod', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Roller Room - Right", false, []],
            ["Turtle Rock - Roller Room - Right", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'CaneOfSomaria', 'FireRod', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Big Chest", false, []],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'Hookshot', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'CaneOfSomaria', 'BigKeyD7']],

            ["Turtle Rock - Big Key Chest", false, []],
            ["Turtle Rock - Big Key Chest", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Crystaroller Room", false, []],
            ["Turtle Rock - Crystaroller Room", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'Lamp', 'CaneOfSomaria']],

            ["Turtle Rock - Eye Bridge - Bottom Left", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Eye Bridge - Bottom Right", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Eye Bridge - Top Left", false, []],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Eye Bridge - Top Right", false, []],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Boss", false, []],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'ProgressiveSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'MasterSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'ProgressiveSword', 'ProgressiveSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
        ];
    }
}
