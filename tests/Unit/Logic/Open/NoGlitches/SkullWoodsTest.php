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
final class SkullWoodsTest extends TestCase
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
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Skull Woods - Big Chest", false, []],
            ["Skull Woods - Big Chest", false, ['TitansMitt', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'TitansMitt', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'BigKeyD3']],
            ["Skull Woods - Big Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'BigKeyD3']],

            ["Skull Woods - Big Key Chest", false, []],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'TitansMitt']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Skull Woods - Big Key Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Skull Woods - Compass Chest", false, []],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'TitansMitt']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Skull Woods - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Skull Woods - Map Chest", false, []],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'TitansMitt']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Skull Woods - Map Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Skull Woods - Bridge Room Chest", false, []],
            ["Skull Woods - Bridge Room Chest", true, ['MoonPearl', 'TitansMitt', 'FireRod']],
            ["Skull Woods - Bridge Room Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
            ["Skull Woods - Bridge Room Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod']],
            ["Skull Woods - Bridge Room Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'FireRod']],
            ["Skull Woods - Bridge Room Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'FireRod']],
            ["Skull Woods - Bridge Room Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'FireRod']],
            ["Skull Woods - Bridge Room Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'FireRod']],
            ["Skull Woods - Bridge Room Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'FireRod']],

            ["Skull Woods - Pot Prison", false, []],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'TitansMitt']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Skull Woods - Pot Prison", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Skull Woods - Pinball Chest", false, []],
            ["Skull Woods - Pinball Chest", true, ['MoonPearl', 'TitansMitt']],
            ["Skull Woods - Pinball Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Skull Woods - Pinball Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Skull Woods - Pinball Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Skull Woods - Pinball Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Skull Woods - Pinball Chest", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Skull Woods - Pinball Chest", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Skull Woods - Pinball Chest", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Skull Woods - Boss", false, []],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'TitansMitt', 'FireRod', 'ProgressiveSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'ProgressiveSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'FireRod', 'ProgressiveSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'PowerGlove', 'Hammer', 'FireRod', 'ProgressiveSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'FireRod', 'ProgressiveSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'FireRod', 'ProgressiveSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'FireRod', 'ProgressiveSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'FireRod', 'UncleSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'FireRod', 'MasterSword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'FireRod', 'L3Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'FireRod', 'L4Sword']],
            ["Skull Woods - Boss", true, ['KeyD3', 'KeyD3', 'KeyD3', 'MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'FireRod', 'ProgressiveSword']],
        ];
    }
}
