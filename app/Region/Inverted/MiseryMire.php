<?php

namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Misery Mire Region and it's Locations contained within
 */
class MiseryMire extends Region\Standard\MiseryMire
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
							|| $items->hasSword(2)
						) 
						&& $items->hasHealth(12) 
						&& (
							$items->hasBottle(2) 
							|| $items->hasArmor()
					)	)
				) && (		
					(
						$locations["Misery Mire Medallion"]->hasItem(Item::get('Bombos', $this->world)) 
						&& $items->has('Bombos')
					) || (
						$locations["Misery Mire Medallion"]->hasItem(Item::get('Ether', $this->world)) 
						&& $items->has('Ether')
					) || (
						$locations["Misery Mire Medallion"]->hasItem(Item::get('Quake', $this->world)) 
						&& $items->has('Quake')
					)
				) && (
						$this->world->config('mode.weapons') == 'swordless' 
						|| $items->hasSword()
				) && (
					$items->has('PegasusBoots') 
					|| $items->has('Hookshot')
				) 
				&& $items->canKillMostThings(8)
                && $this->world->getRegion('Mire')->canEnter($locations, $items);
        };

        return $this;
    }
}
