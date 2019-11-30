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
class East extends Region
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
            new Location\Chest("Superbunny Cave - Top", [0xEA7C], null, $this),
            new Location\Chest("Superbunny Cave - Bottom", [0xEA7F], null, $this),
            new Location\Chest("Hookshot Cave - Top Right", [0xEB51], null, $this),
            new Location\Chest("Hookshot Cave - Top Left", [0xEB54], null, $this),
            new Location\Chest("Hookshot Cave - Bottom Left", [0xEB57], null, $this),
            new Location\Chest("Hookshot Cave - Bottom Right", [0xEB5A], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->shops = new ShopCollection([
            new Shop("Dark World Death Mountain Shop", 0x03, 0xC1, 0x0112, 0x6E, $this),
        ]);

        $this->shops["Dark World Death Mountain Shop"]->clearInventory()
            ->addInventory(0, Item::get('RedPotion', $world), 150)
            ->addInventory(1, Item::get('Heart', $world), 10)
            ->addInventory(2, Item::get('TenBombs', $world), 50);
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Superbunny Cave - Top"]->setRequirements(function ($locations, $items) {
            return $this->world->config('canSuperBunny', false) || $items->has('MoonPearl')
                || (($this->world->config('canOWYBA', false) && $items->hasBottle())
                    && (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                        || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Superbunny Cave - Bottom"]->setRequirements(function ($locations, $items) {
            return $this->world->config('canSuperBunny', false) || $items->has('MoonPearl')
                || (($this->world->config('canOWYBA', false) && $items->hasBottle())
                    && (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                        || $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Hookshot Cave - Top Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hookshot')
                && (($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasBottle()))
                    && ($items->canLiftRocks() || $this->world->config('canOneFrameClipOW', false)
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))));
        });

        $this->locations["Hookshot Cave - Top Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hookshot')
                && (($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasBottle()))
                    && ($items->canLiftRocks() || $this->world->config('canOneFrameClipOW', false)
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))));
        });

        $this->locations["Hookshot Cave - Bottom Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hookshot')
                && (($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasBottle()))
                    && ($items->canLiftRocks() || $this->world->config('canOneFrameClipOW', false)
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))));
        });

        $this->locations["Hookshot Cave - Bottom Right"]->setRequirements(function ($locations, $items) {
            return ($items->has('Hookshot') || ($this->world->config('itemPlacement') !== 'basic' && $items->has('PegasusBoots')))
                && (($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasBottle()))
                    && ($items->canLiftRocks() || $this->world->config('canOneFrameClipOW', false)
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))));
        });

        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && (($items->canLiftDarkRocks()
                    && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items))
                    || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')
                        && ($items->has('MoonPearl') || $items->has('Hammer')
                            || ($this->world->config('canOWYBA', false) && $items->hasBottle())))
                    || $this->world->config('canOneFrameClipOW', false)
                    || ($this->world->getRegion('West Death Mountain')->canEnter($locations, $items)
                        && ($this->world->config('canMirrorClip', false) || $this->world->config('canMirrorWrap', false))
                        && $items->has('MagicMirror')));
        };

        return $this;
    }
}
