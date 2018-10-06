<?php namespace ALttP\Region\Standard\DarkWorld\DeathMountain;

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
class West extends Region {
	protected $name = 'Dark World';

	/**
	 * Create a new Dark World Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Spike Cave", 0xEA8B, null, $this),
		]);

		$this->shops = new ShopCollection([
			new Shop\TakeAny("Dark Death Mountain Fairy", 0x83, 0xC1, 0x0112, 0x70, $this, [0xDBBE2 => [0x58]]),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Spike Cave"]->setItem(Item::get('CaneOfByrna'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		$this->shops["Dark Death Mountain Fairy"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items);
		});

		$this->locations["Spike Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hammer') && $items->canLiftRocks()
				&& (($items->canExtendMagic() && $items->has('Cape'))
					|| ((!$this->world->config('region.cantTakeDamage', false) || $items->canExtendMagic()) && $items->has('CaneOfByrna')))
				&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items);
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda');
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for MajorGlitches Mode
	 *
	 * @return $this
	 */
	public function initMajorGlitches() {
		// @TODO: This should account for 2x YBA
		$this->locations["Spike Cave"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canLiftRocks()
				&& ($items->has('MoonPearl') || ($items->hasABottle() && $items->has('PegasusBoots')))
				&& (($items->canExtendMagic() && $items->has('Cape'))
					|| ((!$this->world->config('region.cantTakeDamage', false) || $items->canExtendMagic()) && $items->has('CaneOfByrna')))
				&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items);
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda');
		};

		return $this;
	}
}
