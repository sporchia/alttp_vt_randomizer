<?php

namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class LightWorldTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
        $this->addCollected(['RescueZelda']);
        $this->collected->setChecksForWorld($this->world->id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    /**
     * @param string $location
     * @param bool $access
     * @param array $items
     * @param array $except
     *
     * @dataProvider accessPool
     */
    public function testLocation(string $location, bool $access, array $items, array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getLocation($location)
            ->canAccess($this->collected));
    }

    public function accessPool()
    {
        return [
            ["Master Sword Pedestal", false, []],
            ["Master Sword Pedestal", false, [], ['PendantOfCourage']],
            ["Master Sword Pedestal", false, [], ['PendantOfWisdom']],
            ["Master Sword Pedestal", false, [], ['PendantOfPower']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower']],

            ["Link's Uncle", true, []],

            ["Secret Passage", true, ['UncleSword']],

            ["King's Tomb", false, []],
            ["King's Tomb", false, [], ['PegasusBoots']],
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
            ["Pegasus Rocks", false, [], ['PegasusBoots']],
            ["Pegasus Rocks", true, ['PegasusBoots']],

            ["Mini Moldorm Cave - Far Left", true, []],

            ["Mini Moldorm Cave - Left", true, []],

            ["Mini Moldorm Cave - Right", true, []],

            ["Mini Moldorm Cave - Far Right", true, []],

            ["Ice Rod Cave", true, []],

            ["Bottle Merchant", true, []],

            ["Sahasrahla", false, []],
            ["Sahasrahla", false, [], ['PendantOfCourage']],
            ["Sahasrahla", true, ['PendantOfCourage']],

            ["Magic Bat", false, []],
            ["Magic Bat", false, [], ['Powder']],
            ["Magic Bat", true, ['Powder']],

            ["Sick Kid", false, []],
            ["Sick Kid", false, [], ['AnyBottle']],
            ["Sick Kid", true, ['BottleWithBee']],
            ["Sick Kid", true, ['BottleWithFairy']],
            ["Sick Kid", true, ['BottleWithRedPotion']],
            ["Sick Kid", true, ['BottleWithGreenPotion']],
            ["Sick Kid", true, ['BottleWithBluePotion']],
            ["Sick Kid", true, ['Bottle']],
            ["Sick Kid", true, ['BottleWithGoldBee']],

            ["Hobo", true, []],

            ["Bombos Tablet", false, []],
            ["Bombos Tablet", false, [], ['UpgradedSword']],
            ["Bombos Tablet", false, [], ['BookOfMudora']],
            ["Bombos Tablet", true, ['BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L2Sword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L3Sword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L4Sword']],

            ["King Zora", true, []],

            ["Lost Woods Hideout", true, []],

            ["Lumberjack Tree", false, []],
            ["Lumberjack Tree", false, [], ['PegasusBoots']],
            ["Lumberjack Tree", false, [], ['DefeatAgahnim']],
            ["Lumberjack Tree", true, ['PegasusBoots', 'DefeatAgahnim']],

            ["Cave 45", true, []],

            ["Graveyard Ledge", true, []],

            ["Checkerboard Cave", false, []],
            ["Checkerboard Cave", false, [], ['Gloves']],
            ["Checkerboard Cave", true, ['ProgressiveGlove']],
            ["Checkerboard Cave", true, ['PowerGlove']],
            ["Checkerboard Cave", true, ['TitansMitt']],

            ["Mini Moldorm Cave - NPC", true, []],

            ["Library", false, []],
            ["Library", false, [], ['PegasusBoots']],
            ["Library", true, ['PegasusBoots']],

            ["Mushroom", true, []],

            ["Potion Shop", false, []],
            ["Potion Shop", false, [], ['Mushroom']],
            ["Potion Shop", true, ['Mushroom']],

            ["Maze Race", true, []],

            ["Desert Ledge", true, []],

            ["Lake Hylia Island", true, []],

            ["Sunken Treasure", true, []],
            
            ["Zora's Ledge", false, []],
            ["Zora's Ledge", false, [], ['Flippers', 'PegasusBoots']],
            ["Zora's Ledge", true, ['Flippers']],
            ["Zora's Ledge", true, ['PegasusBoots']],

            ["Flute Spot", false, []],
            ["Flute Spot", false, [], ['Shovel']],
            ["Flute Spot", true, ['Shovel']],

            ["Waterfall Fairy - Left", false, []],
            ["Waterfall Fairy - Left", false, [], ['Flippers', 'MoonPearl', 'PegasusBoots']],
            ["Waterfall Fairy - Left", true, ['Flippers']],
            ["Waterfall Fairy - Left", true, ['MoonPearl']],
            ["Waterfall Fairy - Left", true, ['PegasusBoots']],

            ["Waterfall Fairy - Right", false, []],
            ["Waterfall Fairy - Right", false, [], ['Flippers', 'MoonPearl', 'PegasusBoots']],
            ["Waterfall Fairy - Right", true, ['Flippers']],
            ["Waterfall Fairy - Right", true, ['MoonPearl']],
            ["Waterfall Fairy - Right", true, ['PegasusBoots']],
        ];
    }
}
