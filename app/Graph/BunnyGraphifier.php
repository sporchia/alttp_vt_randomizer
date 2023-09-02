<?php

declare(strict_types=1);

namespace App\Graph;

use App\Graph\Vertex;
use SplObjectStorage;
use SplQueue;

/**
 * Modify the edges of the graph to deal with MoonPearl/Bunny state.
 */
final class BunnyGraphifier
{
    private const ITEM_MAP = [
        'L1Sword' => 'DarkL1Sword',
        'FireRod' => 'DarkFireRod',
        'IceRod' => 'DarkIceRod',
        'Hammer' => 'DarkHammer',
        'Hookshot' => 'DarkHookshot',
        'BowAndArrows' => 'DarkBowAndArrows',
        'Boomerang' => 'DarkBoomerang',
        'PegasusBoots' => 'DarkPegasusBoots',
        'Powder' => 'DarkPowder',
        'ActiveBombos' => 'DarkActiveBombos',
        'ActiveEther' => 'DarkActiveEther',
        'ActiveQuake' => 'DarkActiveQuake',
        'Lamp' => 'DarkLamp', // Lamp for seeing, Lamp for lighting, ??
        'Shovel' => 'DarkShovel',
        'OcarinaInactive' => 'DarkOcarinaInactive',
        'CaneOfSomaria' => 'DarkCaneOfSomaria',
        'CaneOfByrna' => 'DarkCaneOfByrna',
        'MirrorShield' => 'DarkMirrorShield',
        'Cape' => 'DarkCape',
        'PowerGlove' => 'DarkPowerGlove',
        'TitansMitt' => 'DarkTitansMitt',
        'Flippers' => 'DarkFlippers',
        'BugCatchingNet' => 'DarkBugCatchingNet',
        'RedBoomerang' => 'DarkRedBoomerang',
        'LiftBush' => 'DarkLiftBush',
        'LiftPot' => 'DarkLiftPot',
        'UseBomb' => 'DarkUseBomb',
        'OpenChest' => 'DarkOpenChest',
    ];

    /**
     * Add all the vertices to the graph for Bunny Dark world.
     *
     * @param World $world world to reduce graph for
     * 
     * @return void
     */
    public function __construct(private World $world)
    {
        $graph = $this->world->graph;

        $world_id = $world->id;
        $moonpearl = $graph->newVertex([
            'name' => "MoonPearl:$world_id",
            'type' => 'meta',
        ]);
        $meta = $graph->getVertex("Meta:$world_id");
        $graph->addDirected($meta, $moonpearl, "MoonPearl:$world_id");

        foreach (self::ITEM_MAP as $light_item => $dark_item) {
            $dark_vertex = $graph->newVertex([
                'name' => "$dark_item:$world_id",
                'type' => 'meta',
                'item' => Item::get("$dark_item", $world_id),
            ]);

            $this->world->graph->addDirected($moonpearl, $dark_vertex, "$light_item:$world_id");
        }
    }

    /**
     * Add edges for new dark items required based on dark world and moon pearl.
     */
    public function adjustEdges(): void
    {
        $work_queue = new SplQueue();
        $marked = new SplObjectStorage();
        $dark_nodes = array_filter(
            $this->world->graph->getVertices(),
            fn (Vertex $node) => $node->moonpearl
        );

        $edge_map = collect($this->world->graph->getEdges())
            ->groupBy(fn (Edge $edge) => $edge->from->id);

        foreach ($dark_nodes as $node) {
            $work_queue->enqueue($node);
        }

        while (!$work_queue->isEmpty()) {
            /** @var Vertex $node */
            $node = $work_queue->dequeue();

            if ($marked->contains($node)) {
                continue;
            }
            $marked->attach($node);

            if (!isset($edge_map[$node->id])) {
                continue;
            }
            /** @var Edge $edge */
            foreach ($edge_map[$node->id] as $edge) {
                $alt_node = $edge->to;
                if ($alt_node->moonpearl !== false) {
                    $work_queue->enqueue($alt_node);

                    $group = preg_replace('/:\d+$/', '', $edge->group);
                    if (!isset(static::ITEM_MAP[$group])) {
                        continue;
                    }

                    $edge->group = static::ITEM_MAP[$group] . ":" . $this->world->id;
                }
            }
        }
    }
}
