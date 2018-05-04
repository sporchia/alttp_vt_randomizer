<?php namespace ALttP\Support;

use ALttP\Item;
use ALttP\World;
use ArrayIterator;

/**
 * Collection of Items, maintains counts of items collected as well.
 */
class ItemCollection extends Collection {
	protected $item_counts = [];
	protected $world;

	/**
	 * Create a new collection.
	 *
	 * @param mixed $items
	 * @param World $world if this is related to a world for config
	 *
	 * @return void
	 */
	public function __construct($items = [], World $world = null) {
		foreach ($this->getArrayableItems($items) as $item) {
			$this->addItem($item);
		}
		$this->world = $world ?? new class extends World {
			public function __construct() {}
			public function config(string $key, $default = NULL) { return null; }
		};
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
		if (!isset($this->item_counts[$item->getName()])) {
			$this->item_counts[$item->getName()] = 0;
		}

		$this->item_counts[$item->getName()]++;

		return $this;
	}

	/**
	 * Remove an item from the collection by name.
	 *
	 * @return $this
	 */
	public function removeItem($name) {
		if (!isset($this->item_counts[$name])) {
			return $this;
		}
		$this->item_counts[$name]--;
		if ($this->item_counts[$name] === 0) {
			$this->offsetUnset($name);
		}

		return $this;
	}

	/**
	 * Run a filter over each of the items.
	 *
	 * @param callable|null $callback
	 *
	 * @return static
	 */
	public function filter(callable $callback = null) {
		if ($callback) {
			return new static(array_filter($this->values(), $callback), $this->world);
		}

		return new static(array_filter($this->values()), $this->world);
	}

	/**
	 * Get an array of the underlying elements
	 *
	 * @return array
	 */
	public function values() {
		$values = [];
		foreach ($this->items as $item) {
			for ($i = 0; $i < $this->item_counts[$item->getName()]; $i++) {
				$values[] = $item;
			}
		}
		return $values;
	}

	/**
	 * Get the items in the collection that are not present in the given items.
	 *
	 * @param mixed $items items to diff against
	 *
	 * @return static
	 */
	public function diff($items) {
		if (!count($items)) {
			return $this->copy();
		}

		// TODO: this might not be correct
		if (!is_a($items, static::class)) {
			return parent::diff($items);
		}

		$diffed = $this->copy();

		foreach ($diffed->item_counts as $name => $amount) {
			if (isset($items->item_counts[$name])) {
				if ($items->item_counts[$name] < $amount) {
					$diffed->item_counts[$name] = $amount - $items->item_counts[$name];
				} else {
					$diffed->offsetUnset($name);
				}
			}
		}
		return $diffed;
	}

	/**
	 * Intersect the collection with the given items.
	 *
	 * @param  mixed  $items
	 *
	 * @return static
	 */
	public function intersect($items) {
		return new static(array_intersect($this->items, $this->getArrayableItems($items)), $this->world);
	}

	/**
	 * Execute a callback over each item.
	 *
	 * @param callable $callback
	 *
	 * @return $this
	 */
	public function each(callable $callback) {
		foreach ($this->items as $key => $item) {
			for ($i = 0; $i < $this->item_counts[$key]; $i++) {
				if ($callback($item, $key) === false) {
					break;
				}
			}
		}

		return $this;
	}

	/**
	 * Merge the collection with the given items.
	 *
	 * @TODO: this whole function may be incorrect
	 *
	 * @param mixed $items
	 *
	 * @return static
	 */
	public function merge($items) {
		if (!count($items)) {
			return $this->copy();
		}

		if (!$items instanceof static) {
			return $this->merge(new static($items, $this->world));
		}

		$merged = $this->copy();

		$items->each(function($item) use ($merged) {
			$merged->addItem($item);
		});

		return $merged;
	}

