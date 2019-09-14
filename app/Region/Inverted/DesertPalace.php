<?php

namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Desert Palace Region and it's Locations contained within
 */
class DesertPalace extends Region\Standard\DesertPalace
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        parent::initalize();

        // Bunny can use Book!
        $this->can_enter = function ($locations, $items) {
            return ($this->world->config('canDungeonRevive', false) || $items->has('MoonPearl'))
                && ($items->has('BookOfMudora')
                    && $this->world->getRegion('South Light World')->canEnter($locations, $items));
        };

        return $this;
    }
}
