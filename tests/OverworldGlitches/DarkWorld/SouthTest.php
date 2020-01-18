<?php

namespace OverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class SouthTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
        $this->addCollected(['RescueZelda']);
        $this->collected->setChecksForWorld($this->world->id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    /**
     * @param string $location
     * @param bool $access
     * @param array $items
     * @param array $except
     *
     * @dataProvider accessPool
     */
    public function testLocation(string $location, bool $access, array $items, array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getLocation($location)
            ->canAccess($this->collected));
    }

    public function accessPool()
    {
        return [
            ["Hype Cave - Top", false, []],
            ["Hype Cave - Top", false, [], ['MoonPearl']],
            ["Hype Cave - Top", true, ['MoonPearl', 'PegasusBoots']],

            ["Hype Cave - Middle Right", false, []],
            ["Hype Cave - Middle Right", false, [], ['MoonPearl']],
            ["Hype Cave - Middle Right", true, ['MoonPearl', 'PegasusBoots']],

            ["Hype Cave - Middle Left", false, []],
            ["Hype Cave - Middle Left", false, [], ['MoonPearl']],
            ["Hype Cave - Middle Left", true, ['MoonPearl', 'PegasusBoots']],

            ["Hype Cave - Bottom", false, []],
            ["Hype Cave - Bottom", false, [], ['MoonPearl']],
            ["Hype Cave - Bottom", true, ['MoonPearl', 'PegasusBoots']],

            ["Hype Cave - NPC", false, []],
            ["Hype Cave - NPC", false, [], ['MoonPearl']],
            ["Hype Cave - NPC", true, ['MoonPearl', 'PegasusBoots']],

            ["Stumpy", false, []],
            ["Stumpy", false, [], ['MoonPearl']],
            ["Stumpy", true, ['MoonPearl', 'PegasusBoots']],

            ["Digging Game", false, []],
            ["Digging Game", false, [], ['MoonPearl']],
            ["Digging Game", true, ['MoonPearl', 'PegasusBoots']],
        ];
    }
}
