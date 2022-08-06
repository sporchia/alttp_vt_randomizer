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
final class MiseryMireTest extends TestCase
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
        $randomizer->assumeItems(array_merge(['MireEntryEther:0'], array_map(fn ($i) => "$i:0", $items)));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Misery Mire - Big Chest", false, []],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Main Lobby Chest", false, []],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Big Key Chest", false, []],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'L4Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Compass Chest", false, []],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'L4Sword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Bridge Chest", false, []],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Map Chest", false, []],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Spike Chest", false, []],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Boss", false, []],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'L4Sword']],
        ];
    }
}
