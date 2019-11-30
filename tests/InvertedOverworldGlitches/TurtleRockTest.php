<?php namespace InvertedOverworldGlitches;

use ALttP\Boss;
use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class TurtleRockTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
        $this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake', $this->world));
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

            ["Turtle Rock - Crystaroller Room", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Left", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Bottom Right", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Left", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Eye Bridge - Top Right", true, 'BigKeyD7', [], ['BigKeyD7']],

            ["Turtle Rock - Boss", false, 'BigKeyD7', [], ['BigKeyD7']],
            ["Turtle Rock - Boss", false, 'KeyD7', [], ['KeyD7']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Turtle Rock - Chain Chomps", false, []],
            ["Turtle Rock - Chain Chomps", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Compass Chest", false, []],
            ["Turtle Rock - Compass Chest", false, [], ['CaneOfSomaria']],
            ["Turtle Rock - Compass Chest", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Roller Room - Left", false, []],
            ["Turtle Rock - Roller Room - Left", false, [], ['CaneOfSomaria']],
            ["Turtle Rock - Roller Room - Left", false, [], ['FireRod']],
            ["Turtle Rock - Roller Room - Left", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'CaneOfSomaria', 'FireRod', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Roller Room - Right", false, []],
            ["Turtle Rock - Roller Room - Right", false, [], ['CaneOfSomaria']],
            ["Turtle Rock - Roller Room - Right", false, [], ['FireRod']],
            ["Turtle Rock - Roller Room - Right", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'CaneOfSomaria', 'FireRod', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Big Chest", false, []],
            ["Turtle Rock - Big Chest", false, [], ['BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'Hookshot', 'BigKeyD7']],
            ["Turtle Rock - Big Chest", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'CaneOfSomaria', 'BigKeyD7']],

            ["Turtle Rock - Big Key Chest", false, []],
            ["Turtle Rock - Big Key Chest", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7']],

            ["Turtle Rock - Crystaroller Room", false, []],
            ["Turtle Rock - Crystaroller Room", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'BigKeyD7']],
            ["Turtle Rock - Crystaroller Room", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl', 'Lamp', 'CaneOfSomaria']],

            ["Turtle Rock - Eye Bridge - Bottom Left", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Left", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Eye Bridge - Bottom Right", false, []],
            ["Turtle Rock - Eye Bridge - Bottom Right", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Eye Bridge - Top Left", false, []],
            ["Turtle Rock - Eye Bridge - Top Left", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Eye Bridge - Top Right", false, []],
            ["Turtle Rock - Eye Bridge - Top Right", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Turtle Rock - Boss", false, []],
            ["Turtle Rock - Boss", false, [], ['CaneOfSomaria']],
            ["Turtle Rock - Boss", false, [], ['IceRod']],
            ["Turtle Rock - Boss", false, [], ['FireRod']],
            ["Turtle Rock - Boss", false, [], ['AnySword', 'Hammer']],
            ["Turtle Rock - Boss", false, [], ['BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'UncleSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'ProgressiveSword', 'Bottle', 'Bottle', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'MasterSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'ProgressiveSword', 'ProgressiveSword', 'Bottle', 'Bottle', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'L3Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'L4Sword', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
            ["Turtle Rock - Boss", true, ['IceRod', 'FireRod', 'PegasusBoots', 'MagicMirror', 'MoonPearl', 'Hammer', 'CaneOfSomaria', 'KeyD7', 'KeyD7', 'KeyD7', 'KeyD7', 'BigKeyD7']],
        ];
    }
}
