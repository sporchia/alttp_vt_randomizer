<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group NoGlitches
 */
final class NorthWestTest extends TestCase
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
            ["Brewery", true, []],

            ["C-Shaped House", true, []],

            ["Chest Game", true, []],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", false, ['ProgressiveGlove', 'ProgressiveGlove']],
            ["Hammer Pegs", true, ['Hammer', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hammer Pegs", true, ['Hammer', 'TitansMitt']],
            ["Hammer Pegs", true, ['Hammer', 'ProgressiveGlove', 'MagicMirror', 'MoonPearl']],
            ["Hammer Pegs", true, ['Hammer', 'AgahnimDefeated', 'MagicMirror']],

            ["Bumper Cave", false, []],
            ["Bumper Cave", false, ['Cape', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bumper Cave", false, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bumper Cave", false, ['MoonPearl', 'Cape', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bumper Cave", false, ['MoonPearl', 'Cape', 'MagicMirror', 'Hammer']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'TitansMitt']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'PowerGlove', 'Hammer']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'AgahnimDefeated', 'ProgressiveGlove']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'MagicMirror', 'AgahnimDefeated', 'PowerGlove']],

            ["Blacksmith", false, []],
            ["Blacksmith", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Blacksmith", true, ['TitansMitt', 'MoonPearl']],
            ["Blacksmith", true, ['AgahnimDefeated', 'MagicMirror']],
            ["Blacksmith", true, ['ProgressiveGlove', 'Hammer', 'MagicMirror', 'MoonPearl']],

            ["Purple Chest", false, []],
            ["Purple Chest", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Purple Chest", true, ['TitansMitt', 'MoonPearl']],
            ["Purple Chest", true, ['AgahnimDefeated', 'MagicMirror']],
            ["Purple Chest", true, ['ProgressiveGlove', 'Hammer', 'MagicMirror', 'MoonPearl']],
        ];
    }
}
