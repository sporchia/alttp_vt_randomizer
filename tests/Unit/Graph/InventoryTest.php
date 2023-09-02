<?php

declare(strict_types=1);

namespace Tests\Unit\Graph;

use App\Graph\Inventory;
use App\Graph\Item;
use Tests\TestCase;

/**
 * Basic Graph testing, this still move to appropo places later.
 *
 * @covers App\Graph\Inventory
 * @group graph
 */
final class InventoryTest extends TestCase
{
    public function testConstructWithItems(): void
    {
        $item1 = new Item('TestItem1', [], 0);
        $inventory = new Inventory([$item1]);

        $this->assertTrue($inventory->has($item1->name));
    }

    public function testAddMultipleSameItem(): void
    {
        $item1 = new Item('TestItem1', [], 0);
        $inventory = new Inventory([$item1]);

        $i2 = $inventory->merge($inventory);
        $this->assertTrue($i2->has($item1->name));
        $this->assertTrue($i2->has($item1->name . '|2'));
        $i3 = $i2->merge($inventory);
        $this->assertTrue($i3->has($item1->name . '|3'));
    }

    public function testMerge(): void
    {
        $item1 = new Item('TestItem1', [], 0);
        $inventory = new Inventory([$item1, $item1]);
        $inventory2 = new Inventory([$item1]);

        $merged = $inventory->merge($inventory2);
        $this->assertTrue($merged->has($item1->name . '|3'));

        $merged = $inventory2->merge($inventory);
        $this->assertTrue($merged->has($item1->name . '|3'));
    }

    public function testAddItem(): void
    {
        $item1 = new Item('TestItem1', [], 0);
        $inventory = new Inventory([$item1, $item1]);
        $inventory2 = $inventory->addItem($item1);

        $this->assertNotSame($inventory, $inventory2);
        $this->assertTrue($inventory->has($item1->name . '|2'));
        $this->assertTrue($inventory2->has($item1->name . '|3'));
    }
}
