<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
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
            'mode.state' => 'standard',
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
            ["Superbunny Cave - Top", true, []],

            ["Superbunny Cave - Bottom", true, []],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'MoonPearl']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'MoonPearl']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithBee']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithBee']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithFairy']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithFairy']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithRedPotion']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithRedPotion']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithBluePotion']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithBluePotion']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'Bottle']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'Bottle']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithGoldBee']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithGoldBee']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'MoonPearl']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithBee']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithFairy']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithRedPotion']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithBluePotion']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'Bottle']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithGoldBee']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'MoonPearl']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithBee']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithFairy']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithRedPotion']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithBluePotion']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'Bottle']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithGoldBee']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'MoonPearl']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithBee']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithFairy']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithRedPotion']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithBluePotion']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'Bottle']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithGoldBee']],
        ];
    }
}
