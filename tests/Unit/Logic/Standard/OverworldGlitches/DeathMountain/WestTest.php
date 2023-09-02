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
final class WestTest extends TestCase
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
            ["Ether Tablet", false, []],
            ["Ether Tablet", false, ['PegasusBoots', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", false, ['PegasusBoots', 'BookOfMudora', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PegasusBoots', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PegasusBoots', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PegasusBoots', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PegasusBoots', 'BookOfMudora', 'L4Sword']],

            ["Old Man", false, []],
            ["Old Man", false, ['PegasusBoots']],
            ["Old Man", true, ['PegasusBoots', 'Lamp']],

            ["Spectacle Rock Cave", false, []],
            ["Spectacle Rock Cave", true, ['PegasusBoots']],

            ["Spectacle Rock", false, []],
            ["Spectacle Rock", true, ['PegasusBoots']],
        ];
    }
}
