<?php

namespace ALttP\Region\Standard\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * Mire Dark World Region and it's Locations contained within
 */
class Mire extends Region
{
    protected $name = 'Dark World';

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

        $this->locations = new LocationCollection([
            new Location\Chest("Mire Shed - Left", [0xEA73], null, $this),
            new Location\Chest("Mire Shed - Right", [0xEA76], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->shops = new ShopCollection([
            new Shop\TakeAny("Dark Desert Fairy", 0x83, 0xC1, 0x0112, 0x56, $this, [0xDBBC8 => [0x58]]),
            new Shop\TakeAny("Dark Desert Hint", 0x83, 0xC1, 0x0112, 0x62, $this, [0xDBBD4 => [0x58]]),
        ]);
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->shops["Dark Desert Fairy"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || (($this->world->config('canOWYBA', false) && $items->hasABottle())
                    && ($this->world->config('canOneFrameClipOW', false) || $items->hasBottle(2)
                        || ($items->has('MagicMirror') && $items->has('BugCatchingNet') && $this->world->config('canBunnyRevive', false))
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))));
        });
        
        $this->shops["Dark Desert Hint"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || (($this->world->config('canOWYBA', false) && $items->hasABottle())
                    && ($this->world->config('canOneFrameClipOW', false) || $items->hasBottle(2)
                        || ($items->has('MagicMirror') && $items->has('BugCatchingNet') && $this->world->config('canBunnyRevive', false))
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))));
        });
        
        $this->locations["Mire Shed - Left"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || (($this->world->config('canOWYBA', false) && $items->hasABottle())
                    && ($this->world->config('canOneFrameClipOW', false) || $items->hasBottle(2)
                        || ($items->has('MagicMirror') && $items->has('BugCatchingNet') && $this->world->config('canBunnyRevive', false))
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))))
                || ($this->world->config('canSuperBunny', false)
                    && ($items->has('MagicMirror') || ($items->hasHealth(5) && !$this->world->config('region.cantTakeDamage', false))));
        });
        
        $this->locations["Mire Shed - Right"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || (($this->world->config('canOWYBA', false) && $items->hasABottle())
                    && ($this->world->config('canOneFrameClipOW', false) || $items->hasBottle(2)
                        || ($items->has('MagicMirror') && $items->has('BugCatchingNet') && $this->world->config('canBunnyRevive', false))
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))))
                || ($this->world->config('canSuperBunny', false)
                    && ($items->has('MagicMirror') || ($items->hasHealth(5) && !$this->world->config('region.cantTakeDamage', false))));
        });
        
        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && (($items->canLiftDarkRocks() && ($items->canFly($this->world)
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))))
                    || $this->world->config('canOneFrameClipOW', false)
                    || (((($items->has('MoonPearl') || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive()))
                        && ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')))
                        || ($this->world->config('canMirrorWrap', false) && $items->has('MagicMirror')))
                        && $this->world->getRegion('South Dark World')->canEnter($locations, $items))
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle()));
        };

        return $this;
    }
}
