<?php

use ALttP\Item;

class ItemTest extends TestCase {
	public function testGetName() {
		$item = new Item('Test', 'Testing Item', [0x0F, 0x00, 't0' => 0x31, 't1' => 0x90]);

		$this->assertEquals('Test', $item->getName());
	}

	public function testGetNiceName() {
		$item = new Item('Test', 'Testing Item', [0x0F, 0x00, 't0' => 0x31, 't1' => 0x90]);

		$this->assertEquals('Testing Item', $item->getNiceName());
	}

	public function testToString() {
		$item = new Item('Test', 'Testing Item', [0x0F]);

		$this->assertEquals('Testa:1:{i:0;i:15;}', (string) $item);
	}

	public function testGetL1Sword() {
		$this->assertEquals([0x49], Item::get('L1Sword')->getBytes());
	}

	public function testGetL1SwordAndShield() {
		$this->assertEquals([0x00], Item::get('L1SwordAndShield')->getBytes());
	}

	public function testGetL2Sword() {
		$this->assertEquals([0x01], Item::get('L2Sword')->getBytes());
	}

	public function testGetMasterSword() {
		$this->assertEquals([0x50], Item::get('MasterSword')->getBytes());
	}

	public function testGetL3Sword() {
		$this->assertEquals([0x02], Item::get('L3Sword')->getBytes());
	}

	public function testGetL4Sword() {
		$this->assertEquals([0x03], Item::get('L4Sword')->getBytes());
	}

	public function testGetRupoor() {
		$this->assertEquals([0x59], Item::get('Rupoor')->getBytes());
	}

	public function testGetRupoorWithByte() {
		$this->assertEquals(Item::get('Rupoor'), Item::getWithByte(0x59));
	}

	public function testGetRupoorWithBytes() {
		$this->assertEquals(Item::get('Rupoor'), Item::getWithBytes([0x59]));
	}

	public function testGetNothing() {
		$this->assertEquals([0x5A], Item::get('Nothing')->getBytes());
	}

	public function testGetRedClock() {
		$this->assertEquals([0x5B], Item::get('RedClock')->getBytes());
	}

	public function testGetBlueClock() {
		$this->assertEquals([0x5C], Item::get('BlueClock')->getBytes());
	}

	public function testGetGreenClock() {
		$this->assertEquals([0x5D], Item::get('GreenClock')->getBytes());
	}

	public function testGetProgressiveSword() {
		$this->assertEquals([0x5E], Item::get('ProgressiveSword')->getBytes());
	}

	public function testGetProgressiveShield() {
		$this->assertEquals([0x5F], Item::get('ProgressiveShield')->getBytes());
	}

	public function testGetProgressiveArmor() {
		$this->assertEquals([0x60], Item::get('ProgressiveArmor')->getBytes());
	}
}
