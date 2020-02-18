<?php

namespace Inverted\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class EastTest extends TestCase
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
            ["Spiral Cave", false, []],
            ["Spiral Cave", false, [], ['MoonPearl']],
            ["Spiral Cave", false, [], ['Gloves', 'Flute']],
            ["Spiral Cave", false, [], ['Lamp', 'Flute']],
            ["Spiral Cave", false, [], ['Hookshot', 'TitansMitt']],
            ["Spiral Cave", false, ['ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Spiral Cave", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Spiral Cave", false, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Spiral Cave", false, ['Flute', 'Hookshot', 'MoonPearl']],
            ["Spiral Cave", true, ['Flute', 'Hookshot', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hookshot']],
            ["Spiral Cave", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hookshot']],
            ["Spiral Cave", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hookshot']],
            ["Spiral Cave", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Spiral Cave", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Spiral Cave", true, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Spiral Cave", true, ['Flute', 'TitansMitt', 'MoonPearl']],

            ["Paradox Cave Lower - Far Left", false, []],
            ["Paradox Cave Lower - Far Left", false, [], ['MoonPearl']],
            ["Paradox Cave Lower - Far Left", false, [], ['Gloves', 'Flute']],
            ["Paradox Cave Lower - Far Left", false, [], ['Lamp', 'Flute']],
            ["Paradox Cave Lower - Far Left", false, [], ['TitansMitt', 'Hookshot']],
            ["Paradox Cave Lower - Far Left", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", false, ['Flute', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['Flute', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Far Left", true, ['Flute', 'TitansMitt', 'MoonPearl']],
            
            ["Paradox Cave Lower - Left", false, []],
            ["Paradox Cave Lower - Left", false, [], ['MoonPearl']],
            ["Paradox Cave Lower - Left", false, [], ['Gloves', 'Flute']],
            ["Paradox Cave Lower - Left", false, [], ['Lamp', 'Flute']],
            ["Paradox Cave Lower - Left", false, [], ['TitansMitt', 'Hookshot']],
            ["Paradox Cave Lower - Left", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Left", false, ['Flute', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['Flute', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Left", true, ['Flute', 'TitansMitt', 'MoonPearl']],
            
            ["Paradox Cave Lower - Middle", false, []],
            ["Paradox Cave Lower - Middle", false, [], ['MoonPearl']],
            ["Paradox Cave Lower - Middle", false, [], ['Gloves', 'Flute']],
            ["Paradox Cave Lower - Middle", false, [], ['Lamp', 'Flute']],
            ["Paradox Cave Lower - Middle", false, [], ['TitansMitt', 'Hookshot']],
            ["Paradox Cave Lower - Middle", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", false, ['Flute', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['Flute', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Middle", true, ['Flute', 'TitansMitt', 'MoonPearl']],
            
            ["Paradox Cave Lower - Right", false, []],
            ["Paradox Cave Lower - Right", false, [], ['MoonPearl']],
            ["Paradox Cave Lower - Right", false, [], ['Gloves', 'Flute']],
            ["Paradox Cave Lower - Right", false, [], ['Lamp', 'Flute']],
            ["Paradox Cave Lower - Right", false, [], ['TitansMitt', 'Hookshot']],
            ["Paradox Cave Lower - Right", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Right", false, ['Flute', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['Flute', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Right", true, ['Flute', 'TitansMitt', 'MoonPearl']],
            
            ["Paradox Cave Lower - Far Right", false, []],
            ["Paradox Cave Lower - Far Right", false, [], ['MoonPearl']],
            ["Paradox Cave Lower - Far Right", false, [], ['Gloves', 'Flute']],
            ["Paradox Cave Lower - Far Right", false, [], ['Lamp', 'Flute']],
            ["Paradox Cave Lower - Far Right", false, [], ['TitansMitt', 'Hookshot']],
            ["Paradox Cave Lower - Far Right", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", false, ['Flute', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['Flute', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Lower - Far Right", true, ['Flute', 'TitansMitt', 'MoonPearl']],
            
            ["Paradox Cave Upper - Left", false, []],
            ["Paradox Cave Upper - Left", false, [], ['MoonPearl']],
            ["Paradox Cave Upper - Left", false, [], ['Gloves', 'Flute']],
            ["Paradox Cave Upper - Left", false, [], ['Lamp', 'Flute']],
            ["Paradox Cave Upper - Left", false, [], ['TitansMitt', 'Hookshot']],
            ["Paradox Cave Upper - Left", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Left", false, ['Flute', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['Flute', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Upper - Left", true, ['Flute', 'TitansMitt', 'MoonPearl']],
            
            ["Paradox Cave Upper - Right", false, []],
            ["Paradox Cave Upper - Right", false, [], ['MoonPearl']],
            ["Paradox Cave Upper - Right", false, [], ['Gloves', 'Flute']],
            ["Paradox Cave Upper - Right", false, [], ['Lamp', 'Flute']],
            ["Paradox Cave Upper - Right", false, [], ['TitansMitt', 'Hookshot']],
            ["Paradox Cave Upper - Right", false, ['ProgressiveGlove', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Right", false, ['Flute', 'ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['Flute', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['PowerGlove', 'Lamp', 'Hookshot', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['TitansMitt', 'Lamp', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['Flute', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Paradox Cave Upper - Right", true, ['Flute', 'TitansMitt', 'MoonPearl']],
            
            ["Mimic Cave", false, []],
            ["Mimic Cave", false, [], ['MoonPearl']],
            ["Mimic Cave", false, [], ['Hammer']],
            ["Mimic Cave", false, [], ['Gloves', 'Flute']],
            ["Mimic Cave", false, [], ['Lamp', 'Flute']],
            ["Mimic Cave", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Mimic Cave", true, ['Flute', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Mimic Cave", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer']],
            ["Mimic Cave", true, ['Flute', 'MoonPearl', 'TitansMitt', 'Hammer']],
            ["Mimic Cave", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot']],
            ["Mimic Cave", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot']],
            ["Mimic Cave", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer']],
            ["Mimic Cave", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer']],

            ["Ether Tablet", false, []],
            ["Ether Tablet", false, [], ['MoonPearl']],
            ["Ether Tablet", false, [], ['Gloves', 'Flute']],
            ["Ether Tablet", false, [], ['Lamp', 'Flute']],
            ["Ether Tablet", false, [], ['TitansMitt', 'Hookshot']],
            ["Ether Tablet", false, [], ['Hammer']],
            ["Ether Tablet", false, [], ['UpgradedSword']],
            ["Ether Tablet", false, [], ['BookOfMudora']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'TitansMitt', 'Hammer', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'TitansMitt', 'Hammer', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'TitansMitt', 'Hammer', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['Flute', 'MoonPearl', 'TitansMitt', 'Hammer', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L4Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L2Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L3Sword']],
            ["Ether Tablet", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer', 'BookOfMudora', 'L4Sword']],

            ["Spectacle Rock", false, []],
            ["Spectacle Rock", false, [], ['MoonPearl']],
            ["Spectacle Rock", false, [], ['Gloves', 'Flute']],
            ["Spectacle Rock", false, [], ['Lamp', 'Flute']],
            ["Spectacle Rock", false, [], ['TitansMitt', 'Hookshot']],
            ["Spectacle Rock", false, [], ['Hammer']],
            ["Spectacle Rock", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'Hammer', 'Hookshot']],
            ["Spectacle Rock", true, ['Flute', 'MoonPearl', 'PowerGlove', 'Hammer', 'Hookshot']],
            ["Spectacle Rock", true, ['Flute', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hammer']],
            ["Spectacle Rock", true, ['Flute', 'MoonPearl', 'TitansMitt', 'Hammer']],
            ["Spectacle Rock", true, ['ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot']],
            ["Spectacle Rock", true, ['PowerGlove', 'Lamp', 'MoonPearl', 'Hammer', 'Hookshot']],
            ["Spectacle Rock", true, ['ProgressiveGlove', 'ProgressiveGlove', 'Lamp', 'MoonPearl', 'Hammer']],
            ["Spectacle Rock", true, ['TitansMitt', 'Lamp', 'MoonPearl', 'Hammer']],

        ];
    }
}
