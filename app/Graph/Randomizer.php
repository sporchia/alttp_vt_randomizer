<?php

declare(strict_types=1);

namespace App\Graph;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * This is the primary entry point for randomization. A new object is created
 * with a config array dictating how the worlds should be created and prepping
 * all graph infomation for those worlds.
 *
 * Walk thru walls: 7E037F01
 */
final class Randomizer
{
    const ITEM_LOCATIONS = [
        'bigchest',
        'bonk',
        'chest',
        'drop',
        'dig',
        'event',
        'npc',
        //'mob', // enabling this will allow enemies for major items
        'pot',
        'shopitem',
        'standing',
        'prize',
        'pedestal',
        'refill',
    ];

    public Graph $graph;
    private Graph $starting_graph;
    private readonly array $graphs;
    private array $key_doors = [];
    /**
     * Key edges for just this door.
     */
    private array $key_door_edges = [];
    /** @var Collection<Vertex> */
    private Collection $vertices;
    private Inventory $assumed_items;
    private Inventory $collected_items;
    public array $found_locations;
    public Vertex $start;
    /** @var array<array<Vertex>> */
    private array $set_locations = ['*' => []];
    private array $worlds = [];
    private array $door_chains = [];
    static array $door_cache = [];

    /**
     * Set up the Randomizer. This involves:
     * 1. Creating a new Graph
     * 2. Creating a starting vertex
     * 3. Creating a mapping of placement groups and their vertices
     * 4. using an array of array type configs for all the worlds we would like
     *    to randomize and building them out
     * 5. and keeping track of all the vertices in the graph
     *
     * @param array $configs options for the worlds
     *
     * @return void
     */
    public function __construct(array $configs = [[]])
    {
        $this->graph = new Graph();
        $this->start = $this->graph->newVertex([
            'name' => 'start',
            'type' => 'meta',
        ]);

        $this->vertices = collect([$this->start])->keyBy(static function ($vertex) {
            return $vertex->name;
        });
        $this->set_locations = ['*' => []];
        $this->collected_items = new Inventory();

        $i = 0;
        foreach ($configs as $config) {
            $this->worlds[$i] = new World($i, $config);
            $this->collected_items = $this->collected_items->merge($this->worlds[$i]->collected_items);

            $shop_filler = new ShopFiller($this->worlds[$i]);
            $shop_filler->adjustEdges();

            $entrance_shuffler = new EntranceShuffler($this->worlds[$i]);
            $entrance_shuffler->adjustEdges();

            // boss shuffler must be called before enemy shuffler as enemy
            // shuffler will update sprite GFX sheets.
            $boss_shuffler = new BossShuffler($this->worlds[$i]);
            $boss_shuffler->adjustEdges();

            // This will handle challenge rooms
            $enemy_shuffler = new EnemyShuffler($this->worlds[$i]);
            $enemy_shuffler->adjustEdges();

            $bunnifier = new BunnyGraphifier($this->worlds[$i]);
            $bunnifier->adjustEdges();

            $prizepack_shuffler = new PrizePackShuffler($this->worlds[$i]);
            $prizepack_shuffler->adjustEdges();

            $this->graph = $this->graph->merge($this->worlds[$i]->graph);
            $this->graph->addDirected($this->start, $this->graph->getVertex("start:$i"), 'fixed');

            ++$i;
        }

        foreach ($this->graph->getVertices() as $location) {
            $this->vertices[$location->name] = $location;
            if (!in_array($location->type, self::ITEM_LOCATIONS)) {
                continue;
            }
            $this->set_locations['*'][$location->id] = $location;
            foreach ($location->itemset as $set) {
                $this->set_locations[$set] ??= [];
                $this->set_locations[$set][$location->id] = $location;
            }
        }

        // @todo this needs simplified!
        $graphs = [];
        $edge_groups = array_map(fn ($edge) => $edge->group, $this->graph->getEdges());
        foreach ($edge_groups as $group) {
            if (isset($graphs[$group])) {
                continue;
            }

            if (str_starts_with($group, 'Key') && !str_starts_with($group, 'KeyForKey')) {
                $key_edges = array_filter($this->graph->getEdges(), fn ($edge) => $edge->group === $group);

                foreach ($key_edges as $edge) {
                    $this->key_doors[$group][$edge->from->id] = $edge->from;
                }

                foreach ($this->key_doors[$group] as $key_door) {
                    $this->key_door_edges[$key_door->id] = new Graph();
                    foreach ($key_edges as $edge) {
                        if ($edge->from->id === $key_door->id) {
                            $this->key_door_edges[$key_door->id]->addEdge($edge);
                        }
                    }
                }
            } else {
                $graphs[$group] = $this->graph->getSubgraph($group);
            }
        }

        $this->graphs = $graphs;

        $this->starting_graph = $this->graphs['fixed'];
        $this->starting_graph = $this->searchGraph($this->collected_items);
    }

