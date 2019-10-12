<?php

namespace ALttP\Region\Inverted\LightWorld\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Death Mountain Region and it's Locations contained within
 */
class West extends Region\Standard\LightWorld\DeathMountain\West
{
    /**
     * Create a new Death Mountain Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations->removeItem("Ether Tablet");
        $this->locations->removeItem("Spectacle Rock");
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Old Man"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('Lamp', $this->world->config('item.require.Lamp', 1));
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
				) || 
					$this->world->config('canOneFrameClipOW', false)
				|| (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				);
        };

        return $this;
    }
}
