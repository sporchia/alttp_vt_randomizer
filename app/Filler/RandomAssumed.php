<?php

namespace ALttP\Filler;

use ALttP\Filler;
use ALttP\Item;
use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use ALttP\Support\WorldCollection;
use Illuminate\Support\Facades\Log;

class RandomAssumed extends Filler
{
    /**
     * This fill places items in the first available location that it can possibly be in, assuming that unplaced
     * items will be reachable. Those items will then have a smaller set of places that they can be placed.
     *
     * @param array $dungeon items that must be placed
     * @param array $required items that must be placed
     * @param array $nice items that would be nice to have placed
     * @param array $extra items that don't matter if they get placed
     *
     * @return void
     */
    public function fill(array $dungeon, array $required, array $nice, array $extra): void
    {
        $all_locations = new LocationCollection;
        foreach ($this->worlds as $world) {
            $all_locations = $all_locations->merge($world->getEmptyLocations());
        }

        $randomized_order_locations = $this->shuffleLocations($all_locations);

        $this->fillItemsInLocations($dungeon, $randomized_order_locations, array_merge($required, $nice));

        // random junk fill
        foreach ($this->worlds as $world) {
            [$gt_lower_junk, $gt_upper_junk] = $world->getGanonsTowerJunkFillRange();

            $gt_locations = $world->getRegion('Ganons Tower')->getEmptyLocations()
                ->randomCollection(get_random_int($gt_lower_junk, $gt_upper_junk));

            $extra = $this->shuffleItems($extra);
            $trash = array_splice($extra, 0, $gt_locations->count());
            $this->fastFillItemsInLocations($trash, $gt_locations);
        }

        $randomized_order_locations = $randomized_order_locations->getEmptyLocations()->reverse();

        $this->fillItemsInLocations($this->shuffleItems($required), $randomized_order_locations);

        $randomized_order_locations = $this->shuffleLocations($randomized_order_locations->getEmptyLocations());

        $this->fastFillItemsInLocations($this->shuffleItems($nice), $randomized_order_locations);

        $this->fastFillItemsInLocations($this->shuffleItems($extra), $randomized_order_locations->getEmptyLocations());
    }

    protected function fillItemsInLocations($fill_items, $locations, $base_assumed_items = [])
    {
        $remaining_fill_items = new ItemCollection($fill_items);
        Log::debug(sprintf(
            "Filling %s items in %s locations",
            $remaining_fill_items->count(),
            $locations->getEmptyLocations()->count()
        ));

        if ($remaining_fill_items->count() > $locations->getEmptyLocations()->count()) {
            throw new \Exception(
                "Trying to fill more items than available locations." .
                    $remaining_fill_items->count() . ' ' . $locations->getEmptyLocations()->count()
            );
        }

        $worlds = new WorldCollection($this->worlds);

        foreach ($fill_items as $key => $item) {
            $starting_items = $remaining_fill_items->removeItem($item->getName())->merge($base_assumed_items);
            foreach ($this->worlds as $world) {
                $world->resetCollectedLocations();
            }

            $found_locations = 0;
            $assumed_items = $starting_items->copy();
            foreach ($this->worlds as $world) {
                $assumed_items = $assumed_items->merge($world->getPreCollectedItems());
            }
            do {
                $current_locations = 0;
                foreach ($this->worlds as $world) {
                    $assumed_items = $assumed_items->merge($world->collectOtherItems($assumed_items));
                    $current_locations += $world->getCollectedLocationsCount();
                }
                if ($found_locations == $current_locations) {
                    break;
                } else {
                    $found_locations = $current_locations;
                }
            } while (true);

            $can_skip_access_checks = $item->getWorld()->config('accessibility') === 'none'
                && (!$item instanceof Item\Key || $item->getWorld()->config('region.wildKeys', false))
                && (!$item instanceof Item\BigKey || $item->getWorld()->config('region.wildBigKeys', false))
                && (!$item instanceof Item\Map || $item->getWorld()->config('region.wildMaps', false))
                && (!$item instanceof Item\Compass || $item->getWorld()->config('region.wildCompasses', false))
                && $worlds->checkWinCondition($assumed_items);

            $fillable_locations = $locations->filter(function ($location) use ($item, $assumed_items, $can_skip_access_checks) {
                return !$location->hasItem() && $location->canFill($item, $assumed_items, !$can_skip_access_checks);
            });

            if ($fillable_locations->count() == 0) {
                throw new \Exception(vsprintf('No Available Locations: "%s %d" %s', [
                    $item->getNiceName(),
                    $item->getWorld()->id,
                    json_encode($remaining_fill_items->map(function ($i) {
                        return $i->getName();
                    }))
                ]));
            }

            if ($item instanceof Item\Compass || $item instanceof Item\Map) {
                $fill_location = $fillable_locations->random();
            } else {
                $fill_location = $fillable_locations->first();
            }

            Log::debug(vsprintf("Placing Item: %s in %s (%d)", [
                $item->getName(),
                $fill_location->getName(),
                $fillable_locations->count(),
            ]));

            $fill_location->setItem($item);
        }
    }
}
