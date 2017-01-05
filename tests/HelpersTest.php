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
}
