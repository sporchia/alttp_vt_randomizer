<?php

declare(strict_types=1);

namespace App\Graph;

/**
 * An Item is any collectable thing in game.
 */
final class Item
{
    /** @var array<int> */
    public readonly array $bytes;
    public readonly string $raw_name;
    public readonly string $name;
    public readonly string $nice_name;
    public readonly string $i18n_name;
    public readonly int $world_id;
    public bool $meta = false;
    /** @var array<array<Item>> */
    private static array $items;
    private static array $raw_items = [];

    /**
     * Get the Item by name
     *
     * @param string $name Name of Item
     * @param int $world_id World item belongs to
     */
    public static function get(string $name, int $world_id): self
    {
        $items = static::all($world_id);
        $world_name = $name . ':' . $world_id;

        if (isset($items[$world_name])) {
            return $items[$world_name];
        }

        // allow made up items
        $item = new Item($name, [null], $world_id);
        $item->meta = true;
        self::$items[$world_id][$item->name] = $item;

        return $item;
    }

    /**
     * Get the all known Items.
     *
     * @param int $world_id World item belongs to
     */
    public static function all(int $world_id): array
    {
        if (isset(static::$items[$world_id])) {
            return static::$items[$world_id];
        }

        static::$items[$world_id] = [];

        if (static::$raw_items === []) {
            static::$raw_items = ymlReadFile(app_path('Graph/data/items.yml'));
        }

        foreach (static::$raw_items as $item_name => $item_data) {
            static::$items[$world_id]["$item_name:$world_id"] = new Item($item_name, $item_data['bytes'], $world_id);
        }

        return static::all($world_id);
    }

    /**
     * Create a new Item.
     *
     * @param string $name Unique name of item
     * @param int[]|null[] $bytes data to write to Location addresses
     * @param int $world_id world for which the item belongs
     *
     * @return void
     */
    public function __construct(string $name, array $bytes, int $world_id)
    {
        $this->raw_name = $name;
        $this->name = $name . ':' . $world_id;;
        $this->i18n_name = 'item.' . $name;
        $formatted = __($this->i18n_name);
        $this->nice_name = is_string($formatted) ? $formatted : '';
        $this->bytes = $bytes;
        $this->world_id = $world_id;
    }

    /**
     * serialized version of Item.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
