<?php

namespace Inverted;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class WestTest extends TestCase
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
            ["Old Man", false, []],
            ["Old Man", false, [], ['Gloves', 'Flute']],
            ["Old Man", false, [], ['Lamp']],
            ["Old Man", true, ['ProgressiveGlove', 'Lamp']],
            ["Old Man", true, ['PowerGlove', 'Lamp']],
            ["Old Man", true, ['TitansMitt', 'Lamp']],
            ["Old Man", true, ['OcarinaActive', 'Lamp']],

            ["Spectacle Rock Cave", false, []],
            ["Spectacle Rock Cave", false, [], ['Gloves', 'Flute']],
            ["Spectacle Rock Cave", false, [], ['Lamp', 'Flute']],
            ["Spectacle Rock Cave", false, ['Flute', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock Cave", false, ['Flute', 'PowerGlove', 'Hammer']],
            ["Spectacle Rock Cave", false, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock Cave", false, ['Flute', 'TitansMitt']],
            ["Spectacle Rock Cave", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock Cave", true, ['Flute', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Spectacle Rock Cave", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock Cave", true, ['Flute', 'MoonPearl', 'TitansMitt']],
            ["Spectacle Rock Cave", true, ['ProgressiveGlove', 'Lamp']],
            ["Spectacle Rock Cave", true, ['PowerGlove', 'Lamp']],
            ["Spectacle Rock Cave", true, ['TitansMitt', 'Lamp']],
        ];
    }
}
