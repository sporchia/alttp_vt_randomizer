<?php namespace ALttP\Region\Standard\LightWorld;

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
class South extends Region {
	protected $name = 'Light World';

	/**
	 * Create a new Light World Region and initalize it's locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location\Chest("Floodgate Chest", 0xE98C, null, $this),
			new Location\Chest("Link's House", 0xE9BC, null, $this),
			new Location\Chest("Aginah's Cave", 0xE9F2, null, $this),
			new Location\Chest("Mini Moldorm Cave - Far Left", 0xEB42, null, $this),
			new Location\Chest("Mini Moldorm Cave - Left", 0xEB45, null, $this),
			new Location\Chest("Mini Moldorm Cave - Right", 0xEB48, null, $this),
			new Location\Chest("Mini Moldorm Cave - Far Right", 0xEB4B, null, $this),
			new Location\Chest("Ice Rod Cave", 0xEB4E, null, $this),
			new Location\Npc("Hobo", 0x33E7D, null, $this),
			new Location\Drop\Bombos("Bombos Tablet", 0x180017, null, $this),
			new Location\Standing("Cave 45", 0x180003, null, $this),
			new Location\Standing("Checkerboard Cave", 0x180005, null, $this),
			new Location\Npc("Mini Moldorm Cave - NPC", 0x180010, null, $this),
			new Location\Dash("Library", 0x180012, null, $this),
			new Location\Standing("Maze Race", 0x180142, null, $this),
			new Location\Standing("Desert Ledge", 0x180143, null, $this),
			new Location\Standing("Lake Hylia Island", 0x180144, null, $this),
			new Location\Standing("Sunken Treasure", 0x180145, null, $this),
			new Location\Dig\HauntedGrove("Flute Spot", 0x18014A, null, $this),
		]);

		$this->shops = new ShopCollection([
			new Shop("Light World Lake Hylia Shop",       0x03, 0xA0, 0x0112, 0x58, $this),
			new Shop\Upgrade("Capacity Upgrade",          0x12, 0x04, 0x0115, 0x5D, $this),
			// Single entrance caves with no items in them ;)
			new Shop\TakeAny("20 Rupee Cave",             0x83, 0xA0, 0x0112, 0x7B, $this, [0xDBBED => [0x58]]),
			new Shop\TakeAny("50 Rupee Cave",             0x83, 0xA0, 0x0112, 0x79, $this, [0xDBBEB => [0x58]]),
			new Shop\TakeAny("Bonk Fairy (Light)",        0x83, 0xA0, 0x0112, 0x77, $this, [0xDBBE9 => [0x58]]),
			new Shop\TakeAny("Desert Fairy",              0x83, 0xA0, 0x0112, 0x72, $this, [0xDBBE4 => [0x58]]),
			new Shop\TakeAny("Good Bee Cave",             0x83, 0xA0, 0x0112, 0x6B, $this, [0xDBBDD => [0x58]]),
			new Shop\TakeAny("Lake Hylia Fortune Teller", 0x83, 0xA0, 0x011F, 0x73, $this, [0xDBBE5 => [0x46]]),
			new Shop\TakeAny("Light Hype Fairy",          0x83, 0xA0, 0x0112, 0x6C, $this, [0xDBBDE => [0x58]]),
			new Shop\TakeAny("Kakariko Gamble Game",      0x83, 0xA0, 0x011F, 0x67, $this, [0xDBBD9 => [0x46]]),
		]);


		$this->shops["Capacity Upgrade"]->clearInventory()
			->addInventory(0, Item::get('BombUpgrade5'), 100, 7)
			->addInventory(1, Item::get('ArrowUpgrade5'), 100, 7);

		$this->shops["Light World Lake Hylia Shop"]->clearInventory()
			->addInventory(0, Item::get('RedPotion'), 150)
			->addInventory(1, Item::get('Heart'), 10)
			->addInventory(2, Item::get('TenBombs'), 50);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Floodgate Chest"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Link's House"]->setItem(Item::get('Lamp'));
		$this->locations["Aginah's Cave"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Mini Moldorm Cave - Far Left"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Mini Moldorm Cave - Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Mini Moldorm Cave - Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Mini Moldorm Cave - Far Right"]->setItem(Item::get('TenArrows'));
		$this->locations["Ice Rod Cave"]->setItem(Item::get('IceRod'));
		$this->locations["Hobo"]->setItem(Item::get('Bottle'));
		$this->locations["Bombos Tablet"]->setItem(Item::get('Bombos'));
		$this->locations["Cave 45"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Checkerboard Cave"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Mini Moldorm Cave - NPC"]->setItem(Item::get('ThreeHundredRupees'));
		$this->locations["Library"]->setItem(Item::get('BookOfMudora'));
		$this->locations["Maze Race"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Desert Ledge"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Lake Hylia Island"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Sunken Treasure"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Flute Spot"]->setItem(Item::get('OcarinaInactive'));

		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Glitches
	 *
	 * @return $this
	 */
	public function initNoGlitches() {
		$this->shops["20 Rupee Cave"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks();
		});

		$this->shops["50 Rupee Cave"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks();
		});

		$this->shops["Bonk Fairy (Light)"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->shops["Light Hype Fairy"]->setRequirements(function($locations, $items) {
			return $items->canBombThings();
		});

		$this->shops["Capacity Upgrade"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers');
		});

		$this->locations["Hobo"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers');
		});

		$this->locations["Bombos Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && ($items->hasSword(2)
					|| ($this->world->config('mode.weapons') == 'swordless' && $items->has('Hammer')))
				&& $items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items);
		});

		$this->locations["Cave 45"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items);
		});

		$this->locations["Checkerboard Cave"]->setRequirements(function($locations, $items) {
			return $items->canFly() && $items->canLiftDarkRocks() && $items->has('MagicMirror');
		});

		$this->locations["Library"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Desert Ledge"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('Desert Palace')->canEnter($locations, $items);
		});

		$this->locations["Lake Hylia Island"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers') && $items->has('MoonPearl') && $items->has('MagicMirror')
				&& ($this->world->getRegion('South Dark World')->canEnter($locations, $items)
					|| $this->world->getRegion('North East Dark World')->canEnter($locations, $items));
		});

		$this->locations["Flute Spot"]->setRequirements(function($locations, $items) {
			return $items->has('Shovel');
		});

		$this->can_enter = function($locations, $items) {
			return $items->has('RescueZelda');
		};

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

		$this->locations["Lake Hylia Island"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('Flippers') && $items->has('MagicMirror')
					&& ($items->glitchedLinkInDarkWorld()
						|| $this->world->getRegion('North East Dark World')->canEnter($locations, $items)));
		});

		return $this;
	}

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->initNoGlitches();

		$this->locations["Hobo"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Bombos Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && ($items->hasSword(2)
					|| ($this->world->config('mode.weapons') == 'swordless' && $items->has('Hammer')))
				&& ($items->has('PegasusBoots')
					|| ($items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items)));
		});

		$this->locations["Cave 45"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items));
		});

		$this->locations["Checkerboard Cave"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks()
				&& ($items->has('PegasusBoots')
					|| ($items->has('MagicMirror') && $this->world->getRegion('Mire')->canEnter($locations, $items)));
		});

		$this->locations["Lake Hylia Island"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('Flippers') && $items->has('MagicMirror')
					&& (($items->has('MoonPearl') && $this->world->getRegion('South Dark World')->canEnter($locations, $items))
						|| $this->world->getRegion('North East Dark World')->canEnter($locations, $items)));
		});

		return $this;
	}
}
