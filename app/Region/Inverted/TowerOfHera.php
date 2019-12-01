<?php

namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Region;

/**
 * Tower of Hera Region and it's Locations contained within
 */
class TowerOfHera extends Region\Standard\TowerOfHera
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
            return ($this->world->getRegion('East Death Mountain')->canEnter($locations, $items)
                && $items->has('MoonPearl')
                && $items->has('Hammer')) || ($this->world->getRegion('West Death Mountain')->canEnter($locations, $items)
                    && ((($items->has('MoonPearl')
                        || ($this->world->config('canOWYBA', false) && $items->hasABottle(2))
                            || ((($this->world->config('canOWYBA', false) && $items->hasABottle())
                            || ($this->world->config('canBunnyRevive', false)&& $items->canBunnyRevive()))
                            && ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))))
                            && ($this->world->config('canOneFrameClipOW', false)
                                || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                                || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))))
                        || ($this->world->config('canOneFrameClipOW', false) && $items->hasSword()
                            && $this->world->config('canSuperBunny', false) && $items->has('MagicMirror'))));
        };

        $mire = function ($locations, $items) {
            return $this->world->config('canOneFrameClipUW', false)
                && (
                    ($locations->itemInLocations(Item::get('BigKeyD6', $this->world), [
                        "Misery Mire - Compass Chest",
                        "Misery Mire - Big Key Chest",
                    ]) &&
                        $items->has('KeyD6', 2)) || $items->has('KeyD6', 3)) &&
                $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
        };


        $this->locations["Tower of Hera - Big Key Chest"]->setRequirements(function ($locations, $items) use ($mire) {
            return $items->canLightTorches()
                && (($items->has('KeyP3')
                    && ($items->has('MoonPearl') || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()))) || ($mire($locations, $items)
                    && $items->has('KeyD6', 4)));
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('KeyP3', $this->world);
        });

        $this->locations["Tower of Hera - Compass Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return ($main($locations, $items)
                && $items->has('BigKeyP3')) ||
                $mire($locations, $items);
        });

        $this->locations["Tower of Hera - Big Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return ($main($locations, $items)
                && $items->has('BigKeyP3')) || ($mire($locations, $items)
                && ($items->has('BigKeyP3')
                    || $items->has('BigKeyD6')));
        });

        $this->locations["Tower of Hera - Boss"]->setRequirements(function ($locations, $items) use ($main, $mire){
            return $main($locations, $items)
                && $this->boss->canBeat($items, $locations)
                && ($items->has('BigKeyP3') || ($mire($locations, $items) && $items->has('BigKeyD6')))
                && (!$this->world->config('region.wildCompasses', false)
                    || $items->has('CompassP3')
                    || $this->locations["Tower of Hera - Boss"]->hasItem(Item::get('CompassP3', $this->world))) && (!$this->world->config('region.wildMaps', false)
                    || $items->has('MapP3')
                    || $this->locations["Tower of Hera - Boss"]->hasItem(Item::get('MapP3', $this->world)));
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
                && ($item == Item::get('CompassP3', $this->world) || $item == Item::get('MapP3', $this->world));
        });

        $this->can_enter = function ($locations, $items) use ($main, $mire) {
            return ($main($locations, $items)
                || $mire($locations, $items));
        };

        return $this;
    }
}
