<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\NoGlitches\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
 * @group NoGlitches
 */
final class WestTest extends TestCase
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
            ["Ether Tablet", false, []],
            ["Ether Tablet", true, ['OcarinaActive', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['OcarinaActive', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['OcarinaActive', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['OcarinaActive', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['OcarinaActive', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['OcarinaActive', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['OcarinaActive', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['OcarinaActive', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],

            ["Old Man", false, []],
            ["Old Man", true, ['OcarinaActive', 'Lamp']],
            ["Old Man", true, ['ProgressiveGlove', 'Lamp']],
            ["Old Man", true, ['PowerGlove', 'Lamp']],
            ["Old Man", true, ['TitansMitt', 'Lamp']],

            ["Spectacle Rock Cave", false, []],
            ["Spectacle Rock Cave", true, ['OcarinaActive']],
            ["Spectacle Rock Cave", true, ['ProgressiveGlove', 'Lamp']],
            ["Spectacle Rock Cave", true, ['PowerGlove', 'Lamp']],
            ["Spectacle Rock Cave", true, ['TitansMitt', 'Lamp']],

            ["Spectacle Rock", false, []],
            ["Spectacle Rock", true, ['OcarinaActive', 'MagicMirror']],
            ["Spectacle Rock", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Spectacle Rock", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
            ["Spectacle Rock", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
        ];
    }
}
