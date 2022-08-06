<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
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
            'mode.state' => 'inverted',
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
            ["Hype Cave - Top", true, []],

            ["Hype Cave - Middle Right", true, []],

            ["Hype Cave - Middle Left", true, []],

            ["Hype Cave - Bottom", true, []],

            ["Hype Cave - NPC", true, []],

            ["Stumpy", true, []],

            ["Digging Game", true, []],
        ];
    }
}
