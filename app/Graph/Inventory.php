<?php

declare(strict_types=1);

namespace App\Graph;

use App\Graph\Item;
use Exception;

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
     * @param iterable<Item|string> $items items to add
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

        if (str_starts_with($item_name, 'HeartContainer')) {
            $parts = explode(':', $item_name);
            $world_id = end($parts);
            $this->health[$world_id] ??= 0;
            $this->health[$world_id] += 1;
        } else if (str_starts_with($item_name, 'PieceOfHeart')) {
            $parts = explode(':', $item_name);
            $world_id = end($parts);
            $this->health[$world_id] ??= 0;
            $this->health[$world_id] += .25;
        } else if (str_starts_with($item_name, 'Bottle')) {
            $parts = explode(':', $item_name);
            $world_id = end($parts);
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
        if (str_starts_with($key, 'Bottle')) {
            $parts = explode(':', $key);
            $world_id = end($parts);
            $key = "LogicalBottle:$world_id";
        }

        return $this->item_count[$key] ?? 0;
    }

    /**
     * Verify if item is in inventory.
     *
     * @param string $item_name
     */
    public function has(string $item_name): bool
    {
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
