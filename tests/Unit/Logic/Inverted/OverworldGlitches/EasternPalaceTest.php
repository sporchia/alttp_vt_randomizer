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
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Eastern Palace - Compass Chest", false, []],
            ["Eastern Palace - Compass Chest", true, ['MoonPearl', 'PegasusBoots']],
            ["Eastern Palace - Compass Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Eastern Palace - Compass Chest", true, ['DefeatAgahnim']],

            ["Eastern Palace - Cannonball Chest", false, []],
            ["Eastern Palace - Cannonball Chest", true, ['MoonPearl', 'PegasusBoots']],
            ["Eastern Palace - Cannonball Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Eastern Palace - Cannonball Chest", true, ['DefeatAgahnim']],

            ["Eastern Palace - Big Chest", false, []],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1', 'MoonPearl', 'PegasusBoots']],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1', 'MagicMirror', 'PegasusBoots']],
            ["Eastern Palace - Big Chest", true, ['BigKeyP1', 'DefeatAgahnim']],

            ["Eastern Palace - Map Chest", false, []],
            ["Eastern Palace - Map Chest", true, ['MoonPearl', 'PegasusBoots']],
            ["Eastern Palace - Map Chest", true, ['MagicMirror', 'PegasusBoots']],
            ["Eastern Palace - Map Chest", true, ['DefeatAgahnim']],

            ["Eastern Palace - Big Key Chest", false, []],
            ["Eastern Palace - Big Key Chest", true, ['Lamp', 'MoonPearl', 'PegasusBoots']],
            ["Eastern Palace - Big Key Chest", true, ['Lamp', 'MagicMirror', 'PegasusBoots']],
            ["Eastern Palace - Big Key Chest", true, ['Lamp', 'DefeatAgahnim']],

            ["Eastern Palace - Boss", false, []],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'MoonPearl', 'PegasusBoots']],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'MagicMirror', 'PegasusBoots']],
            ["Eastern Palace - Boss", true, ['Lamp', 'BowAndArrows', 'BigKeyP1', 'DefeatAgahnim']],
        ];
    }
}
