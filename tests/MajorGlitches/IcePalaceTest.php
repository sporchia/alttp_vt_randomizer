<?php

namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class IcePalaceTest extends TestCase
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
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'MoonPearl', 'CaneOfByrna', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'MoonPearl', 'Cape', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'MoonPearl', 'CaneOfByrna', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'MoonPearl', 'Cape', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'Bottle', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'Bottle', 'CaneOfByrna', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'Bottle', 'Cape', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'Bottle', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'Bottle', 'CaneOfByrna', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Flippers', 'Bottle', 'Cape', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['MagicMirror', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['MagicMirror', 'CaneOfByrna', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['MagicMirror', 'Cape', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['MagicMirror', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['MagicMirror', 'CaneOfByrna', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['MagicMirror', 'Cape', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Cape', 'TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['CaneOfByrna', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['Cape', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Big Key Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],

            ["Ice Palace - Compass Chest", false, []],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'MoonPearl']],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'Bottle']],
            ["Ice Palace - Compass Chest", true, ['MagicMirror']],
            ["Ice Palace - Compass Chest", true, ['TitansMitt']],

            ["Ice Palace - Map Chest", false, []],
            ["Ice Palace - Map Chest", false, [], ['Gloves']],
            ["Ice Palace - Map Chest", false, [], ['Hammer']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'MoonPearl', 'CaneOfByrna', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'MoonPearl', 'Cape', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'MoonPearl', 'CaneOfByrna', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'MoonPearl', 'Cape', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'Bottle', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'Bottle', 'CaneOfByrna', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'Bottle', 'Cape', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'Bottle', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'Bottle', 'CaneOfByrna', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Flippers', 'Bottle', 'Cape', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['MagicMirror', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['MagicMirror', 'CaneOfByrna', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['MagicMirror', 'Cape', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['MagicMirror', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['MagicMirror', 'CaneOfByrna', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['MagicMirror', 'Cape', 'PowerGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['CaneOfByrna', 'TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Cape', 'TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['TitansMitt', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['CaneOfByrna', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['Cape', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],
            ["Ice Palace - Map Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'KeyD5']],

            ["Ice Palace - Spike Room", false, []],
            ["Ice Palace - Spike Room", true, ['Flippers', 'MoonPearl', 'Hookshot', 'KeyD5']],

            ["Ice Palace - Freezor Chest", false, []],
            ["Ice Palace - Freezor Chest", false, [], ['FireRod', 'Bombos']],
            ["Ice Palace - Freezor Chest", false, [], ['FireRod', 'AnySword']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'MoonPearl', 'FireRod']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bottle', 'FireRod']],
            ["Ice Palace - Freezor Chest", true, ['MagicMirror', 'FireRod']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'FireRod']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'MoonPearl', 'UncleSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bottle', 'UncleSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['MagicMirror', 'UncleSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'UncleSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'MoonPearl', 'ProgressiveSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bottle', 'ProgressiveSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['MagicMirror', 'ProgressiveSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'ProgressiveSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'MoonPearl', 'MasterSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bottle', 'MasterSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['MagicMirror', 'MasterSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'MasterSword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'MoonPearl', 'L3Sword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bottle', 'L3Sword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['MagicMirror', 'L3Sword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'L3Sword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'MoonPearl', 'L4Sword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['Flippers', 'Bottle', 'L4Sword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['MagicMirror', 'L4Sword', 'Bombos']],
            ["Ice Palace - Freezor Chest", true, ['TitansMitt', 'L4Sword', 'Bombos']],

            ["Ice Palace - Iced T Room", false, []],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'MoonPearl']],
            ["Ice Palace - Compass Chest", true, ['Flippers', 'Bottle']],
            ["Ice Palace - Compass Chest", true, ['MagicMirror']],
            ["Ice Palace - Compass Chest", true, ['TitansMitt']],

            ["Ice Palace - Big Chest", false, []],
            ["Ice Palace - Big Chest", false, [], ['BigKeyD5']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Flippers', 'MoonPearl']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'Flippers', 'Bottle']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'MagicMirror']],
            ["Ice Palace - Big Chest", true, ['BigKeyD5', 'TitansMitt']],

            ["Ice Palace - Boss", false, []],
            ["Ice Palace - Boss", false, [], ['Gloves']],
            ["Ice Palace - Boss", false, [], ['Hammer']],
            ["Ice Palace - Boss", false, [], ['BigKeyD5']],
            ["Ice Palace - Boss", false, [], ['FireRod', 'Bombos', 'AnySword']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'ProgressiveGlove', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'TitansMitt', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'MoonPearl', 'PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'Flippers', 'Bottle', 'PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'ProgressiveGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'FireRod', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'FireRod', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'UncleSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'ProgressiveSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'MasterSword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'L3Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'KeyD5', 'KeyD5']],
            ["Ice Palace - Boss", true, ['BigKeyD5', 'MagicMirror', 'PowerGlove', 'Bombos', 'L4Sword', 'Hammer', 'CaneOfSomaria', 'KeyD5']],

        ];
    }
}
