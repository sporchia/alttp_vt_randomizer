<?php

use ALttP\Support\Lz2;

class Lz2Test extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->lz2 = new Lz2;
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->lz2);
	}

	public function testCompressDirectCopy() {
		$this->assertEquals([0 << 5 | 4, 1, 3, 5, 7, 9, 255], $this->lz2->compress([1, 3, 5, 7, 9]));
	}

	public function testCompressDirectCopyMultiple() {
		$to_compress = range(1, 2059, 2);
		$this->assertEquals(array_merge([227, 254], array_slice($to_compress, 0, 1023), [6], array_slice($to_compress, 1023), [255]), $this->lz2->compress($to_compress));
	}

	public function testCompressByteFill() {
		$this->assertEquals([1 << 5 | 10, 1, 255], $this->lz2->compress([1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]));
	}

	public function testCompressWordFill() {
		$this->assertEquals([2 << 5 | 9, 1, 2, 255], $this->lz2->compress([1, 2, 1, 2, 1, 2, 1, 2, 1, 2]));
	}

	public function testCompressIncreaseFill() {
		$this->assertEquals([3 << 5 | 9, 1, 255], $this->lz2->compress([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]));
	}

	public function testCompressRepeat() {
		$this->assertEquals([0 << 5 | 4, 1, 3, 5, 7, 9, 4 << 5 | 4, 0, 0, 255], $this->lz2->compress([1, 3, 5, 7, 9, 1, 3, 5, 7, 9]));
	}

	public function testCompressLongCommand() {
		$this->assertEquals([229, 1, 1, 255], $this->lz2->compress(array_fill(0, 258, 1)));
	}

	public function testCompressEmpty() {
		$this->expectException(Exception::class);

		$this->lz2->compress([]);
	}

	public function testDecompressDirectCopy() {
		$this->assertEquals([1, 3, 5, 7, 9], $this->lz2->decompress([4, 1, 3, 5, 7, 9, 255]));
	}

	public function testDecompressByteFill() {
		$this->assertEquals([1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], $this->lz2->decompress([1 << 5 | 10, 1, 255]));
	}

	public function testDecompressWordFill() {
		$this->assertEquals([1, 2, 1, 2, 1, 2, 1, 2, 1, 2], $this->lz2->decompress([2 << 5 | 9, 1, 2, 255]));
	}

	public function testDecompressIncreaseFill() {
		$this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $this->lz2->decompress([3 << 5 | 9, 1, 255]));
	}

	public function testDecompressRepeat() {
		$this->assertEquals([1, 3, 5, 7, 9, 1, 3, 5, 7, 9], $this->lz2->decompress([0 << 5 | 4, 1, 3, 5, 7, 9, 4 << 5 | 4, 0, 0, 255]));
	}

	public function testDecompressLongCommand() {
		$this->assertEquals(array_fill(0, 258, 1), $this->lz2->decompress([229, 1, 1, 255]));
	}

	public function testDecompressEmpty() {
		$this->expectException(Exception::class);

		$this->lz2->decompress([]);
	}

	public function testDecompressBadCommand() {
		$this->expectException(Exception::class);

		$this->lz2->decompress([5 << 5 | 1, 1, 1, 225]);
	}

}
