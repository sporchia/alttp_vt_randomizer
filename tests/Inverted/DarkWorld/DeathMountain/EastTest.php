<?php

namespace Inverted\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class EastTest extends TestCase
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
            ["Superbunny Cave - Top", false, []],
            ["Superbunny Cave - Top", false, [], ['Gloves', 'Flute']],
            ["Superbunny Cave - Top", true, ['ProgressiveGlove', 'Lamp']],
            ["Superbunny Cave - Top", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute']],
            ["Superbunny Cave - Top", true, ['Hammer', 'ProgressiveGlove', 'MoonPearl', 'Flute']],

            ["Superbunny Cave - Bottom", false, []],
            ["Superbunny Cave - Bottom", false, [], ['Gloves', 'Flute']],
            ["Superbunny Cave - Bottom", true, ['ProgressiveGlove', 'Lamp']],
            ["Superbunny Cave - Bottom", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute']],
            ["Superbunny Cave - Bottom", true, ['Hammer', 'ProgressiveGlove', 'MoonPearl', 'Flute']],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", false, [], ['Gloves', 'Flute']],
            ["Hookshot Cave - Bottom Right", false, [], ['PegasusBoots', 'Hookshot']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'Lamp', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'Flute', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute', 'Hookshot']],
            ["Hookshot Cave - Bottom Right", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'Flute', 'Hookshot']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", false, [], ['Gloves', 'Flute']],
            ["Hookshot Cave - Bottom Left", false, [], ['PegasusBoots', 'Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute', 'Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'Flute', 'Hookshot']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", false, [], ['Gloves', 'Flute']],
            ["Hookshot Cave - Top Left", false, [], ['PegasusBoots', 'Hookshot']],
            ["Hookshot Cave - Top Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Top Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute', 'Hookshot']],
            ["Hookshot Cave - Top Left", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'Flute', 'Hookshot']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", false, [], ['Gloves', 'Flute']],
            ["Hookshot Cave - Top Right", false, [], ['PegasusBoots', 'Hookshot']],
            ["Hookshot Cave - Top Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Top Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute', 'Hookshot']],
            ["Hookshot Cave - Top Right", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl', 'Flute', 'Hookshot']],
        ];
    }
}
