<?php namespace Randomizer\Region;

use Randomizer\Support\LocationCollection;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\World;

class Swords extends Region {
    public function __construct(World $world) {
        parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("Pyramid", 0x180028, $this),
			new Location("Blacksmiths", 0x3355C, $this),
			new Location("Alter", 0x289B0, $this),
		]);
	}
}
