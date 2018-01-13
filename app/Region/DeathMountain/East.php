<?php namespace ALttP\Region\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * East Death Mountain Region and it's Locations contained within
 */
class East extends Region {
	protected $name = 'Death Mountain';

	/**
	 * Create a new East Death Mountain Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Spiral Cave", 0xE9BF, null, $this),
			new Location\Chest("Mimic Cave", 0xE9C5, null, $this),
			new Location\Chest("Paradox Cave Lower - Far Left", 0xEB2A, null, $this),
			new Location\Chest("Paradox Cave Lower - Left", 0xEB2D, null, $this),
			new Location\Chest("Paradox Cave Lower - Right", 0xEB30, null, $this),
			new Location\Chest("Paradox Cave Lower - Far Right", 0xEB33, null, $this),
			new Location\Chest("Paradox Cave Lower - Middle", 0xEB36, null, $this),
			new Location\Chest("Paradox Cave Upper - Left", 0xEB39, null, $this),
			new Location\Chest("Paradox Cave Upper - Right", 0xEB3C, null, $this),
			new Location\Standing("Floating Island", 0x180141, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Spiral Cave"]->setItem(Item::get('FiftyRupees'));
		$this->locations["Mimic Cave"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Paradox Cave Lower - Far Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Paradox Cave Lower - Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Paradox Cave Lower - Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Paradox Cave Lower - Far Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Paradox Cave Lower - Middle"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Paradox Cave Upper - Left"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Paradox Cave Upper - Right"]->setItem(Item::get('TenArrows'));
		$this->locations["Floating Island"]->setItem(Item::get('PieceOfHeart'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Mimic Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $items->has('KeyD7', 2)
				&& $this->world->getRegion('Turtle Rock')->canEnter($locations, $items);
		});

		$this->locations["Floating Island"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $items->has('MoonPearl')
				&& $items->canLiftDarkRocks();
		});

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)
				&& (($items->has('Hammer') && $items->has('MagicMirror'))
				|| $items->has('Hookshot'));
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
		$this->initOverworldGlitches();

		$this->locations["Floating Island"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $items->glitchedLinkInDarkWorld()
					&& $items->canLiftRocks() && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items));
		});

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->locations["Mimic Cave"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('MagicMirror')
				&& $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items);
		});

		$this->locations["Floating Island"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $items->has('MoonPearl')
					&& $items->canLiftRocks() && $this->world->getRegion('East Dark World Death Mountain')->canEnter($locations, $items));
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('PegasusBoots')
				|| (($items->has('Hookshot') || $items->has('MagicMirror'))
					&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items));
		};

		return $this;
	}
}
