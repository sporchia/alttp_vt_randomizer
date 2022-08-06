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
final class EastTest extends TestCase
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

    /**
     * @param string $location
     * @param bool $access
     * @param string $medallion
     * @param array $items
     *
     * @dataProvider accessPoolWithMedallion
     */
    public function testLocationWithMedallion(string $location, bool $access, string $medallion, array $items)
    {
        $randomizer = new Randomizer([[
            'mode.state' => 'open',
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_merge(["TurtleRockEntry$medallion:0"], array_map(fn ($i) => "$i:0", $items)));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    /**
     * @todo are these tests correct? I don't think so...
     */
    public function accessPoolWithMedallion(): array
    {
        return [
            ["Mimic Cave", false, 'Quake', []],
            ["Mimic Cave", false, 'Quake', ['Quake']],
            ["Mimic Cave", false, 'Quake', ['Gloves', 'OcarinaActive']],
            ["Mimic Cave", false, 'Quake', ['Hammer']],
            ["Mimic Cave", false, 'Quake', ['MagicMirror']],
            ["Mimic Cave", false, 'Quake', ['MoonPearl']],
            ["Mimic Cave", false, 'Quake', ['CaneOfSomaria']],
            ["Mimic Cave", false, 'Ether', []],
            ["Mimic Cave", false, 'Ether', ['Ether']],
            ["Mimic Cave", false, 'Ether', ['Gloves', 'OcarinaActive']],
            ["Mimic Cave", false, 'Ether', ['Hammer']],
            ["Mimic Cave", false, 'Ether', ['MagicMirror']],
            ["Mimic Cave", false, 'Ether', ['MoonPearl']],
            ["Mimic Cave", false, 'Ether', ['CaneOfSomaria']],
            ["Mimic Cave", false, 'Bombos', []],
            ["Mimic Cave", false, 'Bombos', ['Bombos']],
            ["Mimic Cave", false, 'Bombos', ['Gloves', 'OcarinaActive']],
            ["Mimic Cave", false, 'Bombos', ['Hammer']],
            ["Mimic Cave", false, 'Bombos', ['MagicMirror']],
            ["Mimic Cave", false, 'Bombos', ['MoonPearl']],
            ["Mimic Cave", false, 'Bombos', ['CaneOfSomaria']],
        ];
    }

    public function accessPool(): array
    {
        return [
            ["Spiral Cave", false, []],
            ["Spiral Cave", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Spiral Cave", false, ['ProgressiveGlove', 'Hookshot']],
            ["Spiral Cave", false, ['OcarinaActive', 'MagicMirror']],
            ["Spiral Cave", false, ['OcarinaActive', 'Hammer']],
            ["Spiral Cave", true, ['OcarinaActive', 'Hookshot']],
            ["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Spiral Cave", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Spiral Cave", true, ['TitansMitt', 'Lamp', 'Hookshot']],
            ["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Spiral Cave", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Spiral Cave", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Spiral Cave", true, ['OcarinaActive', 'MagicMirror', 'Hammer']],

            ["Paradox Cave Lower - Far Left", false, []],
            ["Paradox Cave Lower - Far Left", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Paradox Cave Lower - Far Left", false, ['ProgressiveGlove', 'Hookshot']],
            ["Paradox Cave Lower - Far Left", false, ['OcarinaActive', 'MagicMirror']],
            ["Paradox Cave Lower - Far Left", false, ['OcarinaActive', 'Hammer']],
            ["Paradox Cave Lower - Far Left", true, ['OcarinaActive', 'Hookshot']],
            ["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Far Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Far Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Far Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Far Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Far Left", true, ['OcarinaActive', 'MagicMirror', 'Hammer']],

            ["Paradox Cave Lower - Left", false, []],
            ["Paradox Cave Lower - Left", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Paradox Cave Lower - Left", false, ['ProgressiveGlove', 'Hookshot']],
            ["Paradox Cave Lower - Left", false, ['OcarinaActive', 'MagicMirror']],
            ["Paradox Cave Lower - Left", false, ['OcarinaActive', 'Hammer']],
            ["Paradox Cave Lower - Left", true, ['OcarinaActive', 'Hookshot']],
            ["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Left", true, ['OcarinaActive', 'MagicMirror', 'Hammer']],

            ["Paradox Cave Lower - Middle", false, []],
            ["Paradox Cave Lower - Middle", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Paradox Cave Lower - Middle", false, ['ProgressiveGlove', 'Hookshot']],
            ["Paradox Cave Lower - Middle", false, ['OcarinaActive', 'MagicMirror']],
            ["Paradox Cave Lower - Middle", false, ['OcarinaActive', 'Hammer']],
            ["Paradox Cave Lower - Middle", true, ['OcarinaActive', 'Hookshot']],
            ["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Middle", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Middle", true, ['TitansMitt', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Middle", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Middle", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Middle", true, ['OcarinaActive', 'MagicMirror', 'Hammer']],

            ["Paradox Cave Lower - Right", false, []],
            ["Paradox Cave Lower - Right", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Paradox Cave Lower - Right", false, ['ProgressiveGlove', 'Hookshot']],
            ["Paradox Cave Lower - Right", false, ['OcarinaActive', 'MagicMirror']],
            ["Paradox Cave Lower - Right", false, ['OcarinaActive', 'Hammer']],
            ["Paradox Cave Lower - Right", true, ['OcarinaActive', 'Hookshot']],
            ["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Right", true, ['OcarinaActive', 'MagicMirror', 'Hammer']],

            ["Paradox Cave Lower - Far Right", false, []],
            ["Paradox Cave Lower - Far Right", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Paradox Cave Lower - Far Right", false, ['ProgressiveGlove', 'Hookshot']],
            ["Paradox Cave Lower - Far Right", false, ['OcarinaActive', 'MagicMirror']],
            ["Paradox Cave Lower - Far Right", false, ['OcarinaActive', 'Hammer']],
            ["Paradox Cave Lower - Far Right", true, ['OcarinaActive', 'Hookshot']],
            ["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Far Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Far Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
            ["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Far Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Far Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Lower - Far Right", true, ['OcarinaActive', 'MagicMirror', 'Hammer']],

            ["Paradox Cave Upper - Left", false, []],
            ["Paradox Cave Upper - Left", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Paradox Cave Upper - Left", false, ['ProgressiveGlove', 'Hookshot']],
            ["Paradox Cave Upper - Left", false, ['OcarinaActive', 'MagicMirror']],
            ["Paradox Cave Upper - Left", false, ['OcarinaActive', 'Hammer']],
            ["Paradox Cave Upper - Left", true, ['OcarinaActive', 'Hookshot']],
            ["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Upper - Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Upper - Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
            ["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Upper - Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Upper - Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Upper - Left", true, ['OcarinaActive', 'MagicMirror', 'Hammer']],

            ["Paradox Cave Upper - Right", false, []],
            ["Paradox Cave Upper - Right", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Paradox Cave Upper - Right", false, ['ProgressiveGlove', 'Hookshot']],
            ["Paradox Cave Upper - Right", false, ['OcarinaActive', 'MagicMirror']],
            ["Paradox Cave Upper - Right", false, ['OcarinaActive', 'Hammer']],
            ["Paradox Cave Upper - Right", true, ['OcarinaActive', 'Hookshot']],
            ["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Upper - Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Paradox Cave Upper - Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
            ["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Upper - Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Upper - Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Paradox Cave Upper - Right", true, ['OcarinaActive', 'MagicMirror', 'Hammer']],

            ["Floating Island", false, []],
            ["Floating Island", false, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
            ["Floating Island", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
        ];
    }
}
