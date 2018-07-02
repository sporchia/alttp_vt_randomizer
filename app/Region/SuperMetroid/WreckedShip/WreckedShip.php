<?php namespace ALttP\Region\SuperMetroid\WreckedShip;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * WreckedShip Region and it's Locations contained within
 */
class WreckedShip extends Region {
	protected $name = 'Wrecked Ship';

	/**
	 * Create a new WreckedShip Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world, 'SM');

		$this->locations = new LocationCollection([
			new Location\SuperMetroid\Visible("Missile (Wrecked Ship middle)", 0xF7C265, null, $this),
			new Location\SuperMetroid\Chozo("Reserve Tank, Wrecked Ship", 0xF7C2E9, null, $this),
			new Location\SuperMetroid\Visible("Missile (Gravity Suit)", 0xF7C2EF, null, $this),
			new Location\SuperMetroid\Visible("Missile (Wrecked Ship top)", 0xF7C319, null, $this),
			new Location\SuperMetroid\Visible("Energy Tank, Wrecked Ship", 0xF7C337, null, $this),
			new Location\SuperMetroid\Visible("Super Missile (Wrecked Ship left)", 0xF7C357, null, $this),
			new Location\SuperMetroid\Visible("Right Super, Wrecked Ship", 0xF7C365, null, $this),
			new Location\SuperMetroid\Chozo("Gravity Suit", 0xF7C36D, null, $this),
			new Location\Prize\Event("Phantoon", null, null, $this),
		]);

		$this->prize_location = $this->locations["Phantoon"];
		$this->prize_location->setItem(Item::get('DefeatPhantoon'));
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Missile (Wrecked Ship middle)"]->setItem(Item::get('Missile'));
		$this->locations["Reserve Tank, Wrecked Ship"]->setItem(Item::get('ReserveTank'));
		$this->locations["Missile (Gravity Suit)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (Wrecked Ship top)"]->setItem(Item::get('Missile'));
		$this->locations["Energy Tank, Wrecked Ship"]->setItem(Item::get('ETank'));
		$this->locations["Super Missile (Wrecked Ship left)"]->setItem(Item::get('Super'));
		$this->locations["Right Super, Wrecked Ship"]->setItem(Item::get('Super'));
		$this->locations["Gravity Suit"]->setItem(Item::get('Gravity'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
		$this->locations["Reserve Tank, Wrecked Ship"]->setRequirements(function($location, $items) {
			return $items->has('SpeedBooster') && ($items->has('Varia') || $items->hasEnergyReserves(2));
		});

        $this->locations["Missile (Gravity Suit)"]->setRequirements(function($location, $items) {
			return $items->has('Varia') || $items->hasEnergyReserves(1);
		});

        $this->locations["Gravity Suit"]->setRequirements(function($location, $items) {
			return $items->has('Varia') || $items->hasEnergyReserves(1);
		});

        $this->locations["Energy Tank, Wrecked Ship"]->setRequirements(function($location, $items) {
            return $items->has('Bomb') 
                || $items->has('PowerBomb')
                || $items->has('HiJump')
                || $items->has('SpaceJump')
                || $items->has('SpeedBooster')
				|| $items->has('SpringBall')
				|| $items->has('Gravity');
		});

        $this->can_enter = function($locations, $items) {
			return $items->has('Super') && ($items->canUsePowerBombs() || ($items->canAccessMaridiaPortal() && $items->has('HiJump') && $items->canPassBombPassages()));
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
		$this->locations["Reserve Tank, Wrecked Ship"]->setRequirements(function($location, $items) {
			return $items->has('SpeedBooster') 
			    && ($items->has('Grapple') || ($items->has('Varia') && $items->hasEnergyReserves(2)) || $items->hasEnergyReserves(3));
		});

        $this->locations["Missile (Gravity Suit)"]->setRequirements(function($location, $items) {
			return ($items->has('Grapple') || ($items->has('Varia') && $items->hasEnergyReserves(2)) || $items->hasEnergyReserves(3));
		});

        $this->locations["Gravity Suit"]->setRequirements(function($location, $items) {
			return ($items->has('Grapple') || ($items->has('Varia') && $items->hasEnergyReserves(2)) || $items->hasEnergyReserves(3));
		});

        $this->locations["Energy Tank, Wrecked Ship"]->setRequirements(function($location, $items) {
            return $items->has('HiJump')
                || $items->has('SpaceJump')
                || $items->has('SpeedBooster')
				|| $items->has('Gravity');
		});

        $this->can_enter = function($locations, $items) {
			return $items->canUsePowerBombs() && $items->has('Super') && ($items->has('SpeedBooster') || $items->has('Grapple') || $items->has('SpaceJump') || $items->has('SpringBall'));
		};
		
		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
