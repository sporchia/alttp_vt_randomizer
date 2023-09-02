<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\OverworldGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group OverworldGlitches
 */
final class NorthEastTest extends TestCase
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
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Catfish", false, []],
            ["Catfish", false, ['PegasusBoots']],
            ["Catfish", true, ['MoonPearl', 'PegasusBoots']],

            ["Pyramid", false, []],
            ["Pyramid", true, ['MoonPearl', 'PegasusBoots']],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", true, ['MagicMirror', 'PegasusBoots']],

            ["Pyramid Fairy - Right", false, []],
            ["Pyramid Fairy - Right", true, ['MagicMirror', 'PegasusBoots']],

            ["Ganon", false, []],
        ];
    }
}
