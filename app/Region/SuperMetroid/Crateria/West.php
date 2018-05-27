<?php namespace ALttP\Region\SuperMetroid\Crateria;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * West Crateria Region and it's Locations contained within
 */
class West extends Region {
	protected $name = 'Crateria';

	/**
	 * Create a new Crateria Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world, 'SM');

		$this->locations = new LocationCollection([
            new Location\SuperMetroid\Visible("Energy Tank, Terminator", 0xF78432, null, $this),
            new Location\SuperMetroid\Visible("Energy Tank, Gauntlet", 0xF78264, null, $this),
            new Location\SuperMetroid\Visible("Missile (Crateria gauntlet right)", 0xF78464, null, $this),
            new Location\SuperMetroid\Visible("Missile (Crateria gauntlet left)", 0xF7846A, null, $this),            
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Energy Tank, Terminator"]->setItem(Item::get('ETank'));
        $this->locations["Energy Tank, Gauntlet"]->setItem(Item::get('ETank'));
        $this->locations["Missile (Crateria gauntlet right)"]->setItem(Item::get('Missile'));
        $this->locations["Missile (Crateria gauntlet left)"]->setItem(Item::get('Missile'));
        
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
		$this->locations["Energy Tank, Gauntlet"]->setRequirements(function($location, $items) {
			return $items->canEnterAndLeaveGauntlet();
        });

        $this->locations["Missile (Crateria gauntlet right)"]->setRequirements(function($location, $items) {
			return $items->canEnterAndLeaveGauntlet() && $items->canPassBombPassages();
        });

        $this->locations["Missile (Crateria gauntlet left)"]->setRequirements(function($location, $items) {
			return $items->canEnterAndLeaveGauntlet() && $items->canPassBombPassages();
        });
        
        $this->can_enter = function($locations, $items) {
			return $items->canDestroyBombWalls() || $items->has('SpeedBooster');
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

		$this->locations["Energy Tank, Gauntlet"]->setRequirements(function($location, $items) {
			return $items->canEnterAndLeaveGauntlet()
			    && $items->hasEnergyReserves(1)
				&& ($items->canFlySM() || $items->has('SpeedBooster'));
        });

        $this->locations["Missile (Crateria gauntlet right)"]->setRequirements(function($location, $items) {
			return $items->canEnterAndLeaveGauntlet() && $items->canPassBombPassages()
				&& $items->hasEnergyReserves(1)
				&& ($items->canFlySM() || $items->has('SpeedBooster'));
		});

        $this->locations["Missile (Crateria gauntlet left)"]->setRequirements(function($location, $items) {
			return $items->canEnterAndLeaveGauntlet() && $items->canPassBombPassages()
				&& $items->hasEnergyReserves(1)
				&& ($items->canFlySM() || $items->has('SpeedBooster'));
		});
        
        $this->can_enter = function($locations, $items) {
			return $items->canDestroyBombWalls() || $items->has('SpeedBooster');
		};

		return $this;
	}
}
