<?php

declare(strict_types=1);

namespace App\Graph;

use App\Graph\Randomizer;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * Meat and potatoes of filling graph based randomizers.
 */
final class RandomAssumedFiller
{
    /**
     * Create graph filler.
     * 
     * @return void
     */
    public function __construct(private Randomizer $randomizer)
    {
        //
    }

    /**
     * This fill places items in the first available location that it can
     * possibly be in, assuming that unplaced items will be reachable. Those
     * items will then have a smaller set of places that they can be placed.
     *
     * @param array $items items to be placed from ItemPooler
     */
    public function fillGraph(array $items): void
    {
        $set_counts = array_map(fn ($set) => count(Arr::flatten($set)), $items);

        $flat_items = Arr::dot($items);
        $shuffled_keys = fy_shuffle(array_keys($flat_items));

        // fix placement groups
        usort($shuffled_keys, function ($a, $b) {
            $aweight = (int) explode('.', $a)[1];
            $bweight = (int) explode('.', $b)[1];
            return $aweight - $bweight;
        });

        $fill_flat_items = array_filter($flat_items, fn ($key) => explode('.', $key)[1] <= 9000, ARRAY_FILTER_USE_KEY);

        foreach ($shuffled_keys as $item_key) {
            $item_set = explode('.', $item_key)[0];
            $item_weight = explode('.', $item_key)[1];
            if ($item_weight > 9000) {
                break;
            }

            $item = $flat_items[$item_key];
            unset($flat_items[$item_key]);
            unset($fill_flat_items[$item_key]);
            $item_world_id = $item->world_id;
            $this->randomizer->assumeItems($fill_flat_items);
            $required = false;
            if (
                $this->randomizer->config($item_world_id, 'accessibility') === 'none'
                && $this->randomizer->collectItems()->has("Triforce:$item_world_id")
            ) {
                $locations = $this->randomizer->getEmptyLocationsInSet($item_set, $set_counts, false);
            } else {
                $required = true;
                $locations = $this->randomizer->getEmptyLocationsInSet($item_set, $set_counts);
            }

            if (empty($locations)) {
                dd($this->randomizer->collectItems());
                throw new Exception("No locations for: $item");
            }

            $location = get_random_element($locations);
            Log::debug(vsprintf('[%s] [%s] Placing `%s` in `%s` (%s:%d)', [
                $item_weight,
                $required ? 'R' : ' ',
                $item,
                $location->getAttribute('name'),
                $item_set,
                count($locations),
            ]));

            $location->item = $item;
            $set_counts[$item_set]--;
        }

        // assume items after last placement to sort the graph out.
        $this->randomizer->assumeItems($flat_items);

        $this->fastFillItemsInLocations($flat_items);
    }

    /**
     * Quickly place items in locations respecting placemenmt groups.
     *
     * @param array $fill_items keys list of items to place
     */
    protected function fastFillItemsInLocations(array $fill_items): void
    {
        Log::debug(sprintf("Fast Filling %s items", count($fill_items)));
        // assure smaller location groups are filled first
        uksort($fill_items, function ($a, $b) {
            $aparts = explode('.', $a);
            $bparts = explode('.', $b);
            $aweight = ((int) $aparts[1]) + ($aparts[0] === '*' ? 9999 : 0);
            $bweight = ((int) $bparts[1]) + ($bparts[0] === '*' ? 9999 : 0);
            return $aweight - $bweight;
        });

        $current_key = '';
        foreach ($fill_items as $item_key => $item) {
            $item_set = explode('.', $item_key)[0];
            if ($current_key !== $item_set) {
                $locations = fy_shuffle($this->randomizer->getEmptyLocationsInSet($item_set, [], false));
                $current_key = $item_set;
            }

            $location = array_pop($locations);
            if (!$location) {
                Log::debug(sprintf('No Location: `%s` `%s`', $item, $item_set));
                continue;
            }
            $location->item = $item;
            Log::debug(vsprintf('[FF] Placing: `%s` in `%s` (%s:%d)', [
                $item,
                $location->getAttribute('name'),
                $item_set,
                count($locations) + 1,
            ]));
        }
    }
}
