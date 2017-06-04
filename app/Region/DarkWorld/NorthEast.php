<?php namespace ALttP\Region\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * North East Dark World Region and it's Locations contained within
 */
class NorthEast extends Region {
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
			new Location\Standing("Catfish", 0xEE185, null, $this),
			new Location\Standing("Piece of Heart (Pyramid)", 0x180147, null, $this),
			new Location\Standing("Pyramid - Sword", 0x180028, null, $this),
			new Location\Standing("Pyramid - Bow", 0x34914, null, $this),
		]);

		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations->addItem(new Location\Chest("Pyramid Fairy - Left", 0xE980, null, $this));
			$this->locations->addItem(new Location\Chest("Pyramid Fairy - Right", 0xE983, null, $this));
		}
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Catfish"]->setItem(Item::get('Quake'));
		$this->locations["Piece of Heart (Pyramid)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Pyramid - Sword"]->setItem(Item::get('L4Sword'));
		$this->locations["Pyramid - Bow"]->setItem(Item::get('BowAndSilverArrows'));

		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations["Pyramid Fairy - Left"]->setItem(Item::get('L4Sword'));
			$this->locations["Pyramid Fairy - Right"]->setItem(Item::get('SilverArrowUpgrade'));
		}

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Catfish"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks();
		});

		$this->locations["Piece of Heart (Pyramid)"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Pyramid - Sword"]->setRequirements(function($locations, $items) {
			return $items->has('Crystal5') && $items->has('Crystal6') && $items->has('MoonPearl')
				&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
					&& ($items->has('Hammer')
						|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')));
		});

		$this->locations["Pyramid - Bow"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->has('Crystal5') && $items->has('Crystal6') && $items->has('MoonPearl')
				&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
					&& ($items->has('Hammer')
						|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')));
		});


		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations["Pyramid Fairy - Left"]->setRequirements(function($locations, $items) {
				return $items->has('Crystal5') && $items->has('Crystal6') && $items->has('MoonPearl')
					&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
						&& ($items->has('Hammer')
							|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')));
			});

			$this->locations["Pyramid Fairy - Right"]->setRequirements(function($locations, $items) {
				return $items->has('Crystal5') && $items->has('Crystal6') && $items->has('MoonPearl')
					&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
						&& ($items->has('Hammer')
							|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')));
			});
		}

		$this->can_enter = function($locations, $items) {
			return $items->has('DefeatAgahnim')
				|| ($items->has('Hammer') && $items->canLiftRocks() && $items->has('MoonPearl'))
				|| ($items->canLiftDarkRocks() && $items->has('Flippers') && $items->has('MoonPearl'));
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Glitched Mode
	 *
	 * @return $this
	 */
	public function initGlitched() {
		$this->locations["Pyramid - Sword"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror')
				|| ($items->has('Crystal5') && $items->has('Crystal6') && $items->has('Hammer')
					&& ($items->hasABottle() || $items->has("MoonPearl")));
		});

		$this->locations["Pyramid - Bow"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && ($items->has('MagicMirror')
				|| ($items->has('Crystal5') && $items->has('Crystal6') && $items->has('Hammer')
					&& ($items->hasABottle() || $items->has("MoonPearl"))));
		});

		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations["Pyramid Fairy - Left"]->setRequirements(function($locations, $items) {
				return $items->has('MagicMirror')
					|| ($items->has('Crystal5') && $items->has('Crystal6') && $items->has('Hammer')
						&& ($items->hasABottle() || $items->has("MoonPearl")));
			});

			$this->locations["Pyramid Fairy - Right"]->setRequirements(function($locations, $items) {
				return $items->has('MagicMirror')
					|| ($items->has('Crystal5') && $items->has('Crystal6') && $items->has('Hammer')
						&& ($items->hasABottle() || $items->has("MoonPearl")));
			});
		}

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') || $items->hasABottle();
		};

		return $this;
	}
}
