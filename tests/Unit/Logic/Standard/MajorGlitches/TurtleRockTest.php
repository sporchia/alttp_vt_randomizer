<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
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
        $this->markTestSkipped();
        $randomizer = new Randomizer([[
            'mode.state' => 'standard',
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_merge(['TurtleRockEntryQuake:0'], array_map(fn ($i) => "$i:0", $items)));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Turtle Rock - Chain Chomps", true, []],

            ["Turtle Rock - Compass Chest", false, []],
            ["Turtle Rock - Compass Chest", true, ['CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Compass Chest", true, ['CaneOfSomaria', 'MoonPearl', 'Quake', 'UncleSword']],
            ["Turtle Rock - Compass Chest", true, ['CaneOfSomaria', 'Bottle', 'Quake', 'UncleSword']],

            ["Turtle Rock - Roller Room - Left", false, []],
            ["Turtle Rock - Roller Room - Left", true, ['CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['CaneOfSomaria', 'MoonPearl', 'Quake', 'UncleSword', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['CaneOfSomaria', 'Bottle', 'Quake', 'UncleSword', 'FireRod']],

            ["Turtle Rock - Roller Room - Right", false, []],
            ["Turtle Rock - Roller Room - Right", true, ['CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['CaneOfSomaria', 'MoonPearl', 'Quake', 'UncleSword', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['CaneOfSomaria', 'Bottle', 'Quake', 'UncleSword', 'FireRod']],

            ["Turtle Rock - Big Chest", false, []],
            ["Turtle Rock - Big Chest", true, ['CaneOfSomaria', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['Hookshot', 'BigKeyD7']],

            ["Turtle Rock - Big Key Chest", false, []],
            ["Turtle Rock - Big Key Chest", true, ['KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Crystaroller Room", false, []],
            ["Turtle Rock - Crystaroller Room", true, ['BigKeyD7']],
            ["Turtle Rock - Crystaroller Room", true, ['Lamp', 'CaneOfSomaria', 'MagicMirror', 'MoonPearl']],
            ["Turtle Rock - Crystaroller Room", true, ['Lamp', 'CaneOfSomaria', 'MagicMirror', 'Bottle']],

            ["Turtle Rock - Eye Bridge - Bottom Left", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Left", false, ['MagicMirror']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['MagicMirror', 'MoonPearl']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['MagicMirror', 'Bottle']],

            ["Turtle Rock - Eye Bridge - Bottom Right", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Right", false, ['MagicMirror']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['MagicMirror', 'MoonPearl']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['MagicMirror', 'Bottle']],

            ["Turtle Rock - Eye Bridge - Top Left", false, []],
            ["Turtle Rock - Eye Bridge - Top Left", false, ['MagicMirror']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['MagicMirror', 'MoonPearl']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['MagicMirror', 'Bottle']],

            ["Turtle Rock - Eye Bridge - Top Right", false, []],
            ["Turtle Rock - Eye Bridge - Top Right", false, ['MagicMirror']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['MagicMirror', 'MoonPearl']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['MagicMirror', 'Bottle']],

            ["Turtle Rock - Boss", false, []],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'ProgressiveSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MasterSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'ProgressiveSword', 'ProgressiveSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'MagicMirror', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'MagicMirror', 'ProgressiveSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'MagicMirror', 'MasterSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'MagicMirror', 'ProgressiveSword', 'ProgressiveSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'MagicMirror', 'MoonPearl', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'MagicMirror', 'MoonPearl', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'MagicMirror', 'MoonPearl', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
        ];
    }
}
