<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group OverworldGlitches
 */
final class ThievesTownTest extends TestCase
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
            ["Thieves' Town - Attic", false, []],
            ["Thieves' Town - Attic", true, ['BigKeyD4', 'KeyD4']],

            ["Thieves' Town - Big Key Chest", true, []],

            ["Thieves' Town - Map Chest", true, []],

            ["Thieves' Town - Compass Chest", true, []],

            ["Thieves' Town - Ambush Chest", true, []],

            ["Thieves' Town - Big Chest", false, []],
            ["Thieves' Town - Big Chest", true, ['Hammer', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Blind's Cell", false, []],
            ["Thieves' Town - Blind's Cell", true, ['BigKeyD4']],

            ["Thieves' Town - Boss", false, []],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BigKeyD4']],
        ];
    }
}
