<?php

namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Thieves Town Region and it's Locations contained within
 */
class ThievesTown extends Region\Standard\ThievesTown
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
            return 
				(
					$this->world->config('itemPlacement') !== 'basic'
                    || (
						(
							$this->world->config('mode.weapons') === 'swordless' 
							|| $items->hasSword()
						) 
						&& $items->hasHealth(7) 
						&& $items->hasBottle()
				)	)
				&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
        };

        return $this;
    }
}
