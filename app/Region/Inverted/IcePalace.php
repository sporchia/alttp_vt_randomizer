<?php

namespace ALttP\Region\Inverted;

use ALttP\Region;

/**
 * Ice Palace Region and it's Locations contained within
 */
class IcePalace extends Region\Standard\IcePalace
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

        $this->can_enter = function ($locations, $items) {
            return ($this->world->config('itemPlacement') !== 'basic'
                || (
                    ($this->world->config('mode.weapons') === 'swordless'
                        || $items->hasSword(2))
                    && $items->hasHealth(12)
                    && ($items->hasBottle(2)
                        || $items->hasArmor()))) && ($items->canMeltThings($this->world)
                || $this->world->config('canOneFrameClipUW', false)) && (($items->has('Flippers')
                || ($this->world->config('canFakeFlipper', false)
                    && ($this->world->config('canBunnyRevive', false)
                    || (!$this->world->config('region.cantTakeDamage', false)
                        && $this->world->getRegion('North West Dark World')->canEnter($locations, $items)) ||
                    $items->canFly($this->world)
                    || ($this->world->getRegion('North West Dark World')->canEnter($locations, $items)
                        && ($items->has('Hammer')
                            || $items->canLiftRocks()))))) || ($this->world->config('canBootsClip', false)
                && $items->has('PegasusBoots'))
                ||
                $this->world->config('canOneFrameClipOW', false)
                || ($this->world->config('canSuperSpeed', false)
                    && $items->canSpinSpeed()));
        };

        return $this;
    }
}
