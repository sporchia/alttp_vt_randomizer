<?php

declare(strict_types=1);

namespace App\Graph;

/**
 * Edge in Graph.
 */
final class Edge
{
    use Attributes;

    public readonly string $id;

    /**
     * Create new edge.
     * 
     * @param Vertex $from from vertex
     * @param Vertex $to to vertex
     * @param array $attributes any extra attributes on the edge
     * 
     * @return void
     */
    public function __construct(
        public readonly Vertex $from,
        public readonly Vertex $to,
        private array $attributes = [],
    ) {
        $this->id = spl_object_hash($this);
    }
}
