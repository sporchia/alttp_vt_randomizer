<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\OverworldGlitches\DeathMountain;

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
            ["Spiral Cave", false, []],
            ["Spiral Cave", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Far Left", false, []],
            ["Paradox Cave Lower - Far Left", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Left", false, []],
            ["Paradox Cave Lower - Left", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Middle", false, []],
            ["Paradox Cave Lower - Middle", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Right", false, []],
            ["Paradox Cave Lower - Right", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Far Right", false, []],
            ["Paradox Cave Lower - Far Right", true, ['PegasusBoots']],

            ["Paradox Cave Upper - Left", false, []],
            ["Paradox Cave Lower - Left", true, ['PegasusBoots']],

            ["Paradox Cave Upper - Right", false, []],
            ["Paradox Cave Lower - Right", true, ['PegasusBoots']],

            ["Mimic Cave", false, []],
            ["Mimic Cave", false, ['Hammer', 'PegasusBoots']],
            ["Mimic Cave", false, ['MagicMirror', 'PegasusBoots']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'PegasusBoots']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'ProgressiveGlove', 'Lamp']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'PowerGlove', 'Lamp']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'TitansMitt', 'Lamp']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'Flute']],
        ];
    }
}
