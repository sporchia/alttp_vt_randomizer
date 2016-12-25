<?php namespace ALttP\Region;

use ALttP\Location\Prize;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Region containing the 7 Crystals required to beat the game
 */
class Crystals extends Region {
	/**
	 * Create a new Crystals Region and generate all it's Locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Prize("Palace of Darkness Crystal", [null, 0x545D1, 0x120A1, 0x5452D, 0x180056, 0xC702], [0x5A], $this),
			new Prize("Swamp Palace Crystal", [null, 0x545D7, 0x120A0, 0x54527, 0x180055, 0xC701], [0x06], $this),
			new Prize("Skull Woods Crystal", [null, 0x545D2, 0x120A3, 0x5452C, 0x180058, 0xC704], [0x29], $this),
			new Prize("Thieves Town Crystal", [null, 0x545D4, 0x120A6, 0x5452A, 0x18005B, 0xC707], [0xAC], $this),
			new Prize("Ice Palace Crystal", [null, 0x545D6, 0x120A4, 0x54528, 0x180059, 0xC705], [0xDE], $this),
			new Prize("Misery Mire Crystal", [null, 0x545D5, 0x120A2, 0x54529, 0x180057, 0xC703], [0x90], $this),
			new Prize("Turtle Rock Crystal", [null, 0x545D3, 0x120A7, 0x5452B, 0x18005C, 0xC708], [0xA4], $this),
		]);
	}
}
