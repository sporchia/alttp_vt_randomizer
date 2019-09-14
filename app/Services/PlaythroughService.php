<?php

namespace ALttP\Services;

use ALttP\Item;
use ALttP\Location;
use ALttP\Support\LocationCollection;
use ALttP\World;
use Illuminate\Support\Facades\Log;

/**
 * Service class to add hints to a series of worlds.
 */
class PlaythroughService
{
    /**
     * Return an array of Locations to collect all Advancement Items in the game in order. This works by cloning the
     * current world (new Locations and all). Then it groups the locations into collection spheres (all reachable
     * locations based on the items in the previous sphere). It then attempts to remove each item (starting from the
     * outer most sphere [latest game locations]), checking the win condition after each removal. If the removed item
     * makes it impossile to achieve the win condition, it is placed back at the location (and marked as a required
     * location). If the item is safe to remove, we then take all the items out of the higher spheres and see if we can
     * still access them with the items available in the lower spheres. If we cannot reach a required item from a higher
     * sphere we put it back (and mark the location as required). We repeat this process until all spheres have been
     * pruned. We then take that list of locations with items and run a playthrough of them so we know collection order.
     *
     * @todo this is failing when basic item placement is enabled
     *
     * @param \ALttP\World  $world        world to get playthrough of
     * @param bool          $walkthrough  include the play order
     *
     * @return array
     */
    public function getPlayThrough(World $world, $walkthrough = true): array
    {
        $shadow_world = $world->copy();
        $junk_items = [
            Item::get('BlueShield', $world),
            Item::get('Boomerang', $world),
            Item::get('MirrorShield', $world),
            Item::get('RedBoomerang', $world),
            Item::get('RedShield', $world),
            Item::get('BombUpgrade5', $world),
            Item::get('BombUpgrade10', $world),
            Item::get('BombUpgrade50', $world),
            Item::get('ArrowUpgrade5', $world),
            Item::get('ArrowUpgrade10', $world),
            Item::get('ArrowUpgrade70', $world),
            Item::get('RedPotion', $world),
            Item::get('Bee', $world),
            Item::get('TenArrows', $world),
            Item::get('Bomb', $world),
            Item::get('ThreeBombs', $world),
            Item::get('OneRupee', $world),
            Item::get('FiveRupees', $world),
            Item::get('TwentyRupees', $world),
            Item::get('FiftyRupees', $world),
            Item::get('OneHundredRupees', $world),
            Item::get('ThreeHundredRupees', $world),
            Item::get('Heart', $world),
            Item::get('Rupoor', $world),
        ];

        // remove junk locations for filtering later
        $shadow_world->getLocations()->each(function ($location) use ($junk_items) {
            $location_item = $location->getItem();
            if ($location_item && in_array($location_item, $junk_items)) {
                $location->setItem();
            }
        });

        $location_sphere = $shadow_world->getLocationSpheres();
        $collectable_locations = new LocationCollection(array_flatten(array_map(function ($collection) {
            return $collection->values();
        }, $location_sphere)));
        $required_locations = new LocationCollection;
        $required_locations_sphere = [];
        $reverse_location_sphere = array_reverse($location_sphere, true);

        foreach ($reverse_location_sphere as $sphere_level => $sphere) {
            if ($sphere_level == 0) {
                continue;
            }
            Log::debug("playthrough SPHERE: $sphere_level");
            foreach ($sphere as $location) {
                Log::debug(sprintf(
                    "playthrough Check: %s :: %s",
                    $location->getName(),
                    $location->getItem() ? $location->getItem()->getNiceName() : 'Nothing'
                ));
                // pull item out (we have to pull keys as well :( as they are used in calcs for big keys see DP)
                $pulled_item = $location->getItem();
                if ($pulled_item === null) {
                    continue;
                }
                $location->setItem();
                if ((!$world->config('region.wildMaps', false) && $pulled_item instanceof Item\Map)
                    || (!$world->config('region.wildCompasses', false) && $pulled_item instanceof Item\Compass)
                    || in_array($pulled_item, $junk_items)
                ) {
                    continue;
                }
                if (!$shadow_world->getWinCondition()($collectable_locations->getItems($shadow_world)->copy())) {
                    // put item back
                    $location->setItem($world->getCollectableLocations()[$location->getName()]->getItem());
                    $required_locations->addItem($location);
                    $required_locations_sphere[$sphere_level][] = $location;
                    Log::debug(sprintf("playthrough Keep: %s :: %s", $location->getName(), $location->getItem()->getNiceName()));
                    continue;
                }

                // Itterate all spheres bubbling up -_-
                foreach (array_reverse(array_keys($required_locations_sphere)) as $check_sphere) {
                    // don't check the current sphere (thats a waste of time).
                    if ($check_sphere == $sphere_level || $required_locations->has($location->getName())) {
                        continue;
                    }

                    // remove all higher sphere items from their locations
                    foreach ($required_locations_sphere as $higher_sphere => $higher_locations) {
                        if ($higher_sphere < $check_sphere) {
                            continue;
                        }
                        foreach ($higher_locations as $higher_location) {
                            $higher_location->setItem();
                        }
                    }

                    // test access of items in the outer sphere
                    foreach ($required_locations_sphere as $higher_sphere => $higher_locations) {
                        if ($higher_sphere != $check_sphere) {
                            continue;
                        }
                        foreach ($higher_locations as $higher_location) {
                            // remove the item we are trying to get
                            $temp_pull = $higher_location->getItem();
                            $higher_location->setItem();
                            $current_items = $collectable_locations->getItems($shadow_world)->copy();

                            if (!$higher_location->canAccess($current_items, $world->getLocations())) {
                                // put item back
                                $location->setItem($world->getCollectableLocations()[$location->getName()]->getItem());
                                Log::debug(sprintf(
                                    "playthrough Higher Location: %s :: %s",
                                    $higher_location->getName(),
                                    $world->getCollectableLocations()[$higher_location->getName()]->getItem()->getNiceName()
                                ));
                                $required_locations->addItem($location);
                                $required_locations_sphere[$sphere_level][] = $location;
                                Log::debug(sprintf(
                                    "playthrough Readd: %s :: %s",
                                    $location->getName(),
                                    $location->getItem()->getNiceName()
                                ));
                                break 2;
                            }
                            $higher_location->setItem($temp_pull);
                        }
                    }
                    // put all higher items back
                    foreach ($required_locations as $higher_location) {
                        $higher_location->setItem($world->getCollectableLocations()[$higher_location->getName()]->getItem());
                    }
                }
            }
        }

        foreach ($required_locations as $higher_location) {
            Log::debug(sprintf(
                "playthrough REQ: %s :: %s",
                $higher_location->getName(),
                $world->getCollectableLocations()[$higher_location->getName()]->getItem()->getNiceName()
            ));
        }
        if (!$walkthrough) {
            return $required_locations->values();
        }

        // RUN PLAYTHROUGH of locations found above
        $my_items = $shadow_world->getPreCollectedItems();
        $location_order = [];
        $location_round = [];
        $longest_item_chain = 1;
        do {
            // make sure we had something before going to the next round
            if (!empty($location_round[$longest_item_chain])) {
                $longest_item_chain++;
            }
            $location_round[$longest_item_chain] = [];
            $available_locations = $shadow_world->getCollectableLocations()->filter(function ($location) use ($world, $my_items, $location_order) {
                return !in_array($location, $location_order)
                    && $location->canAccess($my_items, $world->getLocations());
            });

            $found_items = $available_locations->getItems();

            $available_locations->each(function ($location) use ($world, &$location_order, &$location_round, $longest_item_chain) {
                $item = $location->getItem();
                if (
                    in_array($location, $location_order)
                    || !$location->hasItem()
                ) {
                    return;
                }
                Log::debug(sprintf("Pushing: %s from %s", $item->getNiceName(), $location->getName()));
                array_push($location_order, $location);
                if ((($world->config('rom.genericKeys', false) || !$world->config('region.wildKeys', false)) && $item instanceof Item\Key)
                    || $item instanceof Item\Map
                    || $item instanceof Item\Compass
                    || $item == Item::get('RescueZelda', $world)
                ) {
                    return;
                }
                array_push($location_round[$longest_item_chain], $location);
            });
            $my_items = $my_items->merge($found_items);
        } while ($found_items->count() > 0);

        $ret = ['longest_item_chain' => count($location_round)];
        if (count($shadow_world->getPreCollectedItems())) {
            $i = 0;
            foreach ($shadow_world->getPreCollectedItems() as $item) {
                if (
                    $item instanceof Item\Upgrade\Arrow
                    || $item instanceof Item\Upgrade\Bomb
                    || $item instanceof Item\Upgrade\Health
                    || $item instanceof Item\Event
                ) {
                    continue;
                }

                $location = sprintf("Equipment Slot %s", ++$i);
                $ret[0]['Equipped'][$location] = $item->getName();
            }
        }
        foreach ($location_round as $round => $locations) {
            $locations = array_filter($locations, function ($location) {
                return !$location instanceof Location\Trade;
            });
            if ($locations === null) {
                continue;
            }
            if (!count($locations)) {
                $ret['longest_item_chain']--;
            }
            foreach ($locations as $location) {
                $ret[$round][$location->getRegion()->getName()][$location->getName()] = $location->getItem()->getName();
            }
        }

        $ret['regions_visited'] = array_reduce($ret, function ($carry, $item) {
            return (is_array($item)) ? $carry + count($item) : $carry;
        });

        return $ret;
    }
}
