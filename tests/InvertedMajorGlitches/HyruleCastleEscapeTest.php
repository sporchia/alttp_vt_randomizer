<?php

namespace InvertedMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class HyruleCastleEscapeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
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

    /**
     * @param string $location
     * @param bool $access
     * @param string $item
     * @param array $items
     * @param array $except
     *
     * @dataProvider fillPool
     */
    public function testFillLocation(string $location, bool $access, string $item, array $items = [], array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getLocation($location)
            ->fill(Item::get($item, $this->world), $this->collected));
    }

    public function fillPool()
    {
        return [

            ["Sanctuary", true, 'KeyH2', [], ['KeyH2']],

            ["Sewers - Secret Room - Left", true, 'KeyH2', [], ['KeyH2']],

            ["Sewers - Secret Room - Middle", true, 'KeyH2', [], ['KeyH2']],

            ["Sewers - Secret Room - Right", true, 'KeyH2', [], ['KeyH2']],

            ["Sewers - Dark Cross", true, 'KeyH2', [], ['KeyH2']],

            ["Hyrule Castle - Boomerang Chest", false, 'KeyH2', [], ['KeyH2']],

            ["Hyrule Castle - Map Chest", true, 'KeyH2', [], ['KeyH2']],

            ["Hyrule Castle - Zelda's Cell", false, 'KeyH2', [], ['KeyH2']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Sanctuary", False, []],
            ["Sanctuary", False, [], ['MoonPearl', 'MagicMirror', 'AnyBottle', 'Lamp']],
            ["Sanctuary", true, ['Lamp', 'KeyH2']],
            ["Sanctuary", true, ['MoonPearl']],
            ["Sanctuary", true, ['MagicMirror']],
            ["Sanctuary", true, ['BottleWithBee']],
            ["Sanctuary", true, ['BottleWithFairy']],
            ["Sanctuary", true, ['BottleWithRedPotion']],
            ["Sanctuary", true, ['BottleWithGreenPotion']],
            ["Sanctuary", true, ['BottleWithBluePotion']],
            ["Sanctuary", true, ['Bottle']],
            ["Sanctuary", true, ['BottleWithGoldBee']],
            
            ["Sewers - Secret Room - Left", false, []],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['BottleWithBee', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithBee', 'PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithBee', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['BottleWithFairy', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithFairy', 'PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithFairy', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['BottleWithRedPotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithRedPotion', 'PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithRedPotion', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['BottleWithGreenPotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithGreenPotion', 'PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithGreenPotion', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['BottleWithBluePotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithBluePotion', 'PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithBluePotion', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['Bottle', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['Bottle', 'PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['Bottle', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['BottleWithGoldBee', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithGoldBee', 'PowerGlove']],
            ["Sewers - Secret Room - Left", true, ['BottleWithGoldBee', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['Lamp', 'KeyH2']],
            
            ["Sewers - Secret Room - Middle", false, []],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithBee', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithBee', 'PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithBee', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithFairy', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithFairy', 'PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithFairy', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithRedPotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithRedPotion', 'PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithRedPotion', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithGreenPotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithGreenPotion', 'PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithGreenPotion', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithBluePotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithBluePotion', 'PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithBluePotion', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['Bottle', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['Bottle', 'PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['Bottle', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithGoldBee', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithGoldBee', 'PowerGlove']],
            ["Sewers - Secret Room - Middle", true, ['BottleWithGoldBee', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['Lamp', 'KeyH2']],
            
            ["Sewers - Secret Room - Right", false, []],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['BottleWithBee', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithBee', 'PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithBee', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['BottleWithFairy', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithFairy', 'PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithFairy', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['BottleWithRedPotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithRedPotion', 'PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithRedPotion', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['BottleWithGreenPotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithGreenPotion', 'PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithGreenPotion', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['BottleWithBluePotion', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithBluePotion', 'PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithBluePotion', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['Bottle', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['Bottle', 'PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['Bottle', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['BottleWithGoldBee', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithGoldBee', 'PowerGlove']],
            ["Sewers - Secret Room - Right", true, ['BottleWithGoldBee', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['Lamp', 'KeyH2']],
            
            ["Sewers - Dark Cross", False, []],
            ["Sewers - Dark Cross", False, [], ['Lamp']],
            ["Sewers - Dark Cross", true, ['Lamp']],
            
            ["Hyrule Castle - Boomerang Chest", false, []],
            ["Hyrule Castle - Boomerang Chest", false, [], ['KeyH2']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2']],

            ["Hyrule Castle - Map Chest", true, []],
            ["Hyrule Castle - Map Chest", true, ['DefeatAgahnim']],

            ["Hyrule Castle - Zelda's Cell", false, []],
            ["Hyrule Castle - Zelda's Cell", false, [], ['KeyH2']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2']],
        ];
    }
}
