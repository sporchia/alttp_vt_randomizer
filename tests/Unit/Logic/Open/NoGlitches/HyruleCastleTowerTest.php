<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
 * @group NoGlitches
 */
final class HyruleCastleTowerTest extends TestCase
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
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Agahnims Tower - First Chest", false, []],
            ["Agahnims Tower - First Chest", true, ['L2Sword']],
            ["Agahnims Tower - First Chest", true, ['Cape']],

            ["Agahnims Tower - Second Chest", false, []],
            ["Agahnims Tower - Second Chest", false, ['L2Sword']],
            ["Agahnims Tower - Second Chest", true, ['KeyA1', 'L2Sword', 'Lamp']],
            ["Agahnims Tower - Second Chest", true, ['KeyA1', 'Cape', 'Lamp']],

            ["Agahnims Tower - Boss", false, []],
            ["Agahnims Tower - Boss", false, ['KeyA1', 'KeyA1', 'Cape', 'Lamp']],
            ["Agahnims Tower - Boss", true, ['KeyA1', 'KeyA1', 'L2Sword', 'Lamp']],
            ["Agahnims Tower - Boss", true, ['KeyA1', 'KeyA1', 'L1Sword', 'Cape', 'Lamp']],
        ];
    }
}
