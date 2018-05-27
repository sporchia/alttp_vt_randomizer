<?php namespace ALttP\Region\SuperMetroid;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Tourian Region and it's Locations contained within
 */
class Tourian extends Region {
	protected $name = 'Tourian';

	/**
	 * Create a new Tourian Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world, 'SM');

		$this->locations = new LocationCollection([
			new Location\Prize\Event("Mother Brain", null, null, $this),
        ]);
        
		$this->prize_location = $this->locations["Mother Brain"];
		$this->prize_location->setItem(Item::get('DefeatMotherBrain'));
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
        $this->can_enter = function($locations, $items) {
            return $items->has('DefeatPhantoon')
                && $items->has('DefeatDraygon')
                && $items->has('DefeatRidley')
                && $items->has('DefeatKraid');
		};
		
		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Casual Mode
	 *
	 * @return $this
	 */
	public function initCasual() {
		$this->initTournament();
	}
}
