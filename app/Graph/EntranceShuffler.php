<?php

declare(strict_types=1);

namespace App\Graph;

use Exception;
use Illuminate\Support\Arr;
use Symfony\Component\Yaml\Yaml;

/**
 * Modify the edges of the graph to shuffle entrances.
 */
final class EntranceShuffler
{
    private readonly array $definition;

    /**
     * Add all the vertices to the graph for this region.
     *
     * @param World $world world to reduce graph for
     *
     * @return void
     */
    public function __construct(private World $world)
    {
        $definition = match ($world->config('entrances')) {
            'simple' => 'simple.yml',
            'restricted' => 'vanilla.yml',
            'full' => 'vanilla.yml',
            'crossed' => 'vanilla.yml',
            'insanity' => 'vanilla.yml',
            'none' => 'vanilla.yml',
            default => $world->config('entrances') ?? 'vanilla.yml',
        };

        if (is_string($definition) && is_readable(app_path("Graph/data/Edges/entrances/$definition"))) {
            $this->definition = Yaml::parse(file_get_contents(app_path("Graph/data/Edges/entrances/$definition")));
        } elseif (is_array($definition)) {
            $this->definition = $definition;
        } else {
            throw new Exception("No valid entrance definition found");
        }
    }

    /**
     * Connect Entrances, Exits, Outlets, and rooms based on World settings.
     */
    public function adjustEdges(): void
    {
        $world_id = $this->world->id;
        foreach ($this->definition['fixed'] as $connection) {
            $from = $this->world->graph->getVertex($connection[0] . ":$world_id");
            $to = $this->world->graph->getVertex($connection[1] . ":$world_id");
            if (
                !$from instanceof Vertex
                || !$to instanceof Vertex
            ) {
                dd($connection);
            }
            $this->world->graph->addDirected($from, $to, [
                'group' => "fixed:$world_id",
                'graphviz.label' => "fixed:$world_id",
            ]);
        }

        foreach ($this->definition['connections'] as $group) {
            $ins = fy_shuffle($group['in']);
            $outs = fy_shuffle($group['out']);
            if (count($ins) !== count($outs)) {
                throw new Exception("Entrance count mismatch");
            }

            while (count($ins)) {
                $in_items = Arr::wrap(array_pop($ins));
                $out_items = Arr::wrap(array_pop($outs));
                if (count($in_items) !== count($out_items)) {
                    throw new Exception("Entrance sub-count mismatch");
                }
                foreach ($in_items as $offset => $in) {
                    $out = $out_items[$offset];
                    $from = $this->world->graph->getVertex($in . ":$world_id");
                    $to = $this->world->graph->getVertex($out . ":$world_id");
                    $this->world->graph->addDirected($from, $to, [
                        'group' => "fixed:$world_id",
                        'graphviz.label' => "fixed:$world_id",
                    ]);
                }
            }
        }
    }
}
