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
final class TowerOfHeraTest extends TestCase
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
            ["Tower Of Hera - Big Key Chest", false, []],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'OcarinaActive', 'MagicMirror', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'ProgressiveGlove', 'MagicMirror', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'PowerGlove', 'MagicMirror', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'TitansMitt', 'MagicMirror', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'OcarinaActive', 'Hookshot', 'Hammer', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'ProgressiveGlove', 'Hookshot', 'Hammer', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'PowerGlove', 'Hookshot', 'Hammer', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'TitansMitt', 'Hookshot', 'Hammer', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'OcarinaActive', 'MagicMirror', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'OcarinaActive', 'Hookshot', 'Hammer', 'KeyP3']],

            ["Tower Of Hera - Basement Cage", false, []],
            ["Tower Of Hera - Basement Cage", true, ['OcarinaActive', 'MagicMirror']],
            ["Tower Of Hera - Basement Cage", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Tower Of Hera - Basement Cage", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
            ["Tower Of Hera - Basement Cage", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
            ["Tower Of Hera - Basement Cage", true, ['OcarinaActive', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Basement Cage", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer']],

            ["Tower Of Hera - Map Chest", false, []],
            ["Tower Of Hera - Map Chest", true, ['OcarinaActive', 'MagicMirror']],
            ["Tower Of Hera - Map Chest", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Tower Of Hera - Map Chest", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
            ["Tower Of Hera - Map Chest", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
            ["Tower Of Hera - Map Chest", true, ['OcarinaActive', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer']],
            ["Tower Of Hera - Map Chest", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer']],

            ["Tower Of Hera - Compass Chest", false, []],
            ["Tower Of Hera - Compass Chest", true, ['OcarinaActive', 'MagicMirror', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['OcarinaActive', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],

            ["Tower Of Hera - Big Chest", false, []],
            ["Tower Of Hera - Big Chest", true, ['OcarinaActive', 'MagicMirror', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['OcarinaActive', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],

            ["Tower Of Hera - Boss", false, []],
            ["Tower Of Hera - Boss", true, ['OcarinaActive', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
            ["Tower Of Hera - Boss", true, ['OcarinaActive', 'MagicMirror', 'BigKeyP3', 'UncleSword']],
            ["Tower Of Hera - Boss", true, ['OcarinaActive', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
            ["Tower Of Hera - Boss", true, ['OcarinaActive', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
            ["Tower Of Hera - Boss", true, ['OcarinaActive', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'UncleSword']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
            ["Tower Of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'UncleSword']],
            ["Tower Of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
            ["Tower Of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
            ["Tower Of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
            ["Tower Of Hera - Boss", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
            ["Tower Of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'UncleSword']],
            ["Tower Of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'MasterSword']],
            ["Tower Of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'ProgressiveSword']],
            ["Tower Of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L3Sword']],
            ["Tower Of Hera - Boss", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BigKeyP3', 'L4Sword']],
            ["Tower Of Hera - Boss", true, ['OcarinaActive', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['PowerGlove', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'BigKeyP3']],
        ];
    }
}
