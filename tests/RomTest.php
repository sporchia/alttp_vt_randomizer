<?php

use ALttP\Rom;

class RomTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->rom = new Rom;
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

}
