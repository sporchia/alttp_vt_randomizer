<?php

namespace ALttP\Region\Inverted\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * Dark World Region and it's Locations contained within
 */
class West extends Region\Standard\DarkWorld\DeathMountain\West
{
    /**
     * Create a new Dark World Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->shops->removeItem("Dark Death Mountain Fairy");
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Spike Cave"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('Hammer') 
				&& $items->canLiftRocks()
                && (
					(
						$items->canExtendMagic() 
						&& $items->has('Cape')
					) || (
						(
							!$this->world->config('region.cantTakeDamage', false) 
							|| $items->canExtendMagic()
						) && 
							$items->has('CaneOfByrna')
					)
				);
        });

        $this->can_enter = function ($locations, $items) {
            return 
				$items->canFly($this->world)
                || (
					$items->canLiftRocks() 
					&& $items->has('Lamp', $this->world->config('item.require.Lamp', 1))
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
