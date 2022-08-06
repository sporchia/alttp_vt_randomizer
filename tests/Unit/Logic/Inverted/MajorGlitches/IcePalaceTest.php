<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\MajorGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group MajorGlitches
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
            'difficulty' => 'test_rules',
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Ice Palace - Big Key Chest", false, []],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Compass Chest", true, []],

            ["Ice Palace - Map Chest", false, []],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Spike Room", false, []],
            ["Ice Palace - Spike Room", true, ['Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['KeyD5', 'KeyD5']],

            ["Ice Palace - Freezor Chest", false, []],
            ["Ice Palace - Freezor Chest", true, ['FireRod']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'UncleSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'ProgressiveSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'MasterSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'L3Sword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'L4Sword']],

            ["Ice Palace - Iced T Room", true, []],

            ["Ice Palace - Big Chest", false, []],
            ["Ice Palace - Big Chest", true, ['BigKeyD5']],

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
