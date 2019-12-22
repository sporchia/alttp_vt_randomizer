<?php

namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Region;

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
                && (($locations->itemInLocations(Item::get('BigKeyD6', $this->world), [
                        "Misery Mire - Compass Chest",
                        "Misery Mire - Big Key Chest",
                    ]) &&
                        $items->has('KeyD6', 2)) || $items->has('KeyD6', 3))
                && $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
        };
        
        $hera = function ($locations, $items) use ($mire) {
            return $this->world->config('canOneFrameClipUW', false)
                && $this->world->getRegion('Tower of Hera')->canEnter($locations, $items)
                && ($items->has('BigKeyP3')
                    || ($mire($locations, $items) && $items->has('BigKeyD6')));
        };
        
        $this->locations["Swamp Palace - Entrance"]->setFillRules(function ($item, $locations, $items) use ($mire) {
            return $this->world->config('region.wildKeys', false) || $item == Item::get('KeyD2', $this->world) 
                || $mire($locations, $items);
        });

        $this->locations["Swamp Palace - Big Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer') 
                    || $mire($locations, $items) || $hera($locations, $items))
                && ($items->has('BigKeyD2')
                    || ($mire($locations, $items) && $items->has('BigKeyD6'))
                    || ($hera($locations, $items) && $items->has('BigKeyP3')));
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('BigKeyD2', $this->world);
        });

        $this->locations["Swamp Palace - Big Key Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer') 
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Map Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->canBombThings()
                && ($items->has('KeyD2') || $mire($locations, $items));
        });

        $this->locations["Swamp Palace - West Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return ($items->has('KeyD2')|| $mire($locations, $items))
                && ($items->has('Hammer') 
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Compass Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer') 
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Flooded Room - Left"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->has('Hookshot')
                && ($items->has('KeyD2')|| $mire($locations, $items))
                && ($items->has('Hammer') 
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Flooded Room - Right"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->has('Hookshot')
                && ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer') 
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Waterfall Room"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->has('Hookshot')
                && ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer') 
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Boss"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->has('Hookshot')
                && ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer') 
                    || $mire($locations, $items) || $hera($locations, $items))
                && $this->boss->canBeat($items, $locations)
                && (!$this->world->config('region.wildCompasses', false)
                    || $items->has('CompassD2')
                    || $this->locations["Swamp Palace - Boss"]->hasItem(Item::get('CompassD2', $this->world))) && (!$this->world->config('region.wildMaps', false)
                    || $items->has('MapD2')
                    || $this->locations["Swamp Palace - Boss"]->hasItem(Item::get('MapD2', $this->world)));
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

        $this->can_enter = function ($locations, $items) use ($mire) {
            return $items->has('Flippers')
                && ($this->world->config('itemPlacement') !== 'basic'
                    || (($this->world->config('mode.weapons') === 'swordless'
                        || $items->hasSword())
                    && $items->hasHealth(7)
                    && $items->hasBottle())) 
                && (($items->has('MoonPearl') 
                    || ($this->world->config('canOWYBA', false)
                        && $items->hasABottle())
                    || ($this->world->config('canBunnyRevive', false)
                        && canBunnyRevive()))
                    || $this->world->config('canSuperBunny', false))
                && ($items->has('MagicMirror')
                    || ($this->world->config('canOneFrameClipUW', false)
                        && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)
                        && $items->has('MoonPearl')
                        && (($items->has('PegasusBoots') && $this->world->config('canBootsClip', false))
                            || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                            || $this->world->config('canOneFrameClipOW', false))
                        && ($items->has('BigKeyP3') || $items->has('BigKeyD6')) && $mire($locations, $items)
                        && $locations["Old Man"]->canAccess($items)
                        && (($items->has('MoonPearl')
                            && (($items->has('PegasusBoots') && $this->world->config('canBootsClip', false))
                                || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())))
                                || $this->world->config('canOneFrameClipOW', false))))
                && $this->world->getRegion('South Light World')->canEnter($locations, $items);
        };

        return $this;
    }
}
