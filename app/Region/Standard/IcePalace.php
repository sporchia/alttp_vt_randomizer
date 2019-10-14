<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Ice Palace Region and it's Locations contained within
 */
class IcePalace extends Region
{
    protected $name = 'Ice Palace';
    public $music_addresses = [
        0x155BF,
    ];

    protected $map_reveal = 0x0040;

    protected $region_items = [
        'BigKey',
        'BigKeyD5',
        'Compass',
        'CompassD5',
        'Key',
        'KeyD5',
        'Map',
        'MapD5',
    ];

    /**
     * Create a new Ice Palace Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Kholdstare", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Ice Palace - Big Key Chest", [0xE9A4], null, $this),
            new Location\Chest("Ice Palace - Compass Chest", [0xE9D4], null, $this),
            new Location\Chest("Ice Palace - Map Chest", [0xE9DD], null, $this),
            new Location\Chest("Ice Palace - Spike Room", [0xE9E0], null, $this),
            new Location\Chest("Ice Palace - Freezor Chest", [0xE995], null, $this),
            new Location\Chest("Ice Palace - Iced T Room", [0xE9E3], null, $this),
            new Location\BigChest("Ice Palace - Big Chest", [0xE9AA], null, $this),
            new Location\Drop("Ice Palace - Boss", [0x180157], null, $this),

            new Location\Prize\Crystal("Ice Palace - Prize", [null, 0x120A4, 0x53F5A, 0x53F5B, 0x180059, 0x180073, 0xC705], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Ice Palace - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Ice Palace - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->canLiftRocks()
                && (!$this->world->config('region.cantTakeDamage', false)
                    || $items->has('CaneOfByrna') || $items->has('Cape') || $items->has('Hookshot'))
                && $this->locations["Ice Palace - Spike Room"]->canAccess($items, $locations);
        });

        $this->locations["Ice Palace - Map Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->canLiftRocks()
                && (!$this->world->config('region.cantTakeDamage', false)
                    || $items->has('CaneOfByrna') || $items->has('Cape') || $items->has('Hookshot'))
                && $this->locations["Ice Palace - Spike Room"]->canAccess($items, $locations);
        });

        $this->locations["Ice Palace - Spike Room"]->setRequirements(function ($locations, $items) {
            return (!$this->world->config('region.cantTakeDamage', false)
                || $items->has('CaneOfByrna') || $items->has('Cape') || $items->has('Hookshot'))
                && ($items->has('Hookshot') || ($items->has('BigKeyD5') ? $items->has('Hookshot') : $items->has('KeyD5', 1)));
        });

        $this->locations["Ice Palace - Freezor Chest"]->setRequirements(function ($locations, $items) {
            return $items->canMeltThings($this->world);
        });

        $this->locations["Ice Palace - Big Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('BigKeyD5');
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Ice Palace - Boss"]->canAccess($items);
        };

        $this->locations["Ice Palace - Boss"]->setRequirements(function ($locations, $items) {
            return $this->canEnter($locations, $items)
                && $items->has('Hammer') && $items->canLiftRocks()
                && $this->boss->canBeat($items, $locations)
                && $items->has('BigKeyD5') && (
                    ($this->world->config('itemPlacement') !== 'basic' && ($items->has('CaneOfSomaria') && $items->has('KeyD5')
                        || $items->has('KeyD5', 2)))
                    || ($this->world->config('itemPlacement') === 'basic' && $items->has('KeyD5', 2)))
                && (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD5') || $this->locations["Ice Palace - Boss"]->hasItem(Item::get('CompassD5', $this->world)))
                && (!$this->world->config('region.wildMaps', false) || $items->has('MapD5') || $this->locations["Ice Palace - Boss"]->hasItem(Item::get('MapD5', $this->world)));
        })->setFillRules(function ($item, $locations, $items) {
            if (
                !$this->world->config('region.bossNormalLocation', true)
                && (is_a($item, Item\Key::class) || is_a($item, Item\BigKey::class)
                    || is_a($item, Item\Map::class) || is_a($item, Item\Compass::class))
            ) {
                return false;
            }
            return true;
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('region.bossNormalLocation', true)
                && ($item == Item::get('CompassD5', $this->world) || $item == Item::get('MapD5', $this->world));
        });

        $this->can_enter = function ($locations, $items) {
            return $items->has('RescueZelda')
                && ($this->world->config('itemPlacement') !== 'basic'
                    || (($this->world->config('mode.weapons') === 'swordless' || $items->hasSword(2)) && $items->hasHealth(12) && ($items->hasBottle(2) || $items->hasArmor())))
                && ($items->canMeltThings($this->world) || $this->world->config('canOneFrameClipUW', false))
                && ((($items->has('MoonPearl') || $this->world->config('canDungeonRevive', false))
                    && ($items->has('Flippers') || $this->world->config('canFakeFlipper', false))
                    && $items->canLiftDarkRocks()) 
					|| (
						$this->world->getRegion('South Dark World')->canEnter($locations, $items)
						&& ($items->has('MoonPearl')
							|| ($items->hasABottle() && $this->world->config('canOWYBA', false)) 
							|| ($this->world->config('canBunnyRevive', false) && $items->canBunnyRevive())) 
						&& (($this->world->config('canMirrorWrap', false) && $items->has('MagicMirror')
								&& (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')) 
									|| ($this->world->config('canSuperSpeed', false) && $items->canSpinSpeed()) 
									|| $this->world->config('canOneFrameClipOW', false))) 
							|| ($items->has('Flippers') && $this->world->config('canFakeFlipper', false)
								&& (($this->world->config('canBootsClip', false) && $items->has('PegasusBoots')) 
									|| $this->world->config('canOneFrameClipOW', false)))));
		};

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
