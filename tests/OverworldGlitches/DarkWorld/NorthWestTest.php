<?php

namespace OverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class NorthWestTest extends TestCase
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

    public function accessPool()
    {
        return [
            ["Brewery", false, []],
            ["Brewery", false, [], ['MoonPearl']],
            ["Brewery", true, ['MoonPearl', 'PegasusBoots']],

            ["C-Shaped House", false, []],
            ["C-Shaped House", true, ['MoonPearl', 'PegasusBoots']],
            ["C-Shaped House", true, ['MagicMirror', 'PegasusBoots']],

            ["Chest Game", false, []],
            ["Chest Game", true, ['MoonPearl', 'PegasusBoots']],
            ["Chest Game", true, ['MagicMirror', 'PegasusBoots']],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", false, [], ['MoonPearl']],
            ["Hammer Pegs", false, [], ['Hammer']],
            ["Hammer Pegs", true, ['MoonPearl', 'Hammer', 'PegasusBoots']],

            ["Bumper Cave", false, []],
            ["Bumper Cave", true, ['MoonPearl', 'PegasusBoots']],

            ["Blacksmith", false, []],
            ["Blacksmith", false, [], ['MoonPearl']],
            ["Blacksmith", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blacksmith", true, ['MoonPearl', 'TitansMitt']],

            ["Purple Chest", false, []],
            ["Purple Chest", false, [], ['MoonPearl']],
            ["Purple Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Purple Chest", true, ['MoonPearl', 'TitansMitt']],
        ];
    }
}
