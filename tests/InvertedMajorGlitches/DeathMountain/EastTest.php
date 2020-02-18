<?php

namespace InvertedMajorGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class EastTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
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
            ["Mimic Cave", false, [], ['MoonPearl', 'AnyBottle']],
            ["Mimic Cave", false, [], ['Hammer']],
            ["Mimic Cave", true, ['MoonPearl', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithBee', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithFairy', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithRedPotion', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithGreenPotion', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithBluePotion', 'Hammer']],
            ["Mimic Cave", true, ['Bottle', 'Hammer']],
            ["Mimic Cave", true, ['BottleWithGoldBee', 'Hammer']],
            
            ["Ether Tablet", false, []],
            ["Ether Tablet", false, [], ['UpgradedSword']],
            ["Ether Tablet", false, [], ['BookOfMudora']],
            ["Ether Tablet", true, ['BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L4Sword']],

            ["Spectacle Rock", true, []],
        ];
    }
}