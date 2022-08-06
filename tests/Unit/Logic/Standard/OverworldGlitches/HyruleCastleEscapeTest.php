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
final class HyruleCastleEscapeTest extends TestCase
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
            ["Sanctuary", true, ['UncleSword', 'KeyH2']],

            ["Sewers - Secret Room - Left", true, ['UncleSword', 'KeyH2']],

            ["Sewers - Secret Room - Middle", true, ['UncleSword', 'KeyH2']],

            ["Sewers - Secret Room - Right", true, ['UncleSword', 'KeyH2']],

            ["Sewers - Dark Cross", true, ['UncleSword']],

            ["Hyrule Castle - Boomerang Chest", true, ['UncleSword']],

            ["Hyrule Castle - Map Chest", true, ['UncleSword']],

            ["Hyrule Castle - Zelda's Cell", true, ['UncleSword']],
        ];
    }
}
