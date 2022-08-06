<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
 */
final class NorthEastTest extends TestCase
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
            ["Catfish", false, []],
            ["Catfish", true, ['MoonPearl']],
            ["Catfish", true, ['BottleWithBee']],
            ["Catfish", true, ['BottleWithFairy']],
            ["Catfish", true, ['BottleWithRedPotion']],
            ["Catfish", true, ['BottleWithGreenPotion']],
            ["Catfish", true, ['BottleWithBluePotion']],
            ["Catfish", true, ['Bottle']],
            ["Catfish", true, ['BottleWithGoldBee']],

            ["Pyramid", true, []],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", true, ['MagicMirror']],
            ["Pyramid Fairy - Left", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['Crystal5', 'Crystal6', 'BottleWithBee']],
            ["Pyramid Fairy - Left", true, ['Crystal5', 'Crystal6', 'BottleWithFairy']],
            ["Pyramid Fairy - Left", true, ['Crystal5', 'Crystal6', 'BottleWithRedPotion']],
            ["Pyramid Fairy - Left", true, ['Crystal5', 'Crystal6', 'BottleWithGreenPotion']],
            ["Pyramid Fairy - Left", true, ['Crystal5', 'Crystal6', 'BottleWithBluePotion']],
            ["Pyramid Fairy - Left", true, ['Crystal5', 'Crystal6', 'Bottle']],
            ["Pyramid Fairy - Left", true, ['Crystal5', 'Crystal6', 'BottleWithGoldBee']],

            ["Pyramid Fairy - Right", false, []],
            ["Pyramid Fairy - Right", true, ['MagicMirror']],
            ["Pyramid Fairy - Right", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['Crystal5', 'Crystal6', 'BottleWithBee']],
            ["Pyramid Fairy - Right", true, ['Crystal5', 'Crystal6', 'BottleWithFairy']],
            ["Pyramid Fairy - Right", true, ['Crystal5', 'Crystal6', 'BottleWithRedPotion']],
            ["Pyramid Fairy - Right", true, ['Crystal5', 'Crystal6', 'BottleWithGreenPotion']],
            ["Pyramid Fairy - Right", true, ['Crystal5', 'Crystal6', 'BottleWithBluePotion']],
            ["Pyramid Fairy - Right", true, ['Crystal5', 'Crystal6', 'Bottle']],
            ["Pyramid Fairy - Right", true, ['Crystal5', 'Crystal6', 'BottleWithGoldBee']],

            ["Ganon", false, []],
        ];
    }
}
