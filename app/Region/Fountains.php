<?php namespace ALttP\Region;

use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Region to hold the Fairy Fountain prizes in the world
 */
class Fountains extends Region {
	/**
	 * Create a new Fountains to hold fountain prizes
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Fountain("Waterfall Bottle", 0x348FF, null, $this),
			new Location\Fountain("Pyramid Bottle", 0x3493B, null, $this),
		]);
	}
}
