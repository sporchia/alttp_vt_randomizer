<?php namespace ALttP\Region\SuperMetroid\Maridia;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Outer Maridia Region and it's Locations contained within
 */
class Outer extends Region {
	protected $name = 'Maridia';

	/**
	 * Create a new Maridia Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world, 'SM');

		$this->locations = new LocationCollection([
            new Location\SuperMetroid\Visible("Missile (green Maridia shinespark)", 0xF7C437, null, $this),            
			new Location\SuperMetroid\Visible("Super Missile (green Maridia)", 0xF7C43D, null, $this),
			new Location\SuperMetroid\Visible("Energy Tank, Mama turtle", 0xF7C47D, null, $this),
			new Location\SuperMetroid\Hidden("Missile (green Maridia tatori)", 0xF7C483, null, $this),
        ]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Missile (green Maridia shinespark)"]->setItem(Item::get('Missile'));
		$this->locations["Super Missile (green Maridia)"]->setItem(Item::get('Super'));
		$this->locations["Energy Tank, Mama turtle"]->setItem(Item::get('ETank'));
		$this->locations["Missile (green Maridia tatori)"]->setItem(Item::get('Missile'));
        return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
        
        $this->locations["Missile (green Maridia shinespark)"]->setRequirements(function($location, $items) {
            return $items->has('Gravity') && $items->has('SpeedBooster');        
		});

        $this->locations["Energy Tank, Mama turtle"]->setRequirements(function($location, $items) {
            return $items->canFlySM() || $items->has('SpeedBooster') || $items->has('Grapple') || $items->canSpringBallJump();        
		});

        $this->can_enter = function($locations, $items) {
            return ($this->world->getRegion('West Norfair')->canEnter($locations, $items)
                && $items->canUsePowerBombs()
                && ($items->has('Gravity')
				 || ($items->has('HiJump') && ($items->canSpringBallJump() || $items->has('Ice')))))
			 || $items->canAccessMaridiaPortal();
        };
        
		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Casual Mode
	 *
	 * @return $this
	 */
	public function initCasual() {
        
        $this->locations["Missile (green Maridia shinespark)"]->setRequirements(function($location, $items) {
            return $items->has('SpeedBooster');        
		});

        $this->locations["Energy Tank, Mama turtle"]->setRequirements(function($location, $items) {
            return $items->canFlySM() || $items->has('SpeedBooster') || $items->has('Grapple');        
		});

        $this->can_enter = function($locations, $items) {
            return (($this->world->getRegion('West Norfair')->canEnter($locations, $items)
				&& $items->canUsePowerBombs())
				|| $items->canAccessMaridiaPortal())				
                && $items->has('Gravity');
        };
        
		return $this;
	}
}
