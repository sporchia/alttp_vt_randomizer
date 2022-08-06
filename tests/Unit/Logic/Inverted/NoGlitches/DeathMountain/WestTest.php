<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group NoGlitches
 */
final class WestTest extends TestCase
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
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Old Man", false, []],
            ["Old Man", false, ['ProgressiveGlove']],
            ["Old Man", true, ['ProgressiveGlove', 'Lamp']],
            ["Old Man", true, ['PowerGlove', 'Lamp']],
            ["Old Man", true, ['TitansMitt', 'Lamp']],
            ["Old Man", true, ['OcarinaActive', 'Lamp']],

            ["Spectacle Rock Cave", false, []],
            ["Spectacle Rock Cave", false, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock Cave", false, ['OcarinaInactive', 'PowerGlove', 'Hammer']],
            ["Spectacle Rock Cave", false, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock Cave", false, ['OcarinaInactive', 'TitansMitt']],
            ["Spectacle Rock Cave", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock Cave", true, ['OcarinaInactive', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Spectacle Rock Cave", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock Cave", true, ['OcarinaInactive', 'MoonPearl', 'TitansMitt']],
            ["Spectacle Rock Cave", true, ['ProgressiveGlove', 'Lamp']],
            ["Spectacle Rock Cave", true, ['PowerGlove', 'Lamp']],
            ["Spectacle Rock Cave", true, ['TitansMitt', 'Lamp']],
        ];
    }
}
