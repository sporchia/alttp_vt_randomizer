<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location\Prize;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Region to hold the Pendant prizes in the world
 *
 * @TODO: consider actually putting these locations directly on the regions they belong to.
 */
class Pendants extends Region {
	protected $name = 'Prize';

	/**
	 * Create a new Pendants Region to hold pendant drop locations.
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Prize("Eastern Palace Pendant", [null, 0x1209D, 0x53EF8, 0x53EF9, 0x180052, 0x18007C, 0xC6FE], null, $this),
			new Prize("Desert Palace Pendant", [null, 0x1209E, 0x53F1C, 0x53F1D, 0x180053, 0x180078, 0xC6FF], null, $this),
			new Prize("Tower of Hera Pendant", [null, 0x120A5, 0x53F0A, 0x53F0B, 0x18005A, 0x18007A, 0xC706], null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Eastern Palace Pendant"]->setItem(Item::get('PendantOfCourage'));
		$this->locations["Desert Palace Pendant"]->setItem(Item::get('PendantOfWisdom'));
		$this->locations["Tower of Hera Pendant"]->setItem(Item::get('PendantOfPower'));

		return $this;
	}
}
