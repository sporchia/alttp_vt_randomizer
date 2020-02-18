<?php

namespace MajorGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class WestTest extends TestCase
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
            ["Ether Tablet", false, []],
            ["Ether Tablet", false, [], ['UpgradedSword']],
            ["Ether Tablet", false, [], ['BookOfMudora']],
            ["Ether Tablet", true, ['BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['BookOfMudora', 'L4Sword']],

            ["Old Man", false, []],
            ["Old Man", false, [], ['Lamp']],
            ["Old Man", true, ['Lamp']],

            ["Spectacle Rock Cave", true, []],

            ["Spectacle Rock", true, []],
        ];
    }
}
