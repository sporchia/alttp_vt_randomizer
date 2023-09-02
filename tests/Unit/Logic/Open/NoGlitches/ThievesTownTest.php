<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
 * @group NoGlitches
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
            'mode.state' => 'open',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Thieves' Town - Attic", false, []],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'TitansMitt', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Big Key Chest", false, []],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'TitansMitt']],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Thieves' Town - Map Chest", false, []],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'TitansMitt']],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Thieves' Town - Compass Chest", false, []],
            ["Thieves' Town - Compass Chest", false, ['TitansMitt']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'TitansMitt']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Thieves' Town - Ambush Chest", false, []],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'TitansMitt']],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Thieves' Town - Big Chest", false, []],
            ["Thieves' Town - Big Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['MoonPearl', 'TitansMitt', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hammer', 'Hookshot', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Blind's Cell", false, []],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'TitansMitt', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4']],

            ["Thieves' Town - Boss", false, []],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD4']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'BigKeyD4']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD4']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'TitansMitt', 'BigKeyD4', 'Hammer']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD4', 'Hammer']],
        ];
    }
}
