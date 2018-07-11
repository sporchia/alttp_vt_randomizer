<?php

use ALttP\Randomizer;
use ALttP\Item;

/**
 * These test may have to be updated on any Logic change that adjusts the pooling of the RNG
 */
class RandomizerTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->randomizer = new Randomizer('test_rules');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->randomizer);
	}

	public function testGetSeedIsNullBeforeRandomization() {
		$this->assertNull($this->randomizer->getSeed());
	}

	public function testGetSeedIsNotNullAfterRandomization() {
		$this->randomizer->makeSeed();

		$this->assertNotNull($this->randomizer->getSeed());
	}

	/**
	 * @group crystals
	 */
	public function testCrystalsNotRandomizedByConfigCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', true);
		Config::set('alttp.test_rules.prize.shuffleCrystals', false);

		$this->randomizer->makeSeed(1337);
		$this->assertEquals([
			Item::get('Crystal1'),
			Item::get('Crystal2'),
			Item::get('Crystal3'),
			Item::get('Crystal4'),
			Item::get('Crystal5'),
			Item::get('Crystal6'),
			Item::get('Crystal7'),
		], [
			$this->randomizer->getWorld()->getLocation("Palace of Darkness - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Swamp Palace - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Skull Woods - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Thieves' Town - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Ice Palace - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Misery Mire - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Turtle Rock - Prize")->getItem(),
		]);
	}

	/**
	 * @group crystals
	 */
	public function testCrystalsNotRandomizedByConfigNoCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', false);
		Config::set('alttp.test_rules.prize.shuffleCrystals', false);

		$this->randomizer->makeSeed(1337);

		$this->assertEquals([
			Item::get('Crystal1'),
			Item::get('Crystal2'),
			Item::get('Crystal3'),
			Item::get('Crystal4'),
			Item::get('Crystal5'),
			Item::get('Crystal6'),
			Item::get('Crystal7'),
		], [
			$this->randomizer->getWorld()->getLocation("Palace of Darkness - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Swamp Palace - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Skull Woods - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Thieves' Town - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Ice Palace - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Misery Mire - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Turtle Rock - Prize")->getItem(),
		]);
	}


	/**
	 * @group pendants
	 */
	public function testPendantsNotRandomizedByConfigNoCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', false);
		Config::set('alttp.test_rules.prize.shufflePendants', false);

		$this->randomizer->makeSeed(1337);

		$this->assertEquals([
			Item::get('PendantOfCourage'),
			Item::get('PendantOfPower'),
			Item::get('PendantOfWisdom'),
		], [
			$this->randomizer->getWorld()->getLocation("Eastern Palace - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Desert Palace - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Tower of Hera - Prize")->getItem(),
		]);
	}

	/**
	 * @group pendants
	 */
	public function testPendantsNotRandomizedByConfigCrossWorld() {
		Config::set('alttp.test_rules.prize.crossWorld', true);
		Config::set('alttp.test_rules.prize.shufflePendants', false);

		$this->randomizer->makeSeed(1337);

		$this->assertEquals([
			Item::get('PendantOfCourage'),
			Item::get('PendantOfPower'),
			Item::get('PendantOfWisdom'),
		], [
			$this->randomizer->getWorld()->getLocation("Eastern Palace - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Desert Palace - Prize")->getItem(),
			$this->randomizer->getWorld()->getLocation("Tower of Hera - Prize")->getItem(),
		]);
	}
}
