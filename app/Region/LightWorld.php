<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Light World Region and it's Locations contained within
 */
class LightWorld extends Region {
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
			new Location\Altar("Master Sword Pedestal", 0x289B0, null, $this),
			new Location\Npc("Link's Uncle", 0x2DF45, null, $this),
			new Location\Chest("Secret Passage", 0xE971, null, $this),
			new Location\Chest("King's Tomb", 0xE97A, null, $this),
			new Location\Chest("Floodgate Chest", 0xE98C, null, $this),
			new Location\Chest("Link's House", 0xE9BC, null, $this),
			new Location\Chest("Kakariko Tavern", 0xE9CE, null, $this),
			new Location\Chest("Chicken House", 0xE9E9, null, $this),
			new Location\Chest("Aginah's Cave", 0xE9F2, null, $this),
			new Location\Chest("Sahasrahla's Hut - Left", 0xEA82, null, $this),
			new Location\Chest("Sahasrahla's Hut - Middle", 0xEA85, null, $this),
			new Location\Chest("Sahasrahla's Hut - Right", 0xEA88, null, $this),
			new Location\Chest("Kakriko Well - Top", 0xEA8E, null, $this),
			new Location\Chest("Kakriko Well - Left", 0xEA91, null, $this),
			new Location\Chest("Kakriko Well - Middle", 0xEA94, null, $this),
			new Location\Chest("Kakriko Well - Right", 0xEA97, null, $this),
			new Location\Chest("Kakriko Well - Bottom", 0xEA9A, null, $this),
			new Location\Chest("Blind's Hideout - Top", 0xEB0F, null, $this),
			new Location\Chest("Blind's Hideout - Left", 0xEB12, null, $this),
			new Location\Chest("Blind's Hideout - Right", 0xEB15, null, $this),
			new Location\Chest("Blind's Hideout - Far Left", 0xEB18, null, $this),
			new Location\Chest("Blind's Hideout - Far Right", 0xEB1B, null, $this),
			new Location\Chest("Pegasus Rocks", 0xEB3F, null, $this),
			new Location\Chest("Mini Moldorm Cave - Far Left", 0xEB42, null, $this),
			new Location\Chest("Mini Moldorm Cave - Left", 0xEB45, null, $this),
			new Location\Chest("Mini Moldorm Cave - Right", 0xEB48, null, $this),
			new Location\Chest("Mini Moldorm Cave - Far Right", 0xEB4B, null, $this),
			new Location\Chest("Ice Rod Cave", 0xEB4E, null, $this),
			new Location\Npc("Bottle Merchant", 0x2EB18, null, $this),
			new Location\Npc("Sahasrahla", 0x2F1FC, null, $this),
			new Location\Npc("Magic Bat", 0x180015, null, $this),
			new Location\Npc\BugCatchingKid("Sick Kid", 0x339CF, null, $this),
			new Location\Npc("Hobo", 0x33E7D, null, $this),
			new Location\Drop\Bombos("Bombos Tablet", 0x180017, null, $this),
			new Location\Npc\Zora("King Zora", 0xEE1C3, null, $this),
			new Location\Standing("Lost Woods Hideout", 0x180000, null, $this),
			new Location\Standing("Lumberjack Tree", 0x180001, null, $this),
			new Location\Standing("Cave 45", 0x180003, null, $this),
			new Location\Standing("Graveyard Ledge", 0x180004, null, $this),
			new Location\Standing("Checkerboard Cave", 0x180005, null, $this),
			new Location\Npc("Mini Moldorm Cave - NPC", 0x180010, null, $this),
			new Location\Dash("Library", 0x180012, null, $this),
			new Location\Standing("Mushroom", 0x180013, null, $this),
			new Location\Npc\Witch("Potion Shop", 0x180014, null, $this),
			new Location\Standing("Maze Race", 0x180142, null, $this),
			new Location\Standing("Desert Ledge", 0x180143, null, $this),
			new Location\Standing("Lake Hylia Island", 0x180144, null, $this),
			new Location\Standing("Sunken Treasure", 0x180145, null, $this),
			new Location\Standing("Zora's Ledge", 0x180149, null, $this),
			new Location\Dig\HauntedGrove("Flute Spot", 0x18014A, null, $this),
			new Location\Chest("Waterfall Fairy - Left", 0xE9B0, null, $this),
			new Location\Chest("Waterfall Fairy - Right", 0xE9D1, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Master Sword Pedestal"]->setItem(Item::get('MasterSword'));
		$this->locations["Link's Uncle"]->setItem(Item::get('L1SwordAndShield'));
		$this->locations["Secret Passage"]->setItem(Item::get('Lamp'));
		$this->locations["King's Tomb"]->setItem(Item::get('Cape'));
		$this->locations["Floodgate Chest"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Link's House"]->setItem(Item::get('Lamp'));
		$this->locations["Kakariko Tavern"]->setItem(Item::get('Bottle'));
		$this->locations["Chicken House"]->setItem(Item::get('TenArrows'));
		$this->locations["Aginah's Cave"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Sahasrahla's Hut - Left"]->setItem(Item::get('FiftyRupees'));
		$this->locations["Sahasrahla's Hut - Middle"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Sahasrahla's Hut - Right"]->setItem(Item::get('FiftyRupees'));
		$this->locations["Kakriko Well - Top"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Kakriko Well - Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Kakriko Well - Middle"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Kakriko Well - Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Kakriko Well - Bottom"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Blind's Hideout - Top"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Blind's Hideout - Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Blind's Hideout - Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Blind's Hideout - Far Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Blind's Hideout - Far Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Pegasus Rocks"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Mini Moldorm Cave - Far Left"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Mini Moldorm Cave - Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Mini Moldorm Cave - Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Mini Moldorm Cave - Far Right"]->setItem(Item::get('TenArrows'));
		$this->locations["Ice Rod Cave"]->setItem(Item::get('IceRod'));
		$this->locations["Bottle Merchant"]->setItem(Item::get('Bottle'));
		$this->locations["Sahasrahla"]->setItem(Item::get('PegasusBoots'));
		$this->locations["Magic Bat"]->setItem(Item::get('HalfMagic')); // @TODO: perhaps use 0xFF here
		$this->locations["Sick Kid"]->setItem(Item::get('BugCatchingNet'));
		$this->locations["Hobo"]->setItem(Item::get('Bottle'));
		$this->locations["Bombos Tablet"]->setItem(Item::get('Bombos'));
		$this->locations["King Zora"]->setItem(Item::get('Flippers'));
		$this->locations["Lost Woods Hideout"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Lumberjack Tree"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Cave 45"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Graveyard Ledge"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Checkerboard Cave"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Mini Moldorm Cave - NPC"]->setItem(Item::get('ThreeHundredRupees'));
		$this->locations["Library"]->setItem(Item::get('BookOfMudora'));
		$this->locations["Mushroom"]->setItem(Item::get('Mushroom'));
		$this->locations["Potion Shop"]->setItem(Item::get('Powder'));
		$this->locations["Maze Race"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Desert Ledge"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Lake Hylia Island"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Sunken Treasure"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Zora's Ledge"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Flute Spot"]->setItem(Item::get('OcarinaInactive'));
		$this->locations["Waterfall Fairy - Left"]->setItem(Item::get('RedShield'));
		$this->locations["Waterfall Fairy - Right"]->setItem(Item::get('RedBoomerang'));

		return $this;
	}


	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for No Major Glitches
	 *
	 * @return $this
	 */
	public function initNoMajorGlitches() {
		$this->locations["Master Sword Pedestal"]->setRequirements(function($locations, $items) {
			return $items->has('PendantOfPower')
				&& $items->has('PendantOfWisdom')
				&& $items->has('PendantOfCourage');
		});

		$this->locations["King's Tomb"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots') && ($items->canLiftDarkRocks()
				|| ($items->has('MagicMirror') && $items->has('MoonPearl')
					&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items)));
		});

		$this->locations["Pegasus Rocks"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Sahasrahla"]->setRequirements(function($locations, $items) {
			return $items->has('PendantOfCourage');
		});

		$this->locations["Magic Bat"]->setRequirements(function($locations, $items) {
			return $items->has('Powder')
				&& ($items->has('Hammer')
					|| ($items->has('MoonPearl') && $items->has('MagicMirror') && $items->canLiftDarkRocks()));
		});

		$this->locations["Sick Kid"]->setRequirements(function($locations, $items) {
			return $items->hasABottle();
		});

		$this->locations["Hobo"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers');
		});

		$this->locations["Bombos Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && ($items->hasUpgradedSword()
					|| (config('game-mode') == 'swordless' && $items->has('Hammer')))
				&& $items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items);
		});

		$this->locations["King Zora"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() || $items->has('Flippers');
		});

		$this->locations["Lumberjack Tree"]->setRequirements(function($locations, $items) {
			return $items->has('DefeatAgahnim') && $items->has('PegasusBoots');
		});

		$this->locations["Cave 45"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items);
		});

		$this->locations["Graveyard Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $items->has('MoonPearl')
				&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		});

		$this->locations["Checkerboard Cave"]->setRequirements(function($locations, $items) {
			return $items->canFly() && $items->canLiftDarkRocks() && $items->has('MagicMirror');
		});

		$this->locations["Library"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Potion Shop"]->setRequirements(function($locations, $items) {
			return $items->has('Mushroom');
		});

		$this->locations["Desert Ledge"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('Desert Palace')->canEnter($locations, $items);
		});

		$this->locations["Lake Hylia Island"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers') && $items->has('MoonPearl') && $items->has('MagicMirror')
				&& ($this->world->getRegion('South Dark World')->canEnter($locations, $items)
					|| $this->world->getRegion('North East Dark World')->canEnter($locations, $items));
		});

		$this->locations["Zora's Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers');
		});

		$this->locations["Flute Spot"]->setRequirements(function($locations, $items) {
			return $items->has('Shovel');
		});

		$this->locations["Waterfall Fairy - Left"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers');
		});

		$this->locations["Waterfall Fairy - Right"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers');
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

		$this->locations["King's Tomb"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots') && ($items->canLiftDarkRocks()
				|| ($items->has('MagicMirror') && $items->glitchedLinkInDarkWorld()));
		});

		$this->locations["Magic Bat"]->setRequirements(function($locations, $items) {
			return $items->has('Powder')
				&& ($items->has('Hammer')
					|| $items->has('PegasusBoots')
					|| $items->has('MagicMirror'));
		});

		$this->locations["Graveyard Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $items->glitchedLinkInDarkWorld());
		});

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
		$this->initNoMajorGlitches();

		$this->locations["King's Tomb"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots') && ($items->canLiftDarkRocks()
				|| ($items->has('MagicMirror') && $items->has('MoonPearl')));
		});

		$this->locations["Magic Bat"]->setRequirements(function($locations, $items) {
			return $items->has('Powder')
				&& ($items->has('Hammer')
					|| $items->has('PegasusBoots')
					|| ($items->has('MoonPearl') && $items->has('MagicMirror') && $items->canLiftDarkRocks()
						&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items)));
		});

		$this->locations["Hobo"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Bombos Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && ($items->hasUpgradedSword()
					|| (config('game-mode') == 'swordless' && $items->has('Hammer')))
				&& ($items->has('PegasusBoots')
					|| ($items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items)));
		});

		$this->locations["King Zora"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Cave 45"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items));
		});

		$this->locations["Graveyard Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $items->has('MoonPearl')
					&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items));
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

		$this->locations["Zora's Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers')
				|| ($items->has('PegasusBoots') && $items->has('MoonPearl'));
		});

		$this->locations["Waterfall Fairy - Left"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers') || $items->has('MoonPearl');
		});

		$this->locations["Waterfall Fairy - Right"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers') || $items->has('MoonPearl');
		});

		return $this;
	}
}
