<?php namespace ALttP;

use ALttP\World;
use ALttP\Support\LocationCollection as Locations;
use Log;

abstract class Filler {
	protected $world;

	/**
	 * Returns a Filler of a specified type.
	 *
	 * @param string $type type of Filler requested
	 * @param World $world World to assocaite filler to
	 *
	 * @return self
	 */
	public static function factory($type = null, World $world = null) : self {
		if (!$world) {
			$world = new World;
		}

		switch ($type) {
			case 'Distributed':
				return new Filler\Distributed($world);
			case 'Random':
				return new Filler\Random($world);
			case 'Troll':
				return new Filler\Troll($world);
			default:
			case 'RandomAssumed':
				return new Filler\RandomAssumed($world);
		}
	}

	public function __construct(World $world) {
		$this->world = $world;
	}

	abstract public function fill(array $dungeon, array $required, array $nice, array $extra);

	/**
	 * If the filler uses GT Junk fill, this would be what to do with it.
	 *
	 * @param int $min minimum junk items to be placed
	 * @param int $max maximum junk items to be placed
	 *
	 * @return $this
	 */
	public function setGanonJunkLimits(int $min, int $max) {
		return $this;
	}

	protected function shuffleLocations(Locations $locations) {
		return $locations->randomCollection($locations->count());
	}

	protected function shuffleItems(array $items) {
		return mt_shuffle($items);
	}

	protected function fastFillItemsInLocations($fill_items, $locations) {
		Log::debug(sprintf("Fast Filling %s items in %s locations", count($fill_items), $locations->count()));

		foreach($locations as $location) {
			if ($location->hasItem()) {
				continue;
			}
			$item = array_pop($fill_items);
			if (!$item) {
				break;
			}
			Log::debug(sprintf('Placing: %s in %s', $item->getNiceName(), $location->getName()));
			$location->setItem($item);
		}
	}
}
