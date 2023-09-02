<?php

declare(strict_types=1);

namespace App\Graph;

/**
 * Fill initial shop state.
 */
final class ShopFiller
{
    /**
     * @param World $world world to reduce graph for
     * 
     * @return void
     */
    public function __construct(private World $world)
    {
        $shops = $world->getLocationsOfType('shop');
        $graph = $this->world->graph;

        if ($world->config('region.shopSupply') === 'shuffled') {
            foreach ($shops as $shop) {
                // Potion shop canot be modified at this time.
                if ($shop->name === "Potion Shop:$world->id") {
                    continue;
                }
                $inventory = array_filter($graph->getTargets($shop), fn ($target) => $target->type === 'shopitem');
                foreach ($inventory as $shop_item) {
                    $shop_item->item = null;
                    $shop_item->cost = null;
                }
            }
        }

        if ($world->config('mode.state') === 'inverted') {
            // put blue potion in DW shop.
        }
    }

    /**
     * No edge adjustment is necessary with shop inventories.
     */
    public function adjustEdges(): void
    {
    }
}
