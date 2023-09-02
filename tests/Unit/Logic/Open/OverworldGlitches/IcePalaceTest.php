<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
 * @group OverworldGlitches
 */
final class IcePalaceTest extends TestCase
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
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Ice Palace - Big Key Chest", false, []],
            ["Ice Palace - Big Key Chest", true, ['FireRod', 'CaneOfSomaria', 'TitansMitt']],

            //["Ice Palace - Compass Chest", false, []],
            //["Ice Palace - Compass Chest", true, ['MoonPearl', 'PegasusBoots', 'Flippers', 'FireRod']],
            //
            //["Ice Palace - Map Chest", false, []],
            //["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'MoonPearl', 'PegasusBoots', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            //
            //["Ice Palace - Spike Room", false, []],
            //["Ice Palace - Spike Room", true, ['MoonPearl', 'PegasusBoots', 'Flippers', 'FireRod', 'Hookshot', 'KeyD5']],
            //
            //["Ice Palace - Freezor Chest", false, []],
            //["Ice Palace - Freezor Chest", true, ['TitansMitt', 'Bombos', 'L4Sword']],
            //
            //["Ice Palace - Iced T Room", false, []],
            //["Ice Palace - Iced T Room", true, ['TitansMitt', 'Bombos', 'L4Sword']],
            //
            //["Ice Palace - Big Chest", false, []],
            //["Ice Palace - Big Chest", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L4Sword']],
            //
            //["Ice Palace - Boss", false, []],
            //["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
        ];
    }
}
