<?php

namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Eastern Palace Region and it's Locations contained within
 */
class EasternPalace extends Region\Standard\EasternPalace
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


		$this->locations["Eastern Palace - Compass Chest"]->setRequirements(function ($locations, $items) {
            return 
				$items->hasSword()
				|| $this->world->config('canDungeonRevive', false) 
				|| (
					$this->world->config('canBunnyRevive', false) 
					&& $items->canBunnyRevive()
				) || (
					$this->world->config('canOWYBA', false) 
					&& $items->hasABottle()
				) || 
					$items->has('MoonPearl');
        });

		$this->locations["Eastern Palace - Big Chest"]->setRequirements(function ($locations, $items) {
            return 
				(
					$items->hasSword()
					|| $this->world->config('canDungeonRevive', false) 
					|| (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					) || (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) || 
						$items->has('MoonPearl')
				) && 
					$items->has('BigKeyP1');
        });

		$this->locations["Eastern Palace - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return 
				(
					$items->hasSword()
					||
					$this->world->config('canDungeonRevive', false) 
					|| (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					) || (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) ||
						$items->has('MoonPearl')
				) && $items->has('Lamp');
        });

		$this->locations["Eastern Palace - Boss"]->setRequirements(function ($locations, $items) {
            return 
				$items->canShootArrows() 
				&& (
					$this->world->config('canDungeonRevive', false) 
					|| (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					) || (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) || 
						$items->has('MoonPearl')
				) && (
					$items->has('Lamp', $this->world->config('item.require.Lamp', 1))
					|| (
						$this->world->config('itemPlacement') === 'advanced' 
						&& $items->has('FireRod')
					)
				) && $items->has('BigKeyP1')
				&& $this->boss->canBeat($items, $locations)
				&& (
					!$this->world->config('region.wildCompasses', false) 
					|| $items->has('CompassP1') 
					|| $this->locations["Eastern Palace - Boss"]->hasItem(Item::get('CompassP1', $this->world))
				) && (
					!$this->world->config('region.wildMaps', false) 
					|| $items->has('MapP1') 
					|| $this->locations["Eastern Palace - Boss"]->hasItem(Item::get('MapP1', $this->world))
				);
        });

        $this->can_enter = function ($locations, $items) {
            return 
				(
					$this->world->config('canDungeonRevive', false) 
					|| (
						$this->world->config('canSuperBunny', false) 
						&& $items->has('MagicMirror')
					) || (
						$this->world->config('canBunnyRevive', false) 
						&& $items->canBunnyRevive()
					) || (
						$this->world->config('canOWYBA', false) 
						&& $items->hasABottle()
					) || 
						$items->has('MoonPearl')
				) && 
					$this->world->getRegion('North East Light World')->canEnter($locations, $items);
        };

        return $this;
    }
}
