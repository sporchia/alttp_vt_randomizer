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
 * North West Dark World Region and it's Locations contained within
 */
class NorthWest extends Region
{
    protected $name = 'Dark World';

    /**
     * Create a new North West Dark World Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations = new LocationCollection([
            new Location\Chest("Brewery", [0xE9EC], null, $this),
            new Location\Chest("C-Shaped House", [0xE9EF], null, $this),
            new Location\Chest("Chest Game", [0xEDA8], null, $this),
            new Location\Standing("Hammer Pegs", [0x180006], null, $this),
            new Location\Standing("Bumper Cave", [0x180146], null, $this),
            new Location\Npc("Blacksmith", [$world->config('region.swordsInPool', true) ? 0x18002A : 0x3355C], null, $this),
            new Location\Npc("Purple Chest", [0x33D68], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->shops = new ShopCollection([
            new Shop("Dark World Forest Shop", 0x03, 0xC1, 0x0110, 0x75, $this),
            new Shop("Dark World Lumberjack Hut Shop", 0x03, 0xC1, 0x010F, 0x57, $this),
            new Shop("Dark World Outcasts Shop", 0x03, 0xC1, 0x010F, 0x60, $this),
            // Single entrance caves with no items in them ;)
            new Shop\TakeAny("Dark Sanctuary Hint", 0x83, 0xC1, 0x0112, 0x5A, $this, [0xDBBCC => [0x58]]),
            new Shop\TakeAny("Fortune Teller (Dark)", 0x83, 0xC1, 0x010F, 0x66, $this, [0xDBBD8 => [0x60]]),
        ]);

        $this->shops["Dark World Forest Shop"]->clearInventory()
            ->addInventory(0, Item::get('RedShield', $world), 500)
            ->addInventory(1, Item::get('Bee', $world), 10)
            ->addInventory(2, Item::get('TenArrows', $world), 30);
        $this->shops["Dark World Lumberjack Hut Shop"]->clearInventory()
            ->addInventory(0, Item::get('RedPotion', $world), 150)
            ->addInventory(1, Item::get('BlueShield', $world), 50)
            ->addInventory(2, Item::get('TenBombs', $world), 50);
        $this->shops["Dark World Outcasts Shop"]->clearInventory()
            ->addInventory(0, Item::get('RedPotion', $world), 150)
            ->addInventory(1, Item::get('BlueShield', $world), 50)
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
        $this->shops["Dark World Outcasts Shop"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && ($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive()));
        });
        
        $this->locations["Brewery"]->setRequirements(function ($locations, $items) {
            return $items->canBombThings() && ($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive()));
        });
        
        $this->locations["C-Shaped House"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') || $this->world->config('canSuperBunny', false)
                || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive());
        });
        
        $this->locations["Chest Game"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl') || $this->world->config('canSuperBunny', false)
                || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive());
        });
        
        $this->locations["Hammer Pegs"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && ($items->has('MoonPearl')
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                    || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive()))
                && ($items->canLiftDarkRocks()
                    || ($items->has('MagicMirror') && $this->world->config('canMirrorWrap', false))
                    || (($this->world->config('canFakeFlipper', false) || $items->has('Flippers'))
                        && ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                            || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed()))));
        });
        
        $this->locations["Bumper Cave"]->setRequirements(function ($locations, $items) {
            return $this->world->config('canOneFrameClipOW', false)
                || (($items->has('MoonPearl')
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                    || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive()))
                    && (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                        || (($this->world->config('itemPlacement') !== 'basic' || $items->has('Hookshot'))
                            && $items->canLiftRocks() && $items->has('Cape'))));
        });
        
        $this->locations["Blacksmith"]->setRequirements(function ($locations, $items) {
            return ($this->world->config('itemPlacement') !== 'basic' || $items->has('MagicMirror'))
                && ((($items->has('MoonPearl')
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                    || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive()))
                    && $items->canLiftDarkRocks())
                || (($this->world->config('canOWYBA', false) && $items->hasBottle())
                    && ($this->world->config('canOneFrameClipOW', false)
                        || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')
                            && ($items->has('MoonPearl') || $items->hasBottle(2))))));
        });
        
        $this->locations["Purple Chest"]->setRequirements(function ($locations, $items) {
            return $locations["Blacksmith"]->canAccess($items)
                && (($items->has('MagicMirror') && $this->world->config('canMirrorWrap', false))
                    || (($items->has('MoonPearl')
                        || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                        || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive()))
                        && ($items->canLiftDarkRocks() 
                            || (($this->world->config('canFakeFlipper', false) || $items->has('Flippers'))
                                && ($this->world->config('canOneFrameClipOW', false)
                                    || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                                    || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed()))))));
        });
        
        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && ($this->world->config('canOneFrameClipOW', false)
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                    || ($this->world->getRegion('West Death Mountain')->canEnter($locations, $items) && $items->has('MagicMirror')
                         && ($this->world->config('canMirrorClip', false) || $this->world->config('canMirrorWrap', false)))
                    || ($items->has('MoonPearl')
                        && (($this->world->getRegion('North East Dark World')->canEnter($locations, $items)
                            && ($items->has('Hookshot')
                                && ($items->canLiftRocks() || $items->has('Hammer')
                                    || ($items->has('Flippers')
                                        || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive())))))
                            || ($items->has('Hammer') && $items->canLiftRocks())
                            || $items->canLiftDarkRocks()
                            || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                            || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed()))));
        };
        return $this;
    }
}
