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
 * North West Dark World Region and it's Locations contained within
 */
class NorthWest extends Region\Standard\DarkWorld\NorthWest
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->shops["Dark World Outcasts Shop"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('Hammer');
        });

        $this->locations["Brewery"]->setRequirements(function ($locations, $items) {
            return 
				$items->canBombThings();
        });

        $this->locations["Hammer Pegs"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('Hammer')
                && (
					$items->canLiftDarkRocks()
                    || (
						$items->has('MagicMirror') 
						&& $this->world->getRegion('North West Light World')->canEnter($locations, $items)
					) || (
						$this->world->config('canBootsClip', false) 
						&& $items->has('PegasusBoots')
					) || (
						(
							$this->world->config('canFakeFlipper', false) 
							|| $items->has('Flippers')
							&& (
								(
									$this->world->config('canSuperSpeed', false) 
									&& $items->canSpinSpeed()
								) ||
									$this->world->config('canOneFrameClipOW', false)
				)	)	)	);
        });

        $this->locations["Bumper Cave"]->setRequirements(function ($locations, $items) {
            return 
				(
					$items->canLiftRocks() 
					&& $items->has('Cape')
		            && $items->has('MoonPearl') 
					&& $items->has('MagicMirror')
					&& $this->world->getRegion('North West Light World')->canEnter($locations, $items)
				) || (
					$this->world->config('canBootsClip', false) 
					&& $items->has('PegasusBoots')
				) || 
					$this->world->config('canOneFrameClipOW', false);
        });

        $this->locations["Blacksmith"]->setRequirements(function ($locations, $items) {
            return 
				$items->canLiftDarkRocks() 
				|| 
					$items->has('MagicMirror')
				|| (
					(
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) && (
						$this->world->config('canOneFrameClipOW', false)
						|| (
							$this->world->config('canBootsClip', false) 
							&& $items->has('PegasusBoots')
				)	)	)
				&& $this->world->getRegion('North West Light World')->canEnter($locations, $items);
        });

        $this->locations["Purple Chest"]->setRequirements(function ($locations, $items) {
            return 
				$items->canLiftDarkRocks() 
				|| $items->has('MagicMirror')
				|| (
					(
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) && (
						(
							$this->world->config('canFakeFlipper', false) 
							|| $items->has('Flippers')
						) && (
							(
								$this->world->config('canBootsClip', false) 
								&& $items->has('PegasusBoots')
							) ||
								$this->world->config('canOneFrameClipOW', false)
				)	)	)
				&& $this->world->getRegion('North West Light World')->canEnter($locations, $items)
				&& $this->world->getRegion('South Light World')->canEnter($locations, $items);
        });

        return $this;
    }
}
