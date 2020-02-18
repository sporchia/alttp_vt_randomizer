<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class TurtleRockTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);

        $this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake', $this->world));
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
            ["Turtle Rock - Chain Chomps", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Compass Chest", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Roller Room - Left", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Roller Room - Right", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Big Chest", false, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Big Key Chest", true, 'BigKeyD7', ['KeyD7', 'KeyD7'], ['BigKeyD7']],

            ["Turtle Rock - Crystaroller Room", false, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Left", false, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Right", false, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Left", false, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Right", false, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Boss", false, 'BigKeyD7', [], ['BigKeyD7']],
            ["Turtle Rock - Boss", false, 'KeyD7', [], ['KeyD7']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Turtle Rock - Chain Chomps", false, []],
            ["Turtle Rock - Chain Chomps", true, ['MoonPearl', 'PegasusBoots']],
            ["Turtle Rock - Chain Chomps", true, ['PegasusBoots', 'MagicMirror', 'Hammer']],
            ["Turtle Rock - Chain Chomps", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt']],

            ["Turtle Rock - Compass Chest", false, []],
            ["Turtle Rock - Compass Chest", false, [], ['CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Compass Chest", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Compass Chest", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Roller Room - Left", false, []],
            ["Turtle Rock - Roller Room - Left", false, [], ['CaneOfSomaria']],
            ["Turtle Rock - Roller Room - Left", false, [], ['FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],

            ["Turtle Rock - Roller Room - Right", false, []],
            ["Turtle Rock - Roller Room - Right", false, [], ['CaneOfSomaria']],
            ["Turtle Rock - Roller Room - Right", false, [], ['FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'FireRod']],

            ["Turtle Rock - Big Chest", false, []],
            ["Turtle Rock - Big Chest", false, [], ['BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['MoonPearl', 'PegasusBoots', 'Hookshot', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'Hookshot', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'Hookshot', 'BigKeyD7']],

            ["Turtle Rock - Big Key Chest", false, []],
            ["Turtle Rock - Big Key Chest", true, ['MoonPearl', 'PegasusBoots', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],
            ["Turtle Rock - Big Key Chest", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Crystaroller Room", false, []],
            ["Turtle Rock - Crystaroller Room", false, [], ['BigKeyD7']],
            ["Turtle Rock - Crystaroller Room", true, ['MoonPearl', 'PegasusBoots', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room", true, ['PegasusBoots', 'MagicMirror', 'Hammer', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room", true, ['PegasusBoots', 'MagicMirror', 'TitansMitt', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Left", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Right", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Left", false, []],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Right", false, []],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'Cape', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'CaneOfByrna', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'MirrorShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'MoonPearl', 'PegasusBoots', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['Lamp', 'ProgressiveShield', 'ProgressiveShield', 'ProgressiveShield', 'PegasusBoots', 'MagicMirror', 'TitansMitt', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],

            ["Turtle Rock - Boss", false, []],
            ["Turtle Rock - Boss", false, [], ['CaneOfSomaria']],
            ["Turtle Rock - Boss", false, [], ['IceRod']],
            ["Turtle Rock - Boss", false, [], ['FireRod']],
            ["Turtle Rock - Boss", false, [], ['AnySword', 'Hammer']],
            ["Turtle Rock - Boss", false, [], ['BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'ProgressiveSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'ProgressiveSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'MasterSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'MasterSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'ProgressiveSword', 'ProgressiveSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'ProgressiveSword', 'ProgressiveSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MagicMirror', 'TitansMitt', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'MoonPearl', 'PegasusBoots', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'Lamp', 'PegasusBoots', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
        ];
    }
}