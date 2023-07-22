<?php

declare(strict_types=1);

namespace App\Graph;

use Illuminate\Support\Collection;
use App\Graph\Graph;

/**
 * Model of a world in which a player would be playing.
 */
final class World
{
    public readonly int $id;
    public readonly Graph $graph;
    /** @var Collection<Vertex> */
    private Collection $vertices;
    public readonly Inventory $collected_items;
    private array $config = [];
    public array $sprite_sheets = [
        'underworld' => [],
        'overworld' => [],
        'sets' => [],
    ];

    /**
     * Add all the vertices to the graph for this region.
     *
     * @param int $id id of this world
     * @param array $config options for this world
     *
     * @return void
     */
    public function __construct(int $id = 0, array $config = [])
    {
        $this->id = $id;
        $this->config = array_merge([
            'difficulty' => 'normal',
            'logic' => 'NoGlitches',
            'goal' => 'ganon',
            'enemizer.enemyShuffle' => 'none',
        ], $config);

        $this->graph = new Graph();
        $start = $this->graph->newVertex([
            'name' => 'start:' . $this->id,
            'type' => 'meta',
        ]);

        $meta = $this->graph->newVertex([
            'name' => 'Meta:' . $this->id,
            'type' => 'meta',
        ]);
        $this->graph->addDirected($start, $meta, "fixed:{$this->id}");

        $items = array_merge([
            Item::get('MagicBar', $this->id),
            Item::get('LiftBush', $this->id),
            Item::get('LiftPot', $this->id),
            Item::get('UseBomb', $this->id),
            Item::get('OpenChest', $this->id),
            Item::get('BombUpgrade10', $this->id),
            Item::get('ArrowUpgrade10', $this->id),
            Item::get('ArrowUpgrade10', $this->id),
            Item::get('ArrowUpgrade10', $this->id),
            "fixed:{$this->id}",
            "hop:{$this->id}",
        ], $config['equipment'] ?? [
            Item::get('BossHeartContainer', $this->id),
            Item::get('BossHeartContainer', $this->id),
            Item::get('BossHeartContainer', $this->id),
        ]);
        if ($this->config('mode.state') === 'standard') {
            $items[] = "EscapeLamp:{$this->id}";
        }
        if ($this->config('accessibility') !== 'locations') {
            $items[] = "KeyForKey:{$this->id}";
        }
        $this->collected_items = new Inventory($items);

        $vertices = resolve(VertexCollector::class)->loadYmlData($this);
        collect($vertices)->map(function ($data) {
            if (isset($data['item']) && !$data['item'] instanceof Item) {
                $data['item'] = Item::get($data['item'], $this->id);
            }
            if (isset($data['trophy']) && !$data['trophy'] instanceof Item) {
                $data['trophy'] = Item::get($data['trophy'], $this->id);
            }
            return $this->graph->newVertex($data);
        });

        $edges = resolve(EdgeCollector::class)->getForWorld($this);
        foreach ($edges as $group => $data) {
            foreach ($data['directed'] as $edge_data) {
                if (
                    !$this->graph->getVertex($edge_data[1]) instanceof Vertex
                    || !$this->graph->getVertex($edge_data[0]) instanceof Vertex
                ) {
                    dd([
                        'Name Connection Mismatch',
                        $edge_data,
                        $this->graph->getVertex($edge_data[1]),
                        $this->graph->getVertex($edge_data[0]),
                    ]);
                }
                $this->graph->addDirected($this->graph->getVertex($edge_data[0]), $this->graph->getVertex($edge_data[1]), $group);
            }
            foreach ($data['undirected'] as $edge_data) {
                if (
                    !$this->graph->getVertex($edge_data[1]) instanceof Vertex
                    || !$this->graph->getVertex($edge_data[0]) instanceof Vertex
                ) {
                    dd([
                        'Undirected Name Connection Mismatch',
                        $edge_data,
                        $this->graph->getVertex($edge_data[1]),
                        $this->graph->getVertex($edge_data[0]),
                    ]);
                }
                $this->graph->addDirected($this->graph->getVertex($edge_data[0]), $this->graph->getVertex($edge_data[1]), $group);
                $this->graph->addDirected($this->graph->getVertex($edge_data[1]), $this->graph->getVertex($edge_data[0]), $group);
            }
        }
        // set special edges
        if ($this->graph->getVertex("TowerEntry:{$this->id}")) {
            $entry = $this->config('crystals.tower', 7) === 1
                ? 'Crystal:' . $this->id
                : 'Crystal:' . $this->id . '|' . $this->config('crystals.tower', 7);

            $this->graph->addDirected($this->graph->getVertex("Meta:{$this->id}"), $this->graph->getVertex("TowerEntry:{$this->id}"), $entry);
        }
        if ($this->graph->getVertex("GanonVulnerable:{$this->id}")) {
            switch ($this->config('goal')) {
                case 'dungeons':
                    $this->graph->newVertex(["AllDungeons"]);
                    break;
                case 'ganon':
                case 'fastganon':
                default:
                    $vulnerable = $this->config('crystals.ganon', 7) === 1
                        ? 'Crystal:' . $this->id
                        : 'Crystal:' . $this->id . '|' . $this->config('crystals.ganon', 7);

                    $this->graph->addDirected($this->graph->getVertex("Meta:{$this->id}"), $this->graph->getVertex("GanonVulnerable:{$this->id}"), $vulnerable);
            }
        }

        $this->remapVertices();
    }

    public function remapVertices(): void
    {
        $this->vertices = collect();
        foreach ($this->graph->getVertices() as $location) {
            $this->vertices[$location->name] = $location;
        }
    }

    /**
     * Get a vertex by name.
     *
     * @param string $location_name name to search for
     */
    public function getLocation(string $location_name): ?Vertex
    {
        if (strpos($location_name, ':') === false) {
            $location_name = $location_name . ':' . $this->id;
        }
        return $this->vertices[$location_name] ?? null;
    }

    /**
     * Get a vertices by item contained.
     *
     * @param Item|null $item item to search for
     * 
     * @return Collection<Vertex>
     */
    public function getLocationsWithItem(Item $item = null): Collection
    {
        return $this->vertices->filter(fn (Vertex $vertex) => $vertex->item === $item);
    }

    /**
     * Get a vertices by type.
     *
     * @param string $type type to search for
     * 
     * @return Collection<Vertex>
     */
    public function getLocationsOfType(string $type): Collection
    {
        return $this->vertices->filter(fn (Vertex $vertex) => $vertex->type === $type);
    }

    /**
     * Get vertices we can write to rom.
     */
    public function getWritableVertices(): Collection
    {
        return $this->vertices->filter(fn ($vertex) => $vertex->addresses !== null);
    }

    /**
     * Get config value based on the currently set rules.
     *
     * @param string $key dot notation key of config
     * @param mixed|null $default value to return if $key is not found
     *
     * @return mixed
     */
    public function config(string $key, $default = null)
    {
        if (!array_key_exists($key, $this->config)) {
            $this->config[$key] = config($key, null);
        }

        return $this->config[$key] ?? $default;
    }
}
