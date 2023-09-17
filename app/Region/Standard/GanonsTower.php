<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Ganons Tower Region and it's Locations contained within
 */
class GanonsTower extends Region
{
    protected $name = 'Ganons Tower';
    protected $boss_bottom = null;
    protected $boss_middle = null;
    protected $boss_top = null;
    public $music_addresses = [
        0x155C9,
    ];

    protected $region_items = [
        'BigKey',
        'BigKeyA2',
        'Compass',
        'CompassA2',
        'Key',
        'KeyA2',
        'Map',
        'MapA2',
    ];

    /**
     * Create a new Ganons Tower Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Agahnim2", $world);
        $this->boss_top = Boss::get("Moldorm", $world);
        $this->boss_middle = Boss::get("Lanmolas", $world);
        $this->boss_bottom = Boss::get("Armos Knights", $world);

        $this->locations = new LocationCollection([
            new Location\Dash("Ganon's Tower - Bob's Torch", [0x180161], null, $this),
            new Location\Chest("Ganon's Tower - DMs Room - Top Left", [0xEAB8], null, $this),
            new Location\Chest("Ganon's Tower - DMs Room - Top Right", [0xEABB], null, $this),
            new Location\Chest("Ganon's Tower - DMs Room - Bottom Left", [0xEABE], null, $this),
            new Location\Chest("Ganon's Tower - DMs Room - Bottom Right", [0xEAC1], null, $this),
            new Location\Chest("Ganon's Tower - Randomizer Room - Top Left", [0xEAC4], null, $this),
            new Location\Chest("Ganon's Tower - Randomizer Room - Top Right", [0xEAC7], null, $this),
            new Location\Chest("Ganon's Tower - Randomizer Room - Bottom Left", [0xEACA], null, $this),
            new Location\Chest("Ganon's Tower - Randomizer Room - Bottom Right", [0xEACD], null, $this),
            new Location\Chest("Ganon's Tower - Firesnake Room", [0xEAD0], null, $this),
            new Location\Chest("Ganon's Tower - Map Chest", [0xEAD3], null, $this),
            new Location\BigChest("Ganon's Tower - Big Chest", [0xEAD6], null, $this),
            new Location\Chest("Ganon's Tower - Hope Room - Left", [0xEAD9], null, $this),
            new Location\Chest("Ganon's Tower - Hope Room - Right", [0xEADC], null, $this),
            new Location\Chest("Ganon's Tower - Bob's Chest", [0xEADF], null, $this),
            new Location\Chest("Ganon's Tower - Tile Room", [0xEAE2], null, $this),
            new Location\Chest("Ganon's Tower - Compass Room - Top Left", [0xEAE5], null, $this),
            new Location\Chest("Ganon's Tower - Compass Room - Top Right", [0xEAE8], null, $this),
            new Location\Chest("Ganon's Tower - Compass Room - Bottom Left", [0xEAEB], null, $this),
            new Location\Chest("Ganon's Tower - Compass Room - Bottom Right", [0xEAEE], null, $this),
            new Location\Chest("Ganon's Tower - Big Key Chest", [0xEAF1], null, $this),
            new Location\Chest("Ganon's Tower - Big Key Room - Left", [0xEAF4], null, $this),
            new Location\Chest("Ganon's Tower - Big Key Room - Right", [0xEAF7], null, $this),
            new Location\Chest("Ganon's Tower - Mini Helmasaur Room - Left", [0xEAFD], null, $this),
            new Location\Chest("Ganon's Tower - Mini Helmasaur Room - Right", [0xEB00], null, $this),
            new Location\Chest("Ganon's Tower - Pre-Moldorm Chest", [0xEB03], null, $this),
            new Location\Chest("Ganon's Tower - Moldorm Chest", [0xEB06], null, $this),
            new Location\Prize\Event("Agahnim 2", [], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Agahnim 2"];
        $this->prize_location->setItem(Item::get('DefeatAgahnim2', $world));
    }

    /**
     * Get the Boss of this Region.
     *
     * @param string  $level  which boss
     *
     * @return Boss
     */
    public function getBoss(string $level)
    {
        switch ($level) {
            case '':
                return $this->boss;
            case 'top':
                return $this->boss_top;
            case 'middle':
                return $this->boss_middle;
            case 'bottom':
                return $this->boss_bottom;
        }

        throw new \Exception(sprintf('Unknown Boss Location %s', $level));
    }

