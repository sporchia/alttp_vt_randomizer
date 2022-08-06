<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
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
            'difficulty' => 'test_rules',
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Ether Tablet", false, []],
            ["Ether Tablet", true, ['BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L4Sword']],

            ["Old Man", false, []],
            ["Old Man", true, ['Lamp']],

            ["Spectacle Rock Cave", true, []],

            ["Spectacle Rock", true, []],
        ];
    }
}
