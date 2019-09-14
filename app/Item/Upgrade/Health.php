<?php

namespace ALttP\Item\Upgrade;

use ALttP\Item;
use ALttP\World;

/**
 * Health Capacity type Item
 */
class Health extends Item
{
    public $power = 1;

    /**
     * Create a new Item
     *
     * @param string       $name  Unique name of item
     * @param array        $bytes data to write to Location addresses
     * @param \ALttP\World $world world for which the item belongs
     * @param float        $power effectiveness of upgrade
     *
     * @return void
     */
    public function __construct(string $name, array $bytes, World $world, float $power)
    {
        parent::__construct($name, $bytes, $world);

        $this->power = $power;
    }
}
