<?php

namespace ALttP\Region\Standard\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * Dark World Region and it's Locations contained within
 */
class West extends Region
{
    protected $name = 'Dark World';

    /**
     * Create a new Dark World Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations = new LocationCollection([
            new Location\Chest("Spike Cave", [0xEA8B], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->shops = new ShopCollection([
            new Shop\TakeAny("Dark Death Mountain Fairy", 0x83, 0xC1, 0x0112, 0x70, $this, [0xDBBE2 => [0x58]]),
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
        $this->shops["Dark Death Mountain Fairy"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false) && $items->hasABottle()
                    && (($items->has('PegasusBoots') && $this->world->config('canBootsClip', false))
                        || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Spike Cave"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle()
                        && (($items->has('PegasusBoots') && $this->world->config('canBootsClip', false))
                            || $this->world->config('canOneFrameClipOW', false))
                        && (($items->has('Cape') && $items->canExtendMagic(3))
                            || ((!$this->world->config('region.cantTakeDamage', false) || $items->canExtendMagic(3))
                                && $items->has('CaneOfByrna')))))
                && $items->has('Hammer') && $items->canLiftRocks()
                && (($items->canExtendMagic() && $items->has('Cape'))
                    || ((!$this->world->config('region.cantTakeDamage', false) || $items->canExtendMagic()) && $items->has('CaneOfByrna')));
        });

        $this->can_enter = function ($locations, $items) {
            return ($items->has('RescueZelda') 
            && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items));
        };

        return $this;
    }
}
