<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\MajorGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group MajorGlitches
 */
final class TowerOfHeraTest extends TestCase
{
    /**
     * @param string $location
     * @param bool $access
     * @param array $items
     *
     * @dataProvider accessPool
     */
    public function testLocation(string $location, bool $access, array $items): void
    {
        $randomizer = new Randomizer([[
            'mode.state' => 'inverted',
            'difficulty' => 'test_rules',
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Tower Of Hera - Big Key Chest", false, []],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'MoonPearl', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'MoonPearl', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'BottleWithBee', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'BottleWithBee', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'BottleWithFairy', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'BottleWithFairy', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'BottleWithRedPotion', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'BottleWithRedPotion', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'BottleWithGreenPotion', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'BottleWithGreenPotion', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'BottleWithBluePotion', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'BottleWithBluePotion', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Bottle', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Bottle', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'BottleWithGoldBee', 'KeyP3']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'BottleWithGoldBee', 'KeyP3']],
            ["Tower Of Hera - Basement Cage", true, ['Lamp', 'MagicMirror', 'UncleSword']],
            ["Tower Of Hera - Basement Cage", true, ['FireRod', 'MagicMirror', 'UncleSword']],
            ["Tower Of Hera - Basement Cage", true, ['Lamp', 'MagicMirror', 'ProgressiveSword']],
            ["Tower Of Hera - Basement Cage", true, ['FireRod', 'MagicMirror', 'ProgressiveSword']],
            ["Tower Of Hera - Basement Cage", true, ['Lamp', 'MagicMirror', 'MasterSword']],
            ["Tower Of Hera - Basement Cage", true, ['FireRod', 'MagicMirror', 'MasterSword']],
            ["Tower Of Hera - Basement Cage", true, ['Lamp', 'MagicMirror', 'L3Sword']],
            ["Tower Of Hera - Basement Cage", true, ['FireRod', 'MagicMirror', 'L3Sword']],
            ["Tower Of Hera - Basement Cage", true, ['Lamp', 'MagicMirror', 'L4Sword']],
            ["Tower Of Hera - Basement Cage", true, ['FireRod', 'MagicMirror', 'L4Sword']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['Lamp', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Big Key Chest", true, ['FireRod', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'KeyD6']],

            ["Tower Of Hera - Basement Cage", false, []],
            ["Tower Of Hera - Basement Cage", true, ['MoonPearl']],
            ["Tower Of Hera - Basement Cage", true, ['BottleWithBee']],
            ["Tower Of Hera - Basement Cage", true, ['BottleWithFairy']],
            ["Tower Of Hera - Basement Cage", true, ['BottleWithRedPotion']],
            ["Tower Of Hera - Basement Cage", true, ['BottleWithGreenPotion']],
            ["Tower Of Hera - Basement Cage", true, ['BottleWithBluePotion']],
            ["Tower Of Hera - Basement Cage", true, ['Bottle']],
            ["Tower Of Hera - Basement Cage", true, ['BottleWithGoldBee']],
            ["Tower Of Hera - Basement Cage", true, ['MagicMirror', 'UncleSword']],
            ["Tower Of Hera - Basement Cage", true, ['MagicMirror', 'ProgressiveSword']],
            ["Tower Of Hera - Basement Cage", true, ['MagicMirror', 'MasterSword']],
            ["Tower Of Hera - Basement Cage", true, ['MagicMirror', 'L3Sword']],
            ["Tower Of Hera - Basement Cage", true, ['MagicMirror', 'L4Sword']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Basement Cage", true, ['Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6']],

            ["Tower Of Hera - Map Chest", false, []],
            ["Tower Of Hera - Map Chest", true, ['MoonPearl']],
            ["Tower Of Hera - Map Chest", true, ['BottleWithBee']],
            ["Tower Of Hera - Map Chest", true, ['BottleWithFairy']],
            ["Tower Of Hera - Map Chest", true, ['BottleWithRedPotion']],
            ["Tower Of Hera - Map Chest", true, ['BottleWithGreenPotion']],
            ["Tower Of Hera - Map Chest", true, ['BottleWithBluePotion']],
            ["Tower Of Hera - Map Chest", true, ['Bottle']],
            ["Tower Of Hera - Map Chest", true, ['BottleWithGoldBee']],
            ["Tower Of Hera - Map Chest", true, ['MagicMirror', 'UncleSword']],
            ["Tower Of Hera - Map Chest", true, ['MagicMirror', 'ProgressiveSword']],
            ["Tower Of Hera - Map Chest", true, ['MagicMirror', 'MasterSword']],
            ["Tower Of Hera - Map Chest", true, ['MagicMirror', 'L3Sword']],
            ["Tower Of Hera - Map Chest", true, ['MagicMirror', 'L4Sword']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Map Chest", true, ['Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6']],

            ["Tower Of Hera - Compass Chest", false, []],
            ["Tower Of Hera - Compass Chest", true, ['MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['BottleWithBee', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['BottleWithFairy', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['BottleWithRedPotion', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['BottleWithGreenPotion', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['BottleWithBluePotion', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['Bottle', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['BottleWithGoldBee', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['MagicMirror', 'UncleSword', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['MagicMirror', 'ProgressiveSword', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['MagicMirror', 'MasterSword', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['MagicMirror', 'L3Sword', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['MagicMirror', 'L4Sword', 'BigKeyP3']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6']],
            ["Tower Of Hera - Compass Chest", true, ['Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6']],

            ["Tower Of Hera - Big Chest", false, []],
            ["Tower Of Hera - Big Chest", true, ['MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['BottleWithBee', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['BottleWithFairy', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['BottleWithRedPotion', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['BottleWithGreenPotion', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['BottleWithBluePotion', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['Bottle', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['BottleWithGoldBee', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['MagicMirror', 'UncleSword', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['MagicMirror', 'ProgressiveSword', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['MagicMirror', 'MasterSword', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['MagicMirror', 'L3Sword', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['MagicMirror', 'L4Sword', 'BigKeyP3']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Big Chest", true, ['Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],

            ["Tower Of Hera - Boss", false, []],
            ["Tower Of Hera - Boss", true, ['Hammer', 'MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['Hammer', 'BottleWithBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['Hammer', 'BottleWithFairy', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['Hammer', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['Hammer', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['Hammer', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['Hammer', 'Bottle', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['Hammer', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['UncleSword', 'MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['UncleSword', 'BottleWithBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['UncleSword', 'BottleWithFairy', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['UncleSword', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['UncleSword', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['UncleSword', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['UncleSword', 'Bottle', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['UncleSword', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveSword', 'MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveSword', 'BottleWithBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveSword', 'BottleWithFairy', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveSword', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveSword', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveSword', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveSword', 'Bottle', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['ProgressiveSword', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MasterSword', 'MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MasterSword', 'BottleWithBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MasterSword', 'BottleWithFairy', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MasterSword', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MasterSword', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MasterSword', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MasterSword', 'Bottle', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MasterSword', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L3Sword', 'MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L3Sword', 'BottleWithBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L3Sword', 'BottleWithFairy', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L3Sword', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L3Sword', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L3Sword', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L3Sword', 'Bottle', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L3Sword', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L4Sword', 'MoonPearl', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L4Sword', 'BottleWithBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L4Sword', 'BottleWithFairy', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L4Sword', 'BottleWithRedPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L4Sword', 'BottleWithGreenPotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L4Sword', 'BottleWithBluePotion', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L4Sword', 'Bottle', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['L4Sword', 'BottleWithGoldBee', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'UncleSword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'ProgressiveSword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'MasterSword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'L3Sword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'L4Sword', 'BigKeyP3']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MoonPearl', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBee', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithFairy', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithRedPotion', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGreenPotion', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithBluePotion', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['Bottle', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['BottleWithGoldBee', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'PegasusBoots', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'PegasusBoots', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'PegasusBoots', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'PegasusBoots', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'PegasusBoots', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'Hookshot', 'UncleSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'Hookshot', 'ProgressiveSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'Hookshot', 'MasterSword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'Hookshot', 'L3Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
            ["Tower Of Hera - Boss", true, ['MagicMirror', 'Ether', 'Hookshot', 'L4Sword', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
        ];
    }
}
