<?php

declare(strict_types=1);

namespace App\Graph;

use Illuminate\Support\Arr;
use SplQueue;

/**
 * Matrix backed graph. Instead of using a full graph library, this is an
 * attempt at one that is more tuned to our needs. We only allow additions to
 * the graph, so there is no need to consider removal of edges/vertices. And all
 * edges must be directed!
 */
final class Graph
{
    use Attributes;

    private array $vertices = [];
    private array $vertices_name = [];
    private array $visited = [];
    private array $adjency_matrix = [];
    private array $edges = [];
    private array $marked = [];
    private array $peg_marked = [];
    private array $items = [];
    private array $recheck_nodes = [];

    /**
     * Create new Graph.
     * 
     * @param array $attributes any extra attributes on the graph
     * 
     * @return void
     */
    public function __construct(private array $attributes = [])
    {
        //
    }

    /**
     * Get the Vertices in the Graph.
     */
    public function getVertices(): array
    {
        return $this->vertices;
    }

    /**
     * Get a Vertex by name in the Graph.
     * 
     * @param string $name name of vertex to search for
     */
    public function getVertex(string $name): ?Vertex
    {
        return $this->vertices_name[$name] ?? null;
    }

    /**
     * Get the Edges in the Graph.
     */
    public function getEdges(): array
    {
        return $this->edges;
    }

    /**
     * Get the Items found is last search of the Graph.
     * 
     * @param Vertex $start where the search was started from
     * @param callable $filter if we should filter the items
     */
    public function getItems(Vertex $start, callable $filter = null): array
    {
        $items = [];
        $filtering = $filter === null;
        foreach ($this->visited[$start->id] as $vertex) {
            if ($vertex->item && ($filtering || $filter($vertex->item))) {
                $items[$vertex->id] = $vertex->item;
            }
            if ($vertex->trophy && ($filtering || $filter($vertex->trophy))) {
                $items["{$vertex->id}-trophy"] = $vertex->trophy;
            }
        }

        return $items;
    }

    /**
     * Create a new Vertex in this Graph.
     *
     * @param mixed[] $attributes attributes for the vertex
     */
    public function newVertex(array $attributes = []): Vertex
    {
        $vertex = new Vertex($attributes);

        $this->addVertex($vertex);

        return $vertex;
    }

    /**
     * Add vertex to graph.
     * 
     * @param Vertex $vertex Vertex to add to graph
     */
    public function addVertex(Vertex $vertex): void
    {
        $this->vertices[$vertex->id] = $vertex;
        $this->vertices_name[$vertex->getAttribute('name', $vertex->id)] = $vertex;
        $this->adjency_matrix[$vertex->id] = [];
    }

    public function getTargetVertex(Vertex $vertex): ?Vertex
    {
        return Arr::first($this->adjency_matrix[$vertex->id]);
    }

    public function getTargets(Vertex $vertex): array
    {
        return $this->adjency_matrix[$vertex->id] ?? [];
    }

    /**
     * Create a new Directed Edge in the graph.
     * 
     * @param Vertex $from from vertex
     * @param Vertex $to to vertex
     * @param array $attributes any extra attributes on the edge
     */
    public function addDirected(Vertex $from, Vertex $to, array $attributes = []): Edge
    {
        $edge = new Edge($from, $to, $attributes);

        $this->addEdge($edge);

        return $edge;
    }

    /**
     * Add already constructed Edge to graph, this will also add the related
     * Vertices to the graph if they aren't there already.
     * 
     * @param Edge $edge Edge to add
     */
    public function addEdge(Edge $edge): void
    {
        if (!isset($this->vertices[$edge->from->id])) {
            $this->addVertex($edge->from);
        }

        if (!isset($this->vertices[$edge->to->id])) {
            $this->addVertex($edge->to);
        }

        $this->adjency_matrix[$edge->from->id][$edge->to->id] = $edge->to;
        $this->edges[$edge->id] = $edge;
    }

    /**
     * Get a subgraph of the graph filtering on given edge group. Used to split
     * the graph up by item requirements.
     * 
     * @param string $group name of group
     */
    public function getSubgraph(string $group): Graph
    {
        $new = new static($this->attributes);

        foreach ($this->edges as $edge) {
            if ($edge->getAttribute('group') !== $group) {
                continue;
            }

            $new->addEdge($edge);
        }

        return $new;
    }

    /**
     * Merge this graph with a variable amount of other graphs and return new
     * Graph.
     *
     * @param Graph ...$graphs graphs to merge
     */
    public function merge(Graph ...$graphs): Graph
    {
        $new = clone $this;

        foreach ($graphs as $graph) {
            foreach ($graph->edges as $eid => $edge) {
                if (isset($new->edges[$eid])) {
                    continue;
                }

                $new->addEdge($edge);
                $new->recheck_nodes[$edge->from->id] = $edge->from;
            }
        }

        return $new;
    }

