<?php

namespace ALttP\Location;

use ALttP\Item;
use ALttP\Item\Crystal;
use ALttP\Item\Pendant;
use ALttP\Location;
use ALttP\Rom;
use Illuminate\Support\Arr;

/**
 * Prize for completing a dungeon. These have the added benefit of being placed on the map.
 */
class Prize extends Location
{
    /**
     * sets the item for this location.
     *
     * @param Item|null $item can only be items [Pendant|Crystal] that "complete" a dungeon.
     *
     * @return $this
     */
    public function setItem(Item $item = null)
    {
        if (!$item instanceof Pendant && !$item instanceof Crystal && $item !== null) {
            throw new \Exception('Trying to set non-Pendant/Crystal in a Prize Location: ' . $this->getName() . ' item ' . $item->getName());
        }

        $this->item = $item;
        return $this;
    }

    /**
     * When writing a prize we also change the music for the region
     *
     * @param Rom $rom ROM we are writing to
     * @param Item $item item we are placing at this location
     *
     * @return $this
     */
    public function writeItem(Rom $rom, Item $item = null)
    {
        parent::writeItem($rom, $item);

        if (isset($this->region->music_addresses) && is_array($this->region->music_addresses)) {
            if ($this->region->getWorld()->config('rom.mapOnPickup', false)) {
                $music = Arr::first(fy_shuffle([0x11, 0x16]));
            } else {
                $item = $this->getItem();
                $music = $item instanceof Pendant ? 0x11 : 0x16;
            }

            foreach ($this->region->music_addresses as $address) {
                $rom->write($address, pack('C*', $music));
            }
        }

        return $this;
    }
}
