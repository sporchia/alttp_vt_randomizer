<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
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
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Spike Cave", false, []],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Bottle', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Bottle', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Bottle', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Bottle', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Bottle', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Bottle', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Bottle', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Bottle', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Bottle', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Bottle', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Bottle', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Bottle', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Bottle', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Bottle', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Bottle', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Bottle', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Bottle', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Bottle', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
        ];
    }
}