    /**
     * Get new graph with certain edge groups excluded.
     * 
     * @param string ...$groups edge groups to exclude
     */
    public function exclude(string ...$groups): Graph
    {
        $new = new static($this->attributes);

        foreach ($this->edges as $edge) {
            if (in_array($edge->getAttribute('group'), $groups)) {
                continue;
            }

            $new->addEdge($edge);
        }

        return $new;
    }

    /**
     * Get all vertices that were visited in a given search (which has been
     * called first) from a set starting point.
     *
     * @param Vertex $start vertex where search was started from
     */
    public function getVisited(Vertex $start): array
    {
        return $this->visited[$start->id] ?? [];
    }

    /**
     * Perform a search of reachable Vertices from a given start. This is really
     * meat an potatoes of the whole class... I'm sure you were expecting good
     * documentation. Eventually my friend, eventually.
     *
     * @param Vertex $start vertex to start search from
     */
    public function search(Vertex $start): array
    {
        if (!isset($this->vertices[$start->id])) {
            return [];
        }

        if (!isset($this->visited[$start->id])) {
            $this->visited[$start->id] = [$start->id => $start];
            $this->peg_marked[$start->id] = [];
            $this->marked[$start->id] = [$start->id => $start];
        }
        $queue = new SplQueue();
        $peg_queue = new SplQueue();
        $queue->enqueue($start);
        foreach ($this->marked[$start->id] as $vertex) {
            isset($this->recheck_nodes[$vertex->id]) && $queue->enqueue($vertex);
        }
        foreach ($this->peg_marked[$start->id] as $vertex) {
            isset($this->recheck_nodes[$vertex->id]) && $peg_queue->enqueue($vertex);
        }
        $this->recheck_nodes = [];

        do {
            while (!$peg_queue->isEmpty()) {
                $vertex = $peg_queue->dequeue();

                if ($vertex->switch) {
                    if (!isset($this->marked[$start->id][$vertex->id])) {
                        $queue->enqueue($vertex);
                    }
                }
                if ($vertex->peg === 'orange') {
                    continue;
                }
                foreach ($this->adjency_matrix[$vertex->id] as $next_vertex) {
                    if (!isset($this->peg_marked[$start->id][$next_vertex->id])) {
                        $peg_queue->enqueue($next_vertex);
                    }
                }
                $this->visited[$start->id][$vertex->id] = $vertex;
                $this->peg_marked[$start->id][$vertex->id] = $vertex;
            }

            while (!$queue->isEmpty()) {
                $vertex = $queue->dequeue();

                if ($vertex->switch) {
                    if (!isset($this->peg_marked[$start->id][$vertex->id])) {
                        $peg_queue->enqueue($vertex);
                    }
                }
                if ($vertex->peg === 'blue') {
                    continue;
                }
                foreach ($this->adjency_matrix[$vertex->id] as $next_vertex) {
                    if (!isset($this->marked[$start->id][$next_vertex->id])) {
                        $queue->enqueue($next_vertex);
                    }
                }
                $this->visited[$start->id][$vertex->id] = $vertex;
                $this->marked[$start->id][$vertex->id] = $vertex;
            }
        } while (!$queue->isEmpty() || !$peg_queue->isEmpty());

        return $this->visited[$start->id];
    }

    /**
     * Create a new graph based on previous search.
     * 
     * @todo not used, consider removal?
     * 
     * @param Vertex $start vertex where search was started from
     */
    public function newFromSearch(Vertex $start): Graph
    {
        $found = $this->search($start);
        $new = new static;

        foreach ($found as $vertex) {
            $new->addVertex($vertex);
        }

        foreach ($this->edges as $edge) {
            if (isset($found[$edge->from->id]) && isset($found[$edge->to->id])) {
                $new->adjency_matrix[$edge->from->id][$edge->to->id] = $edge->to;
                $new->edges[$edge->id] = $edge;
            }
        }

        return $new;
    }

    /**
     * Grouped: count total number of different groups assigned to vertices.
     */
    public function getNumberOfGroups(): int
    {
        return count($this->getGroups());
    }

    /**
     * Grouped: get array of all group numbers.
     */
    public function getGroups(): array
    {
        $groups = [];

        foreach ($this->vertices as $vertex) {
            $groups[(int) $vertex->getAttribute('group')] = true;
        }

        return array_keys($groups);
    }

    /**
     * Grouped: get set of all Vertices in the given group.
     *
     * @param int $group group id to return Vertices from
     */
    public function getVerticesGroup(int $group): array
    {
        return array_filter($this->vertices, static function ($vertex) use ($group) {
            return $vertex->getAttribute('group') === $group;
        });
    }
}
