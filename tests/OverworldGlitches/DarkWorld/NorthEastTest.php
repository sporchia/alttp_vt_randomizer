<?php

namespace OverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class NorthEastTest extends TestCase
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
            ["Catfish", false, []],
            ["Catfish", false, [], ['MoonPearl']],
            ["Catfish", true, ['MoonPearl', 'PegasusBoots']],

            ["Pyramid", false, []],
            ["Pyramid", true, ['MoonPearl', 'PegasusBoots']],

            ["Pyramid Fairy - Sword", false, []],
            ["Pyramid Fairy - Sword", false, [], ['AnySword']],
            ["Pyramid Fairy - Sword", true, ['MagicMirror', 'PegasusBoots', 'UncleSword']],
            ["Pyramid Fairy - Sword", true, ['MagicMirror', 'PegasusBoots', 'ProgressiveSword']],

            ["Pyramid Fairy - Bow", false, []],
            ["Pyramid Fairy - Bow", false, [], ['AnyBow']],
            ["Pyramid Fairy - Bow", true, ['MagicMirror', 'PegasusBoots', 'BowAndArrows']],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", true, ['MagicMirror', 'PegasusBoots']],

            ["Pyramid Fairy - Right", false, []],
            ["Pyramid Fairy - Right", true, ['MagicMirror', 'PegasusBoots']],

            ["Ganon", false, []],
            ["Ganon", false, [], ['MoonPearl']],
            ["Ganon", false, [], ['DefeatAgahnim2']],
        ];
    }
}
