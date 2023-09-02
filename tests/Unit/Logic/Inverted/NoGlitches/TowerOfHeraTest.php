<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group NoGlitches
 */
final class TowerOfHeraTest extends TestCase
{
    public function testKeyForKey(): void
    {
        $randomizer = new Randomizer([[
            'mode.state' => 'inverted',
            'accessibility' => 'item',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", ['Lamp', 'Hammer', 'MoonPearl', 'OcarinaActive', 'Hookshot']));
        $this->assertTrue($randomizer->canReachLocation("Tower Of Hera - Big Key Chest:0"));
    }

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
            'accessibility' => 'locations',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Tower Of Hera - Big Key Chest", false, []],
            ["Tower Of Hera - Big Key Chest", false, ['Lamp', 'MoonPearl', 'OcarinaActive', 'Hookshot', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", false, ['Lamp', 'Hammer', 'OcarinaActive', 'Hookshot']],
            ["Tower Of Hera - Big Key Chest", false, ['Lamp', 'Hammer', 'MoonPearl', 'OcarinaActive', 'Hookshot']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'OcarinaActive', 'Hookshot', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'ProgressiveGlove', 'Hookshot', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'PowerGlove', 'Hookshot', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Hammer', 'MoonPearl', 'TitansMitt', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'AgahnimDefeated', 'Hookshot', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'ProgressiveGlove', 'Hookshot', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'PowerGlove', 'Hookshot', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Hammer', 'MoonPearl', 'OcarinaInactive', 'TitansMitt', 'KeyP3']],

            ["Tower Of Hera - Basement Cage", false, []],
            ["Tower Of Hera - Basement Cage", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['PowerGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['TitansMitt', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer']],

            ["Tower Of Hera - Map Chest", false, []],
            ["Tower Of Hera - Map Chest", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['PowerGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['TitansMitt', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer']],

            ["Tower Of Hera - Compass Chest", false, []],
            ["Tower Of Hera - Compass Chest", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Compass Chest", true, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['PowerGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['TitansMitt', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],

            ["Tower Of Hera - Big Chest", false, []],
            ["Tower Of Hera - Big Chest", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Big Chest", true, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['PowerGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['TitansMitt', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],

            ["Tower Of Hera - Boss", false, []],
            ["Tower Of Hera - Boss", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Boss", false, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['PowerGlove', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['TitansMitt', 'OcarinaInactive', 'Hookshot', 'MoonPearl', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['PowerGlove', 'MoonPearl', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['TitansMitt', 'MoonPearl', 'Lamp', 'Hammer', 'BigKeyP3']],
        ];
    }
}
