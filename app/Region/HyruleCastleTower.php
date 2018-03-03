<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Hyrule Castle Tower Region and it's Locations contained within
 */
class HyruleCastleTower extends Region {
	protected $name = 'Castle Tower';

	protected $region_items = [
		'BigKey',
		'BigKeyA1',
		'Compass',
		'CompassA1',
		'Key',
		'KeyA1',
		'Map',
		'MapA1',
	];

	/**
	 * Create a new Hyrule Castle Tower Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Castle Tower - Room 03", 0xEAB5, null, $this),
			new Location\Chest("Castle Tower - Dark Maze", 0xEAB2, null, $this),
			new Location\Prize\Event("Agahnim", null, null, $this),
		]);

		$this->prize_location = $this->locations["Agahnim"];
		$this->prize_location->setItem(Item::get('DefeatAgahnim'));
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Castle Tower - Room 03"]->setItem(Item::get('KeyA1'));
		$this->locations["Castle Tower - Dark Maze"]->setItem(Item::get('KeyA1'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Castle Tower - Dark Maze"]->setRequirements(function($locations, $items) {
			return $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && $items->has('KeyA1');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items) && $items->has('KeyA1', 2)
				&& $items->has('Lamp', $this->world->config('item.require.Lamp', 1)) && ($items->hasSword()
					|| ($this->world->config('mode.weapons')== 'swordless' && ($items->has('Hammer') || $items->has('BugCatchingNet'))));
		};

		$this->prize_location->setRequirements($this->can_complete);

		$this->can_enter = function($locations, $items) {
			return $items->canKillMostThings(8)
				&& $items->has('RescueZelda')
				&& ($items->has('Cape')
					|| $items->hasUpgradedSword()
					|| ($this->world->config('mode.weapons')== 'swordless' && $items->has('Hammer')));
		};

		return $this;
	}
}
