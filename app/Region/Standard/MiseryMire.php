<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Misery Mire Region and it's Locations contained within
 */
class MiseryMire extends Region
{
    protected $name = 'Misery Mire';
    public $music_addresses = [
        0x155B9,
    ];

    protected $map_reveal = 0x0100;

    protected $region_items = [
        'BigKey',
        'BigKeyD6',
        'Compass',
        'CompassD6',
        'Key',
        'KeyD6',
        'Map',
        'MapD6',
    ];

    /**
     * Create a new Misery Mire Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Vitreous", $world);

        $this->locations = new LocationCollection([
            new Location\BigChest("Misery Mire - Big Chest", [0xEA67], null, $this),
            new Location\Chest("Misery Mire - Main Lobby", [0xEA5E], null, $this),
            new Location\Chest("Misery Mire - Big Key Chest", [0xEA6D], null, $this),
            new Location\Chest("Misery Mire - Compass Chest", [0xEA64], null, $this),
            new Location\Chest("Misery Mire - Bridge Chest", [0xEA61], null, $this),
            new Location\Chest("Misery Mire - Map Chest", [0xEA6A], null, $this),
            new Location\Chest("Misery Mire - Spike Chest", [0xE9DA], null, $this),
            new Location\Drop("Misery Mire - Boss", [0x180158], null, $this),

            new Location\Prize\Crystal("Misery Mire - Prize", [null, 0x120A2, 0x53F48, 0x53F49, 0x180057, 0x180075, 0xC703], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Misery Mire - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Misery Mire - Big Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('BigKeyD6');
        });

        $this->locations["Misery Mire - Spike Chest"]->setRequirements(function ($locations, $items) {
            return !$this->world->config('region.cantTakeDamage', false)
                || $items->has('CaneOfByrna') || $items->has('Cape');
        });

        $this->locations["Misery Mire - Main Lobby"]->setRequirements(function ($locations, $items) {
            return $items->has('KeyD6') || $items->has('BigKeyD6');
        });

        $this->locations["Misery Mire - Map Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('KeyD6') || $items->has('BigKeyD6');
        });

        $this->locations["Misery Mire - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return $items->canLightTorches()
                && (($locations["Misery Mire - Compass Chest"]->hasItem(Item::get('BigKeyD6', $this->world)) && $items->has('KeyD6', 2))
                    || $items->has('KeyD6', 3));
        });

        $this->locations["Misery Mire - Compass Chest"]->setRequirements(function ($locations, $items) {
            return $items->canLightTorches()
                && (($locations["Misery Mire - Big Key Chest"]->hasItem(Item::get('BigKeyD6', $this->world)) && $items->has('KeyD6', 2))
                    || $items->has('KeyD6', 3));
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Misery Mire - Boss"]->canAccess($items);
        };

        $this->locations["Misery Mire - Boss"]->setRequirements(function ($locations, $items) {
            return $this->canEnter($locations, $items)
                && $items->has('CaneOfSomaria') && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))
                && $items->has('BigKeyD6')
                && $this->boss->canBeat($items, $locations)
                && (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD6') || $this->locations["Misery Mire - Boss"]->hasItem(Item::get('CompassD6', $this->world)))
                && (!$this->world->config('region.wildMaps', false) || $items->has('MapD6') || $this->locations["Misery Mire - Boss"]->hasItem(Item::get('MapD6', $this->world)));
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
                && ($item == Item::get('CompassD6', $this->world) || $item == Item::get('MapD6', $this->world));
        });

        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && ($this->world->config('itemPlacement') !== 'basic'
                    || (($this->world->config('mode.weapons') === 'swordless' || $items->hasSword(2)) && $items->hasHealth(12) && ($items->hasBottle(2) || $items->hasArmor())))
                && ((($locations["Misery Mire Medallion"]->hasItem(Item::get('Bombos', $this->world)) && $items->has('Bombos'))
                    || ($locations["Misery Mire Medallion"]->hasItem(Item::get('Ether', $this->world)) && $items->has('Ether'))
                    || ($locations["Misery Mire Medallion"]->hasItem(Item::get('Quake', $this->world)) && $items->has('Quake')))
                    && ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword()))
                && ($items->has('MoonPearl')
                    || ($items->hasABottle()
                        && (($items->has('BugCatchingNet') && $this->world->config('canBunnyRevive', false)
                            && (($items->canLiftDarkRocks() && ($items->canFly($this->world) ||
                                ($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))))
                                 || ($this->world->config('canOWYBA', false) && $items->has('MagicMirror'))
                                 || $this->world->config('canOneFrameClipOW', false))) 
                            || ($this->world->config('canOWYBA', false)
                                && (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')) 
                                    || $this->world->config('canOneFrameClipOW', false)
                                    || $items->hasBottle(2))))))
                && (($this->world->config('itemPlacement') !== 'basic' && $items->has('PegasusBoots'))
                    || $items->has('Hookshot'))
                && $items->canKillMostThings(8)
                && $this->world->getRegion('Mire')->canEnter($locations, $items);
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
