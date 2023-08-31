<?php

namespace InvertedOverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class InvertedIcePalaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
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
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],

            ["Ice Palace - Compass Chest", false, []],
            ["Ice Palace - Compass Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Compass Chest", true, ['FireRod']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'UncleSword']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'ProgressiveSword']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'MasterSword']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'L3Sword']],
            ["Ice Palace - Compass Chest", true, ['Bombos', 'L4Sword']],

            ["Ice Palace - Map Chest", false, []],
            ["Ice Palace - Map Chest", false, [], ['Gloves']],
            ["Ice Palace - Map Chest", false, [], ['Hammer']],
            ["Ice Palace - Map Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],

            ["Ice Palace - Spike Room", false, []],
            ["Ice Palace - Spike Room", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Spike Room", true, ['FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],

            ["Ice Palace - Freezor Chest", false, []],
            ["Ice Palace - Freezor Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Freezor Chest", true, ['FireRod']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'UncleSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'ProgressiveSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'MasterSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'L3Sword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'L4Sword']],

            ["Ice Palace - Iced T Room", false, []],
            ["Ice Palace - Iced T Room", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Iced T Room", true, ['FireRod']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'UncleSword']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'ProgressiveSword']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'MasterSword']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'L3Sword']],
            ["Ice Palace - Iced T Room", true, ['Bombos', 'L4Sword']],

            ["Ice Palace - Big Chest", false, []],
            ["Ice Palace - Big Chest", false, [], ['BigKeyD5']],
            ["Ice Palace - Big Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'FireRod']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'UncleSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'MasterSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'L3Sword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Bombos', 'L4Sword']],

            ["Ice Palace - Boss", false, []],
            ["Ice Palace - Boss", false, [], ['Gloves']],
            ["Ice Palace - Boss", false, [], ['Hammer']],
            ["Ice Palace - Boss", false, [], ['BigKeyD5']],
            ["Ice Palace - Boss", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
        ];
    }
}
