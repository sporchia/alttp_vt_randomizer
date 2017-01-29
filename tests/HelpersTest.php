<?php

class HelpersTest extends TestCase {
	// it's highly unlikely that this will fail
	public function testMtShuffleDifferentReturn() {
		$unshuffled = range(0, 1000);

		$this->assertNotEquals(mt_shuffle($unshuffled), $unshuffled);
	}

	public function testMtShuffleSameValues() {
		$unshuffled = range(0, 1000);
		$shuffled = mt_shuffle($unshuffled);

		sort($unshuffled);
		sort($shuffled);

		$this->assertEquals($unshuffled, $shuffled);
	}
/*
	public function testKsortr() {
		$unsorted = [
			'zed' => [
				'1' => '2',
				'red' => '4',
				'fed' => 0,
			],
			'yo' => [
				'3' => 'hello',
				'goo' => 'foo',
				'bar' => 'baz',
			],
		];
		ksortr($unsorted);
		$this->assertSame([
			'yo' => [
				'bar' => 'baz',
				'goo' => 'foo',
				'3' => 'hello',
			],
			'zed' => [
				'fed' => 0,
				'red' => '4',
				'1' => '2',
			],
		], $unsorted);
	}
	*/
}
