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
final class IcePalaceTest extends TestCase
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
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Ice Palace - Big Key Chest", false, []],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Compass Chest", false, []],
            ["Ice Palace - Compass Chest", true, ['FireRod']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'UncleSword']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'ProgressiveSword']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'MasterSword']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'L3Sword']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'L4Sword']],

            ["Ice Palace - Map Chest", false, []],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Spike Room", false, []],
            ["Ice Palace - Spike Room", true, ['FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'FireRod', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'UncleSword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'FireRod', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'UncleSword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'ProgressiveSword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'MasterSword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'L3Sword', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'L4Sword', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Freezor Chest", false, []],
            ["Ice Palace - Freezor Chest", true, ['FireRod']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'UncleSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'ProgressiveSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'MasterSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'L3Sword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'L4Sword']],

            ["Ice Palace - Iced T Room", false, []],
            ["Ice Palace - Iced T Room", true, ['FireRod']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'UncleSword']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'ProgressiveSword']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'MasterSword']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'L3Sword']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'L4Sword']],

            ["Ice Palace - Big Chest", false, []],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'FireRod']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'UncleSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'MasterSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'L3Sword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'L4Sword']],

            ["Ice Palace - Boss", false, []],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
        ];
    }
}
