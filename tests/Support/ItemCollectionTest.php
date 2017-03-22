<?php

use ALttP\Support\ItemCollection;
use ALttP\Item;

class ItemCollectionTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->collection = new ItemCollection;
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->collection);
	}

	public function testCountWithItem() {
		$this->collection->addItem(Item::get('L1Sword'));

		$this->assertEquals(1, $this->collection->count());
	}

	public function testGlobalCountWithItem() {
		$this->collection->addItem(Item::get('L1Sword'));

		$this->assertEquals(1, count($this->collection));
	}

	public function testCountWithDifferentItems() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('OneRupee'));

		$this->assertEquals(2, $this->collection->count());
	}

	public function testGlobalCountWithDifferentItems() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('OneRupee'));

		$this->assertEquals(2, count($this->collection));
	}

	public function testCountWithSameItem() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L1Sword'));

		$this->assertEquals(2, $this->collection->count());
	}
}
