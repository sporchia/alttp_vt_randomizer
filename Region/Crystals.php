<?php namespace Randomizer\Region;

use Randomizer\Location\Crystal;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class Crystals extends Region {
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Crystal("Palace of Darkness Crystal", [0x545D1, 0x120A1, 0x5452D], $this),
			new Crystal("Swamp Palace Crystal", [0x545D7, 0x120A0, 0x54527], $this),
			new Crystal("Skull Woods Crystal", [0x545D2, 0x120A3, 0x5452C], $this),
			new Crystal("Thieves Town Crystal", [0x545D4, 0x120A6, 0x5452A], $this),
			new Crystal("Ice Palace Crystal", [0x545D6, 0x120A4, 0x54528], $this),
			new Crystal("Misery Mire Crystal", [0x545D5, 0x120A2, 0x54529], $this),
			new Crystal("Turtle Rock Crystal", [0x545D3, 0x120A7, 0x5452B], $this),
		]);
	}
}
