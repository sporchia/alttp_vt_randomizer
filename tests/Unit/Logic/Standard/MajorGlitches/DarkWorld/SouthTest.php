<?php

declare(strict_types=1);

namespace Tests\Unit\Logic\Standard\MajorGlitches\DarkWorld;

use App\Graph\Randomizer;
use Tests\TestCase;

/**
 * @group graph
 * @group Standard
 * @group MajorGlitches
 */
final class SouthTest extends TestCase
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
            ["Hype Cave - Top", false, []],
            ["Hype Cave - Top", true, ['MoonPearl']],
            ["Hype Cave - Top", true, ['BottleWithBee']],
            ["Hype Cave - Top", true, ['BottleWithFairy']],
            ["Hype Cave - Top", true, ['BottleWithRedPotion']],
            ["Hype Cave - Top", true, ['BottleWithGreenPotion']],
            ["Hype Cave - Top", true, ['BottleWithBluePotion']],
            ["Hype Cave - Top", true, ['Bottle']],
            ["Hype Cave - Top", true, ['BottleWithGoldBee']],

            ["Hype Cave - Middle Right", false, []],
            ["Hype Cave - Middle Right", true, ['MoonPearl']],
            ["Hype Cave - Middle Right", true, ['BottleWithBee']],
            ["Hype Cave - Middle Right", true, ['BottleWithFairy']],
            ["Hype Cave - Middle Right", true, ['BottleWithRedPotion']],
            ["Hype Cave - Middle Right", true, ['BottleWithGreenPotion']],
            ["Hype Cave - Middle Right", true, ['BottleWithBluePotion']],
            ["Hype Cave - Middle Right", true, ['Bottle']],
            ["Hype Cave - Middle Right", true, ['BottleWithGoldBee']],

            ["Hype Cave - Middle Left", false, []],
            ["Hype Cave - Middle Left", true, ['MoonPearl']],
            ["Hype Cave - Middle Left", true, ['BottleWithBee']],
            ["Hype Cave - Middle Left", true, ['BottleWithFairy']],
            ["Hype Cave - Middle Left", true, ['BottleWithRedPotion']],
            ["Hype Cave - Middle Left", true, ['BottleWithGreenPotion']],
            ["Hype Cave - Middle Left", true, ['BottleWithBluePotion']],
            ["Hype Cave - Middle Left", true, ['Bottle']],
            ["Hype Cave - Middle Left", true, ['BottleWithGoldBee']],

            ["Hype Cave - Bottom", false, []],
            ["Hype Cave - Bottom", true, ['MoonPearl']],
            ["Hype Cave - Bottom", true, ['BottleWithBee']],
            ["Hype Cave - Bottom", true, ['BottleWithFairy']],
            ["Hype Cave - Bottom", true, ['BottleWithRedPotion']],
            ["Hype Cave - Bottom", true, ['BottleWithGreenPotion']],
            ["Hype Cave - Bottom", true, ['BottleWithBluePotion']],
            ["Hype Cave - Bottom", true, ['Bottle']],
            ["Hype Cave - Bottom", true, ['BottleWithGoldBee']],

            ["Hype Cave - NPC", false, []],
            ["Hype Cave - NPC", true, ['MoonPearl']],
            ["Hype Cave - NPC", true, ['BottleWithBee']],
            ["Hype Cave - NPC", true, ['BottleWithFairy']],
            ["Hype Cave - NPC", true, ['BottleWithRedPotion']],
            ["Hype Cave - NPC", true, ['BottleWithGreenPotion']],
            ["Hype Cave - NPC", true, ['BottleWithBluePotion']],
            ["Hype Cave - NPC", true, ['Bottle']],
            ["Hype Cave - NPC", true, ['BottleWithGoldBee']],

            ["Stumpy", false, []],
            ["Stumpy", true, ['MoonPearl']],
            ["Stumpy", true, ['MagicMirror']],
            ["Stumpy", true, ['BottleWithBee']],
            ["Stumpy", true, ['BottleWithFairy']],
            ["Stumpy", true, ['BottleWithRedPotion']],
            ["Stumpy", true, ['BottleWithGreenPotion']],
            ["Stumpy", true, ['BottleWithBluePotion']],
            ["Stumpy", true, ['Bottle']],
            ["Stumpy", true, ['BottleWithGoldBee']],

            ["Digging Game", false, []],
            ["Digging Game", true, ['MoonPearl']],
            ["Digging Game", true, ['BottleWithBee']],
            ["Digging Game", true, ['BottleWithFairy']],
            ["Digging Game", true, ['BottleWithRedPotion']],
            ["Digging Game", true, ['BottleWithGreenPotion']],
            ["Digging Game", true, ['BottleWithBluePotion']],
            ["Digging Game", true, ['Bottle']],
            ["Digging Game", true, ['BottleWithGoldBee']],
        ];
    }
}
