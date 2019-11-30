<?php

namespace ALttP\Region\Inverted\LightWorld\DeathMountain;

use ALttP\Location;
use ALttP\Region;
use ALttP\World;

/**
 * East Death Mountain Region and it's Locations contained within
 */
class East extends Region\Standard\LightWorld\DeathMountain\East
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

        $this->locations->addItem(new Location\Drop\Ether("Ether Tablet", [0x180016], null, $this));
        $this->locations->addItem(new Location\Standing("Spectacle Rock", [0x180140], null, $this));
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->shops["Light World Death Mountain Shop"]->setRequirements(function ($locations, $items) {
            return (($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle(2))) && ($items->has('Hookshot')
                || ($this->world->config('canSuperSpeed', false)
                    && $items->canSpinSpeed())) || ($this->world->config('canOWYBA', false)
                && $items->hasABottle()
                && ((($this->world->config('canBootsClip', false)
                    && $items->has('PegasusBoots')) ||
                    $this->world->config('canOneFrameClipOW', false)))))
                && $items->canBombThings();
        });


        $this->locations["Spiral Cave"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')) || ($this->world->config('canOWYBA', false)
                && $items->hasABottle(2) && ($items->has('Hookshot') 
                    || $this->world->config('canSuperSpeed', false)
                    && $items->canSpinSpeed())) 
                || ($this->world->config('canSuperBunny', false) && $items->has('MagicMirror')
                && $items->hasSword()) 
                || (($this->world->config('canOWYBA', false)
                    && $items->hasABottle())
                && (($this->world->config('canBootsClip', false)
                    && $items->has('PegasusBoots')) 
                    || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Mimic Cave"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && ($items->has('MoonPearl')
                    || (($this->world->config('canOWYBA', false)
                        && $items->hasABottle()) && (
                        ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoots')) ||
                        $this->world->config('canOneFrameClipOW', false))));
        });

        $this->locations["Paradox Cave Lower - Far Left"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle(2) && ($items->has('Hookshot')
                        || ($this->world->config('canSuperSpeed', false)
                        && $items->canSpinSpeed()))) || ($this->world->config('canOWYBA', false)
                && $items->hasABottle()
                && (($this->world->config('canBootsClip', false)
                    && $items->has('PegasusBoots'))
                    || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Paradox Cave Lower - Left"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle(2) && ($items->has('Hookshot')
                        || ($this->world->config('canSuperSpeed', false)
                        && $items->canSpinSpeed()))) || ($this->world->config('canOWYBA', false)
                && $items->hasABottle()
                && (($this->world->config('canBootsClip', false)
                    && $items->has('PegasusBoots'))
                    || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Paradox Cave Lower - Right"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle(2) && ($items->has('Hookshot')
                        || ($this->world->config('canSuperSpeed', false)
                        && $items->canSpinSpeed()))) || ($this->world->config('canOWYBA', false)
                && $items->hasABottle()
                && (($this->world->config('canBootsClip', false)
                    && $items->has('PegasusBoots'))
                    || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Paradox Cave Lower - Far Right"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle(2) && ($items->has('Hookshot')
                        || ($this->world->config('canSuperSpeed', false)
                        && $items->canSpinSpeed()))) || ($this->world->config('canOWYBA', false)
                && $items->hasABottle()
                && (($this->world->config('canBootsClip', false)
                    && $items->has('PegasusBoots'))
                    || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Paradox Cave Lower - Middle"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle(2) && ($items->has('Hookshot')
                        || ($this->world->config('canSuperSpeed', false)
                        && $items->canSpinSpeed()))) || ($this->world->config('canOWYBA', false)
                && $items->hasABottle()
                && (($this->world->config('canBootsClip', false)
                    && $items->has('PegasusBoots'))
                    || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Paradox Cave Upper - Left"]->setRequirements(function ($locations, $items) {
            return $items->canBombThings()
                && ($items->has('MoonPearl')
                    || ($this->world->config('canOWYBA', false)
                        && $items->hasABottle(2) && ($items->has('Hookshot')
                            || ($this->world->config('canSuperSpeed', false)
                                && $items->canSpinSpeed())))
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle()
                    && (($this->world->config('canBootsClip', false)
                        && $items->has('PegasusBoots'))
                        || $this->world->config('canOneFrameClipOW', false))));
        });

        $this->locations["Paradox Cave Upper - Right"]->setRequirements(function ($locations, $items) {
            return $items->canBombThings()
                && ($items->has('MoonPearl')
                    || ($this->world->config('canOWYBA', false)
                        && $items->hasABottle(2) && ($items->has('Hookshot')
                            || ($this->world->config('canSuperSpeed', false)
                                && $items->canSpinSpeed())))
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle()
                    && (($this->world->config('canBootsClip', false)
                        && $items->has('PegasusBoots'))
                        || $this->world->config('canOneFrameClipOW', false))));
        });

        $this->locations["Ether Tablet"]->setRequirements(function ($locations, $items) {
            return $items->has('BookOfMudora')
                && (($this->world->config('mode.weapons') == 'swordless'
                    && $items->has('Hammer'))
                    || $items->hasSword(2)) && (($items->has('MoonPearl')
                    && ($items->has('Hammer')
                    || ($this->world->config('canBootsClip', false)
                        && $items->has('PegasusBoots')) || ($this->world->config('canSuperSpeed', false)
                        && $items->canSpinSpeed())
                            || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()
                                && $this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))))
				        || $this->world->config('canOneFrameClipOW', false))
                );
        });

        $this->locations["Spectacle Rock"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                && ($items->has('Hammer')
                    || ($this->world->config('canSuperSpeed', false)
                        && $items->canSpinSpeed()) || ($this->world->config('canBootsClip', false)
                        && $items->has('PegasusBoots')))) || ($this->world->config('canOWYBA', false)
                && $items->hasABottle()
                && $this->world->config('canBootsClip', false)
                && $items->has('PegasusBoots')) ||
                $this->world->config('canOneFrameClipOW', false);
        });

        $this->can_enter = function ($locations, $items) {
            return ($items->canLiftDarkRocks()
                && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items)) || ($this->world->getRegion('West Death Mountain')->canEnter($locations, $items)
                && (
                    (($items->has('MoonPearl')
                        || ($this->world->config('canOWYBA', false)
                            && $items->hasABottle(2))) && ($items->has('Hookshot')
                        || ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoots')) || ($this->world->config('canSuperSpeed', false)
                            && $items->canSpinSpeed()))) 
                    || ($this->world->config('canMirrorWrap', false)
                        && $items->has('MagicMirror')) ||
                    $this->world->config('canOneFrameClipOW', false)));
        };

        return $this;
    }
}