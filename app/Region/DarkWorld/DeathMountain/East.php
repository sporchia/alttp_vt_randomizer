<?php namespace ALttP\Region\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
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
			new Location\Chest("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", 0xEA7C, null, $this),
			new Location\Chest("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", 0xEA7F, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", 0xEB51, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", 0xEB54, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", 0xEB57, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", 0xEB5A, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]"]->setItem(Item::get('FiftyRupees'));
		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]"]->setItem(Item::get('FiftyRupees'));
		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]"]->setItem(Item::get('FiftyRupees'));
		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]"]->setItem(Item::get('FiftyRupees'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')  && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && ($items->has('Hookshot') || $items->has('PegasusBoots'));
		});

		$this->can_enter = function($locations, $items) {
			return $items->canLiftDarkRocks()
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
		$access_dark_world = function($items) {
			return $items->has('MoonPearl') || $items->hasABottle();
		};

		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
			return $access_dark_world($items) || $items->canLiftDarkRocks() || $items->has('Hammer') || $items->has('MagicMirror');
		});

		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
			return $access_dark_world($items) || $items->canLiftDarkRocks() || $items->has('Hammer') || $items->has('MagicMirror');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
 			return (($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->canLiftDarkRocks()))
					|| ($access_dark_world($items) && $items->canLiftRocks())) && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
 			return (($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->canLiftDarkRocks()))
					|| ($access_dark_world($items) && $items->canLiftRocks())) && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
 			return (($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->canLiftDarkRocks()))
					|| ($access_dark_world($items) && $items->canLiftRocks())) && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
 			return (($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->canLiftDarkRocks()))
					|| ($access_dark_world($items) && $items->canLiftRocks())) && ($items->has('Hookshot') || $items->has('PegasusBoots'));
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
		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('MoonPearl') && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('MoonPearl') && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('MoonPearl')  && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() && $items->has('MoonPearl') && ($items->has('Hookshot') || $items->has('PegasusBoots'));
		});

		$this->can_enter = function($locations, $items) {
			return ($items->has('PegasusBoots') && $items->has('MoonPearl'))
				|| (($items->canLiftDarkRocks() || ($items->has('Hammer') && $items->has('PegasusBoots')))
					&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items));
		};

		return $this;
	}

}
