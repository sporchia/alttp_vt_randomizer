<?php namespace ALttP\Region;

use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\World;

/**
 * Region to hold the Sword Locations in the world
 */
class Swords extends Region {
	/**
	 * Create a new Swords Region to hold sword locations.
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Standing("Pyramid", 0x180028, null, $this),
			new Location\Npc("Blacksmiths", 0x3355C, null, $this),
			new Location\Alter("Alter", 0x289B0, null, $this),
		]);
	}
}
