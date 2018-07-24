<?php namespace ALttP\Region\SuperMetroid\Norfair;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * West Norfair Region and it's Locations contained within
 */
class West extends Region {
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
            new Location\SuperMetroid\Chozo("Ice Beam", 0xF78B24, null, $this),
            new Location\SuperMetroid\Hidden("Missile (below Ice Beam)", 0xF78B46, null, $this),
            new Location\SuperMetroid\Chozo("Hi-Jump Boots", 0xF78BAC, null, $this),
            new Location\SuperMetroid\Visible("Missile (Hi-Jump Boots)", 0xF78BE6, null, $this),
            new Location\SuperMetroid\Visible("Energy Tank (Hi-Jump Boots)", 0xF78BEC, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Ice Beam"]->setItem(Item::get('Ice'));
		$this->locations["Missile (below Ice Beam)"]->setItem(Item::get('Missile'));
		$this->locations["Hi-Jump Boots"]->setItem(Item::get('HiJump'));
		$this->locations["Missile (Hi-Jump Boots)"]->setItem(Item::get('Missile'));
		$this->locations["Energy Tank (Hi-Jump Boots)"]->setItem(Item::get('ETank'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
		$this->locations["Ice Beam"]->setRequirements(function($location, $items) {
			return $items->has('Super') && $items->has('Morph') && ($items->heatProof() || $items->hasEnergyReserves(3));
        });

        $this->locations["Missile (below Ice Beam)"]->setRequirements(function($location, $items) {
			return ($items->has('Super') && $items->canUsePowerBombs() && ($items->hasEnergyReserves(3) || $items->heatProof())) || ($items->has('Varia') && $items->has('SpeedBooster') && $items->has('Super'));
        });

		$this->locations["Energy Tank (Hi-Jump Boots)"]->setRequirements(function($location, $items) {
			return $items->canOpenRedDoors();
        });

        $this->locations["Hi-Jump Boots"]->setRequirements(function($location, $items) {
			return $items->canOpenRedDoors() && $items->canPassBombPassages();
        });

        $this->locations["Missile (Hi-Jump Boots)"]->setRequirements(function($location, $items) {
			return $items->canOpenRedDoors() && $items->has('Morph');
        });

        $this->can_enter = function($locations, $items) {
            return (($items->canDestroyBombWalls() || $items->has('SpeedBooster'))
                && ($items->has('Super') && $items->has('Morph')))
                || $items->canAccessNorfairPortal();
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
		$this->locations["Ice Beam"]->setRequirements(function($location, $items) {
			return $items->has('Super') && $items->canPassBombPassages() && $items->has('Varia') && $items->has('SpeedBooster');
        });

        $this->locations["Missile (below Ice Beam)"]->setRequirements(function($location, $items) {
			return $items->has('Super') && $items->canUsePowerBombs() && $items->has('Varia') && $items->has('SpeedBooster');
        });

		$this->locations["Energy Tank (Hi-Jump Boots)"]->setRequirements(function($location, $items) {
			return $items->canOpenRedDoors();
        });

        $this->locations["Hi-Jump Boots"]->setRequirements(function($location, $items) {
			return $items->canOpenRedDoors() && $items->canPassBombPassages();
        });

        $this->locations["Missile (Hi-Jump Boots)"]->setRequirements(function($location, $items) {
			return $items->canOpenRedDoors() && $items->has('Morph');
        });

        $this->can_enter = function($locations, $items) {
            return (($items->canDestroyBombWalls() || $items->has('SpeedBooster'))
                && ($items->has('Super') && $items->has('Morph')))
                || $items->canAccessNorfairPortal();
        };
        
		return $this;
	}
}
