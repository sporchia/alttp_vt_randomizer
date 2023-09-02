<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
 * @group OverworldGlitches
 */
final class LightWorldTest extends TestCase
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
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            // @todo figure out where the boots clip drops one off?
            // ["Magic Bat", false, []],
            // ["Magic Bat", true, ['Powder', 'PegasusBoots']],

            ["Hobo", true, []],

            ["Bombos Tablet", false, []],
            ["Bombos Tablet", true, ['PegasusBoots', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],

            ["King Zora", true, []],


            ["Cave 45", false, []],
            ["Cave 45", true, ['PegasusBoots']],

            ["Graveyard Cave Item", false, []],
            ["Graveyard Cave Item", true, ['PegasusBoots']],

            ["Checkerboard Cave", false, []],
            ["Checkerboard Cave", true, ['PegasusBoots', 'ProgressiveGlove']],
            ["Checkerboard Cave", true, ['PegasusBoots', 'PowerGlove']],
            ["Checkerboard Cave", true, ['PegasusBoots', 'TitansMitt']],

            ["Maze Race", true, []],

            ["Desert Ledge - Item", false, []],
            ["Desert Ledge - Item", true, ['PegasusBoots']],

            ["Lake Hylia Island", false, []],
            ["Lake Hylia Island", true, ['PegasusBoots']],

            ["Zora's Domain Ledge Item", false, []],
            ["Zora's Domain Ledge Item", true, ['PegasusBoots']],

            ["Waterfall Fairy - Left", false, []],
            ["Waterfall Fairy - Left", true, ['Flippers']],
            ["Waterfall Fairy - Left", true, ['MoonPearl']],
            ["Waterfall Fairy - Left", true, ['PegasusBoots']],

            ["Waterfall Fairy - Right", false, []],
            ["Waterfall Fairy - Right", true, ['Flippers']],
            ["Waterfall Fairy - Right", true, ['MoonPearl']],
            ["Waterfall Fairy - Right", true, ['PegasusBoots']],
        ];
    }
}
