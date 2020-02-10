<?php

namespace Inverted\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class NorthWestTest extends TestCase
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
            ["Hammer Pegs", false, [], ['Gloves', 'MagicMirror']],
            ["Hammer Pegs", true, ['Hammer', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hammer Pegs", true, ['Hammer', 'TitansMitt']],
            ["Hammer Pegs", true, ['Hammer', 'ProgressiveGlove', 'MagicMirror', 'MoonPearl']],
            ["Hammer Pegs", true, ['Hammer', 'DefeatAgahnim', 'MagicMirror']],

            ["Bumper Cave", false, []],
            ["Bumper Cave", false, [], ['MoonPearl']],
            ["Bumper Cave", false, [], ['Cape']],
            ["Bumper Cave", false, [], ['Gloves']],
            ["Bumper Cave", false, [], ['MagicMirror']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'TitansMitt']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'PowerGlove', 'Hammer']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'DefeatAgahnim', 'ProgressiveGlove']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'DefeatAgahnim', 'PowerGlove']],

            ["Blacksmith", false, []],
            ["Blacksmith", false, [], ['Gloves', 'MagicMirror']],
            ["Blacksmith", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Blacksmith", true, ['TitansMitt', 'MoonPearl']],
            ["Blacksmith", true, ['DefeatAgahnim', 'MagicMirror']],
            ["Blacksmith", true, ['ProgressiveGlove', 'Hammer', 'MagicMirror', 'MoonPearl']],

            ["Purple Chest", false, []],
            ["Purple Chest", false, [], ['Gloves', 'MagicMirror']],
            ["Purple Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Purple Chest", true, ['TitansMitt', 'MoonPearl']],
            ["Purple Chest", true, ['DefeatAgahnim', 'MagicMirror']],
            ["Purple Chest", true, ['ProgressiveGlove', 'Hammer', 'MagicMirror', 'MoonPearl']],
        ];
    }
}
