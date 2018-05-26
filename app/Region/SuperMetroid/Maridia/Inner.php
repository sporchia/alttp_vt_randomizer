<?php namespace ALttP\Region\SuperMetroid\Maridia;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Inner Maridia Region and it's Locations contained within
 */
class Inner extends Region {
	protected $name = 'Maridia';

	/**
	 * Create a new Maridia Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world, 'SM');

		$this->locations = new LocationCollection([
            new Location\SuperMetroid\Visible("Super Missile (yellow Maridia)", 0xF7C4AF, null, $this),            
			new Location\SuperMetroid\Visible("Missile (yellow Maridia super missile)", 0xF7C4B5, null, $this),
			new Location\SuperMetroid\Visible("Missile (yellow Maridia false wall)", 0xF7C533, null, $this),
			new Location\SuperMetroid\Chozo("Plasma Beam", 0xF7C559, null, $this),
			new Location\SuperMetroid\Visible("Missile (left Maridia sand pit room)", 0xF7C5DD, null, $this),
			new Location\SuperMetroid\Chozo("Reserve Tank, Maridia", 0xF7C5E3, null, $this),
			new Location\SuperMetroid\Visible("Missile (right Maridia sand pit room)", 0xF7C5EB, null, $this),
			new Location\SuperMetroid\Visible("Power Bomb (right Maridia sand pit room)", 0xF7C5F1, null, $this),
			new Location\SuperMetroid\Visible("Missile (pink Maridia)", 0xF7C603, null, $this),
			new Location\SuperMetroid\Visible("Super Missile (pink Maridia)", 0xF7C609, null, $this),
			new Location\SuperMetroid\Chozo("Spring Ball", 0xF7C6E5, null, $this),
			new Location\SuperMetroid\Hidden("Missile (Draygon)", 0xF7C74D, null, $this),
			new Location\SuperMetroid\Visible("Energy Tank, Botwoon", 0xF7C755, null, $this),
			new Location\SuperMetroid\Chozo("Space Jump", 0xF7C7A7, null, $this),
			new Location\Prize\Event("Draygon", null, null, $this),
		]);
		
		$this->prize_location = $this->locations["Draygon"];
		$this->prize_location->setItem(Item::get('DefeatDraygon'));
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Super Missile (yellow Maridia)"]->setItem(Item::get('Super'));
		$this->locations["Missile (yellow Maridia super missile)"]->setItem(Item::get('Missile'));
		$this->locations["Missile (yellow Maridia false wall)"]->setItem(Item::get('Missile'));
		$this->locations["Plasma Beam"]->setItem(Item::get('Plasma'));
		$this->locations["Missile (left Maridia sand pit room)"]->setItem(Item::get('Missile'));
		$this->locations["Reserve Tank, Maridia"]->setItem(Item::get('ReserveTank'));
		$this->locations["Missile (right Maridia sand pit room)"]->setItem(Item::get('Missile'));
		$this->locations["Power Bomb (right Maridia sand pit room)"]->setItem(Item::get('PowerBomb'));
		$this->locations["Missile (pink Maridia)"]->setItem(Item::get('Missile'));
		$this->locations["Super Missile (pink Maridia)"]->setItem(Item::get('Super'));
		$this->locations["Spring Ball"]->setItem(Item::get('SpringBall'));
		$this->locations["Missile (Draygon)"]->setItem(Item::get('Missile'));
		$this->locations["Energy Tank, Botwoon"]->setItem(Item::get('ETank'));
		$this->locations["Space Jump"]->setItem(Item::get('SpaceJump'));
        return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Tournament
	 *
	 * @return $this
	 */
	public function initTournament() {
        
        $this->locations["Plasma Beam"]->setRequirements(function($location, $items) {
            return $items->canDefeatDraygon()
                && ($items->has('SpeedBooster')
                 || ((($items->has('ChargeBeam') && ($items->hasEnergyReserves(4) || ($items->has('Varia') && $items->hasEnergyReserves(1)))) || $items->has('Plasma') || $items->has('ScrewAttack')) && ($items->canFlySM() || $items->has('HiJump'))));                 
		});

        $this->locations["Power Bomb (right Maridia sand pit room)"]->setRequirements(function($location, $items) {
            return $items->has('Gravity');
		});

        $this->locations["Missile (pink Maridia)"]->setRequirements(function($location, $items) {
            return $items->has('Gravity') && $items->has('SpeedBooster');
		});

        $this->locations["Super Missile (pink Maridia)"]->setRequirements(function($location, $items) {
            return $items->has('Gravity') && $items->has('SpeedBooster');
		});

        $this->locations["Spring Ball"]->setRequirements(function($location, $items) {
            return $items->has('Gravity') && ($items->has('Grapple') && ($items->canFlySM() || $items->has('HiJump')));
		});

        $this->locations["Missile (Draygon)"]->setRequirements(function($location, $items) {
            return $items->canDefeatBotwoon();
		});

        $this->locations["Energy Tank, Botwoon"]->setRequirements(function($location, $items) {
            return $items->canDefeatBotwoon();
		});

        $this->locations["Space Jump"]->setRequirements(function($location, $items) {
            return $items->canDefeatDraygon();
		});

        $this->can_enter = function($locations, $items) {
            return $this->world->getRegion('Outer Maridia')->canEnter($locations, $items)
                && ($items->has('Gravity') || ($items->has('Grapple') && $items->has('HiJump') && $items->has('IceBeam')));
        };
		
		$this->can_complete = function($locations, $items) {
			return ($this->canEnter($locations, $items) && $items->canDefeatBotwoon() && $items->canDefeatDraygon());
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
        
        $this->locations["Plasma Beam"]->setRequirements(function($location, $items) {
            return $items->canDefeatDraygon()
                && ($items->has('Plasma') || $items->has('ScrewAttack'))
				&& ($items->canFlySM() || $items->has('HiJump'));          
		});

        $this->locations["Missile (pink Maridia)"]->setRequirements(function($location, $items) {
            return $items->has('SpeedBooster');
		});

        $this->locations["Super Missile (pink Maridia)"]->setRequirements(function($location, $items) {
            return $items->has('SpeedBooster');
		});

        $this->locations["Spring Ball"]->setRequirements(function($location, $items) {
            return ($items->has('Grapple') && ($items->has('SpaceJump') || $items->has('HiJump')));
		});

        $this->locations["Missile (Draygon)"]->setRequirements(function($location, $items) {
            return $items->canDefeatBotwoon();
		});

        $this->locations["Energy Tank, Botwoon"]->setRequirements(function($location, $items) {
            return $items->canDefeatBotwoon();
		});

        $this->locations["Space Jump"]->setRequirements(function($location, $items) {
            return $items->canDefeatDraygon() && ($items->canFlySM() || ($items->has('SpeedBooster') && $items->has('HiJump')));
		});

        $this->can_enter = function($locations, $items) {
			return $this->world->getRegion('Outer Maridia')->canEnter($locations, $items)
			    && ($items->canFlySM() || $items->has('Grapple') || $items->has('SpeedBooster') || $items->canAccessMaridiaPortal());
        };
		
		$this->can_complete = function($locations, $items) {
			return ($this->canEnter($locations, $items) && $items->canDefeatBotwoon() && $items->canDefeatDraygon());
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}
}
