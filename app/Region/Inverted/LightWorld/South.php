<?php

namespace ALttP\Region\Inverted\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\World;

/**
 * South Light World Region and it's Locations contained within
 */
class South extends Region\Standard\LightWorld\South
{
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

        $this->locations->removeItem("Link's House");
        $this->locations->addItem(new Location\Prize\Event("Bomb Merchant", [], null, $this));

        $this->locations["Bomb Merchant"]->setItem(Item::get('BigRedBomb', $world));
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->shops["20 Rupee Cave"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canLiftRocks();
        });

        $this->shops["50 Rupee Cave"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canLiftRocks();
        });

        $this->shops["Bonk Fairy (Light)"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->has('PegasusBoots');
        });

        $this->shops["Light Hype Fairy"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canBombThings();
        });

        $this->shops["Capacity Upgrade"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) && (
                ($this->world->config('canFakeFlipper', false)
                    || $items->has('Flippers')) || ($this->world->config('canWaterWalk', false)
                    && $items->has('PegasusBoots'))) || ($this->world->config('canBunnyRevive', false)
                && $items->canBunnyRevive());
        });

        $this->locations["Floodgate Chest"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canSuperBunny', false)
                    && $items->has('MagicMirror')) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()));
        });

        $this->locations["Bomb Merchant"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || $this->world->config('canSuperBunny', false)) &&
                $items->has('Crystal5') && $items->has('Crystal6');
        });

        $this->locations["Aginah's Cave"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive())) &&
                $items->canBombThings();
        });

        $this->locations["Mini Moldorm Cave - Far Left"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canBombThings() && $items->canKillMostThings($this->world);
        });

        $this->locations["Mini Moldorm Cave - Left"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canBombThings() && $items->canKillMostThings($this->world);
        });

        $this->locations["Mini Moldorm Cave - Right"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canBombThings() && $items->canKillMostThings($this->world);
        });

        $this->locations["Mini Moldorm Cave - Far Right"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canBombThings() && $items->canKillMostThings($this->world);
        });

        $this->locations["Ice Rod Cave"]->setRequirements(function ($locations, $items) {
            return (($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canBombThings()) || ($items->has('BigRedBomb')
                && $this->world->config('canSuperBunny', false)
                && $items->has('MagicMirror'));
        });

        $this->locations["Hobo"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) && (
                ($this->world->config('canFakeFlipper', false)
                    || $items->has('Flippers')) || ($this->world->config('canWaterWalk', false)
                    && $items->has('PegasusBoots')));
        });

        $this->locations["Bombos Tablet"]->setRequirements(function ($locations, $items) {
            return $items->has('BookOfMudora')
                && ($items->hasSword(2)
                    || ($this->world->config('mode.weapons') == 'swordless'
                        && $items->has('Hammer')));
        });

        $this->locations["Cave 45"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canSuperBunny', false)
                    && $items->has('MagicMirror')) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive());
        });

        $this->locations["Checkerboard Cave"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()))
                && $items->canLiftRocks();
        });

        $this->locations["Mini Moldorm Cave - NPC"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) &&
                $items->canBombThings() && $items->canKillMostThings($this->world);
        });

        $this->locations["Library"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) || ($this->world->config('canSuperBunny', false)
                    && $items->has('MagicMirror'))) 
                && $items->has('PegasusBoots');
        });

        $this->locations["Maze Race"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                && ($items->has('PegasusBoots')
                    || $items->canBombThings())) ||
                $this->world->config('canOneFrameClipOW', false);
        });

        $this->locations["Desert Ledge"]->setRequirements(function ($locations, $items) {
            return (($items->has('MoonPearl')
                || $this->world->config('canDungeonRevive', false) || ($this->world->config('canSuperBunny', false)
                    && $items->has('MagicMirror')) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) && $this->world->getRegion('Desert Palace')->canEnter($locations, $items))
                ||
                $this->world->config('canOneFrameClipOW', false)
                || ($this->world->config('canBootsClip', false)
                    && $items->has('PegasusBoots'));
        });

        $this->locations["Lake Hylia Island"]->setRequirements(function ($locations, $items) {
            return (($items->has('MoonPearl')
                || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle())) && ($items->has('Flippers')
                    || ($this->world->config('canBootsClip', false)
                        && $items->has('PegasusBoots')) || ($this->world->config('canSuperSpeed', false)
                        && $items->canSpinSpeed()))) 
                || $this->world->config('canOneFrameClipOW', false);
        });

        $this->locations["Sunken Treasure"]->setRequirements(function ($locations, $items) {
            return $items->has('MoonPearl')
                || ($this->world->config('canSuperBunny', false)
                    && $items->has('MagicMirror')) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle());
        });

        $this->locations["Flute Spot"]->setRequirements(function ($locations, $items) {
            return ($items->has('MoonPearl')
                || ($this->world->config('canOWYBA', false)
                    && $items->hasABottle()) || ($this->world->config('canBunnyRevive', false)
                    && $items->canBunnyRevive())) && $items->has('Shovel');
        });

        $this->can_enter = function ($locations, $items) {
            return $this->world->getRegion('North East Light World')->canEnter($locations, $items);
        };

        return $this;
    }
}
