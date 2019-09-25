<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Thieves Town Region and it's Locations contained within
 */
class ThievesTown extends Region
{
    protected $name = 'Thieves Town';
    public $music_addresses = [
        0x155C6,
    ];

    protected $map_reveal = 0x0010;

    protected $region_items = [
        'BigKey',
        'BigKeyD4',
        'Compass',
        'CompassD4',
        'Key',
        'KeyD4',
        'Map',
        'MapD4',
    ];

    /**
     * Create a new Thieves Town Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Blind", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Thieves' Town - Attic", [0xEA0D], null, $this),
            new Location\Chest("Thieves' Town - Big Key Chest", [0xEA04], null, $this),
            new Location\Chest("Thieves' Town - Map Chest", [0xEA01], null, $this),
            new Location\Chest("Thieves' Town - Compass Chest", [0xEA07], null, $this),
            new Location\Chest("Thieves' Town - Ambush Chest", [0xEA0A], null, $this),
            new Location\BigChest("Thieves' Town - Big Chest", [0xEA10], null, $this),
            new Location\Chest("Thieves' Town - Blind's Cell", [0xEA13], null, $this),
            new Location\Drop("Thieves' Town - Boss", [0x180156], null, $this),

            new Location\Prize\Crystal("Thieves' Town - Prize", [null, 0x120A6, 0x53F36, 0x53F37, 0x18005B, 0x180077, 0xC707], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Thieves' Town - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Thieves' Town - Attic"]->setRequirements(function ($locations, $items) {
            return $items->has('KeyD4') && $items->has('BigKeyD4');
        });

        $this->locations["Thieves' Town - Big Chest"]->setRequirements(function ($locations, $items) {
            if ($locations["Thieves' Town - Big Chest"]->hasItem(Item::get('KeyD4', $this->world))) {
                return $items->has('Hammer') && $items->has('BigKeyD4')
                    && $this->world->config('accessibility') !== 'locations';
            }

            return $items->has('Hammer') && $items->has('KeyD4') && $items->has('BigKeyD4');
        })->setAlwaysAllow(function ($item, $items) {
            logger()->error(json_encode([
                $this->world->config('accessibility'),
                $item->getName(),
                $this->world->config('accessibility') !== 'locations' && $item == Item::get('KeyD4', $this->world) && $items->has('Hammer'),
            ]));
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('KeyD4', $this->world) && $items->has('Hammer');
        });

        $this->locations["Thieves' Town - Blind's Cell"]->setRequirements(function ($locations, $items) {
            return $items->has('BigKeyD4');
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Thieves' Town - Boss"]->canAccess($items);
        };

        $this->locations["Thieves' Town - Boss"]->setRequirements(function ($locations, $items) {
            return $this->canEnter($locations, $items)
                && $items->has('KeyD4') && $items->has('BigKeyD4')
                && $this->boss->canBeat($items, $locations)
                && (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD4') || $this->locations["Thieves' Town - Boss"]->hasItem(Item::get('CompassD4', $this->world)))
                && (!$this->world->config('region.wildMaps', false) || $items->has('MapD4') || $this->locations["Thieves' Town - Boss"]->hasItem(Item::get('MapD4', $this->world)));
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
                && ($item == Item::get('CompassD4', $this->world) || $item == Item::get('MapD4', $this->world));
        });

        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && ($this->world->config('itemPlacement') !== 'basic'
                    || (($this->world->config('mode.weapons') === 'swordless' || $items->hasSword()) && $items->hasHealth(7) && $items->hasBottle()))
                && ($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
                && $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