    /**
     * Randomize the worlds. This handles creating a filler and placing those
     * items into the worlds.
     * 
     * @return World[]
     */
    public function randomize(): array
    {
        $filler = new RandomAssumedFiller($this, [
            'accessibility' => array_map(fn ($world) => $world->config('accessibility'), $this->worlds),
        ]);

        $sets = (new ItemPooler($this->worlds))->getPool();

        $filler->fillGraph($sets);

        return $this->worlds;
    }

    /**
     * Get a complete connected graph that has been searched based on a supplied
     * inventory. One may supply a starting graph to continue searching from
     * along with item locations within the graph that have already been
     * accounted for.
     *
     * @todo Speed this up!!! Every 1ms in here ~= 100ms of total time
     *
     * @param Inventory $collected Items assumed to be collected before the search has started
     * @param ?Graph $starting_graph A graph that is already partially searched
     * @param array $collected_item_map a listing of locations that are already accounted for in $collected
     */
    private function searchGraph(Inventory $collected, ?Graph $starting_graph = null, array $collected_item_map = []): Graph
    {
        /** @var Graph $search_graph */
        $search_graph = $starting_graph ?? $this->starting_graph;
        $graphs = $this->graphs;
        do {
            $new = false;
            $sub_graphs = [];
            foreach ($graphs as $item => $sub_graph) {
                if ($collected->has($item)) {
                    $sub_graphs[] = $sub_graph;
                    unset($graphs[$item]);
                }
            }

            $search_graph = $search_graph->merge(...$sub_graphs);
            $search_graph->search($this->start);

            foreach ($search_graph->getItems($this->start) as $vid => $item) {
                if (!isset($collected_item_map[$vid])) {
                    if (str_starts_with($item->name, "BigRedBomb") && $this->dropOffSearch($item, $search_graph)) {
                        $collected = $collected->addItem(Item::get("BigRedBombActive", $item->world_id));
                    }
                    $new = true;
                    $collected_item_map[$vid] = true;
                    $collected = $collected->addItem($item);
                }
            }
        } while ($new);

        return $search_graph;
    }

    private function dropOffSearch(Item $item, Graph $search_graph): bool
    {
        $start = $this->vertices["Bomb Shoppe Lobby:" . $item->world_id];
        $end = $this->vertices["Pyramid:" . $item->world_id];
        // @todo tidy up this exclude by only being hops/entrances.
        $exclude = [
            "hop:$item->world_id",
            "Flippers:$item->world_id",
            "DarkFlippers:$item->world_id",
        ];
        $bomb_search_graph = $search_graph->exclude(...$exclude);
        $bomb_search_graph->search($start);

        return isset($bomb_search_graph->getVisited($start)[$end->id]);
    }

    /**
     * Search the graph starting with a set number of keys, and determine the
     * shared outcome if one were to use their keys in every possible way.
     *
     * @param Graph $search_graph starting search
     * @param array $found previously found locations
     * @param Inventory $collected already collected items
     * @param array $locked_doors currently locked doors
     * @param string $key which key we are unlocking for
     * @param int $recursion_level how deep in this %#*& we are
     * @param array $chain listing of doors already opened
     */
    private function recursiveDoorSearch(
        Graph $search_graph,
        array $found,
        Inventory $collected,
        array $locked_doors,
        string $key,
        int $recursion_level,
        array $chain = [],
    ): array {
        if ($collected->getCount($key) >= count($this->key_doors[$key])) {
            $door_graphs = array_filter(
                $this->key_door_edges,
                fn ($door_id) => isset($this->key_doors[$key][$door_id]),
                ARRAY_FILTER_USE_KEY
            );
            $graph = $this->searchGraph($collected, $search_graph->merge(...$door_graphs), $found);
            return $graph->getVisited($this->start);
        }

        $in_graph_locations = $search_graph->getVisited($this->start);
        $sub_found_locations = [];
        foreach (array_filter($locked_doors, fn ($location) => isset($in_graph_locations[$location->id])) as $door) {
            $current_chain = array_merge($chain, [$door->id]);
            sort($current_chain);
            $chain_id = implode($current_chain);
            if (isset($this->door_chains[$chain_id])) {
                $sub_found_locations[$door->id] = $this->door_chains[$chain_id];
                continue;
            }
            $graph = $this->searchGraph($collected, $search_graph->merge($this->key_door_edges[$door->id]), $found);
            $found_locations = $graph->getVisited($this->start);
            $new_collected = $collected->merge($this->collectItems(array_diff_key($found_locations, $found)));
            $sub_found_locations[$door->id] = $found_locations;
            $new_found_keys = $new_collected->getCount($key);
            if (count($locked_doors) > 1 && $new_found_keys > $recursion_level) {
                $all_found = array_merge($found_locations, $found);
                $sub_found_locations[$door->id] = $this->recursiveDoorSearch(
                    $graph,
                    $all_found,
                    $new_collected,
                    Arr::except($locked_doors, [$door->id]),
                    $key,
                    $recursion_level + 1,
                    $current_chain
                );
            }
            $this->door_chains[$chain_id] = $sub_found_locations[$door->id];
        }

        return count($sub_found_locations) ? array_intersect_key(...array_values($sub_found_locations)) : $found;
    }

