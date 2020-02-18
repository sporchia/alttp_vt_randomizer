<?php

namespace InvertedMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class HyruleCastleTowerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
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
            [true, ['UncleSword']],
            [true, ['Hammer']],
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
            [true, ['KeyA1', 'KeyA1', 'Lamp', 'UncleSword']],
            [true, ['KeyA1', 'KeyA1', 'Lamp', 'ProgressiveSword']],
            [true, ['KeyA1', 'KeyA1', 'Lamp', 'MasterSword']],
            [true, ['KeyA1', 'KeyA1', 'Lamp', 'L3Sword']],
            [true, ['KeyA1', 'KeyA1', 'Lamp', 'L4Sword']],
        ];
    }
}
