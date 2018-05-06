<?php namespace ALttP\Region\SuperMetroid\LowerNorfair;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * West Lower Norfair Region and it's Locations contained within
 */
class West extends Region {
	protected $name = 'Lower Norfair';

	/**
	 * Create a new Lower Norfair Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
            new Location\SuperMetroid\Visible("Missile (Gold Torizo)", 0xF78E6E, null, $this),
            new Location\SuperMetroid\Hidden("Super Missile (Gold Torizo)", 0xF78E74, null, $this),
            new Location\SuperMetroid\Chozo("Screw Attack", 0xF79110, null, $this),            
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Missile (Gold Torizo)"]->setItem(Item::get('Missile'));
		$this->locations["Super Missile (Gold Torizo)"]->setItem(Item::get('Super'));
		$this->locations["Screw Attack"]->setItem(Item::get('ScrewAttack'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {

		$this->locations["Missile (Gold Torizo)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerbombs() 
				&& $items->has('SpaceJump') 
				&& (($items->heatProof() && ($items->has('HiJump') || $items->has('Gravity')))
				 || ($items->heatProof()
					&& ($items->canIbj() 
						|| ($items->has('SpaceJump') && ($items->has('ScrewAttack') || $items->canPassBombPassages() || $items->canUsePowerbombs())) 
						|| ($items->has('SpringBall') && $items->canUsePowerBombs()) 
						|| $items->has('SpeedBooster'))));

        });

        $this->locations["Super Missile (Gold Torizo)"]->setRequirements(function($location, $items) {
			return $items->canDestroyBombWalls()
							&& $items->heatProof() 
							&& ($items->canIbj()
                            || ($items->has('SpaceJump') && ($items->has('ScrewAttack') || $items->canPassBombPassages() || $items->canUsePowerbombs())) 
                            || ($items->has('SpringBall') && $items->canUsePowerBombs()) 
                            || $items->has('SpeedBooster'));
        });

        $this->locations["Screw Attack"]->setRequirements(function($location, $items) {
            return $items->canDestroyBombWalls() 
                            && (($items->canIbj() 
                             || ($items->has('SpaceJump') && ($items->has('ScrewAttack') || $items->canPassBombPassages() || $items->canUsePowerbombs())) 
                             || ($items->has('SpringBall') && $items->canUsePowerBombs()) 
							 || $items->has('SpeedBooster'))
							|| $items->canAccessLowerNorfairPortal());
        });

        $this->can_enter = function($locations, $items) {
            return ($this->world->getRegion('East Norfair')->canEnter($locations, $items)
                && $items->canUsePowerBombs()
                && ($items->heatProof() && ($items->has('HiJump') || $items->has('Gravity'))))
                || ($items->canAccessLowerNorfairPortal() && $items->canHellRun() && $items->canDestroyBombWalls());					
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
