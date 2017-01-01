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
	private $fail_sword_checks = false;
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
		$this->locations["Pyramid"]->setRequirements(function($locations, $items) {
			$c5 = Item::get('Crystal5');
			$c6 = Item::get('Crystal6');

			$p1 = ($this->world->getRegion('Eastern Palace')->hasPrize($c5)
					|| $this->world->getRegion('Eastern Palace')->hasPrize($c6))
				&& $this->world->getRegion('Eastern Palace')->canComplete($locations, $items) ? 1 : 0;
			$p2 = ($this->world->getRegion('Desert Palace')->hasPrize($c5)
					|| $this->world->getRegion('Desert Palace')->hasPrize($c6))
				&& $this->world->getRegion('Desert Palace')->canComplete($locations, $items) ? 1 : 0;
			$p3 = ($this->world->getRegion('Tower of Hera')->hasPrize($c5)
					|| $this->world->getRegion('Tower of Hera')->hasPrize($c6))
				&& $this->world->getRegion('Tower of Hera')->canComplete($locations, $items) ? 1 : 0;
			$d1 = ($this->world->getRegion('Palace of Darkness')->hasPrize($c5)
					|| $this->world->getRegion('Palace of Darkness')->hasPrize($c6))
				&& $this->world->getRegion('Palace of Darkness')->canComplete($locations, $items) ? 1 : 0;
			$d2 = ($this->world->getRegion('Swamp Palace')->hasPrize($c5)
					|| $this->world->getRegion('Swamp Palace')->hasPrize($c6))
				&& $this->world->getRegion('Swamp Palace')->canComplete($locations, $items) ? 1 : 0;
			$d3 = ($this->world->getRegion('Skull Woods')->hasPrize($c5)
					|| $this->world->getRegion('Skull Woods')->hasPrize($c6))
				&& $this->world->getRegion('Skull Woods')->canComplete($locations, $items) ? 1 : 0;
			$d4 = ($this->world->getRegion('Thieves Town')->hasPrize($c5)
					|| $this->world->getRegion('Thieves Town')->hasPrize($c6))
				&& $this->world->getRegion('Thieves Town')->canComplete($locations, $items) ? 1 : 0;
			$d5 = ($this->world->getRegion('Ice Palace')->hasPrize($c5)
					|| $this->world->getRegion('Ice Palace')->hasPrize($c6))
				&& $this->world->getRegion('Ice Palace')->canComplete($locations, $items) ? 1 : 0;
			$d6 = ($this->world->getRegion('Misery Mire')->hasPrize($c5)
					|| $this->world->getRegion('Misery Mire')->hasPrize($c6))
				&& $this->world->getRegion('Misery Mire')->canComplete($locations, $items) ? 1 : 0;
			$d7 = ($this->world->getRegion('Turtle Rock')->hasPrize($c5)
					|| $this->world->getRegion('Turtle Rock')->hasPrize($c6))
				&& $this->world->getRegion('Turtle Rock')->canComplete($locations, $items) ? 1 : 0;

			$this->fail_sword_checks = false;
			return $p1 + $p2 + $p3 + $d1 + $d2 + $d3 + $d4 + $d5 + $d6 + $d7 == 2;
		});

		// this can infinite loop
		$this->locations["Blacksmiths"]->setRequirements(function($locations, $items) {
			$access = $this->world->getRegion('North West Dark World')->canEnter($locations, $items) && $items->has('TitansMitt') && $items->has('MagicMirror');

			$this->fail_sword_checks = false;
			return $access;
		});

		$this->locations["Alter"]->setRequirements(function($locations, $items) {
			$c1 = Item::get('PendantOfCourage');
			$c2 = Item::get('PendantOfWisdom');
			$c3 = Item::get('PendantOfPower');

			$p1 = ($this->world->getRegion('Eastern Palace')->hasPrize($c1)
					|| $this->world->getRegion('Eastern Palace')->hasPrize($c2)
					|| $this->world->getRegion('Eastern Palace')->hasPrize($c3))
				&& $this->world->getRegion('Eastern Palace')->canComplete($locations, $items) ? 1 : 0;
			$p2 = ($this->world->getRegion('Desert Palace')->hasPrize($c1)
					|| $this->world->getRegion('Desert Palace')->hasPrize($c2)
					|| $this->world->getRegion('Desert Palace')->hasPrize($c3))
				&& $this->world->getRegion('Desert Palace')->canComplete($locations, $items) ? 1 : 0;
			$p3 = ($this->world->getRegion('Tower of Hera')->hasPrize($c1)
					|| $this->world->getRegion('Tower of Hera')->hasPrize($c2)
					|| $this->world->getRegion('Tower of Hera')->hasPrize($c3))
				&& $this->world->getRegion('Tower of Hera')->canComplete($locations, $items) ? 1 : 0;
			$d1 = ($this->world->getRegion('Palace of Darkness')->hasPrize($c1)
					|| $this->world->getRegion('Palace of Darkness')->hasPrize($c2)
					|| $this->world->getRegion('Palace of Darkness')->hasPrize($c3))
				&& $this->world->getRegion('Palace of Darkness')->canComplete($locations, $items) ? 1 : 0;
			$d2 = ($this->world->getRegion('Swamp Palace')->hasPrize($c1)
					|| $this->world->getRegion('Swamp Palace')->hasPrize($c2)
					|| $this->world->getRegion('Swamp Palace')->hasPrize($c3))
				&& $this->world->getRegion('Swamp Palace')->canComplete($locations, $items) ? 1 : 0;
			$d3 = ($this->world->getRegion('Skull Woods')->hasPrize($c1)
					|| $this->world->getRegion('Skull Woods')->hasPrize($c2)
					|| $this->world->getRegion('Skull Woods')->hasPrize($c3))
				&& $this->world->getRegion('Skull Woods')->canComplete($locations, $items) ? 1 : 0;
			$d4 = ($this->world->getRegion('Thieves Town')->hasPrize($c1)
					|| $this->world->getRegion('Thieves Town')->hasPrize($c2)
					|| $this->world->getRegion('Thieves Town')->hasPrize($c3))
				&& $this->world->getRegion('Thieves Town')->canComplete($locations, $items) ? 1 : 0;
			$d5 = ($this->world->getRegion('Ice Palace')->hasPrize($c1)
					|| $this->world->getRegion('Ice Palace')->hasPrize($c2)
					|| $this->world->getRegion('Ice Palace')->hasPrize($c3))
				&& $this->world->getRegion('Ice Palace')->canComplete($locations, $items) ? 1 : 0;
			$d6 = ($this->world->getRegion('Misery Mire')->hasPrize($c1)
					|| $this->world->getRegion('Misery Mire')->hasPrize($c2)
					|| $this->world->getRegion('Misery Mire')->hasPrize($c3))
				&& $this->world->getRegion('Misery Mire')->canComplete($locations, $items) ? 1 : 0;
			$d7 = ($this->world->getRegion('Turtle Rock')->hasPrize($c1)
					|| $this->world->getRegion('Turtle Rock')->hasPrize($c2)
					|| $this->world->getRegion('Turtle Rock')->hasPrize($c3))
				&& $this->world->getRegion('Turtle Rock')->canComplete($locations, $items) ? 1 : 0;

			$this->fail_sword_checks = false;
			return $p1 + $p2 + $p3 + $d1 + $d2 + $d3 + $d4 + $d5 + $d6 + $d7 == 3;
		});

		$this->can_enter = function($locations, $items) {
			if ($this->fail_sword_checks) {
				return false;
			}

			$this->fail_sword_checks = true;
			return true;
		};

		return $this;
	}
}
