<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\MajorGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group MajorGlitches
 */
final class DesertPalaceTest extends TestCase
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
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Desert Palace - Map Chest", true, []],

            ["Desert Palace - Big Chest", false, []],
            ["Desert Palace - Big Chest", true, ['BigKeyP2']],

            ["Desert Palace - Torch", false, []],
            ["Desert Palace - Torch", true, ['PegasusBoots']],

            ["Desert Palace - Compass Chest", false, []],
            ["Desert Palace - Compass Chest", true, ['KeyP2']],

            ["Desert Palace - Big Key Chest", false, []],
            ["Desert Palace - Big Key Chest", true, ['KeyP2']],

            ["Desert Palace - Boss", false, []],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BigKeyP2', 'Lamp']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BigKeyP2', 'FireRod']],
        ];
    }
}
