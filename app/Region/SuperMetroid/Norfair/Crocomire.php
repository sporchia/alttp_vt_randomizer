<?php namespace ALttP\Region\SuperMetroid\Norfair;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Crocomire Norfair Region and it's Locations contained within
 */
class Crocomire extends Region {
	protected $name = 'Norfair';

	/**
	 * Create a new Norfair Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
            new Location\SuperMetroid\Visible("Energy Tank, Crocomire", 0xF78BA4, null, $this),            
            new Location\SuperMetroid\Visible("Missile (above Crocomire)", 0xF78BC0, null, $this),            
            new Location\SuperMetroid\Visible("Power Bomb (Crocomire)", 0xF78C04, null, $this),            
            new Location\SuperMetroid\Visible("Missile (below Crocomire)", 0xF78C14, null, $this),            
            new Location\SuperMetroid\Visible("Missile (Grapple Beam)", 0xF78C2A, null, $this),            
            new Location\SuperMetroid\Chozo("Grapple Beam", 0xF78C36, null, $this),            
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Energy Tank, Crocomire"]->setItem(Item::get('ETank'));
        $this->locations["Missile (above Crocomire)"]->setItem(Item::get('Missile'));
        $this->locations["Power Bomb (Crocomire)"]->setItem(Item::get('PowerBomb'));        
        $this->locations["Missile (below Crocomire)"]->setItem(Item::get('Missile'));        
        $this->locations["Missile (Grapple Beam)"]->setItem(Item::get('Missile'));        
        $this->locations["Grapple Beam"]->setItem(Item::get('Grapple'));        
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
        
        $this->locations["Missile (above Crocomire)"]->setRequirements(function($location, $items) {
			return ($items->canFlySM() || $items->has('Grapple') || ($items->has('HiJump') && $items->has('SpeedBooster'))) && $items->canHellRun();
        });

        $this->locations["Missile (Grapple Beam)"]->setRequirements(function($location, $items) {
			return ($items->canFlySM() || $items->has('SpeedBooster') || $items->has('Grapple')) && $items->has('Morph');
        });

        $this->locations["Grapple Beam"]->setRequirements(function($location, $items) {
			return ($items->canFlySM() || $items->has('HiJump') || $items->has('Grapple') || $items->has('Morph'));
        });

        $this->can_enter = function($locations, $items) {
            return ((($items->canDestroyBombWalls() || $items->has('SpeedBooster'))
                && ($items->has('Super') && $items->has('Morph')))
                || $items->canAccessNorfairPortal())
                && ($items->hasEnergyReserves(3) || $items->heatProof())
                && $items->has('Super')
                && ((($items->canFlySM() || $items->has('HiJump')) && $items->has('Morph')) || $items->has('SpeedBooster'));
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
		$this->initNoMajorGlitches();
	}
}
