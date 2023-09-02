<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Open\NoGlitches\DarkWorld\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Open
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
            'mode.state' => 'open',
            'logic' => 'NoGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            // @todo update this to handle bottle/magic
            ["Spike Cave", false, []],
            ["Spike Cave", false, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", false, ['Bottle', 'MoonPearl', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", false, ['Bottle', 'MoonPearl', 'Hammer', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'OcarinaActive', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'PowerGlove', 'OcarinaActive', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'MoonPearl', 'Hammer', 'TitansMitt', 'OcarinaActive', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'OcarinaActive', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'OcarinaActive', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'OcarinaActive', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'OcarinaActive', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'ProgressiveGlove', 'OcarinaActive', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'PowerGlove', 'OcarinaActive', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'MoonPearl', 'Hammer', 'TitansMitt', 'OcarinaActive', 'CaneOfByrna']],
        ];
    }
}
