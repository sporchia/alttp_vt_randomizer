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
            'mode.state' => 'inverted',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Catfish", false, []],
            ["Catfish", false, ['AgahnimDefeated', 'MagicMirror']],
            ["Catfish", true, ['AgahnimDefeated', 'MagicMirror', 'ProgressiveGlove']],
            ["Catfish", true, ['AgahnimDefeated', 'MagicMirror',  'PowerGlove']],
            ["Catfish", true, ['AgahnimDefeated', 'MagicMirror',  'TitansMitt']],
            ["Catfish", true, ['ProgressiveGlove', 'Hammer']],
            ["Catfish", true, ['ProgressiveGlove', 'Flippers']],
            ["Catfish", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'MoonPearl']],

            ["Pyramid Item", false, []],
            ["Pyramid Item", true, ['AgahnimDefeated', 'MagicMirror']],
            ["Pyramid Item", true, ['Hammer']],
            ["Pyramid Item", true, ['Flippers', 'ProgressiveGlove']],
            ["Pyramid Item", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'MoonPearl']],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", false, ['AgahnimDefeated', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Left", false, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'MagicMirror', 'ProgressiveGlove', 'Flippers']],
            ["Pyramid Fairy - Left", true, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'MagicMirror', 'PowerGlove', 'Flippers']],
            ["Pyramid Fairy - Left", true, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'MagicMirror', 'TitansMitt', 'Flippers']],

            ["Pyramid Fairy - Right", false, []],
            ["Pyramid Fairy - Right", false, ['AgahnimDefeated', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Right", false, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'MagicMirror', 'ProgressiveGlove', 'Flippers']],
            ["Pyramid Fairy - Right", true, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'MagicMirror', 'PowerGlove', 'Flippers']],
            ["Pyramid Fairy - Right", true, ['AgahnimDefeated', 'Crystal5', 'Crystal6', 'MagicMirror', 'TitansMitt', 'Flippers']],
        ];
    }
}
