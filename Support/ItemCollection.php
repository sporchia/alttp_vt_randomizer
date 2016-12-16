<?php namespace Randomizer\Support;

use Randomizer\Item;
use Randomizer\World;

class ItemCollection extends Collection {
	protected $world;
	protected $no_upgrade_sword_check = false;

	public function setWorld(World $world) {
		$this->world = $world;
	}

	public function addItem(Item $item) {
		$this->offsetSet($item->getName(), $item);
	}

	public function tempAdd(Item $item) {
		$new = new static(array_merge($this->items, [$item]));
		$new->setWorld($this->world);
		return $new;
	}

	public function canLiftRocks() {
		return $this->has("PowerGlove") || $this->has("TitansMitt");
	}

	public function canLightTorches() {
		return $this->has('FireRod') || $this->has('Lamp');
	}

	public function canMeltThings() {
		return $this->has('FireRod') || $this->has('Bombos');
	}

	public function canFly() {
		return $this->has('OcarinaActive') || $this->has('OcarinaInactive');
	}

	public function canShootArrows() {
		return $this->has('Bow')
			|| $this->has('BowAndArrows')
			|| $this->has('BowAndSilverArrows');
	}

	public function canAccessNorthWestDarkWorld() {
		return ($this->canAccessPyramid()
			&& ($this->has('Hookshot')
				&& ($this->has('Hammer')
					|| $this->canLiftRocks()
					|| $this->has('Flippers')))
			|| ($this->has('Hammer')
				&& $this->canLiftRocks())
			|| $this->has("TitansMitt"))
		&& $this->has('MoonPearl');
	}

	public function canAccessSouthDarkWorld() {
		return $this->has('MoonPearl')
			&& (($this->canDefeatAgahnim1() && ($this->has('Hammer')
				|| ($this->has('Hookshot') && ($this->has('Flippers') || $this->canLiftRocks()))))
				|| ($this->has('Hammer') && $this->canLiftRocks())
				|| $this->has('TitansMitt'));
	}

	public function canAccessPyramid() {
		return $this->canDefeatAgahnim1()
			|| ($this->has('Hammer') && $this->canLiftRocks() && $this->has('MoonPearl'))
			|| ($this->has("TitansMitt") && $this->has('Flippers') && $this->has('MoonPearl'));
	}

	public function canAccessWestDeathMountain() {
		return $this->canFly() || $this->canLiftRocks();
	}

	public function canAccessEastDeathMountain() {
		return $this->canAccessWestDeathMountain()
			&& (($this->has('Hammer') && $this->has('MagicMirror'))
			|| $this->has('Hookshot'));
	}

	public function canDefeatAgahnim1() {
		return $this->has('Cape') || (!$this->no_upgrade_sword_check && $this->canUpgradeSword());
	}

	public function canUpgradeSword() {
		$locations = $this->world->getLocations();
		$this->no_upgrade_sword_check = true;

		$c5 = Item::get('Crystal5');
		$c6 = Item::get('Crystal6');

		$p1 = ($this->world->getRegion('Eastern Palace')->hasPrize($c5)
				|| $this->world->getRegion('Eastern Palace')->hasPrize($c6))
			&& $this->world->getRegion('Eastern Palace')->canComplete($locations, $this) ? 1 : 0;
		$p2 = ($this->world->getRegion('Desert Palace')->hasPrize($c5)
				|| $this->world->getRegion('Desert Palace')->hasPrize($c6))
			&& $this->world->getRegion('Desert Palace')->canComplete($locations, $this) ? 1 : 0;
		$p3 = ($this->world->getRegion('Tower of Hera')->hasPrize($c5)
				|| $this->world->getRegion('Tower of Hera')->hasPrize($c6))
			&& $this->world->getRegion('Tower of Hera')->canComplete($locations, $this) ? 1 : 0;
		$d1 = ($this->world->getRegion('Palace of Darkness')->hasPrize($c5)
				|| $this->world->getRegion('Palace of Darkness')->hasPrize($c6))
			&& $this->world->getRegion('Palace of Darkness')->canComplete($locations, $this) ? 1 : 0;
		$d2 = ($this->world->getRegion('Swamp Palace')->hasPrize($c5)
				|| $this->world->getRegion('Swamp Palace')->hasPrize($c6))
			&& $this->world->getRegion('Swamp Palace')->canComplete($locations, $this) ? 1 : 0;
		$d3 = ($this->world->getRegion('Skull Woods')->hasPrize($c5)
				|| $this->world->getRegion('Skull Woods')->hasPrize($c6))
			&& $this->world->getRegion('Skull Woods')->canComplete($locations, $this) ? 1 : 0;
		$d4 = ($this->world->getRegion('Thieves Town')->hasPrize($c5)
				|| $this->world->getRegion('Thieves Town')->hasPrize($c6))
			&& $this->world->getRegion('Thieves Town')->canComplete($locations, $this) ? 1 : 0;
		$d5 = ($this->world->getRegion('Ice Palace')->hasPrize($c5)
				|| $this->world->getRegion('Ice Palace')->hasPrize($c6))
			&& $this->world->getRegion('Ice Palace')->canComplete($locations, $this) ? 1 : 0;
		$d6 = ($this->world->getRegion('Misery Mire')->hasPrize($c5)
				|| $this->world->getRegion('Misery Mire')->hasPrize($c6))
			&& $this->world->getRegion('Misery Mire')->canComplete($locations, $this) ? 1 : 0;
		$d7 = ($this->world->getRegion('Turtle Rock')->hasPrize($c5)
				|| $this->world->getRegion('Turtle Rock')->hasPrize($c6))
			&& $this->world->getRegion('Turtle Rock')->canComplete($locations, $this) ? 1 : 0;

		$can_upgrade = ($this->canCollectPendants())
			|| ($this->canAccessNorthWestDarkWorld() && $this->has('TitansMitt') && $this->has('MagicMirror'))
			|| ($p1 + $p2 + $p3 + $d1 + $d2 + $d3 + $d4 + $d5 + $d6 + $d7 == 2);

		$this->no_upgrade_sword_check = false;

		return $can_upgrade;
	}

