<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
 */
final class MireTest extends TestCase
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
            ["Mire Shed - Left", false, []],
            ["Mire Shed - Left", true, ['MoonPearl']],
            ["Mire Shed - Left", true, ['BottleWithBee']],
            ["Mire Shed - Left", true, ['BottleWithFairy']],
            ["Mire Shed - Left", true, ['BottleWithRedPotion']],
            ["Mire Shed - Left", true, ['BottleWithGreenPotion']],
            ["Mire Shed - Left", true, ['BottleWithBluePotion']],
            ["Mire Shed - Left", true, ['Bottle']],
            ["Mire Shed - Left", true, ['BottleWithGoldBee']],
            ["Mire Shed - Left", true, ['MagicMirror']],

            ["Mire Shed - Right", false, []],
            ["Mire Shed - Right", true, ['MoonPearl']],
            ["Mire Shed - Right", true, ['BottleWithBee']],
            ["Mire Shed - Right", true, ['BottleWithFairy']],
            ["Mire Shed - Right", true, ['BottleWithRedPotion']],
            ["Mire Shed - Right", true, ['BottleWithGreenPotion']],
            ["Mire Shed - Right", true, ['BottleWithBluePotion']],
            ["Mire Shed - Right", true, ['Bottle']],
            ["Mire Shed - Right", true, ['BottleWithGoldBee']],
            ["Mire Shed - Right", true, ['MagicMirror']],
        ];
    }
}
