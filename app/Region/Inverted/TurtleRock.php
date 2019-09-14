<?php

namespace ALttP\Region\Inverted;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Turtle Rock Region and it's Locations contained within
 */
class TurtleRock extends Region\Standard\TurtleRock
{
    protected function enterTopNoGlitches($locations, $items)
    {
        return ((($locations["Turtle Rock Medallion"]->hasItem(Item::get('Bombos', $this->world)) && $items->has('Bombos'))
            || ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Ether', $this->world)) && $items->has('Ether'))
            || ($locations["Turtle Rock Medallion"]->hasItem(Item::get('Quake', $this->world)) && $items->has('Quake')))
            && ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword()))
            && $items->has('CaneOfSomaria')
            && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items);
    }

    protected function enterMiddleNoGlitches($locations, $items)
    {
        return $items->has('MagicMirror')
            && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
    }

    protected function enterBottomNoGlitches($locations, $items)
    {
        return $items->has('MagicMirror')
            && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
    }

    protected function canReachTop($locations, $items)
    {
        return $items->has('CaneOfSomaria') && ($this->enterTop($locations, $items)
            || ($this->enterMiddle($locations, $items) && $items->has('KeyD7', 4)) // IF both top and bottom external access is provably impossible, and big key is in front, we can reduce this to 2 keys.
            || ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))
                && $items->has('KeyD7', 4)));
    }

    protected function canReachMiddle($locations, $items)
    {
        return $this->enterMiddle($locations, $items)
            || ($this->enterTop($locations, $items) && $items->has('KeyD7', $this->accountForWastingKeyOnTrinexDoor(2, 3)))
            || ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))
                && $items->has('CaneOfSomaria'));
    }

    protected function canReachBottom($locations, $items)
    {
        return $this->enterBottom($locations, $items) || (($this->enterTop($locations, $items) || $this->enterMiddle($locations, $items)) &&
            $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria')
            && $items->has('BigKeyD7') && $items->has('KeyD7', 3));
    }

    // If it can be conclusively proven that bottom is not externally reachable
    protected function accountForWastingKeyOnTrinexDoor($withoutWaste, $withWaste)
    {
        if ($this->world->config('turtlerock.wastekey', false)) {
            return $withoutWaste;
        }
        return $withWaste;
    }

    protected function enterTopOverworldGlitches($locations, $items)
    {
        return $this->enterTopNoGlitches($locations, $items);
    }

    protected function enterMiddleOverworldGlitches($locations, $items)
    {
        return $this->enterMiddleNoGlitches($locations, $items)
            || ($this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items)
                && $items->has('PegasusBoots')
                && ($items->has('Hookshot') || $items->hasSword(1)));
    }

    protected function enterBottomOverworldGlitches($locations, $items)
    {
        return $this->enterBottomNoGlitches($locations, $items);
    }

    protected function enterTopMajorGlitches($locations, $items)
    {
        return $this->enterTopOverworldGlitches($locations, $items);
    }

    protected function enterMiddleMajorGlitches($locations, $items)
    {
        return $this->enterMiddleOverworldGlitches($locations, $items);
    }

    protected function enterBottomMajorGlitches($locations, $items)
    {
        return $this->enterBottomOverworldGlitches($locations, $items);
    }

    protected function enterTopNone($locations, $items)
    {
        return true;
    }

    protected function enterMiddleNone($locations, $items)
    {
        return true;
    }

    protected function enterBottomNone($locations, $items)
    {
        return true;
    }

    protected function enterTop($locations, $items)
    {
        $function = 'enterTop' . $this->world->config('logic');

        return $this->$function($locations, $items);
    }

    protected function enterMiddle($locations, $items)
    {
        $function = 'enterMiddle' . $this->world->config('logic');

        return $this->$function($locations, $items);
    }

    protected function enterBottom($locations, $items)
    {
        $function = 'enterBottom' . $this->world->config('logic');

        return $this->$function($locations, $items);
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Turtle Rock - Chain Chomps"]->setRequirements(function ($locations, $items) {
            return ($this->enterTop($locations, $items) && $items->has('CaneOfSomaria')
                && $items->has('KeyD7', $this->accountForWastingKeyOnTrinexDoor(1, 2)))
                || $this->enterMiddle($locations, $items);
        });

        $this->locations["Turtle Rock - Roller Room - Left"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod') && $this->canReachTop($locations, $items);
        });

        $this->locations["Turtle Rock - Roller Room - Right"]->setRequirements(function ($locations, $items) {
            return $items->has('FireRod') && $this->canReachTop($locations, $items);
        });

        $this->locations["Turtle Rock - Compass Chest"]->setRequirements(function ($locations, $items) {
            return $this->canReachTop($locations, $items);
        });

        $this->locations["Turtle Rock - Big Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('BigKeyD7') && $this->canReachMiddle($locations, $items)
                && ($items->has('Hookshot') || $items->has('CaneOfSomaria'));
        })->setFillRules(function ($item, $locations, $items) {
            return $item != Item::get('BigKeyD7', $this->world);
        });

        $this->locations["Turtle Rock - Big Key Chest"]->setRequirements(function ($locations, $items) {
            // TODO: It only needs 2 keys if it has the big key and there is no possible external bottom access.
            return $this->canReachMiddle($locations, $items) && ($items->has('KeyD7', 4)
                || $this->locations["Turtle Rock - Big Key Chest"]->hasItem(Item::get('KeyD7', $this->world)));
        })->setAlwaysAllow(function ($item, $items) {
            return $item == Item::get('KeyD7', $this->world);
        });

        $this->locations["Turtle Rock - Crystaroller Room"]->setRequirements(function ($locations, $items) {
            return ($items->has('BigKeyD7') && $this->canReachMiddle($locations, $items))
                || ($this->enterBottom($locations, $items) && $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('CaneOfSomaria'));
        });

        $this->locations["Turtle Rock - Eye Bridge - Bottom Left"]->setRequirements(function ($locations, $items) {
            return $this->canReachBottom($locations, $items)
                && ($this->world->config('itemPlacement') !== 'basic' || $items->has('Cape') || $items->has('CaneOfByrna')
                    || ($this->world->config('item.overflow.count.Shield', 3) >= 3 && $items->canBlockLasers()));
        });

        $this->locations["Turtle Rock - Eye Bridge - Bottom Right"]->setRequirements(function ($locations, $items) {
            return $this->canReachBottom($locations, $items)
                && ($this->world->config('itemPlacement') !== 'basic' || $items->has('Cape') || $items->has('CaneOfByrna')
                    || ($this->world->config('item.overflow.count.Shield', 3) >= 3 && $items->canBlockLasers()));
        });

        $this->locations["Turtle Rock - Eye Bridge - Top Left"]->setRequirements(function ($locations, $items) {
            return $this->canReachBottom($locations, $items)
                && ($this->world->config('itemPlacement') !== 'basic' || $items->has('Cape') || $items->has('CaneOfByrna')
                    || ($this->world->config('item.overflow.count.Shield', 3) >= 3 && $items->canBlockLasers()));
        });

        $this->locations["Turtle Rock - Eye Bridge - Top Right"]->setRequirements(function ($locations, $items) {
            return $this->canReachBottom($locations, $items)
                && ($this->world->config('itemPlacement') !== 'basic' || $items->has('Cape') || $items->has('CaneOfByrna')
                    || ($this->world->config('item.overflow.count.Shield', 3) >= 3 && $items->canBlockLasers()));
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Turtle Rock - Boss"]->canAccess($items);
        };

        $this->locations["Turtle Rock - Boss"]->setRequirements(function ($locations, $items) {
            return $this->canReachBottom($locations, $items)
                && $items->has('KeyD7', 4)
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

        $this->can_enter = function ($locations, $items) {
            return $this->enterTop($locations, $items)
                || $this->enterMiddle($locations, $items)
                || $this->enterBottom($locations, $items);
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
