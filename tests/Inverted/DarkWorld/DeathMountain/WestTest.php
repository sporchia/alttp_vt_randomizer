<?php

namespace Inverted\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class WestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
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
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Flute', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'PowerGlove', 'Flute', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['Bottle', 'Hammer', 'TitansMitt', 'Flute', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'ProgressiveGlove', 'Flute', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'PowerGlove', 'Flute', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['HalfMagic', 'Hammer', 'TitansMitt', 'Flute', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'Lamp', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'Flute', 'MoonPearl', 'Cape']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'Lamp', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'ProgressiveGlove', 'Flute', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'PowerGlove', 'Flute', 'MoonPearl', 'CaneOfByrna']],
            ["Spike Cave", true, ['QuarterMagic', 'Hammer', 'TitansMitt', 'Flute', 'MoonPearl', 'CaneOfByrna']],
        ];
    }
}
