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
final class EasternPalaceTest extends TestCase
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
            ["Eastern Palace - Compass Chest", true, []],

            ["Eastern Palace - Cannonball Chest", true, []],

            ["Eastern Palace - Big Chest", false, []],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1']],

            ["Eastern Palace - Map Chest", true, []],

            ["Eastern Palace - Big Key Chest", false, []],
            ["Eastern Palace - Big Key Chest", true, ['Lamp']],

            ["Eastern Palace - Boss", false, []],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1']],
        ];
    }
}
