<?php

use ALttP\Rom;

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

	public function testSetMaxArrows() {
		$this->rom->setMaxArrows(40);

		$this->assertEquals(40, $this->rom->read(0x180035));
	}

	public function testSetMaxBombs() {
		$this->rom->setMaxBombs(40);

		$this->assertEquals(40, $this->rom->read(0x180034));
	}

	public function testSetUncleText() {
		$this->rom->setUncleText(0x02);

		$this->assertEquals(0x02, $this->rom->read(0x180040));
	}

	public function testSetUncleTextCustom() {
		$this->rom->setUncleTextCustom("1234567890abcd\nline2 specials\n ?!,-.~'");

		$converted = [0, 161, 0, 162, 0, 163, 0, 164, 0, 165, 0, 166, 0, 167, 0, 168, 0, 169, 0, 160, 0, 170, 0, 171, 0,
			172, 0, 173, 117, 0, 181, 0, 178, 0, 183, 0, 174, 0, 162, 0, 255, 0, 188, 0, 185, 0, 174, 0, 172, 0, 178, 0,
			170, 0, 181, 0, 188, 118, 0, 255, 0, 198, 0, 199, 0, 200, 0, 201, 0, 205, 0, 206, 0, 216, 127, 127];

		$this->assertEquals($converted, $this->rom->read(0x10244A, 76));
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

	public function testSetMirrorlessSaveAneQuitToLightWorldOn() {
		$this->rom->setMirrorlessSaveAneQuitToLightWorld(true);

		$this->assertEquals(0x01, $this->rom->read(0x1800A0));
	}

	public function testSetMirrorlessSaveAneQuitToLightWorldOff() {
		$this->rom->setMirrorlessSaveAneQuitToLightWorld(false);

		$this->assertEquals(0x00, $this->rom->read(0x1800A0));
	}
}
