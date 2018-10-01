<?php namespace ALttP\Region\Open;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Hyrule Castle Escape Region and it's Locations contained within
 */
class HyruleCastleEscape extends Region\Standard\HyruleCastleEscape {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		$this->locations["Sewers - Secret Room - Left"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
		});

		$this->locations["Sewers - Secret Room - Middle"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
		});

		$this->locations["Sewers - Secret Room - Right"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() || ($items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyH2'));
		});

		$this->locations["Sewers - Dark Cross"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp', $this->world->config('item.require.Lamp', 1));
		});

		$this->locations["Hyrule Castle - Boomerang Chest"]->setRequirements(function($locations, $items) {
			return $items->has('KeyH2');
		});

		$this->locations["Hyrule Castle - Zelda's Cell"]->setRequirements(function($locations, $items) {
			return $items->has('KeyH2');
		});

		$this->locations["Secret Passage"]->setFillRules(function($item, $locations, $items) {
			return !((!$this->world->config('region.wildKeys', false) && $item instanceof Item\Key)
				|| (!$this->world->config('region.wildBigKeys', false) && $item instanceof Item\BigKey)
				|| (!$this->world->config('region.wildMaps', false) && $item instanceof Item\Map)
				|| (!$this->world->config('region.wildCompasses', false) && $item instanceof Item\Compass));
		});

		$this->locations["Link's Uncle"]->setFillRules(function($item, $locations, $items) {
			return $this->locations["Sanctuary"]->canAccess($this->world->collectItems())
				&& !((!$this->world->config('region.wildKeys', false) && $item instanceof Item\Key)
					|| (!$this->world->config('region.wildBigKeys', false) && $item instanceof Item\BigKey)
					|| (!$this->world->config('region.wildMaps', false) && $item instanceof Item\Map)
					|| (!$this->world->config('region.wildCompasses', false) && $item instanceof Item\Compass));
		});

		return $this;
	}
}
