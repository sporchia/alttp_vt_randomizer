<?php

namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class GanonsTowerTest extends TestCase
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
            ["Ganon's Tower - Bob's Torch", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - DMs Room - Top Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - DMs Room - Top Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - DMs Room - Bottom Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - DMs Room - Bottom Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Randomizer Room - Top Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Randomizer Room - Top Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Randomizer Room - Bottom Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Randomizer Room - Bottom Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Firesnake Room", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Map Chest", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Big Chest", false, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Hope Room - Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Hope Room - Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Bob's Chest", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Tile Room", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Compass Room - Top Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Compass Room - Top Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Compass Room - Bottom Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Compass Room - Bottom Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Big Key Chest", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Big Key Room - Left", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Big Key Room - Right", true, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Mini Helmasaur Room - Left", false, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Mini Helmasaur Room - Right", false, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Pre-Moldorm Chest", false, 'BigKeyA2', [], ['BigKeyA2']],

            ["Ganon's Tower - Moldorm Chest", false, 'BigKeyA2', [], ['BigKeyA2']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Ganon's Tower - Bob's Torch", false, []],
            ["Ganon's Tower - Bob's Torch", false, [], ['PegasusBoots']],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Torch", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - DMs Room - Top Left", false, []],
            ["Ganon's Tower - DMs Room - Top Left", false, [], ['Hammer']],
            ["Ganon's Tower - DMs Room - Top Left", false, [], ['Hookshot']],
            ["Ganon's Tower - DMs Room - Top Left", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Top Left", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Top Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Top Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - DMs Room - Top Right", false, []],
            ["Ganon's Tower - DMs Room - Top Right", false, [], ['Hammer']],
            ["Ganon's Tower - DMs Room - Top Right", false, [], ['Hookshot']],
            ["Ganon's Tower - DMs Room - Top Right", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Top Right", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Top Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Top Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - DMs Room - Bottom Left", false, []],
            ["Ganon's Tower - DMs Room - Bottom Left", false, [], ['Hammer']],
            ["Ganon's Tower - DMs Room - Bottom Left", false, [], ['Hookshot']],
            ["Ganon's Tower - DMs Room - Bottom Left", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Bottom Left", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Bottom Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Bottom Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - DMs Room - Bottom Right", false, []],
            ["Ganon's Tower - DMs Room - Bottom Right", false, [], ['Hammer']],
            ["Ganon's Tower - DMs Room - Bottom Right", false, [], ['Hookshot']],
            ["Ganon's Tower - DMs Room - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Bottom Right", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - DMs Room - Bottom Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Randomizer Room - Top Left", false, []],
            ["Ganon's Tower - Randomizer Room - Top Left", false, [], ['Hammer']],
            ["Ganon's Tower - Randomizer Room - Top Left", false, [], ['Hookshot']],
            ["Ganon's Tower - Randomizer Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Randomizer Room - Top Right", false, []],
            ["Ganon's Tower - Randomizer Room - Top Right", false, [], ['Hammer']],
            ["Ganon's Tower - Randomizer Room - Top Right", false, [], ['Hookshot']],
            ["Ganon's Tower - Randomizer Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Randomizer Room - Bottom Left", false, []],
            ["Ganon's Tower - Randomizer Room - Bottom Left", false, [], ['Hammer']],
            ["Ganon's Tower - Randomizer Room - Bottom Left", false, [], ['Hookshot']],
            ["Ganon's Tower - Randomizer Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Randomizer Room - Bottom Right", false, []],
            ["Ganon's Tower - Randomizer Room - Bottom Right", false, [], ['Hammer']],
            ["Ganon's Tower - Randomizer Room - Bottom Right", false, [], ['Hookshot']],
            ["Ganon's Tower - Randomizer Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Randomizer Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Firesnake Room", false, []],
            ["Ganon's Tower - Firesnake Room", false, [], ['Hammer']],
            ["Ganon's Tower - Firesnake Room", false, [], ['Hookshot']],
            ["Ganon's Tower - Firesnake Room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Firesnake Room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Firesnake Room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Firesnake Room", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Map Chest", false, []],
            ["Ganon's Tower - Map Chest", false, [], ['Hammer']],
            ["Ganon's Tower - Map Chest", false, [], ['Hookshot', 'PegasusBoots']],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Map Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'PegasusBoots', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Big Chest", false, []],
            ["Ganon's Tower - Big Chest", false, [], ['BigKeyA2']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Chest", true, ['BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Hope Room - Left", true, []],

            ["Ganon's Tower - Hope Room - Right", true, []],

            ["Ganon's Tower - Bob's Chest", false, []],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Bob's Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Tile Room", false, []],
            ["Ganon's Tower - Tile Room", false, [], ['CaneOfSomaria']],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Tile Room", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Compass Room - Top Left", false, []],
            ["Ganon's Tower - Compass Room - Top Left", false, [], ['CaneOfSomaria']],
            ["Ganon's Tower - Compass Room - Top Left", false, [], ['FireRod']],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Compass Room - Top Right", false, []],
            ["Ganon's Tower - Compass Room - Top Right", false, [], ['CaneOfSomaria']],
            ["Ganon's Tower - Compass Room - Top Right", false, [], ['FireRod']],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Top Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Compass Room - Bottom Left", false, []],
            ["Ganon's Tower - Compass Room - Bottom Left", false, [], ['CaneOfSomaria']],
            ["Ganon's Tower - Compass Room - Bottom Left", false, [], ['FireRod']],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Compass Room - Bottom Right", false, []],
            ["Ganon's Tower - Compass Room - Bottom Right", false, [], ['CaneOfSomaria']],
            ["Ganon's Tower - Compass Room - Bottom Right", false, [], ['FireRod']],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Compass Room - Bottom Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'FireRod', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Big Key Chest", false, []],
            ["Ganon's Tower - Big Key Chest", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Chest", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Big Key Room - Left", false, []],
            ["Ganon's Tower - Big Key Room - Left", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Left", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Big Key Room - Right", false, []],
            ["Ganon's Tower - Big Key Room - Right", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['UncleSword', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Big Key Room - Right", true, ['KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'CaneOfSomaria', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Mini Helmasaur Room - Left", false, []],
            ["Ganon's Tower - Mini Helmasaur Room - Left", false, [], ['AnyBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", false, [], ['BigKeyA2']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Left", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Mini Helmasaur Room - Right", false, []],
            ["Ganon's Tower - Mini Helmasaur Room - Right", false, [], ['AnyBow']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", false, [], ['BigKeyA2']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Mini Helmasaur Room - Right", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Pre-Moldorm Chest", false, []],
            ["Ganon's Tower - Pre-Moldorm Chest", false, [], ['AnyBow']],
            ["Ganon's Tower - Pre-Moldorm Chest", false, [], ['BigKeyA2']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Pre-Moldorm Chest", true, ['BowAndArrows', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'MagicMirror', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],

            ["Ganon's Tower - Moldorm Chest", false, []],
            ["Ganon's Tower - Moldorm Chest", false, [], ['Hookshot']],
            ["Ganon's Tower - Moldorm Chest", false, [], ['AnyBow']],
            ["Ganon's Tower - Moldorm Chest", false, [], ['BigKeyA2']],
            ["Ganon's Tower - Moldorm Chest", true, ['BowAndArrows', 'UncleSword', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Moldorm Chest", true, ['BowAndArrows', 'UncleSword', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'TitansMitt', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Moldorm Chest", true, ['BowAndArrows', 'UncleSword', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'Hookshot', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
            ["Ganon's Tower - Moldorm Chest", true, ['BowAndArrows', 'UncleSword', 'BigKeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'KeyA2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Flute', 'Hookshot', 'Hammer', 'FireRod', 'Crystal1', 'Crystal2', 'Crystal3', 'Crystal4', 'Crystal5', 'Crystal6', 'Crystal7']],
        ];
    }
}
