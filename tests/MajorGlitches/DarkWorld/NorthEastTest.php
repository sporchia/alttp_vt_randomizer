<?php

namespace MajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class NorthEastTest extends TestCase
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
            ["Catfish", false, []],
            ["Catfish", false, [], ['MoonPearl', 'AnyBottle']],
            ["Catfish", true, ['MoonPearl']],
            ["Catfish", true, ['BottleWithBee']],
            ["Catfish", true, ['BottleWithFairy']],
            ["Catfish", true, ['BottleWithRedPotion']],
            ["Catfish", true, ['BottleWithGreenPotion']],
            ["Catfish", true, ['BottleWithBluePotion']],
            ["Catfish", true, ['Bottle']],
            ["Catfish", true, ['BottleWithGoldBee']],

            ["Pyramid", true, []],

            ["Pyramid Fairy - Sword", false, []],
            ["Pyramid Fairy - Sword", false, [], ['AnySword']],
            ["Pyramid Fairy - Sword", false, [], ['MagicMirror', 'Crystal5']],
            ["Pyramid Fairy - Sword", false, [], ['MagicMirror', 'Crystal6']],
            ["Pyramid Fairy - Sword", false, [], ['MagicMirror', 'MoonPearl', 'AnyBottle']],
            ["Pyramid Fairy - Sword", false, [], ['MagicMirror', 'Hammer', 'AnyBottle']],
            ["Pyramid Fairy - Sword", true, ['MagicMirror', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'Hammer', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['Crystal5', 'Crystal6', 'BottleWithBee', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['Crystal5', 'Crystal6', 'BottleWithFairy', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['Crystal5', 'Crystal6', 'BottleWithRedPotion', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['Crystal5', 'Crystal6', 'BottleWithGreenPotion', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['Crystal5', 'Crystal6', 'BottleWithBluePotion', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['Crystal5', 'Crystal6', 'Bottle', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['Crystal5', 'Crystal6', 'BottleWithGoldBee', 'UncleSword']],

            ["Pyramid Fairy - Bow", false, []],
            ["Pyramid Fairy - Bow", false, [], ['AnyBow']],
            ["Pyramid Fairy - Bow", false, [], ['MagicMirror', 'Crystal5']],
            ["Pyramid Fairy - Bow", false, [], ['MagicMirror', 'Crystal6']],
            ["Pyramid Fairy - Bow", false, [], ['MagicMirror', 'MoonPearl', 'AnyBottle']],
            ["Pyramid Fairy - Bow", false, [], ['MagicMirror', 'Hammer', 'AnyBottle']],
            ["Pyramid Fairy - Bow", true, ['MagicMirror', 'BowAndArrows']],
            ["Pyramid Fairy - Bow", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'Hammer', 'BowAndArrows']],
            ["Pyramid Fairy - Bow", true, ['Crystal5', 'Crystal6', 'BottleWithBee', 'BowAndArrows']],
            ["Pyramid Fairy - Bow", true, ['Crystal5', 'Crystal6', 'BottleWithFairy', 'BowAndArrows']],
            ["Pyramid Fairy - Bow", true, ['Crystal5', 'Crystal6', 'BottleWithRedPotion', 'BowAndArrows']],
            ["Pyramid Fairy - Bow", true, ['Crystal5', 'Crystal6', 'BottleWithGreenPotion', 'BowAndArrows']],
            ["Pyramid Fairy - Bow", true, ['Crystal5', 'Crystal6', 'BottleWithBluePotion', 'BowAndArrows']],
            ["Pyramid Fairy - Bow", true, ['Crystal5', 'Crystal6', 'Bottle', 'BowAndArrows']],
            ["Pyramid Fairy - Bow", true, ['Crystal5', 'Crystal6', 'BottleWithGoldBee', 'BowAndArrows']],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", false, [], ['MagicMirror', 'Crystal5']],
            ["Pyramid Fairy - Left", false, [], ['MagicMirror', 'Crystal6']],
            ["Pyramid Fairy - Left", false, [], ['MagicMirror', 'MoonPearl', 'AnyBottle']],
            ["Pyramid Fairy - Left", false, [], ['MagicMirror', 'Hammer', 'AnyBottle']],
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
            ["Pyramid Fairy - Right", false, [], ['MagicMirror', 'Crystal5']],
            ["Pyramid Fairy - Right", false, [], ['MagicMirror', 'Crystal6']],
            ["Pyramid Fairy - Right", false, [], ['MagicMirror', 'MoonPearl', 'AnyBottle']],
            ["Pyramid Fairy - Right", false, [], ['MagicMirror', 'Hammer', 'AnyBottle']],
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
            ["Ganon", false, [], ['DefeatAgahnim2']],
            ["Ganon", false, [], ['FireRod', 'Lamp']],
            ["Ganon", false, [], ['AnySword']],
        ];
    }
}
