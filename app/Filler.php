<?php

namespace ALttP;

use ALttP\Support\LocationCollection;
use ALttP\World;
use Log;

abstract class Filler
{
    protected $worlds;

    /**
     * Returns a Filler of a specified type.
     *
     * @param string $type type of Filler requested
     * @param array $worlds World to assocaite filler to
     *
     * @return self
     */
    public static function factory($type = null, array $worlds = null): self
    {
        if ($worlds === null) {
            $worlds = [World::factory()];
        }

        switch ($type) {
            default:
            case 'RandomAssumed':
                return new Filler\RandomAssumed($worlds);
        }
    }

    public function __construct(array $worlds)
    {
        $this->worlds = $worlds;
    }

    abstract public function fill(array $dungeon, array $required, array $nice, array $extra);

    protected function shuffleLocations(LocationCollection $locations)
    {
        return $locations->randomCollection($locations->count());
    }

    protected function shuffleItems(array $items)
    {
        return fy_shuffle($items);
    }

    protected function fastFillItemsInLocations($fill_items, $locations)
    {
        Log::debug(sprintf("Fast Filling %s items in %s locations", count($fill_items), $locations->count()));

        foreach ($locations as $location) {
            if ($location->hasItem()) {
                continue;
            }
            $item = array_pop($fill_items);
            if (!$item) {
                break;
            }
            Log::debug(sprintf('Placing: %s in %s', $item->getNiceName(), $location->getName()));
            $location->setItem($item);
        }
    }
}
