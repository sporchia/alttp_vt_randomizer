<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
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
            'mode.state' => 'inverted',
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Spiral Cave", false, []],
            ["Spiral Cave", false, ['ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Spiral Cave", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Spiral Cave", false, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Spiral Cave", false, ['OcarinaInactive', 'Hookshot', 'MoonPearl']],
            ["Spiral Cave", true, ['OcarinaInactive', 'Hookshot', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hookshot']],
            ["Spiral Cave", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hookshot']],
            ["Spiral Cave", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hookshot']],
            ["Spiral Cave", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Spiral Cave", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Spiral Cave", true, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Spiral Cave", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Paradox Cave Lower - Far Left", false, []],
            ["Paradox Cave Lower - Far Left", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", false, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Paradox Cave Lower - Left", false, []],
            ["Paradox Cave Lower - Left", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Left", false, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Paradox Cave Lower - Middle", false, []],
            ["Paradox Cave Lower - Middle", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", false, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Paradox Cave Lower - Right", false, []],
            ["Paradox Cave Lower - Right", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Right", false, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Paradox Cave Lower - Far Right", false, []],
            ["Paradox Cave Lower - Far Right", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", false, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Paradox Cave Upper - Left", false, []],
            ["Paradox Cave Upper - Left", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Left", false, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Paradox Cave Upper - Right", false, []],
            ["Paradox Cave Upper - Right", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Right", false, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['OcarinaInactive', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['OcarinaInactive', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['OcarinaInactive', 'TitansMitt', 'MoonPearl']],

            ["Mimic Cave", false, []],
            ["Mimic Cave", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Mimic Cave", true, ['OcarinaInactive', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Mimic Cave", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer']],
            ["Mimic Cave", true, ['OcarinaInactive', 'MoonPearl', 'TitansMitt', 'Hammer']],
            ["Mimic Cave", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot']],
            ["Mimic Cave", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot']],
            ["Mimic Cave", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer']],
            ["Mimic Cave", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer']],

            ["Ether Tablet", false, []],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'TitansMitt', 'Hammer', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'TitansMitt', 'Hammer', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'TitansMitt', 'Hammer', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['OcarinaInactive', 'MoonPearl', 'TitansMitt', 'Hammer', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L4Sword']],

            ["Spectacle Rock", false, []],
            ["Spectacle Rock", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Spectacle Rock", true, ['OcarinaInactive', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Spectacle Rock", true, ['OcarinaInactive', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock", true, ['OcarinaInactive', 'MoonPearl', 'TitansMitt', 'Hammer']],
            ["Spectacle Rock", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot']],
            ["Spectacle Rock", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot']],
            ["Spectacle Rock", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer']],
            ["Spectacle Rock", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer']],

        ];
    }
}
