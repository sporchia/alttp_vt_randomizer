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

	public function testEachWithSameItem() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L1Sword'));

		$times_run = 0;

		$this->collection->each(function($item) use (&$times_run) {
			$times_run++;
		});

		$this->assertEquals(2, $times_run);
	}

	public function testMap() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L2Sword'));

		$mapped = $this->collection->map(function($item) {
			return $item->getName();
		});

		$this->assertEquals(['L1Sword', 'L2Sword'], $mapped);
	}

	public function testMapWithSameItem() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L2Sword'));

		$mapped = $this->collection->map(function($item) {
			return $item->getName();
		});

		$this->assertEquals(['L1Sword', 'L1Sword', 'L2Sword'], $mapped);
	}

	public function testFilter() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L2Sword'));
		$this->collection->addItem(Item::get('Map'));

		$filtered = $this->collection->filter(function($item) {
			return is_a($item, Item\Sword::class);
		});

		$this->assertEquals([
			Item::get('L1Sword'),
			Item::get('L2Sword'),
		], $filtered->values());
	}

	public function testFilterSameItem() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('Map'));

		$filtered = $this->collection->filter(function($item) {
			return is_a($item, Item\Sword::class);
		});

		$this->assertEquals([
			Item::get('L1Sword'),
			Item::get('L1Sword'),
		], $filtered->values());
	}

	public function testValues() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L2Sword'));
		$this->collection->addItem(Item::get('L3Sword'));

		$this->assertEquals([
			Item::get('L1Sword'),
			Item::get('L2Sword'),
			Item::get('L3Sword'),
		], $this->collection->values());
	}

	public function testValuesSameItem() {
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L1Sword'));
		$this->collection->addItem(Item::get('L2Sword'));

		$this->assertEquals([
			Item::get('L1Sword'),
			Item::get('L1Sword'),
			Item::get('L2Sword'),
		], $this->collection->values());
	}

	/**
	 * @dataProvider bottlesPool
	 */
	public function testBottleCounting($items) {
		$this->addCollected($items);

		$this->assertTrue($this->collected->hasBottle(count($items)));
		$this->assertFalse($this->collected->hasBottle(count($items) + 1));
	}

	public function bottlesPool() {
		return [
			[['Bottle']],
			[['BottleWithBee']],
			[['BottleWithFairy']],
			[['BottleWithRedPotion']],
			[['BottleWithGreenPotion']],
			[['BottleWithBluePotion']],
			[['BottleWithGoldBee']],
			[['Bottle', 'Bottle']],
			[['Bottle', 'Bottle', 'Bottle']],
			[['Bottle', 'Bottle', 'Bottle', 'Bottle']],
			[['Bottle', 'Bottle', 'Bottle', 'BottleWithBee']],
			[['Bottle', 'Bottle', 'BottleWithBee', 'BottleWithBee']],
		];
	}
}
