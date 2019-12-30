<?php

namespace InvertedOverworldGlitches\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class EastTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
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
            ["Superbunny Cave - Top", true, ['PegasusBoots']],

            ["Superbunny Cave - Bottom", false, []],
            ["Superbunny Cave - Bottom", true, ['PegasusBoots']],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", false, [], ['Hookshot', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", false, [], ['Gloves', 'PegasusBoots', 'MagicMirror']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", false, [], ['Hookshot']],
            ["Hookshot Cave - Bottom Left", false, [], ['Gloves', 'PegasusBoots', 'MagicMirror']],
            ["Hookshot Cave - Bottom Left", true, ['PegasusBoots', 'Hookshot']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", false, [], ['Hookshot']],
            ["Hookshot Cave - Top Left", false, [], ['Gloves', 'PegasusBoots', 'MagicMirror']],
            ["Hookshot Cave - Top Left", true, ['PegasusBoots', 'Hookshot']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", false, [], ['Hookshot']],
            ["Hookshot Cave - Top Right", false, [], ['Gloves', 'PegasusBoots', 'MagicMirror']],
            ["Hookshot Cave - Top Right", true, ['PegasusBoots', 'Hookshot']],
        ];
    }
}
