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
final class EscapeTest extends TestCase
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
            ["Sanctuary", true, []],

            ["Sewers - Secret Room - Left", false, []],
            ["Sewers - Secret Room - Left", true, ['ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['Lamp', 'KeyH2']],

            ["Sewers - Secret Room - Middle", false, []],
            ["Sewers - Secret Room - Middle", true, ['ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['Lamp', 'KeyH2']],

            ["Sewers - Secret Room - Right", false, []],
            ["Sewers - Secret Room - Right", true, ['ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['Lamp', 'KeyH2']],

            ["Sewers - Dark Cross", true, ['Lamp']],

            ["Hyrule Castle - Boomerang Chest", false, []],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2']],

            ["Hyrule Castle - Map Chest", true, []],

            ["Hyrule Castle - Zelda's Cell", false, []],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2']],

            ["Link's Uncle", true, []],

            ["Secret Passage", true, []],
        ];
    }
}
