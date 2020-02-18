<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class ThievesTownTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
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
            ["Thieves' Town - Attic", false, [], ['MoonPearl']],
            ["Thieves' Town - Attic", false, [], ['BigKeyD4']],
            ["Thieves' Town - Attic", true, ['MoonPearl', 'PegasusBoots', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Big Key Chest", false, []],
            ["Thieves' Town - Big Key Chest", false, [], ['MoonPearl']],
            ["Thieves' Town - Big Key Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Thieves' Town - Map Chest", false, []],
            ["Thieves' Town - Map Chest", false, [], ['MoonPearl']],
            ["Thieves' Town - Map Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Thieves' Town - Compass Chest", false, []],
            ["Thieves' Town - Compass Chest", false, [], ['MoonPearl']],
            ["Thieves' Town - Compass Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Thieves' Town - Ambush Chest", false, []],
            ["Thieves' Town - Ambush Chest", false, [], ['MoonPearl']],
            ["Thieves' Town - Ambush Chest", true, ['MoonPearl', 'PegasusBoots']],

            ["Thieves' Town - Big Chest", false, []],
            ["Thieves' Town - Big Chest", false, [], ['MoonPearl']],
            ["Thieves' Town - Big Chest", false, [], ['BigKeyD4']],
            ["Thieves' Town - Big Chest", true, ['MoonPearl', 'PegasusBoots', 'Hammer', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Blind's Cell", false, []],
            ["Thieves' Town - Blind's Cell", false, [], ['MoonPearl']],
            ["Thieves' Town - Blind's Cell", false, [], ['BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['MoonPearl', 'PegasusBoots', 'BigKeyD4']],

            ["Thieves' Town - Boss", false, []],
            ["Thieves' Town - Boss", false, [], ['MoonPearl']],
            ["Thieves' Town - Boss", false, [], ['BigKeyD4']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'ProgressiveSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'UncleSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'MasterSword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'L3Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'L4Sword']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'CaneOfByrna']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'CaneOfSomaria']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'MoonPearl', 'PegasusBoots', 'BigKeyD4', 'Hammer']],
        ];
    }
}
