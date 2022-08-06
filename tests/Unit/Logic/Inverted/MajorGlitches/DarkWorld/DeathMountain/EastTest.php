<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\MajorGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group MajorGlitches
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
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Superbunny Cave - Top", true, []],

            ["Superbunny Cave - Bottom", true, []],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", true, ['Hookshot']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", true, ['Hookshot']],
        ];
    }
}
