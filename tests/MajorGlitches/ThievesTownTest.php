<?php

namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class ThievesTownTest extends TestCase
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

    /**
     * @param string $location
     * @param bool $access
     * @param string $item
     * @param array $items
     * @param array $except
     * @param array $keys
     * @param string $big_key
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
            ["Thieves' Town - Attic", false, 'BigKeyD4', [], ['BigKeyD4']],
            ["Thieves' Town - Attic", false, 'KeyD4', [], ['KeyD4']],

            ["Thieves' Town - Big Key Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Map Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Compass Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Ambush Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Big Chest", false, 'BigKeyD4', [], ['BigKeyD4']],
            ["Thieves' Town - Big Chest", true, 'KeyD4', [], ['KeyD4']],

            ["Thieves' Town - Blind's Cell", false, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Boss", false, 'BigKeyD4', [], ['BigKeyD4']],
            ["Thieves' Town - Boss", false, 'KeyD4', [], ['KeyD4']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Thieves' Town - Attic", false, []],
            ["Thieves' Town - Attic", false, [], ['BigKeyD4']],
            ["Thieves' Town - Attic", false, [], ['MoonPearl', 'AnyBottle']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['BottleWithBee', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['BottleWithFairy', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['BottleWithRedPotion', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['BottleWithGreenPotion', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['BottleWithBluePotion', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['Bottle', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Attic", true, ['BottleWithGoldBee', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Big Key Chest", false, []],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl']],
            ["Thieves' Town - Big Key Chest", true, ['BottleWithBee']],
            ["Thieves' Town - Big Key Chest", true, ['BottleWithFairy']],
            ["Thieves' Town - Big Key Chest", true, ['BottleWithRedPotion']],
            ["Thieves' Town - Big Key Chest", true, ['BottleWithGreenPotion']],
            ["Thieves' Town - Big Key Chest", true, ['BottleWithBluePotion']],
            ["Thieves' Town - Big Key Chest", true, ['Bottle']],
            ["Thieves' Town - Big Key Chest", true, ['BottleWithGoldBee']],

            ["Thieves' Town - Map Chest", false, []],
            ["Thieves' Town - Map Chest", true, ['MoonPearl']],
            ["Thieves' Town - Map Chest", true, ['BottleWithBee']],
            ["Thieves' Town - Map Chest", true, ['BottleWithFairy']],
            ["Thieves' Town - Map Chest", true, ['BottleWithRedPotion']],
            ["Thieves' Town - Map Chest", true, ['BottleWithGreenPotion']],
            ["Thieves' Town - Map Chest", true, ['BottleWithBluePotion']],
            ["Thieves' Town - Map Chest", true, ['Bottle']],
            ["Thieves' Town - Map Chest", true, ['BottleWithGoldBee']],


            ["Thieves' Town - Compass Chest", false, []],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl']],
            ["Thieves' Town - Compass Chest", true, ['BottleWithBee']],
            ["Thieves' Town - Compass Chest", true, ['BottleWithFairy']],
            ["Thieves' Town - Compass Chest", true, ['BottleWithRedPotion']],
            ["Thieves' Town - Compass Chest", true, ['BottleWithGreenPotion']],
            ["Thieves' Town - Compass Chest", true, ['BottleWithBluePotion']],
            ["Thieves' Town - Compass Chest", true, ['Bottle']],
            ["Thieves' Town - Compass Chest", true, ['BottleWithGoldBee']],


            ["Thieves' Town - Ambush Chest", false, []],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl']],
            ["Thieves' Town - Ambush Chest", true, ['BottleWithBee']],
            ["Thieves' Town - Ambush Chest", true, ['BottleWithFairy']],
            ["Thieves' Town - Ambush Chest", true, ['BottleWithRedPotion']],
            ["Thieves' Town - Ambush Chest", true, ['BottleWithGreenPotion']],
            ["Thieves' Town - Ambush Chest", true, ['BottleWithBluePotion']],
            ["Thieves' Town - Ambush Chest", true, ['Bottle']],
            ["Thieves' Town - Ambush Chest", true, ['BottleWithGoldBee']],


            ["Thieves' Town - Big Chest", false, []],
            ["Thieves' Town - Big Chest", false, [], ['BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['BottleWithBee', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['BottleWithFairy', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['BottleWithRedPotion', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['BottleWithGreenPotion', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['BottleWithBluePotion', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['Bottle', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['BottleWithGoldBee', 'Hammer', 'KeyD4', 'BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['MoonPearl', 'Hammer', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Blind's Cell", false, []],
            ["Thieves' Town - Blind's Cell", false, [], ['BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['BottleWithBee', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['BottleWithFairy', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['BottleWithRedPotion', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['BottleWithGreenPotion', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['BottleWithBluePotion', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['Bottle', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['BottleWithGoldBee', 'BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'BigKeyD4']],

            ["Thieves' Town - Boss", false, []],
            ["Thieves' Town - Boss", false, [], ['BigKeyD4']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'BigKeyD4', 'Hammer']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBee', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBee', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBee', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBee', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBee', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBee', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBee', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBee', 'BigKeyD4', 'Hammer']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithFairy', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithFairy', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithFairy', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithFairy', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithFairy', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithFairy', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithFairy', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithFairy', 'BigKeyD4', 'Hammer']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithRedPotion', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithRedPotion', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithRedPotion', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithRedPotion', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithRedPotion', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithRedPotion', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithRedPotion', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithRedPotion', 'BigKeyD4', 'Hammer']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGreenPotion', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGreenPotion', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGreenPotion', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGreenPotion', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGreenPotion', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGreenPotion', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGreenPotion', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGreenPotion', 'BigKeyD4', 'Hammer']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBluePotion', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBluePotion', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBluePotion', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBluePotion', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBluePotion', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBluePotion', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBluePotion', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithBluePotion', 'BigKeyD4', 'Hammer']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'Bottle', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'Bottle', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'Bottle', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'Bottle', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'Bottle', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'Bottle', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'Bottle', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'Bottle', 'BigKeyD4', 'Hammer']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGoldBee', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGoldBee', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGoldBee', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGoldBee', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGoldBee', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGoldBee', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGoldBee', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BottleWithGoldBee', 'BigKeyD4', 'Hammer']],


        ];
    }
}
