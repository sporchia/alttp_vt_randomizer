<?php

namespace Inverted;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class HyruleCastleEscapeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
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
            ["Sanctuary", False, [], ['MoonPearl']],
            ["Sanctuary", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Sanctuary", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sanctuary", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sanctuary", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sanctuary", true, ['MoonPearl', 'TitansMitt']],
            
            ["Sewers - Secret Room - Left", false, []],
            ["Sewers - Secret Room - Left", false, [], ['MoonPearl']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove', 'DefeatAgahnim']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'PowerGlove', 'DefeatAgahnim']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'DefeatAgahnim', 'Lamp', 'KeyH2']],
            
            ["Sewers - Secret Room - Middle", false, []],
            ["Sewers - Secret Room - Middle", false, [], ['MoonPearl']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'DefeatAgahnim']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'PowerGlove', 'DefeatAgahnim']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'DefeatAgahnim', 'Lamp', 'KeyH2']],
            
            ["Sewers - Secret Room - Right", false, []],
            ["Sewers - Secret Room - Right", false, [], ['MoonPearl']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove', 'DefeatAgahnim']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'PowerGlove', 'DefeatAgahnim']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'DefeatAgahnim', 'Lamp', 'KeyH2']],
            
            ["Sewers - Dark Cross", False, []],
            ["Sewers - Dark Cross", False, [], ['Lamp']],
            ["Sewers - Dark Cross", False, [], ['MoonPearl']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MoonPearl', 'DefeatAgahnim']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MoonPearl', 'TitansMitt']],
            
            ["Hyrule Castle - Boomerang Chest", false, []],
            ["Hyrule Castle - Boomerang Chest", false, [], ['KeyH2']],
            ["Hyrule Castle - Boomerang Chest", false, [], ['MoonPearl']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'DefeatAgahnim']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'TitansMitt']],

            ["Hyrule Castle - Map Chest", false, []],
            ["Hyrule Castle - Map Chest", false, [], ['MoonPearl']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'TitansMitt']],

            ["Hyrule Castle - Zelda's Cell", false, []],
            ["Hyrule Castle - Zelda's Cell", false, [], ['KeyH2']],
            ["Hyrule Castle - Zelda's Cell", false, [], ['MoonPearl']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'DefeatAgahnim']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'TitansMitt']],
        ];
    }
}
