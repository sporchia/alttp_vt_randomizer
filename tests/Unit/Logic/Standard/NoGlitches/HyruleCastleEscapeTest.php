<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group NoGlitches
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
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Sanctuary Chest", true, ['UncleSword', 'KeyH2']],

            ["Sewers - Secret Room - Left", true, ['UncleSword', 'KeyH2']],

            ["Sewers - Secret Room - Middle", true, ['UncleSword', 'KeyH2']],

            ["Sewers - Secret Room - Right", true, ['UncleSword', 'KeyH2']],

            ["Sewers - Dark Cross Chest", true, ['UncleSword']],

            ["Hyrule Castle - Boomerang Chest", true, ['UncleSword']],

            ["Hyrule Castle - Map Chest", true, ['UncleSword']],

            ["Hyrule Castle - Zelda's Cell", true, ['UncleSword']],
        ];
    }
}
