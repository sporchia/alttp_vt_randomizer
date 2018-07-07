<?php namespace ALttP\Region\DarkWorld\DeathMountain;

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
class East extends Region {
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
			new Location\Chest("Superbunny Cave - Top", 0xEA7C, null, $this),
			new Location\Chest("Superbunny Cave - Bottom", 0xEA7F, null, $this),
			new Location\Chest("Hookshot Cave - Top Right", 0xEB51, null, $this),
			new Location\Chest("Hookshot Cave - Top Left", 0xEB54, null, $this),
			new Location\Chest("Hookshot Cave - Bottom Left", 0xEB57, null, $this),
			new Location\Chest("Hookshot Cave - Bottom Right", 0xEB5A, null, $this),
		]);

		$this->shops = new ShopCollection([
			new Shop("Dark World Death Mountain Shop", 0x03, 0xC1, 0x0112, 0x6E, $this),
		]);

		$this->shops["Dark World Death Mountain Shop"]->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('Heart'), 10)
			->addInventory(2, Item::get('TenBombs'), 50);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Superbunny Cave - Top"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Superbunny Cave - Bottom"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Hookshot Cave - Top Right"]->setItem(Item::get('FiftyRupees'));
		$this->locations["Hookshot Cave - Top Left"]->setItem(Item::get('FiftyRupees'));
		$this->locations["Hookshot Cave - Bottom Left"]->setItem(Item::get('FiftyRupees'));
		$this->locations["Hookshot Cave - Bottom Right"]->setItem(Item::get('FiftyRupees'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Superbunny Cave - Top"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Superbunny Cave - Bottom"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Hookshot Cave - Top Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hookshot');
		});

		$this->locations["Hookshot Cave - Top Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hookshot');
		});

		$this->locations["Hookshot Cave - Bottom Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')  && $items->has('Hookshot');
		});

		$this->locations["Hookshot Cave - Bottom Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && ($items->has('Hookshot') || $items->has('PegasusBoots'));
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda') && $items->canLiftDarkRocks()
				&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
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

		$this->can_enter = function($locations, $items) {
			// @TODO: This should account for 2x YBA
			return $items->has('RescueZelda')
				&& (($items->has('MoonPearl') || ($items->hasABottle() && $items->has('PegasusBoots')))
					|| (($items->canLiftDarkRocks() || ($items->has('Hammer') && $items->has('PegasusBoots')))
						&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items))
					|| ($items->has('MagicMirror') && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)));
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
		$this->locations["Hookshot Cave - Top Right"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('MoonPearl') && $items->has('Hookshot');
		});

		$this->locations["Hookshot Cave - Top Left"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('MoonPearl') && $items->has('Hookshot');
		});

		$this->locations["Hookshot Cave - Bottom Left"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('MoonPearl')  && $items->has('Hookshot');
		});

		$this->locations["Hookshot Cave - Bottom Right"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('MoonPearl') && ($items->has('Hookshot') || $items->has('PegasusBoots'));
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& (($items->has('PegasusBoots') && $items->has('MoonPearl'))
					|| ($items->has('MagicMirror') && $this->world->getRegion('West Death Mountain')->canEnter($locations, $items))
					|| (($items->canLiftDarkRocks() || ($items->has('Hammer') && $items->has('PegasusBoots')))
						&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items)));
		};

		return $this;
	}

}
