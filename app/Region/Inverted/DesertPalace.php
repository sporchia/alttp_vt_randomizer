<?php

namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Desert Palace Region and it's Locations contained within
 */
class DesertPalace extends Region\Standard\DesertPalace
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

		$main = function ($locations, $items) {
			return
				$items->has('BookOfMudora')
				&& $this->world->getRegion('South Light World')->canEnter($locations, $items);
		};

		$side = function ($locations, $items) {
			return
				$this->world->config('canOneFrameClipOW', false)
				|| (
					(
						$items->has('MoonPearl')
						|| (
							$this->world->config('canOWYBA', false) 
							&& $items->hasABottle()
						) || (
							$this->world->config('canBunnyRevive', false) 
							&& $items->canBunnyRevive()
						)
					) && (
						(	
							$this->world->config('canBootsClip', false) 
							&& $items->has('PegasusBoots')
					)	)
				) &&
					$this->world->getRegion('South Light World')->canEnter($locations, $items);
		};

		$thieves = function ($locations, $items) {
			return 
				$this->world->getRegion('Thieves Town')->canEnter($locations, $items)
				&& $items->has('KeyD4') 
				&& $items->has('BigKeyD4')
				&& $this->world->config('canOneFrameClipUW', false);
		};



		$this->locations["Desert Palace - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return 
				$items->has('KeyP2')
				&& (
					$items->has('MoonPearl')
					|| $this->world->config('canDungeonRevive')
					|| (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					) || (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
				)	);
        });


		$this->locations["Desert Palace - Boss"]->setRequirements(function ($locations, $items) {
            return 
				$this->canEnter($locations, $items)
				&& (
					(
						$items->has('MoonPearl')
						|| (
							$this->world->config('canBunnyRevive', false) 
							&& $items->canBunnyRevive()
						) || (
							$this->world->config('canOWYBA', false) 
							&& $items->hasABottle()
						)
					) || (
						$this->world->config('canOneFrameClipOW', false) 
						&& $this->world->config('canDungeonRevive', false)
					)
				) 
				&& $items->canLightTorches() 
				&& $items->has('BigKeyP2') 
				&& $items->has('KeyP2')
				&& $this->boss->canBeat($items, $locations)
				&& (
					!$this->world->config('region.wildCompasses', false) 
					|| $items->has('CompassP2') 
					|| $this->locations["Desert Palace - Boss"]->hasItem(Item::get('CompassP2', $this->world))
				) && (
					!$this->world->config('region.wildMaps', false) 
					|| $items->has('MapP2') 
					|| $this->locations["Desert Palace - Boss"]->hasItem(Item::get('MapP2', $this->world))
				);
        });

        // Bunny can use Book!
        $this->can_enter = function ($locations, $items) use ($main, $side, $thieves) {
            return 
				(			// Do Stuff in Front
					$this->world->config('canDungeonRevive', false) 
					|| (
						$this->world->config('canSuperBunny', false) 
						&& (
							$items->has('MagicMirror')
							&& $items->has('BookOfMudora')
						)
					) || (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					) || (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) || 
						$items->has('MoonPearl')
				) && (
					$main($locations, $items) 
					|| $side($locations, $items) 
					|| $thieves($locations, $items) 
				);
        };

        return $this;
    }
}