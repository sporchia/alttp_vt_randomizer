<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group OverworldGlitches
 */
final class TowerOfHeraTest extends TestCase
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
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Tower Of Hera - Big Key Chest", false, []],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'PegasusBoots', 'MoonPearl', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'PegasusBoots', 'MoonPearl', 'KeyP3']],

            ["Tower Of Hera - Basement Cage", false, []],
            ["Tower Of Hera - Basement Cage", true, ['PegasusBoots', 'MoonPearl']],

            ["Tower Of Hera - Map Chest", false, []],
            ["Tower Of Hera - Map Chest", true, ['PegasusBoots', 'MoonPearl']],

            ["Tower Of Hera - Compass Chest", false, []],
            ["Tower Of Hera - Compass Chest", true, ['PegasusBoots', 'MoonPearl', 'BigKeyP3']],

            ["Tower Of Hera - Big Chest", false, []],
            ["Tower Of Hera - Big Chest", true, ['PegasusBoots', 'MoonPearl', 'BigKeyP3']],

            ["Tower Of Hera - Boss", false, []],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'UncleSword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'ProgressiveSword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'MasterSword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'L3Sword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'MoonPearl', 'L4Sword', 'BigKeyP3']],
        ];
    }
}
