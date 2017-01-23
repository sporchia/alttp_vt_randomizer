<?php namespace ALttP\Region;

use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Dark World Region and it's Locations contained within
 */
class DarkWorld extends Region {
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
			new Location\Chest("[cave-055] Spike cave", 0xEA8B, null, $this),
			new Location\Chest("[cave-071] Misery Mire west area [left chest]", 0xEA73, null, $this),
			new Location\Chest("[cave-071] Misery Mire west area [right chest]", 0xEA76, null, $this),
			new Location\Chest("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", 0xEA7C, null, $this),
			new Location\Chest("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", 0xEA7F, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", 0xEB51, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", 0xEB54, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", 0xEB57, null, $this),
			new Location\Chest("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", 0xEB5A, null, $this),
		]);
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[cave-055] Spike cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Hammer') && $items->canLiftRocks()
				&& $this->world->getRegion('Death Mountain')->canEnter($locations, $items);
		});

		$this->locations["[cave-071] Misery Mire west area [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canFly() && $items->has('TitansMitt');
		});

		$this->locations["[cave-071] Misery Mire west area [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canFly() && $items->has('TitansMitt');
		});

		// Super Bunny
		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('East Death Mountain')->canEnter($locations, $items) && $items->has('TitansMitt')
				&& ($this->world->config('region.superBunnyDM', false) || $items->has('MoonPearl'));
		});

		// Super Bunny
		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('East Death Mountain')->canEnter($locations, $items) && $items->has('TitansMitt')
				&& ($this->world->config('region.superBunnyDM', false) || $items->has('MoonPearl'));
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('TitansMitt') && $items->has('Hookshot')
				&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('TitansMitt') && $items->has('Hookshot')
				&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('TitansMitt') && $items->has('Hookshot')
				&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('TitansMitt') && ($items->has('Hookshot') || $items->has('PegasusBoots'))
				&& $this->world->getRegion('East Death Mountain')->canEnter($locations, $items);
		});

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Glitched Mode
	 *
	 * @return $this
	 */
	public function initGlitched() {
		$access_dark_world = function($items) {
			return $items->has('MoonPearl') || $items->hasABottle();
		};

		$this->locations["[cave-055] Spike cave"]->setRequirements(function($locations, $items) use ($access_dark_world) {
			return $access_dark_world($items) && $items->has('Hammer') && $items->canLiftRocks();
		});

		$this->locations["[cave-071] Misery Mire west area [left chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
			return $access_dark_world($items);
		});

		$this->locations["[cave-071] Misery Mire west area [right chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
			return $access_dark_world($items);
		});

		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
			return $access_dark_world($items) || $items->has('TitansMitt');
		});

		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
			return $access_dark_world($items) || $items->has('TitansMitt');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
 			return (($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->has('TitansMitt')))
					|| ($access_dark_world($items) && $items->canLiftRocks())) && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
 			return (($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->has('TitansMitt')))
					|| ($access_dark_world($items) && $items->canLiftRocks())) && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
 			return (($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->has('TitansMitt')))
					|| ($access_dark_world($items) && $items->canLiftRocks())) && $items->has('Hookshot');
		});

		$this->locations["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]"]->setRequirements(function($locations, $items) use ($access_dark_world) {
 			return (($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->has('TitansMitt')))
					|| ($access_dark_world($items) && $items->canLiftRocks())) && ($items->has('Hookshot') || $items->has('PegasusBoots'));
		});

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Minor Glitched Mode
	 *
	 * @return $this
	 */
	public function initSpeedRunner() {
		$this->initNoMajorGlitches();

		$this->locations["[cave-071] Misery Mire west area [left chest]"]->setRequirements(function($locations, $items) {
			return $items->has('TitansMitt') && $items->canFly() && ($items->has('MoonPearl')
				|| ($items->has('Flippers') && $items->hasABottle() && $items->has('BugCatchingNet')));
		});

		$this->locations["[cave-071] Misery Mire west area [right chest]"]->setRequirements(function($locations, $items) {
			return $items->has('TitansMitt') && $items->canFly() && ($items->has('MoonPearl')
				|| ($items->has('Flippers') && $items->hasABottle() && $items->has('BugCatchingNet')));
		});

		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('East Death Mountain')->canEnter($locations, $items) && $items->has('TitansMitt');
		});

		$this->locations["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('East Death Mountain')->canEnter($locations, $items) && $items->has('TitansMitt');
		});
	}
}
