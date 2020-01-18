<?php

namespace OverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class MireTest extends TestCase
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
            ["Mire Shed - Left", false, []],
            ["Mire Shed - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Mire Shed - Left", true, ['MagicMirror', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Left", true, ['MagicMirror', 'Flute', 'TitansMitt']],

            ["Mire Shed - Right", false, []],
            ["Mire Shed - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Mire Shed - Right", true, ['MagicMirror', 'Flute', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mire Shed - Right", true, ['MagicMirror', 'Flute', 'TitansMitt']],
        ];
    }
}
