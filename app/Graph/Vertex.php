<?php

declare(strict_types=1);

namespace App\Graph;

/**
 * Vertex in Graph.
 */
final class Vertex
{
    use Attributes;

    public readonly string $id;
    public readonly string $type;
    public readonly string $name;
    public ?Item $item = null;
    public ?Item $trophy = null;
    public bool $switch = false;
    public ?string $peg = null;

    /**
     * Create new Vertex.
     * 
     * @param array $attributes any extra attributes on the vertex
     * 
     * @return void
     */
    public function __construct(private array $attributes = [])
    {
        $this->id = spl_object_hash($this);
        foreach ($attributes as $key => $value) {
            switch ($key) {
                case 'switch':
                    $this->switch = (bool) $value;
                    break;
                case 'peg':
                    $this->peg = $value;
                    break;
                case 'type':
                    $this->type = $value;
                    break;
                case 'name':
                    $this->name = $value;
                    break;
            }
        }
    }

    /**
     * String representation of vertex, required for array_diff comparison.
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->id;
    }
}
