<?php

namespace InvertedMajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class NorthWestTest extends TestCase
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
            ["Hammer Pegs", true, ['Hammer']],

            ["Bumper Cave", true, []],

            ["Blacksmith", false, []],
            ["Blacksmith", true, ['MagicMirror']],
            ["Blacksmith", true, ['Bottle']],
            ["Blacksmith", true, ['ProgressiveGlove', 'ProgressiveGlove']],

            ["Purple Chest", false, []],
            ["Purple Chest", true, ['MagicMirror']],
            ["Purple Chest", true, ['Bottle']],
            ["Purple Chest", true, ['ProgressiveGlove', 'ProgressiveGlove']],
        ];
    }
}
