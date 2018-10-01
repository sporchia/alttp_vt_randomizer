<?php namespace ALttP\Region\Inverted\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * North East Light World Region and it's Locations contained within
 */
class NorthEast extends Region\Standard\LightWorld\NorthEast {
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations->addItem(new Location\Prize\Event("Ganon", null, null, $this));

		$this->prize_location = $this->locations["Ganon"];
		$this->prize_location->setItem(Item::get('DefeatGanon'));
	}
	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		$this->locations["Sahasrahla's Hut - Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});

		$this->locations["Sahasrahla's Hut - Middle"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});
		
		$this->locations["Sahasrahla's Hut - Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canBombThings();
		});
		
		$this->locations["Sahasrahla"]->setRequirements(function($locations, $items) {
			return $items->has('PendantOfCourage');
		});

		$this->locations["King Zora"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && ($items->canLiftRocks() || $items->has('Flippers'));
		});

		$this->locations["Potion Shop"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Mushroom');
		});

		$this->locations["Zora's Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers');
		});

		$this->locations["Waterfall Fairy - Left"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers');
		});

		$this->locations["Waterfall Fairy - Right"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers');
		});

		$this->prize_location->setRequirements(function($locations, $items) {
			if ($this->world->getGoal() == 'dungeons'
				&& (!$items->has('PendantOfCourage')
					|| !$items->has('PendantOfWisdom')
					|| !$items->has('PendantOfPower')
					|| !$items->has('DefeatAgahnim')
					|| !$items->has('Crystal1')
					|| !$items->has('Crystal2')
					|| !$items->has('Crystal3')
					|| !$items->has('Crystal4')
					|| !$items->has('Crystal5')
					|| !$items->has('Crystal6')
					|| !$items->has('Crystal7')
					|| !$items->has('DefeatAgahnim2'))) {
				return false;
			}

			if ($this->world->getGoal() == 'ganon'
				&& (!$items->has('Crystal1')
					|| !$items->has('Crystal2')
					|| !$items->has('Crystal3')
					|| !$items->has('Crystal4')
					|| !$items->has('Crystal5')
					|| !$items->has('Crystal6')
					|| !$items->has('Crystal7'))) {
				return false;
			}

			return $items->has('MoonPearl')
				&& $items->has('DefeatAgahnim2')
				&& (!$this->world->config('region.requireBetterBow', false) || $items->canShootArrows(2))
				&& (
					($this->world->config('mode.weapons') == 'swordless' && $items->has('Hammer'))
					|| (!$this->world->config('region.requireBetterSword', false) &&
						($items->hasSword(2) && ($items->has('Lamp') || ($items->has('FireRod') && $items->canExtendMagic(3)))))
					|| ($items->hasSword(3) && ($items->has('Lamp') || ($items->has('FireRod') && $items->canExtendMagic(2))))
				);
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('DefeatAgahnim')
				|| ($items->has('MoonPearl')
					&& (($items->has('Hammer') && $items->canLiftRocks())
						|| $items->canLiftDarkRocks()));
		};

		return $this;
	}
}
