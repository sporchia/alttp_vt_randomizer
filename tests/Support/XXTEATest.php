<?php

use ALttP\Support\XXTEA;

class XXTEATest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->xxtea = new XXTEA([2,3,6]);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->xxtea);
	}

	/**
	 * @dataProvider dataPool
	 */
	public function testEncryptor($data, $key) {
		$xxtea = new XXTEA($key);
		$encrypted = $xxtea->encrypt($data);

		$this->assertEquals($data, $xxtea->decrypt($encrypted));
	}

	public function dataPool() {
		return [
			[[24, 35, 12, 43, 22, 120, 40, 128], [12, 0, 13, 240]],
			[[24, 35, 12, 43, 22, 120, 40, 128], []],
		];
	}
}
