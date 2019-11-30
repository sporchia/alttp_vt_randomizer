<?php

namespace OverworldGlitches\DarkWorld\DeathMountain;

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
            ["Superbunny Cave - Top", false, []],
            ["Superbunny Cave - Top", true, ['ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots']],
            ["Superbunny Cave - Top", true, ['TitansMitt', 'PegasusBoots']],
            ["Superbunny Cave - Top", true, ['Hammer', 'PegasusBoots']],
            ["Superbunny Cave - Top", true, ['MoonPearl', 'PegasusBoots']],

            ["Superbunny Cave - Bottom", false, []],
            ["Superbunny Cave - Bottom", true, ['ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots']],
            ["Superbunny Cave - Bottom", true, ['TitansMitt', 'PegasusBoots']],
            ["Superbunny Cave - Bottom", true, ['Hammer', 'PegasusBoots']],
            ["Superbunny Cave - Bottom", true, ['MoonPearl', 'PegasusBoots']],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", false, [], ['Gloves', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", false, [], ['MoonPearl']],
            ["Hookshot Cave - Bottom Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", false, [], ['Gloves', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Left", false, [], ['MoonPearl']],
            ["Hookshot Cave - Bottom Left", false, [], ['Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['MoonPearl', 'PegasusBoots', 'Hookshot']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", false, [], ['Gloves', 'PegasusBoots']],
            ["Hookshot Cave - Top Left", false, [], ['MoonPearl']],
            ["Hookshot Cave - Top Left", false, [], ['Hookshot']],
            ["Hookshot Cave - Top Left", true, ['MoonPearl', 'PegasusBoots', 'Hookshot']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", false, [], ['Gloves', 'PegasusBoots']],
            ["Hookshot Cave - Top Right", false, [], ['MoonPearl']],
            ["Hookshot Cave - Top Right", false, [], ['Hookshot']],
            ["Hookshot Cave - Top Right", true, ['MoonPearl', 'PegasusBoots', 'Hookshot']],
        ];
    }
}
