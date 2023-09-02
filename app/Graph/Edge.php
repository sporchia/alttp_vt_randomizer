<?php

declare(strict_types=1);

namespace App\Graph;

/**
 * Edge in Graph.
 */
final class Edge
{
    public readonly string $id;

    public function __construct(
        public readonly Vertex $from,
        public readonly Vertex $to,
        public string $group,
    ) {
        $this->id = spl_object_hash($this);
    }
}
