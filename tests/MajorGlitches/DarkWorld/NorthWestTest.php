<?php

namespace MajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class NorthWestTest extends TestCase
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

    public function accessPool()
    {
        return [
            ["Brewery", false, []],
            ["Brewery", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Brewery", true, ['MoonPearl', 'TitansMitt']],
            ["Brewery", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Brewery", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Brewery", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
            ["Brewery", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove', 'Hookshot']],
            ["Brewery", true, ['MoonPearl', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

            ["C-Shaped House", true, []],

            ["Chest Game", true, []],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", false, [], ['Hammer']],
            ["Hammer Pegs", true, ['MoonPearl', 'Hammer', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hammer Pegs", true, ['MoonPearl', 'Hammer', 'TitansMitt']],

            ["Bumper Cave", true, []],

            ["Blacksmith", false, []],
            ["Blacksmith", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blacksmith", true, ['MoonPearl', 'TitansMitt']],

            ["Purple Chest", false, []],
            ["Purple Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Purple Chest", true, ['MoonPearl', 'TitansMitt']],
        ];
    }
}