    /**
     * Set the Boss of this Region.
     *
     * @param Boss $boss boss of the region
     * @param string $level which boss
     *
     * @return $this
     */
    public function setBoss(Boss $boss, string $level = null): Region
    {
        switch ($level) {
            case null:
                $this->boss = $boss;
                break;
            case 'top':
                $this->boss_top = $boss;
                break;
            case 'middle':
                $this->boss_middle = $boss;
                break;
            case 'bottom':
                $this->boss_bottom = $boss;
                break;
            default:
                throw new \Exception(sprintf('Unknown Boss Location %s', $level));
        }

        return $this;
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

        if ($level == 'top') {
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

        if ($level == 'middle') {
            return !in_array($boss->getName(), [
                "Agahnim",
                "Agahnim2",
                "Blind",
                "Ganon",
            ]);
        }

        return !in_array($boss->getName(), [
            "Agahnim",
            "Agahnim2",
            "Ganon",
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
        $this->locations["Ganon's Tower - Bob's Torch"]->setRequirements(function ($locations, $items) {
            return $items->has('PegasusBoots');
        });

        $this->locations["Ganon's Tower - DMs Room - Top Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot');
        });

        $this->locations["Ganon's Tower - DMs Room - Top Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot');
        });

        $this->locations["Ganon's Tower - DMs Room - Bottom Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot');
        });

        $this->locations["Ganon's Tower - DMs Room - Bottom Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot');
        });

