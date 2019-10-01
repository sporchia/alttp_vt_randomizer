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
 * North East Dark World Region and it's Locations contained within
 */
class NorthEast extends Region
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
            new Location\Standing("Catfish", [0xEE185], null, $this),
            new Location\Standing("Pyramid", [0x180147], null, $this),
            new Location\Trade("Pyramid Fairy - Sword", [0x180028], null, $this),
            new Location\Trade("Pyramid Fairy - Bow", [0x34914], null, $this),
            new Location\Prize\Event("Ganon", [], null, $this),
        ]);

        if ($this->world->config('region.swordsInPool', true)) {
            $this->locations->addItem(new Location\Chest("Pyramid Fairy - Left", [0xE980], null, $this));
            $this->locations->addItem(new Location\Chest("Pyramid Fairy - Right", [0xE983], null, $this));
        }

        $this->shops = new ShopCollection([
            new Shop("Dark World Potion Shop", 0x03, 0xC1, 0x010F, 0x6F, $this),
            // Single entrance caves with no items in them ;)
            new Shop\TakeAny("Dark Lake Hylia Fairy", 0x83, 0xC1, 0x0112, 0x6D, $this, [0xDBBDF => [0x58]]),
            new Shop\TakeAny("East Dark World Hint", 0x83, 0xC1, 0x0112, 0x69, $this, [0xDBBDB => [0x58]]),
            new Shop\TakeAny("Palace of Darkness Hint", 0x83, 0xC1, 0x010F, 0x68, $this, [0xDBBDA => [0x60]]),
        ]);

        $this->shops["Dark World Potion Shop"]->clearInventory()
            ->addInventory(0, Item::get('RedPotion', $world), 150)
            ->addInventory(1, Item::get('BlueShield', $world), 50)
            ->addInventory(2, Item::get('TenBombs', $world), 50);

        $this->locations->setChecksForWorld($world->id);
        // set these to not upgrade
        $this->locations["Pyramid Fairy - Sword"]->setItem(Item::get('L1Sword', $world));
        $this->locations["Pyramid Fairy - Bow"]->setItem(Item::get('Bow', $world));

        $this->prize_location = $this->locations["Ganon"];
        $this->prize_location->setItem(Item::get('DefeatGanon', $world));
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->shops["Dark World Potion Shop"]->setRequirements(function ($locations, $items) {
            return ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive())
                || (($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                    && ($this->world->config('canOneFrameClipOW', false)
                       || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                       || $items->has('Hammer') || $items->has('Flippers') || $items->canLiftRocks()));
        });
        
        // @TODO: do we want to allow super bunny item shopping
        $this->shops["East Dark World Hint"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive());
        });
        
        $this->shops["Palace of Darkness Hint"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false) && $items->hasABottle())
                || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive());
        });
        
        $this->locations["Catfish"]->setRequirements(function ($locations, $items) {
            return (($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive())
                   || $items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                && ($this->world->config('canOneFrameClipOW', false)
                   || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                   || $items->canLiftRocks());
        });
        
        $this->locations["Pyramid Fairy - Sword"]->setRequirements(function ($locations, $items) {
            return $items->hasSword()
                && (($items->has('Crystal5') && $items->has('Crystal6')
                        && ($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                        && $this->world->getRegion('South Dark World')->canEnter($locations, $items)
                        && ($items->has('Hammer')
                            || ($this->world->config('canOWYBA', false)
                                && (($items->has('MoonPearl') && $items->hasBottle()) || $items->hasBottle(2)))
                            || ($items->has('MagicMirror') && $items->has('DefeatAgahnim'))))
                    || ($this->world->config('canMirrorClip', false) && $items->has('MagicMirror')
                        && (($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                            || $this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')))));
        });
        
        $this->locations["Pyramid Fairy - Bow"]->setRequirements(function ($locations, $items) {
            return $items->canShootArrows()
                && (($items->has('Crystal5') && $items->has('Crystal6')
                        && ($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                        && $this->world->getRegion('South Dark World')->canEnter($locations, $items)
                        && ($items->has('Hammer')
                            || ($this->world->config('canOWYBA', false)
                                && (($items->has('MoonPearl') && $items->hasBottle()) || $items->hasBottle(2)))
                            || ($items->has('MagicMirror') && $items->has('DefeatAgahnim'))))
                    || ($this->world->config('canMirrorClip', false) && $items->has('MagicMirror')
                        && (($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                            || $this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')))));
        });
        
        
        if ($this->world->config('region.swordsInPool', true)) {
            $this->locations["Pyramid Fairy - Left"]->setRequirements(function ($locations, $items) {
                return ($items->has('Crystal5') && $items->has('Crystal6')
                        && ($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                        && $this->world->getRegion('South Dark World')->canEnter($locations, $items)
                        && ($items->has('Hammer')
                            || ($this->world->config('canOWYBA', false)
                                && (($items->has('MoonPearl') && $items->hasBottle()) || $items->hasBottle(2)))
                            || ($items->has('MagicMirror') && $items->has('DefeatAgahnim'))))
                    || ($this->world->config('canMirrorClip', false) && $items->has('MagicMirror')
                        && (($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                            || $this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))));
            });
            
            $this->locations["Pyramid Fairy - Right"]->setRequirements(function ($locations, $items) {
                return ($items->has('Crystal5') && $items->has('Crystal6')
                        && ($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                        && $this->world->getRegion('South Dark World')->canEnter($locations, $items)
                        && ($items->has('Hammer')
                            || ($this->world->config('canOWYBA', false)
                                && (($items->has('MoonPearl') && $items->hasBottle()) || $items->hasBottle(2)))
                            || ($items->has('MagicMirror') && $items->has('DefeatAgahnim'))))
                    || ($this->world->config('canMirrorClip', false) && $items->has('MagicMirror')
                        && (($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                            || $this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))));
            });
        }
        
        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && (($this->world->config('canOWYBA', false) && $items->hasABottle())
                    || $this->world->config('canOneFrameClipOW', false)
                    || ($items->has('MoonPearl') && ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')))
                    || ($items->has('MagicMirror') && $this->world->config('canMirrorClip', false)
                        && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)
                        && (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                            || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive())
                            || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())))
                    || $items->has('DefeatAgahnim')
                    || ($items->has('MagicMirror') && $this->world->config('canMirrorWrap', false)
                        && $this->world->config('canBunnyRevive', false) && $items->canBunnyRevive()
                        && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items))
                    || ($items->has('Hammer') && $items->canLiftRocks() && $items->has('MoonPearl'))
                    || (($items->canLiftDarkRocks() || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                        || ($items->has('MagicMirror') && $this->world->config('canMirrorWrap', false)
                            && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)))
                        && $items->has('MoonPearl')
                        && ($items->has('Hammer') || $items->has('Flippers')
                            || ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive())
                            || ($this->world->config('canWaterWalk', false) && $items->has('PegasusBoots'))
                            || ($this->world->config('canFakeFlipper', false) && !$this->world->config('region.cantTakeDamage', false)))));
        };

        $this->prize_location->setRequirements(function ($locations, $items) {
            if (
                $this->world->config('goal') == 'dungeons'
                && (!$items->has('PendantOfCourage')
                    || !$items->has('PendantOfWisdom')
                    || !$items->has('PendantOfPower')
                    || !$items->has('DefeatAgahnim')
                    || !$items->has('Crystal1')
                    || !$items->has('Crystal2')
                    || !$items->has('Crystal3')
                    || !$items->has('Crystal4')
                    || !$items->has('Crystal5')
                    || !$items->has('Crystal6')
                    || !$items->has('Crystal7')
                    || !$items->has('DefeatAgahnim2'))
            ) {
                return false;
            }

            if (
                in_array($this->world->config('goal'), ['ganon', 'fast_ganon'])
                && (($items->has('Crystal1')
                    + $items->has('Crystal2')
                    + $items->has('Crystal3')
                    + $items->has('Crystal4')
                    + $items->has('Crystal5')
                    + $items->has('Crystal6')
                    + $items->has('Crystal7')) < $this->world->config('crystals.ganon', 7))
            ) {
                return false;
            }

            return $items->has('MoonPearl')
                && ($items->has('DefeatAgahnim2') || $this->world->config('goal') === 'fast_ganon')
                && (!$this->world->config('region.requireBetterBow', false) || $items->canShootArrows(2))
                && (
                    ($this->world->config('mode.weapons') == 'swordless' && $items->has('Hammer'))
                    || (!$this->world->config('region.requireBetterSword', false) && ($items->hasSword(2) && ($items->has('Lamp') || ($items->has('FireRod') && $items->canExtendMagic(3)))))
                    || ($items->hasSword(3) && ($items->has('Lamp') || ($items->has('FireRod') && $items->canExtendMagic(2)))));
        });

        return $this;
    }
}
