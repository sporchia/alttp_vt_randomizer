<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group NoGlitches
 */
final class DesertPalaceTest extends TestCase
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
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Desert Palace - Map Chest", false, []],
            ["Desert Palace - Map Chest", false, ['MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Map Chest", false, ['BookOfMudora', 'AgahnimDefeated']],
            ["Desert Palace - Map Chest", true, ['BookOfMudora', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Map Chest", true, ['BookOfMudora', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Desert Palace - Map Chest", true, ['BookOfMudora', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Desert Palace - Map Chest", true, ['BookOfMudora', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Palace - Map Chest", true, ['BookOfMudora', 'MoonPearl', 'TitansMitt']],

            ["Desert Palace - Big Chest", false, []],
            ["Desert Palace - Big Chest", false, ['BigKeyP2', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Big Chest", false, ['BookOfMudora', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Big Chest", false, ['BookOfMudora', 'BigKeyP2', 'AgahnimDefeated']],
            ["Desert Palace - Big Chest", true, ['BookOfMudora', 'BigKeyP2', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Big Chest", true, ['BookOfMudora', 'BigKeyP2', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Desert Palace - Big Chest", true, ['BookOfMudora', 'BigKeyP2', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Desert Palace - Big Chest", true, ['BookOfMudora', 'BigKeyP2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Palace - Big Chest", true, ['BookOfMudora', 'BigKeyP2', 'MoonPearl', 'TitansMitt']],

            ["Desert Palace - Torch", false, []],
            ["Desert Palace - Torch", false, ['PegasusBoots', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Torch", false, ['BookOfMudora', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Torch", false, ['BookOfMudora', 'PegasusBoots', 'AgahnimDefeated']],
            ["Desert Palace - Torch", true, ['BookOfMudora', 'PegasusBoots', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Torch", true, ['BookOfMudora', 'PegasusBoots', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Desert Palace - Torch", true, ['BookOfMudora', 'PegasusBoots', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Desert Palace - Torch", true, ['BookOfMudora', 'PegasusBoots', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Palace - Torch", true, ['BookOfMudora', 'PegasusBoots', 'MoonPearl', 'TitansMitt']],

            ["Desert Palace - Compass Chest", false, []],
            ["Desert Palace - Compass Chest", false, ['KeyP2', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Compass Chest", false, ['BookOfMudora', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Compass Chest", false, ['BookOfMudora', 'KeyP2', 'AgahnimDefeated']],
            ["Desert Palace - Compass Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Compass Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Desert Palace - Compass Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Desert Palace - Compass Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Palace - Compass Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'TitansMitt']],

            ["Desert Palace - Big Key Chest", false, []],
            ["Desert Palace - Big Key Chest", false, ['KeyP2', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Big Key Chest", false, ['BookOfMudora', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Big Key Chest", false, ['BookOfMudora', 'KeyP2', 'AgahnimDefeated']],
            ["Desert Palace - Big Key Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'AgahnimDefeated']],
            ["Desert Palace - Big Key Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Desert Palace - Big Key Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Desert Palace - Big Key Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Palace - Big Key Chest", true, ['BookOfMudora', 'KeyP2', 'MoonPearl', 'TitansMitt']],

            ["Desert Palace - Boss", false, []],
            ["Desert Palace - Boss", false, ['UncleSword', 'MoonPearl', 'ProgressiveGlove', 'AgahnimDefeated', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", false, ['UncleSword', 'MoonPearl', 'ProgressiveGlove', 'AgahnimDefeated', 'KeyP2', 'BookOfMudora', 'Lamp']],
            ["Desert Palace - Boss", false, ['UncleSword', 'MoonPearl', 'ProgressiveGlove', 'AgahnimDefeated', 'KeyP2', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", false, ['UncleSword', 'ProgressiveGlove', 'AgahnimDefeated', 'KeyP2', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", false, ['UncleSword', 'MoonPearl', 'AgahnimDefeated', 'KeyP2', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'ProgressiveGlove', 'AgahnimDefeated', 'KeyP2', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'PowerGlove', 'AgahnimDefeated', 'KeyP2', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'KeyP2', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'KeyP2', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP2', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'TitansMitt', 'KeyP2', 'BookOfMudora', 'Lamp', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'ProgressiveGlove', 'AgahnimDefeated', 'KeyP2', 'BookOfMudora', 'FireRod', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'PowerGlove', 'AgahnimDefeated', 'KeyP2', 'BookOfMudora', 'FireRod', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer', 'KeyP2', 'BookOfMudora', 'FireRod', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['MoonPearl', 'PowerGlove', 'Hammer', 'KeyP2', 'BookOfMudora', 'FireRod', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'KeyP2', 'BookOfMudora', 'FireRod', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'TitansMitt', 'KeyP2', 'BookOfMudora', 'FireRod', 'BigKeyP2']],
            ["Desert Palace - Boss", true, ['UncleSword', 'MoonPearl', 'TitansMitt', 'KeyP2', 'BookOfMudora', 'FireRod', 'BigKeyP2']],
        ];
    }
}
