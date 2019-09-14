<?php

namespace NoGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NoGlitches
 */
class WestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
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
            ["Ether Tablet", false, []],
            ["Ether Tablet", false, [], ['Gloves', 'Flute']],
            ["Ether Tablet", false, [], ['Lamp', 'Flute']],
            ["Ether Tablet", false, [], ['MagicMirror', 'Hookshot']],
            ["Ether Tablet", false, [], ['MagicMirror', 'Hammer']],
            ["Ether Tablet", false, [], ['UpgradedSword']],
            ["Ether Tablet", false, [], ['BookOfMudora']],
            ["Ether Tablet", true, ['Flute', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['Flute', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['Flute', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['Flute', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['Flute', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['Flute', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['Flute', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['Flute', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],

            ["Old Man", false, []],
            ["Old Man", false, [], ['Gloves', 'Flute']],
            ["Old Man", false, [], ['Lamp']],
            ["Old Man", true, ['Flute', 'Lamp']],
            ["Old Man", true, ['ProgressiveGlove', 'Lamp']],
            ["Old Man", true, ['PowerGlove', 'Lamp']],
            ["Old Man", true, ['TitansMitt', 'Lamp']],

            ["Spectacle Rock Cave", false, []],
            ["Spectacle Rock Cave", false, [], ['Gloves', 'Flute']],
            ["Spectacle Rock Cave", true, ['Flute']],
            ["Spectacle Rock Cave", true, ['ProgressiveGlove', 'Lamp']],
            ["Spectacle Rock Cave", true, ['PowerGlove', 'Lamp']],
            ["Spectacle Rock Cave", true, ['TitansMitt', 'Lamp']],

            ["Spectacle Rock", false, []],
            ["Spectacle Rock", false, [], ['Gloves', 'Flute']],
            ["Spectacle Rock", false, [], ['MagicMirror']],
            ["Spectacle Rock", true, ['Flute', 'MagicMirror']],
            ["Spectacle Rock", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
            ["Spectacle Rock", true, ['PowerGlove', 'Lamp', 'MagicMirror']],
            ["Spectacle Rock", true, ['TitansMitt', 'Lamp', 'MagicMirror']],
        ];
    }
}
