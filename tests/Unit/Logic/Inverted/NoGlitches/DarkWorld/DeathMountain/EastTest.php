<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group NoGlitches
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
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Superbunny Cave - Top", false, []],
            ["Superbunny Cave - Top", true, ['ProgressiveGlove', 'Lamp']],
            ["Superbunny Cave - Top", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive']],
            ["Superbunny Cave - Top", true, ['Hammer', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive']],

            ["Superbunny Cave - Bottom", false, []],
            ["Superbunny Cave - Bottom", true, ['ProgressiveGlove', 'Lamp']],
            ["Superbunny Cave - Bottom", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive']],
            ["Superbunny Cave - Bottom", true, ['Hammer', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive']],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'Lamp', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive', 'Hookshot']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'Hookshot']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", false, ['ProgressiveGlove', 'Lamp']],
            ["Hookshot Cave - Bottom Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive', 'Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'Hookshot']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", false, ['ProgressiveGlove', 'Lamp']],
            ["Hookshot Cave - Top Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Top Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive', 'Hookshot']],
            ["Hookshot Cave - Top Left", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'Hookshot']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", false, ['ProgressiveGlove', 'Lamp']],
            ["Hookshot Cave - Top Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Top Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'OcarinaInactive', 'Hookshot']],
            ["Hookshot Cave - Top Right", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'Hookshot']],
        ];
    }
}
