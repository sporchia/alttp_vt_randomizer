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
final class GanonsTowerTest extends TestCase
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
            ["Ganon's Tower - Bob's Torch", false, []],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'PegasusBoots']],

            ["Ganon's Tower - DMs Room - Top Left", false, []],
            ["Ganon's Tower - DMs Room - Top Left", true, ['MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - DMs Room - Top Right", false, []],
            ["Ganon's Tower - DMs Room - Top Right", true, ['MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - DMs Room - Bottom Left", false, []],
            ["Ganon's Tower - DMs Room - Bottom Left", true, ['MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - DMs Room - Bottom Right", false, []],
            ["Ganon's Tower - DMs Room - Bottom Right", true, ['MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Randomizer Room - Top Left", false, []],
            ["Ganon's Tower - Randomizer Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Randomizer Room - Top Right", false, []],
            ["Ganon's Tower - Randomizer Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Randomizer Room - Bottom Left", false, []],
            ["Ganon's Tower - Randomizer Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Randomizer Room - Bottom Right", false, []],
            ["Ganon's Tower - Randomizer Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Firesnake Room", false, []],
            ["Ganon's Tower - Firesnake Room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Map Chest", false, []],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Big Chest", false, []],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'PegasusBoots']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Hope Room - Left", false, []],
            ["Ganon's Tower - Hope Room - Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Ganon's Tower - Hope Room - Right", false, []],
            ["Ganon's Tower - Hope Room - Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Ganon's Tower - Bob's Chest", false, []],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'CaneOfSomaria', 'FireRod', 'PegasusBoots']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Tile Room", false, []],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'TitansMitt', 'CaneOfSomaria', 'PegasusBoots']],

            ["Ganon's Tower - Compass Room - Top Left", false, []],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'CaneOfSomaria', 'PegasusBoots']],

            ["Ganon's Tower - Compass Room - Top Right", false, []],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'CaneOfSomaria', 'PegasusBoots']],

            ["Ganon's Tower - Compass Room - Bottom Left", false, []],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'CaneOfSomaria', 'PegasusBoots']],

            ["Ganon's Tower - Compass Room - Bottom Right", false, []],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'CaneOfSomaria', 'PegasusBoots']],

            ["Ganon's Tower - Big Key Chest", false, []],
            ["Ganon's Tower - Big Key Chest", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl',  'CaneOfSomaria', 'FireRod', 'PegasusBoots']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Big Key Room - Left", false, []],
            ["Ganon's Tower - Big Key Room - Left", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'CaneOfSomaria', 'FireRod', 'PegasusBoots']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Big Key Room - Right", false, []],
            ["Ganon's Tower - Big Key Room - Right", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'CaneOfSomaria', 'FireRod', 'PegasusBoots']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'Hammer', 'PegasusBoots']],

            ["Ganon's Tower - Mini Helmasaur Room - Left", false, []],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'FireRod', 'PegasusBoots']],

            ["Ganon's Tower - Mini Helmasaur Room - Right", false, []],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'FireRod', 'PegasusBoots']],

            ["Ganon's Tower - Pre-Moldorm Chest", false, []],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Lamp', 'PegasusBoots']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'FireRod', 'PegasusBoots']],

            ["Ganon's Tower - Moldorm Chest", false, []],
            ["Ganon's Tower - Moldorm Chest", true, ['BowAndArrows', 'UncleSword', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Lamp', 'Hookshot', 'PegasusBoots']],
            ["Ganon's Tower - Moldorm Chest", true, ['BowAndArrows', 'UncleSword', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'Hookshot', 'FireRod', 'PegasusBoots']],
        ];
    }
}
