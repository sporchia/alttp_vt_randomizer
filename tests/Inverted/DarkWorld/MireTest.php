<?php

namespace Inverted\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class MireTest extends TestCase
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
            ["Mire Shed - Left", false, []],
            ["Mire Shed - Left", false, [], ['Flute', 'MagicMirror']],
            ["Mire Shed - Left", true, ['MoonPearl', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Left", true, ['MoonPearl', 'Flute', 'ProgressiveGlove', 'Hammer']],
            ["Mire Shed - Left", true, ['MoonPearl', 'Flute', 'DefeatAgahnim']],
            ["Mire Shed - Left", true, ['MagicMirror', 'DefeatAgahnim']],

            ["Mire Shed - Right", false, []],
            ["Mire Shed - Right", false, [], ['Flute', 'MagicMirror']],
            ["Mire Shed - Right", true, ['MoonPearl', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Right", true, ['MoonPearl', 'Flute', 'ProgressiveGlove', 'Hammer']],
            ["Mire Shed - Right", true, ['MoonPearl', 'Flute', 'DefeatAgahnim']],
            ["Mire Shed - Right", true, ['MagicMirror', 'DefeatAgahnim']],
        ];
    }
}
