<?php

namespace MajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class NorthWestTest extends TestCase
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
            ["Brewery", false, []],
            ["Brewery", false, [], ['MoonPearl', 'AnyBottle']],
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
            ["Hammer Pegs", false, [], ['Hammer']],
            ["Hammer Pegs", false, [], ['MoonPearl', 'AnyBottle']],
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
            ["Blacksmith", false, [], ['MoonPearl', 'AnyBottle']],
            ["Blacksmith", false, [], ['Gloves', 'AnyBottle']],
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
            ["Purple Chest", false, [], ['MoonPearl', 'AnyBottle']],
            ["Purple Chest", false, [], ['Gloves', 'AnyBottle']],
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
