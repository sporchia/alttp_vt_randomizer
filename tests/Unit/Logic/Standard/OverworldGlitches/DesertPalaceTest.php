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
            'mode.state' => 'standard',
            'difficulty' => 'test_rules',
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Desert Palace - Map Chest", false, []],
            ["Desert Palace - Map Chest", true, ['PegasusBoots']],

            ["Desert Palace - Big Chest", false, []],
            ["Desert Palace - Big Chest", true, ['PegasusBoots', 'BigKeyP2']],

            ["Desert Palace - Torch", false, []],
            ["Desert Palace - Torch", true, ['PegasusBoots']],

            ["Desert Palace - Compass Chest", false, []],
            ["Desert Palace - Compass Chest", true, ['PegasusBoots', 'KeyP2']],

            ["Desert Palace - Big Key Chest", false, []],
            ["Desert Palace - Big Key Chest", true, ['PegasusBoots', 'KeyP2']],

            ["Desert Palace - Boss", false, []],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'PegasusBoots', 'Lamp', 'BigKeyP2']],
        ];
    }
}
