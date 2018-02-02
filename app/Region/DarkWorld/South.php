<?php namespace ALttP\Region\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * South Dark World Region and it's Locations contained within
 */
class South extends Region {
	protected $name = 'Dark World';

	/**
	 * Create a new South Dark World Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Hype Cave - Top", 0xEB1E, null, $this),
			new Location\Chest("Hype Cave - Middle Right", 0xEB21, null, $this),
			new Location\Chest("Hype Cave - Middle Left", 0xEB24, null, $this),
			new Location\Chest("Hype Cave - Bottom", 0xEB27, null, $this),
			new Location\Npc("Stumpy", 0x330C7, null, $this),
			new Location\Npc("Hype Cave - NPC", 0x180011, null, $this),
			new Location\Dig("Digging Game", 0x180148, null, $this),
			new Location\Archery("Shooting Gallery", 0x3B51F, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Hype Cave - Top"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Hype Cave - Middle Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Hype Cave - Middle Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Hype Cave - Bottom"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Stumpy"]->setItem(Item::get('Shovel'));
		$this->locations["Hype Cave - NPC"]->setItem(Item::get('ThreeHundredRupees'));
		$this->locations["Digging Game"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Shooting Gallery"]->setItem(Item::get('Nothing'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl')
				&& (($this->world->getRegion('North East Dark World')->canEnter($locations, $items) && ($items->has('Hammer')
					|| ($items->has('Hookshot') && ($items->has('Flippers') || $items->canLiftRocks()))))
					|| ($items->has('Hammer') && $items->canLiftRocks())
					|| $items->canLiftDarkRocks());
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

		foreach ($this->locations as $location) {
			$location->setRequirements(function($locations, $items) {
				return $items->glitchedLinkInDarkWorld();
			});
		}

		$this->can_enter = function($locations, $items) {
			return ($items->has('MoonPearl')
				&& ($items->canLiftDarkRocks()
					|| ($items->has('Hammer') && $items->canLiftRocks())
					|| ($items->has('DefeatAgahnim') && ($items->has('Hammer')
						|| ($items->has('Hookshot') && ($items->canLiftRocks() || $items->has('Flippers')))))))
				|| $this->world->getRegion('West Death Mountain')->canEnter($locations, $items);
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
		// I don't know why, but I guess everything in the region requires Moon Pearl, except for entry
		foreach ($this->locations as $location) {
			$location->setRequirements(function($locations, $items) {
				return $items->has('MoonPearl');
			});
		}

		$this->can_enter = function($locations, $items) {
			return ($items->has('MoonPearl')
				&& ($items->canLiftDarkRocks()
					|| ($items->has('Hammer') && $items->canLiftRocks())
					|| ($items->has('DefeatAgahnim') && ($items->has('Hammer')
						|| ($items->has('Hookshot') && ($items->canLiftRocks() || $items->has('Flippers')))))))
				|| (($items->has('MagicMirror') || ($items->has('PegasusBoots') && $items->has('MoonPearl')))
					&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items));
		};

		return $this;
	}
}
