<?php namespace ALttP\Region\SuperMetroid\Brinstar;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Red Brinstar Region and it's Locations contained within
 */
class Red extends Region {
	protected $name = 'Brinstar';

	/**
	 * Create a new Brinstar Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world, 'SM');

		$this->locations = new LocationCollection([
			new Location\SuperMetroid\Chozo("X-Ray Scope", 0xF78876, null, $this),
			new Location\SuperMetroid\Visible("Power Bomb (red Brinstar sidehopper room)", 0xF788CA, null, $this),
			new Location\SuperMetroid\Chozo("Power Bomb (red Brinstar spike room)", 0xF7890E, null, $this),
			new Location\SuperMetroid\Visible("Missile (red Brinstar spike room)", 0xF78914, null, $this),
			new Location\SuperMetroid\Chozo("Spazer", 0xF7896E, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["X-Ray Scope"]->setItem(Item::get('XRay'));
		$this->locations["Power Bomb (red Brinstar sidehopper room)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Power Bomb (red Brinstar spike room)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Missile (red Brinstar spike room)"]->setItem(Item::get('Missile'));
		$this->locations["Spazer"]->setItem(Item::get('Spazer'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {

		$this->locations["X-Ray Scope"]->setRequirements(function($location, $items) {
            return $items->canUsePowerBombs()
                && $items->canOpenRedDoors()
                && ($items->has('Grapple')
                 || $items->has('SpaceJump')
                 || ($items->has('Varia') && $items->hasEnergyReserves(3) && ($items->canIbj() || ($items->has('HiJump') && $items->has('SpeedBooster')) || $items->canSpringBallJump()))
                 || ($items->hasEnergyReserves(5) && ($items->canIbj() || ($items->has('HiJump') && $items->has('SpeedBooster')) || $items->canSpringBallJump())));
		});

        $this->locations["Power Bomb (red Brinstar sidehopper room)"]->setRequirements(function($location, $items) {
            return $items->canUsePowerBombs() && $items->has('Super');
		});

        $this->locations["Power Bomb (red Brinstar spike room)"]->setRequirements(function($location, $items) {
            return $items->has('Super');
		});

        $this->locations["Missile (red Brinstar spike room)"]->setRequirements(function($location, $items) {
            return $items->canUsePowerBombs() && $items->has('Super');
		});

        $this->locations["Spazer"]->setRequirements(function($location, $items) {
            return $items->canPassBombPassages() && $items->has('Super');
		});

        $this->can_enter = function($locations, $items) {
            return (($items->canDestroyBombWalls() || $items->has('SpeedBooster'))
                && ($items->has('Super') && $items->has('Morph')))
                || ($items->canAccessNorfairPortal() && ($items->has('IceBeam') || $items->canSpringBallJump() || $items->has('HiJump') || $items->canFlySM()));
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

		$this->locations["X-Ray Scope"]->setRequirements(function($location, $items) {
            return $items->canUsePowerBombs()
                && $items->canOpenRedDoors()
                && ($items->has('Grapple') || $items->has('SpaceJump'));
		});

        $this->locations["Power Bomb (red Brinstar sidehopper room)"]->setRequirements(function($location, $items) {
            return $items->canUsePowerBombs() && $items->has('Super');
		});

        $this->locations["Power Bomb (red Brinstar spike room)"]->setRequirements(function($location, $items) {
            return ($items->canUsePowerBombs() || $items->has('IceBeam')) && $items->has('Super');
		});

        $this->locations["Missile (red Brinstar spike room)"]->setRequirements(function($location, $items) {
            return $items->canUsePowerBombs() && $items->has('Super');
		});

        $this->locations["Spazer"]->setRequirements(function($location, $items) {
            return $items->canPassBombPassages() && $items->has('Super');
		});

        $this->can_enter = function($locations, $items) {
            return (($items->canDestroyBombWalls() || $items->has('SpeedBooster'))
                && ($items->has('Super') && $items->has('Morph')))
                || ($items->canAccessNorfairPortal() && ($items->has('IceBeam') || $items->has('HiJump') || $items->has('SpaceJump')));
		};

		return $this;
	}
}
