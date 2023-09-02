<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches\DeathMountain;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
 */
final class EastTest extends TestCase
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
            'mode.state' => 'standard',
            'tech' => config('logic.major_glitches'),
            'logic' => 'MajorGlitches',
        ]]);
        $randomizer->assumeItems(array_map(fn ($i) => "$i:0", $items));
        $this->assertEquals($access, $randomizer->canReachLocation("$location:0"));
    }

    public function accessPool(): array
    {
        return [
            ["Spiral Cave", true, []],

            ["Paradox Cave Lower - Far Left", true, []],

            ["Paradox Cave Lower - Left", true, []],

            ["Paradox Cave Lower - Middle", true, []],

            ["Paradox Cave Lower - Right", true, []],

            ["Paradox Cave Lower - Far Right", true, []],

            ["Paradox Cave Upper - Left", true, []],

            ["Paradox Cave Upper - Right", true, []],
        ];
    }
}
