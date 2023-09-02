<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\OverworldGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group OverworldGlitches
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
            ["Mire Shed - Left", false, []],
            ["Mire Shed - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Mire Shed - Left", true, ['MagicMirror', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Left", true, ['MagicMirror', 'Flute', 'TitansMitt']],

            ["Mire Shed - Right", false, []],
            ["Mire Shed - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Mire Shed - Right", true, ['MagicMirror', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Right", true, ['MagicMirror', 'Flute', 'TitansMitt']],
        ];
    }
}
