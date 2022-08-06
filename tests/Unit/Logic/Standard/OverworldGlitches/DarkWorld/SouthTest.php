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
final class SouthTest extends TestCase
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
            ["Hype Cave - Top", false, []],
            ["Hype Cave - Top", false, ['PegasusBoots']],
            ["Hype Cave - Top", true, ['MoonPearl', 'PegasusBoots']],

            ["Hype Cave - Middle Right", false, []],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Hype Cave - Middle Left", false, []],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Hype Cave - Bottom", false, []],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'PegasusBoots']],

            ["Hype Cave - NPC", false, []],
            ["Hype Cave - NPC", true, ['MoonPearl', 'PegasusBoots']],

            ["Stumpy", false, []],
            ["Stumpy", true, ['MoonPearl', 'PegasusBoots']],

            ["Digging Game", false, []],
            ["Digging Game", true, ['MoonPearl', 'PegasusBoots']],
        ];
    }
}
