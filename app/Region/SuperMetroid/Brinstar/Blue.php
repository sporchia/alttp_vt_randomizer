<?php namespace ALttP\Region\SuperMetroid\Brinstar;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Blue Brinstar Region and it's Locations contained within
 */
class Blue extends Region {
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
            new Location\SuperMetroid\Visible("Morphing Ball", 0xF786EC, null, $this),
            new Location\SuperMetroid\Visible("Power Bomb (blue Brinstar)", 0xF7874C, null, $this),
            new Location\SuperMetroid\Visible("Missile (blue Brinstar middle)", 0xF78798, null, $this),
            new Location\SuperMetroid\Hidden("Energy Tank, Brinstar Ceiling", 0xF7879E, null, $this),
            new Location\SuperMetroid\Chozo("Missile (blue Brinstar bottom)", 0xF78802, null, $this),
            new Location\SuperMetroid\Visible("Missile (blue Brinstar top)", 0xF78836, null, $this),
            new Location\SuperMetroid\Hidden("Missile (blue Brinstar behind missile)", 0xF7883C, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Morphing Ball"]->setItem(Item::get('Morph'));
		$this->locations["Power Bomb (blue Brinstar)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Missile (blue Brinstar middle)"]->setItem(Item::get('Missile'));
		$this->locations["Energy Tank, Brinstar Ceiling"]->setItem(Item::get('ETank'));
		$this->locations["Missile (blue Brinstar bottom)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (blue Brinstar top)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (blue Brinstar behind missile)"]->setItem(Item::get('Missile'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
		$this->locations["Power Bomb (blue Brinstar)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Missile (blue Brinstar middle)"]->setRequirements(function($location, $items) {
			return $items->has('Morph');
		});

        $this->locations["Missile (blue Brinstar bottom)"]->setRequirements(function($location, $items) {
			return $items->has('Morph');
		});

        $this->locations["Missile (blue Brinstar top)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Missile (blue Brinstar behind missile)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Casual Mode
	 *
	 * @return $this
	 */

	public function initCasual() {
		$this->locations["Power Bomb (blue Brinstar)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Missile (blue Brinstar middle)"]->setRequirements(function($location, $items) {
			return $items->has('Morph');
		});

        $this->locations["Missile (blue Brinstar bottom)"]->setRequirements(function($location, $items) {
			return $items->has('Morph');
		});

        $this->locations["Missile (blue Brinstar top)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Missile (blue Brinstar behind missile)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs();
		});

        $this->locations["Energy Tank, Brinstar Ceiling"]->setRequirements(function($location, $items) {
			return $items->canFlySM() || $items->has('HiJump') || $items->has('SpeedBooster') || $items->has('IceBeam');
		});		

		return $this;
	}
}
