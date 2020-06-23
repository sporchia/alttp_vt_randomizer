<?php

namespace ALttP\Support;

use ALttP\Location;
use ALttP\Item;
use ALttP\World;
use Illuminate\Support\Arr;

/**
 * Collection of Locations to place Items
 */
class LocationCollection extends Collection
{
    private $checks_for_world = 0;

    /**
     * Create a new collection.
     *
     * @param mixed $items
     *
     * @return void
     */
    public function __construct($items = [])
    {
        parent::__construct($items);

        $this->items = [];

        foreach ($this->getArrayableItems($items) as $item) {
            $this->addItem($item);
        }
    }

    public function setChecksForWorld(int $world_id)
    {
        $this->checks_for_world = $world_id;
    }

    /**
     * Add a Location to this Collection
     *
     * @param Location $item
     *
     * @return $this
     */
    public function addItem(Location $item)
    {
        $this->offsetSet($item->getName(), $item);
        return $this;
    }

    /**
     * Remove an item from the collection.
     *
     * @return $this
     */
    public function removeItem($key)
    {
        $this->offsetUnset("$key:$this->checks_for_world");

        return $this;
    }

    /**
     * Get a Collection of Locations that do not have Items assigned
     *
     * @return static
     */
    public function getEmptyLocations()
    {
        return $this->filter(function ($location) {
            return !$location->hasItem();
        });
    }

    /**
     * Get a Collection of Locations that do have Items assigned
     *
     * @return static
     */
    public function getNonEmptyLocations()
    {
        return $this->filter(function ($location) {
            return $location->hasItem();
        });
    }

    /**
     * get the hint string for this location collection.
     */
    public function getHint()
    {
        $prime_location = $this->locationsWithItem()->first();

        $items = $this->getItems()->map(function ($item) use ($prime_location) {
            if ($prime_location->getRegion()->getWorld()->config('rom.genericKeys', false) && $item instanceof Item\Key) {
                $item = Item::get('KeyGK', $prime_location->getRegion()->getWorld());
            }

            $item_name = __('hint.item.' . $item->getTarget()->getName());

            return (is_array($item_name)) ? Arr::first(fy_shuffle($item_name)) : $item_name;
        });

        switch (count($items)) {
            case 1:
                return $prime_location->getHint();
            case 0:
                return null;
        }


        $location_name = __('hint.location.' . $prime_location->getName());

        if (is_array($location_name)) {
            $location_name = Arr::first($location_name); // on multi-locations we want the first one
        }

        $last_item = array_pop($items);

        return implode(', ', $items) . ' and ' . $last_item . ' ' . $location_name;
    }

    /**
     * Deterime if the Locations given has at least a particular amount of a particular Item
     *
     * @param Item $item Item to search for
     * @param LocationCollection $locations locations to search against
     * @param int $count the required minimum number of Items
     *
     * @return bool
     */
    public function itemInLocations(Item $item, $locations, $count = 1)
    {
        foreach ($locations as $location) {
            if ($this->items[$location . ':' . $this->checks_for_world]->hasItem($item)) {
                $count--;
            }
        }
        return $count < 1;
    }

    /**
     * Get all the Items assigned in this
     *
     * @todo see about actual world comparison, not ID comparison later (this was required for shadow world).
     *
     * @param World $world allow a world context to be passed in for item collection being returned
     *
     * @return ItemCollection
     */
    public function getItems(World $world = null)
    {
        $items = [];

        foreach ($this->items as $location) {
            $item = $location->getItem();
            if ($item !== null && ($world === null || $item->getWorld()->id === $world->id)) {
                $items[] = $item;
            }
        }

        return new ItemCollection($items);
    }

    /**
     * Get all the Regions that this Collection is part of
     *
     * @return array
     */
    public function getRegions()
    {
        $regions = [];
        foreach ($this->items as $location) {
            if (!in_array($location->getRegion(), $regions)) {
                array_push($regions, $location->getRegion());
            }
        }
        return $regions;
    }

    /**
     * Get a new Collection of Locations that have (a particlar) Item assigned
     *
     * @param Item|null $item Item to search for
     *
     * @return static
     */
    public function locationsWithItem(Item $item = null)
    {
        return $this->filter(function ($location) use ($item) {
            return $location->hasItem($item);
        });
    }

    /**
     * Get a new Collection of Locations that the items have access to.
     *
     * @param ItemCollection $items Items available
     *
     * @return static
     */
    public function canAccess(ItemCollection $items)
    {
        return $this->filter(function ($location) use ($items) {
            return $location->canAccess($items);
        });
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
        $random_collection = parent::randomCollection($number);
        $random_collection->checks_for_world = $this->checks_for_world;

        return $random_collection;
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
            $filtered = new static(array_filter($this->items, $callback));
        } else {
            $filtered = new static(array_filter($this->items));
        }

        $filtered->checks_for_world = $this->checks_for_world;

        return $filtered;
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
        $merged = parent::merge($items);
        $merged->checks_for_world = $this->checks_for_world;

        return $merged;
    }

    /**
     * Get a fresh copy of this object, the underlying items will still be the same
     *
     * @return static
     */
    public function copy()
    {
        $copy = parent::copy();
        $copy->checks_for_world = $this->checks_for_world;

        return $copy;
    }

    /**
     * Get an item at a given offset.
     *
     * @param string $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        $offset = str_replace(":$this->checks_for_world", '', $offset);
        return $this->items["$offset:$this->checks_for_world"];
    }
}
