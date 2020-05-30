<?php

namespace ALttP;

use Illuminate\Support\Arr;

/**
 * A Location is any place an Item can be found in game
 */
class Location
{
    protected $name;
    protected $address;
    protected $bytes;
    /** @var \ALttP\Region */
    protected $region;
    protected $requirement_callback;
    protected $fill_callback;
    protected $always_callback;
    protected $item = null;

    /**
     * Create a new Location
     *
     * @param string $name Unique name of location
     * @param array $address Addresses in ROM to write to
     * @param array|null $bytes data to write back to Item addresses if set
     * @param \ALttP\Region $region Region that this Location belongs to
     * @param callable|null $requirement_callback callback function when determining if Location is accessable
     *
     * @return void
     */
    public function __construct($name, array $address, $bytes, Region $region, callable $requirement_callback = null)
    {
        $this->name = $name;
        $this->address = $address;
        $this->bytes = (array) $bytes;
        $this->region = $region;
        $this->requirement_callback = $requirement_callback;
    }

    /**
     * Try to place the given Item in this Location.
     *
     * @param Item $item Item we are trying to place
     * @param \ALttP\Support\ItemCollection $items Items that can be collected
     *
     * @return bool
     */
    public function fill(Item $item, $items)
    {
        $old_item = $this->item;
        $this->setItem($item);
        if ($this->canFill($item, $items)) {
            return true;
        }

        $this->setItem($old_item);

        return false;
    }

    /**
     * Test if given Item can be placed in this location without soft locks.
     *
     * @param Item $item Item we are testing for placement
     * @param \ALttP\Support\ItemCollection $items Items that can be collected
     * @param bool $check_access also test access
     *
     * @return bool
     */
    public function canFill(Item $item, $items, $check_access = true)
    {
        $items->setChecksForWorld($this->region->getWorld()->id);
        $old_item = $this->item;
        $this->setItem($item);
        $fillable = ($this->always_callback && call_user_func($this->always_callback, $item, $items))
            || ($this->region->canFill($item)
                && (!$this->fill_callback
                    || call_user_func($this->fill_callback, $item, $this->region->getWorld()->getLocations(), $items))
                && (!$check_access || $this->canAccess($items)));
        $this->setItem($old_item);

        return $fillable;
    }

    /**
     * Determine if Link can access this location given his Items collected. Starts by checking if access to the Region
     * is granted, then checks the spcific location.
     *
     * @param \ALttP\Support\ItemCollection     $items     Items Link can collect
     * @param \ALttP\Support\LocationCollection $locations locations
     *
     * @return bool
     */
    public function canAccess($items, $locations = null)
    {
        $locations = $locations ?? $this->region->getWorld()->getLocations();
        $items->setChecksForWorld($this->region->getWorld()->id);

        // @TODO: optimize this call, perhaps cache?
        if (!$this->region->canEnter($locations, $items)) {
            return false;
        }

        if (!$this->requirement_callback || call_user_func($this->requirement_callback, $locations, $items)) {
            return true;
        }

        return false;
    }

    /**
     * Set the requirements callback for this Lcation, closure should take 2 arguments, $locations and $items and
     * return boolean.
     *
     * @param callable $callback function to be called when checking if Location can have Item
     *
     * @return $this
     */
    public function setRequirements(callable $callback)
    {
        $this->requirement_callback = $callback;

        return $this;
    }

    /**
     * Set the rules for filling this location
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function setFillRules(callable $callback)
    {
        $this->fill_callback = $callback;

        return $this;
    }

    /**
     * Set the rules for freely allowing items at this location
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function setAlwaysAllow(callable $callback)
    {
        $this->always_callback = $callback;

        return $this;
    }

    /**
     * Sets the item for this location.
     *
     * @param Item|null $item Item to be placed at this Location
     *
     * @return $this
     */
    public function setItem(Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Does this Location have (a particular) Item assigned
     *
     * @param Item|null $item item to search locations for
     *
     * @return bool
     */
    public function hasItem(Item $item = null)
    {
        return $item ? $this->item == $item : $this->item !== null;
    }

    /**
     * Get the Item assigned to this Location, null is nothing is assigned
     *
     * @return Item|null
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * get the hint string for this location.
     */
    public function getHint()
    {
        if (!$this->item) {
            return null;
        }

        $item = ($this->region->getWorld()->config('rom.genericKeys', false) && $this->item instanceof Item\Key)
            ? Item::get('KeyGK', $this->region->getWorld())
            : $this->item;

        $item_name = __('hint.item.' . $item->getTarget()->getRawName());

        if (is_array($item_name)) {
            $item_name = Arr::first(fy_shuffle($item_name));
        }

        $location_name = __('hint.location.' . $this->name);

        if (is_array($location_name)) {
            $location_name = Arr::first(fy_shuffle($location_name));
        }

        return "$item_name $location_name";
    }

    /**
     * Write the Item to this Location in ROM. Will set Item if passed in, and only write if there is an Item set.
     * @TODO: this is side-affecty
     *
     * @param Rom $rom ROM we are writing to
     * @param Item|null $item item we are going to write
     *
     * @throws \Exception if no item is set for location
     *
     * @return $this
     */
    public function writeItem(Rom $rom, Item $item = null)
    {
        if ($item) {
            $this->setItem($item);
        }

        if (!$this->item) {
            throw new \Exception('No Item set to be written');
        }

        $item = $this->item;

        if (
            $item instanceof Item\Key && $this->region->isRegionItem($item)
            && (!in_array($this->name, ["Secret Passage", "Link's Uncle"]) || $item != Item::get('KeyH2', $this->region->getWorld()))
        ) { // special key-sanity case
            $item = Item::get('Key', $this->region->getWorld());
        }

        if ($item instanceof Item\BigKey && $this->region->isRegionItem($item)) {
            $item = Item::get('BigKey', $this->region->getWorld());
        }

        if ($this->region->getWorld()->config('rom.genericKeys', false) && $item instanceof Item\Key) {
            $item = Item::get('KeyGK', $this->region->getWorld());
        }

        $item_bytes = $item->getBytes();

        foreach ($this->address as $key => $address) {
            if (!isset($item_bytes[$key]) || !isset($address)) {
                continue;
            }
            $rom->write($address, pack('C', $item_bytes[$key]));
        }

        return $this;
    }

    /**
     * Get the name of this Location.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name . ':' . $this->region->getWorld()->id;
    }

    /**
     * Get the ROM addres of this Location.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the Region of this Location.
     * @TODO: determine if this has side affects that are extremely negitive.
     *
     * @param Region $region new region to assign location to.
     *
     * @return $this
     */
    public function setRegion(Region $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get the Region of this Location.
     *
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Convert this to string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
