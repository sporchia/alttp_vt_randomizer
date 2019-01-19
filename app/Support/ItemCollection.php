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
	private $string_rep = null;

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
		$item_name = $item->getName();
		$this->offsetSet($item_name, $item);
		if (!isset($this->item_counts[$item_name])) {
			$this->item_counts[$item_name] = 0;
		}

		$this->item_counts[$item_name]++;
		$this->string_rep = null;

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
	 * Reduce the collection to a single value.
	 *
	 * @param callable $callback
	 * @param mixed $initial
	 *
	 * @return mixed
	 */
	public function reduce(callable $callback, $initial = null) {
		return array_reduce($this->values(), $callback, $initial);
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
		if ($at_least === 0) {
			return true;
		}

		if ($at_least == null) {
			return false;
		}

		// @TODO: this check is expensive, as this function is called A LOT, can we reduce it somehow?
		if ($this->world->config('rom.genericKeys', false) && ($this->item_counts['ShopKey'] ?? false)
			&& strpos($key, 'Key') === 0) {
			return true;
		}

		return ($this->item_counts[$key] ?? 0) >= $at_least;
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
		return $this->has('OcarinaActive') || $this->has('OcarinaInactive') && $this->canActivateOcarina();
	}
	
	private function canActivateOcarina() {
		if ($this->world instanceof World\Inverted) {
			return $this->has('MoonPearl') && $this->world->getRegion('North West Light World')->canEnter([], $this);
		}
		return true;
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
				return ($this->has('Bow')
						&& (!$this->world->config('rom.rupeeBow', false) || $this->has('ShopArrow') || $this->has('SilverArrowUpgrade')))
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
		return $this->has('UncleSword')
			|| (!$this->world->getCurrentlyFillingItems()->count() && $this->hasSword())
			|| $this->has('CaneOfSomaria')
			|| ($this->has('TenBombs') && $enemies < 6)
			|| ($this->has('CaneOfByrna') && ($enemies < 6 || $this->canExtendMagic()))
			|| $this->canShootArrows()
			|| $this->has('Hammer')
			|| $this->has('FireRod');
	}

	/**
	 * Requirements for bombing things
	 *
	 * @return bool
	 */
	public function canBombThings() {
		return true;
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

	/**
	 * Requirements for having a sword, we treat the special UncleSword like a progressive sword.
	 *
	 * @param int $min_level minimum level of sword
	 *
	 * @return bool
	 */
	public function hasSword(int $min_level = 1) {
		switch ($min_level) {
			case 4:
				return $this->has('ProgressiveSword', 4)
					|| $this->has('UncleSword') && $this->has('ProgressiveSword', 3)
					|| $this->has('L4Sword');
			case 3:
				return $this->has('ProgressiveSword', 3)
					|| $this->has('UncleSword') && $this->has('ProgressiveSword', 2)
					|| $this->has('L3Sword')
					|| $this->has('L4Sword');
			case 2:
				return $this->has('ProgressiveSword', 2)
					|| $this->has('UncleSword') && $this->has('ProgressiveSword')
					|| $this->has('L2Sword')
					|| $this->has('MasterSword')
					|| $this->has('L3Sword')
					|| $this->has('L4Sword');
			case 1:
			default:
				return $this->has('ProgressiveSword')
					|| $this->has('UncleSword')
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

	public function __toString() {
		if ($this->string_rep === null) {
			$this->string_rep = $this->reduce(function($carry, $item) {
				return $carry . $item->getName();
			}, '');
		}

		return $this->string_rep;
	}
}
