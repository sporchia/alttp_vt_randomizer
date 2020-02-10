<?php

namespace Inverted;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class HyruleCastleTowerTest extends TestCase
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
     * @param bool $access
     * @param array $items
     * @param array $except
     *
     * @dataProvider entryPool
     */
    public function testEntry(bool $access, array $items, array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getRegion('Hyrule Castle Tower')
            ->canEnter($this->world->getLocations(), $this->collected));
    }

    public function entryPool()
    {
        return [
            [false, []],
            [false, [], ['Flute', 'Gloves']],
            [false, [], ['Flute', 'Lamp']],
            [true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            [true, ['Flute', 'MoonPearl', 'PowerGlove', 'Hammer']],
            [true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'UncleSword']],
            [true, ['Flute', 'MoonPearl', 'TitansMitt', 'UncleSword']],
            [true, ['ProgressiveGlove', 'Lamp', 'UncleSword']],
            [true, ['PowerGlove', 'Lamp', 'UncleSword']],
            [true, ['TitansMitt', 'Lamp', 'UncleSword']],
        ];
    }

    /**
     * @param bool $access
     * @param array $items
     * @param array $except
     *
     * @dataProvider completePool
     */
    public function testComplete(bool $access, array $items, array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getRegion('Hyrule Castle Tower')
            ->canComplete($this->world->getLocations(), $this->collected));
    }

    public function completePool()
    {
        return [
            [false, []],
            [false, [], ['Lamp']],
            [false, [], ['AnySword']],
            [true, ['KeyA1', 'KeyA1', 'ProgressiveGlove', 'Lamp', 'UncleSword']],
            [true, ['KeyA1', 'KeyA1', 'PowerGlove', 'Lamp', 'UncleSword']],
            [true, ['KeyA1', 'KeyA1', 'TitansMitt', 'Lamp', 'UncleSword']],
            [true, ['KeyA1', 'KeyA1', 'ProgressiveGlove', 'Lamp', 'ProgressiveSword']],
            [true, ['KeyA1', 'KeyA1', 'PowerGlove', 'Lamp', 'ProgressiveSword']],
            [true, ['KeyA1', 'KeyA1', 'TitansMitt', 'Lamp', 'ProgressiveSword']],
            [true, ['KeyA1', 'KeyA1', 'ProgressiveGlove', 'Lamp', 'MasterSword']],
            [true, ['KeyA1', 'KeyA1', 'PowerGlove', 'Lamp', 'MasterSword']],
            [true, ['KeyA1', 'KeyA1', 'TitansMitt', 'Lamp', 'MasterSword']],
            [true, ['KeyA1', 'KeyA1', 'ProgressiveGlove', 'Lamp', 'L3Sword']],
            [true, ['KeyA1', 'KeyA1', 'PowerGlove', 'Lamp', 'L3Sword']],
            [true, ['KeyA1', 'KeyA1', 'TitansMitt', 'Lamp', 'L3Sword']],
            [true, ['KeyA1', 'KeyA1', 'ProgressiveGlove', 'Lamp', 'L4Sword']],
            [true, ['KeyA1', 'KeyA1', 'PowerGlove', 'Lamp', 'L4Sword']],
            [true, ['KeyA1', 'KeyA1', 'TitansMitt', 'Lamp', 'L4Sword']],
        ];
    }
}
