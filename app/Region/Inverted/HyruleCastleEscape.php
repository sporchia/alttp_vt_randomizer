<?php

namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Hyrule Castle Escape Region and it's Locations contained within
 */
class HyruleCastleEscape extends Region\Open\HyruleCastleEscape
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

        $this->can_enter = function ($locations, $items) {
            return ($this->world->config('canDungeonRevive', false) || $items->has('MoonPearl'))
                && $this->world->getRegion('North East Light World')->canEnter($locations, $items);
        };

        return $this;
    }
}
