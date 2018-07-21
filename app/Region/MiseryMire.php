<?php namespace ALttP\Region;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Misery Mire Region and it's Locations contained within
 */
class MiseryMire extends Region {
	protected $name = 'Misery Mire';
	public $music_addresses = [
		0x155B9,
	];

	protected $map_reveal = 0x0100;

	protected $region_items = [
		'BigKey',
		'BigKeyD6',
		'Compass',
		'CompassD6',
		'Key',
		'KeyD6',
		'Map',
		'MapD6',
	];

	/**
	 * Create a new Misery Mire Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->boss = Boss::get("Vitreous");

		$this->locations = new LocationCollection([
			new Location\BigChest("Misery Mire - Big Chest", 0xEA67, null, $this),
			new Location\Chest("Misery Mire - Main Lobby", 0xEA5E, null, $this),
			new Location\Chest("Misery Mire - Big Key Chest", 0xEA6D, null, $this),
			new Location\Chest("Misery Mire - Compass Chest", 0xEA64, null, $this),
			new Location\Chest("Misery Mire - Bridge Chest", 0xEA61, null, $this),
			new Location\Chest("Misery Mire - Map Chest", 0xEA6A, null, $this),
			new Location\Chest("Misery Mire - Spike Chest", 0xE9DA, null, $this),
			new Location\Drop("Misery Mire - Vitreous", 0x180158, null, $this),

			new Location\Prize\Crystal("Misery Mire - Prize", [null, 0x120A2, 0x53F48, 0x53F49, 0x180057, 0x180075, 0xC703], null, $this),
		]);

		$this->prize_location = $this->locations["Misery Mire - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Misery Mire - Big Chest"]->setItem(Item::get('CaneOfSomaria'));
		$this->locations["Misery Mire - Main Lobby"]->setItem(Item::get('KeyD6'));
		$this->locations["Misery Mire - Big Key Chest"]->setItem(Item::get('BigKeyD6'));
		$this->locations["Misery Mire - Compass Chest"]->setItem(Item::get('CompassD6'));
		$this->locations["Misery Mire - Bridge Chest"]->setItem(Item::get('KeyD6'));
		$this->locations["Misery Mire - Map Chest"]->setItem(Item::get('MapD6'));
		$this->locations["Misery Mire - Spike Chest"]->setItem(Item::get('KeyD6'));
		$this->locations["Misery Mire - Vitreous"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Misery Mire - Prize"]->setItem(Item::get('Crystal6'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Misery Mire - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD6');
		});

		$this->locations["Misery Mire - Spike Chest"]->setRequirements(function($locations, $items) {
			return !$this->world->config('region.cantTakeDamage', false)
					|| $items->has('CaneOfByrna') || $items->has('Cape');
		});

		$this->locations["Misery Mire - Main Lobby"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD6') || $items->has('BigKeyD6');
		});

		$this->locations["Misery Mire - Map Chest"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD6') || $items->has('BigKeyD6');
		});

		$this->locations["Misery Mire - Big Key Chest"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches()
				&& (($locations["Misery Mire - Compass Chest"]->hasItem(Item::get('BigKeyD6')) && $items->has('KeyD6', 2))
				|| $items->has('KeyD6', 3));
		});

		$this->locations["Misery Mire - Compass Chest"]->setRequirements(function($locations, $items) {
			return $items->canLightTorches()
				&& (($locations["Misery Mire - Big Key Chest"]->hasItem(Item::get('BigKeyD6')) && $items->has('KeyD6', 2))
				|| $items->has('KeyD6', 3));
		});

		$this->can_complete = function($locations, $items) {
			return $this->locations["Misery Mire - Vitreous"]->canAccess($items);
		};

		$this->locations["Misery Mire - Vitreous"]->setRequirements(function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('CaneOfSomaria') && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))
				&& $items->has('BigKeyD6')
				&& $this->boss->canBeat($items, $locations)
				&& (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD6'))
				&& (!$this->world->config('region.wildMaps', false) || $items->has('MapD6'));
		})->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& ($item instanceof Item\Key || $item instanceof Item\BigKey
						|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
					return false;
				}

			return true;
		})->setAlwaysAllow(function($item, $items) {
			return $this->world->config('region.bossNormalLocation', true)
				&& ($item == Item::get('CompassD6') || $item == Item::get('MapD6'));
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& ((($locations["Misery Mire Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
						|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
						|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
					&& ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword()))
				&& $items->has('MoonPearl') && ($items->has('PegasusBoots') || $items->has('Hookshot'))
				&& $items->canKillMostThings(8)
				&& $this->world->getRegion('Mire')->canEnter($locations, $items);
		};

		$this->prize_location->setRequirements($this->can_complete);

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for MajorGlitches Mode.
	 *
	 * @return $this
	 */
	public function initMajorGlitches() {
		$this->initNoMajorGlitches();

		// @TODO: this function is probably wrong -_-
		$this->can_complete = function($locations, $items) {
			return ($this->canEnter($locations, $items)
				&& $items->has('CaneOfSomaria') && $items->has('Lamp', $this->world->config('item.require.Lamp', 1))
				&& $items->has('BigKeyD6') && (
					$items->hasSword() || $items->has('Hammer') || $items->canShootArrows()
				))
				|| ((($locations->itemInLocations(Item::get('BigKeyD6'), [
						"Misery Mire - Compass Chest",
						"Misery Mire - Big Key Chest",
					]) && $items->has('KeyD6', 2))
				|| $items->has('KeyD6', 3))
				&& ($locations["Tower of Hera - Moldorm"]->canAccess($items)
					|| $locations["Swamp Palace - Arrghus"]->canAccess($items))
				);
		};

		// @TODO: doesn't account for 2x YBA
		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda')
				&& ((($locations["Misery Mire Medallion"]->hasItem(Item::get('Bombos')) && $items->has('Bombos'))
					|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Ether')) && $items->has('Ether'))
					|| ($locations["Misery Mire Medallion"]->hasItem(Item::get('Quake')) && $items->has('Quake')))
				&& ($this->world->config('mode.weapons') == 'swordless' || $items->hasSword()))
			&& ($items->has('MoonPearl') || ($items->hasABottle() && $items->has('PegasusBoots')))
			&& ($items->has('PegasusBoots') || $items->has('Hookshot'))
			&& $this->world->getRegion('Mire')->canEnter($locations, $items);
		};

		return $this;
	}
}
