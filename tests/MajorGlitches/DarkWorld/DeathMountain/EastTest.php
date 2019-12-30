<?php

namespace MajorGlitches\DarkWorld\DeathMountain;

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
            ["Superbunny Cave - Top", true, []],

            ["Superbunny Cave - Bottom", true, []],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", false, [], ['Hookshot', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", false, [], ['AnyBottle', 'MoonPearl']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'MoonPearl']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'MoonPearl']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithBee']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithBee']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithFairy']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithFairy']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithRedPotion']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithRedPotion']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithBluePotion']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithBluePotion']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'Bottle']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'Bottle']],
            ["Hookshot Cave - Bottom Right", true, ['PegasusBoots', 'BottleWithGoldBee']],
            ["Hookshot Cave - Bottom Right", true, ['Hookshot', 'BottleWithGoldBee']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", false, [], ['Hookshot']],
            ["Hookshot Cave - Bottom Left", false, [], ['AnyBottle', 'MoonPearl']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'MoonPearl']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithBee']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithFairy']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithRedPotion']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithBluePotion']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'Bottle']],
            ["Hookshot Cave - Bottom Left", true, ['Hookshot', 'BottleWithGoldBee']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", false, [], ['Hookshot']],
            ["Hookshot Cave - Top Left", false, [], ['AnyBottle', 'MoonPearl']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'MoonPearl']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithBee']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithFairy']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithRedPotion']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithBluePotion']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'Bottle']],
            ["Hookshot Cave - Top Left", true, ['Hookshot', 'BottleWithGoldBee']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", false, [], ['Hookshot']],
            ["Hookshot Cave - Top Right", false, [], ['AnyBottle', 'MoonPearl']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'MoonPearl']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithBee']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithFairy']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithRedPotion']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithGreenPotion']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithBluePotion']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'Bottle']],
            ["Hookshot Cave - Top Right", true, ['Hookshot', 'BottleWithGoldBee']],
        ];
    }
}
