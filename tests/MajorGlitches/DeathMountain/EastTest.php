<?php

namespace MajorGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class EastTest extends TestCase
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
            ["Spiral Cave", true, []],

            ["Paradox Cave Lower - Far Left", true, []],

            ["Paradox Cave Lower - Left", true, []],

            ["Paradox Cave Lower - Middle", true, []],

            ["Paradox Cave Lower - Right", true, []],

            ["Paradox Cave Lower - Far Right", true, []],

            ["Paradox Cave Upper - Left", true, []],

            ["Paradox Cave Upper - Right", true, []],
        ];
    }
}
