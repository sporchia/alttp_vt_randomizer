<?php

namespace App\Drops;

/**
 * A Prize Pack is a set of droppable sprites that can drop from killed enemies
 * or other means.
 */
class PrizePack
{
    protected $drops = [];
    public $name;

    /**
     * Constructor for PrizePack class.
     *
     * @param string $name the name of the Prize Pack
     * @param int $slots the number of slots the Prize Pack has
     *
     * @return void
     */
    public function __construct(string $name, int $slots)
    {
        $this->name = $name;
        for ($i = 0; $i < $slots; $i++) {
            $this->drops[] = new PrizePackSlot();
        }
    }

    /**
     * Gets the name of the Prize Pack.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the Prize Pack Slots within the prize pack.
     *
     * @return array
     */
    public function getDrops(): array
    {
        return $this->drops;
    }

    /**
     * Gets the Prize Pack Slots within the prize pack that are not filled.
     *
     * @return array
     */
    public function getEmptyDrops(): array
    {
        return array_filter($this->drops, function ($slot) {
            return !$slot->isFilled();
        }) ?? [];
    }
}
