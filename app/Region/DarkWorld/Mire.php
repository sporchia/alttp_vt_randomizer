<?php namespace ALttP\Region\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
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
			new Location\Chest("[cave-071] Misery Mire west area [left chest]", 0xEA73, null, $this),
			new Location\Chest("[cave-071] Misery Mire west area [right chest]", 0xEA76, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[cave-071] Misery Mire west area [left chest]"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["[cave-071] Misery Mire west area [right chest]"]->setItem(Item::get('TwentyRupees'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[cave-071] Misery Mire west area [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["[cave-071] Misery Mire west area [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});


		$this->can_enter = function($locations, $items) {
			return $items->canFly() && $items->canLiftDarkRocks();
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
		$this->locations["[cave-071] Misery Mire west area [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') || $items->has('MagicMirror');
		});

		$this->locations["[cave-071] Misery Mire west area [right chest]"]->setRequirements(function($locations, $items) {
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
