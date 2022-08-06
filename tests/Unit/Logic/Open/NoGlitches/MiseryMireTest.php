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
            'mode.state' => 'open',
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_merge(['MireEntryEther:0'], array_map(fn ($i) => "$i:0", $items)));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Misery Mire - Big Chest", false, []],
            ["Misery Mire - Big Chest", false, ['BigKeyD6', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Main Lobby Chest", false, []],
            ["Misery Mire - Main Lobby Chest", false, ['KeyD6', 'MoonPearl', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Big Key Chest", false, []],
            ["Misery Mire - Big Key Chest", false, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Compass Chest", false, []],
            ["Misery Mire - Compass Chest", false, ['KeyD6', 'KeyD6', 'KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Bridge Chest", false, []],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Map Chest", false, []],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Spike Chest", false, []],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Boss", false, []],
            ["Misery Mire - Boss", false, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'OcarinaActive', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],
        ];
    }
}
