<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
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
            'mode.state' => 'inverted',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Mire Shed - Left", false, []],
            ["Mire Shed - Left", false, [], ['OcarinaInactive', 'MagicMirror']],
            ["Mire Shed - Left", true, ['MoonPearl', 'OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Left", true, ['MoonPearl', 'OcarinaInactive', 'ProgressiveGlove', 'Hammer']],
            ["Mire Shed - Left", true, ['MoonPearl', 'OcarinaInactive', 'AgahnimDefeated']],
            ["Mire Shed - Left", true, ['MagicMirror', 'AgahnimDefeated']],

            ["Mire Shed - Right", false, []],
            ["Mire Shed - Right", false, [], ['OcarinaInactive', 'MagicMirror']],
            ["Mire Shed - Right", true, ['MoonPearl', 'OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Right", true, ['MoonPearl', 'OcarinaInactive', 'ProgressiveGlove', 'Hammer']],
            ["Mire Shed - Right", true, ['MoonPearl', 'OcarinaInactive', 'AgahnimDefeated']],
            ["Mire Shed - Right", true, ['MagicMirror', 'AgahnimDefeated']],
        ];
    }
}
