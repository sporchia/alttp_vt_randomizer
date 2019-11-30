<?php

namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Region;

/**
 * Ganons Tower Region and it's Locations contained within
 */
class GanonsTower extends Region\Standard\GanonsTower
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        parent::initalize();

        $this->locations["Ganon's Tower - DMs Room - Top Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - DMs Room - Top Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - DMs Room - Bottom Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - DMs Room - Bottom Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Randomizer Room - Top Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && (
                    ($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Randomizer Room - Top Right",
                        "Ganon's Tower - Randomizer Room - Bottom Left",
                        "Ganon's Tower - Randomizer Room - Bottom Right",
                    ])
                        && $items->has('KeyA2', 3)) ||
                    $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                    || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Randomizer Room - Top Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && (
                    ($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Randomizer Room - Top Left",
                        "Ganon's Tower - Randomizer Room - Bottom Left",
                        "Ganon's Tower - Randomizer Room - Bottom Right",
                    ])
                        && $items->has('KeyA2', 3)) ||
                    $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                    || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Randomizer Room - Bottom Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && (
                    ($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Randomizer Room - Top Right",
                        "Ganon's Tower - Randomizer Room - Top Left",
                        "Ganon's Tower - Randomizer Room - Bottom Right",
                    ])
                        && $items->has('KeyA2', 3)) ||
                    $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                    || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Randomizer Room - Bottom Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && (
                    ($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Randomizer Room - Top Right",
                        "Ganon's Tower - Randomizer Room - Top Left",
                        "Ganon's Tower - Randomizer Room - Bottom Left",
                    ])
                        && $items->has('KeyA2', 3)) ||
                    $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                    || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Firesnake Room"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && $items->has('Hookshot')
                && (
                    (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Randomizer Room - Top Right",
                        "Ganon's Tower - Randomizer Room - Top Left",
                        "Ganon's Tower - Randomizer Room - Bottom Left",
                        "Ganon's Tower - Randomizer Room - Bottom Right",
                    ])
                        ||
                        $locations["Ganon's Tower - Firesnake Room"]->hasItem(Item::get('KeyA2', $this->world))) &&
                        $items->has('KeyA2', 2)) || $items->has('KeyA2', 3)) && ($items->has('MoonPearl')
                        || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Map Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer')
                && ($items->has('Hookshot')
                    || ($this->world->config('itemPlacement') !== 'basic'
                        && $items->has('PegasusBoots'))) && (in_array(
                    $locations["Ganon's Tower - Map Chest"]->getItem(),
                    [
                        Item::get('BigKeyA2', $this->world),
                        Item::get('KeyA2', $this->world)
                    ]
                )
                    ? $items->has('KeyA2', 3) : $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                    || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations'
                && $item == Item::get('KeyA2', $this->world)
                && $items->has('KeyA2', 3);
        })->setFillRules(function ($item, $locations, $items) {
            return $this->world->config('accessibility') !== 'locations'
                || $item != Item::get('KeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Big Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('BigKeyA2')
                && $items->has('KeyA2', 3)
                && (
                    ($items->has('Hammer')
                        && $items->has('Hookshot')) || ($items->has('FireRod')
                        && $items->has('CaneOfSomaria'))) && ($items->has('MoonPearl')
                    || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Bob's Chest"]->setRequirements(function ($locations, $items) {
            return (($items->has('Hammer')
                && $items->has('Hookshot')) || ($items->has('FireRod')
                && $items->has('CaneOfSomaria'))) && $items->has('KeyA2', 3)
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Tile Room"]->setRequirements(function ($locations, $items) {
            return $items->has('CaneOfSomaria')
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Compass Room - Top Left"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod')
                && $items->has('CaneOfSomaria')
                && (
                    ($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Compass Room - Top Right",
                        "Ganon's Tower - Compass Room - Bottom Left",
                        "Ganon's Tower - Compass Room - Bottom Right",
                    ])
                        && $items->has('KeyA2', 3)) ||
                    $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                        || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Compass Room - Top Right"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod')
                && $items->has('CaneOfSomaria')
                && (
                    ($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Compass Room - Top Left",
                        "Ganon's Tower - Compass Room - Bottom Left",
                        "Ganon's Tower - Compass Room - Bottom Right",
                    ])
                        && $items->has('KeyA2', 3)) ||
                    $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                        || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Compass Room - Bottom Left"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod')
                && $items->has('CaneOfSomaria')
                && (
                    ($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Compass Room - Top Right",
                        "Ganon's Tower - Compass Room - Top Left",
                        "Ganon's Tower - Compass Room - Bottom Right",
                    ]) && $items->has('KeyA2', 3)) || $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                        || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Compass Room - Bottom Right"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod')
                && $items->has('CaneOfSomaria')
                && (
                    ($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                        "Ganon's Tower - Compass Room - Top Right",
                        "Ganon's Tower - Compass Room - Top Left",
                        "Ganon's Tower - Compass Room - Bottom Left",
                    ]) && $items->has('KeyA2', 3)) ||
                    $items->has('KeyA2', 4)) && ($items->has('MoonPearl')
                        || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return (($items->has('Hammer')
                && $items->has('Hookshot')) || ($items->has('FireRod')
                && $items->has('CaneOfSomaria'))) && $items->has('KeyA2', 3)
                && $this->boss_bottom->canBeat($items, $locations)
                && ($items->has('MoonPearl')
                    || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Big Key Room - Left"]->setRequirements(function ($locations, $items) {
            return (($items->has('Hammer')
                && $items->has('Hookshot')) || ($items->has('FireRod')
                && $items->has('CaneOfSomaria'))) && $items->has('KeyA2', 3)
                && $this->boss_bottom->canBeat($items, $locations)
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Big Key Room - Right"]->setRequirements(function ($locations, $items) {
            return (($items->has('Hammer')
                && $items->has('Hookshot')) || ($items->has('FireRod')
                && $items->has('CaneOfSomaria'))) && $items->has('KeyA2', 3)
                && $this->boss_bottom->canBeat($items, $locations)
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        });

        $this->locations["Ganon's Tower - Mini Helmasaur Room - Left"]->setRequirements(function ($locations, $items) {
            return $items->canShootArrows($this->world)
                && $items->canLightTorches()
                && $items->has('BigKeyA2')
                && $items->has('KeyA2', 3)
                && $this->boss_middle->canBeat($items, $locations)
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Mini Helmasaur Room - Right"]->setRequirements(function ($locations, $items) {
            return $items->canShootArrows($this->world)
                && $items->canLightTorches()
                && $items->has('BigKeyA2')
                && $items->has('KeyA2', 3)
                && $this->boss_middle->canBeat($items, $locations)
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Pre-Moldorm Chest"]->setRequirements(function ($locations, $items) {
            return $items->canShootArrows($this->world)
                && $items->canLightTorches()
                && $items->has('BigKeyA2')
                && $items->has('KeyA2', 3)
                && $this->boss_middle->canBeat($items, $locations)
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Moldorm Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('Hookshot')
                && $items->canShootArrows($this->world)
                && $items->canLightTorches()
                && $items->has('BigKeyA2')
                && $items->has('KeyA2', 4)
                && $this->boss_middle->canBeat($items, $locations)
                && $this->boss_top->canBeat($items, $locations)
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive')
                    || (
                        ($this->world->config('canOneFrameClipOW', false)
                            || ($this->world->config('canBootsClip', false)
                                && $items->has('PegasusBoots'))) && (
                            ($this->world->config('canBunnyRevive', false)
                                && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                                && $items->hasABottle()))));
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('KeyA2', $this->world)
                && $item != Item::get('BigKeyA2', $this->world);
        });

        $this->can_complete = function ($locations, $items) {
            return $this->canEnter($locations, $items)
                && $this->locations["Ganon's Tower - Moldorm Chest"]->canAccess($items)
                && $this->boss->canBeat($items, $locations);
        };

        $this->prize_location->setRequirements($this->can_complete);

        $this->can_enter = function ($locations, $items) {
            return ($this->world->config('itemPlacement') !== 'basic'
                || (
                    ($this->world->config('mode.weapons') === 'swordless'
                        || $items->hasSword(2))
                    && $items->hasHealth(12)
                    && ($items->hasBottle(2)
                        || $items->hasArmor()))) && ($this->world->config('canDungeonRevive', false)
                || ($this->world->config('canSuperBunny', false)
                    && $items->has('MagicMirror')) ||
                $items->has('MoonPearl')
                || (
                    ($this->world->config('canOneFrameClipOW', false)
                        || ($this->world->config('canBootsClip', false)
                            && $items->has('PegasusBoots'))) && (
                        ($this->world->config('canBunnyRevive', false)
                            && $items->canBunnyRevive()) || ($this->world->config('canOWYBA', false)
                            && $items->hasABottle())))) && ($items->has('Crystal1')
                + $items->has('Crystal2')
                + $items->has('Crystal3')
                + $items->has('Crystal4')
                + $items->has('Crystal5')
                + $items->has('Crystal6')
                + $items->has('Crystal7'))    >= $this->world->config('crystals.tower', 7)
                && $this->world->getRegion('North East Light World')->canEnter($locations, $items);
        };

        return $this;
    }
}
