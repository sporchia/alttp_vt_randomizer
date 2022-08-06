<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\MajorGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
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
            'mode.state' => 'inverted',
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
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'CaneOfByrna']],
        ];
    }
}
