<?php

namespace NoGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NoGlitches
 */
class MiseryMireTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);

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
            ["Misery Mire - Big Chest", false, [], ['TitansMitt']],
            ["Misery Mire - Big Chest", false, [], ['Flute']],
            ["Misery Mire - Big Chest", false, [], ['BigKeyD6']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Big Chest", true, ['BigKeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Main Lobby", false, []],
            ["Misery Mire - Main Lobby", false, [], ['MoonPearl']],
            ["Misery Mire - Main Lobby", false, [], ['TitansMitt']],
            ["Misery Mire - Main Lobby", false, [], ['Flute']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Main Lobby", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Big Key Chest", false, []],
            ["Misery Mire - Big Key Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Big Key Chest", false, [], ['TitansMitt']],
            ["Misery Mire - Big Key Chest", false, [], ['Flute']],
            ["Misery Mire - Big Key Chest", false, [], ['FireRod', 'Lamp']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Big Key Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Compass Chest", false, []],
            ["Misery Mire - Compass Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Compass Chest", false, [], ['TitansMitt']],
            ["Misery Mire - Compass Chest", false, [], ['Flute']],
            ["Misery Mire - Compass Chest", false, [], ['FireRod', 'Lamp']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'Lamp', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Compass Chest", true, ['KeyD6', 'KeyD6', 'KeyD6', 'FireRod', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Bridge Chest", false, []],
            ["Misery Mire - Bridge Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Bridge Chest", false, [], ['TitansMitt']],
            ["Misery Mire - Bridge Chest", false, [], ['Flute']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Bridge Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Map Chest", false, []],
            ["Misery Mire - Map Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Map Chest", false, [], ['TitansMitt']],
            ["Misery Mire - Map Chest", false, [], ['Flute']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Map Chest", true, ['KeyD6', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

            ["Misery Mire - Spike Chest", false, []],
            ["Misery Mire - Spike Chest", false, [], ['MoonPearl']],
            ["Misery Mire - Spike Chest", false, [], ['TitansMitt']],
            ["Misery Mire - Spike Chest", false, [], ['Flute']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot', 'CaneOfByrna']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots', 'Cape']],
            ["Misery Mire - Spike Chest", true, ['MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot', 'Cape']],

            ["Misery Mire - Boss", false, []],
            ["Misery Mire - Boss", false, [], ['MoonPearl']],
            ["Misery Mire - Boss", false, [], ['TitansMitt']],
            ["Misery Mire - Boss", false, [], ['Flute']],
            ["Misery Mire - Boss", false, [], ['Lamp']],
            ["Misery Mire - Boss", false, [], ['CaneOfSomaria']],
            ["Misery Mire - Boss", false, [], ['BigKeyD6']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'UncleSword', 'Hookshot']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'ProgressiveSword', 'Hookshot']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'MasterSword', 'Hookshot']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L3Sword', 'Hookshot']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'PegasusBoots']],
            ["Misery Mire - Boss", true, ['KeyD6', 'KeyD6', 'BigKeyD6', 'Lamp', 'CaneOfSomaria', 'MoonPearl', 'Flute', 'TitansMitt', 'Ether', 'L4Sword', 'Hookshot']],

        ];
    }
}
