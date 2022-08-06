<?php

declare(strict_types=1);

namespace App\Graph;

use App\Graph\Item;
use Illuminate\Support\Arr;

/**
 * Representation of Players inventory for graph based traversal.
 *
 * @immutable
 */
final class Inventory
{
    private array $item_count = [];
    /** @var array<float> */
    private array $health = [];

    /**
     * Create new Inventory instance.
     *
     * @param iterable<Item> $items items to add
     *
     * @return void
     */
    public function __construct(iterable $items = [])
    {
        foreach ($items as $item) {
            $this->addItemByName($item instanceof Item ? $item->name : $item);
        }
    }

    /**
     * Add item to inventory.
     *
     * @param Item|string $item item to add
     */
    public function addItem($item): self
    {
        $new = clone $this;
        $new->addItemByName($item instanceof Item ? $item->name : $item);

        return $new;
    }

    /**
     * Add an item to this by name.
     *
     * @param string $item_name name of item
     */
    private function addItemByName(string $item_name): void
    {
        $this->item_count[$item_name] ??= 0;
        $this->item_count[$item_name]++;

        if (strpos($item_name, 'HeartContainer') !== false) {
            $world_id = Arr::last(explode(':', $item_name));
            $this->health[$world_id] ??= 0;
            $this->health[$world_id] += 1;
        }
        if (strpos($item_name, 'PieceOfHeart') !== false) {
            $world_id = Arr::last(explode(':', $item_name));
            $this->health[$world_id] ??= 0;
            $this->health[$world_id] += .25;
        }
        if (strpos($item_name, 'Bottle') === 0) {
            $world_id = Arr::last(explode(':', $item_name));
            $this->addItemByName("LogicalBottle:$world_id");
        }

        if ($this->item_count[$item_name] > 1) {
            $this->item_count[$item_name . '|' . $this->item_count[$item_name]] = 1;
        }
    }

    /**
     * Get listing of all items contained in Inventory.
     */
    public function all(): array
    {
        return array_keys($this->item_count);
    }

    /**
     * Get all items in inventory as Items.
     */
    public function toArray(): array
    {
        $return = [];
        foreach ($this->item_count as $key => $count) {
            if (strpos($key, '|') !== false) {
                continue;
            }
            [$name, $world_id] = explode(':', $key);
            for ($i = 0; $i < $count; ++$i) {
                $return[] = Item::get($name, (int) $world_id);
            }
        }
        return $return;
    }

    /**
     * Determine how many of a particular item are in inventory.
     * 
     * @param string $key item name to search for
     */
    public function getCount(string $key): int
    {
        if (strpos($key, ':') === false) {
            $key = "$key:0";
        }

        if (strpos($key, 'Bottle') === 0) {
            $world_id = Arr::last(explode(':', $key));
            $key = "LogicalBottle:$world_id";
        }

        return $this->item_count[$key] ?? 0;
    }

    /**
     * Get the key to use for getting a count of items.
     * 
     * @param string $key name of item in subset
     */
    public function getCountKey(string $key): string
    {
        $key = preg_replace('/\|\d+$/', '', $key);
        if (strpos($key, ':') === false) {
            $key = "$key:0";
        }

        if (strpos($key, 'Bottle') === 0) {
            $world_id = Arr::last(explode(':', $key));
            $key = "LogicalBottle:$world_id";
        }

        $count = $this->item_count[$key] ?? 0;

        if ($count === 0) {
            return '';
        }

        if ($count === 1) {
            return $key;
        }

        return "$key|$count";
    }

    /**
     * Verify if item is in inventory.
     *
     * @param string $item_name
     */
    public function has(string $item_name): bool
    {
        if (strpos($item_name, ':') === false) {
            $item_name = "$item_name:0";
        }

        return ($this->item_count[$item_name] ?? 0) > 0;
    }

    /**
     * Get new Inventory with merge from another Inventory.
     *
     * @param self $inventory Inventory to merge
     */
    public function merge(self $inventory): self
    {
        $new = clone $this;

        foreach ($inventory->item_count as $key => $count) {
            if (strpos($key, '|') !== false) {
                continue;
            }

            $new->item_count[$key] ??= 0;
            $new->item_count[$key] += $count;

            for ($i = $this->item_count[$key] ?? 0; $i < $new->item_count[$key]; ++$i) {
                $new->item_count[$key . '|' . ($i + 1)] = 1;
            }
        }

        return $new;
    }

    /**
     * Get the health value available based on items in this world.
     * 
     * @param int $world_id world id for which we care about count
     */
    public function heartCount(int $world_id): float
    {
        return $this->health[$world_id] ?? 0;
    }
}
