<?php

namespace InvertedOverworldGlitches\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class WestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
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
            ["Spike Cave", false, []],
            ["Spike Cave", false, [], ['Gloves']],
            ["Spike Cave", false, [], ['Hammer']],
            ["Spike Cave", false, [], ['Cape', 'CaneOfByrna']],
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
