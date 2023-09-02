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
            ["Brewery", false, []],
            ["Brewery", false, ['PegasusBoots']],
            ["Brewery", true, ['MoonPearl', 'PegasusBoots']],

            ["C-Shaped House", false, []],
            ["C-Shaped House", true, ['MoonPearl', 'PegasusBoots']],
            ["C-Shaped House", true, ['MagicMirror', 'PegasusBoots']],

            ["Chest Game", false, []],
            ["Chest Game", true, ['MoonPearl', 'PegasusBoots']],
            ["Chest Game", true, ['MagicMirror', 'PegasusBoots']],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", false, ['MoonPearl', 'PegasusBoots']],
            ["Hammer Pegs", false, ['Hammer', 'PegasusBoots']],
            ["Hammer Pegs", true, ['MoonPearl', 'Hammer', 'PegasusBoots']],

            ["Bumper Cave", false, []],
            ["Bumper Cave", true, ['MoonPearl', 'PegasusBoots']],

            ["Blacksmith", false, []],
            ["Blacksmith", false, ['ProgressiveGlove', 'ProgressiveGlove']],
            ["Blacksmith", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blacksmith", true, ['MoonPearl', 'TitansMitt']],

            ["Purple Chest", false, []],
            ["Purple Chest", false, ['ProgressiveGlove', 'ProgressiveGlove']],
            ["Purple Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Purple Chest", true, ['MoonPearl', 'TitansMitt']],
        ];
    }
}
