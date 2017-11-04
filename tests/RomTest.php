<?php

use ALttP\Item;
use ALttP\Rom;
use ALttP\Support\ItemCollection;

class RomTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->rom = new Rom;
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->rom);
	}

	public function testCheckMD5WithNoBaseFile() {
		$this->assertFalse($this->rom->checkMD5());
	}

	public function testSetHeartBeepSpeedOff() {
		$this->rom->setHeartBeepSpeed('off');

		$this->assertEquals(0x00, $this->rom->read(0x180033));
	}

	public function testSetHeartBeepSpeedNormal() {
		$this->rom->setHeartBeepSpeed('normal');

		$this->assertEquals(0x20, $this->rom->read(0x180033));
	}

	public function testSetHeartBeepSpeedHalf() {
		$this->rom->setHeartBeepSpeed('half');

		$this->assertEquals(0x40, $this->rom->read(0x180033));
	}

	public function testSetHeartBeepSpeedQuarter() {
		$this->rom->setHeartBeepSpeed('quarter');

		$this->assertEquals(0x80, $this->rom->read(0x180033));
	}

	public function testSetHeartBeepSpeedUnknownSetsNormal() {
		$this->rom->setHeartBeepSpeed('testing');

		$this->assertEquals(0x20, $this->rom->read(0x180033));
	}

	public function testSetRupoor() {
		$this->rom->setRupoorValue(40);

		$this->assertEquals([0x28, 0x00], $this->rom->read(0x180036, 2));
	}

	public function testSetRupoorLarge() {
		$this->rom->setRupoorValue(999);

		$this->assertEquals([0xE7, 0x03], $this->rom->read(0x180036, 2));
	}

	public function testSetByrnaCaveSpikeDamageDefault() {
		$this->rom->setByrnaCaveSpikeDamage();

		$this->assertEquals(0x08, $this->rom->read(0x180168));
	}

	public function testSetByrnaCaveSpikeDamage() {
		$this->rom->setByrnaCaveSpikeDamage(0x02);

		$this->assertEquals(0x02, $this->rom->read(0x180168));
	}

	public function testSetClockModeDefault() {
		$this->rom->setClockMode();

		$this->assertEquals([0x00, 0x00, 0x00], $this->rom->read(0x180190, 3));
	}

	public function testSetClockModeCountdownStopNoReset() {
		$this->rom->setClockMode('countdown-stop');

		$this->assertEquals([0x01, 0x00, 0x00], $this->rom->read(0x180190, 3));
	}

	public function testSetClockModeCountdownContinueNoReset() {
		$this->rom->setClockMode('countdown-continue');

		$this->assertEquals([0x01, 0x01, 0x00], $this->rom->read(0x180190, 3));
	}

	public function testSetClockModeStopwatchNoReset() {
		$this->rom->setClockMode('stopwatch');

		$this->assertEquals([0x02, 0x01, 0x00], $this->rom->read(0x180190, 3));
	}

	public function testSetClockModeCountdownStopReset() {
		$this->rom->setClockMode('countdown-stop', true);

		$this->assertEquals([0x01, 0x00, 0x01], $this->rom->read(0x180190, 3));
	}

	public function testSetClockModeCountdownContinueReset() {
		$this->rom->setClockMode('countdown-continue', true);

		$this->assertEquals([0x01, 0x01, 0x01], $this->rom->read(0x180190, 3));
	}

	public function testSetClockModeStopwatchReset() {
		$this->rom->setClockMode('stopwatch', true);

		$this->assertEquals([0x02, 0x01, 0x01], $this->rom->read(0x180190, 3));
	}

	public function testSetStartingTime() {
		// 5 hours
		$this->rom->setStartingTime(5 * 60 * 60);

		$this->assertEquals([0xC0, 0x7A, 0x10, 0x00], $this->rom->read(0x18020C, 4));
	}

	public function testSetRedClock() {
		$this->rom->setRedClock(5 * 60);

		$this->assertEquals([0x50, 0x46, 0x00, 0x00], $this->rom->read(0x180200, 4));
	}

	public function testSetBlueClock() {
		$this->rom->setBlueClock(5 * 60);

		$this->assertEquals([0x50, 0x46, 0x00, 0x00], $this->rom->read(0x180204, 4));
	}

	public function testSetGreenClock() {
		$this->rom->setGreenClock(5 * 60);

		$this->assertEquals([0x50, 0x46, 0x00, 0x00], $this->rom->read(0x180208, 4));
	}

	public function testSetMaxArrows() {
		$this->rom->setMaxArrows(40);

		$this->assertEquals(40, $this->rom->read(0x180035));
	}

	public function testSetMaxBombs() {
		$this->rom->setMaxBombs(40);

		$this->assertEquals(40, $this->rom->read(0x180034));
	}

	public function testSetCapacityUpgradeFills() {
		$this->rom->setCapacityUpgradeFills([1, 2, 0, 0, 20]);

		$this->assertEquals([1, 2, 0, 0], $this->rom->read(0x180080, 4));
	}

	public function setBottleFills() {
		$this->rom->setCapacityUpgradeFills([1, 2, 0, 0, 20]);

		$this->assertEquals([1, 2], $this->rom->read(0x180084, 2));
	}

	public function testSetUncleTextCustom() {
		$this->rom->setUncleTextString("1234567890abcd\nline2 specials\n ?!,-.~'");

		$converted = [116, 0, 161, 0, 162, 0, 163, 0, 164, 0, 165, 0, 166, 0, 167, 0, 168, 0, 169, 0, 160, 0, 170, 0,
			171, 0, 172, 0, 173, 117, 0, 181, 0, 178, 0, 183, 0, 174, 0, 162, 0, 255, 0, 188, 0, 185, 0, 174, 0, 172,
			0, 178, 0, 170, 0, 181, 0, 188, 118, 0, 255, 0, 198, 0, 199, 0, 200, 0, 201, 0, 205, 0, 206, 0, 216, 127];

		$this->assertEquals($converted, $this->rom->read(0x180500, 76));
	}

	public function testSetDebugModeOn() {
		$this->rom->setDebugMode(true);

		$this->assertEquals([[0xEA, 0xEA],[0xEA, 0xEA]], [$this->rom->read(0x65B88, 2), $this->rom->read(0x65B91, 2)]);
	}

	public function testSetDebugModeOff() {
		$this->rom->setDebugMode(false);

		$this->assertEquals([[0xF0, 0x21],[0xD0, 0x18]], [$this->rom->read(0x65B88, 2), $this->rom->read(0x65B91, 2)]);
	}

	public function testSetSRAMTraceOn() {
		$this->rom->setSRAMTrace(true);

		$this->assertEquals(0x01, $this->rom->read(0x180030));
	}

	public function testSetSRAMTraceOff() {
		$this->rom->setSRAMTrace(false);

		$this->assertEquals(0x00, $this->rom->read(0x180030));
	}

	public function testSetSingleRNGTable() {
		$items = new ItemCollection([
			Item::get('ProgressiveSword'),
			Item::get('ProgressiveSword'),
			Item::get('ProgressiveSword'),
			Item::get('ProgressiveGlove'),
		]);

		$this->rom->setSingleRNGTable($items);

		$this->assertEquals([[0x5E, 0x5E, 0x5E, 0x61], 0x04],
			[$this->rom->read(0x182000, 4), $this->rom->read(0x18207F)]);
	}

	public function testSetMultiRNGTable() {
		$items = new ItemCollection([
			Item::get('ProgressiveSword'),
			Item::get('ProgressiveSword'),
			Item::get('ProgressiveGlove'),
		]);

		$this->rom->setMultiRNGTable($items);

		$this->assertEquals([[0x5E, 0x5E, 0x61], 0x03],
			[$this->rom->read(0x182080, 3), $this->rom->read(0x1820FF)]);
	}

	public function testSetRandomizerSeedTypeMajorGlitches() {
		$this->rom->setRandomizerSeedType('MajorGlitches');

		$this->assertEquals(0x01, $this->rom->read(0x180210));
	}

	public function testSetRandomizerSeedTypeNormal() {
		$this->rom->setRandomizerSeedType('NoMajorGlitches');

		$this->assertEquals(0x00, $this->rom->read(0x180210));
	}

	public function testSetRandomizerSeedTypeDefaultsToNMG() {
		$this->rom->setRandomizerSeedType('badType');

		$this->assertEquals(0x00, $this->rom->read(0x180210));
	}

	public function testSetRandomizerSeedTypeOff() {
		$this->rom->setRandomizerSeedType('off');

		$this->assertEquals(0xFF, $this->rom->read(0x180210));
	}

	public function testSetGameTypePlandomizer() {
		$this->rom->setGameType('Plandomizer');

		$this->assertEquals(0x01, $this->rom->read(0x180211));
	}

	public function testSeGameTypeRandomizer() {
		$this->rom->setGameType('Randomizer');

		$this->assertEquals(0x00, $this->rom->read(0x180211));
	}

	public function testSetPlandomizerAuthor() {
		$this->rom->setPlandomizerAuthor('123456789012345678901');

		$this->assertEquals([49,50,51,52,53,54,55,56,57,48,49,50,51,52,53,54,55,56,57,48,49], $this->rom->read(0x180220, 31));
	}

	public function testSeGameTypeDefaultsToRandomizer() {
		$this->rom->setGameType('badType');

		$this->assertEquals(0x00, $this->rom->read(0x180211));
	}

	public function testSeGameTypeOther() {
		$this->rom->setGameType('other');

		$this->assertEquals(0xFF, $this->rom->read(0x180211));
	}

	public function testSetHardMode2ChangesCapeMagicUsage() {
		$this->rom->setHardMode(2);

		$this->assertEquals([0x01, 0x01, 0x01], $this->rom->read(0x3ADA7, 3));
	}

	public function testSetHardMode1ChangesCapeMagicUsage() {
		$this->rom->setHardMode(1);

		$this->assertEquals([0x02, 0x02, 0x02], $this->rom->read(0x3ADA7, 3));
	}

	public function testSetHardMode0ChangesCapeMagicUsage() {
		$this->rom->setHardMode(0);

		$this->assertEquals([0x04, 0x08, 0x10], $this->rom->read(0x3ADA7, 3));
	}

	public function testSetHardMode2ChangesBubbleTransform() {
		$this->rom->setHardMode(2);

		$this->assertEquals(0x79, $this->rom->read(0x36DD0));
	}

	public function testSetHardMode1ChangesBubbleTransform() {
		$this->rom->setHardMode(1);

		$this->assertEquals(0xD8, $this->rom->read(0x36DD0));
	}

	public function testSetHardMode0ChangesBubbleTransform() {
		$this->rom->setHardMode(0);

		$this->assertEquals(0xE3, $this->rom->read(0x36DD0));
	}

	public function testSetSmithyQuickItemGiveOn() {
		$this->rom->setSmithyQuickItemGive(true);

		$this->assertEquals(0x01, $this->rom->read(0x180029));
	}

	public function testSetSmithyQuickItemGiveOff() {
		$this->rom->setSmithyQuickItemGive(false);

		$this->assertEquals(0x00, $this->rom->read(0x180029));
	}

	public function testSetPyramidFairyChestsOn() {
		$this->rom->setPyramidFairyChests(true);

		$this->assertEquals([0xB1, 0xC6, 0xF9, 0xC9, 0xC6, 0xF9], $this->rom->read(0x1FC16, 6));
	}

	public function testSetPyramidFairyChestsOff() {
		$this->rom->setPyramidFairyChests(false);

		$this->assertEquals([0xA8, 0xB8, 0x3D, 0xD0, 0xB8, 0x3D], $this->rom->read(0x1FC16, 6));
	}

	public function testSetOpenModeOn() {
		$this->rom->setOpenMode(true);

		$this->assertEquals(0x01, $this->rom->read(0x180032));
	}

	public function testSetOpenModeOff() {
		$this->rom->setOpenMode(false);

		$this->assertEquals(0x00, $this->rom->read(0x180032));
	}

	public function testSetSewersLampConeOn() {
		$this->rom->setSewersLampCone(true);

		$this->assertEquals(0x01, $this->rom->read(0x180038));
	}

	public function testSetSewersLampConeOff() {
		$this->rom->setSewersLampCone(false);

		$this->assertEquals(0x00, $this->rom->read(0x180038));
	}

	public function testSetLightWorldLampConeOn() {
		$this->rom->setLightWorldLampCone(true);

		$this->assertEquals(0x01, $this->rom->read(0x180039));
	}

	public function testSetLightWorldLampConeOff() {
		$this->rom->setLightWorldLampCone(false);

		$this->assertEquals(0x00, $this->rom->read(0x180039));
	}

	public function testSetDarkWorldLampConeOn() {
		$this->rom->setDarkWorldLampCone(true);

		$this->assertEquals(0x01, $this->rom->read(0x18003A));
	}

	public function testSetDarkWorldLampConeOff() {
		$this->rom->setDarkWorldLampCone(false);

		$this->assertEquals(0x00, $this->rom->read(0x18003A));
	}

	public function testSetMirrorlessSaveAndQuitToLightWorldOn() {
		$this->rom->setMirrorlessSaveAndQuitToLightWorld(true);

		$this->assertEquals(0x01, $this->rom->read(0x1800A0));
	}

	public function testSetMirrorlessSaveAndQuitToLightWorldOff() {
		$this->rom->setMirrorlessSaveAndQuitToLightWorld(false);

		$this->assertEquals(0x00, $this->rom->read(0x1800A0));
	}

	public function testSetSwampWaterLevelOn() {
		$this->rom->setSwampWaterLevel(true);

		$this->assertEquals(0x01, $this->rom->read(0x1800A1));
	}

	public function testSetSwampWaterLevelOff() {
		$this->rom->setSwampWaterLevel(false);

		$this->assertEquals(0x00, $this->rom->read(0x1800A1));
	}

	public function testSetPreAgahnimDarkWorldDeathInDungeonOn() {
		$this->rom->setPreAgahnimDarkWorldDeathInDungeon(true);

		$this->assertEquals(0x01, $this->rom->read(0x1800A2));
	}

	public function testSetPreAgahnimDarkWorldDeathInDungeonOff() {
		$this->rom->setPreAgahnimDarkWorldDeathInDungeon(false);

		$this->assertEquals(0x00, $this->rom->read(0x1800A2));
	}

	public function testSetSeedString() {
		$this->rom->setSeedString('123456789012345678901');

		$this->assertEquals([49,50,51,52,53,54,55,56,57,48,49,50,51,52,53,54,55,56,57,48,49], $this->rom->read(0x7FC0, 21));
	}

	public function testSetSeedStringNotLongerThan21Chars() {
		$this->rom->setSeedString('aaaaaaaaaaaaaaaaaaaaaaaaa');

		$this->assertEquals([97,97,97,97,97,97,97,97,97,97,97,97,97,97,97,97,97,97,97,97,97], $this->rom->read(0x7FC0, 25));
	}

}
