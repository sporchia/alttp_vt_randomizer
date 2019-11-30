<?php

namespace ALttP\Region\Inverted\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\World;

/**
 * North East Light World Region and it's Locations contained within
 */
class NorthEast extends Region\Standard\LightWorld\NorthEast
{
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations->addItem(new Location\Prize\Event("Ganon", [], null, $this));

        $this->prize_location = $this->locations["Ganon"];
        $this->prize_location->setItem(Item::get('DefeatGanon', $world));
    }
    /**
     * Initalize the requirements for Entry and Completetion of the Region as
     * well as access to all Locations contained within for No Glitches.
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Sahasrahla's Hut - Left"]->setRequirements(function ($locations, $items) {
            return (($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()))
                && $items->canBombThings())
                || ($this->world->config('canSuperBunny', false)
                    && $items->has('PegasusBoots')
                    && ($items->has('MagicMirror')
                        || !$this->world->config('region.cantTakeDamage', false)));
        });

        $this->locations["Sahasrahla's Hut - Middle"]->setRequirements(function ($locations, $items) {
            return (($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()))
                && $items->canBombThings())
                || ($this->world->config('canSuperBunny', false)
                    && $items->has('PegasusBoots')
                    && ($items->has('MagicMirror')
                        || !$this->world->config('region.cantTakeDamage', false)));
        });

        $this->locations["Sahasrahla's Hut - Right"]->setRequirements(function ($locations, $items) {
            return (($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()))
                && $items->canBombThings())
                || ($this->world->config('canSuperBunny', false)
                    && $items->has('PegasusBoots')
                    && ($items->has('MagicMirror')
                        || !$this->world->config('region.cantTakeDamage', false)));
        });

        $this->locations["Sahasrahla"]->setRequirements(function ($locations, $items) {
            return $items->has('PendantOfCourage');
        });

        $this->locations["King Zora"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) && ($items->canLiftRocks()
                || ($this->world->config('canFakeFlipper', false)
                    || $items->has('Flippers')) || (
                    ($this->world->config('canBootsClip', false)
                        || $this->world->config('canWaterWalk', false)) &&
                    $items->has('PegasusBoots')) || ($this->world->config('canSuperSpeed', false)
                    && $items->canSpinSpeed()
                    && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items))) ||
                $this->world->config('canOneFrameClipOW', false);
        });

        $this->locations["Potion Shop"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive())
                || $this->world->config('canOneFrameClipOW', false)) &&
                $items->has('Mushroom');
        });

        $this->locations["Zora's Ledge"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) && ($items->has('Flippers')
                    || ($this->world->config('canFakeFlipper', false)
                        && $this->world->config('canWaterWalk', false)
                        && $items->has('PegasusBoots')) || ($this->world->config('canWaterWalk', false)
                        && ($items->has('PegasusBoots')
                            || $items->has('MoonPearl')) && ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoots')) || ($this->world->config('canSuperSpeed', false)
                            && $items->canSpinSpeed()) ||
                        $this->world->config('canOneFrameClipOW', false)));
        });

        $this->locations["Waterfall Fairy - Left"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) && ($this->world->config('canFakeFlipper', false)
                || ($this->world->config('canWaterWalk', false)
                    && ($items->has('PegasusBoots')
                        || $items->has('MoonPearl'))) ||
                $items->has('Flippers')
                || ($this->world->getRegion('East Death Mountain')->canEnter($locations, $items)
                    && (
                        ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoots')) || ($this->world->config('canSuperSpeed', false)
                            && $items->canSpinSpeed()) ||
                        $this->world->config('canOneFrameClipOW', false))));
        });

        $this->locations["Waterfall Fairy - Right"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) && ($this->world->config('canFakeFlipper', false)
                || ($this->world->config('canWaterWalk', false)
                    && ($items->has('PegasusBoots')
                        || $items->has('MoonPearl'))) ||
                $items->has('Flippers')
                || ($this->world->getRegion('East Death Mountain')->canEnter($locations, $items)
                    && (
                        ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoots')) || ($this->world->config('canSuperSpeed', false)
                            && $items->canSpinSpeed()) ||
                        $this->world->config('canOneFrameClipOW', false))));
        });

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

            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) || (     // Invis Ganon fight sounds fun for logic :)
                    $this->world->config('canSuperBunny')
                    && $this->world->config('canDungeonRevive', false) // Just so it's not in logic for everyone. Don't care, just think it's better like this.
                    && $this->world->getRegion('Ganons Tower')->canEnter($locations, $items) //Bunny Beam Storage from GT
                    && $items->has('CaneOfSomaria')
                    && $items->has('MagicMirror')
                    && $items->hasABottle() // Magic should be easily fine, but it's easy to miss when Invisible, even with lamp. FRod when Requires a bunch of Bottles anyway.
                )) && ($items->has('DefeatAgahnim2')
                || $this->world->config('goal') === 'fast_ganon')
                && (!$this->world->config('region.requireBetterBow', false)
                    || $items->canShootArrows($this->world, 2)) && (
                    ($this->world->config('mode.weapons') == 'swordless'
                        && $items->has('Hammer') && ($items->has('Lamp')
                            || ($items->has('FireRod') && ($items->canExtendMagic(1)
                                && $items->has('MoonPearl')) || $items->canExtendMagic(4)))) 
                    || (!$this->world->config('region.requireBetterSword', false)
                        && ($items->hasSword(2)
                            && ($items->has('Lamp')
                                || ($items->has('FireRod')
                                    && ($items->canExtendMagic(3)
                                        && $items->has('MoonPearl')) ||
                                    $items->canExtendMagic(4))))) || ($items->hasSword(3)
                        && ($items->has('Lamp')
                            || ($items->has('FireRod')
                                && ($items->canExtendMagic(2)
                                    && $items->has('MoonPearl')) ||
                                $items->canExtendMagic(3)))));
        });

        $this->can_enter = function ($locations, $items) {
            return
                $items->has('DefeatAgahnim')
                || ($items->has('MoonPearl')
                    && (
                        ($items->has('Hammer')
                            && $items->canLiftRocks()) ||
                        $items->canLiftDarkRocks())) || (
                    // Glitched Access from DeathMountain
                    $this->world->config('canOWYBA', false)
                    && ($items->hasABottle(2)
                        || ($items->hasABottle()
                            && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)))))
                || ($this->world->getRegion('West Death Mountain')->canEnter($locations, $items)
                    && ($items->has('MoonPearl') || $items->has('MagicMirror'))
                    && (
                        ($this->world->config('canSuperSpeed', false)
                            && $items->canSpinSpeed()) || ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoots')))) ||
                $this->world->config('canOneFrameClipOW', false);
        };

        return $this;
    }
}
