<?php

namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Region;

/**
 * Hyrule Castle Escape Region and it's Locations contained within
 */
class HyruleCastleEscape extends Region\Open\HyruleCastleEscape
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
        
        $this->locations["Sanctuary"]->setRequirements(function ($locations, $items) {
            return ($items->has('KeyH2') && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)))
                || (($items->has('MoonPearl')
                    || ($this->world->config('canSuperBunny', false)
                        && $items->has('MagicMirror'))
                    || ($this->world->config('canOWYBA', false)
                        && $items->hasABottle())
                    || ($this->world->config('canBunnyRevive', false)
                        && $items->canBunnyRevive()))
                    && $this->world->getRegion('North West Light World')->canEnter($locations, $items));
        });

        $this->locations["Secret Passage"]->setRequirements(function ($locations, $items) {
            return (
                ($this->world->config('canMirrorClip', false)
                    && $this->world->config('canSuperBunny', false)
                    && $items->has('MagicMirror')
                    && (
                        ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoot')) || ($this->world->config('canSuperSpeed', false)
                            && $items->canSpinSpeed()) ||
                        $this->world->config('canOneFrameClipOW', false)) &&
                    $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) ||
                $items->has('MoonPearl')) &&
                $this->world->getRegion('North East Light World')->canEnter($locations, $items);
        })->setFillRules(function ($item, $locations, $items) {
            return !((!$this->world->config('region.wildKeys', false) && $item instanceof Item\Key)
                || (!$this->world->config('region.wildBigKeys', false) && $item instanceof Item\BigKey)
                || (!$this->world->config('region.wildMaps', false) && $item instanceof Item\Map)
                || (!$this->world->config('region.wildCompasses', false) && $item instanceof Item\Compass));
        });

        $this->locations["Link's Uncle"]->setRequirements(function ($locations, $items) {
            return (
                ($this->world->config('canMirrorClip', false)
                    && $items->has('MagicMirror')
                    && (
                        ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoot')) || ($this->world->config('canSuperSpeed', false)
                            && $items->canSpinSpeed()) ||
                        $this->world->config('canOneFrameClipOW', false)) &&
                    $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) ||
                $items->has('MoonPearl')) &&
                $this->world->getRegion('North East Light World')->canEnter($locations, $items);
        })->setFillRules(function ($item, $locations, $items) {
            return $this->locations["Sanctuary"]->canAccess($this->world->collectItems())
                && !((!$this->world->config('region.wildKeys', false) && $item instanceof Item\Key)
                    || (!$this->world->config('region.wildBigKeys', false) && $item instanceof Item\BigKey)
                    || (!$this->world->config('region.wildMaps', false) && $item instanceof Item\Map)
                    || (!$this->world->config('region.wildCompasses', false) && $item instanceof Item\Compass));
        });


        $this->can_enter = function ($locations, $items) {
            return ($this->world->config('canDungeonRevive', false)
                || ($this->world->config('canSuperBunny', false)
                    && $items->has('MagicMirror')) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) ||
                $items->has('MoonPearl')) &&
                $this->world->getRegion('North East Light World')->canEnter($locations, $items);
        };

        return $this;
    }
}
