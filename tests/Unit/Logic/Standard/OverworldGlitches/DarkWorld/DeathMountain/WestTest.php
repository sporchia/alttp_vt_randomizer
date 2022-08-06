<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\OverworldGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group OverworldGlitches
 */
final class WestTest extends TestCase
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
            'mode.state' => 'standard',
            'difficulty' => 'test_rules',
            'tech' => config('logic.overworld_glitches'),
            'logic' => 'OverworldGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Spike Cave", false, []],
            ["Spike Cave", false, ['Bottle', 'MoonPearl', 'Hammer', 'PegasusBoots', 'Cape']],
            ["Spike Cave", false, ['Bottle', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", false, ['Bottle', 'MoonPearl', 'ProgressiveGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", false, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'PegasusBoots']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'PegasusBoots', 'CaneOfByrna']],
        ];
    }
}
