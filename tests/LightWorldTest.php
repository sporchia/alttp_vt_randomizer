<?php

use ALttP\World;

/**
 * @group config
 */
class LightWorldTest extends TestCase {
	public function testBlacksmithAddressSwordShuffleOn() {
		config(['alttp.test_rules.region.swordsInPool' => true]);

		$world = new World('test_rules');

		$this->assertEquals([0x18002A], $world->getLocation("Blacksmiths")->getAddress());
	}

	public function testBlacksmithAddressSwordShuffleOff() {
		config(['alttp.test_rules.region.swordsInPool' => false]);

		$world = new World('test_rules');

		$this->assertEquals([0x3355C], $world->getLocation("Blacksmiths")->getAddress());
	}
}
