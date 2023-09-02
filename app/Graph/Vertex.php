<?php

declare(strict_types=1);

namespace App\Graph;

use App\Sprite;

/**
 * Vertex in Graph.
 */
final class Vertex
{
    public readonly string $id;
    public readonly string $type;
    public readonly string $name;
    public readonly bool $switch;
    public ?int $cost = null;
    public ?Item $item = null;
    public readonly ?Item $trophy;
    public ?string $peg = null;
    public ?Sprite $sprite = null;
    public ?string $enemizerBoss = null;
    public readonly ?int $roomid;
    public readonly ?int $map;
    public readonly ?bool $moonpearl;
    public readonly array $itemset;
    public readonly ?array $addresses;
    public readonly ?int $offset;
    public readonly array|int|null $position;
    public readonly ?array $state;
    public readonly ?int $entranceid;
    public readonly ?int $outletid;
    public readonly ?int $inletid;
    public readonly ?array $entranceids;
    public readonly ?int $shopstyle;
    public readonly ?int $shopkeeper;
    public readonly ?int $group;

    public function __construct(
        array $attributes = []
    ) {
        $this->id = spl_object_hash($this);
        $this->switch = (bool) ($attributes['switch'] ?? false);
        $this->peg = $attributes['peg'] ?? null;
        $this->cost = $attributes['cost'] ?? null;
        $this->type = $attributes['type'] ?? 'unknown';
        $this->name = $attributes['name'] ?? $this->id;
        $this->sprite = !empty($attributes['sprite'])
            ? ($attributes['sprite'] instanceof Sprite
                ? $attributes['sprite']
                : Sprite::get($attributes['sprite']))
            : null;
        $this->item = $attributes['item'] ?? null;
        $this->trophy = $attributes['trophy'] ?? null;
        $this->roomid = $attributes['roomid'] ?? null;
        $this->map = $attributes['map'] ?? null;
        $this->moonpearl = $attributes['moonpearl'] ?? null;
        $this->itemset = $attributes['itemset'] ?? [];
        $this->addresses = $attributes['addresses'] ?? null;
        $this->offset = $attributes['offset'] ?? null;
        $this->position = $attributes['position'] ?? null;
        $this->state = $attributes['state'] ?? null;
        $this->entranceid = $attributes['entranceid'] ?? null;
        $this->outletid = $attributes['outletid'] ?? null;
        $this->inletid = $attributes['inletid'] ?? null;
        $this->entranceids = $attributes['entranceids'] ?? null;
        $this->shopstyle = $attributes['shopstyle'] ?? null;
        $this->shopkeeper = $attributes['shopkeeper'] ?? null;
        $this->group = $attributes['group'] ?? null;
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
