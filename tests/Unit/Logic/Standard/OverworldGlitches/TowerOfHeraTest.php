<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
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
            ["Tower Of Hera - Big Key Chest", false, []],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'PegasusBoots', 'KeyP3']],

            ["Tower Of Hera - Basement Cage", false, []],
            ["Tower Of Hera - Basement Cage", true, ['PegasusBoots']],

            ["Tower Of Hera - Map Chest", false, []],
            ["Tower Of Hera - Map Chest", true, ['PegasusBoots']],

            ["Tower Of Hera - Compass Chest", false, []],
            ["Tower Of Hera - Compass Chest", true, ['PegasusBoots', 'BigKeyP3']],

            ["Tower Of Hera - Big Chest", false, []],
            ["Tower Of Hera - Big Chest", true, ['PegasusBoots', 'BigKeyP3']],

            ["Tower Of Hera - Boss", false, []],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'ProgressiveSword']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'UncleSword']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'MasterSword']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'L3Sword']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'L4Sword']],
            ["Tower Of Hera - Boss", true, ['PegasusBoots', 'BigKeyP3', 'Hammer']],
        ];
    }
}
