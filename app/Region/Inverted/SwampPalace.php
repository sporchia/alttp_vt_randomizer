<?php

namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Swamp Palace Region and it's Locations contained within
 */
class SwampPalace extends Region\Standard\SwampPalace
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


        $mire = function ($locations, $items) {
            return $this->world->config('canOneFrameClipUW', false)
                && $items->has('KeyD6', 3)
                && $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
        };

        $main = function ($locations, $items) {
			return	 
				(
					$items->has('MoonPearl') 
					|| $this->world->config('canSuperBunny', false)
				) 
				&& $items->has('MagicMirror') 
				&& $items->has('Flippers')
                && $this->world->getRegion('South Light World')->canEnter($locations, $items);
        };
		
		$this->locations["Swamp Palace - Boss"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return 
				$items->has('KeyD2')
                && $items->has('Flippers')
                && (
					$main($locations, $items) 
					&& (
						$items->has('Hammer') 
						|| $mire($locations, $items)
					)	
				) 
				&& $items->has('Hookshot')
				&& $this->boss->canBeat($items, $locations)
				&& (
					!$this->world->config('region.wildCompasses', false) 
					|| $items->has('CompassD2') 
					|| $this->locations["Swamp Palace - Boss"]->hasItem(Item::get('CompassD2', $this->world))
				) && (
					!$this->world->config('region.wildMaps', false) 
					|| $items->has('MapD2') 
					|| $this->locations["Swamp Palace - Boss"]->hasItem(Item::get('MapD2', $this->world))
				);
        })->setFillRules(function ($item, $locations, $items) {
            if (
                !$this->world->config('region.bossNormalLocation', true)
                && ($item instanceof Item\Key || $item instanceof Item\BigKey
                    || $item instanceof Item\Map || $item instanceof Item\Compass)
            ) {
                return false;
            }

            return true;
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('region.bossNormalLocation', true)
                && ($item == Item::get('CompassD2', $this->world) || $item == Item::get('MapD2', $this->world));
        });

        $this->can_enter = function ($locations, $items) use ($main, $mire) {
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
					)
				) && (
					$main($locations, $items)
					|| $mire($locations, $items)
				);
        };

        return $this;
    }
}
