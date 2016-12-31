<?php namespace ALttP\Support;

use ALttP\Item;
use ALttP\World;

/**
 * Collection of Items
 */
class ItemCollection extends Collection {
	protected $world;
	protected $no_upgrade_sword_check = false;

	/**
	 * Create a new collection.
	 *
	 * @param mixed $items
	 *
	 * @return void
	 */
	public function __construct($items = []) {
		foreach ($this->getArrayableItems($items) as $item) {
			$this->addItem($item);
		}
	}

	/**
	 * Set the World in which these Items reside
	 * @TODO: this was a sort of hack for some of the restriction functions, I think those should be moved to
	 * new Regions, and only have the functions that don't rely on a world in here.
	 *
	 * @param World $world World this item collection belongs to
	 *
	 * @return $this
	 */
	public function setWorld(World $world) {
		$this->world = $world;
		return $this;
	}

	/**
	 * Add an Item to this Collection
	 *
	 * @param Item $item
	 *
	 * @return $this
	 */
	public function addItem(Item $item) {
		$this->offsetSet($item->getName(), $item);
		return $this;
	}

	/**
	 * Add an Item to a copy of this Collection
	 *
	 * @param Item $item
	 *
	 * @return static
	 */
	public function tempAdd(Item $item) {
		$new = new static(array_merge($this->items, [$item]));
		$new->setWorld($this->world);
		return $new;
	}

	/**
	 * Requirements for lifting rocks
	 *
	 * @return bool
	 */
	public function canLiftRocks() {
		return $this->has("PowerGlove") || $this->has("TitansMitt");
	}

	/**
	 * Requirements for lighting torches
	 *
	 * @return bool
	 */
	public function canLightTorches() {
		return $this->has('FireRod') || $this->has('Lamp');
	}

	/**
	 * Requirements for melting things, like ice statues
	 *
	 * @return bool
	 */
	public function canMeltThings() {
		return $this->has('FireRod') || $this->has('Bombos');
	}

	/**
	 * Requirements for fast travel through the duck
	 *
	 * @return bool
	 */
	public function canFly() {
		return $this->has('OcarinaActive') || $this->has('OcarinaInactive');
	}

	/**
	 * Requirements for lobbing arrows at things
	 *
	 * @return bool
	 */
	public function canShootArrows() {
		return $this->has('Bow')
			|| $this->has('BowAndArrows')
			|| $this->has('BowAndSilverArrows');
	}

	/**
	 * Requirements for accessing the NW DW.
	 * @TODO: consider moving this to it's own Region
	 *
	 * @return bool
	 */
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

	/**
	 * Requirements for accessing the S DW.
	 * @TODO: consider moving this to it's own Region
	 *
	 * @return bool
	 */
	public function canAccessSouthDarkWorld() {
		return $this->has('MoonPearl')
			&& (($this->canDefeatAgahnim1() && ($this->has('Hammer')
				|| ($this->has('Hookshot') && ($this->has('Flippers') || $this->canLiftRocks()))))
				|| ($this->has('Hammer') && $this->canLiftRocks())
				|| $this->has('TitansMitt'));
	}

	/**
	 * Requirements for accessing the NE DW.
	 * @TODO: consider moving this to it's own Region
	 *
	 * @return bool
	 */
	public function canAccessPyramid() {
		return $this->canDefeatAgahnim1()
			|| ($this->has('Hammer') && $this->canLiftRocks() && $this->has('MoonPearl'))
			|| ($this->has("TitansMitt") && $this->has('Flippers') && $this->has('MoonPearl'));
	}

	/**
	 * Requirements for accessing the W DM.
	 * @TODO: consider moving this to the Death Mountain Region
	 *
	 * @return bool
	 */
	public function canAccessWestDeathMountain() {
		return $this->canFly() || $this->canLiftRocks();
	}

	/**
	 * Requirements for accessing the E DM.
	 * @TODO: consider moving this to the Death Mountain Region
	 *
	 * @return bool
	 */
	public function canAccessEastDeathMountain() {
		return $this->canAccessWestDeathMountain()
			&& (($this->has('Hammer') && $this->has('MagicMirror'))
			|| $this->has('Hookshot'));
	}

	/**
	 * Requirements for defeating AG1
	 * @TODO: consider moving this to canComplete for HyruleTower Region
	 *
	 * @return bool
	 */
	public function canDefeatAgahnim1() {
		return $this->has('Cape') || (!$this->no_upgrade_sword_check && $this->canUpgradeSword());
	}

	/**
	 * Requirements for upgrading sword
	 * @TODO: consider moving this to World so we don't have to dep inject World into this collection
	 *
	 * @return bool
	 */
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

	/**
	 * Requirements for collecing all 3 pendants
	 * @TODO: consider moving this to World so we don't have to dep inject World into this collection
	 *
	 * @return bool
	 */
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

	/**
	 * Requirements for having a bottle
	 *
	 * @return bool
	 */
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