    /**
     * Get locations that are accessible no matter how one uses the keys
     * available.
     *
     * @param Inventory $collected Assumed collected items
     */
    public function getStrongLocations(Inventory $collected): array
    {
        $search_graph = $this->searchGraph($collected);
        $found_locations = $search_graph->getVisited($this->start);
        do {
            $this->door_chains = [];
            $new_found_locations = [];
            $new_items = $this->collectItems($found_locations);
            $new_collected = $collected->merge($new_items);
            $search_graph = $this->searchGraph($new_collected, null, $found_locations);
            foreach ($this->key_doors as $key => $doors) {
                if ($new_collected->has($key)) {
                    $strong_locations = $this->recursiveDoorSearch(
                        $search_graph,
                        $found_locations,
                        $new_collected,
                        $doors,
                        $key,
                        1
                    );
                    $new_strong_locations = array_diff_key($strong_locations, $found_locations);
                    $found_locations = array_merge($found_locations, $new_strong_locations);
                    $new_found_locations = array_merge($new_found_locations, $new_strong_locations);
                }
            }
        } while (count($new_found_locations));

        return $found_locations;
    }

    /**
     * Assume a set of items and search for locations that would be accessable.
     *
     * @param array<Item> $items items to assume
     */
    public function assumeItems(array $items): void
    {
        $this->assumed_items = new Inventory($items);
        $this->found_locations = $this->getStrongLocations($this->collected_items->merge($this->assumed_items));
    }

    /**
     * Get locations in an item set, one may toggle reachability of these
     * locations.
     *
     * @param string $item_set contrain results to item set
     * @param array $item_sets counts of items required in each set
     * @param bool $reachable only return reachable locations
     *
     * @throws Exception if there are no available locations in a set
     *
     * @return array<Vertex>
     */
    public function getEmptyLocationsInSet(string $item_set = '*', array $item_sets = [], bool $reachable = true): array
    {
        $empty_locations = array_filter($this->set_locations[$item_set], function ($vertex) use ($reachable) {
            return (!$reachable || isset($this->found_locations[$vertex->id])) && $vertex->item === null;
        });

        foreach ($item_sets as $set_name => $set_count) {
            if ($set_name === '*') {
                continue;
            }
            $set_locations = array_filter($this->set_locations[$set_name], static function ($location) {
                return $location->item === null;
            });
            if (count($set_locations) < $set_count) {
                throw new Exception("Not enough set locations available: $set_name");
            }
            // if a set has the same number of items to place as set locations
            // left, remove it from this return.
            if ($item_set !== $set_name && count($set_locations) === $set_count) {
                $empty_locations = array_diff($empty_locations, $set_locations);
            }
        }

        return $empty_locations;
    }

    /**
     * Determine if a location is considered reachable after last assumeItems
     * call.
     *
     * @param string $location_name location to check reachability of
     */
    public function canReachLocation(string $location_name): bool
    {
        return isset($this->found_locations[$this->vertices[$location_name]->id]);
    }

    /**
     * Get array of locations that currently have placed items.
     *
     * @param ?array $locations filtered locations to check, otherwise all locations
     */
    public function locationsWithItems(?array $locations = null): array
    {
        return array_filter($locations ?? $this->found_locations, fn ($location) => $location->item || $location->trophy);
    }

    /**
     * Search world and get all items that are found.
     *
     * @param ?array $locations filtered locations to check, otherwise all locations
     */
    public function collectItems(?array $locations = null): Inventory
    {
        $items = [];
        $locationsWithItems = $this->locationsWithItems($locations);
        foreach ($locationsWithItems as $location) {
            if ($location->item) {
                $items[] = $location->item;
            }
            if ($location->trophy) {
                $items[] = $location->trophy;
            }
        }
        return new Inventory($items);
    }

    /**
     * Get a vertex by name.
     *
     * @param string $location_name name to search for
     */
    public function getLocation(string $location_name): ?Vertex
    {
        return $this->vertices[$location_name] ?? null;
    }
}
