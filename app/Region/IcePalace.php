<?php namespace ALttP\Region;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Ice Palace Region and it's Locations contained within
 */
class IcePalace extends Region {
	protected $name = 'Ice Palace';
	public $music_addresses = [
		0x155BF,
	];

	protected $region_items = [
		'BigKey',
		'BigKeyD5',
		'Compass',
		'CompassD5',
		'Key',
		'KeyD5',
		'Map',
		'MapD5',
	];

	/**
	 * Create a new Ice Palace Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->boss = Boss::get("Kholdstare");

		$this->locations = new LocationCollection([
			new Location\Chest("Ice Palace - Big Key Chest", 0xE9A4, null, $this),
			new Location\Chest("Ice Palace - Compass Chest", 0xE9D4, null, $this),
			new Location\Chest("Ice Palace - Map Chest", 0xE9DD, null, $this),
			new Location\Chest("Ice Palace - Spike Room", 0xE9E0, null, $this),
			new Location\Chest("Ice Palace - Freezor Chest", 0xE995, null, $this),
			new Location\Chest("Ice Palace - Iced T Room", 0xE9E3, null, $this),
			new Location\BigChest("Ice Palace - Big Chest", 0xE9AA, null, $this),
			new Location\Drop("Ice Palace - Kholdstare", 0x180157, null, $this),

			new Location\Prize\Crystal("Ice Palace - Prize", [null, 0x120A4, 0x53F5A, 0x53F5B, 0x180059, 0x180073, 0xC705], null, $this),
		]);

		$this->prize_location = $this->locations["Ice Palace - Prize"];
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Ice Palace - Big Key Chest"]->setItem(Item::get('BigKeyD5'));
		$this->locations["Ice Palace - Compass Chest"]->setItem(Item::get('CompassD5'));
		$this->locations["Ice Palace - Map Chest"]->setItem(Item::get('MapD5'));
		$this->locations["Ice Palace - Spike Room"]->setItem(Item::get('KeyD5'));
		$this->locations["Ice Palace - Freezor Chest"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Ice Palace - Iced T Room"]->setItem(Item::get('KeyD5'));
		$this->locations["Ice Palace - Big Chest"]->setItem(Item::get('BlueMail'));
		$this->locations["Ice Palace - Kholdstare"]->setItem(Item::get('BossHeartContainer'));

		$this->locations["Ice Palace - Prize"]->setItem(Item::get('Crystal5'));

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Ice Palace - Big Key Chest"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canLiftRocks()
				&& (!$this->world->config('region.cantTakeDamage', false)
					|| $items->has('CaneOfByrna') || $items->has('Cape') || $items->has('Hookshot'))
				&& ($items->has('Hookshot')
					|| $items->has('BigKeyD5') ? $items->has('Hookshot') : $items->has('KeyD5', 1));
		});

		$this->locations["Ice Palace - Map Chest"]->setRequirements(function($locations, $items) {
			return $items->has('Hammer') && $items->canLiftRocks()
				&& (!$this->world->config('region.cantTakeDamage', false)
					|| $items->has('CaneOfByrna') || $items->has('Cape') || $items->has('Hookshot'))
				&& ($items->has('Hookshot')
					|| $items->has('BigKeyD5') ? $items->has('Hookshot') : $items->has('KeyD5', 1));
		});

		$this->locations["Ice Palace - Spike Room"]->setRequirements(function($locations, $items) {
			return (!$this->world->config('region.cantTakeDamage', false)
					|| $items->has('CaneOfByrna') || $items->has('Cape') || $items->has('Hookshot'))
				&& ($items->has('Hookshot')
					|| $items->has('BigKeyD5') ? $items->has('Hookshot') : $items->has('KeyD5', 1));
		});

		$this->locations["Ice Palace - Freezor Chest"]->setRequirements(function($locations, $items) {
			return $items->canMeltThings();
		});

		$this->locations["Ice Palace - Big Chest"]->setRequirements(function($locations, $items) {
			return $items->has('BigKeyD5');
		});

		$this->can_complete = function($locations, $items) {
			return $this->locations["Ice Palace - Kholdstare"]->canAccess($items)
				&& (!$this->world->config('region.wildCompasses', false) || $items->has('CompassD5'))
				&& (!$this->world->config('region.wildMaps', false) || $items->has('MapD5'));
		};

		$this->locations["Ice Palace - Kholdstare"]->setRequirements(function($locations, $items) {
			return $this->canEnter($locations, $items)
				&& $items->has('Hammer') && $items->canMeltThings() && $items->canLiftRocks()
				&& $this->boss->canBeat($items, $locations)
				&& $items->has('BigKeyD5') && (
					($items->has('CaneOfSomaria') && $items->has('KeyD5'))
					|| $items->has('KeyD5', 2)
				);
		})->setFillRules(function($item, $locations, $items) {
			if (!$this->world->config('region.bossNormalLocation', true)
				&& (is_a($item, Item\Key::class) || is_a($item, Item\BigKey::class)
					|| is_a($item, Item\Map::class) || is_a($item, Item\Compass::class))) {
				return false;
			}

			return true;
		});


		$this->can_enter = function($locations, $items) {
			return $items->has('MoonPearl') && $items->has('Flippers')
				&& $items->canLiftDarkRocks() && $items->canMeltThings();
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
			return $items->canLiftDarkRocks()
				|| ($items->has('MagicMirror') && $items->glitchedLinkInDarkWorld()
					&& $this->world->getRegion('South Dark World')->canEnter($locations, $items));
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

		$this->can_enter = function($locations, $items) {
			return $items->canLiftDarkRocks() && $items->canMeltThings();
		};

		return $this;
	}
}
