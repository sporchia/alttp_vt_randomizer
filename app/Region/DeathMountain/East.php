<?php namespace ALttP\Region\DeathMountain;

use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\Item;
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
			new Location\Chest("[cave-012-1F] Death Mountain - wall of caves - left cave", 0xE9BF, null, $this),
			new Location\Chest("[cave-013] Mimic cave (from Turtle Rock)", 0xE9C5, null, $this),
			new Location\Chest("[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", 0xEB2A, null, $this),
			new Location\Chest("[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", 0xEB2D, null, $this),
			new Location\Chest("[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", 0xEB30, null, $this),
			new Location\Chest("[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", 0xEB33, null, $this),
			new Location\Chest("[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", 0xEB36, null, $this),
			new Location\Chest("[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", 0xEB39, null, $this),
			new Location\Chest("[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", 0xEB3C, null, $this),
			new Location\Standing("Piece of Heart (Death Mountain - floating island)", 0x180141, null, $this),
		]);
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["[cave-012-1F] Death Mountain - wall of caves - left cave"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-013] Mimic cave (from Turtle Rock)"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer')
				&& $this->world->getRegion('Turtle Rock')->canEnter($locations, $items)
				&& $items->has('MagicMirror')
				&& (($locations["[dungeon-D7-1F] Turtle Rock - compass room"]->hasItem(Item::get('Key'))
				&& $locations["[dungeon-D7-1F] Turtle Rock - Chain chomp room"]->hasItem(Item::get('Key')))
					|| $items->has('FireRod'));
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Piece of Heart (Death Mountain - floating island)"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $items->has('MoonPearl')
				&& $items->has('TitansMitt');
		});

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('Death Mountain')->canEnter($locations, $items)
				&& (($items->has('Hammer') && $items->has('MagicMirror'))
				|| $items->has('Hookshot'));
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
		$this->locations["[cave-013] Mimic cave (from Turtle Rock)"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->has('MagicMirror')
				&& ($items->has('MoonPearl') || $items->hasABottle() || $items->has('TitansMitt'));
		});

		$this->locations["Piece of Heart (Death Mountain - floating island)"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers')
				|| ($items->has('MagicMirror')
					&& ($items->has('MoonPearl') || $items->hasABottle() || $items->has('TitansMitt')));
		});

		return $this;
	}
}
