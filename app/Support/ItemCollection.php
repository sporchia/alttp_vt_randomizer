<?php namespace ALttP\Support;

use ALttP\Item;

/**
 * Collection of Items
 */
class ItemCollection extends Collection {
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
		return new static(array_merge($this->items, [$item]));
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
		return $this->has('FireRod')
			|| ($this->has('Bombos') && $this->hasSword());
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
	 * Requirements for having a sword
	 *
	 * @return bool
	 */
	public function hasSword() {
		return $this->has('L1Sword')
			|| $this->has('L1SwordAndShield')
			|| $this->hasUpgradedSword();
	}

	/**
	 * Requirements for having an upgraded sword
	 *
	 * @return bool
	 */
	public function hasUpgradedSword() {
		return $this->has('L2Sword')
			|| $this->has('MasterSword')
			|| $this->has('L3Sword')
			|| $this->has('L4Sword');
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
