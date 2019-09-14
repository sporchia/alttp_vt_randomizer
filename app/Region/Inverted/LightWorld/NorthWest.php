<?php

namespace ALttP\Region\Inverted\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * North West Light World Region and it's Locations contained within
 */
class NorthWest extends Region\Standard\LightWorld\NorthWest
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->shops["Bush Covered House"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->shops["Bomb Hut"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->canBombThings();
        });

        // Bunny can pull pedestal
        $this->locations["Master Sword Pedestal"]->setRequirements(function ($locations, $items) {
            return $items->has('PendantOfPower')
                && $items->has('PendantOfWisdom')
                && $items->has('PendantOfCourage');
        });

        $this->locations["King's Tomb"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->canLiftDarkRocks() && $items->has('PegasusBoots');
        });

        $this->locations["Kakariko Tavern"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Chicken House"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->canBombThings();
        });

        $this->locations["Kakariko Well - Top"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->canBombThings();
        });

        $this->locations["Kakariko Well - Left"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Kakariko Well - Middle"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Kakariko Well - Right"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Kakariko Well - Bottom"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Blind's Hideout - Top"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->canBombThings();
        });

        $this->locations["Blind's Hideout - Left"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Blind's Hideout - Right"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Blind's Hideout - Far Left"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Blind's Hideout - Far Right"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Pegasus Rocks"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->has('PegasusBoots');
        });

        $this->locations["Magic Bat"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->has('Hammer') && $items->has('Powder');
        });

        $this->locations["Sick Kid"]->setRequirements(function ($locations, $items) {
            return $items->hasBottle();
        });

        $this->locations["Lumberjack Tree"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->has('DefeatAgahnim') && $items->has('PegasusBoots');
        });

        $this->locations["Graveyard Ledge"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') && $items->canBombThings();
        });

        $this->locations["Mushroom"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->locations["Lost Woods Hideout"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl');
        });

        $this->can_enter = function ($locations, $items) {
            return $this->world->getRegion('North East Light World')->canEnter($locations, $items);
        };

        return $this;
    }
}
