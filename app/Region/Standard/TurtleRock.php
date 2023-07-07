<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Turtle Rock Region and it's Locations contained within
 */
class TurtleRock extends Region
{
    protected $name = 'Turtle Rock';
    public $music_addresses = [
        0x155C7,
        0x155A7,
        0x155AA,
        0x155AB,
    ];

    protected $map_reveal = 0x0008;

    protected $region_items = [
        'BigKey',
        'BigKeyD7',
        'Compass',
        'CompassD7',
        'Key',
        'KeyD7',
        'Map',
        'MapD7',
        'Crystal7'
    ];

    /**
     * Consider using this as a way of filling all items at once. set to 0 for
     * keysanity.
     * @todo remove this if we don't plan on using it
     */
    protected $dungeon_item_count = 7;

    /**
     * Create a new Turtle Rock Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Trinexx", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Turtle Rock - Chain Chomps", [0xEA16], null, $this),
            new Location\Chest("Turtle Rock - Compass Chest", [0xEA22], null, $this),
            new Location\Chest("Turtle Rock - Roller Room - Left", [0xEA1C], null, $this),
            new Location\Chest("Turtle Rock - Roller Room - Right", [0xEA1F], null, $this),
            new Location\BigChest("Turtle Rock - Big Chest", [0xEA19], null, $this),
            new Location\Chest("Turtle Rock - Big Key Chest", [0xEA25], null, $this),
            new Location\Chest("Turtle Rock - Crystaroller Room", [0xEA34], null, $this),
            new Location\Chest("Turtle Rock - Eye Bridge - Bottom Left", [0xEA31], null, $this),
            new Location\Chest("Turtle Rock - Eye Bridge - Bottom Right", [0xEA2E], null, $this),
            new Location\Chest("Turtle Rock - Eye Bridge - Top Left", [0xEA2B], null, $this),
            new Location\Chest("Turtle Rock - Eye Bridge - Top Right", [0xEA28], null, $this),
            new Location\Drop("Turtle Rock - Boss", [0x180159], null, $this),

            new Location\Prize\Crystal("Turtle Rock - Prize", [null, 0x120A7, 0x53E80, 0x53E81, 0x18005C, 0x180075, 0xC708], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Turtle Rock - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $upper = function ($locations, $items) {
            return (($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos', $this->world)) && $items->has('Bombos'))
                || ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether', $this->world)) && $items->has('Ether'))
                || ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake', $this->world)) && $items->has('Quake')))
                && ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword())
                && ($items->has('MoonPearl')
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle()
                        && (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                            || $this->world->config('canOneFrameClipOW', false))))
                && $items->has('CaneOfSomaria')
                && (($items->has('Hammer') && $items->canLiftDarkRocks()
                    && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items))
                    || (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                        || $this->world->config('canOneFrameClipOW', false)));
        };

        $middle = function ($locations, $items) {
            return ((($this->world->config('canMirrorClip', false) && $items->has('MagicMirror'))
                && ($items->has('MoonPearl') || $this->world->config('canDungeonRevive', false)))
                || (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                    && (($this->world->config('canOWYBA', false) && $items->hasABottle()) || $items->has('MoonPearl')))
                || ($this->world->config('canSuperSpeed', false) && $items->has('MoonPearl') && $items->canSpinSpeed())
                || ($this->world->config('canOneFrameClipOW', false) && ($this->world->config('canDungeonRevive', false)
                    || $items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))))
                && ($items->has('PegasusBoots') || $items->has('CaneOfSomaria') || $items->has('Hookshot')
                    || !$this->world->config('region.cantTakeDamage', false)
                    || $items->has('Cape') || $items->has('CaneOfByrna'))
                && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items);
        };

        $lower = function ($locations, $items) {
            return $this->world->config('canMirrorWrap', false) && $items->has('MagicMirror')
                && ($items->has('MoonPearl')
                    || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                && (((($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')) || $this->world->config('canOneFrameClipOW', false))
                    && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items))
                    || (($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                        && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items)));
        };

        $this->locations["Turtle Rock - Chain Chomps"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return ($upper($locations, $items) && $items->has('KeyD7'))
                || $middle($locations, $items)
                || ($lower($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria'));
        });

        $this->locations["Turtle Rock - Roller Room - Left"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return $items->has('FireRod') && $items->has('CaneOfSomaria')
                && ($upper($locations, $items)
                    || ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7', $this->world), [
                        "Turtle Rock - Roller Room - Right",
                        "Turtle Rock - Compass Chest",
                    ]) && $items->has('KeyD7', 2))
                        || $items->has('KeyD7', 4)))
                    || ($lower($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyD7', 4)));
        });

        $this->locations["Turtle Rock - Roller Room - Right"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return $items->has('FireRod') && $items->has('CaneOfSomaria')
                && ($upper($locations, $items)
                    || ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7', $this->world), [
                        "Turtle Rock - Roller Room - Left",
                        "Turtle Rock - Compass Chest",
                    ]) && $items->has('KeyD7', 2))
                        || $items->has('KeyD7', 4)))
                    || ($lower($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyD7', 4)));
        });

        $this->locations["Turtle Rock - Compass Chest"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return $items->has('CaneOfSomaria')
                && ($upper($locations, $items)
                    || ($middle($locations, $items) && (($locations->itemInLocations(Item::get('BigKeyD7', $this->world), [
                        "Turtle Rock - Roller Room - Left",
                        "Turtle Rock - Roller Room - Right",
                    ]) && $items->has('KeyD7', 2))
                        || $items->has('KeyD7', 4)))
                    || ($lower($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyD7', 4)));
        });

        $this->locations["Turtle Rock - Big Chest"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return $items->has('BigKeyD7')
                && (($upper($locations, $items) && $items->has('KeyD7', 2))
                    || ($middle($locations, $items) && ($items->has('Hookshot') || $items->has('CaneOfSomaria')))
                    || ($lower($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria')));
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyD7', $this->world);
        });

        $this->locations["Turtle Rock - Big Key Chest"]->setRequirements(function ($locations, $items) {
            if (!$locations["Turtle Rock - Big Key Chest"]->hasItem(Item::get('BigKeyD7', $this->world)) && $this->world->config('region.wildKeys', false)) {
                return $locations["Turtle Rock - Big Key Chest"]->hasItem(Item::get('KeyD7', $this->world)) ? $items->has('KeyD7', 3) : $items->has('KeyD7', 4);
            }
            return $items->has('KeyD7', 2);
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('KeyD7', $this->world) && $items->has('KeyD7', 3);
        })->setFillRules(function ($item, $locations, $items) {
            return $this->world->config('accessibility') !== 'locations' || $item != Item::get('KeyD7', $this->world);
        });

        $this->locations["Turtle Rock - Crystaroller Room"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return ($items->has('BigKeyD7') && (($upper($locations, $items) && $items->has('KeyD7', 2))
                    || $middle($locations, $items)))
                || ($lower($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria'));
        });

        $this->locations["Turtle Rock - Eye Bridge - Bottom Left"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return ($lower($locations, $items)
                || (($upper($locations, $items) || $middle($locations, $items)) &&
                    $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
                && ($this->world->config('itemPlacement') !== 'basic' || $items->has('Cape') || $items->has('CaneOfByrna')
                    || ($this->world->config('item.overflow.count.Shield', 3) >= 3 && $items->canBlockLasers()));
        });

        $this->locations["Turtle Rock - Eye Bridge - Bottom Right"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return ($lower($locations, $items)
                || (($upper($locations, $items) || $middle($locations, $items)) &&
                    $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
                && ($this->world->config('itemPlacement') !== 'basic' || $items->has('Cape') || $items->has('CaneOfByrna')
                    || ($this->world->config('item.overflow.count.Shield', 3) >= 3 && $items->canBlockLasers()));
        });

        $this->locations["Turtle Rock - Eye Bridge - Top Left"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return ($lower($locations, $items)
                || (($upper($locations, $items) || $middle($locations, $items)) &&
                    $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
                && ($this->world->config('itemPlacement') !== 'basic' || $items->has('Cape') || $items->has('CaneOfByrna')
                    || ($this->world->config('item.overflow.count.Shield', 3) >= 3 && $items->canBlockLasers()));
        });

        $this->locations["Turtle Rock - Eye Bridge - Top Right"]->setRequirements(function ($locations, $items) use ($upper, $middle, $lower) {
            return ($lower($locations, $items)
                || (($upper($locations, $items) || $middle($locations, $items)) &&
                    $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria') && $items->has('BigKeyD7') && $items->has('KeyD7', 3)))
                && ($this->world->config('itemPlacement') !== 'basic' || $items->has('Cape') || $items->has('CaneOfByrna')
                    || ($this->world->config('item.overflow.count.Shield', 3) >= 3 && $items->canBlockLasers()));
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Turtle Rock - Boss"]->canAccess($items);
        };

        $this->locations["Turtle Rock - Boss"]->setRequirements(function ($locations, $items) {
            return $this->canEnter($locations, $items)
                && $items->has('KeyD7', 4)
                && (($this->world->config('canMirrorWrap', false) && $items->has('MagicMirror')
                    && ($items->has('MoonPearl')
                        || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                    && (((($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')) || $this->world->config('canOneFrameClipOW', false))
                        && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items))
                        || (($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed())
                            && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items))))
                    || $items->has('Lamp', $this->world->config('item.require.Lamp', 1)))
                && $items->has('BigKeyD7') && $items->has('CaneOfSomaria')
                && $this->boss->canBeat($items, $locations)
                && (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD7') || $this->locations["Turtle Rock - Boss"]->hasItem(Item::get('CompassD7', $this->world)))
                && (!$this->world->config('region.wildMaps', false) || $items->has('MapD7') || $this->locations["Turtle Rock - Boss"]->hasItem(Item::get('MapD7', $this->world)));
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
                && ($item == Item::get('CompassD7', $this->world) || $item == Item::get('MapD7', $this->world));
        });

        $this->can_enter = function ($locations, $items) use ($lower, $middle, $upper) {
            return $items->has('RescueZelda')
                && ($this->world->config('itemPlacement') !== 'basic'
                    || (($this->world->config('mode.weapons') === 'swordless' || $items->hasSword(2)) && $items->hasHealth(12) && ($items->hasBottle(2) || $items->hasArmor())))
                && ($lower($locations, $items)
                    || $middle($locations, $items)
                    || $upper($locations, $items));
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
