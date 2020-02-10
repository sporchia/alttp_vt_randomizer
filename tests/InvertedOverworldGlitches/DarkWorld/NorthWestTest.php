<?php

namespace InvertedOverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class NorthWestTest extends TestCase
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
            ["Brewery", true, []],

            ["C-Shaped House", true, []],

            ["Chest Game", true, []],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", false, [], ['Hammer']],
            ["Hammer Pegs", true, ['Hammer', 'PegasusBoots']],

            ["Bumper Cave", false, []],
            ["Bumper Cave", true, ['PegasusBoots']],

            ["Blacksmith", false, []],
            ["Blacksmith", true, ['MagicMirror', 'PegasusBoots']],
            ["Blacksmith", true, ['ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots', 'MoonPearl']],

            ["Purple Chest", false, []],
            ["Purple Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Purple Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots', 'MoonPearl']],
        ];
    }
}
