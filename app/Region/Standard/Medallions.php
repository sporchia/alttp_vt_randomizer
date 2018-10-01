<?php namespace ALttP\Region\Standard;

use ALttP\Item;
use ALttP\Location\Medallion;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Region to hold the Medallion Entry Locations in the world
 */
class Medallions extends Region {
	protected $name = 'Special';

	/**
	 * Create a new Medallions Region to hold sword locations.
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Medallion("Turtle Rock Medallion", [null, 0x180023, 't0' => 0x5020, 't1' => 0x50FF, 't2' => 0x51DE], null, $this),
			new Medallion("Misery Mire Medallion", [null, 0x180022, 'm0' => 0x4FF2, 'm1' => 0x50D1, 'm2' => 0x51B0], null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Turtle Rock Medallion"]->setItem(Item::get('Quake'));
		$this->locations["Misery Mire Medallion"]->setItem(Item::get('Ether'));

		return $this;
	}
}
