<?php

namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\Item;
use ALttP\World;

/**
 * Palace of Darkness Region and it's Locations contained within
 */
class PalaceOfDarkness extends Region\Standard\PalaceOfDarkness
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
				&& (
					$this->world->getRegion('North East Dark World')->canEnter($locations, $items)
					|| (
						$this->world->config('canOneFrameClipOW')
						&& $this->world->getRegion('West Death Mountain')
					)
				);
        };

        return $this;
    }
}
