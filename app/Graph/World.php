<?php

declare(strict_types=1);

namespace App\Graph;

use App\Drops\PrizePack;
use App\Sprite\Droppable;
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
    public Inventory $collected_items;
    private array $config = [];
    private array $prizepacks;
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
        ], $config);

        $this->prizepacks = [
            '0' => new PrizePack('0', 8),
            '1' => new PrizePack('1', 8),
            '2' => new PrizePack('2', 8),
            '3' => new PrizePack('3', 8),
            '4' => new PrizePack('4', 8),
            '5' => new PrizePack('5', 8),
            '6' => new PrizePack('6', 8),
            'pull' => new PrizePack('pull', 3),
            'crab' => new PrizePack('crab', 2),
            'stun' => new PrizePack('stun', 1),
            'fish' => new PrizePack('fish', 1),
        ];

        $this->graph = new Graph();
        $start = $this->graph->newVertex([
            'name' => 'start:' . $this->id,
            'type' => 'meta',
        ]);

        $meta = $this->graph->newVertex([
            'name' => 'Meta:' . $this->id,
            'type' => 'meta',
        ]);
        $this->graph->addDirected($start, $meta, ['group' => 'fixed']);

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

        $vertices = resolve(VertexCollector::class)->getForWorld($this);
        collect($vertices)->map(function ($data) {
            return $this->graph->newVertex($data);
        });

        $edges = resolve(EdgeCollector::class)->getForWorld($this);
        foreach ($edges as $group => $data) {
            foreach ($data['directed'] as $edge_data) {
                if (
                    !$this->graph->getVertex($edge_data[1]) instanceof Vertex
                    || !$this->graph->getVertex($edge_data[0]) instanceof Vertex
                ) {
                    dd($edge_data);
                }
                $this->graph->addDirected(
                    $this->graph->getVertex($edge_data[0]),
                    $this->graph->getVertex($edge_data[1]),
                    [
                        'group' => $group,
                        'graphviz.label' => $group,
                    ]
                );
            }
            foreach ($data['undirected'] as $edge_data) {
                $this->graph->addDirected(
                    $this->graph->getVertex($edge_data[0]),
                    $this->graph->getVertex($edge_data[1]),
                    [
                        'group' => $group,
                        'graphviz.label' => $group,
                    ]
                );
                $this->graph->addDirected(
                    $this->graph->getVertex($edge_data[1]),
                    $this->graph->getVertex($edge_data[0]),
                    [
                        'group' => $group,
                        'graphviz.label' => $group,
                    ]
                );
            }
        }
        // set special edges
        if ($this->graph->getVertex("TowerEntry:{$this->id}")) {
            $entry = $this->config('crystals.tower', 7) === 1
                ? 'Crystal:' . $this->id
                : 'Crystal:' . $this->id . '|' . $this->config('crystals.tower', 7);

            $this->graph->addDirected(
                $this->graph->getVertex("Meta:{$this->id}"),
                $this->graph->getVertex("TowerEntry:{$this->id}"),
                [
                    'group' => $entry,
                    'graphviz.label' => $entry,
                ]
            );
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

                    $this->graph->addDirected(
                        $this->graph->getVertex("Meta:{$this->id}"),
                        $this->graph->getVertex("GanonVulnerable:{$this->id}"),
                        [
                            'group' => $vulnerable,
                            'graphviz.label' => $vulnerable,
                        ]
                    );
            }
        }

        $this->remapVertices();
    }

    public function remapVertices(): void
    {
        $this->vertices = collect();
        foreach ($this->graph->getVertices() as $location) {
            $this->vertices[$location->getAttribute('name')] = $location;
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
     */
    public function getLocationsWithItem(Item $item = null): Collection
    {
        return $this->vertices->filter(static function (Vertex $vertex) use ($item) {
            return $vertex->item === $item;
        });
    }

    /**
     * Get a vertices by type.
     *
     * @param string $type type to search for
     */
    public function getLocationsOfType(string $type): Collection
    {
        return $this->vertices->filter(static function (Vertex $vertex) use ($type) {
            return $vertex->getAttribute('type') === $type;
        });
    }

    /**
     * Get a vertices by room.
     *
     * @param int $id room id
     */
    public function getLocationsInRoom(int $id): Collection
    {
        return $this->vertices->filter(static function (Vertex $vertex) use ($id) {
            return $vertex->getAttribute('roomid') === $id;
        });
    }

    /**
     * Get a vertices by map.
     *
     * @param int $id map id
     */
    public function getLocationsInMap(int $id): Collection
    {
        return $this->vertices->filter(static function (Vertex $vertex) use ($id) {
            return $vertex->getAttribute('map') === $id;
        });
    }

    /**
     * Get vertices we can write to rom.
     */
    public function getWritableVertices(): Collection
    {
        return $this->vertices->filter(function ($vertex) {
            return $vertex->getAttribute('addresses', false);
        });
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
        // @todo remove this block later only needed for prize packs
        if (!array_key_exists($key, $this->config)) {
            $this->config[$key] = config(
                "alttp.goals.{$this->config['goal']}.$key",
                config(
                    "alttp.$key",
                    config(
                        "logic.{$this->config['logic']}.$key",
                        config($key, null)
                    )
                )
            );
        }

        return $this->config[$key] ?? $default;
    }

    /**
     * Set a drop in a PrizePackSlot in a given PrizePack.
     * @todo sadness refactor drops into graph and remove this code
     *
     * @param string $pack the prize pack to set the drop in
     * @param int $ind the index of the drop to set
     * @param Droppable $drop the name of the drop to set
     */
    public function setDrop(string $pack, int $ind, Droppable $drop): void
    {
        $this->prizepacks[$pack]->getDrops()[$ind]->setDrop($drop);
    }

    /**
     * Get all prize packs.
     */
    public function getPrizePacks(): array
    {
        return $this->prizepacks;
    }
}
