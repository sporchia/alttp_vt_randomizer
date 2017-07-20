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
			new Location\Altar("Altar", 0x289B0, null, $this),
			new Location\Npc("Uncle", 0x2DF45, null, $this),
			new Location\Chest("[cave-034] Hyrule Castle secret entrance", 0xE971, null, $this),
			new Location\Chest("[cave-018] Graveyard - top right grave", 0xE97A, null, $this),
			new Location\Chest("[cave-047] Dam", 0xE98C, null, $this),
			new Location\Chest("[cave-040] Link's House", 0xE9BC, null, $this),
			new Location\Chest("[cave-031] Tavern", 0xE9CE, null, $this),
			new Location\Chest("[cave-026] chicken house", 0xE9E9, null, $this),
			new Location\Chest("[cave-044] Aginah's cave", 0xE9F2, null, $this),
			new Location\Chest("[cave-035] Sahasrahla's Hut [left chest]", 0xEA82, null, $this),
			new Location\Chest("[cave-035] Sahasrahla's Hut [center chest]", 0xEA85, null, $this),
			new Location\Chest("[cave-035] Sahasrahla's Hut [right chest]", 0xEA88, null, $this),
			new Location\Chest("[cave-021] Kakariko well [top chest]", 0xEA8E, null, $this),
			new Location\Chest("[cave-021] Kakariko well [left chest row of 3]", 0xEA91, null, $this),
			new Location\Chest("[cave-021] Kakariko well [center chest row of 3]", 0xEA94, null, $this),
			new Location\Chest("[cave-021] Kakariko well [right chest row of 3]", 0xEA97, null, $this),
			new Location\Chest("[cave-021] Kakariko well [bottom chest]", 0xEA9A, null, $this),
			new Location\Chest("[cave-022-B1] Thief's hut [top chest]", 0xEB0F, null, $this),
			new Location\Chest("[cave-022-B1] Thief's hut [top left chest]", 0xEB12, null, $this),
			new Location\Chest("[cave-022-B1] Thief's hut [top right chest]", 0xEB15, null, $this),
			new Location\Chest("[cave-022-B1] Thief's hut [bottom left chest]", 0xEB18, null, $this),
			new Location\Chest("[cave-022-B1] Thief's hut [bottom right chest]", 0xEB1B, null, $this),
			new Location\Npc("Blacksmiths", $world->config('region.swordsInPool', true) ? 0x18002A : 0x3355C, null, $this),
			new Location\Chest("[cave-016] cave under rocks west of Santuary", 0xEB3F, null, $this),
			new Location\Chest("[cave-050] cave southwest of Lake Hylia [bottom left chest]", 0xEB42, null, $this),
			new Location\Chest("[cave-050] cave southwest of Lake Hylia [top left chest]", 0xEB45, null, $this),
			new Location\Chest("[cave-050] cave southwest of Lake Hylia [top right chest]", 0xEB48, null, $this),
			new Location\Chest("[cave-050] cave southwest of Lake Hylia [bottom right chest]", 0xEB4B, null, $this),
			new Location\Chest("[cave-051] Ice Cave", 0xEB4E, null, $this),
			new Location\Npc("Bottle Vendor", 0x2EB18, null, $this),
			new Location\Npc("Sahasrahla", 0x2F1FC, null, $this),
			new Location\Npc("Magic Bat", 0x180015, null, $this),
			new Location\Npc\BugCatchingKid("Sick Kid", 0x339CF, null, $this),
			new Location\Npc("Purple Chest", 0x33D68, null, $this),
			new Location\Npc("Hobo", 0x33E7D, null, $this),
			new Location\Drop\Bombos("Bombos Tablet", 0x180017, null, $this),
			new Location\Npc\Zora("King Zora", 0xEE1C3, null, $this),
			new Location\Standing("Piece of Heart (Thieves' Forest Hideout)", 0x180000, null, $this),
			new Location\Standing("Piece of Heart (Lumberjack Tree)", 0x180001, null, $this),
			new Location\Standing("Piece of Heart (south of Haunted Grove)", 0x180003, null, $this),
			new Location\Standing("Piece of Heart (Graveyard)", 0x180004, null, $this),
			new Location\Standing("Piece of Heart (Desert - northeast corner)", 0x180005, null, $this),
			new Location\Npc("[cave-050] cave southwest of Lake Hylia - generous guy", 0x180010, null, $this),
			new Location\Dash("Library", 0x180012, null, $this),
			new Location\Standing("Mushroom", 0x180013, null, $this),
			new Location\Npc\Witch("Witch", 0x180014, null, $this),
			new Location\Standing("Piece of Heart (Maze Race)", 0x180142, null, $this),
			new Location\Standing("Piece of Heart (Desert - west side)", 0x180143, null, $this),
			new Location\Standing("Piece of Heart (Lake Hylia)", 0x180144, null, $this),
			new Location\Standing("Piece of Heart (Dam)", 0x180145, null, $this),
			new Location\Standing("Piece of Heart (Zora's River)", 0x180149, null, $this),
			new Location\Dig\HauntedGrove("Haunted Grove item", 0x18014A, null, $this),
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
		$this->locations["Altar"]->setItem(Item::get('MasterSword'));
		$this->locations["Uncle"]->setItem(Item::get('L1SwordAndShield'));
		$this->locations["[cave-034] Hyrule Castle secret entrance"]->setItem(Item::get('Lamp'));
		$this->locations["[cave-018] Graveyard - top right grave"]->setItem(Item::get('Cape'));
		$this->locations["[cave-047] Dam"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[cave-040] Link's House"]->setItem(Item::get('Lamp'));
		$this->locations["[cave-031] Tavern"]->setItem(Item::get('Bottle'));
		$this->locations["[cave-026] chicken house"]->setItem(Item::get('TenArrows'));
		$this->locations["[cave-044] Aginah's cave"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["[cave-035] Sahasrahla's Hut [left chest]"]->setItem(Item::get('FiftyRupees'));
		$this->locations["[cave-035] Sahasrahla's Hut [center chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[cave-035] Sahasrahla's Hut [right chest]"]->setItem(Item::get('FiftyRupees'));
		$this->locations["[cave-021] Kakariko well [top chest]"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["[cave-021] Kakariko well [left chest row of 3]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-021] Kakariko well [center chest row of 3]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-021] Kakariko well [right chest row of 3]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-021] Kakariko well [bottom chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[cave-022-B1] Thief's hut [top chest]"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["[cave-022-B1] Thief's hut [top left chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-022-B1] Thief's hut [top right chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-022-B1] Thief's hut [bottom left chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-022-B1] Thief's hut [bottom right chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Blacksmiths"]->setItem(Item::get('L3Sword'));
		$this->locations["[cave-016] cave under rocks west of Santuary"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["[cave-050] cave southwest of Lake Hylia [bottom left chest]"]->setItem(Item::get('ThreeBombs'));
		$this->locations["[cave-050] cave southwest of Lake Hylia [top left chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-050] cave southwest of Lake Hylia [top right chest]"]->setItem(Item::get('TwentyRupees'));
		$this->locations["[cave-050] cave southwest of Lake Hylia [bottom right chest]"]->setItem(Item::get('TenArrows'));
		$this->locations["[cave-051] Ice Cave"]->setItem(Item::get('IceRod'));
		$this->locations["Bottle Vendor"]->setItem(Item::get('Bottle'));
		$this->locations["Sahasrahla"]->setItem(Item::get('PegasusBoots'));
		$this->locations["Magic Bat"]->setItem(Item::get('HalfMagic')); // @TODO: perhaps use 0xFF here
		$this->locations["Sick Kid"]->setItem(Item::get('BugCatchingNet'));
		$this->locations["Purple Chest"]->setItem(Item::get('Bottle'));
		$this->locations["Hobo"]->setItem(Item::get('Bottle'));
		$this->locations["Bombos Tablet"]->setItem(Item::get('Bombos'));
		$this->locations["King Zora"]->setItem(Item::get('Flippers'));
		$this->locations["Piece of Heart (Thieves' Forest Hideout)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (Lumberjack Tree)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (south of Haunted Grove)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (Graveyard)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (Desert - northeast corner)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["[cave-050] cave southwest of Lake Hylia - generous guy"]->setItem(Item::get('ThreeHundredRupees'));
		$this->locations["Library"]->setItem(Item::get('BookOfMudora'));
		$this->locations["Mushroom"]->setItem(Item::get('Mushroom'));
		$this->locations["Witch"]->setItem(Item::get('Powder'));
		$this->locations["Piece of Heart (Maze Race)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (Desert - west side)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (Lake Hylia)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (Dam)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Piece of Heart (Zora's River)"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Haunted Grove item"]->setItem(Item::get('OcarinaInactive'));
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
		$this->locations["Altar"]->setRequirements(function($locations, $items) {
			return $items->has('PendantOfPower')
				&& $items->has('PendantOfWisdom')
				&& $items->has('PendantOfCourage');
		});

		$this->locations["[cave-018] Graveyard - top right grave"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots') && ($items->canLiftDarkRocks()
				|| ($items->has('MagicMirror') && $this->world->getRegion('North West Dark World')->canEnter($locations, $items)));
		});

		$this->locations["Blacksmiths"]->setRequirements(function($locations, $items) {
			return $items->canLiftDarkRocks()
				&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		});

		$this->locations["[cave-016] cave under rocks west of Santuary"]->setRequirements(function($locations, $items) {
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

		$this->locations["Purple Chest"]->setRequirements(function($locations, $items) {
			return $items->canLiftDarkRocks() && $items->has("MoonPearl")
				&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		});

		$this->locations["Hobo"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers');
		});

		$this->locations["Bombos Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && $items->hasUpgradedSword()
				&& $items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items);
		});

		$this->locations["King Zora"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks() || $items->has('Flippers');
		});

		$this->locations["Piece of Heart (Lumberjack Tree)"]->setRequirements(function($locations, $items) {
			return $items->has('DefeatAgahnim') && $items->has('PegasusBoots');
		});

		$this->locations["Piece of Heart (south of Haunted Grove)"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items);
		});

		$this->locations["Piece of Heart (Graveyard)"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $items->has('MoonPearl')
				&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
		});

		$this->locations["Piece of Heart (Desert - northeast corner)"]->setRequirements(function($locations, $items) {
			return $items->canFly() && $items->canLiftDarkRocks() && $items->has('MagicMirror');
		});

		$this->locations["Library"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Witch"]->setRequirements(function($locations, $items) {
			return $items->has('Mushroom');
		});

		$this->locations["Piece of Heart (Desert - west side)"]->setRequirements(function($locations, $items) {
			return $this->world->getRegion('Desert Palace')->canEnter($locations, $items);
		});

		$this->locations["Piece of Heart (Lake Hylia)"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers') && $items->has('MoonPearl') && $items->has('MagicMirror')
				&& ($this->world->getRegion('South Dark World')->canEnter($locations, $items)
					|| $this->world->getRegion('North East Dark World')->canEnter($locations, $items));
		});

		$this->locations["Piece of Heart (Zora's River)"]->setRequirements(function($locations, $items) {
			return $items->has('Flippers');
		});

		$this->locations["Haunted Grove item"]->setRequirements(function($locations, $items) {
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
	 * within for Glitched Mode
	 *
	 * @return $this
	 */
	public function initGlitched() {
		$this->locations["Altar"]->setRequirements(function($locations, $items) {
			return $items->has('PendantOfPower')
				&& $items->has('PendantOfWisdom')
				&& $items->has('PendantOfCourage');
		});

		$this->locations["Blacksmiths"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror')
				&& ($items->hasABottle() || $items->has("MoonPearl"));
		});

		$this->locations["[cave-018] Graveyard - top right grave"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots') && ($items->canLiftDarkRocks()
				|| ($items->has('MagicMirror') && ($items->has('MoonPearl') || $items->hasABottle())));
		});

		$this->locations["[cave-016] cave under rocks west of Santuary"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Sahasrahla"]->setRequirements(function($locations, $items) {
			return $items->has('PendantOfCourage');
		});

		$this->locations["Sick Kid"]->setRequirements(function($locations, $items) {
			return $items->hasABottle();
		});

		$this->locations["Purple Chest"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror')
				&& ($items->hasABottle() || $items->has("MoonPearl"))
				&& ($items->canLiftDarkRocks()
					|| $items->has('Flippers')
					|| $items->has('Hammer')
					|| $this->world->getRegion('North East Dark World')->canEnter($locations, $items));
		});

		$this->locations["Piece of Heart (Lumberjack Tree)"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots') && $items->hasSword();
		});

		$this->locations["Piece of Heart (Desert - northeast corner)"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks();
		});

		$this->locations["Library"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots');
		});

		$this->locations["Witch"]->setRequirements(function($locations, $items) {
			return $items->has('Mushroom');
		});

		$this->locations["Magic Bat"]->setRequirements(function($locations, $items) {
			return $items->has('Powder')
				&& ($items->has('Hammer') || $items->has('MagicMirror'));
		});

		$this->locations["Bombos Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && $items->hasUpgradedSword();
		});

		$this->locations["Haunted Grove item"]->setRequirements(function($locations, $items) {
			return $items->has('Shovel');
		});

		$this->locations["Piece of Heart (Zora's River)"]->setRequirements(function($locations, $items) {
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

	/**
	 * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
	 * within for Overworld Glitches Mode
	 *
	 * @return $this
	 */
	public function initOverworldGlitches() {
		$this->initNoMajorGlitches();

		$this->locations["[cave-018] Graveyard - top right grave"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots') && ($items->canLiftDarkRocks()
				|| ($items->has('MagicMirror') && $items->has('MoonPearl')));
		});

		$this->locations["Blacksmiths"]->setRequirements(function($locations, $items) {
			return $items->has('MoonPearl')
				&& ($items->canLiftDarkRocks()
					|| ($items->has('PegasusBoots') && $items->has('MagicMirror')));
		});

		$this->locations["Magic Bat"]->setRequirements(function($locations, $items) {
			return $items->has('Powder')
				&& ($items->has('Hammer')
					|| $items->has('PegasusBoots')
					|| ($items->has('MoonPearl') && $items->has('MagicMirror') && $items->canLiftDarkRocks()
						&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items)));
		});

		$this->locations["Purple Chest"]->setRequirements(function($locations, $items) {
			return $locations["Blacksmiths"]->canAccess($items)
				&& ($items->has("MoonPearl")
					&& (($items->canLiftDarkRocks() && $this->world->getRegion('North West Dark World')->canEnter($locations, $items))
						|| ($items->has('PegasusBoots') && $this->world->getRegion('North East Dark World')->canEnter($locations, $items))));
		});

		$this->locations["Hobo"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Bombos Tablet"]->setRequirements(function($locations, $items) {
			return $items->has('BookOfMudora') && $items->hasUpgradedSword()
				&& ($items->has('PegasusBoots')
					|| ($items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items)));
		});

		$this->locations["King Zora"]->setRequirements(function($locations, $items) {
			return true;
		});

		$this->locations["Piece of Heart (south of Haunted Grove)"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $this->world->getRegion('South Dark World')->canEnter($locations, $items));
		});

		$this->locations["Piece of Heart (Graveyard)"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $items->has('MoonPearl')
					&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items));
		});

		$this->locations["Piece of Heart (Desert - northeast corner)"]->setRequirements(function($locations, $items) {
			return $items->canLiftRocks()
				&& ($items->has('PegasusBoots')
					|| ($items->has('MagicMirror') && $this->world->getRegion('Mire')->canEnter($locations, $items)));
		});

		$this->locations["Piece of Heart (Lake Hylia)"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('Flippers') && $items->has('MagicMirror')
					&& (($items->has('MoonPearl') && $this->world->getRegion('South Dark World')->canEnter($locations, $items))
						|| $this->world->getRegion('North East Dark World')->canEnter($locations, $items)));
		});

		$this->locations["Piece of Heart (Zora's River)"]->setRequirements(function($locations, $items) {
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
