<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Swamp Palace Region and it's Locations contained within
 */
class SwampPalace extends Region
{
    protected $name = 'Swamp Palace';
    public $music_addresses = [
        0x155B7,
    ];

    protected $map_reveal = 0x0400;

    protected $region_items = [
        'BigKey',
        'BigKeyD2',
        'Compass',
        'CompassD2',
        'Key',
        'KeyD2',
        'Map',
        'MapD2',
    ];

    /**
     * Create a new Swamp Palace Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Arrghus", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Swamp Palace - Entrance", [0xEA9D], null, $this),
            new Location\BigChest("Swamp Palace - Big Chest", [0xE989], null, $this),
            new Location\Chest("Swamp Palace - Big Key Chest", [0xEAA6], null, $this),
            new Location\Chest("Swamp Palace - Map Chest", [0xE986], null, $this),
            new Location\Chest("Swamp Palace - West Chest", [0xEAA3], null, $this),
            new Location\Chest("Swamp Palace - Compass Chest", [0xEAA0], null, $this),
            new Location\Chest("Swamp Palace - Flooded Room - Left", [0xEAA9], null, $this),
            new Location\Chest("Swamp Palace - Flooded Room - Right", [0xEAAC], null, $this),
            new Location\Chest("Swamp Palace - Waterfall Room", [0xEAAF], null, $this),
            new Location\Drop("Swamp Palace - Boss", [0x180154], null, $this),

            new Location\Prize\Crystal("Swamp Palace - Prize", [null, 0x120A0, 0x53F6C, 0x53F6D, 0x180055, 0x180071, 0xC701], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Swamp Palace - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $mire = function ($locations, $items) {
            return $this->world->config('canOneFrameClipUW', false)
                && (($locations->itemInLocations(Item::get('BigKeyD6', $this->world), [
                    "Misery Mire - Compass Chest",
                    "Misery Mire - Big Key Chest",
                ])
                    && $items->has('KeyD6', 2))
                    || $items->has('KeyD6', 3))
                && $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
        };

        $hera = function ($locations, $items) {
            return $this->world->config('canOneFrameClipUW', false)
                && $this->world->getRegion('Tower of Hera')->canEnter($locations, $items)
                && $items->has('BigKeyP3');
        };

        $this->locations["Swamp Palace - Entrance"]->setFillRules(function ($item, $locations, $items) use ($mire) {
            return $this->world->config('region.wildKeys', false) || $item == Item::get('KeyD2', $this->world)
                || $mire($locations, $items);
        });

        $this->locations["Swamp Palace - Big Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer')
                    || $mire($locations, $items) || $hera($locations, $items))
                && ($items->has('BigKeyD2')
                    || ($mire($locations, $items) && $items->has('BigKeyD6'))
                    || ($hera($locations, $items) && $items->has('BigKeyP3')));
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('BigKeyD2', $this->world);
        })->setFillRules(function ($item, $locations, $items) {
            return $this->world->config('accessibility') !== 'locations' || $item != Item::get('BigKeyD2', $this->world);
        });

        $this->locations["Swamp Palace - Big Key Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer')
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Map Chest"]->setRequirements(function ($locations, $items) use ($mire) {
            return $items->canBombThings()
                && ($items->has('KeyD2') || $mire($locations, $items));
        });

        $this->locations["Swamp Palace - West Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer')
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Compass Chest"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer')
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Flooded Room - Left"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->has('Hookshot')
                && ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer')
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Flooded Room - Right"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->has('Hookshot')
                && ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer')
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->locations["Swamp Palace - Waterfall Room"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->has('Hookshot')
                && ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer')
                    || $mire($locations, $items) || $hera($locations, $items));
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Swamp Palace - Boss"]->canAccess($items);
        };

        $this->locations["Swamp Palace - Boss"]->setRequirements(function ($locations, $items) use ($mire, $hera) {
            return $items->has('Hookshot')
                && ($items->has('KeyD2') || $mire($locations, $items))
                && ($items->has('Hammer')
                    || $mire($locations, $items) || $hera($locations, $items))
                && $this->boss->canBeat($items, $locations)
                && (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD2') || $this->locations["Swamp Palace - Boss"]->hasItem(Item::get('CompassD2', $this->world)))
                && (!$this->world->config('region.wildMaps', false) || $items->has('MapD2') || $this->locations["Swamp Palace - Boss"]->hasItem(Item::get('MapD2', $this->world)));
        })->setFillRules(function ($item, $locations, $items) {
            if (
                !$this->world->config('region.bossNormalLocation', true)
                && ($item instanceof Item\Key || $item instanceof Item\BigKey
                    || $item instanceof Item\Map || $item instanceof Item\Compass)
            ) {
                return false;
            }

            return true;
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('region.bossNormalLocation', true)
                && ($item == Item::get('CompassD2', $this->world) || $item == Item::get('MapD2', $this->world));
        });

        $this->can_enter = function ($locations, $items) use ($mire) {
            return $items->has('RescueZelda')
                && ($this->world->config('itemPlacement') !== 'basic'
                    || (($this->world->config('mode.weapons') === 'swordless' || $items->hasSword()) && $items->hasHealth(7) && $items->hasABottle()))
                && $items->has('Flippers')
                && $this->world->getRegion('South Dark World')->canEnter($locations, $items)
                && (($items->has('MoonPearl')
                    && $items->has('MagicMirror'))
                    || ($this->world->config('canOneFrameClipUW', false)
                        && ($items->has('BigKeyP3') || $items->has('BigKeyD6')) && $mire($locations, $items)
                        && $locations["Old Man"]->canAccess($items)
                        && (($items->has('PegasusBoots')
                            && $this->world->config('canBootsClip', false))
                            || ($this->world->config('canSuperSpeed', false)
                                && $items->canSpinSpeed())
                            || $this->world->config('canOneFrameClipOW', false))));
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
