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
final class SkullWoodsTest extends TestCase
{
    public function testKeyForKey(): void
    {
        $randomizer = new Randomizer([[
            'mode.state' => 'inverted',
            'accessibility' => 'item',
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems([]);
        $this->assertTrue($randomizer->canReachLocation("Skull Woods - Big Chest:0"));
    }

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
            'accessibility' => 'locations',
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
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

            ["Skull Woods - Bridge Room Chest", false, []],
            ["Skull Woods - Bridge Room Chest", true, ['FireRod']],

            ["Skull Woods - Pot Prison", true, []],

            ["Skull Woods - Pinball Chest", true, []],

            ["Skull Woods - Boss", false, []],
            ["Skull Woods - Boss", false, ['KeyD3', 'KeyD3', 'KeyD3', 'UncleSword']],
            ["Skull Woods - Boss", false, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'FireRod', 'L4Sword']],
        ];
    }
}
