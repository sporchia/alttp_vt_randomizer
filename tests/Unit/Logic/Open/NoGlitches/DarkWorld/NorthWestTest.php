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
            'mode.state' => 'open',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Brewery", false, []],
            ["Brewery", false, ['ProgressiveGlove', 'ProgressiveGlove']],
            ["Brewery", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Brewery", true, ['MoonPearl', 'TitansMitt']],
            ["Brewery", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Brewery", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Brewery", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Brewery", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Brewery", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["C-Shaped House", false, []],
            ["C-Shaped House", false, ['ProgressiveGlove', 'ProgressiveGlove']],
            ["C-Shaped House", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["C-Shaped House", true, ['MoonPearl', 'TitansMitt']],
            ["C-Shaped House", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["C-Shaped House", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["C-Shaped House", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["C-Shaped House", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["C-Shaped House", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Chest Game", false, []],
            ["Chest Game", false, ['ProgressiveGlove', 'ProgressiveGlove']],
            ["Chest Game", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Chest Game", true, ['MoonPearl', 'TitansMitt']],
            ["Chest Game", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Chest Game", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Chest Game", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Chest Game", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],
            ["Chest Game", true, ['MoonPearl', 'AgahnimDefeated', 'Flippers', 'Hookshot']],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", false, ['Hammer', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hammer Pegs", false, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hammer Pegs", false, ['MoonPearl', 'Hammer', 'ProgressiveGlove']],
            ["Hammer Pegs", true, ['MoonPearl', 'Hammer', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hammer Pegs", true, ['MoonPearl', 'Hammer', 'TitansMitt']],

            ["Bumper Cave", false, []],
            ["Bumper Cave", false, ['Cape', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bumper Cave", false, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bumper Cave", false, ['MoonPearl', 'Cape', 'ProgressiveGlove']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'TitansMitt']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'ProgressiveGlove', 'Hammer']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'PowerGlove', 'Hammer']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot']],
            ["Bumper Cave", true, ['MoonPearl', 'Cape', 'AgahnimDefeated', 'PowerGlove', 'Hookshot']],

            ["Blacksmith", false, []],
            ["Blacksmith", false, ['ProgressiveGlove', 'ProgressiveGlove']],
            ["Blacksmith", false, ['MoonPearl', 'ProgressiveGlove']],
            ["Blacksmith", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blacksmith", true, ['MoonPearl', 'TitansMitt']],

            ["Purple Chest", false, []],
            ["Purple Chest", false, ['ProgressiveGlove', 'ProgressiveGlove']],
            ["Purple Chest", false, ['MoonPearl', 'ProgressiveGlove']],
            ["Purple Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Purple Chest", true, ['MoonPearl', 'TitansMitt']],
        ];
    }
}
