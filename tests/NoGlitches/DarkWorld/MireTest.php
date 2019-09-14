<?php

namespace NoGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NoGlitches
 */
class MireTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
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
            ["Mire Shed - Left", false, []],
            ["Mire Shed - Left", false, [], ['Gloves']],
            ["Mire Shed - Left", false, [], ['MoonPearl']],
            ["Mire Shed - Left", false, [], ['Flute']],
            ["Mire Shed - Left", true, ['MoonPearl', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Left", true, ['MoonPearl', 'Flute', 'TitansMitt']],

            ["Mire Shed - Right", false, []],
            ["Mire Shed - Right", false, [], ['Gloves']],
            ["Mire Shed - Right", false, [], ['MoonPearl']],
            ["Mire Shed - Right", false, [], ['Flute']],
            ["Mire Shed - Right", true, ['MoonPearl', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Right", true, ['MoonPearl', 'Flute', 'TitansMitt']],
        ];
    }
}
