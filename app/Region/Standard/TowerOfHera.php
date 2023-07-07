<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Tower of Hera Region and it's Locations contained within
 */
class TowerOfHera extends Region
{
    protected $name = 'Tower Of Hera';
    public $music_addresses = [
        0x155C5,
        0x1107A,
        0x10B8C,
    ];

    protected $map_reveal = 0x0020;

    protected $region_items = [
        'BigKey',
        'BigKeyP3',
        'Compass',
        'CompassP3',
        'Key',
        'KeyP3',
        'Map',
        'MapP3',
        'PendantOfWisdom'
    ];

    /**
     * Create a new Tower of Hera Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        // set a default boss
        $this->boss = Boss::get("Moldorm", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Tower of Hera - Big Key Chest", [0xE9E6], null, $this),
            new Location\Standing\HeraBasement("Tower of Hera - Basement Cage", [0x180162], null, $this),
            new Location\Chest("Tower of Hera - Map Chest", [0xE9AD], null, $this),
            new Location\Chest("Tower of Hera - Compass Chest", [0xE9FB], null, $this),
            new Location\BigChest("Tower of Hera - Big Chest", [0xE9F8], null, $this),
            new Location\Drop("Tower of Hera - Boss", [0x180152], null, $this),

            new Location\Prize\Pendant("Tower of Hera - Prize", [null, 0x120A5, 0x53E78, 0x53E79, 0x18005A, 0x180071, 0xC706], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Tower of Hera - Prize"];
    }

    /**
     * Check if a Boss can be placed in this region.
     * currently Agahnim or Ganon can't be moved.
     *
     * @param Boss $boss boss we are testing
     *
     * @return bool
     */
    public function canPlaceBoss(Boss $boss, string $level = 'top'): bool
    {
        if (
            $this->name != "Ice Palace" && $this->world->config('mode.weapons') == 'swordless'
            && $boss->getName() == 'Kholdstare'
        ) {
            return false;
        }

        return !in_array($boss->getName(), [
            "Agahnim",
            "Agahnim2",
            "Armos Knights",
            "Arrghus",
            "Blind",
            "Ganon",
            "Lanmolas",
            "Trinexx",
        ]);
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
            return (($items->has('PegasusBoots') && $this->world->config('canBootsClip', false))
                || ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed()))
                || $this->world->config('canOneFrameClipOW', false)
                || (($items->has('MagicMirror') || ($items->has('Hookshot') && $items->has('Hammer')))
                    && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items));
        };

        $mire = function ($locations, $items) {
            return $this->world->config('canOneFrameClipUW', false)
                && (($locations->itemInLocations(Item::get('BigKeyD6', $this->world), [
                    "Misery Mire - Compass Chest",
                    "Misery Mire - Big Key Chest",
                ]) && $items->has('KeyD6', 2))
                    || $items->has('KeyD6', 3))
                && $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
        };

        $this->locations["Tower of Hera - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return $items->canLightTorches() && $items->has('KeyP3');
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('KeyP3', $this->world);
        })->setFillRules(function ($item, $locations, $items) {
            return $this->world->config('accessibility') !== 'locations' || $item != Item::get('KeyP3', $this->world);
        });

        $this->locations["Tower of Hera - Compass Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return ($main($locations, $items) && $items->has('BigKeyP3'))
                || $mire($locations, $items);
        });

        $this->locations["Tower of Hera - Big Chest"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return ($main($locations, $items) && $items->has('BigKeyP3'))
                || ($mire($locations, $items) && ($items->has('BigKeyP3') || $items->has('BigKeyD6')));
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Tower of Hera - Boss"]->canAccess($items);
        };

        $this->locations["Tower of Hera - Boss"]->setRequirements(function ($locations, $items) use ($main, $mire) {
            return $main($locations, $items)
                && $this->boss->canBeat($items, $locations)
                && ($items->has('BigKeyP3') || ($mire($locations, $items) && $items->has('BigKeyD6')))
                && (!$this->world->config('region.wildCompasses', false) || $items->has('CompassP3') || $this->locations["Tower of Hera - Boss"]->hasItem(Item::get('CompassP3', $this->world)))
                && (!$this->world->config('region.wildMaps', false) || $items->has('MapP3') || $this->locations["Tower of Hera - Boss"]->hasItem(Item::get('MapP3', $this->world)));
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
                && ($item == Item::get('CompassP3', $this->world) || $item == Item::get('MapP3', $this->world));
        });

        $this->can_enter = function ($locations, $items) use ($main, $mire) {
            return $items->has('RescueZelda')
                && ($main($locations, $items)
                    || $mire($locations, $items));
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
