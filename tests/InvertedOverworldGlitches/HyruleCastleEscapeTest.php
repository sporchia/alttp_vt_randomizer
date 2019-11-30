<?php

namespace InvertedOverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class HyruleCastleEscapeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
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

    /**
     * @param string $location
     * @param bool $access
     * @param string $item
     * @param array $items
     * @param array $except
     *
     * @dataProvider fillPool
     */
    public function testFillLocation(string $location, bool $access, string $item, array $items = [], array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getLocation($location)
            ->fill(Item::get($item, $this->world), $this->collected));
    }

    public function fillPool()
    {
        return [

            ["Sanctuary", true, 'KeyH2', [], ['KeyH2']],

            ["Sewers - Secret Room - Left", true, 'KeyH2', [], ['KeyH2']],

            ["Sewers - Secret Room - Middle", true, 'KeyH2', [], ['KeyH2']],

            ["Sewers - Secret Room - Right", true, 'KeyH2', [], ['KeyH2']],

            ["Sewers - Dark Cross", true, 'KeyH2', [], ['KeyH2']],

            ["Hyrule Castle - Boomerang Chest", false, 'KeyH2', [], ['KeyH2']],

            ["Hyrule Castle - Map Chest", true, 'KeyH2', [], ['KeyH2']],

            ["Hyrule Castle - Zelda's Cell", false, 'KeyH2', [], ['KeyH2']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Sanctuary", False, []],
            ["Sanctuary", true, ['DefeatAgahnim']],
            ["Sanctuary", true, ['MoonPearl', 'PegasusBoots']],
            ["Sanctuary", true, ['MagicMirror', 'PegasusBoots']],
            
            ["Sewers - Secret Room - Left", false, []],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove', 'PegasusBoots']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Left", true, ['MagicMirror', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Left", true, ['DefeatAgahnim', 'Lamp', 'KeyH2']],
            
            ["Sewers - Secret Room - Middle", false, []],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'PegasusBoots']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Middle", true, ['MagicMirror', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Middle", true, ['DefeatAgahnim', 'Lamp', 'KeyH2']],
            
            ["Sewers - Secret Room - Right", false, []],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove', 'PegasusBoots']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Right", true, ['MagicMirror', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Right", true, ['DefeatAgahnim', 'Lamp', 'KeyH2']],
            
            ["Sewers - Dark Cross", False, []],
            ["Sewers - Dark Cross", False, [], ['Lamp']],
            ["Sewers - Dark Cross", true, ['Lamp', 'DefeatAgahnim']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MoonPearl', 'PegasusBoots']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MagicMirror', 'PegasusBoots']],
            
            ["Hyrule Castle - Boomerang Chest", false, []],
            ["Hyrule Castle - Boomerang Chest", false, [], ['KeyH2']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'DefeatAgahnim']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'PegasusBoots']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MagicMirror', 'PegasusBoots']],

            ["Hyrule Castle - Map Chest", false, []],
            ["Hyrule Castle - Map Chest", true, ['DefeatAgahnim']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'PegasusBoots']],
            ["Hyrule Castle - Map Chest", true, ['MagicMirror', 'PegasusBoots']],

            ["Hyrule Castle - Zelda's Cell", false, []],
            ["Hyrule Castle - Zelda's Cell", false, [], ['KeyH2']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'DefeatAgahnim']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'PegasusBoots']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MagicMirror', 'PegasusBoots']],
        ];
    }
}
