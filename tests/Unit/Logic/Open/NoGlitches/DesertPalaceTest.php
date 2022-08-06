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
final class DesertPalaceTest extends TestCase
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
            ["Desert Palace - Main Room - Center", false, []],
            ["Desert Palace - Main Room - Center", true, ['BookOfMudora']],
            ["Desert Palace - Main Room - Center", true, ['OcarinaActive', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Palace - Main Room - Center", true, ['OcarinaActive', 'MagicMirror', 'TitansMitt']],

            ["Desert Palace - Map Chest", false, []],
            ["Desert Palace - Map Chest", true, ['BookOfMudora']],
            ["Desert Palace - Map Chest", true, ['OcarinaActive', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Palace - Map Chest", true, ['OcarinaActive', 'MagicMirror', 'TitansMitt']],

            ["Desert Palace - Big Chest", false, []],
            ["Desert Palace - Big Chest", true, ['BookOfMudora', 'BigKeyP2']],
            ["Desert Palace - Big Chest", true, ['OcarinaActive', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Big Chest", true, ['OcarinaActive', 'MagicMirror', 'TitansMitt', 'BigKeyP2']],

            ["Desert Palace - Torch", false, []],
            ["Desert Palace - Torch", true, ['BookOfMudora', 'PegasusBoots']],
            ["Desert Palace - Torch", true, ['OcarinaActive', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots']],
            ["Desert Palace - Torch", true, ['OcarinaActive', 'MagicMirror', 'TitansMitt', 'PegasusBoots']],

            ["Desert Palace - Compass Chest", false, []],
            ["Desert Palace - Compass Chest", true, ['BookOfMudora', 'KeyP2']],
            ["Desert Palace - Compass Chest", true, ['OcarinaActive', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP2']],
            ["Desert Palace - Compass Chest", true, ['OcarinaActive', 'MagicMirror', 'TitansMitt', 'KeyP2']],

            ["Desert Palace - Big Key Chest", false, []],
            ["Desert Palace - Big Key Chest", true, ['BookOfMudora', 'KeyP2']],
            ["Desert Palace - Big Key Chest", true, ['OcarinaActive', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP2']],
            ["Desert Palace - Big Key Chest", true, ['OcarinaActive', 'MagicMirror', 'TitansMitt', 'KeyP2']],

            ["Desert Palace - Boss", false, []],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'Lamp', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'Lamp', 'PowerGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'Lamp', 'TitansMitt', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'FireRod', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'FireRod', 'PowerGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'BookOfMudora', 'FireRod', 'TitansMitt', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'OcarinaActive', 'MagicMirror', 'Lamp', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'OcarinaActive', 'MagicMirror', 'Lamp', 'TitansMitt', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'OcarinaActive', 'MagicMirror', 'FireRod', 'ProgressiveGlove', 'ProgressiveGlove', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'KeyP2', 'OcarinaActive', 'MagicMirror', 'FireRod', 'TitansMitt', 'BigKeyP2']],
        ];
    }
}
