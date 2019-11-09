<?php

namespace ALttP\Region\Inverted\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * Mire Dark World Region and it's Locations contained within
 */
class Mire extends Region\Standard\DarkWorld\Mire
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->can_enter = function ($locations, $items) {
            return 
				$items->canFly($this->world)
                || (
					$items->has('MagicMirror') 
					&& $this->world->getRegion('South Light World')->canEnter($locations, $items)
				) || (
					$this->world->config('canBootsClip', false) 
					&& $items->has('PegasusBoots')
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || 
					$this->world->config('canOneFrameClipOW', false);
        };

        return $this;
    }
}
