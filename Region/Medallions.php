<?php namespace Randomizer\Region;

use Randomizer\Support\LocationCollection;
use Randomizer\Location\Medallion;
use Randomizer\Region;
use Randomizer\Item;
use Randomizer\World;

class Medallions extends Region {
    public function __construct(World $world) {
        parent::__construct($world);

        // We need to set defaults on these so the Base Fill logic doesn't vomit
        $this->locations = new LocationCollection([
            (new Medallion("Turtle Rock Medallion", [0x180023, 't0' => 0x5020, 't1' => 0x50FF, 't2' => 0x51DE], $this))->setItem(Item::get('Quake')),
            (new Medallion("Misery Mire Medallion", [0x180022, 'm0' => 0x4FF2, 'm1' => 0x50D1, 'm2' => 0x51B0], $this))->setItem(Item::get('Ether')),
        ]);
    }
}
