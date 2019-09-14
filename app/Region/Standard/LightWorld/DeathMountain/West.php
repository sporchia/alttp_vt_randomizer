<?php

namespace ALttP\Region\Standard\LightWorld\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Death Mountain Region and it's Locations contained within
 */
class West extends Region
{
    protected $name = 'Death Mountain';

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

        $this->locations = new LocationCollection([
            new Location\Npc("Old Man", [0xF69FA], null, $this),
            new Location\Standing("Spectacle Rock Cave", [0x180002], null, $this),
            new Location\Drop\Ether("Ether Tablet", [0x180016], null, $this),
            new Location\Standing("Spectacle Rock", [0x180140], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Old Man"]->setRequirements(function ($locations, $items) {
            return $items->has('Lamp', $this->world->config('item.require.Lamp', 1));
        });

        $this->locations["Ether Tablet"]->setRequirements(function ($locations, $items) {
            return $items->has('BookOfMudora') && ($items->hasSword(2)
                || ($this->world->config('mode.weapons') == 'swordless' && $items->has('Hammer')))
                && $this->world->getRegion('Tower of Hera')->canEnter($locations, $items);
        });

        $this->locations["Spectacle Rock"]->setRequirements(function ($locations, $items) {
            return $items->has('MagicMirror')
                || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'));
        });

        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && ($items->canFly($this->world)
                    || $this->world->config('canOneFrameClipOW', false)
                    || ($this->world->config('canOWYBA', false) &&  $items->hasABottle())
                    || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                    || ($items->canLiftRocks() && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))));
        };

        return $this;
    }
}
