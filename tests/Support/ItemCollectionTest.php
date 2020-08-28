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

    public function canBunnyReviveDataProvider()
    {
        return [
            [[], 'normal', False],
            [['Bottle'], 'normal', False],
            [['Bottle', 'BugCatchingNet'], 'normal', True],
            [['BottleWithFairy', 'BugCatchingNet'], 'normal', True],
            [['Bottle', 'BugCatchingNet'], 'hard', False],
            [['Bottle', 'BugCatchingNet'], 'expert', False],
        ];
    }

    /**
     * @dataProvider canBunnyReviveDataProvider
     */
    public function testCanBunnyRevive($items, $difficultySetting, $expectedResult)
    {
        $this->world = World::factory('standard', ['item.functionality' => $difficultySetting]);
        $this->collected->setChecksForWorld($this->world->id);

        $this->addCollected($items);

        $this->assertEquals($expectedResult, $this->collected->canBunnyRevive($this->world));
    }

    public function canAcquireFairyDataProvider()
    {
        return [
            ["easy", True],
            ["normal", True],
            ["hard", False],
            ["expert", False],
            [null, True]
        ];
    }

    /**
     * @dataProvider canAcquireFairyDataProvider
     */
    public function testCanAcquireFairy($difficultySetting, $expectedResult)
    {
        $world = null;
        if ($difficultySetting !== null)
        {
            $world = World::factory('standard', ['item.functionality' => $difficultySetting]);
        }
        else
        {
            $world = World::factory();
        }
        $this->assertEquals($expectedResult, $this->collection->canAcquireFairy($world));
    }

    public function canExtendMagicDataProvider()
    {
        return [
            [['Bottle'], 'normal', 2, True],
            [['Bottle'], 'normal', 3, False],
            [['Bottle', 'HalfMagic'], 'normal', 4, True],
            [['Bottle', 'HalfMagic'], 'normal', 5, False],
            [['Bottle', 'HalfMagic'], 'hard', 2, True],
            [['Bottle', 'HalfMagic'], 'hard', 3, False],
            [['Bottle', 'Bottle', 'Bottle', 'Bottle', 'QuarterMagic'], 'expert', 5, True],
            [['Bottle', 'Bottle', 'Bottle', 'Bottle', 'QuarterMagic'], 'expert', 6, False],
        ];
    }

    /**
     * @dataProvider canExtendMagicDataProvider
     */
    public function testCanExtendMagic($items, $difficultySetting, $magicBars, $expectedResult)
    {
        $this->world = World::factory('standard', ['item.functionality' => $difficultySetting]);

        $this->collected->setChecksForWorld($this->world->id);

        $this->addCollected($items);

        $this->assertEquals($expectedResult, $this->collected->canExtendMagic($this->world, $magicBars));
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
