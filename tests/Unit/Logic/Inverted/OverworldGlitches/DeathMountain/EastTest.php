<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches\DeathMountain;

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
            ["Spiral Cave", false, []],
            ["Spiral Cave", true, ['MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'TitansMitt', 'Lamp', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'TitansMitt', 'PegasusBoots', 'UncleSword']],
            ["Spiral Cave", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Far Left", false, []],
            ["Paradox Cave Lower - Far Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Left", false, []],
            ["Paradox Cave Lower - Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Middle", false, []],
            ["Paradox Cave Lower - Middle", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Right", false, []],
            ["Paradox Cave Lower - Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Far Right", false, []],
            ["Paradox Cave Lower - Far Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Upper - Left", false, []],
            ["Paradox Cave Upper - Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Upper - Right", false, []],
            ["Paradox Cave Upper - Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Mimic Cave", false, []],
            ["Mimic Cave", true, ['MoonPearl', 'Hammer', 'PegasusBoots']],

            ["Ether Tablet", false, []],
            ["Ether Tablet", true, ['PegasusBoots', 'MoonPearl', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PegasusBoots', 'MoonPearl', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PegasusBoots', 'MoonPearl', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PegasusBoots', 'MoonPearl', 'BookOfMudora', 'L4Sword']],

            ["Spectacle Rock", false, []],
            ["Spectacle Rock", true, ['MoonPearl', 'PegasusBoots']],
        ];
    }
}
