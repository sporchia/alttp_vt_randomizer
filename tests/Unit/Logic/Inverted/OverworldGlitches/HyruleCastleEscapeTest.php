<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group OverworldGlitches
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
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Sanctuary", False, []],
            ["Sanctuary", true, ['MagicMirror', 'DefeatAgahnim']],
            ["Sanctuary", true, ['Lamp', 'DefeatAgahnim', 'KeyH2']],
            ["Sanctuary", true, ['MoonPearl', 'PegasusBoots']],
            ["Sanctuary", true, ['MagicMirror', 'PegasusBoots']],

            ["Sewers - Secret Room - Left", false, []],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'ProgressiveGlove', 'PegasusBoots']],
            ["Sewers - Secret Room - Left", true, ['MoonPearl', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Left", true, ['MagicMirror', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Left", true, ['DefeatAgahnim', 'Lamp', 'KeyH2']],

            ["Sewers - Secret Room - Middle", false, []],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'PegasusBoots']],
            ["Sewers - Secret Room - Middle", true, ['MoonPearl', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Middle", true, ['MagicMirror', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Middle", true, ['DefeatAgahnim', 'Lamp', 'KeyH2']],

            ["Sewers - Secret Room - Right", false, []],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'ProgressiveGlove', 'PegasusBoots']],
            ["Sewers - Secret Room - Right", true, ['MoonPearl', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Right", true, ['MagicMirror', 'PegasusBoots', 'Lamp', 'KeyH2']],
            ["Sewers - Secret Room - Right", true, ['DefeatAgahnim', 'Lamp', 'KeyH2']],

            ["Sewers - Dark Cross", False, []],
            ["Sewers - Dark Cross", true, ['Lamp', 'DefeatAgahnim']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MoonPearl', 'PegasusBoots']],
            ["Sewers - Dark Cross", true, ['Lamp', 'MagicMirror', 'PegasusBoots']],

            ["Hyrule Castle - Boomerang Chest", false, []],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'DefeatAgahnim']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MoonPearl', 'PegasusBoots']],
            ["Hyrule Castle - Boomerang Chest", true, ['KeyH2', 'MagicMirror', 'PegasusBoots']],

            ["Hyrule Castle - Map Chest", false, []],
            ["Hyrule Castle - Map Chest", true, ['DefeatAgahnim']],
            ["Hyrule Castle - Map Chest", true, ['MoonPearl', 'PegasusBoots']],
            ["Hyrule Castle - Map Chest", true, ['MagicMirror', 'PegasusBoots']],

            ["Hyrule Castle - Zelda's Cell", false, []],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'DefeatAgahnim']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MoonPearl', 'PegasusBoots']],
            ["Hyrule Castle - Zelda's Cell", true, ['KeyH2', 'MagicMirror', 'PegasusBoots']],
        ];
    }
}
