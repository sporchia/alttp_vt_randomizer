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
final class NorthWestTest extends TestCase
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
        $this->markTestSkipped();
        $randomizer = new Randomizer([[
            'mode.state' => 'standard',
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Brewery", false, []],
            ["Brewery", true, ['MoonPearl']],
            ["Brewery", true, ['BottleWithBee']],
            ["Brewery", true, ['BottleWithFairy']],
            ["Brewery", true, ['BottleWithRedPotion']],
            ["Brewery", true, ['BottleWithGreenPotion']],
            ["Brewery", true, ['BottleWithBluePotion']],
            ["Brewery", true, ['Bottle']],
            ["Brewery", true, ['BottleWithGoldBee']],

            ["C-Shaped House", true, []],

            ["Chest Game", true, []],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", true, ['MoonPearl', 'Hammer']],
            ["Hammer Pegs", true, ['BottleWithBee', 'Hammer']],
            ["Hammer Pegs", true, ['BottleWithFairy', 'Hammer']],
            ["Hammer Pegs", true, ['BottleWithRedPotion', 'Hammer']],
            ["Hammer Pegs", true, ['BottleWithGreenPotion', 'Hammer']],
            ["Hammer Pegs", true, ['BottleWithBluePotion', 'Hammer']],
            ["Hammer Pegs", true, ['Bottle', 'Hammer']],
            ["Hammer Pegs", true, ['BottleWithGoldBee', 'Hammer']],

            ["Bumper Cave", true, []],

            ["Blacksmith", false, []],
            ["Blacksmith", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blacksmith", true, ['BottleWithBee']],
            ["Blacksmith", true, ['BottleWithFairy']],
            ["Blacksmith", true, ['BottleWithRedPotion']],
            ["Blacksmith", true, ['BottleWithGreenPotion']],
            ["Blacksmith", true, ['BottleWithFairy']],
            ["Blacksmith", true, ['BottleWithBluePotion']],
            ["Blacksmith", true, ['Bottle']],
            ["Blacksmith", true, ['BottleWithGoldBee']],

            ["Purple Chest", false, []],
            ["Purple Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Purple Chest", true, ['BottleWithBee']],
            ["Purple Chest", true, ['BottleWithFairy']],
            ["Purple Chest", true, ['BottleWithRedPotion']],
            ["Purple Chest", true, ['BottleWithGreenPotion']],
            ["Purple Chest", true, ['BottleWithFairy']],
            ["Purple Chest", true, ['BottleWithBluePotion']],
            ["Purple Chest", true, ['Bottle']],
            ["Purple Chest", true, ['BottleWithGoldBee']],
        ];
    }
}