        $this->locations["Ganon's Tower - Randomizer Room - Top Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot')
                && (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Randomizer Room - Top Right",
                    "Ganon's Tower - Randomizer Room - Bottom Left",
                    "Ganon's Tower - Randomizer Room - Bottom Right",
                ]) && $items->has('KeyA2', 3))
                    || $items->has('KeyA2', 4));
        });

        $this->locations["Ganon's Tower - Randomizer Room - Top Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot')
                && (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Randomizer Room - Top Left",
                    "Ganon's Tower - Randomizer Room - Bottom Left",
                    "Ganon's Tower - Randomizer Room - Bottom Right",
                ]) && $items->has('KeyA2', 3))
                    || $items->has('KeyA2', 4));
        });

        $this->locations["Ganon's Tower - Randomizer Room - Bottom Left"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot')
                && (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Randomizer Room - Top Right",
                    "Ganon's Tower - Randomizer Room - Top Left",
                    "Ganon's Tower - Randomizer Room - Bottom Right",
                ]) && $items->has('KeyA2', 3))
                    || $items->has('KeyA2', 4));
        });

        $this->locations["Ganon's Tower - Randomizer Room - Bottom Right"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot')
                && (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Randomizer Room - Top Right",
                    "Ganon's Tower - Randomizer Room - Top Left",
                    "Ganon's Tower - Randomizer Room - Bottom Left",
                ]) && $items->has('KeyA2', 3))
                    || $items->has('KeyA2', 4));
        });

        $this->locations["Ganon's Tower - Firesnake Room"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && $items->has('Hookshot')
                && ((($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Randomizer Room - Top Right",
                    "Ganon's Tower - Randomizer Room - Top Left",
                    "Ganon's Tower - Randomizer Room - Bottom Left",
                    "Ganon's Tower - Randomizer Room - Bottom Right",
                ]) || $locations["Ganon's Tower - Firesnake Room"]->hasItem(Item::get('KeyA2', $this->world))) && $items->has('KeyA2', 2))
                    || $items->has('KeyA2', 3));
        });

        $this->locations["Ganon's Tower - Map Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('Hammer') && ($items->has('Hookshot') || ($this->world->config('itemPlacement') !== 'basic' && $items->has('PegasusBoots')))
                && (in_array($locations["Ganon's Tower - Map Chest"]->getItem(), [Item::get('BigKeyA2', $this->world), Item::get('KeyA2', $this->world)])
                    ? $items->has('KeyA2', 3) : $items->has('KeyA2', 4));
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('KeyA2', $this->world) && $items->has('KeyA2', 3);
        })->setFillRules(function ($item, $locations, $items) {
            return $this->world->config('accessibility') !== 'locations' || $item != Item::get('KeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Big Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('BigKeyA2') && $items->has('KeyA2', 3)
                && (($items->has('Hammer') && $items->has('Hookshot')) || ($items->has('FireRod') && $items->has('CaneOfSomaria')));
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Bob's Chest"]->setRequirements(function ($locations, $items) {
            return (($items->has('Hammer') && $items->has('Hookshot'))
                || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
                && $items->has('KeyA2', 3)
                && ($this->world->config('itemPlacement') != 'basic' || ($items->has('FireRod') || ($items->has('Ether') && $items->hasSword(1))));
        });

        $this->locations["Ganon's Tower - Tile Room"]->setRequirements(function ($locations, $items) {
            return $items->has('CaneOfSomaria');
        });

        $this->locations["Ganon's Tower - Compass Room - Top Left"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod') && $items->has('CaneOfSomaria')
                && (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Compass Room - Top Right",
                    "Ganon's Tower - Compass Room - Bottom Left",
                    "Ganon's Tower - Compass Room - Bottom Right",
                ]) && $items->has('KeyA2', 3))
                    || $items->has('KeyA2', 4));
        });

        $this->locations["Ganon's Tower - Compass Room - Top Right"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod') && $items->has('CaneOfSomaria')
                && (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Compass Room - Top Left",
                    "Ganon's Tower - Compass Room - Bottom Left",
                    "Ganon's Tower - Compass Room - Bottom Right",
                ]) && $items->has('KeyA2', 3))
                    || $items->has('KeyA2', 4));
        });

        $this->locations["Ganon's Tower - Compass Room - Bottom Left"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod') && $items->has('CaneOfSomaria')
                && (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Compass Room - Top Right",
                    "Ganon's Tower - Compass Room - Top Left",
                    "Ganon's Tower - Compass Room - Bottom Right",
                ]) && $items->has('KeyA2', 3))
                    || $items->has('KeyA2', 4));
        });

        $this->locations["Ganon's Tower - Compass Room - Bottom Right"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod') && $items->has('CaneOfSomaria')
                && (($locations->itemInLocations(Item::get('BigKeyA2', $this->world), [
                    "Ganon's Tower - Compass Room - Top Right",
                    "Ganon's Tower - Compass Room - Top Left",
                    "Ganon's Tower - Compass Room - Bottom Left",
                ]) && $items->has('KeyA2', 3))
                    || $items->has('KeyA2', 4));
        });

        $this->locations["Ganon's Tower - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return (($items->has('Hammer') && $items->has('Hookshot'))
                || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
                && $items->has('KeyA2', 3)
                && $this->boss_bottom->canBeat($items, $locations);
        });

        $this->locations["Ganon's Tower - Big Key Room - Left"]->setRequirements(function ($locations, $items) {
            return (($items->has('Hammer') && $items->has('Hookshot'))
                || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
                && $items->has('KeyA2', 3)
                && $this->boss_bottom->canBeat($items, $locations);
        });

        $this->locations["Ganon's Tower - Big Key Room - Right"]->setRequirements(function ($locations, $items) {
            return (($items->has('Hammer') && $items->has('Hookshot'))
                || ($items->has('FireRod') && $items->has('CaneOfSomaria')))
                && $items->has('KeyA2', 3)
                && $this->boss_bottom->canBeat($items, $locations);
        });

        $this->locations["Ganon's Tower - Mini Helmasaur Room - Left"]->setRequirements(function ($locations, $items) {
            return $items->canShootArrows($this->world) && $items->canLightTorches()
                && $items->has('BigKeyA2') && $items->has('KeyA2', 3)
                && $this->boss_middle->canBeat($items, $locations);
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Mini Helmasaur Room - Right"]->setRequirements(function ($locations, $items) {
            return $items->canShootArrows($this->world) && $items->canLightTorches()
                && $items->has('BigKeyA2') && $items->has('KeyA2', 3)
                && $this->boss_middle->canBeat($items, $locations);
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Pre-Moldorm Chest"]->setRequirements(function ($locations, $items) {
            return $items->canShootArrows($this->world) && $items->canLightTorches()
                && $items->has('BigKeyA2') && $items->has('KeyA2', 3)
                && $this->boss_middle->canBeat($items, $locations);
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyA2', $this->world);
        });

        $this->locations["Ganon's Tower - Moldorm Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('Hookshot')
                && $items->canShootArrows($this->world) && $items->canLightTorches()
                && $items->has('BigKeyA2') && $items->has('KeyA2', 4)
                && $this->boss_middle->canBeat($items, $locations)
                && $this->boss_top->canBeat($items, $locations);
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('KeyA2', $this->world) && $item != Item::get('BigKeyA2', $this->world);
        });

        $this->can_complete = function ($locations, $items) {
            return $this->canEnter($locations, $items)
                && $this->locations["Ganon's Tower - Moldorm Chest"]->canAccess($items)
                && $this->boss->canBeat($items, $locations);
        };

        $this->prize_location->setRequirements($this->can_complete);

        $this->can_enter = function ($locations, $items) {
      $playerCrystalCount = (
        $items->has('Crystal1')
        + $items->has('Crystal2')
        + $items->has('Crystal3')
        + $items->has('Crystal4')
        + $items->has('Crystal5')
        + $items->has('Crystal6')
        + $items->has('Crystal7')
      );

      return $items->has('RescueZelda')
        && ($this->world->config('itemPlacement') !== 'basic'
          || (($this->world->config('mode.weapons') === 'swordless' || $items->hasSword(2)) && $items->hasHealth(12) && ($items->hasBottle(2) || $items->hasArmor())))
        && (
          (($items->has('MoonPearl') || ($this->world->config('canOWYBA', false) && $items->hasABottle()))
            && ((($playerCrystalCount >= $this->world->config('crystals.tower', 7))
                        && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items))
                        || ((($this->world->config('canBootsClip', false) && $items->has('PegasusBoots'))
                            || ($this->world->config('canSuperSpeed', false) && $items->has('PegasusBoots')
                                && $items->has('Hookshot')))
                            && $this->world->getRegion('West Dark World Death Mountain')->canEnter($locations, $items))))

                    || ($this->world->config('canOneFrameClipOW', false)
                        && ($this->world->config('canDungeonRevive', false) || $items->has('MoonPearl')
              || ($this->world->config('canOWYBA', false) && $items->hasABottle())))
          || (($playerCrystalCount >= $this->world->config('crystals.tower', 7)) &&
            $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items) &&
            ($this->world->config('canDungeonRevive', false)))
        );
        };

        return $this;
    }
}
