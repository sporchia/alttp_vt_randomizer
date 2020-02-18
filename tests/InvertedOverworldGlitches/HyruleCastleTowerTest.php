<?php

namespace InvertedOverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class HyruleCastleTowerTest extends TestCase
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
            [true, ['PegasusBoots', 'UncleSword']],
            [true, ['PegasusBoots', 'Hammer']],
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
            [true, ['KeyA1', 'KeyA1', 'PegasusBoots', 'Lamp', 'UncleSword']],
            [true, ['KeyA1', 'KeyA1', 'PegasusBoots', 'Lamp', 'ProgressiveSword']],
            [true, ['KeyA1', 'KeyA1', 'PegasusBoots', 'Lamp', 'MasterSword']],
            [true, ['KeyA1', 'KeyA1', 'PegasusBoots', 'Lamp', 'L3Sword']],
            [true, ['KeyA1', 'KeyA1', 'PegasusBoots', 'Lamp', 'L4Sword']],
        ];
    }
}
