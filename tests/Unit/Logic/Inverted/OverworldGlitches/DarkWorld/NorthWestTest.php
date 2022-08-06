<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group OverworldGlitches
 */
final class NorthWestTest extends TestCase
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
            ["Brewery", true, []],

            ["C-Shaped House", true, []],

            ["Chest Game", true, []],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", true, ['Hammer', 'PegasusBoots']],

            ["Bumper Cave", false, []],
            ["Bumper Cave", true, ['PegasusBoots']],

            ["Blacksmith", false, []],
            ["Blacksmith", true, ['MagicMirror', 'PegasusBoots']],
            ["Blacksmith", true, ['ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots', 'MoonPearl']],

            ["Purple Chest", false, []],
            ["Purple Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Purple Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots', 'MoonPearl']],
        ];
    }
}
