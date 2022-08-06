<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group OverworldGlitches
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
            'mode.state' => 'inverted',
            'difficulty' => 'test_rules',
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Master Sword Pedestal", false, []],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'MoonPearl', 'PegasusBoots']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'MagicMirror', 'PegasusBoots']],

            ["Link's Uncle", false, []],
            ["Link's Uncle", true, ['MoonPearl', 'PegasusBoots']],

            ["Secret Passage", false, []],
            ["Secret Passage", true, ['MoonPearl', 'PegasusBoots']],

            ["King's Tomb", false, []],
            ["King's Tomb", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Floodgate Chest", false, []],
            ["Floodgate Chest", true, ['MoonPearl', 'PegasusBoots']],
            ["Floodgate Chest", true, ['MagicMirror', 'PegasusBoots']],

            ["Kakariko Tavern", false, []],
            ["Kakariko Tavern", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Tavern", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Tavern", true, ['DefeatAgahnim']],

            ["Chicken House", false, []],
            ["Chicken House", true, ['MoonPearl', 'PegasusBoots']],

            ["Aginah's Cave", false, []],
            ["Aginah's Cave", true, ['MoonPearl', 'PegasusBoots']],

            ["Sahasrahla's Hut - Left", false, []],
            ["Sahasrahla's Hut - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Sahasrahla's Hut - Left", true, ['MagicMirror', 'PegasusBoots']],
            ["Sahasrahla's Hut - Left", true, ['DefeatAgahnim', 'PegasusBoots']],

            ["Sahasrahla's Hut - Middle", false, []],
            ["Sahasrahla's Hut - Middle", true, ['MoonPearl', 'PegasusBoots']],
            ["Sahasrahla's Hut - Middle", true, ['MagicMirror', 'PegasusBoots']],
            ["Sahasrahla's Hut - Middle", true, ['DefeatAgahnim', 'PegasusBoots']],

            ["Sahasrahla's Hut - Right", false, []],
            ["Sahasrahla's Hut - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Sahasrahla's Hut - Right", true, ['MagicMirror', 'PegasusBoots']],
            ["Sahasrahla's Hut - Right", true, ['DefeatAgahnim', 'PegasusBoots']],

            ["Kakariko Well - Top", false, []],
            ["Kakariko Well - Top", true, ['MoonPearl', 'PegasusBoots']],

            ["Kakariko Well - Left", false, []],
            ["Kakariko Well - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Well - Left", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Well - Left", true, ['DefeatAgahnim']],

            ["Kakariko Well - Middle", false, []],
            ["Kakariko Well - Middle", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Well - Middle", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Well - Middle", true, ['DefeatAgahnim']],

            ["Kakariko Well - Right", false, []],
            ["Kakariko Well - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Well - Right", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Well - Right", true, ['DefeatAgahnim']],

            ["Kakariko Well - Bottom", false, []],
            ["Kakariko Well - Bottom", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Well - Bottom", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Well - Bottom", true, ['DefeatAgahnim']],

            ["Blind's Hideout - Top", false, []],
            ["Blind's Hideout - Top", true, ['MoonPearl', 'PegasusBoots']],

            ["Blind's Hideout - Left", false, []],
            ["Blind's Hideout - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Blind's Hideout - Left", true, ['MagicMirror', 'PegasusBoots']],
            ["Blind's Hideout - Left", true, ['MagicMirror', 'DefeatAgahnim']],

            ["Blind's Hideout - Right", false, []],
            ["Blind's Hideout - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Blind's Hideout - Right", true, ['MagicMirror', 'PegasusBoots']],
            ["Blind's Hideout - Right", true, ['MagicMirror', 'DefeatAgahnim']],

            ["Blind's Hideout - Far Left", false, []],
            ["Blind's Hideout - Far Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Blind's Hideout - Far Left", true, ['MagicMirror', 'PegasusBoots']],
            ["Blind's Hideout - Far Left", true, ['MagicMirror', 'DefeatAgahnim']],

            ["Blind's Hideout - Far Right", false, []],
            ["Blind's Hideout - Far Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Blind's Hideout - Far Right", true, ['MagicMirror', 'PegasusBoots']],
            ["Blind's Hideout - Far Right", true, ['MagicMirror', 'DefeatAgahnim']],

            ["Pegasus Rocks", false, []],
            ["Pegasus Rocks", true, ['MoonPearl', 'PegasusBoots']],

            ["Mini Moldorm Cave - Far Left", false, []],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Mini Moldorm Cave - Left", false, []],

            ["Mini Moldorm Cave - Right", false, []],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Mini Moldorm Cave - Far Right", false, []],

            ["Ice Rod Cave", false, []],
            ["Ice Rod Cave", true, ['MoonPearl', 'PegasusBoots']],
            ["Ice Rod Cave", true, ['MagicMirror', 'PegasusBoots', 'BigRedBomb']],
            ["Ice Rod Cave", true, ['MagicMirror', 'DefeatAgahnim', 'BigRedBomb']],

            ["Bottle Merchant", false, []],
            ["Bottle Merchant", true, ['PegasusBoots', 'MagicMirror']],
            ["Bottle Merchant", true, ['MoonPearl', 'PegasusBoots']],

            ["Sahasrahla's Hut - Sahasrahla", false, []],
            ["Sahasrahla's Hut - Sahasrahla", true, ['PendantOfCourage', 'MagicMirror', 'PegasusBoots']],
            ["Sahasrahla's Hut - Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'PegasusBoots']],

            ["Magic Bat", false, []],
            ["Magic Bat", true, ['Powder', 'PegasusBoots', 'MoonPearl']],

            ["Sick Kid", false, []],
            ["Sick Kid", false, ['BottleWithBee']],
            ["Sick Kid", false, ['BottleWithFairy']],
            ["Sick Kid", false, ['BottleWithRedPotion']],
            ["Sick Kid", false, ['BottleWithGreenPotion']],
            ["Sick Kid", false, ['BottleWithBluePotion']],
            ["Sick Kid", false, ['Bottle']],
            ["Sick Kid", false, ['BottleWithGoldBee']],
            ["Sick Kid", true, ['BottleWithBee', 'MagicMirror', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithFairy', 'MagicMirror', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MagicMirror', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MagicMirror', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MagicMirror', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'PegasusBoots']],
            ["Sick Kid", true, ['Bottle', 'MagicMirror', 'PegasusBoots']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MagicMirror', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'PegasusBoots']],

            ["Hobo", false, []],
            ["Hobo", true, ['MoonPearl', 'PegasusBoots']],
            ["Hobo", true, ['MoonPearl', 'DefeatAgahnim']],

            ["Bombos Tablet", false, []],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PegasusBoots', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PegasusBoots', 'L2Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PegasusBoots', 'L3Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PegasusBoots', 'L4Sword']],
            ["Bombos Tablet", true, ['MagicMirror', 'BookOfMudora', 'PegasusBoots', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['MagicMirror', 'BookOfMudora', 'PegasusBoots', 'L2Sword']],
            ["Bombos Tablet", true, ['MagicMirror', 'BookOfMudora', 'PegasusBoots', 'L3Sword']],
            ["Bombos Tablet", true, ['MagicMirror', 'BookOfMudora', 'PegasusBoots', 'L4Sword']],

            ["King Zora", false, []],
            ["King Zora", true, ['MoonPearl', 'PegasusBoots']],

            ["Lost Woods Hideout", false, []],
            ["Lost Woods Hideout", true, ['MoonPearl', 'PegasusBoots']],

            ["Lumberjack Tree", false, []],
            ["Lumberjack Tree", true, ['PegasusBoots', 'MoonPearl', 'DefeatAgahnim']],

            ["Cave 45", false, []],
            ["Cave 45", true, ['MoonPearl',  'PegasusBoots']],
            ["Cave 45", true, ['MagicMirror',  'PegasusBoots']],
            ["Cave 45", true, ['MagicMirror',  'DefeatAgahnim']],

            ["Graveyard Ledge", false, []],
            ["Graveyard Ledge", true, ['MoonPearl', 'PegasusBoots']],

            ["Checkerboard Cave", false, []],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'PegasusBoots', 'MoonPearl']],
            ["Checkerboard Cave", true, ['PowerGlove', 'PegasusBoots', 'MoonPearl']],

            ["Mini Moldorm Cave - NPC", false, []],
            ["Mini Moldorm Cave - NPC", true, ['MoonPearl', 'PegasusBoots']],

            ["Library", false, []],
            ["Library", true, ['PegasusBoots', 'MoonPearl']],
            ["Library", true, ['PegasusBoots', 'MagicMirror']],

            ["Mushroom", false, []],
            ["Mushroom", true, ['MoonPearl', 'PegasusBoots']],

            ["Potion Shop", false, []],
            ["Potion Shop", true, ['Mushroom', 'MoonPearl', 'PegasusBoots']],

            ["Maze Race", false, []],
            ["Maze Race", true, ['MoonPearl', 'PegasusBoots']],

            ["Desert Ledge", false, []],
            ["Desert Ledge", true, ['BookOfMudora', 'MagicMirror', 'PegasusBoots']],
            ["Desert Ledge", true, ['BookOfMudora', 'DefeatAgahnim']],
            ["Desert Ledge", true, ['MoonPearl', 'PegasusBoots']],

            ["Lake Hylia Island", false, []],
            ["Lake Hylia Island", true, ['MoonPearl', 'PegasusBoots']],

            ["Sunken Treasure", false, []],
            ["Sunken Treasure", true, ['MoonPearl', 'PegasusBoots']],
            ["Sunken Treasure", true, ['MagicMirror', 'PegasusBoots']],
            ["Sunken Treasure", true, ['MagicMirror', 'DefeatAgahnim']],

            ["Zora's Domain Ledge Item", false, []],
            ["Zora's Domain Ledge Item", true, ['MoonPearl', 'PegasusBoots']],

            ["Flute Spot", false, []],
            ["Flute Spot", true, ['Shovel', 'MoonPearl', 'PegasusBoots']],

            ["Waterfall Fairy - Left", false, []],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'TitansMitt']],

            ["Waterfall Fairy - Right", false, []],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'TitansMitt']],

            ["Bomb Shoppe Item", false, []],
            ["Bomb Shoppe Item", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'PegasusBoots']],
            ["Bomb Shoppe Item", true, ['Crystal5', 'Crystal6', 'MagicMirror', 'PegasusBoots']],
            ["Bomb Shoppe Item", true, ['Crystal5', 'Crystal6', 'DefeatAgahnim']],

            ["Ganon", false, []],
        ];
    }
}
