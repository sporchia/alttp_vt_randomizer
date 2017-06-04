<?php namespace ALttP\Region;

use ALttP\Item;
use ALttP\Location\Prize;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Region containing the 7 Crystals required to beat the game
 *
 * @TODO: consider actually putting these locations directly on the regions they belong to.
 */
class Crystals extends Region {
	protected $name = 'Prize';

	/**
	 * Create a new Crystals Region and generate all it's Locations
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Prize\Crystal("Palace of Darkness Crystal", [null, 0x120A1, 0x53F00, 0x53F01, 0x180056, 0x18007D, 0xC702], null, $this),
			new Prize\Crystal("Swamp Palace Crystal", [null, 0x120A0, 0x53F6C, 0x53F6D, 0x180055, 0x180071, 0xC701], null, $this),
			new Prize\Crystal("Skull Woods Crystal", [null, 0x120A3, 0x53F12, 0x53F13, 0x180058, 0x18007B, 0xC704], null, $this),
			new Prize\Crystal("Thieves Town Crystal", [null, 0x120A6, 0x53F36, 0x53F37, 0x18005B, 0x180077, 0xC707], null, $this),
			new Prize\Crystal("Ice Palace Crystal", [null, 0x120A4, 0x53F5A, 0x53F5B, 0x180059, 0x180073, 0xC705], null, $this),
			new Prize\Crystal("Misery Mire Crystal", [null, 0x120A2, 0x53F48, 0x53F49, 0x180057, 0x180075, 0xC703], null, $this),
			new Prize\Crystal("Turtle Rock Crystal", [null, 0x120A7, 0x53F24, 0x53F25, 0x18005C, 0x180079, 0xC708], null, $this),
		]);
	}

	/**
	 * Set Locations to have Items like the vanilla game.
	 *
	 * @return $this
	 */
	public function setVanilla() {
		$this->locations["Palace of Darkness Crystal"]->setItem(Item::get('Crystal1'));
		$this->locations["Swamp Palace Crystal"]->setItem(Item::get('Crystal2'));
		$this->locations["Skull Woods Crystal"]->setItem(Item::get('Crystal3'));
		$this->locations["Thieves Town Crystal"]->setItem(Item::get('Crystal4'));
		$this->locations["Ice Palace Crystal"]->setItem(Item::get('Crystal5'));
		$this->locations["Misery Mire Crystal"]->setItem(Item::get('Crystal6'));
		$this->locations["Turtle Rock Crystal"]->setItem(Item::get('Crystal7'));

		return $this;
	}
}
