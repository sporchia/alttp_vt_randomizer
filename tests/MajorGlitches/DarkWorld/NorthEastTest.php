<?php

namespace MajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class NorthEastTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
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
            ["Catfish", true, ['MoonPearl', 'DefeatAgahnim', 'ProgressiveGlove']],
            ["Catfish", true, ['MoonPearl', 'DefeatAgahnim', 'PowerGlove']],
            ["Catfish", true, ['MoonPearl', 'DefeatAgahnim', 'TitansMitt']],
            ["Catfish", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Catfish", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Catfish", true, ['MoonPearl', 'TitansMitt', 'Flippers']],

            ["Pyramid", true, []],

            ["Pyramid Fairy - Sword", false, []],
            ["Pyramid Fairy - Sword", false, [], ['AnySword']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'DefeatAgahnim', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'TitansMitt', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'ProgressiveGlove', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'PowerGlove', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'UncleSword', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'TitansMitt', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'ProgressiveGlove', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'PowerGlove', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Sword", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveSword', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],

            ["Pyramid Fairy - Bow", false, []],
            ["Pyramid Fairy - Bow", false, [], ['AnyBow']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'DefeatAgahnim', 'Hammer']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'TitansMitt', 'Hammer']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'ProgressiveGlove', 'Hammer']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'PowerGlove', 'Hammer']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Bow", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'BowAndArrows', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'TitansMitt', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveGlove', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'PowerGlove', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],

            ["Pyramid Fairy - Right", false, []],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'TitansMitt', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveGlove', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'PowerGlove', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'TitansMitt', 'MagicMirror']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'PowerGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'DefeatAgahnim', 'Flippers', 'Hookshot', 'MagicMirror']],

            ["Ganon", false, []],
            ["Ganon", false, [], ['MoonPearl']],
            ["Ganon", false, [], ['DefeatAgahnim2']],
        ];
    }
}
