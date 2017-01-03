<?php namespace ALttP\Region;

use ALttP\Location\Prize;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Region containing the 7 Crystals required to beat the game
 *
 * @TODO: consider actually putting these locations directly on the regions they belong to.
 */
class Crystals extends Region {
	protected $name = 'Prize';

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
			new Prize("Palace of Darkness Crystal", [null, 0x120A1, 0x53F00, 0x53F01, 0x180056, 0x18007D, 0xC702], [0x5A], $this),
			new Prize("Swamp Palace Crystal", [null, 0x120A0, 0x53F6C, 0x53F6D, 0x180055, 0x180071, 0xC701], [0x06], $this),
			new Prize("Skull Woods Crystal", [null, 0x120A3, 0x53F12, 0x53F13, 0x180058, 0x18007B, 0xC704], [0x29], $this),
			new Prize("Thieves Town Crystal", [null, 0x120A6, 0x53F36, 0x53F37, 0x18005B, 0x180077, 0xC707], [0xAC], $this),
			new Prize("Ice Palace Crystal", [null, 0x120A4, 0x53F5A, 0x53F5B, 0x180059, 0x180073, 0xC705], [0xDE], $this),
			new Prize("Misery Mire Crystal", [null, 0x120A2, 0x53F48, 0x53F49, 0x180057, 0x180075, 0xC703], [0x90], $this),
			new Prize("Turtle Rock Crystal", [null, 0x120A7, 0x53F24, 0x53F25, 0x18005C, 0x180079, 0xC708], [0xA4], $this),
		]);
	}
}
