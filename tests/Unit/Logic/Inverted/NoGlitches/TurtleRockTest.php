<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @todo this is missing all the mirror entry tests.
 *
 * @group graph
 * @group Inverted
 * @group NoGlitches
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
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_merge(['TurtleRockEntryQuake:0'], array_map(fn ($i) => "$i:0", $items)));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Turtle Rock - Chain Chomps", false, []],
            ["Turtle Rock - Chain Chomps", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7']],
            ["Turtle Rock - Chain Chomps", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7']],
            ["Turtle Rock - Chain Chomps", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
            ["Turtle Rock - Chain Chomps", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7']],
            ["Turtle Rock - Chain Chomps", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Chain Chomps", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Chain Chomps", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Chain Chomps", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Compass Chest", false, []],
            ["Turtle Rock - Compass Chest", false, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword']],
            ["Turtle Rock - Compass Chest", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria']],

            ["Turtle Rock - Roller Room - Left", false, []],
            ["Turtle Rock - Roller Room - Left", false, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", false, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria']],
            ["Turtle Rock - Roller Room - Left", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],

            ["Turtle Rock - Roller Room - Right", false, []],
            ["Turtle Rock - Roller Room - Right", false, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", false, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria']],
            ["Turtle Rock - Roller Room - Right", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'FireRod']],

            ["Turtle Rock - Big Chest", false, []],
            ["Turtle Rock - Big Chest", false, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Chest", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Big Key Chest", false, []],
            ["Turtle Rock - Big Key Chest", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Crystaroller Room Chest", false, []],
            ["Turtle Rock - Crystaroller Room Chest", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room Chest", true, ['MoonPearl', 'OcarinaInactive', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room Chest", true, ['Lamp', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room Chest", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room Chest", true, ['MoonPearl', 'OcarinaInactive', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room Chest", true, ['Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Left", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Right", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Left", false, []],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Right", false, []],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MagicMirror', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'UncleSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Boss", false, []],
            ["Turtle Rock - Boss", false, ['FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Quake', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", false, ['IceRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Quake', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", false, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Quake', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", false, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Quake', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Quake', 'L2Sword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Quake', 'ProgressiveSword', 'ProgressiveSword', 'HalfMagic', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Quake', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'Quake', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'HalfMagic', 'Bottle', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'Hookshot', 'TitansMitt', 'Hammer', 'Quake', 'HalfMagic', 'Bottle', 'ProgressiveSword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
        ];
    }
}
