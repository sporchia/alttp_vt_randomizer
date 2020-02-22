<?php

namespace ALttP\Support;

use ALttP\World;

/**
 * Service class to add hints to a series of worlds.
 */
class WorldCollection
{
    /** @var array */
    protected $worlds;

    /**
     * Create a new world service.
     *
     * @param array  $worlds  worlds to create hints for
     *
     * @return void
     */
    public function __construct(array $worlds)
    {
        foreach ($worlds as $world) {
            $this->worlds[$world->id] = $world;
        }
    }

    /**
     * Check if all the worlds are winnable
     *
     * @return bool
     */
    public function isWinnable(): bool
    {
        foreach ($this->worlds as $reset_count_world) {
            $reset_count_world->resetCollectedLocations();
        }

        $found_locations = 0;
        $assumed_items = new ItemCollection;
        foreach ($this->worlds as $world) {
            $assumed_items = $assumed_items->merge($world->getPreCollectedItems());
        }
        do {
            $current_locations = 0;
            foreach ($this->worlds as $collect_world) {
                $assumed_items = $assumed_items->merge($collect_world->collectOtherItems($assumed_items));
                $current_locations += $collect_world->getCollectedLocationsCount();
            }
            if ($found_locations == $current_locations) {
                break;
            } else {
                $found_locations = $current_locations;
            }
        } while (true);

        foreach ($this->worlds as $check_world) {
            if (!$check_world->getWinCondition()($assumed_items)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the first item from the collection.
     *
     * @return \ALttP\World
     */
    public function first(): World
    {
        return reset($this->worlds);
    }

    /**
     * Get by world id.
     * 
     * @throws \OutOfBoundsException
     * 
     * @param int  $worldId  the world id we are looking for
     * 
     * @return \ALttP\World
     */
    public function get(int $worldId): World
    {
        return $this->worlds[$worldId];
    }


    /**
     * Takes an ItemCollection and calls checkWinCondition on each world, until
     * one returns false, or we run out.
     *
     * @param \ALttP\Support\ItemCollection  $items  Items to check win condition with
     *
     * @return bool
     */
    public function checkWinCondition(ItemCollection $items): bool
    {
        foreach ($this->worlds as $check_world) {
            if (!$check_world->getWinCondition()($items)) {
                return false;
            }
        }

        return true;
    }

    /**
     * This gets the spoiler data for all the worlds.
     * 
     * @return array
     */
    public function getSpoiler($meta = []): array
    {
        $spoiler = [];
        foreach ($this->worlds as $world) {
            $spoiler[$world->id] = $world->getSpoiler(array_merge([
                'entry_crystals_ganon' => $world->config('crystals.ganon'),
                'entry_crystals_tower' => $world->config('crystals.tower'),
            ], $meta));
        }
        return $spoiler;
    }

    public function count(): int
    {
        return count($this->worlds);
    }
}
