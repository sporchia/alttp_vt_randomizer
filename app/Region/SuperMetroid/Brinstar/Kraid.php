<?php namespace ALttP\Region\SuperMetroid\Brinstar;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Kraid's Lair Brinstar Region and it's Locations contained within
 */
class Kraid extends Region {
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
			new Location\SuperMetroid\Hidden("Energy Tank, Kraid", 0xF7899C, null, $this),
			new Location\SuperMetroid\Chozo("Varia Suit", 0xF78ACA, null, $this),
			new Location\SuperMetroid\Hidden("Missile (Kraid)", 0xF789EC, null, $this),
			new Location\Prize\Event("Kraid", null, null, $this),
		]);		

		$this->prize_location = $this->locations["Kraid"];
		$this->prize_location->setItem(Item::get('DefeatKraid'));		
    }

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Energy Tank, Kraid"]->setItem(Item::get('ETank'));
		$this->locations["Varia Suit"]->setItem(Item::get('Varia'));
		$this->locations["Missile (Kraid)"]->setItem(Item::get('Missile'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
        
        $this->locations["Missile (Kraid)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
        });
        
        $this->can_enter = function($locations, $items) {
            return ($items->canDestroyBombWalls() || $items->has('SpeedBooster') || $items->canAccessNorfairPortal())
                && ($items->has('Super') && $items->has('Morph'))
                && $items->canPassBombPassages();
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
		return $this->initTournament();
	}
}
