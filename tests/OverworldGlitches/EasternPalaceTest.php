<?php

namespace OverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class EasternPalaceTest extends TestCase
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

    // Entry
    public function testNothingRequiredToEnter()
    {
        $this->assertTrue($this->world->getRegion('Eastern Palace')
            ->canEnter($this->world->getLocations(), $this->collected));
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
            ["Eastern Palace - Compass Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Cannonball Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Big Chest", false, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Map Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Big Key Chest", true, 'BigKeyP1', [], ['BigKeyP1']],

            ["Eastern Palace - Boss", false, 'BigKeyP1', [], ['BigKeyP1']],
        ];
    }

    public function accessPool()
    {
        return [
            ["Eastern Palace - Compass Chest", true, []],

            ["Eastern Palace - Cannonball Chest", true, []],

            ["Eastern Palace - Big Chest", false, []],
            ["Eastern Palace - Big Chest", false, [], ['BigKeyP1']],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1']],

            ["Eastern Palace - Map Chest", true, []],

            ["Eastern Palace - Big Key Chest", false, []],
            ["Eastern Palace - Big Key Chest", false, [], ['Lamp']],
            ["Eastern Palace - Big Key Chest", true, ['Lamp']],


            ["Eastern Palace - Boss", false, []],
            ["Eastern Palace - Boss", false, [], ['Lamp']],
            ["Eastern Palace - Boss", false, [], ['AnyBow']],
            ["Eastern Palace - Boss", false, [], ['BigKeyP1']],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1']],
        ];
    }
}
