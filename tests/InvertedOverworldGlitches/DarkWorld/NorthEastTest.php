<?php

namespace InvertedOverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class NorthEastTest extends TestCase
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
            ["Catfish", false, []],
            ["Catfish", true, ['PegasusBoots']],

            ["Pyramid", true, []],
            
            ["Pyramid Fairy - Sword", false, []],
            ["Pyramid Fairy - Sword", false, [], ['MagicMirror']],
            ["Pyramid Fairy - Sword", false, [], ['BigRedBomb']],
            ["Pyramid Fairy - Sword", false, [], ['AnySword']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'UncleSword', 'MagicMirror', 'PegasusBoots']],

            ["Pyramid Fairy - Bow", false, []],
            ["Pyramid Fairy - Bow", false, [], ['MagicMirror']],
            ["Pyramid Fairy - Bow", false, [], ['BigRedBomb']],
            ["Pyramid Fairy - Bow", false, [], ['AnyBow']],
            ["Pyramid Fairy - Bow", true, ['BigRedBomb', 'BowAndArrows', 'MagicMirror', 'PegasusBoots']],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", false, [], ['MagicMirror']],
            ["Pyramid Fairy - Left", false, [], ['BigRedBomb']],
            ["Pyramid Fairy - Left", true, ['BigRedBomb', 'MagicMirror', 'PegasusBoots']],

            ["Pyramid Fairy - Right", false, []],
            ["Pyramid Fairy - Right", false, [], ['MagicMirror']],
            ["Pyramid Fairy - Right", false, [], ['BigRedBomb']],
            ["Pyramid Fairy - Right", true, ['BigRedBomb', 'MagicMirror', 'PegasusBoots']],
        ];
    }
}
