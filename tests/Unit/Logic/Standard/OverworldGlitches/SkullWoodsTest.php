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
final class SkullWoodsTest extends TestCase
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
            ["Skull Woods - Big Chest", false, []],
            ["Skull Woods - Big Chest", true, ['MagicMirror', 'PegasusBoots', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'PegasusBoots', 'BigKeyD3']],

            ["Skull Woods - Big Key Chest", false, []],
            ["Skull Woods - Big Key Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Compass Chest", false, []],
            ["Skull Woods - Compass Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Map Chest", false, []],
            ["Skull Woods - Map Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Bridge Room", false, []],
            ["Skull Woods - Bridge Room", true, ['MoonPearl', 'PegasusBoots', 'FireRod']],

            ["Skull Woods - Pot Prison", false, []],
            ["Skull Woods - Pot Prison", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Pinball Room", false, []],
            ["Skull Woods - Pinball Room", true, ['MagicMirror', 'PegasusBoots']],
            ["Skull Woods - Pinball Room", true, ['MoonPearl', 'PegasusBoots']],

            ["Skull Woods - Boss", false, []],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PegasusBoots', 'FireRod', 'ProgressiveSword']],
        ];
    }
}
