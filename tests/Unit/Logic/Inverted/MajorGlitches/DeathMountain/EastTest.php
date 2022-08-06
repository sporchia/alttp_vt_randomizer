<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\MajorGlitches\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group MajorGlitches
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
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Spiral Cave", false, []],
            ["Spiral Cave", true, ['MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'TitansMitt', 'Lamp', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'TitansMitt', 'PegasusBoots', 'UncleSword']],
            ["Spiral Cave", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Far Left", false, []],
            ["Paradox Cave Lower - Far Left", true, ['MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['BottleWithFairy']],
            ["Paradox Cave Lower - Far Left", true, ['BottleWithRedPotion']],
            ["Paradox Cave Lower - Far Left", true, ['BottleWithGreenPotion']],
            ["Paradox Cave Lower - Far Left", true, ['BottleWithBluePotion']],
            ["Paradox Cave Lower - Far Left", true, ['Bottle']],
            ["Paradox Cave Lower - Far Left", true, ['BottleWithGoldBee']],

            ["Paradox Cave Lower - Left", false, []],
            ["Paradox Cave Lower - Left", true, ['MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['BottleWithBee']],
            ["Paradox Cave Lower - Left", true, ['BottleWithFairy']],
            ["Paradox Cave Lower - Left", true, ['BottleWithRedPotion']],
            ["Paradox Cave Lower - Left", true, ['BottleWithGreenPotion']],
            ["Paradox Cave Lower - Left", true, ['BottleWithBluePotion']],
            ["Paradox Cave Lower - Left", true, ['Bottle']],
            ["Paradox Cave Lower - Left", true, ['BottleWithGoldBee']],

            ["Paradox Cave Lower - Middle", false, []],
            ["Paradox Cave Lower - Middle", true, ['MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['BottleWithBee']],
            ["Paradox Cave Lower - Middle", true, ['BottleWithFairy']],
            ["Paradox Cave Lower - Middle", true, ['BottleWithRedPotion']],
            ["Paradox Cave Lower - Middle", true, ['BottleWithGreenPotion']],
            ["Paradox Cave Lower - Middle", true, ['BottleWithBluePotion']],
            ["Paradox Cave Lower - Middle", true, ['Bottle']],
            ["Paradox Cave Lower - Middle", true, ['BottleWithGoldBee']],

            ["Paradox Cave Lower - Right", false, []],
            ["Paradox Cave Lower - Right", true, ['MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['BottleWithBee']],
            ["Paradox Cave Lower - Right", true, ['BottleWithFairy']],
            ["Paradox Cave Lower - Right", true, ['BottleWithRedPotion']],
            ["Paradox Cave Lower - Right", true, ['BottleWithGreenPotion']],
            ["Paradox Cave Lower - Right", true, ['BottleWithBluePotion']],
            ["Paradox Cave Lower - Right", true, ['Bottle']],
            ["Paradox Cave Lower - Right", true, ['BottleWithGoldBee']],

            ["Paradox Cave Lower - Far Right", false, []],
            ["Paradox Cave Lower - Far Right", true, ['MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['BottleWithBee']],
            ["Paradox Cave Lower - Far Right", true, ['BottleWithFairy']],
            ["Paradox Cave Lower - Far Right", true, ['BottleWithRedPotion']],
            ["Paradox Cave Lower - Far Right", true, ['BottleWithGreenPotion']],
            ["Paradox Cave Lower - Far Right", true, ['BottleWithBluePotion']],
            ["Paradox Cave Lower - Far Right", true, ['Bottle']],
            ["Paradox Cave Lower - Far Right", true, ['BottleWithGoldBee']],

            ["Paradox Cave Upper - Left", false, []],
            ["Paradox Cave Upper - Left", true, ['MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['BottleWithBee']],
            ["Paradox Cave Upper - Left", true, ['BottleWithFairy']],
            ["Paradox Cave Upper - Left", true, ['BottleWithRedPotion']],
            ["Paradox Cave Upper - Left", true, ['BottleWithGreenPotion']],
            ["Paradox Cave Upper - Left", true, ['BottleWithBluePotion']],
            ["Paradox Cave Upper - Left", true, ['Bottle']],
            ["Paradox Cave Upper - Left", true, ['BottleWithGoldBee']],

            ["Paradox Cave Upper - Right", false, []],
            ["Paradox Cave Upper - Right", true, ['MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['BottleWithBee']],
            ["Paradox Cave Upper - Right", true, ['BottleWithFairy']],
            ["Paradox Cave Upper - Right", true, ['BottleWithRedPotion']],
            ["Paradox Cave Upper - Right", true, ['BottleWithGreenPotion']],
            ["Paradox Cave Upper - Right", true, ['BottleWithBluePotion']],
            ["Paradox Cave Upper - Right", true, ['Bottle']],
            ["Paradox Cave Upper - Right", true, ['BottleWithGoldBee']],

            ["Mimic Cave", false, []],
            ["Mimic Cave", true, ['MoonPearl', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithBee', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithFairy', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithRedPotion', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithGreenPotion', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithBluePotion', 'Hammer']],
            ["Mimic Cave", true, ['Bottle', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithGoldBee', 'Hammer']],

            ["Ether Tablet", false, []],
            ["Ether Tablet", true, ['BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L4Sword']],

            ["Spectacle Rock", true, []],
        ];
    }
}
