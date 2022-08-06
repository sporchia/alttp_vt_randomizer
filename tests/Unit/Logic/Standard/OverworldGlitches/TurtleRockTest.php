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
            'mode.state' => 'standard',
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
            ["Turtle Rock - Chain Chomps", true, ['MoonPearl', 'PegasusBoots']],
            ["Turtle Rock - Chain Chomps", true, ['PegasusBoots', 'MagicMirror', 'Hammer']],
            ["Turtle Rock - Chain Chomps", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt']],

            ["Turtle Rock - Compass Chest", false, []],
            ["Turtle Rock - Compass Chest", true, ['MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Compass Chest", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Compass Chest", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Roller Room - Left", false, []],
            ["Turtle Rock - Roller Room - Left", true, ['MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],

            ["Turtle Rock - Roller Room - Right", false, []],
            ["Turtle Rock - Roller Room - Right", true, ['MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],

            ["Turtle Rock - Big Chest", false, []],
            ["Turtle Rock - Big Chest", true, ['MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['MoonPearl', 'PegasusBoots', 'Hookshot', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'Hookshot', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'Hookshot', 'BigKeyD7']],

            ["Turtle Rock - Big Key Chest", false, []],
            ["Turtle Rock - Big Key Chest", true, ['MoonPearl', 'PegasusBoots', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Crystaroller Room", false, []],
            ["Turtle Rock - Crystaroller Room", true, ['MoonPearl', 'PegasusBoots', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Left", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Right", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Left", false, []],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Right", false, []],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Boss", false, []],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'ProgressiveSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'ProgressiveSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'MasterSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'MasterSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'ProgressiveSword', 'ProgressiveSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'ProgressiveSword', 'ProgressiveSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
        ];
    }
}
