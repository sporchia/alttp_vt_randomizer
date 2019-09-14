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
}
