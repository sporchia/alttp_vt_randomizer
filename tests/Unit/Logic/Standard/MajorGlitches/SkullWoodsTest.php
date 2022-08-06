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
            ["Skull Woods - Big Chest", false, []],
            ["Skull Woods - Big Chest", true, ['BigKeyD3']],

            ["Skull Woods - Big Key Chest", true, []],

            ["Skull Woods - Compass Chest", true, []],

            ["Skull Woods - Map Chest", true, []],

            ["Skull Woods - Bridge Room", false, []],
            ["Skull Woods - Bridge Room", true, ['FireRod', 'MoonPearl']],

            ["Skull Woods - Pot Prison", true, []],

            ["Skull Woods - Pinball Room", true, []],

            ["Skull Woods - Boss", false, []],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MoonPearl', 'ProgressiveSword']],
        ];
    }
}
