<?php namespace ALttP\Region\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * North West Light World Region and it's Locations contained within
 */
class NorthWest extends Region {
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
			new Location\Pedestal("Master Sword Pedestal", 0x289B0, null, $this),
			new Location\Chest("King's Tomb", 0xE97A, null, $this),
			new Location\Chest("Kakariko Tavern", 0xE9CE, null, $this),
			new Location\Chest("Chicken House", 0xE9E9, null, $this),
			new Location\Chest("Kakariko Well - Top", 0xEA8E, null, $this),
			new Location\Chest("Kakariko Well - Left", 0xEA91, null, $this),
			new Location\Chest("Kakariko Well - Middle", 0xEA94, null, $this),
			new Location\Chest("Kakariko Well - Right", 0xEA97, null, $this),
			new Location\Chest("Kakariko Well - Bottom", 0xEA9A, null, $this),
			new Location\Chest("Blind's Hideout - Top", 0xEB0F, null, $this),
			new Location\Chest("Blind's Hideout - Left", 0xEB12, null, $this),
			new Location\Chest("Blind's Hideout - Right", 0xEB15, null, $this),
			new Location\Chest("Blind's Hideout - Far Left", 0xEB18, null, $this),
			new Location\Chest("Blind's Hideout - Far Right", 0xEB1B, null, $this),
			new Location\Chest("Pegasus Rocks", 0xEB3F, null, $this),
			new Location\Npc("Bottle Merchant", 0x2EB18, null, $this),
			new Location\Npc("Magic Bat", 0x180015, null, $this),
			new Location\Npc\BugCatchingKid("Sick Kid", 0x339CF, null, $this),
			new Location\Standing("Lost Woods Hideout", 0x180000, null, $this),
			new Location\Standing("Lumberjack Tree", 0x180001, null, $this),
			new Location\Standing("Graveyard Ledge", 0x180004, null, $this),
			new Location\Standing("Mushroom", 0x180013, null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Master Sword Pedestal"]->setItem(Item::get('MasterSword'));
		$this->locations["King's Tomb"]->setItem(Item::get('Cape'));
		$this->locations["Kakariko Tavern"]->setItem(Item::get('Bottle'));
		$this->locations["Chicken House"]->setItem(Item::get('Boomerang'));
		$this->locations["Kakariko Well - Top"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Kakariko Well - Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Kakariko Well - Middle"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Kakariko Well - Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Kakariko Well - Bottom"]->setItem(Item::get('ThreeBombs'));
		$this->locations["Blind's Hideout - Top"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Blind's Hideout - Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Blind's Hideout - Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Blind's Hideout - Far Left"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Blind's Hideout - Far Right"]->setItem(Item::get('TwentyRupees'));
		$this->locations["Pegasus Rocks"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Bottle Merchant"]->setItem(Item::get('Bottle'));
		$this->locations["Magic Bat"]->setItem(Item::get('HalfMagic')); // @TODO: perhaps use 0xFF here
		$this->locations["Sick Kid"]->setItem(Item::get('BugCatchingNet'));
		$this->locations["Lost Woods Hideout"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Lumberjack Tree"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Graveyard Ledge"]->setItem(Item::get('PieceOfHeart'));
		$this->locations["Mushroom"]->setItem(Item::get('Mushroom'));

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

		$this->locations["Magic Bat"]->setRequirements(function($locations, $items) {
			return $items->has('Powder')
				&& ($items->has('Hammer')
					|| ($items->has('MoonPearl') && $items->has('MagicMirror') && $items->canLiftDarkRocks()));
		});

		$this->locations["Sick Kid"]->setRequirements(function($locations, $items) {
			return $items->hasABottle();
		});

		$this->locations["Lumberjack Tree"]->setRequirements(function($locations, $items) {
			return $items->has('DefeatAgahnim') && $items->has('PegasusBoots');
		});

		$this->locations["Graveyard Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('MagicMirror') && $items->has('MoonPearl')
				&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items);
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

		$this->locations["Graveyard Ledge"]->setRequirements(function($locations, $items) {
			return $items->has('PegasusBoots')
				|| ($items->has('MagicMirror') && $items->has('MoonPearl')
					&& $this->world->getRegion('North West Dark World')->canEnter($locations, $items));
		});

		return $this;
	}
}
