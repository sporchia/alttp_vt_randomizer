<?php namespace ALttP\Region\SuperMetroid\Crateria;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Central Crateria Region and it's Locations contained within
 */
class Central extends Region {
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
			new Location\SuperMetroid\Visible("Power Bomb (Crateria surface)", 0xF781CC, null, $this),
			new Location\SuperMetroid\Visible("Missile (Crateria middle)", 0xF78486, null, $this),
			new Location\SuperMetroid\Visible("Missile (Crateria bottom)", 0xF783EE, null, $this),
			new Location\SuperMetroid\Visible("Super Missile (Crateria)", 0xF78478, null, $this),
			new Location\SuperMetroid\Chozo("Bombs", 0xF78404, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Power Bomb (Crateria surface)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Missile (Crateria middle)"]->setItem(Item::Get('Missile'));
		$this->locations["Missile (Crateria bottom)"]->setItem(Item::get('Missile'));
		$this->locations["Super Missile (Crateria)"]->setItem(Item::get('Super'));
		$this->locations["Bombs"]->setItem(Item::get('Bombs'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament Logic
	 *
	 * @return $this
	 */
	public function initTournament() {
		$this->locations["Power Bomb (Crateria surface)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && ($items->has('SpeedBooster') || $items->canFlySM());
		});

		$this->locations["Missile (Crateria middle)"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages();
		});

		$this->locations["Missile (Crateria bottom)"]->setRequirements(function($location, $items) {
			return $items->canDestroyBombWalls();
		});

		$this->locations["Super Missile (Crateria)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->hasEnergyReserves(2) && $items->has('SpeedBooster');
		});

		$this->locations["Bombs"]->setRequirements(function($location, $items) {
			return $items->has('Morph') && $items->has('Missile');
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
		$this->locations["Power Bomb (Crateria surface)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && ($items->has('SpeedBooster') || $items->canFlySM());
		});

		$this->locations["Missile (Crateria middle)"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages();
		});

		$this->locations["Missile (Crateria bottom)"]->setRequirements(function($location, $items) {
			return $items->canDestroyBombWalls();
		});

		$this->locations["Super Missile (Crateria)"]->setRequirements(function($location, $items) {
			return $items->canUsePowerBombs() && $items->hasEnergyReserves(2) && $items->has('SpeedBooster');
		});

		$this->locations["Bombs"]->setRequirements(function($location, $items) {
			return $items->canPassBombPassages() && $items->has('Missile');
		});

		return $this;		
	}
}
