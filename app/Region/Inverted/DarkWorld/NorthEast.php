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
 * North East Dark World Region and it's Locations contained within
 */
class NorthEast extends Region\Standard\DarkWorld\NorthEast
{
    /**
     * Create a new North East Dark World Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations->removeItem("Ganon");
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->shops["Dark World Potion Shop"]->setRequirements(function ($locations, $items) {
            return 
				$items->canFly($this->world)
				|| $items->has('Hammer')
                || $items->has('Flippers')
                || (
					$items->has('MagicMirror') 
					&& $this->world->getRegion('North East Light World')->canEnter($locations, $items) 
					&& $items->has('MoonPearl')
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBootsClip', false) 
					&& $items->has('PegasusBoots')
				) || (
					$this->world->config('canSuperSpeed', false) 
					&& $items->canSpinSpeed()
				) || (
					$this->world->config('canOneFrameClipOW', false)
					|| ( //Quirn-Jump
						!$this->world->config('region.cantTakeDamage', false) 
						&& $this->world->config('canFakeFlipper', false)
					) || (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					)
				) || (
					$this->world->config('canWaterWalk', false) 
					&& $items->has('PegasusBoots')
				);
        });

        $this->locations["Catfish"]->setRequirements(function ($locations, $items) {
            return 
				$items->canLiftRocks()
				|| (
					$this->world->config('canBootsClip', false) 
					&& $items->has('PegasusBoots')
				) || 
					$this->world->config('canOneFrameClipOW', false);
        });

        $this->locations["Pyramid Fairy - Sword"]->setRequirements(function ($locations, $items) {
            return 
				$items->hasSword() 
				&& $items->has('BigRedBomb') 
				&& $items->has('MagicMirror');
        });

        $this->locations["Pyramid Fairy - Bow"]->setRequirements(function ($locations, $items) {
            return 
				$items->canShootArrows() 
				&& $items->has('BigRedBomb') 
				&& $items->has('MagicMirror');
        });


        if ($this->world->config('region.swordsInPool', true)) {
            $this->locations["Pyramid Fairy - Left"]->setRequirements(function ($locations, $items) {
                return 
					$items->has('BigRedBomb') 
					&& $items->has('MagicMirror');
            });

            $this->locations["Pyramid Fairy - Right"]->setRequirements(function ($locations, $items) {
                return 
					$items->has('BigRedBomb') 
					&& $items->has('MagicMirror');
            });
        }

        $this->can_enter = function ($locations, $items) {
            return 
				$items->canFly($this->world)
				|| $items->has('Hammer')
                || $items->has('Flippers')
                || (
					$items->has('MagicMirror') 
					&& $this->world->getRegion('North East Light World')->canEnter($locations, $items)
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || (
					$this->world->config('canBootsClip', false) 
					&& $items->has('PegasusBoots')
				) || (
					$this->world->config('canWaterWalk', false) 
					&& $items->has('PegasusBoots')
				) || (
					$this->world->config('canSuperSpeed', false) 
					&& $items->canSpinSpeed()
				) || (
					!$this->world->config('region.cantTakeDamage', false) 
					&& $this->world->config('canFakeFlipper', false)
				) || (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				) || 
					$this->world->config('canOneFrameClipOW', false);
        };

        return $this;
    }
}
