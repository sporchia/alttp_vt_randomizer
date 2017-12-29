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
			new static("Armos Knights", function($locations, $items) {
				return true;
			}),
			new static("Lanmolas", function($locations, $items) {
				return in_array(config('game-mode'), ['open', 'swordless']) && !($items->hasSword() || $items->has('Hammer')
					|| $items->canShootArrows() || $items->has('FireRod') || $items->has('IceRod')
					|| $items->has('CaneOfByrna') || $items->has('CaneOfSomaria'));
			}),
			new static("Moldorm", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer');
			}),
			new static("Helmasaur King", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer') || $items->canShootArrows();
			}),
			new static("Arrghus", function($locations, $items) {
				return $items->has('Hookshot') && ($items->has('Hammer') || $items->hasSword());// || $items->canShootArrows());
			}),
			new static("Mothula", function($locations, $items) {
				return $items->has('FireRod')
					&& ((config('game-mode') == 'swordless' && ($items->canExtendMagic() || $items->has('Hammer'))) || $items->hasSword());
			}),
			new static("Blind", function($locations, $items) {
				return $items->hasSword() || $items->has('Hammer')
					|| $items->has('CaneOfSomaria') || $items->has('CaneOfByrna');
			}),
			new static("Kholdstare", function($locations, $items) {
				return $items->canMeltThings() && ($items->has('Hammer') || $items->hasUpgradedSword());
			}),
			new static("Vitreous", function($locations, $items) {
				return $items->has('Hammer') || $items->hasUpgradedSword();
			}),
			new static("Trinexx", function($locations, $items) {
				return $items->has('FireRod') && $items->has('IceRod')
					&& ($items->has('Hammer') || $items->hasUpgradedSword());
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
	public function __construct(string $name, callable $can_beat) {
		$this->name = $name;
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
