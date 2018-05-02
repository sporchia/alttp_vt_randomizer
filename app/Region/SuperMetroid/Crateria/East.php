<?php namespace ALttP\Region\SuperMetroid\Crateria;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * East Crateria Region and it's Locations contained within
 */
class East extends Region {
	protected $name = 'Crateria';

	/**
	 * Create a new Crateria Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
            new Location\SuperMetroid\Visible("Missile (outside Wrecked Ship bottom)", 0xF781E8, null, $this),
            new Location\SuperMetroid\Hidden("Missile (outside Wrecked Ship top)", 0xF781EE, null, $this),
            new Location\SuperMetroid\Visible("Missile (outside Wrecked Ship middle)", 0xF781F4, null, $this),
            new Location\SuperMetroid\Visible("Missile (Crateria moat)", 0xF78248, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Missile (outside Wrecked Ship bottom)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (outside Wrecked Ship top)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (outside Wrecked Ship middle)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (Crateria moat)"]->setItem(Item::get('Missile'));
		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {

        $this->can_enter = function($locations, $items) {
			return $items->canUsePowerBombs() && $items->has('Super');
		};

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->initNoMajorGlitches();
	}
}
