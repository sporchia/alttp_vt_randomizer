<?php

namespace MajorGlitches\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class WestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
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
            ["Spike Cave", false, [], ['AnyBottle', 'MoonPearl']],
            ["Spike Cave", false, ['Bottle', 'Hammer', 'ProgressiveGlove', 'Cape']],
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