	/**
	 * Get a fresh copy of this object, the underlying items will still be the same
	 *
	 * @return static
	 */
	public function copy() {
		$new = new static([], $this->world);
		$new->items = $this->items;
		$new->item_counts = $this->item_counts;

		return $new;
	}

	/**
	 * Run a map over each of the items.
	 *
	 * @param callable $callback
	 *
	 * @return array
	 */
	public function map(callable $callback) {
		return array_map($callback, $this->values());
	}

	/**
	 * Determine if an item exists in the collection by key.
	 *
	 * @param mixed $key
	 * @param int $at_least mininum number of item in collection
	 *
	 * @return bool
	 */
	public function has($key, $at_least = 1) {
		if ($key != 'KeyH2' && strpos($key, 'Key') === 0 && $this->world->config('rom.genericKeys', false)) {
			return true;
		}
		return $this->offsetExists($key) && $this->item_counts[$key] >= $at_least;
	}

	/**
	 * For testing, we up the key count to 10 for every dungeon.
	 *
	 * @return $this
	 */
	public function manyKeys() : self {
		foreach ($this->item_counts as $key => $count) {
			if (strpos($key, 'Key') === 0) {
				$this->item_counts[$key] = 10;
			}
		}

		return $this;
	}

	/**
	 * Get the collection of items as a plain array.
	 *
	 * @return array
	 */
	public function toArray() {
		return array_map(function ($value) {
			return $value instanceof Arrayable ? $value->toArray() : $value;
		}, $this->values());
	}

	/**
	 * Count the number of items in the collection.
	 *
	 * @return int
	 */
	public function count() {
		return array_sum($this->item_counts);
	}

	/**
	 * Get an iterator for the items.
	 *
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new ArrayIterator($this->toArray());
	}

	/**
	 * Count the number of an item in the collection.
	 *
	 * @param mixed $key
	 *
	 * @return int
	 */
	public function countItem($key) {
		return $this->item_counts[$key] ?? 0;
	}

	/**
	 * Unset the item at a given offset.
	 *
	 * @param mixed $offset
	 *
	 * @return void
	 */
	public function offsetUnset($offset) {
		unset($this->item_counts[$offset]);
		unset($this->items[$offset]);
	}

	/**
	 * Add an Item to a copy of this Collection
	 *
	 * @param Item $item
	 *
	 * @return static
	 */
	public function tempAdd(Item $item) {
		$temp = $this->copy();
		return $temp->addItem($item);
	}

	/**
	 * Get total collectable Health
	 *
	 * @param float $initial starting health
	 *
	 * @return float
	 */
	public function heartCount($initial = 3) {
		$count = $initial;

		$hearts = $this->filter(function($item) {
			return $item instanceof Item\Upgrade\Health;
		});

		foreach ($hearts as $heart) {
			$count += ($heart->getName() == 'PieceOfHeart') ? .25 : 1;
		}

		return $count;
	}

	/**
	 * Requirements for lifting rocks
	 *
	 * @return bool
	 */
	public function canLiftRocks() {
		return $this->has('PowerGlove')
			|| $this->has('ProgressiveGlove')
			|| $this->has('TitansMitt');
	}

