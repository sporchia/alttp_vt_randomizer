<?php namespace ALttP\Region\SuperMetroid\LowerNorfair;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * East Lower Norfair Region and it's Locations contained within
 */
class East extends Region {
	protected $name = 'Lower Norfair';

	/**
	 * Create a new Lower Norfair Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world, 'SM');

		$this->locations = new LocationCollection([
            new Location\SuperMetroid\Visible("Missile (Mickey Mouse room)", 0xF78F30, null, $this),
            new Location\SuperMetroid\Visible("Missile (lower Norfair above fire flea room)", 0xF78FCA, null, $this),
            new Location\SuperMetroid\Visible("Power Bomb (lower Norfair above fire flea room)", 0xF78FD2, null, $this),
            new Location\SuperMetroid\Visible("Power Bomb (Power Bombs of shame)", 0xF790C0, null, $this),
            new Location\SuperMetroid\Visible("Missile (lower Norfair near Wave Beam)", 0xF79100, null, $this),
            new Location\SuperMetroid\Hidden("Energy Tank, Ridley", 0xF79108, null, $this),
			new Location\SuperMetroid\Visible("Energy Tank, Firefleas", 0xF79184, null, $this),
			new Location\Prize\Event("Ridley", null, null, $this),
		]);

		$this->prize_location = $this->locations["Ridley"];
		$this->prize_location->setItem(Item::get('DefeatRidley'));
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Missile (Mickey Mouse room)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (lower Norfair above fire flea room)"]->setItem(Item::get('Missile'));
		$this->locations["Power Bomb (lower Norfair above fire flea room)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Power Bomb (Power Bombs of shame)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Missile (lower Norfair near Wave Beam)"]->setItem(Item::get('Missile'));
		$this->locations["Energy Tank, Ridley"]->setItem(Item::get('ETank'));
		$this->locations["Energy Tank, Firefleas"]->setItem(Item::get('ETank'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
        
        $this->locations["Missile (lower Norfair near Wave Beam)"]->setRequirements(function($location, $items) {
			return $items->has('Morph') && $items->canDestroyBombWalls();
        });

		$this->locations["Missile (Mickey Mouse room)"]->setRequirements(function($location, $items) {
			return $items->has('Morph') && $items->canDestroyBombWalls();
        });

		$this->locations["Power Bomb (lower Norfair above fire flea room)"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages();
        });

		$this->locations["Power Bomb (Power Bombs of shame)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerbombs();
        });

        $this->locations["Energy Tank, Ridley"]->setRequirements(function($location, $items) {
			return $items->canUsePowerbombs() && $items->has('Super') && $items->has('Charge');
        });

		$this->can_enter = function($locations, $items) {
			return $items->heatProof()
				&&	(($this->world->getRegion('East Norfair')->canEnter($locations, $items)
						&& $items->canUsePowerBombs()		
						&& ($items->has('HiJump') || $items->has('Gravity')))
					|| ($items->canAccessLowerNorfairPortal() 
						&& $items->canDestroyBombWalls()
						&& $items->has('Super') 
						&& ($items->canFlySM() || $items->canSpringBallJump() || $items->has('SpeedBooster'))))
				&& ($items->canFlySM() || $items->has('HiJump') || $items->canSpringBallJump() || ($items->has('Ice') && $items->has('Charge')))
				&& ($items->canPassBombPassages() || ($items->has('ScrewAttack') && $items->has('SpaceJump')))
				&& ($items->has('Morph') || $items->hasEnergyReserves(5));
		};

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->canUsePowerbombs() && $items->has('Super') && $items->has('Charge');
		};

		$this->prize_location->setRequirements($this->can_complete);	

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initCasual() {
        $this->locations["Power Bomb (Power Bombs of shame)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerbombs();
        });

        $this->locations["Energy Tank, Ridley"]->setRequirements(function($location, $items) {
			return $items->canUsePowerbombs() && $items->has('Super') && $items->has('Charge');
        });

        $this->can_enter = function($locations, $items) {
			return $items->heatProof()
				&&	(($this->world->getRegion('East Norfair')->canEnter($locations, $items)
						&& $items->canUsePowerBombs()		
						&& ($items->has('SpaceJump') && $items->has('Gravity')))
					|| ($items->canAccessLowerNorfairPortal() 
						&& $items->canDestroyBombWalls()
						&& $items->has('Super')
						&& $items->canUsePowerBombs()
						&& ($items->canFlySM() || $items->has('SpeedBooster'))))
				&& ($items->canFlySM() || $items->has('HiJump'));
        };

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->canUsePowerbombs() && $items->has('Super') && $items->has('Charge');
		};

		$this->prize_location->setRequirements($this->can_complete);
		
		return $this;
	}
}
