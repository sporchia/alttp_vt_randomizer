<?php

use ALttP\World;

/**
 * @group config
 */
class LightWorldTest extends TestCase
{
    public function testBlacksmithAddressSwordShuffleOn()
    {
        $world = World::factory('standard', [
            'region.swordsInPool' => true,
        ]);

        $this->assertEquals([0x18002A], $world->getLocation("Blacksmith")->getAddress());
    }

    public function testBlacksmithAddressSwordShuffleOff()
    {
        $world = World::factory('standard', [
            'region.swordsInPool' => false,
        ]);

        $this->assertEquals([0x3355C], $world->getLocation("Blacksmith")->getAddress());
    }
}
