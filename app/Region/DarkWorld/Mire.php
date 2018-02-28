<?php namespace ALttP\Region\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * Mire Dark World Region and it's Locations contained within
 */
class Mire extends Region {
	protected $name = 'Dark World';

	/**
	 * Create a new North East Dark World Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Mire Shed - Left", 0xEA73, null, $this),
			new Location\Chest("Mire Shed - Right", 0xEA76, null, $this),
		]);

		$this->shops = new ShopCollection([
			new Shop\TakeAny("Dark Desert Fairy", 0x83, 0xC1, 0x0112, 0x56, $this, [0xDBBC8 => [0x58]]),
			new Shop\TakeAny("Dark Desert Hint",  0x83, 0xC1, 0x0112, 0x62, $this, [0xDBBD4 => [0x58]]),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Mire Shed - Left"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Mire Shed - Right"]->setItem(Item::get('TwentyRupees'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Mire Shed - Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Mire Shed - Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});


		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda') && $items->canFly() && $items->canLiftDarkRocks();
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
		$this->can_enter = function($locations, $items) {
			return ($items->hasABottle() && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items))
				|| ($items->canLiftDarkRocks() && ($items->canFly() || $items->hasABottle() || $items->has('PegasusBoots')))
				|| ($items->glitchedLinkInDarkWorld() && $items->has('PegasusBoots')
					&& $this->world->getRegion('South Dark World')->canEnter($locations, $items));
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->locations["Mire Shed - Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') || $items->has('MagicMirror');
		});

		$this->locations["Mire Shed - Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') || $items->has('MagicMirror');
		});

		$this->can_enter = function($locations, $items) {
			return ($items->canLiftDarkRocks() && ($items->canFly() || $items->has('PegasusBoots')))
				|| ($items->has('MoonPearl') && $items->has('PegasusBoots')
					&& $this->world->getRegion('South Dark World')->canEnter($locations, $items));
		};

		return $this;
	}
}
