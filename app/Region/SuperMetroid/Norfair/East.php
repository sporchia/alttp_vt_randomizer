<?php namespace ALttP\Region\SuperMetroid\Norfair;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * East Norfair Region and it's Locations contained within
 */
class East extends Region {
	protected $name = 'Norfair';

	/**
	 * Create a new Norfair Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world, 'SM');

		$this->locations = new LocationCollection([
            new Location\SuperMetroid\Hidden("Missile (lava room)", 0xF78AE4, null, $this),            
            new Location\SuperMetroid\Chozo("Reserve Tank, Norfair", 0xF78C3E, null, $this),            
            new Location\SuperMetroid\Hidden("Missile (Norfair Reserve Tank)", 0xF78C44, null, $this),            
            new Location\SuperMetroid\Visible("Missile (bubble Norfair green door)", 0xF78C52, null, $this),            
            new Location\SuperMetroid\Visible("Missile (bubble Norfair)", 0xF78C66, null, $this),            
            new Location\SuperMetroid\Hidden("Missile (Speed Booster)", 0xF78C74, null, $this),            
            new Location\SuperMetroid\Chozo("Speed Booster", 0xF78C82, null, $this),            
            new Location\SuperMetroid\Visible("Missile (Wave Beam)", 0xF78CBC, null, $this),            
            new Location\SuperMetroid\Chozo("Wave Beam", 0xF78CCA, null, $this),            
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Missile (lava room)"]->setItem(Item::get('Missile'));
		$this->locations["Reserve Tank, Norfair"]->setItem(Item::get('ReserveTank'));
		$this->locations["Missile (Norfair Reserve Tank)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (bubble Norfair green door)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (bubble Norfair)"]->setItem(Item::get('Missile'));
        $this->locations["Missile (Speed Booster)"]->setItem(Item::get('Missile'));
        $this->locations["Speed Booster"]->setItem(Item::get('SpeedBooster'));
        $this->locations["Missile (Wave Beam)"]->setItem(Item::get('Missile'));
        $this->locations["Wave Beam"]->setItem(Item::get('WaveBeam'));        /* Speed Booster was listed here again! */
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
        
        $this->locations["Missile (lava room)"]->setRequirements(function($location, $items) {
			return $items->has('Morph');
        });

        $this->locations["Reserve Tank, Norfair"]->setRequirements(function($location, $items) {
            return $items->has('Morph') && $items->has('Super');
        });

        $this->locations["Missile (Norfair Reserve Tank)"]->setRequirements(function($location, $items) {
            return $items->has('Morph') && $items->has('Super');
        });

        $this->locations["Missile (bubble Norfair green door)"]->setRequirements(function($location, $items) {
            return $items->has('Super');
        });

        $this->locations["Missile (Speed Booster)"]->setRequirements(function($location, $items) {
            return $items->has('Super');
        });

        $this->locations["Speed Booster"]->setRequirements(function($location, $items) {
            return $items->has('Super');
        });

	    $this->locations["Wave Beam"]->setRequirements(function($location, $items) {
            return $items->canOpenRedDoors() && ($items->has('Morph') || $items->has('Grapple') || ($items->has('HiJump') && $items->heatProof()) || $items->has('SpaceJump'));
        });

        $this->can_enter = function($locations, $items) {
            return ((($items->canDestroyBombWalls() || $items->has('SpeedBooster'))
                && ($items->has('Super') && $items->has('Morph')))
                || $items->canAccessNorfairPortal())
                && $items->canHellRun()
                && ($items->has('Super') && ($items->canFlySM() || $items->has('HiJump') || $items->has('SpringBall') || ($items->has('Varia') && ($items->has('IceBeam') || $items->has('SpeedBooster'))))
                 || ($items->has('SpeedBooster') && $items->canUsePowerBombs()));
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
        $this->locations["Missile (lava room)"]->setRequirements(function($location, $items) {
			return $items->has('Morph');
        });

        $this->locations["Reserve Tank, Norfair"]->setRequirements(function($location, $items) {
            return $items->has('Morph')
                && $items->has('Super')
                && ($items->canFlySM() || $items->has('Grapple') || $items->has('HiJump') || $items->has('IceBeam'));
        });

        $this->locations["Missile (Norfair Reserve Tank)"]->setRequirements(function($location, $items) {
            return $items->has('Morph')
                && $items->has('Super')
                && ($items->canFlySM() || $items->has('Grapple') || $items->has('HiJump') || $items->has('IceBeam'));
        });

        $this->locations["Missile (bubble Norfair green door)"]->setRequirements(function($location, $items) {
            return $items->has('Super')
                && ($items->canFlySM() || $items->has('Grapple') || $items->has('HiJump') || $items->has('IceBeam'));
        });
		
	$this->locations["Wave Beam"]->setRequirements(function($location, $items) {
            return ($items->has('Super') && $items->has('Morph') && ($items->has('Grapple') || $items->CanFlySM())
        	&& $items->has('HiJump') || $items->has('IceBeam'));
        });
	/*
	Adding in logic for the Wave Beam location.
	Kept the Super requirement for Wave since Bubble Mountain is also Super-locked.
	Made escaping Wave require Grapple/Space since people may be afraid of spikes.
	*/

        $this->can_enter = function($locations, $items) {
            return ((($items->canDestroyBombWalls() || $items->has('SpeedBooster'))
                && ($items->has('Super') && $items->has('Morph')))
                || $items->canAccessNorfairPortal())
                && $items->has('Varia')
                && ($items->canFlySM() || $items->has('HiJump') || ($items->has('SpeedBooster') && $items->canUsePowerBombs()) || ($items->has('Varia') && ($items->has('IceBeam') || $items->has('SpeedBooster'))));
        };
        
		return $this;
	}
}
