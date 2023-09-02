<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
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
            'mode.state' => 'inverted',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Agahnims Tower - First Chest", false, []],
            ["Agahnims Tower - First Chest", true, ['Lamp', 'ProgressiveGlove']],
            ["Agahnims Tower - First Chest", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Agahnims Tower - Second Chest", false, []],
            ["Agahnims Tower - Second Chest", false, ['KeyA1', 'OcarinaInactive', 'TitansMitt', 'MoonPearl']],
            ["Agahnims Tower - Second Chest", true, ['KeyA1', 'Lamp', 'ProgressiveGlove']],
            ["Agahnims Tower - Second Chest", true, ['KeyA1', 'Lamp', 'OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Agahnims Tower - Boss", false, []],
            ["Agahnims Tower - Boss", false, ['KeyA1', 'KeyA1', 'ProgressiveGlove', 'Lamp']],
            ["Agahnims Tower - Boss", true, ['KeyA1', 'KeyA1', 'L1Sword', 'ProgressiveGlove', 'Lamp']],
        ];
    }
}
