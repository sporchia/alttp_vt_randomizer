<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class MiseryMireTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);

        $this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether', $this->world));
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
            ["Misery Mire - Big Chest", false, 'BigKeyD6', [], ['BigKeyD6']],

            ["Misery Mire - Main Lobby", true, 'BigKeyD6', [], ['BigKeyD6']],

            ["Misery Mire - Big Key Chest", true, 'BigKeyD6', [], ['BigKeyD6']],

            ["Misery Mire - Compass Chest", true, 'BigKeyD6', [], ['BigKeyD6']],

            ["Misery Mire - Bridge Chest", true, 'BigKeyD6', [], ['BigKeyD6']],

            ["Misery Mire - Map Chest", true, 'BigKeyD6', [], ['BigKeyD6']],

            ["Misery Mire - Spike Chest", true, 'BigKeyD6', [], ['BigKeyD6']],

            ["Misery Mire - Boss", false, 'BigKeyD6', [], ['BigKeyD6']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Misery Mire - Big Chest", false, []],
            ["Misery Mire - Big Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Big Chest", false, [], ['BigKeyD6']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Main Lobby", false, []],
            ["Misery Mire - Main Lobby", false, [], ['MoonPearl']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Big Key Chest", false, []],
            ["Misery Mire - Big Key Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Big Key Chest", false, [], ['FireRod', 'Lamp']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Compass Chest", false, []],
            ["Misery Mire - Compass Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Compass Chest", false, [], ['FireRod', 'Lamp']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Bridge Chest", false, []],
            ["Misery Mire - Bridge Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Map Chest", false, []],
            ["Misery Mire - Map Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Spike Chest", false, []],
            ["Misery Mire - Spike Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Boss", false, []],
            ["Misery Mire - Boss", false, [], ['MoonPearl']],
            ["Misery Mire - Boss", false, [], ['Lamp']],
            ["Misery Mire - Boss", false, [], ['CaneOfSomaria']],
            ["Misery Mire - Boss", false, [], ['BigKeyD6']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'PegasusBoots', 'Ether', 'L4Sword']],
        ];
    }
}
