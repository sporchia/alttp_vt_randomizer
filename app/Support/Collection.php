<?php

namespace ALttP\Support;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Illuminate\Contracts\Support\Arrayable;
use IteratorAggregate;
use Traversable;

/**
 * Collection's aim to expand on the array native, and give meaningful accessors and extra functionality related to the
 * underlying elements.
 */
class Collection implements ArrayAccess, Countable, IteratorAggregate
{
    protected $items = [];

    /**
     * Create a new collection.
     *
     * @param mixed $items
     *
     * @return void
     */
    public function __construct($items = [])
    {
        $this->items = is_array($items) ? $items : $this->getArrayableItems($items);
    }

    /**
     * Remove an item from the collection.
     *
     * @return $this
     */
    public function removeItem($item)
    {
        foreach ($this->items as $key => $search_item) {
            if ($search_item === $item) {
                $this->offsetUnset($key);

                break;
            }
        }

        return $this;
    }

    /**
     * Get one item randomly from the collection.
     *
     * @return mixed
     */
    public function random()
    {
        $new = $this->values();
        if ($this->count() === 0) {
            return null;
        }
        return $new[get_random_int(0, $this->count() - 1)];
    }

    /**
     * Get a random subset of the collection of given size
     *
     * @param int $number size of the new collection
     *
     * @return static
     */
    public function randomCollection($number = 1)
    {
        $old = $this->values();
        $new = [];
        while ($number-- > 0 && count($old) > 0) {
            $new = array_merge($new, array_splice($old, get_random_int(0, count($old) - 1), 1));
        }
        return new static($new);
    }

    /**
     * Run a filter over each of the items.
     *
     * @param callable|null $callback
     *
     * @return static
     */
    public function filter(callable $callback = null)
    {
        if ($callback) {
            return new static(array_filter($this->items, $callback));
        }

        return new static(array_filter($this->items));
    }

    /**
     * Get an array of the underlying elements
     *
     * @return array
     */
    public function values()
    {
        return array_values($this->items);
    }

    /**
     * Get the items in the collection that are not present in the given items.
     *
     * @param mixed $items items to diff against
     *
     * @return static
     */
    public function diff($items)
    {
        return new static(array_diff($this->items, $this->getArrayableItems($items)));
    }

    /**
     * Reverese the order of the items.
     *
     * @return static
     */
    public function reverse()
    {
        return new static(array_reverse($this->items));
    }

    /**
     * Execute a callback over each item.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function each(callable $callback)
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * Get the first item from the collection.
     *
     * @return mixed
     */
    public function first()
    {
        return reset($this->items);
    }

    /**
     * Get the next item from the collection based on internal pointer.
     *
     * @return mixed
     */
    public function next()
    {
        return next($this->items) === false ? $this->first() : current($this->items);
    }


    /**
     * Get the last item from the collection.
     *
     * @return mixed
     */
    public function last()
    {
        return end($this->items);
    }

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Get and remove the last item from the collection.
     *
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * Push an item onto the beginning of the collection.
     *
     * @param  mixed  $value
     *
     * @return $this
     */
    public function unshift($value)
    {
        array_unshift($this->items, $value);

        return $this;
    }

    /**
     * Get and remove an item from the begining collection.
     *
     * @return mixed
     */
    public function shift()
    {
        return array_shift($this->items);
    }

    /**
     * Take the first or last {$limit} items.
     *
     * @param int $limit
     *
     * @return static
     */
    public function take($limit)
    {
        if ($limit < 0) {
            return $this->slice($limit, abs($limit));
        }

        return $this->slice(0, $limit);
    }

    /**
     * Slice the underlying collection array.
     *
     * @param int $offset
     * @param int $length
     *
     * @return static
     */
    public function slice($offset, $length = null)
    {
        return new static(array_slice($this->items, $offset, $length, true));
    }

    /**
     * Merge the collection with the given items.
     *
     * @param mixed $items
     *
     * @return static
     */
    public function merge($items)
    {
        return new static(array_merge($this->items, $this->getArrayableItems($items)));
    }

    /**
     * Get a fresh copy of this object, the underlying items will still be the same
     *
     * @return static
     */
    public function copy()
    {
        return new static($this->items);
    }

    /**
     * Reduce the collection to a single value.
     *
     * @param callable $callback
     * @param mixed $initial
     *
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null)
    {
        return array_reduce($this->items, $callback, $initial);
    }

    /**
     * Run a map over each of the items.
     *
     * @param callable $callback
     *
     * @return array
     */
    public function map(callable $callback)
    {
        $keys = array_keys($this->items);

        $items = array_map($callback, $this->items, $keys);

        return array_combine($keys, $items) ?: [];
    }

    /**
     * Get the keys of the collection items.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->items);
    }

    /**
     * Determine if an item exists in the collection by key.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function has($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Intersect the collection with the given items.
     *
     * @param  mixed  $items
     *
     * @return static
     */
    public function intersect($items)
    {
        return new static(array_intersect($this->items, $this->getArrayableItems($items)));
    }

    /**
     * Determine if an item exists in the collection.
     *
     * @param mixed $item
     *
     * @return bool
     */
    public function contains($item)
    {
        return in_array($item, $this->items);
    }

    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : $value;
        }, $this->items);
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * Get an item at a given offset.
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    /**
     * Set the item at a given offset.
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Get an iterator for the items.
     *
     * @return ArrayIterator
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Results array of items from Collection or Arrayable.
     *
     * @param mixed $items
     *
     * @return array
     */
    protected function getArrayableItems($items)
    {
        if ($items instanceof self) {
            return $items->values();
        }

        return (array) $items;
    }
}
