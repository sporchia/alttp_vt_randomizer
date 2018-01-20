<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Thieves Town Region and it's Locations contained within
 */
class ThievesTown extends Region {
	protected $name = 'Thieves Town';
	public $music_addresses = [
		0x155C6,
	];

	protected $region_items = [
		'BigKey',
		'BigKeyD4',
		'Compass',
		'CompassD4',
		'Key',
		'KeyD4',
		'Map',
		'MapD4',
	];

	/**
	 * Create a new Thieves Town Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Thieves' Town - Attic", 0xEA0D, null, $this),
			new Location\Chest("Thieves' Town - Big Key Chest", 0xEA04, null, $this),
			new Location\Chest("Thieves' Town - Map Chest", 0xEA01, null, $this),
			new Location\Chest("Thieves' Town - Compass Chest", 0xEA07, null, $this),
			new Location\Chest("Thieves' Town - Ambush Chest", 0xEA0A, null, $this),
			new Location\BigChest("Thieves' Town - Big Chest", 0xEA10, null, $this),
			new Location\Chest("Thieves' Town - Blind's Cell", 0xEA13, null, $this),
			new Location\Drop("Thieves' Town - Blind", 0x180156, null, $this),

			new Location\Prize\Crystal("Thieves' Town - Prize", [null, 0x120A6, 0x53F36, 0x53F37, 0x18005B, 0x180077, 0xC707], null, $this),
		]);

		$this->prize_location = $this->locations["Thieves' Town - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Thieves' Town - Attic"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Thieves' Town - Big Key Chest"]->setItem(Item::get('BigKeyD4'));
		$this->locations["Thieves' Town - Map Chest"]->setItem(Item::get('MapD4'));
		$this->locations["Thieves' Town - Compass Chest"]->setItem(Item::get('CompassD4'));
		$this->locations["Thieves' Town - Ambush Chest"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Thieves' Town - Big Chest"]->setItem(Item::get('TitansMitt'));
		$this->locations["Thieves' Town - Blind's Cell"]->setItem(Item::get('KeyD4'));
		$this->locations["Thieves' Town - Blind"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Thieves' Town - Prize"]->setItem(Item::get('Crystal4'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Thieves' Town - Attic"]->setRequirements(function($locations, $items) {
			return $items->has('KeyD4') && $items->has('BigKeyD4');
		});

		$this->locations["Thieves' Town - Big Chest"]->setRequirements(function($locations, $items) {
			if ($locations["Thieves' Town - Big Chest"]->hasItem(Item::get('KeyD4'))) {
				return $items->has('Hammer') && $items->has('BigKeyD4');
			}

			return $items->has('Hammer') && $items->has('KeyD4') && $items->has('BigKeyD4');
		})->setAlwaysAllow(function($item, $items) {
			return $item == Item::get('KeyD4') && $items->has('Hammer');
		});

		$this->locations["Thieves' Town - Blind's Cell"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD4');
		});

		$this->can_complete = function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('KeyD4') && $items->has('BigKeyD4')
				&& ($items->hasSword() || $items->has('Hammer')
				|| $items->has('CaneOfSomaria') || $items->has('CaneOfByrna'));
		};

		$this->locations["Thieves' Town - Blind"]->setRequirements($this->can_complete)
			->setFillRules(function($item, $locations, $items) {
				if (!$this->world->config('region.bossNormalLocation', true)
					&& ($item instanceof Item\Key || $item instanceof Item\BigKey
						|| $item instanceof Item\Map || $item instanceof Item\Compass)) {
					return false;
				}

				return true;
			});

		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
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

		$this->can_enter = function($locations, $items) {
			return $items->glitchedLinkInDarkWorld()
				&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		};

		return $this;
	}
}
