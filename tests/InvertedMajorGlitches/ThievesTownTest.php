<?php

namespace InvertedMajorGlitches;

use ALttP\Boss;
use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class ThievesTownTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
        $this->world->getRegion('Thieves Town')->setBoss(new Boss("Dummy Boss"));
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
     * @param array $keys
     * @param string $big_key
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
            ["Thieves' Town - Attic", false, 'BigKeyD4', [], ['BigKeyD4']],
            ["Thieves' Town - Attic", false, 'KeyD4', [], ['KeyD4']],

            ["Thieves' Town - Big Key Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Map Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Compass Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Ambush Chest", true, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Big Chest", false, 'BigKeyD4', [], ['BigKeyD4']],
            ["Thieves' Town - Big Chest", true, 'KeyD4', [], ['KeyD4']],

            ["Thieves' Town - Blind's Cell", false, 'BigKeyD4', [], ['BigKeyD4']],

            ["Thieves' Town - Boss", false, 'BigKeyD4', [], ['BigKeyD4']],
            ["Thieves' Town - Boss", false, 'KeyD4', [], ['KeyD4']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Thieves' Town - Attic", false, []],
            ["Thieves' Town - Attic", false, [], ['BigKeyD4']],
            ["Thieves' Town - Attic", false, [], ['KeyD4']],
            ["Thieves' Town - Attic", true, ['BigKeyD4', 'KeyD4']],

            ["Thieves' Town - Big Key Chest", true, []],

            ["Thieves' Town - Map Chest", true, []],

            ["Thieves' Town - Compass Chest", true, []],

            ["Thieves' Town - Ambush Chest", true, []],

            ["Thieves' Town - Big Chest", false, []],
            ["Thieves' Town - Big Chest", false, [], ['BigKeyD4']],
            ["Thieves' Town - Big Chest", false, [], ['Hammer']],
            ["Thieves' Town - Big Chest", true, ['Hammer', 'KeyD4', 'BigKeyD4']],

            ["Thieves' Town - Blind's Cell", false, []],
            ["Thieves' Town - Blind's Cell", false, [], ['BigKeyD4']],
            ["Thieves' Town - Blind's Cell", true, ['BigKeyD4']],

            ["Thieves' Town - Boss", false, []],
            ["Thieves' Town - Boss", false, [], ['BigKeyD4']],
            ["Thieves' Town - Boss", false, [], ['KeyD4']],
            ["Thieves' Town - Boss", true, ['KeyD4', 'BigKeyD4']],
        ];
    }
}
