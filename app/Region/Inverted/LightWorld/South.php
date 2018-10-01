<?php namespace ALttP\Region\Inverted\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * South Light World Region and it's Locations contained within
 */
class South extends Region\Standard\LightWorld\South {
	/**
	 * Create a new Light World Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations->removeItem("Link's House");
		$this->locations->addItem(new Location\Prize\Event("Bomb Merchant", null, null, $this));

		$this->locations["Bomb Merchant"]->setItem(Item::get('BigRedBomb'));
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		$this->shops["20 Rupee Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks();
		});

		$this->shops["50 Rupee Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks();
		});

		$this->shops["Bonk Fairy (Light)"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('PegasusBoots');
		});

		$this->shops["Light Hype Fairy"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->shops["Capacity Upgrade"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers');
		});

		$this->locations["Floodgate Chest"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Bomb Merchant"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Crystal5')
				&& $items->has('Crystal6');
		});

		$this->locations["Aginah's Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Mini Moldorm Cave - Far Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Mini Moldorm Cave - Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Mini Moldorm Cave - Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Mini Moldorm Cave - Far Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Ice Rod Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Hobo"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers');
		});

		$this->locations["Bombos Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && ($items->hasSword(2)
					|| ($this->world->config('mode.weapons') == 'swordless' && $items->has('Hammer')));
		});

		$this->locations["Cave 45"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Checkerboard Cave"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks();
		});

		$this->locations["Mini Moldorm Cave - NPC"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Library"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('PegasusBoots');
		});

		$this->locations["Maze Race"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && ($items->has('PegasusBoots') || $items->canBombThings());
		});

		$this->locations["Desert Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('Desert Palace')->canEnter($locations, $items);
		});

		$this->locations["Lake Hylia Island"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers');
		});

		$this->locations["Sunken Treasure"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl');
		});

		$this->locations["Flute Spot"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Shovel');
		});

		$this->can_enter = function($locations, $items) {
			return $this->world->getRegion('North East Light World')->canEnter($locations, $items);
		};

		return $this;
	}
}
