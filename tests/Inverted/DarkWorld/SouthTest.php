<?php

namespace Inverted\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class SouthTest extends TestCase
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
            ["Hype Cave - Top", true, []],

            ["Hype Cave - Middle Right", true, []],

            ["Hype Cave - Middle Left", true, []],

            ["Hype Cave - Bottom", true, []],

            ["Hype Cave - NPC", true, []],

            ["Stumpy", true, []],

            ["Digging Game", true, []],

            ["Link's House", true, []],
        ];
    }
}
