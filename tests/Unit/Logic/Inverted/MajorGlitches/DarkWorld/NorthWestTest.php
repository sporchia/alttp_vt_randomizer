<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Inverted\MajorGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Inverted
 * @group MajorGlitches
 */
final class NorthWestTest extends TestCase
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
        $this->markTestSkipped();
        $randomizer = new Randomizer([[
            'mode.state' => 'inverted',
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Brewery", true, []],

            ["C-Shaped House", true, []],

            ["Chest Game", true, []],

            ["Hammer Pegs", false, []],
            ["Hammer Pegs", true, ['Hammer']],

            ["Bumper Cave", true, []],

            ["Blacksmith", false, []],
            ["Blacksmith", true, ['MagicMirror']],
            ["Blacksmith", true, ['Bottle']],
            ["Blacksmith", true, ['ProgressiveGlove', 'ProgressiveGlove']],

            ["Purple Chest", false, []],
            ["Purple Chest", true, ['MagicMirror']],
            ["Purple Chest", true, ['Bottle']],
            ["Purple Chest", true, ['ProgressiveGlove', 'ProgressiveGlove']],
        ];
    }
}