	public function canCollectPendants() {
		$locations = $this->world->getLocations();

		$c1 = Item::get('PendantOfCourage');
		$c2 = Item::get('PendantOfWisdom');
		$c3 = Item::get('PendantOfPower');

		$p1 = ($this->world->getRegion('Eastern Palace')->hasPrize($c1)
				|| $this->world->getRegion('Eastern Palace')->hasPrize($c2)
				|| $this->world->getRegion('Eastern Palace')->hasPrize($c3))
			&& $this->world->getRegion('Eastern Palace')->canComplete($locations, $this) ? 1 : 0;
		$p2 = ($this->world->getRegion('Desert Palace')->hasPrize($c1)
				|| $this->world->getRegion('Desert Palace')->hasPrize($c2)
				|| $this->world->getRegion('Desert Palace')->hasPrize($c3))
			&& $this->world->getRegion('Desert Palace')->canComplete($locations, $this) ? 1 : 0;
		$p3 = ($this->world->getRegion('Tower of Hera')->hasPrize($c1)
				|| $this->world->getRegion('Tower of Hera')->hasPrize($c2)
				|| $this->world->getRegion('Tower of Hera')->hasPrize($c3))
			&& $this->world->getRegion('Tower of Hera')->canComplete($locations, $this) ? 1 : 0;
		$d1 = ($this->world->getRegion('Palace of Darkness')->hasPrize($c1)
				|| $this->world->getRegion('Palace of Darkness')->hasPrize($c2)
				|| $this->world->getRegion('Palace of Darkness')->hasPrize($c3))
			&& $this->world->getRegion('Palace of Darkness')->canComplete($locations, $this) ? 1 : 0;
		$d2 = ($this->world->getRegion('Swamp Palace')->hasPrize($c1)
				|| $this->world->getRegion('Swamp Palace')->hasPrize($c2)
				|| $this->world->getRegion('Swamp Palace')->hasPrize($c3))
			&& $this->world->getRegion('Swamp Palace')->canComplete($locations, $this) ? 1 : 0;
		$d3 = ($this->world->getRegion('Skull Woods')->hasPrize($c1)
				|| $this->world->getRegion('Skull Woods')->hasPrize($c2)
				|| $this->world->getRegion('Skull Woods')->hasPrize($c3))
			&& $this->world->getRegion('Skull Woods')->canComplete($locations, $this) ? 1 : 0;
		$d4 = ($this->world->getRegion('Thieves Town')->hasPrize($c1)
				|| $this->world->getRegion('Thieves Town')->hasPrize($c2)
				|| $this->world->getRegion('Thieves Town')->hasPrize($c3))
			&& $this->world->getRegion('Thieves Town')->canComplete($locations, $this) ? 1 : 0;
		$d5 = ($this->world->getRegion('Ice Palace')->hasPrize($c1)
				|| $this->world->getRegion('Ice Palace')->hasPrize($c2)
				|| $this->world->getRegion('Ice Palace')->hasPrize($c3))
			&& $this->world->getRegion('Ice Palace')->canComplete($locations, $this) ? 1 : 0;
		$d6 = ($this->world->getRegion('Misery Mire')->hasPrize($c1)
				|| $this->world->getRegion('Misery Mire')->hasPrize($c2)
				|| $this->world->getRegion('Misery Mire')->hasPrize($c3))
			&& $this->world->getRegion('Misery Mire')->canComplete($locations, $this) ? 1 : 0;
		$d7 = ($this->world->getRegion('Turtle Rock')->hasPrize($c1)
				|| $this->world->getRegion('Turtle Rock')->hasPrize($c2)
				|| $this->world->getRegion('Turtle Rock')->hasPrize($c3))
			&& $this->world->getRegion('Turtle Rock')->canComplete($locations, $this) ? 1 : 0;

		return $p1 + $p2 + $p3 + $d1 + $d2 + $d3 + $d4 + $d5 + $d6 + $d7 == 3;
	}

	public function hasABottle() {
		return $this->has('BottleWithBee')
			|| $this->has('BottleWithFairy')
			|| $this->has('BottleWithRedPotion')
			|| $this->has('BottleWithGreenPotion')
			|| $this->has('BottleWithBluePotion')
			|| $this->has('Bottle')
			|| $this->has('BottleWithGoldBee');
	}
}
