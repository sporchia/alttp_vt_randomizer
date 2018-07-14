<?php namespace ALttP;

use ALttP\Item;
use ALttP\Support\BossCollection;
use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;

/**
 * Boss Logic for beating each boss
 */
class Boss {
	protected $name;
	protected $enemizer_name;
	protected $can_beat;

	static protected $items;

	/**
	 * Get the Boss by name
	 *
	 * @param string $name Name of Boss
	 *
	 * @throws Exception if the Boss doesn't exist
	 *
	 * @return Boss
	 */
	static public function get(string $name) {
		$items = static::all();
		if (isset($items[$name])) {
			return $items[$name];
		}

		throw new \Exception('Unknown Boss: ' . $name);
	}

	/**
	 * Get the all known Bosses
	 *
	 * @return BossCollection
	 */
	static public function all() : BossCollection {
		if (static::$items) {
			return static::$items;
		}

		static::$items = new BossCollection([
			new static("Armos Knights", "Armos", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer') || $items->canShootArrows()
					|| $items->has('Boomerang') || $items->has('RedBoomerang')
					|| ($items->canExtendMagic(4) && ($items->has('FireRod') || $items->has('IceRod')))
					|| ($items->canExtendMagic(2) && ($items->has('CaneOfByrna') || $items->has('CaneOfSomaria')));
			}),
			new static("Lanmolas", "Lanmola", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer')
					|| $items->canShootArrows() || $items->has('FireRod') || $items->has('IceRod')
					|| $items->has('CaneOfByrna') || $items->has('CaneOfSomaria');
			}),
			new static("Moldorm", "Moldorm", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer');
			}),
			new static("Agahnim", "Agahnim", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer') || $items->has('BugCatchingNet');
			}),
			new static("Helmasaur King", "Helmasaur", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer') || $items->canShootArrows();
			}),
			new static("Arrghus", "Arrghus", function($locations, $items) {
				return $items->has('Hookshot') && ($items->has('Hammer') || $items->hasSword()
					|| (($items->canExtendMagic(2) || $items->canShootArrows()) && ($items->has('FireRod') || $items->has('IceRod'))));
			}),
			new static("Mothula", "Mothula", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer')
					|| ($items->canExtendMagic(2) && ($items->has('FireRod') || $items->has('CaneOfSomaria')
						|| $items->has('CaneOfByrna')))
					|| $items->canGetGoodBee();
			}),
			new static("Blind", "Blind", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer')
					|| $items->has('CaneOfSomaria') || $items->has('CaneOfByrna');
			}),
			new static("Kholdstare", "Kholdstare", function($locations, $items) {
				return $items->canMeltThings() && ($items->has('Hammer') || $items->hasSword()
					|| ($items->canExtendMagic(3) && $items->has('FireRod'))
					|| ($items->canExtendMagic(2) && $items->has('FireRod') && $items->has('Bombos')));
			}),
			new static("Vitreous", "Vitreous", function($locations, $items) {
				return $items->has('Hammer') || $items->hasSword() || $items->canShootArrows();
			}),
			new static("Trinexx", "Trinexx", function($locations, $items) {
				return $items->has('FireRod') && $items->has('IceRod')
					&& ($items->hasSword(3) || $items->has('Hammer')
						|| ($items->canExtendMagic(2) && $items->hasSword(2))
						|| ($items->canExtendMagic(4) && $items->hasSword()));
			}),
			new static("Agahnim2", "Agahnim2", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer') || $items->has('BugCatchingNet');
			}),

		]);

		return static::all();
	}

	/**
	 * Create a new Item
	 *
	 * @param string $name Unique name of Boss
	 * @param callable $can_beat Rules for beating the Boss
	 *
	 * @return void
	 */
	public function __construct(string $name, string $ename, callable $can_beat) {
		$this->name = $name;
		$this->enemizer_name = $ename;
		$this->can_beat = $can_beat;
	}

	/**
	 * Get the name of this Boss
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Get the name of this Boss for Enemizer
	 *
	 * @return string
	 */
	public function getEName() {
		return $this->enemizer_name;
	}

	/**
	 * Determine if Link can beat this Boss.
	 *
	 * @param ItemCollection $items Items Link can collect
	 * @param LocationCollection $locations
	 *
	 * @return bool
	 */
	public function canBeat($items, $locations = null) : bool {
		if (!$this->can_beat || call_user_func($this->can_beat, $locations ?? new LocationCollection, $items)) {
			return true;
		}

		return false;
	}
}
