<?php

use ALttP\Item;
use ALttP\World;

class WorldTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    public function testGetRegionDoesntExist()
    {
        $this->expectException(\ErrorException::class);

        $this->world->getRegion("This Region Doesn't Exist");
    }

    /**
     * @param string $logic
     * @param bool $free
     * @param bool $expected
     *
     * @dataProvider vanillaDungeonItemsPool
     */
    public function testSetVanillaDungeonItems(string $logic, bool $free, bool $expected)
    {
        $world = World::factory('standard', ['difficulty' => 'test_rules',
            'logic' => $logic,
            'region.wildKeys' => $free,
            'region.wildBigKeys' => $free,
            'region.wildCompasses' => $free,
            'region.wildMaps' => $free,
        ]);

        $this->assertEquals($expected, $world->config('rom.vanillaKeys'));
        $this->assertEquals($expected, $world->config('rom.vanillaBigKeys'));
        $this->assertEquals($expected, $world->config('rom.vanillaCompasses'));
        $this->assertEquals($expected, $world->config('rom.vanillaMaps'));
    }

    public function vanillaDungeonItemsPool()
    {
        return [
            ["NoGlitches", true, false],
            ["NoGlitches", false, false],
            ["MajorGlitches", true, false],
            ["MajorGlitches", false, true],
            ["HybridMajorGlitches", true, false],
            ["HybridMajorGlitches", false, true],
            ["NoLogic", true, false],
            ["NoLogic", false, true],
        ];
    }
}
