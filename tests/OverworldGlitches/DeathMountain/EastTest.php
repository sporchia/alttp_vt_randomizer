<?php

namespace OverworldGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class EastTest extends TestCase
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
            ["Spiral Cave", false, []],
            ["Spiral Cave", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Far Left", false, []],
            ["Paradox Cave Lower - Far Left", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Left", false, []],
            ["Paradox Cave Lower - Left", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Middle", false, []],
            ["Paradox Cave Lower - Middle", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Right", false, []],
            ["Paradox Cave Lower - Right", true, ['PegasusBoots']],

            ["Paradox Cave Lower - Far Right", false, []],
            ["Paradox Cave Lower - Far Right", true, ['PegasusBoots']],

            ["Paradox Cave Upper - Left", false, []],
            ["Paradox Cave Lower - Left", true, ['PegasusBoots']],

            ["Paradox Cave Upper - Right", false, []],
            ["Paradox Cave Lower - Right", true, ['PegasusBoots']],
            
            ["Mimic Cave", false, []],
            ["Mimic Cave", false, [], ['MagicMirror']],
            ["Mimic Cave", false, [], ['Hammer']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'PegasusBoots']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'ProgressiveGlove', 'Lamp']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'PowerGlove', 'Lamp']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'TitansMitt', 'Lamp']],
            ["Mimic Cave", true, ['MagicMirror', 'Hammer', 'Flute']],
        ];
    }
}
