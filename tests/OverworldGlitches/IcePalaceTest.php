<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class IcePalaceTest extends TestCase
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
            ["Ice Palace - Big Key Chest", true, 'BigKeyD5', [], ['BigKeyD5']],

            ["Ice Palace - Compass Chest", true, 'BigKeyD5', [], ['BigKeyD5']],

            ["Ice Palace - Map Chest", true, 'BigKeyD5', [], ['BigKeyD5']],

            ["Ice Palace - Spike Room", true, 'BigKeyD5', [], ['BigKeyD5']],

            ["Ice Palace - Freezor Chest", true, 'BigKeyD5', [], ['BigKeyD5']],

            ["Ice Palace - Iced T Room", true, 'BigKeyD5', [], ['BigKeyD5']],

            ["Ice Palace - Big Chest", false, 'BigKeyD5', [], ['BigKeyD5']],

            ["Ice Palace - Boss", false, 'BigKeyD5', [], ['BigKeyD5']],
        ];
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
            ["Ice Palace - Big Key Chest", false, []],
            ["Ice Palace - Big Key Chest", false, [], ['Gloves']],
            ["Ice Palace - Big Key Chest", false, [], ['Hammer']],
            ["Ice Palace - Big Key Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Compass Chest", false, []],
            ["Ice Palace - Compass Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Compass Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
            ["Ice Palace - Compass Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword']],
            ["Ice Palace - Compass Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Compass Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
            ["Ice Palace - Compass Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
            ["Ice Palace - Compass Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
            ["Ice Palace - Compass Chest", true, ['TitansMitt', 'FireRod']],
            ["Ice Palace - Compass Chest", true, ['TitansMitt', 'Bombos', 'UncleSword']],
            ["Ice Palace - Compass Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Compass Chest", true, ['TitansMitt', 'Bombos', 'MasterSword']],
            ["Ice Palace - Compass Chest", true, ['TitansMitt', 'Bombos', 'L3Sword']],
            ["Ice Palace - Compass Chest", true, ['TitansMitt', 'Bombos', 'L4Sword']],

            ["Ice Palace - Map Chest", false, []],
            ["Ice Palace - Map Chest", false, [], ['Gloves']],
            ["Ice Palace - Map Chest", false, [], ['Hammer']],
            ["Ice Palace - Map Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Cape', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Spike Room", false, []],
            ["Ice Palace - Spike Room", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'FireRod', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'UncleSword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'MasterSword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'L3Sword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'L4Sword', 'CaneOfByrna', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'FireRod', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Cape', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Cape', 'KeyD5', 'KeyD5']],




            ["Ice Palace - Freezor Chest", false, []],
            ["Ice Palace - Freezor Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Freezor Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
            ["Ice Palace - Freezor Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword']],
            ["Ice Palace - Freezor Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Freezor Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
            ["Ice Palace - Freezor Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
            ["Ice Palace - Freezor Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'FireRod']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'Bombos', 'UncleSword']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'Bombos', 'MasterSword']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'Bombos', 'L3Sword']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'Bombos', 'L4Sword']],

            ["Ice Palace - Iced T Room", false, []],
            ["Ice Palace - Iced T Room", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Iced T Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
            ["Ice Palace - Iced T Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword']],
            ["Ice Palace - Iced T Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Iced T Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
            ["Ice Palace - Iced T Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
            ["Ice Palace - Iced T Room", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
            ["Ice Palace - Iced T Room", true, ['TitansMitt', 'FireRod']],
            ["Ice Palace - Iced T Room", true, ['TitansMitt', 'Bombos', 'UncleSword']],
            ["Ice Palace - Iced T Room", true, ['TitansMitt', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Iced T Room", true, ['TitansMitt', 'Bombos', 'MasterSword']],
            ["Ice Palace - Iced T Room", true, ['TitansMitt', 'Bombos', 'L3Sword']],
            ["Ice Palace - Iced T Room", true, ['TitansMitt', 'Bombos', 'L4Sword']],

            ["Ice Palace - Big Chest", false, []],
            ["Ice Palace - Big Chest", false, [], ['BigKeyD5']],
            ["Ice Palace - Big Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'TitansMitt', 'FireRod']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'UncleSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'MasterSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L3Sword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L4Sword']],

            ["Ice Palace - Boss", false, []],
            ["Ice Palace - Boss", false, [], ['Gloves']],
            ["Ice Palace - Boss", false, [], ['Hammer']],
            ["Ice Palace - Boss", false, [], ['BigKeyD5']],
            ["Ice Palace - Boss", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
        ];
    }
}
