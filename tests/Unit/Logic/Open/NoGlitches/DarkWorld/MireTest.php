<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\NoGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
 * @group NoGlitches
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
            ["Mire Shed - Left", false, []],
            ["Mire Shed - Left", false, ['OcarinaActive', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Left", false, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Left", false, ['MoonPearl', 'OcarinaActive', 'ProgressiveGlove']],
            ["Mire Shed - Left", true, ['MoonPearl', 'OcarinaActive', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Left", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt']],

            ["Mire Shed - Right", false, []],
            ["Mire Shed - Right", false, ['OcarinaActive', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Right", false, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Right", false, ['MoonPearl', 'OcarinaActive', 'ProgressiveGlove']],
            ["Mire Shed - Right", true, ['MoonPearl', 'OcarinaActive', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Right", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt']],
        ];
    }
}
