<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
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
        $this->markTestSkipped();
        $randomizer = new Randomizer([[
            'mode.state' => 'standard',
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Tower Of Hera - Big Key Chest", false, []],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'KeyP3']],

            ["Tower Of Hera - Basement Cage", true, []],

            ["Tower Of Hera - Map Chest", true, []],

            ["Tower Of Hera - Compass Chest", false, []],
            ["Tower Of Hera - Compass Chest", true, ['BigKeyP3']],

            ["Tower Of Hera - Big Chest", false, []],
            ["Tower Of Hera - Big Chest", true, ['BigKeyP3']],

            ["Tower Of Hera - Boss", false, []],
            ["Tower Of Hera - Boss", true, ['BigKeyP3', 'ProgressiveSword']],
            ["Tower Of Hera - Boss", true, ['BigKeyP3', 'UncleSword']],
            ["Tower Of Hera - Boss", true, ['BigKeyP3', 'MasterSword']],
            ["Tower Of Hera - Boss", true, ['BigKeyP3', 'L3Sword']],
            ["Tower Of Hera - Boss", true, ['BigKeyP3', 'L4Sword']],
            ["Tower Of Hera - Boss", true, ['BigKeyP3', 'Hammer']],
        ];
    }
}
