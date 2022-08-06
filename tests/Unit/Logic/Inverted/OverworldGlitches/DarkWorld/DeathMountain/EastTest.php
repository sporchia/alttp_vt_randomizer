<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
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
            'mode.state' => 'inverted',
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
            ["Superbunny Cave - Top", false, []],
            ["Superbunny Cave - Top", true, ['PegasusBoots']],

            ["Superbunny Cave - Bottom", false, []],
            ["Superbunny Cave - Bottom", true, ['PegasusBoots']],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", true, ['PegasusBoots', 'Hookshot']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", true, ['PegasusBoots', 'Hookshot']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", true, ['PegasusBoots', 'Hookshot']],
        ];
    }
}
