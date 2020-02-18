<?php

namespace MajorGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class MireTest extends TestCase
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
            ["Mire Shed - Left", false, []],
            ["Mire Shed - Left", false, [], ['MoonPearl', 'AnyBottle', 'MagicMirror']],
            ["Mire Shed - Left", true, ['MoonPearl']],
            ["Mire Shed - Left", true, ['BottleWithBee']],
            ["Mire Shed - Left", true, ['BottleWithFairy']],
            ["Mire Shed - Left", true, ['BottleWithRedPotion']],
            ["Mire Shed - Left", true, ['BottleWithGreenPotion']],
            ["Mire Shed - Left", true, ['BottleWithBluePotion']],
            ["Mire Shed - Left", true, ['Bottle']],
            ["Mire Shed - Left", true, ['BottleWithGoldBee']],
            ["Mire Shed - Left", true, ['MagicMirror']],

            ["Mire Shed - Right", false, []],
            ["Mire Shed - Right", false, [], ['MoonPearl', 'AnyBottle', 'MagicMirror']],
            ["Mire Shed - Right", true, ['MoonPearl']],
            ["Mire Shed - Right", true, ['BottleWithBee']],
            ["Mire Shed - Right", true, ['BottleWithFairy']],
            ["Mire Shed - Right", true, ['BottleWithRedPotion']],
            ["Mire Shed - Right", true, ['BottleWithGreenPotion']],
            ["Mire Shed - Right", true, ['BottleWithBluePotion']],
            ["Mire Shed - Right", true, ['Bottle']],
            ["Mire Shed - Right", true, ['BottleWithGoldBee']],
            ["Mire Shed - Right", true, ['MagicMirror']],
        ];
    }
}
