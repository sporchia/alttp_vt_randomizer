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
        $main = function ($locations, $items) {
            return $items->has('MoonPearl') && $items->has('MagicMirror') && $items->has('Flippers')
                && $this->world->getRegion('South Dark World')->canEnter($locations, $items);
        };

        $mire = function ($locations, $items) {
            return $this->world->config('canOneFrameClipUW', false)
                && $items->has('KeyD6', 3)
                && $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
        };

        $this->locations["Swamp Palace - Entrance"]->setFillRules(function ($item, $locations, $items) {
            return $this->world->config('region.wildKeys', false) || $item == Item::get('KeyD2', $this->world);
        });

        $this->locations["Swamp Palace - Big Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->has('KeyD2') && $items->has('Flippers')
                && ($mire($locations, $items) && ($items->has('BigKeyD6') || $items->has('BigKeyD2') || $items->has('BigKeyP3'))
                    || ($main($locations, $items) && $items->has('Hammer') && $items->has('BigKeyD2')));
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('BigKeyD2', $this->world);
        });

        $this->locations["Swamp Palace - Big Key Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->has('KeyD2')
                && $items->has('Flippers')
                && ($mire($locations, $items)
                    || ($main($locations, $items) && $items->has('Hammer')));
        });

        $this->locations["Swamp Palace - Map Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->canBombThings()
                && (($items->has('KeyD2') && $main($locations, $items))
                    || $mire($locations, $items));
        });

        $this->locations["Swamp Palace - West Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->has('KeyD2')
                && $items->has('Flippers')
                && ($mire($locations, $items)
                    || ($main($locations, $items) && $items->has('Hammer')));
        });

        $this->locations["Swamp Palace - Compass Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->has('KeyD2')
                && $items->has('Flippers')
                && ($mire($locations, $items)
                    || ($main($locations, $items) && $items->has('Hammer')));
        });

        $this->locations["Swamp Palace - Flooded Room - Left"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->has('KeyD2')
                && $items->has('Hookshot')
                && $items->has('Flippers')
                && ($mire($locations, $items)
                    || ($main($locations, $items) && $items->has('Hammer')));
        });

        $this->locations["Swamp Palace - Flooded Room - Right"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->has('KeyD2')
                && $items->has('Hookshot')
                && $items->has('Flippers')
                && ($mire($locations, $items)
                    || ($main($locations, $items) && $items->has('Hammer')));
        });

        $this->locations["Swamp Palace - Waterfall Room"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->has('KeyD2')
                && $items->has('Hookshot')
                && $items->has('Flippers')
                && ($mire($locations, $items)
                    || ($main($locations, $items) && $items->has('Hammer')));
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Swamp Palace - Boss"]->canAccess($items);
        };

        $this->locations["Swamp Palace - Boss"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $items->has('KeyD2')
                && $items->has('Flippers')
                && ($mire($locations, $items) || ($main($locations, $items) && $items->has('Hammer')))
                && $items->has('Hookshot')
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

        $this->can_enter = function ($locations, $items) use ($main, $mire) {
            return $items->has('RescueZelda')
                && ($this->world->config('itemPlacement') !== 'basic'
                    || (($this->world->config('mode.weapons') === 'swordless' || $items->hasSword()) && $items->hasHealth(7) && $items->hasBottle()))
                && ($main($locations, $items)
                    || $mire($locations, $items));
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