	/**
	 * Requirements for lifting dark rocks
	 *
	 * @return bool
	 */
	public function canLiftDarkRocks() {
		return $this->has('TitansMitt')
			|| $this->has('ProgressiveGlove', 2);
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
	 * should only be used in places where we have put Bombos pads in swordless
	 *
	 * @return bool
	 */
	public function canMeltThings() {
		return $this->has('FireRod')
			|| ($this->has('Bombos') && ($this->world->config('mode.weapons') == 'swordless' || $this->hasSword()));
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
	 * Requirements for fast travel through the spin/hook speed
	 *
	 * @return bool
	 */
	public function canSpinSpeed() {
		return $this->has('PegasusBoots')
			&& ($this->hasSword() || $this->has('Hookshot'));
	}

	/**
	 * Requirements for lobbing arrows at things
	 *
	 * @param int $min_level minimum level of bow
	 *
	 * @return bool
	 */
	public function canShootArrows(int $min_level = 1) {
		switch ($min_level) {
			case 2:
				return $this->has('BowAndSilverArrows')
					|| ($this->has('SilverArrowUpgrade')
						&& ($this->has('Bow') || $this->has('BowAndArrows')));
			case 1:
			default:
				return $this->has('Bow')
					|| $this->has('BowAndArrows')
					|| $this->has('BowAndSilverArrows');
		}

	}

	/**
	 * Requirements for blocking lasers
	 *
	 * @return bool
	 */
	public function canBlockLasers() {
		return $this->has('MirrorShield')
			|| $this->has('ProgressiveShield', 3);
	}

	/**
	 * Requirements for blocking lasers
	 *
	 * @return bool
	 */
	public function canExtendMagic($bars = 2) {
		return ($this->has('HalfMagic') ? 2 : 1)
			* ($this->has('QuarterMagic') ? 4 : 1)
			* ($this->bottleCount() + 1) >= $bars;
	}

	/**
	 * Requirements for being link in Dark World using Major Glitches
	 *
	 * @return bool
	 */
	public function glitchedLinkInDarkWorld() {
		return $this->has('MoonPearl')
			|| $this->hasABottle();
	}

	/**
	 * Requirements for killing most things
	 *
	 * @return bool
	 */
	public function canKillMostThings($enemies = 5) {
		return ($this->hasSword()
				&& (in_array($this->world->config('mode.weapons'), ['uncle', 'swordless'])
					|| !($this->world->getCurrentlyFillingItems()->count() && $this->world->getCurrentlyFillingItems()->hasSword())))
			|| $this->has('CaneOfSomaria')
			|| ($this->has('TenBombs') && $enemies < 6)
			|| ($this->has('CaneOfByrna') && ($enemies < 6 || $this->canExtendMagic()))
			|| $this->canShootArrows()
			|| $this->has('Hammer')
			|| $this->has('FireRod');
	}

	/**
	 * Requirements for catching a Golden Bee
	 *
	 * @return bool
	 */
	public function canGetGoodBee() {
		return $this->has('BugCatchingNet')
			&& $this->hasABottle()
			&& ($this->has('PegasusBoots')
				|| ($this->hasSword() && $this->has('Quake')));
	}


	public function canAccessDeathMountainPortal()
	{
		return (($this->canDestroyBombWalls() || $this->has('SpeedBooster'))
		&& ($this->has('Super') && $this->has('Morph')));
	}

	public function canAccessMiseryMirePortal()
	{
		return $this->heatProof()
			&& $this->has('Super')
			&& ($this->has('HiJump') || $this->has('Gravity'))
			&& $this->canUsePowerBombs()
			&& ($this->heatProof() && ($this->has('HiJump') || $this->has('Gravity')));
	}

	public function canAccessDarkWorldPortal()
	{
		return $this->canUsePowerBombs()
			&& $this->has('Super')
			&& ($items->has('Gravity')
			 || ($items->has('HiJump') && $items->has('IceBeam') && $items->has('Grapple')))
			&& ($this->has('IceBeam') || $this->has('SpeedBooster'));
	}


	/* Super Metroid Ability Macros */
	public function canIbj() {
		return $this->has('Morph') && $this->has('Bombs');
	}

	public function canFlySM() {
		return $this->canIbj() || $this->has('SpaceJump');
	}

	public function canCrystalFlash()
	{
		return $this->has('Missile', 2) 
			&& $this->has('Super', 2)
			&& $this->has('PowerBomb', 3);
	}

	public function hasEnergyReserves(int $amount = 0)
	{
		return (($this->countItem('ETank') + $this->countItem('ReserveTank')) >= $amount);
	}

	public function heatProof()
	{
		return $this->has('Varia');
	}

	public function canHellRun()
	{
		return $this->heatProof() || $this->hasEnergyReserves(5);
	}

	public function canUsePowerBombs()
	{
		return $this->has('Morph') && $this->has('PowerBomb');
	}

	public function canOpenRedDoors()
	{
		return $this->has('Missile') || $this->has('Super');
	}

	public function canDestroyBombWalls()
	{
		return ($this->has('Morph') 
				&&	($this->has('Bombs')
					|| $this->has('PowerBomb')))
			|| $this->has('ScrewAttack');
	}

	public function canEnterAndLeaveGauntlet()
	{
		return ($this->canFlySM() || $this->has('HiJump') || $this->has('SpeedBooster'))
			&& ($this->canIbj()
				|| ($this->canUsePowerBombs() && $this->has('PowerBomb', 2))
				|| $this->has('ScrewAttack')
				|| ($this->has('SpeedBooster') && $this->canUsePowerBombs() && $this->hasEnergyReserves(2)));
	}

	public function canPassBombPassages()
	{
		return $this->canUsePowerBombs() || $this->canIbj();
	}

	public function canAccessNorfairPortal()
	{
		return $this->canFly() || ($this->canLiftRocks() && $this->has('Lamp'));
	}

	public function canAccessLowerNorfairPortal()
	{
		return $this->canFly() && $this->has('MoonPearl') && $this->canLiftDarkRocks();		
	}

	public function canAccessMaridiaPortal()
	{
		return $this->has('MoonPearl')
		&& $this->has('RescueZelda')
		&& $this->has('Flippers')
		&& ((($this->has('DefeatAgahnim')
			|| ($this->has('Hammer') && $this->canLiftRocks() && $this->has('MoonPearl'))
			|| ($this->canLiftDarkRocks() && $this->has('Flippers') && $this->has('MoonPearl'))) && ($this->has('Hammer')
			|| ($this->has('Hookshot') && ($this->has('Flippers') || $this->canLiftRocks()))))
			|| ($this->has('Hammer') && $this->canLiftRocks())
			|| $this->canLiftDarkRocks());

	}

	public function canDefeatBotwoon()
	{
		return $this->has('IceBeam') || $this->has('SpeedBooster') || $this->canAccessMaridiaPortal();
	}

	public function canDefeatDraygon()
	{
		return $this->canDefeatBotwoon() && $this->has('Gravity');
	}

	/**
	 * Requirements for having a sword
	 *
	 * @param int $min_level minimum level of sword
	 *
	 * @return bool
	 */
	public function hasSword(int $min_level = 1) {
		switch ($min_level) {
			case 4:
				return $this->has('ProgressiveSword', 4)
					|| $this->has('L4Sword');
			case 3:
				return $this->has('ProgressiveSword', 3)
					|| $this->has('L3Sword')
					|| $this->has('L4Sword');
			case 2:
				return $this->has('ProgressiveSword', 2)
					|| $this->has('L2Sword')
					|| $this->has('MasterSword')
					|| $this->has('L3Sword')
					|| $this->has('L4Sword');
			case 1:
			default:
				return $this->has('ProgressiveSword')
					|| $this->has('L1Sword')
					|| $this->has('L1SwordAndShield')
					|| $this->has('L2Sword')
					|| $this->has('MasterSword')
					|| $this->has('L3Sword')
					|| $this->has('L4Sword');
		}
	}

	/**
	 * Requirements for having X bottles
	 *
	 * @param int $at_least mininum number of item in collection
	 *
	 * @return bool
	 */
	public function hasBottle(int $at_least = 1) : bool {
		return $this->bottleCount() >= $at_least;
	}

	/**
	 * Requirements for having X bottles
	 *
	 * @param int $at_least mininum number of item in collection
	 *
	 * @return bool
	 */
	public function bottleCount() : int {
		return $this->filter(function($item) {
			return $item instanceof Item\Bottle;
		})->count();
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
