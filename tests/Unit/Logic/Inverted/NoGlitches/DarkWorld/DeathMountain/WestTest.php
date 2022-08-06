<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\NoGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group NoGlitches
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
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Spike Cave", false, []],
            ["Spike Cave", false, ['Bottle', 'Hammer', 'Lamp', 'Cape']],
            ["Spike Cave", false, ['Bottle', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", false, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Lamp']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'OcarinaInactive', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'OcarinaInactive', 'MoonPearl', 'CaneOfByrna']],
        ];
    }
}
