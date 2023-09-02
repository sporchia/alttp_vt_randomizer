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
final class NorthEastTest extends TestCase
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
            ["Catfish", false, []],
            ["Catfish", false, ['AgahnimDefeated', 'ProgressiveGlove']],
            ["Catfish", false, ['MoonPearl', 'AgahnimDefeated']],
            ["Catfish", true, ['MoonPearl', 'AgahnimDefeated', 'ProgressiveGlove']],
            ["Catfish", true, ['MoonPearl', 'AgahnimDefeated', 'PowerGlove']],
            ["Catfish", true, ['MoonPearl', 'AgahnimDefeated', 'TitansMitt']],
            ["Catfish", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Catfish", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Catfish", true, ['MoonPearl', 'TitansMitt', 'Flippers']],

            ["Pyramid Item", false, []],
            ["Pyramid Item", true, ['AgahnimDefeated']],
            ["Pyramid Item", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Pyramid Item", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Pyramid Item", true, ['MoonPearl', 'TitansMitt', 'Flippers']],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", false, ['Crystal5', 'Crystal6', 'AgahnimDefeated', 'Hammer']],
            ["Pyramid Fairy - Left", false, ['MoonPearl', 'Crystal6', 'AgahnimDefeated', 'Hammer']],
            ["Pyramid Fairy - Left", false, ['MoonPearl', 'Crystal5', 'AgahnimDefeated', 'Hammer']],
            // can't jump with red bomb
            ["Pyramid Fairy - Left", false, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'Hookshot', 'Flippers']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'TitansMitt', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveGlove', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'PowerGlove', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'TitansMitt', 'MagicMirror']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Left", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'MagicMirror']],

            ["Pyramid Fairy - Right", false, []],
            ["Pyramid Fairy - Right", false, ['Crystal5', 'Crystal6', 'AgahnimDefeated', 'Hammer']],
            ["Pyramid Fairy - Right", false, ['MoonPearl', 'Crystal6', 'AgahnimDefeated', 'Hammer']],
            ["Pyramid Fairy - Right", false, ['MoonPearl', 'Crystal5', 'AgahnimDefeated', 'Hammer']],
            ["Pyramid Fairy - Right", false, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'Hookshot', 'Flippers']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'TitansMitt', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'ProgressiveGlove', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'PowerGlove', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'TitansMitt', 'MagicMirror']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'ProgressiveGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'PowerGlove', 'Hookshot', 'MagicMirror']],
            ["Pyramid Fairy - Right", true, ['MoonPearl', 'Crystal5', 'Crystal6', 'AgahnimDefeated', 'Flippers', 'Hookshot', 'MagicMirror']],

            // @todo update this
            ["Ganon", false, []],
        ];
    }
}
