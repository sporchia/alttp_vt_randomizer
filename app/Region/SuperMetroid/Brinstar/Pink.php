<?php namespace ALttP\Region\SuperMetroid\Brinstar;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Pink Brinstar Region and it's Locations contained within
 */
class Pink extends Region {
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
			new Location\SuperMetroid\Chozo("Super Missile (pink Brinstar)", 0xF784E4, null, $this),
			new Location\SuperMetroid\Visible("Missile (pink Brinstar top)", 0xF78608, null, $this),
			new Location\SuperMetroid\Visible("Missile (pink Brinstar bottom)", 0xF7860E, null, $this),
			new Location\SuperMetroid\Chozo("Charge Beam", 0xF78614, null, $this),
			new Location\SuperMetroid\Visible("Power Bomb (pink Brinstar)", 0xF7865C, null, $this),
			new Location\SuperMetroid\Visible("Missile (green Brinstar pipe)", 0xF78676, null, $this),
			new Location\SuperMetroid\Visible("Energy Tank, Waterway", 0xF787FA, null, $this),
			new Location\SuperMetroid\Visible("Energy Tank, Brinstar Gate", 0xF78824, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Super Missile (pink Brinstar)"]->setItem(Item::get('Super'));
		$this->locations["Missile (pink Brinstar top)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (pink Brinstar bottom)"]->setItem(Item::get('Missile'));
		$this->locations["Charge Beam"]->setItem(Item::get('Charge'));
		$this->locations["Power Bomb (pink Brinstar)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Missile (green Brinstar pipe)"]->setItem(Item::get('Missile'));
		$this->locations["Energy Tank, Waterway"]->setItem(Item::get('ETank'));
		$this->locations["Energy Tank, Brinstar Gate"]->setItem(Item::get('ETank'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
		$this->locations["Super Missile (pink Brinstar)"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages() && $items->has('Super');
		});

        $this->locations["Charge Beam"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages();
		});

        $this->locations["Power Bomb (pink Brinstar)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->has('Super');
		});

        $this->locations["Missile (green Brinstar pipe)"]->setRequirements(function($location, $items) {
			return $items->has('Morph') && ($items->has('PowerBomb') || $items->has('Super') || $items->canAccessNorfairPortal());
		});

        $this->locations["Energy Tank, Waterway"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->canOpenRedDoors() && $items->has('SpeedBooster') && $items->hasEnergyReserves(1);
		});

        $this->locations["Energy Tank, Brinstar Gate"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && ($items->has('Wave') || $items->has('Super'));
		});

        $this->can_enter = function($locations, $items) {
			return ($items->canOpenRedDoors() && ($items->canDestroyBombWalls() || $items->has('SpeedBooster')))
				|| $items->canUsePowerBombs()
				|| ($items->canAccessNorfairPortal() && $items->has('Morph') && ($items->canOpenRedDoors() || $items->has('Wave')) && ($items->has('Ice') || $items->has('HiJump') || $items->canSpringBallJump() || $items->canFlySM()));
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
		$this->locations["Super Missile (pink Brinstar)"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages() && $items->has('Super');
		});

        $this->locations["Charge Beam"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages();
		});

        $this->locations["Power Bomb (pink Brinstar)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->has('Super') && $items->hasEnergyReserves(1);
		});

        $this->locations["Missile (green Brinstar pipe)"]->setRequirements(function($location, $items) {
			return $items->has('Morph') && ($items->has('PowerBomb') || $items->has('Super') || $items->canAccessNorfairPortal());
		});

        $this->locations["Energy Tank, Waterway"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->canOpenRedDoors() && $items->has('SpeedBooster') && $items->hasEnergyReserves(1);
		});

        $this->locations["Energy Tank, Brinstar Gate"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->has('Wave') && $items->hasEnergyReserves(1);
		});

        $this->can_enter = function($locations, $items) {
			return ($items->canOpenRedDoors() && ($items->canDestroyBombWalls() || $items->has('SpeedBooster')))
				|| $items->canUsePowerBombs()
				|| ($items->canAccessNorfairPortal() && $items->has('Morph') && $items->has('Wave') && ($items->has('Ice') || $items->has('HiJump') || $items->has('SpaceJump')));
		};

		return $this;
	}
}
