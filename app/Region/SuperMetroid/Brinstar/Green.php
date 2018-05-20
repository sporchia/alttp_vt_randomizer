<?php namespace ALttP\Region\SuperMetroid\Brinstar;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Green Brinstar Region and it's Locations contained within
 */
class Green extends Region {
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
            new Location\SuperMetroid\Chozo("Power Bomb (green Brinstar bottom)", 0xF784AC, null, $this),
            new Location\SuperMetroid\Visible("Missile (green Brinstar below super missile)", 0xF78518, null, $this),            
            new Location\SuperMetroid\Visible("Super Missile (green Brinstar top)", 0xF7851E, null, $this),            
            new Location\SuperMetroid\Chozo("Reserve Tank, Brinstar", 0xF7852C, null, $this),            
            new Location\SuperMetroid\Hidden("Missile (green Brinstar behind missile)", 0xF78532, null, $this),            
            new Location\SuperMetroid\Visible("Missile (green Brinstar behind reserve tank)", 0xF78538, null, $this),            
            new Location\SuperMetroid\Visible("Energy Tank, Etecoons", 0xF787C2, null, $this),            
            new Location\SuperMetroid\Visible("Super Missile (green Brinstar bottom)", 0xF787D0, null, $this),            
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Power Bomb (green Brinstar bottom)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Missile (green Brinstar below super missile)"]->setItem(Item::get('Missile'));
		$this->locations["Super Missile (green Brinstar top)"]->setItem(Item::get('Super'));
		$this->locations["Reserve Tank, Brinstar"]->setItem(Item::get('ReserveTank'));
		$this->locations["Missile (green Brinstar behind missile)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (green Brinstar behind reserve tank)"]->setItem(Item::get('Missile'));
		$this->locations["Energy Tank, Etecoons"]->setItem(Item::get('ETank'));
		$this->locations["Super Missile (green Brinstar bottom)"]->setItem(Item::get('Super'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament mode
	 *
	 * @return $this
	 */
	public function initTournament() {
		$this->locations["Power Bomb (green Brinstar bottom)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Missile (green Brinstar below super missile)"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages() && $items->canOpenRedDoors();
		});

        $this->locations["Super Missile (green Brinstar top)"]->setRequirements(function($location, $items) {
            return ($items->has('SpeedBooster') || $items->canDestroyBombWalls())
                && $items->canOpenRedDoors()
                && ($items->has('Morph') || $items->has('SpeedBooster'));
		});

        $this->locations["Reserve Tank, Brinstar"]->setRequirements(function($location, $items) {
            return ($items->has('SpeedBooster') || $items->canDestroyBombWalls())
                && $items->canOpenRedDoors()
                && ($items->has('Morph') || $items->has('SpeedBooster'));
		});

        $this->locations["Missile (green Brinstar behind missile)"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages() && $items->canOpenRedDoors();
		});

        $this->locations["Missile (green Brinstar behind reserve tank)"]->setRequirements(function($location, $items) {
			return $items->canOpenRedDoors() && $items->has('Morph');
		});

        $this->locations["Energy Tank, Etecoons"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Super Missile (green Brinstar bottom)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->has('Super');
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
		$this->locations["Power Bomb (green Brinstar bottom)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Missile (green Brinstar below super missile)"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages() && $items->canOpenRedDoors();
		});

        $this->locations["Super Missile (green Brinstar top)"]->setRequirements(function($location, $items) {
            return $items->has('SpeedBooster') && $items->canOpenRedDoors();
		});

        $this->locations["Reserve Tank, Brinstar"]->setRequirements(function($location, $items) {
            return $items->has('SpeedBooster') && $items->canOpenRedDoors();
		});

        $this->locations["Missile (green Brinstar behind missile)"]->setRequirements(function($location, $items) {
			return $items->has('SpeedBooster') && $items->canPassBombPassages() && $items->canOpenRedDoors();
		});

        $this->locations["Missile (green Brinstar behind reserve tank)"]->setRequirements(function($location, $items) {
			return $items->has('SpeedBooster') && $items->canOpenRedDoors() && $items->has('Morph');
		});

        $this->locations["Energy Tank, Etecoons"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Super Missile (green Brinstar bottom)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->has('Super');
		});

        $this->can_enter = function($locations, $items) {
			return $items->canDestroyBombWalls() || $items->has('SpeedBooster');
		};

		return $this;
	}
}
