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
            ["Thieves' Town - Attic", false, []],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'PegasusBoots', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Big Key Chest", false, []],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Thieves' Town - Map Chest", false, []],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Thieves' Town - Compass Chest", false, []],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Thieves' Town - Ambush Chest", false, []],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Thieves' Town - Big Chest", false, []],
            ["Thieves' Town - Big Chest", true, ['MoonPearl', 'PegasusBoots', 'Hammer', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Blind's Cell", false, []],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'PegasusBoots', 'BigKeyD4']],

            ["Thieves' Town - Boss", false, []],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'Hammer']],
        ];
    }
}
