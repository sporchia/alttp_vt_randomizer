<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\OverworldGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
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
            'mode.state' => 'inverted',
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
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'PegasusBoots', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'PegasusBoots', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'PegasusBoots', 'CaneOfByrna']],
        ];
    }
}
