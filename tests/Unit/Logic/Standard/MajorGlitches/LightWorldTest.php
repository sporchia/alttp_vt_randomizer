<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
 */
final class LightWorldTest extends TestCase
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
            ["Master Sword Pedestal", false, []],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower']],

            ["Link's Uncle", true, []],

            ["Secret Passage", true, ['UncleSword']],

            ["King's Tomb", false, []],
            ["King's Tomb", true, ['PegasusBoots']],

            ["Floodgate Chest", true, []],

            ["Link's House", true, []],

            ["Kakariko Tavern", true, []],

            ["Chicken House", true, []],

            ["Aginah's Cave", true, []],

            ["Sahasrahla's Hut - Left", true, []],

            ["Sahasrahla's Hut - Middle", true, []],

            ["Sahasrahla's Hut - Right", true, []],

            ["Kakariko Well - Top", true, []],

            ["Kakariko Well - Left", true, []],

            ["Kakariko Well - Middle", true, []],

            ["Kakariko Well - Right", true, []],

            ["Kakariko Well - Bottom", true, []],

            ["Blind's Hideout - Top", true, []],

            ["Blind's Hideout - Left", true, []],

            ["Blind's Hideout - Right", true, []],

            ["Blind's Hideout - Far Left", true, []],

            ["Blind's Hideout - Far Right", true, []],

            ["Pegasus Rocks", false, []],
            ["Pegasus Rocks", true, ['PegasusBoots']],

            ["Mini Moldorm Cave - Far Left", true, []],

            ["Mini Moldorm Cave - Left", true, []],

            ["Mini Moldorm Cave - Right", true, []],

            ["Mini Moldorm Cave - Far Right", true, []],

            ["Ice Rod Cave", true, []],

            ["Bottle Merchant", true, []],

            ["Sahasrahla's Hut - Sahasrahla", false, []],
            ["Sahasrahla's Hut - Sahasrahla", true, ['PendantOfCourage']],

            ["Magic Bat", false, []],
            ["Magic Bat", true, ['Powder']],

            ["Sick Kid", false, []],
            ["Sick Kid", true, ['BottleWithBee']],
            ["Sick Kid", true, ['BottleWithFairy']],
            ["Sick Kid", true, ['BottleWithRedPotion']],
            ["Sick Kid", true, ['BottleWithGreenPotion']],
            ["Sick Kid", true, ['BottleWithBluePotion']],
            ["Sick Kid", true, ['Bottle']],
            ["Sick Kid", true, ['BottleWithGoldBee']],

            ["Hobo", true, []],

            ["Bombos Tablet", false, []],
            ["Bombos Tablet", true, ['BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L2Sword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L3Sword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L4Sword']],

            ["King Zora", true, []],

            ["Lost Woods Hideout", true, []],

            ["Lumberjack Tree", false, []],
            ["Lumberjack Tree", true, ['PegasusBoots', 'DefeatAgahnim']],

            ["Cave 45", true, []],

            ["Graveyard Ledge", true, []],

            ["Checkerboard Cave", false, []],
            ["Checkerboard Cave", true, ['ProgressiveGlove']],
            ["Checkerboard Cave", true, ['PowerGlove']],
            ["Checkerboard Cave", true, ['TitansMitt']],

            ["Mini Moldorm Cave - NPC", true, []],

            ["Library", false, []],
            ["Library", true, ['PegasusBoots']],

            ["Mushroom", true, []],

            ["Potion Shop", false, []],
            ["Potion Shop", true, ['Mushroom']],

            ["Maze Race", true, []],

            ["Desert Ledge", true, []],

            ["Lake Hylia Island", true, []],

            ["Sunken Treasure", true, []],

            ["Zora's Domain Ledge Item", false, []],
            ["Zora's Domain Ledge Item", true, ['Flippers']],
            ["Zora's Domain Ledge Item", true, ['PegasusBoots']],

            ["Flute Spot", false, []],
            ["Flute Spot", true, ['Shovel']],

            ["Waterfall Fairy - Left", false, []],
            ["Waterfall Fairy - Left", true, ['Flippers']],
            ["Waterfall Fairy - Left", true, ['MoonPearl']],
            ["Waterfall Fairy - Left", true, ['PegasusBoots']],

            ["Waterfall Fairy - Right", false, []],
            ["Waterfall Fairy - Right", true, ['Flippers']],
            ["Waterfall Fairy - Right", true, ['MoonPearl']],
            ["Waterfall Fairy - Right", true, ['PegasusBoots']],
        ];
    }
}
