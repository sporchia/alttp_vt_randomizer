<?php

namespace ALttP\Region\Standard\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * North East Light World Region and it's Locations contained within
 */
class NorthEast extends Region
{
    protected $name = 'Light World';

    /**
     * Create a new Light World Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations = new LocationCollection([
            new Location\Chest("Sahasrahla's Hut - Left", [0xEA82], null, $this),
            new Location\Chest("Sahasrahla's Hut - Middle", [0xEA85], null, $this),
            new Location\Chest("Sahasrahla's Hut - Right", [0xEA88], null, $this),
            new Location\Npc("Sahasrahla", [0x2F1FC], null, $this),
            new Location\Npc\Zora("King Zora", [0xEE1C3], null, $this),
            new Location\Npc\Witch("Potion Shop", [0x180014], null, $this),
            new Location\Standing("Zora's Ledge", [0x180149], null, $this),
            new Location\Chest("Waterfall Fairy - Left", [0xE9B0], null, $this),
            new Location\Chest("Waterfall Fairy - Right", [0xE9D1], null, $this),
        ]);

        $this->shops = new ShopCollection([
            new Shop\TakeAny("Long Fairy Cave", 0x83, 0xA0, 0x0112, 0x55, $this, [0xDBBC7 => [0x58]]),
            new Shop\TakeAny("Lake Hylia Fairy", 0x83, 0xA0, 0x0112, 0x5E, $this, [0xDBBD0 => [0x58]]),
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
        $this->locations["Sahasrahla"]->setRequirements(function ($locations, $items) {
            return $items->has('PendantOfCourage');
        });

        $this->locations["King Zora"]->setRequirements(function ($locations, $items) {
            return $this->world->config('canFakeFlipper', false)
                || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                || $items->canLiftRocks() || $items->has('Flippers');
        });

        $this->locations["Potion Shop"]->setRequirements(function ($locations, $items) {
            return $items->has('Mushroom');
        });

        $this->locations["Zora's Ledge"]->setRequirements(function ($locations, $items) {
            return (($this->world->config('canWaterWalk', false) || $this->world->config('canBootsClip', false))
                && $items->has('PegasusBoots'))
                || $items->has('Flippers');
        });

        $this->locations["Waterfall Fairy - Left"]->setRequirements(function ($locations, $items) {
            return ($this->world->config('canFakeFlipper', false) && $items->has('MoonPearl'))
                || ($this->world->config('canWaterWalk', false) && $items->has('PegasusBoots'))
                || $items->has('Flippers');
        });

        $this->locations["Waterfall Fairy - Right"]->setRequirements(function ($locations, $items) {
            return ($this->world->config('canFakeFlipper', false) && $items->has('MoonPearl'))
                || ($this->world->config('canWaterWalk', false) && $items->has('PegasusBoots'))
                || $items->has('Flippers');
        });

        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda');
        };

        return $this;
    }
}
