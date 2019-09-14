<?php

namespace ALttP\Region\Standard\LightWorld\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * East Death Mountain Region and it's Locations contained within
 */
class East extends Region
{
    protected $name = 'Death Mountain';

    /**
     * Create a new East Death Mountain Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations = new LocationCollection([
            new Location\Chest("Spiral Cave", [0xE9BF], null, $this),
            new Location\Chest("Mimic Cave", [0xE9C5], null, $this),
            new Location\Chest("Paradox Cave Lower - Far Left", [0xEB2A], null, $this),
            new Location\Chest("Paradox Cave Lower - Left", [0xEB2D], null, $this),
            new Location\Chest("Paradox Cave Lower - Right", [0xEB30], null, $this),
            new Location\Chest("Paradox Cave Lower - Far Right", [0xEB33], null, $this),
            new Location\Chest("Paradox Cave Lower - Middle", [0xEB36], null, $this),
            new Location\Chest("Paradox Cave Upper - Left", [0xEB39], null, $this),
            new Location\Chest("Paradox Cave Upper - Right", [0xEB3C], null, $this),
            new Location\Standing("Floating Island", [0x180141], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->shops = new ShopCollection([
            new Shop("Light World Death Mountain Shop", 0x43, 0xA0, 0x00FF, 0x00, $this),

            new Shop\TakeAny("Hookshot Fairy", 0x83, 0xA0, 0x0112, 0x50, $this, [0xDBBC2 => [0x58]]),
        ]);

        $this->shops["Light World Death Mountain Shop"]->clearInventory()
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
        $this->shops["Light World Death Mountain Shop"]->setRequirements(function ($locations, $items) {
            return $items->canBombThings();
        });

        $this->locations["Mimic Cave"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && ((($this->world->config('canMirrorClip', false) && $items->has('MagicMirror'))
                    || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots') && $items->has('MoonPearl'))
                    && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items))
                    || ($items->has('MagicMirror') && $items->has('KeyD7', 2)
                        && $this->world->getRegion('Turtle Rock')->canEnter($locations, $items)));
        });

        $this->locations["Floating Island"]->setRequirements(function ($locations, $items) {
            return ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                || ($items->has('MagicMirror') && $items->has('MoonPearl')
                    && $items->canBombThings()
                    && $items->canLiftRocks()
                    && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items));
        });

        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)
                && ($this->world->config('canOneFrameClipOW', false)
                    || ($this->world->config('canMirrorClip', false) && $items->has('MagicMirror'))
                    || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                    || ($items->has('Hammer') && $items->has('MagicMirror'))
                    || $items->has('Hookshot'));
        };

        return $this;
    }
}
