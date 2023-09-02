<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\OverworldGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group OverworldGlitches
 */
final class EastTest extends TestCase
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
            ["Superbunny Cave - Top", false, []],
            ["Superbunny Cave - Top", true, ['ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots']],
            ["Superbunny Cave - Top", true, ['TitansMitt', 'PegasusBoots']],
            ["Superbunny Cave - Top", true, ['Hammer', 'PegasusBoots']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'PegasusBoots']],

            ["Superbunny Cave - Bottom", false, []],
            ["Superbunny Cave - Bottom", true, ['ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots']],
            ["Superbunny Cave - Bottom", true, ['TitansMitt', 'PegasusBoots']],
            ["Superbunny Cave - Bottom", true, ['Hammer', 'PegasusBoots']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'PegasusBoots']],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'PegasusBoots', 'Hookshot']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", true, ['MoonPearl', 'PegasusBoots', 'Hookshot']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", true, ['MoonPearl', 'PegasusBoots', 'Hookshot']],
        ];
    }
}
