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
final class HyruleCastleEscapeTest extends TestCase
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
            ["Sanctuary Chest", False, []],
            ["Sanctuary Chest", false, ['AgahnimDefeated']],
            ["Sanctuary Chest", true, ['MoonPearl', 'AgahnimDefeated']],
            ["Sanctuary Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sanctuary Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sanctuary Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sanctuary Chest", true, ['MoonPearl', 'TitansMitt']],

            ["Sewers - Secret Room - Left", false, []],
            ["Sewers - Secret Room - Left", false, ['ProgressiveGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'PowerGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'AgahnimDefeated', 'Lamp', 'KeyH2']],

            ["Sewers - Secret Room - Middle", false, []],
            ["Sewers - Secret Room - Middle", false, ['ProgressiveGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'PowerGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'AgahnimDefeated', 'Lamp', 'KeyH2']],

            ["Sewers - Secret Room - Right", false, []],
            ["Sewers - Secret Room - Right", false, ['ProgressiveGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'PowerGlove', 'AgahnimDefeated']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'TitansMitt']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'AgahnimDefeated', 'Lamp', 'KeyH2']],

            ["Sewers - Dark Cross Chest", False, []],
            ["Sewers - Dark Cross Chest", false, ['MoonPearl', 'AgahnimDefeated']],
            ["Sewers - Dark Cross Chest", false, ['Lamp', 'AgahnimDefeated']],
            ["Sewers - Dark Cross Chest", true, ['Lamp', 'MoonPearl', 'AgahnimDefeated']],
            ["Sewers - Dark Cross Chest", true, ['Lamp', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sewers - Dark Cross Chest", true, ['Lamp', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sewers - Dark Cross Chest", true, ['Lamp', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sewers - Dark Cross Chest", true, ['Lamp', 'MoonPearl', 'TitansMitt']],

            ["Hyrule Castle - Boomerang Chest", false, []],
            ["Hyrule Castle - Boomerang Chest", false, ['MoonPearl', 'Lamp', 'AgahnimDefeated']],
            ["Hyrule Castle - Boomerang Chest", false, ['KeyH2', 'AgahnimDefeated']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'AgahnimDefeated']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'TitansMitt']],

            ["Hyrule Castle - Map Chest", false, []],
            ["Hyrule Castle - Map Chest", false, ['AgahnimDefeated']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'AgahnimDefeated']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'TitansMitt']],

            ["Hyrule Castle - Zelda's Cell", false, []],
            ["Hyrule Castle - Zelda's Cell", false, ['MoonPearl', 'Lamp', 'AgahnimDefeated']],
            ["Hyrule Castle - Zelda's Cell", false, ['KeyH2', 'AgahnimDefeated']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'AgahnimDefeated']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'TitansMitt']],
        ];
    }
}
