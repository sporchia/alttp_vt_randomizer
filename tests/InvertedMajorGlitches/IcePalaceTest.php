<?php

namespace InvertedMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class InvertedIcePalaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
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
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['PowerGlove', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Compass Chest", true, []],

            ["Ice Palace - Map Chest", false, []],
            ["Ice Palace - Map Chest", false, [], ['Gloves']],
            ["Ice Palace - Map Chest", false, [], ['Hammer']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['PowerGlove', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'CaneOfByrna', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Cape', 'Hammer', 'KeyD5', 'KeyD5']],

            ["Ice Palace - Spike Room", false, []],
            ["Ice Palace - Spike Room", true, ['Hookshot', 'KeyD5']],
            ["Ice Palace - Spike Room", true, ['KeyD5', 'KeyD5']],

            ["Ice Palace - Freezor Chest", false, []],
            ["Ice Palace - Freezor Chest", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Freezor Chest", true, ['FireRod']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'UncleSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'ProgressiveSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'MasterSword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'L3Sword']],
            ["Ice Palace - Freezor Chest", true, ['Bombos', 'L4Sword']],

            ["Ice Palace - Iced T Room", true, []],

            ["Ice Palace - Big Chest", false, []],
            ["Ice Palace - Big Chest", false, [], ['BigKeyD5']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5']],

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
