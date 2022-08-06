<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\NoGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
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
            'mode.state' => 'open',
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
            ["Superbunny Cave - Top", false, ['ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Superbunny Cave - Top", false, ['MoonPearl', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'OcarinaActive']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'OcarinaActive']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'OcarinaActive']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp']],

            ["Superbunny Cave - Bottom", false, []],
            ["Superbunny Cave - Bottom", false, ['ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Superbunny Cave - Bottom", false, ['MoonPearl', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'OcarinaActive']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'OcarinaActive']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'OcarinaActive']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp']],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", false, ['ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Bottom Right", false, ['MoonPearl', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'OcarinaActive', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'OcarinaActive', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp', 'PegasusBoots']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
            ["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Top Left", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Top Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
            ["Hookshot Cave - Top Left", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Top Right", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'OcarinaActive']],
            ["Hookshot Cave - Top Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
            ["Hookshot Cave - Top Right", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
        ];
    }
}
