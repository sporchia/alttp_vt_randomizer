<?php

namespace InvertedOverworldGlitches\DeathMountain;

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
            ["Spiral Cave", false, []],
            ["Spiral Cave", true, ['MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'TitansMitt', 'Lamp', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove', 'PegasusBoots', 'UncleSword']],
            ["Spiral Cave", true, ['MagicMirror', 'TitansMitt', 'PegasusBoots', 'UncleSword']],
            ["Spiral Cave", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Far Left", false, []],
            ["Paradox Cave Lower - Far Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Left", false, []],
            ["Paradox Cave Lower - Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Middle", false, []],
            ["Paradox Cave Lower - Middle", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Right", false, []],
            ["Paradox Cave Lower - Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Lower - Far Right", false, []],
            ["Paradox Cave Lower - Far Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Upper - Left", false, []],
            ["Paradox Cave Upper - Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Paradox Cave Upper - Right", false, []],
            ["Paradox Cave Upper - Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Mimic Cave", false, []],
            ["Mimic Cave", false, [], ['MoonPearl']],
            ["Mimic Cave", false, [], ['Hammer']],
            ["Mimic Cave", true, ['MoonPearl', 'Hammer', 'PegasusBoots']],
            
            ["Ether Tablet", false, []],
            ["Ether Tablet", false, [], ['UpgradedSword']],
            ["Ether Tablet", false, [], ['BookOfMudora']],
            ["Ether Tablet", false, [], ['MoonPearl']],
            ["Ether Tablet", true, ['PegasusBoots', 'MoonPearl', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PegasusBoots', 'MoonPearl', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PegasusBoots', 'MoonPearl', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PegasusBoots', 'MoonPearl', 'BookOfMudora', 'L4Sword']],

            ["Spectacle Rock", false, []],
            ["Spectacle Rock", false, [], ['MoonPearl']],
            ["Spectacle Rock", true, ['MoonPearl', 'PegasusBoots']],
        ];
    }
}
