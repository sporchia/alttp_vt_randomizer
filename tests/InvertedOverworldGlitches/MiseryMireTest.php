<?php

namespace InvertedOverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class MiseryMireTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);

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
            ["Misery Mire - Big Chest", false, [], ['BigKeyD6']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Main Lobby", false, []],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Big Key Chest", false, []],
            ["Misery Mire - Big Key Chest", false, [], ['FireRod', 'Lamp']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'L4Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Compass Chest", false, []],
            ["Misery Mire - Compass Chest", false, [], ['FireRod', 'Lamp']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'PegasusBoots', 'Ether', 'L4Sword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Bridge Chest", false, []],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Bridge Chest", true, ['PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Map Chest", false, []],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Spike Chest", false, []],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Spike Chest", true, ['PegasusBoots', 'Ether', 'L4Sword']],

            ["Misery Mire - Boss", false, []],
            ["Misery Mire - Boss", false, [], ['Lamp']],
            ["Misery Mire - Boss", false, [], ['CaneOfSomaria']],
            ["Misery Mire - Boss", false, [], ['BigKeyD6']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'UncleSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'ProgressiveSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'MasterSword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'L3Sword']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'PegasusBoots', 'Ether', 'L4Sword']],
        ];
    }
}
