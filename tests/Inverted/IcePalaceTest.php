<?php

namespace Inverted;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class IcePalaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
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
            ["Ice Palace - Big Key Chest", false, [], ['Flippers']],
            ["Ice Palace - Big Key Chest", false, [], ['Hammer']],
            ["Ice Palace - Big Key Chest", false, [], ['Gloves']],
            ["Ice Palace - Big Key Chest", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Big Key Chest", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Flippers','Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Flippers','Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Flippers','Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],

            ["Ice Palace - Compass Chest", false, []],
            ["Ice Palace - Compass Chest", false, [], ['Flippers']],
            ["Ice Palace - Compass Chest", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Compass Chest", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'FireRod']],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'Bombos', 'UncleSword']],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'Bombos', 'MasterSword']],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'Bombos', 'L3Sword']],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'Bombos', 'L4Sword']],

            ["Ice Palace - Map Chest", false, []],
            ["Ice Palace - Map Chest", false, [], ['Flippers']],
            ["Ice Palace - Map Chest", false, [], ['Hammer']],
            ["Ice Palace - Map Chest", false, [], ['Gloves']],
            ["Ice Palace - Map Chest", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Map Chest", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'FireRod', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'Hookshot', 'KeyD5']],

            ["Ice Palace - Spike Room", false, []],
            ["Ice Palace - Spike Room", false, [], ['Flippers']],
            ["Ice Palace - Spike Room", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Spike Room", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Spike Room", true, ['Flippers', 'FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Flippers', 'Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Flippers', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Flippers', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Flippers', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Flippers', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Flippers', 'FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Flippers', 'Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Flippers', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Flippers', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['Cape', 'Flippers', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Flippers', 'FireRod', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Flippers', 'Bombos', 'UncleSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Flippers', 'Bombos', 'MasterSword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Flippers', 'Bombos', 'L3Sword', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['CaneOfByrna', 'Flippers', 'Bombos', 'L4Sword', 'Hookshot', 'KeyD5']],


            ["Ice Palace - Freezor Chest", false, []],
            ["Ice Palace - Freezor Chest", false, [], ['Flippers']],
            ["Ice Palace - Freezor Chest", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Freezor Chest", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'FireRod']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bombos', 'UncleSword']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bombos', 'MasterSword']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bombos', 'L3Sword']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bombos', 'L4Sword']],

            ["Ice Palace - Iced T Room", false, []],
            ["Ice Palace - Iced T Room", false, [], ['Flippers']],
            ["Ice Palace - Iced T Room", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Iced T Room", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Iced T Room", true, ['Flippers', 'FireRod']],
            ["Ice Palace - Iced T Room", true, ['Flippers', 'Bombos', 'UncleSword']],
            ["Ice Palace - Iced T Room", true, ['Flippers', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Iced T Room", true, ['Flippers', 'Bombos', 'MasterSword']],
            ["Ice Palace - Iced T Room", true, ['Flippers', 'Bombos', 'L3Sword']],
            ["Ice Palace - Iced T Room", true, ['Flippers', 'Bombos', 'L4Sword']],

            ["Ice Palace - Big Chest", false, []],
            ["Ice Palace - Big Chest", false, [], ['Flippers']],
            ["Ice Palace - Big Chest", false, [], ['BigKeyD5']],
            ["Ice Palace - Big Chest", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Big Chest", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5','Flippers', 'FireRod']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5','Flippers', 'Bombos', 'UncleSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5','Flippers', 'Bombos', 'ProgressiveSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5','Flippers', 'Bombos', 'MasterSword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5','Flippers', 'Bombos', 'L3Sword']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5','Flippers', 'Bombos', 'L4Sword']],

            ["Ice Palace - Boss", false, []],
            ["Ice Palace - Boss", false, [], ['Flippers']],
            ["Ice Palace - Boss", false, [], ['Hammer']],
            ["Ice Palace - Boss", false, [], ['Gloves']],
            ["Ice Palace - Boss", false, [], ['BigKeyD5']],
            ["Ice Palace - Boss", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Boss", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['ProgressiveGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['PowerGlove', 'BigKeyD5', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['TitansMitt', 'BigKeyD5', 'Flippers', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
        ];
    }
}
