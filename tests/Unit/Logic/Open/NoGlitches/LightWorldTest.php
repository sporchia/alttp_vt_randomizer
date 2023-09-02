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
            'mode.state' => 'open',
            'logic' => 'NoGlitches',
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

            ["King's Tomb Chest", false, []],
            ["King's Tomb Chest", true, ['PegasusBoots', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["King's Tomb Chest", true, ['PegasusBoots', 'TitansMitt']],
            ["King's Tomb Chest", true, ['PegasusBoots', 'ProgressiveGlove', 'Hammer', 'MoonPearl', 'MagicMirror']],
            ["King's Tomb Chest", true, ['PegasusBoots', 'PowerGlove', 'Hammer', 'MoonPearl', 'MagicMirror']],
            ["King's Tomb Chest", true, ['PegasusBoots', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'MoonPearl', 'MagicMirror']],
            ["King's Tomb Chest", true, ['PegasusBoots', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'MoonPearl', 'MagicMirror']],
            ["King's Tomb Chest", true, ['PegasusBoots', 'AgahnimDefeated', 'Hammer', 'Hookshot', 'MoonPearl', 'MagicMirror']],
            ["King's Tomb Chest", true, ['PegasusBoots', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'MoonPearl', 'MagicMirror']],

            ["Floodgate Chest", true, []],

            ["Link's House - Chest", true, []],

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
            ["Magic Bat", true, ['Powder', 'Hammer']],
            ["Magic Bat", true, ['Powder', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'MagicMirror']],
            ["Magic Bat", true, ['Powder', 'TitansMitt', 'MoonPearl', 'MagicMirror']],

            ["Sick Kid", false, []],
            ["Sick Kid", true, ['BottleWithBee']],
            ["Sick Kid", true, ['BottleWithFairy']],
            ["Sick Kid", true, ['BottleWithRedPotion']],
            ["Sick Kid", true, ['BottleWithGreenPotion']],
            ["Sick Kid", true, ['BottleWithBluePotion']],
            ["Sick Kid", true, ['Bottle']],
            ["Sick Kid", true, ['BottleWithGoldBee']],

            ["Hobo", false, []],
            ["Hobo", true, ['Flippers']],

            ["Bombos Tablet", false, []],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'TitansMitt']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'TitansMitt']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'TitansMitt']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'TitansMitt']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'ProgressiveGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'ProgressiveGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'ProgressiveGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'ProgressiveGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'PowerGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'PowerGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'PowerGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'PowerGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'AgahnimDefeated', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'AgahnimDefeated', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'AgahnimDefeated', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'AgahnimDefeated', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'AgahnimDefeated', 'Flippers', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'AgahnimDefeated', 'Flippers', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'AgahnimDefeated', 'Flippers', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["King Zora", false, []],
            ["King Zora", true, ['Flippers']],
            ["King Zora", true, ['ProgressiveGlove']],
            ["King Zora", true, ['PowerGlove']],
            ["King Zora", true, ['TitansMitt']],

            ["Lost Woods Hideout", true, []],

            ["Lumberjack Tree", false, []],
            ["Lumberjack Tree", true, ['PegasusBoots', 'AgahnimDefeated']],

            ["Cave 45", false, []],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'TitansMitt']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'AgahnimDefeated', 'Hammer']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Graveyard Cave Item", false, []],
            ["Graveyard Cave Item", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Graveyard Cave Item", true, ['MoonPearl', 'MagicMirror', 'TitansMitt']],
            ["Graveyard Cave Item", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
            ["Graveyard Cave Item", true, ['MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
            ["Graveyard Cave Item", true, ['MoonPearl', 'MagicMirror', 'AgahnimDefeated', 'Hammer', 'Hookshot']],
            ["Graveyard Cave Item", true, ['MoonPearl', 'MagicMirror', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Graveyard Cave Item", true, ['MoonPearl', 'MagicMirror', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Checkerboard Cave", false, []],
            ["Checkerboard Cave", true, ['OcarinaActive', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Checkerboard Cave", true, ['OcarinaActive', 'MagicMirror', 'TitansMitt']],

            ["Mini Moldorm Cave - NPC", true, []],

            ["Library", false, []],
            ["Library", true, ['PegasusBoots']],

            ["Mushroom", true, []],

            ["Potion Shop Item", false, []],
            ["Potion Shop Item", true, ['Mushroom']],

            ["Maze Race", true, []],

            ["Desert Ledge - Item", false, []],
            ["Desert Ledge - Item", true, ['BookOfMudora']],
            ["Desert Ledge - Item", true, ['OcarinaActive', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Ledge - Item", true, ['OcarinaActive', 'MagicMirror', 'TitansMitt']],

            ["Lake Hylia Island", false, []],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'TitansMitt']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'AgahnimDefeated']],

            ["Sunken Treasure", true, []],

            ["Zora's Domain Ledge Item", false, []],
            ["Zora's Domain Ledge Item", true, ['Flippers']],

            ["Flute Spot", false, []],
            ["Flute Spot", true, ['Shovel']],

            ["Waterfall Fairy - Left", false, []],
            ["Waterfall Fairy - Left", true, ['Flippers']],

            ["Waterfall Fairy - Right", false, []],
            ["Waterfall Fairy - Right", true, ['Flippers']],
        ];
    }
}
