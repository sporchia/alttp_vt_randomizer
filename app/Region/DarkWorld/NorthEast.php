<?php namespace ALttP\Region\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Shop;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\World;

/**
 * North East Dark World Region and it's Locations contained within
 */
class NorthEast extends Region {
	protected $name = 'Dark World';

	/**
	 * Create a new North East Dark World Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Standing("Catfish", 0xEE185, null, $this),
			new Location\Standing("Pyramid", 0x180147, null, $this),
			new Location\Trade("Pyramid Fairy - Sword", 0x180028, null, $this),
			new Location\Trade("Pyramid Fairy - Bow", 0x34914, null, $this),
			new Location\Prize\Event("Ganon", null, null, $this),
		]);

		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations->addItem(new Location\Chest("Pyramid Fairy - Left", 0xE980, null, $this));
			$this->locations->addItem(new Location\Chest("Pyramid Fairy - Right", 0xE983, null, $this));
		}

		$this->shops = new ShopCollection([
			new Shop("Dark World Potion Shop",                   0x03, 0xC1, 0x010F, 0x6F, $this),
			// Single entrance caves with no items in them ;)
			new Shop\TakeAny("East Dark World Hint",             0x83, 0xC1, 0x0112, 0x69, $this, [0xDBBDB => [0x58]]),
			new Shop\TakeAny("Palace of Darkness Hint",          0x83, 0xC1, 0x010F, 0x68, $this, [0xDBBDA => [0x60]]),
		]);

		$this->shops["Dark World Potion Shop"]->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('BlueShield'), 50)
			->addInventory(2, Item::get('TenBombs'), 50);

		// set these to not upgrade
		$this->locations["Pyramid Fairy - Sword"]->setItem(Item::get('L1Sword'));
		$this->locations["Pyramid Fairy - Bow"]->setItem(Item::get('Bow'));

		$this->prize_location = $this->locations["Ganon"];
		$this->prize_location->setItem(Item::get('DefeatGanon'));
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Catfish"]->setItem(Item::get('Quake'));
		$this->locations["Pyramid"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Pyramid Fairy - Sword"]->setItem(Item::get('L4Sword'));
		$this->locations["Pyramid Fairy - Bow"]->setItem(Item::get('BowAndSilverArrows'));

		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations["Pyramid Fairy - Left"]->setItem(Item::get('L4Sword'));
			$this->locations["Pyramid Fairy - Right"]->setItem(Item::get('SilverArrowUpgrade'));
		}

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Catfish"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl') && $items->canLiftRocks();
		});

		$this->locations["Pyramid Fairy - Sword"]->setRequirements(function($locations, $items) {
			return $items->hasSword() && $items->has('Crystal5') && $items->has('Crystal6') && $items->has('MoonPearl')
				&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
					&& ($items->has('Hammer')
						|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')));
		});

		$this->locations["Pyramid Fairy - Bow"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows() && $items->has('Crystal5') && $items->has('Crystal6') && $items->has('MoonPearl')
				&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
					&& ($items->has('Hammer')
						|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')));
		});


		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations["Pyramid Fairy - Left"]->setRequirements(function($locations, $items) {
				return $items->has('Crystal5') && $items->has('Crystal6') && $items->has('MoonPearl')
					&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
						&& ($items->has('Hammer')
							|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')));
			});

			$this->locations["Pyramid Fairy - Right"]->setRequirements(function($locations, $items) {
				return $items->has('Crystal5') && $items->has('Crystal6') && $items->has('MoonPearl')
					&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
						&& ($items->has('Hammer')
							|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')));
			});
		}

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& ($items->has('DefeatAgahnim')
					|| ($items->has('Hammer') && $items->canLiftRocks() && $items->has('MoonPearl'))
					|| ($items->canLiftDarkRocks() && $items->has('Flippers') && $items->has('MoonPearl')));
		};

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

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for MajorGlitches Mode
	 *
	 * @return $this
	 */
	public function initMajorGlitches() {
		$this->initOverworldGlitches();

		// @TODO: This should account for 2x YBA/1x YBA and S&Q from DM
		$this->locations["Catfish"]->setRequirements(function($locations, $items) {
			return $items->glitchedLinkInDarkWorld()
				&& ($items->canLiftRocks() || $items->has('PegasusBoots'));
		});

		$this->locations["Pyramid Fairy - Sword"]->setRequirements(function($locations, $items) {
			return $items->hasSword()
				&& (($items->has('MagicMirror') && $items->canSpinSpeed())
					|| ($items->has('Crystal5') && $items->has('Crystal6')
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
							&& (($items->has('Hammer') && $items->glitchedLinkInDarkWorld())
								|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')))));
		});

		$this->locations["Pyramid Fairy - Bow"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows()
				&& (($items->has('MagicMirror') && $items->canSpinSpeed())
					|| ($items->has('Crystal5') && $items->has('Crystal6')
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
							&& (($items->has('Hammer') && $items->glitchedLinkInDarkWorld())
								|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')))));
		});


		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations["Pyramid Fairy - Left"]->setRequirements(function($locations, $items) {
				return ($items->has('MagicMirror') && $items->canSpinSpeed())
					|| ($items->has('Crystal5') && $items->has('Crystal6')
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
							&& (($items->has('Hammer') && $items->glitchedLinkInDarkWorld())
								|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim'))));
			});

			$this->locations["Pyramid Fairy - Right"]->setRequirements(function($locations, $items) {
				return ($items->has('MagicMirror') && $items->canSpinSpeed())
					|| ($items->has('Crystal5') && $items->has('Crystal6')
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
							&& (($items->has('Hammer') && $items->glitchedLinkInDarkWorld())
								|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim'))));
			});
		}

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& ($items->has('DefeatAgahnim')
					|| ($items->has('MoonPearl')
						&& (($items->canLiftDarkRocks() && ($items->has('PegasusBoots') || $items->has('Flippers')))
							|| ($items->has('Hammer') && $items->canLiftRocks())))
					|| (($items->hasABottle()
						|| ($items->has('MagicMirror') && $items->canSpinSpeed())
						|| ($items->has('MoonPearl') && ($items->has('MagicMirror') || $items->has('PegasusBoots'))))
							&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)));
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

		$this->locations["Catfish"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& ($items->canLiftRocks() || $items->has('PegasusBoots'));
		});

		$this->locations["Pyramid Fairy - Sword"]->setRequirements(function($locations, $items) {
			return $items->hasSword()
				&& (($items->has('MagicMirror') && $items->canSpinSpeed())
					|| ($items->has('Crystal5') && $items->has('Crystal6')
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
							&& (($items->has('Hammer') && $items->has('MoonPearl'))
								|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')))));
		});

		$this->locations["Pyramid Fairy - Bow"]->setRequirements(function($locations, $items) {
			return $items->canShootArrows()
				&& (($items->has('MagicMirror') && $items->canSpinSpeed())
					|| ($items->has('Crystal5') && $items->has('Crystal6')
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
							&& (($items->has('Hammer') && $items->has('MoonPearl'))
								|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim')))));
		});


		if ($this->world->config('region.swordsInPool', true)) {
			$this->locations["Pyramid Fairy - Left"]->setRequirements(function($locations, $items) {
				return ($items->has('MagicMirror') && $items->canSpinSpeed())
					|| ($items->has('Crystal5') && $items->has('Crystal6')
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
							&& (($items->has('Hammer') && $items->has('MoonPearl'))
								|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim'))));
			});

			$this->locations["Pyramid Fairy - Right"]->setRequirements(function($locations, $items) {
				return ($items->has('MagicMirror') && $items->canSpinSpeed())
					|| ($items->has('Crystal5') && $items->has('Crystal6')
						&& $this->world->getRegion('South Dark World')->canEnter($locations, $items)
							&& (($items->has('Hammer') && $items->has('MoonPearl'))
								|| ($items->has('MagicMirror') && $items->has('DefeatAgahnim'))));
			});
		}

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& ($items->has('DefeatAgahnim')
					|| ($items->has('MoonPearl')
						&& (($items->canLiftDarkRocks() && ($items->has('PegasusBoots') || $items->has('Flippers')))
							|| ($items->has('Hammer') && $items->canLiftRocks())))
					|| ((($items->has('MagicMirror') && $items->canSpinSpeed())
						|| ($items->has('MoonPearl') && ($items->has('MagicMirror') || $items->has('PegasusBoots'))))
							&& $this->world->getRegion('West Death Mountain')->canEnter($locations, $items)));
		};

		return $this;
	}
}
