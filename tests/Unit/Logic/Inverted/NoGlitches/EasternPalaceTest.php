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
final class EasternPalaceTest extends TestCase
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
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Eastern Palace - Compass Chest", false, []],
            ["Eastern Palace - Compass Chest", false, ['AgahnimDefeated']],
            ["Eastern Palace - Compass Chest", true, ['MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Eastern Palace - Compass Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Eastern Palace - Compass Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Eastern Palace - Compass Chest", true, ['MoonPearl', 'TitansMitt']],

            ["Eastern Palace - Cannonball Chest", false, []],
            ["Eastern Palace - Cannonball Chest", false, ['AgahnimDefeated',]],
            ["Eastern Palace - Cannonball Chest", true, ['MoonPearl', 'AgahnimDefeated',]],
            ["Eastern Palace - Cannonball Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Eastern Palace - Cannonball Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Eastern Palace - Cannonball Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Eastern Palace - Cannonball Chest", true, ['MoonPearl', 'TitansMitt']],

            ["Eastern Palace - Big Chest", false, []],
            ["Eastern Palace - Big Chest", false, ['BigKeyP1', 'AgahnimDefeated']],
            ["Eastern Palace - Big Chest", false, ['MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1', 'MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1', 'MoonPearl', 'TitansMitt']],

            ["Eastern Palace - Map Chest", false, []],
            ["Eastern Palace - Map Chest", false, ['AgahnimDefeated']],
            ["Eastern Palace - Map Chest", true, ['MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Eastern Palace - Map Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Eastern Palace - Map Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Eastern Palace - Map Chest", true, ['MoonPearl', 'TitansMitt']],

            ["Eastern Palace - Big Key Chest", false, []],
            ["Eastern Palace - Big Key Chest", false, ['Lamp', 'AgahnimDefeated']],
            ["Eastern Palace - Big Key Chest", false, ['MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Big Key Chest", true, ['Lamp', 'MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Big Key Chest", true, ['Lamp', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Eastern Palace - Big Key Chest", true, ['Lamp', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Eastern Palace - Big Key Chest", true, ['Lamp', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Eastern Palace - Big Key Chest", true, ['Lamp', 'MoonPearl', 'TitansMitt']],

            ["Eastern Palace - Boss", false, []],
            ["Eastern Palace - Boss", false, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'AgahnimDefeated']],
            ["Eastern Palace - Boss", false, ['BowAndArrows', 'BigKeyP1', 'MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Boss", false, ['Lamp', 'BigKeyP1', 'MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Boss", false, ['Lamp', 'BowAndArrows', 'MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'MoonPearl', 'AgahnimDefeated']],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'MoonPearl', 'TitansMitt']],
        ];
    }
}
