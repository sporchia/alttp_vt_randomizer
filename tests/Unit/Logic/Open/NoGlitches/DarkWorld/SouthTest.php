<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\NoGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
 * @group NoGlitches
 */
final class SouthTest extends TestCase
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
            'mode.state' => 'open',
            'difficulty' => 'test_rules',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Hype Cave - Top", false, []],
            ["Hype Cave - Top", false, ['AgahnimDefeated', 'Hammer']],
            ["Hype Cave - Top", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer']],
            ["Hype Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hype Cave - Top", true, ['MoonPearl', 'TitansMitt']],
            ["Hype Cave - Top", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hype Cave - Top", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hype Cave - Top", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Hype Cave - Top", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Hype Cave - Top", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Hype Cave - Middle Right", false, []],
            ["Hype Cave - Middle Right", false, ['AgahnimDefeated', 'Hammer']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'TitansMitt']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Hype Cave - Middle Left", false, []],
            ["Hype Cave - Middle Left", false, ['AgahnimDefeated', 'Hammer']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'TitansMitt']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Hype Cave - Bottom", false, []],
            ["Hype Cave - Bottom", false, ['AgahnimDefeated', 'Hammer']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'TitansMitt']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Hype Cave - NPC", false, []],
            ["Hype Cave - NPC", false, ['AgahnimDefeated', 'Hammer']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'TitansMitt']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Stumpy", false, []],
            ["Stumpy", false, ['AgahnimDefeated', 'Hammer']],
            ["Stumpy", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer']],
            ["Stumpy", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Stumpy", true, ['MoonPearl', 'TitansMitt']],
            ["Stumpy", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Stumpy", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Stumpy", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Stumpy", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Stumpy", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Digging Game - Item", false, []],
            ["Digging Game - Item", false, ['AgahnimDefeated', 'Hammer']],
            ["Digging Game - Item", true, ['MoonPearl', 'AgahnimDefeated', 'Hammer']],
            ["Digging Game - Item", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Digging Game - Item", true, ['MoonPearl', 'TitansMitt']],
            ["Digging Game - Item", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Digging Game - Item", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Digging Game - Item", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Digging Game - Item", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Digging Game - Item", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],
        ];
    }
}
