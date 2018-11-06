<?php namespace ALttP\Region\Inverted\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * Dark World Region and it's Locations contained within
 */
class East extends Region\Standard\DarkWorld\DeathMountain\East {
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		$this->locations["Hookshot Cave - Top Right"]->setRequirements(function($locations, $items) {
			return $items->has('Hookshot')
				&& ($items->canLiftRocks()
					|| ($items->has('MagicMirror') && $items->canBombThings() && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items)));
		});

		$this->locations["Hookshot Cave - Top Left"]->setRequirements(function($locations, $items) {
			return $items->has('Hookshot')
				&& ($items->canLiftRocks()
					|| ($items->has('MagicMirror') && $items->canBombThings() && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items)));
		});

		$this->locations["Hookshot Cave - Bottom Left"]->setRequirements(function($locations, $items) {
			return $items->has('Hookshot')
				&& ($items->canLiftRocks()
					|| ($items->has('MagicMirror') && $items->canBombThings() && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items)));
		});

		$this->locations["Hookshot Cave - Bottom Right"]->setRequirements(function($locations, $items) {
			return ($items->has('Hookshot') || $items->has('PegasusBoots'))
				&& ($items->canLiftRocks()
					|| ($items->has('MagicMirror') && $items->canBombThings() && $this->world->getRegion('East Death Mountain')->canEnter($locations, $items)));
		});

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('West Dark World Death Mountain')->canEnter($locations, $items)
				&& ((!$this->world->config('region.cantTakeDamage', false) || $items->has('CaneOfByrna') || $items->has('Cape'))
                    			|| ($items->has('MagicMirror') && $items->has('Hookshot') && $items->has('MoonPearl')));
		};

		return $this;
	}
}
