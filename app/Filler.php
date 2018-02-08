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

		if ($type == '?') {
			$algorithms = ['Distributed', 'Random', 'RandomAssumed', 'RandomBeatable', 'RandomSwap', 'Troll'];
			$type = $algorithms[array_rand($algorithms)];
			Log::debug(sprintf('Algorithm used: %s', $type));
		}

		switch ($type) {
			case 'Distributed':
				return new Filler\Distributed($world);
			case 'Random':
				return new Filler\Random($world);
			case 'RandomBeatable':
				return new Filler\RandomBeatable($world);
			case 'RandomSwap':
				return new Filler\RandomSwap($world);
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
