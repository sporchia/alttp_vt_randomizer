<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Region to hold the Sword Locations in the world
 */
class Swords extends Region {
	protected $name = "Swords";
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

	public function initNoMajorGlitches() {
		// @TODO: This logic is a little off, we need to account for beating AG1 and having Mirror
		$this->locations["Pyramid"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Crystal5') && $items->has('Crystal6')
				&& $items->has('Hammer');
		});

		$this->locations["Blacksmiths"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('North West Dark World')->canEnter($locations, $items) && $items->has('TitansMitt') && $items->has('MagicMirror');
		});

		$this->locations["Alter"]->setRequirements(function($locations, $items) {
			return $items->has('PendantOfPower')
				&& $items->has('PendantOfWisdom')
				&& $items->has('PendantOfCourage');
		});

		return $this;
	}
}
