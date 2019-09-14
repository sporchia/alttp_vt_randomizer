<?php

use ALttP\Support\ItemCollection;
use ALttP\Item;
use ALttP\World;

class ItemCollectionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory();
        $this->collection = new ItemCollection;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->collection);
        unset($this->world);
    }

    public function testCountWithItem()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));

        $this->assertEquals(1, $this->collection->count());
    }

    public function testGlobalCountWithItem()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));

        $this->assertEquals(1, count($this->collection));
    }

    public function testCountWithDifferentItems()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('OneRupee', $this->world));

        $this->assertEquals(2, $this->collection->count());
    }

    public function testGlobalCountWithDifferentItems()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('OneRupee', $this->world));

        $this->assertEquals(2, count($this->collection));
    }

    public function testCountWithSameItem()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L1Sword', $this->world));

        $this->assertEquals(2, $this->collection->count());
    }

    public function testEachWithSameItem()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L1Sword', $this->world));

        $times_run = 0;

        $this->collection->each(function ($item) use (&$times_run) {
            $times_run++;
        });

        $this->assertEquals(2, $times_run);
    }

    public function testMap()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L2Sword', $this->world));

        $mapped = $this->collection->map(function ($item) {
            return explode(':', $item->getName())[0];
        });

        $this->assertEquals(['L1Sword', 'L2Sword'], $mapped);
    }

    public function testMapWithSameItem()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L2Sword', $this->world));

        $mapped = $this->collection->map(function ($item) {
            return explode(':', $item->getName())[0];
        });

        $this->assertEquals(['L1Sword', 'L1Sword', 'L2Sword'], $mapped);
    }

    public function testFilter()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L2Sword', $this->world));
        $this->collection->addItem(Item::get('Map', $this->world));

        $filtered = $this->collection->filter(function ($item) {
            return $item instanceof Item\Sword;
        });

        $this->assertEquals([
            Item::get('L1Sword', $this->world),
            Item::get('L2Sword', $this->world),
        ], $filtered->values());
    }

    public function testFilterSameItem()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('Map', $this->world));

        $filtered = $this->collection->filter(function ($item) {
            return $item instanceof Item\Sword;
        });

        $this->assertEquals([
            Item::get('L1Sword', $this->world),
            Item::get('L1Sword', $this->world),
        ], $filtered->values());
    }

    public function testValues()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L2Sword', $this->world));
        $this->collection->addItem(Item::get('L3Sword', $this->world));

        $this->assertEquals([
            Item::get('L1Sword', $this->world),
            Item::get('L2Sword', $this->world),
            Item::get('L3Sword', $this->world),
        ], $this->collection->values());
    }

    public function testValuesSameItem()
    {
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L1Sword', $this->world));
        $this->collection->addItem(Item::get('L2Sword', $this->world));

        $this->assertEquals([
            Item::get('L1Sword', $this->world),
            Item::get('L1Sword', $this->world),
            Item::get('L2Sword', $this->world),
        ], $this->collection->values());
    }

    /**
     * @dataProvider bottlesPool
     */
    public function testBottleCounting($items)
    {
        $this->addCollected($items);

        $this->assertTrue($this->collected->hasBottle(count($items)));
        $this->assertFalse($this->collected->hasBottle(count($items) + 1));
    }

    public function bottlesPool()
    {
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
