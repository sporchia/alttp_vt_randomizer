<?php

namespace ALttP;

use ALttP\Support\ShopCollection;
use ALttP\Support\LocationCollection;

/**
 * Shop related features.
 * this is very much a work in progress
 */
class Shop
{
    protected $name;
    protected $config;
    protected $shopkeeper;
    protected $room_id;
    protected $door_id;
    protected $region;
    protected $requirement_callback;
    protected $writes = [];
    protected $active = false;
    protected $inventory = [];

    /**
     * Create a new Shop
     *
     * @param string $name Unique name of Shop
     * @param int $config td----qq t: take-any,  d: check door, q: number of items for sale
     * @param int $shopkeeper ppp---ss p: palette s: sprite
     * @param int $room_id Id for the room to use
     * @param int $door_id Id of door to use
     * @param \ALttP\Region $region Region where the shop is found
     * @param array $writes extra data that needs to be written to entrance table to make sure it works correctly
     *
     * @return void
     */
    public function __construct(string $name, int $config, int $shopkeeper, int $room_id, int $door_id, Region $region, array $writes = [])
    {
        $this->name = $name;
        $this->config = $config;
        $this->shopkeeper = $shopkeeper;
        $this->room_id = $room_id;
        $this->door_id = $door_id;
        $this->region = $region;
        $this->writes = $writes;
    }

    /**
     * Get the name of this Shop
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getBytes(int $sram_offset = 0x00): array
    {
        return array_merge(
            array_values(unpack('C*', pack('S', $this->room_id ?? 0))),
            [$this->door_id, 0x00, ($this->config & 0xFC) + count($this->inventory), $this->shopkeeper, $sram_offset]
        );
    }

    /**
     * Write extra data into the rom for this location. Generally, this is used for take-anys that will essentually
     * hijack another cave/house and place themselves in there. Usually it's done by wiriting the type ID into
     * the table starting at 0xDBB73 offset by the entrance ID.
     *
     * @param \ALttP\Rom $rom Rom to write data to
     *
     * @return $this
     */
    public function writeExtraData(Rom $rom): self
    {
        foreach ($this->writes as $address => $bytes) {
            $rom->write($address, pack('C*', ...$bytes));
        }

        return $this;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setShopkeeper(string $shopkeeper): self
    {
        switch ($shopkeeper) {
            case 'old_man':
                $this->shopkeeper = 0xE2;
                break;
            case 'old_woman':
                $this->shopkeeper = 0xE3;
                break;
            case 'dark_shopkepper':
                $this->shopkeeper = 0xC1;
                break;
            case 'shopkeeper':
            default:
                $this->shopkeeper = 0xA0;
        }

        return $this;
    }

    public function clearInventory(): self
    {
        $this->inventory = [];

        return $this;
    }

    public function addInventory(int $slot, Item $item, int $price, int $max = 0, Item $replacement = null, int $replacement_price = 0): self
    {
        $this->inventory[$slot] = [
            'id' => head($item->getBytes()),
            'item' => $item,
            'price' => $price,
            'max' => $max,
            'replace_id' => $replacement === null ? 0xFF : head($replacement->getBytes()),
            'replacement_item' => $replacement,
            'replace_price' => $replacement_price,
        ];

        return $this;
    }

    public function getInventory(): array
    {
        return $this->inventory;
    }

    public function getLocations(): LocationCollection
    {
        $locations = [];
        foreach ($this->inventory as $slot => $record) {
            $location = (new Location("$this->name - $slot", [], null, $this->region))->setItem($record['item']);
            if ($this->requirement_callback) {
                $location->setRequirements($this->requirement_callback);
            }
            $locations[] = $location;

            if ($record['replacement_item']) {
                $location = (new Location("$this->name - $slot.2", [], null, $this->region))->setItem($record['replacement_item']);
                if ($this->requirement_callback) {
                    $location->setRequirements($this->requirement_callback);
                }
                $locations[] = $location;
            }
        }
        return new LocationCollection($locations);
    }

    /**
     * Determine if Link can access this location given his Items collected. Starts by checking if access to the Region
     * is granted, then checks the spcific location.
     *
     * @param \ALttP\Support\ItemCollection          $items     Items Link can collect
     * @param \ALttP\Support\LocationCollection|null $locations current locations
     *
     * @return bool
     */
    public function canAccess($items, $locations = null)
    {
        if (!$this->region->canEnter($locations ?? $this->region->getWorld()->getLocations(), $items)) {
            return false;
        }

        if (!$this->requirement_callback || call_user_func($this->requirement_callback, $locations ?? $this->region->getWorld()->getLocations(), $items)) {
            return true;
        }

        return false;
    }

    /**
     * Set the requirements callback for this Lcation, closure should take 2 arguments, $locations and $items and
     * return boolean.
     *
     * @param Callable $callback function to be called when checking if Location can have Item
     *
     * @return $this
     */
    public function setRequirements(callable $callback)
    {
        $this->requirement_callback = $callback;

        return $this;
    }

    /**
     * Get the Region of this Location.
     *
     * @return \ALttP\Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    public function copy()
    {
        $copy = new static($this->name, $this->config, $this->shopkeeper, $this->room_id, $this->door_id, $this->region, $this->writes);
        $copy->inventory = $this->inventory;
        $copy->requirement_callback = $this->requirement_callback;

        return $copy;
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
