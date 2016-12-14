<?php namespace Randomizer\Region;

use Randomizer\Support\LocationCollection;
use Randomizer\Location\Pendant;
use Randomizer\Region;
use Randomizer\World;

class Pendants extends Region {
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Pendant("Eastern Palace Pendant", [0x545B8, 0x1209D, 0x53EF8, 0x48B7D], $this),
			new Pendant("Desert Palace Pendant", [0x545BA, 0x1209E, 0x53F1C, 0x48B7E], $this),
			new Pendant("Tower of Hera Pendant", [0x545B9, 0x120A5, 0x53F0A, 0x48B7F], $this),
		]);
	}
}
