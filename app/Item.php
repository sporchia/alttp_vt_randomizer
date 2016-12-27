<?php namespace ALttP;

use ALttP\Support\ItemCollection;

/**
 * An Item is any collectable thing in game.
 */
class Item {
	protected $bytes;
	protected $address;
	protected $name;
	protected $nice_name;

	static protected $items;

	/**
	 * Get the Item by name
	 *
	 * @param string $name Name of Item
	 *
	 * @throws Exception if the Item doesn't exist
	 *
	 * @return Item
	 */
	static public function get($name) {
		$items = static::all();
		if (isset($items[$name])) {
			return $items[$name];
		}

		throw new \Exception('Unknown Item: ' . $name);
	}

	/**
	 * Get the all known Items
	 *
	 * @return ItemCollection
	 */
	static public function all() {
		if (static::$items) {
			return static::$items;
		}

		static::$items = new ItemCollection([
			new Item('Nothing', 'Nothing', 0xFF),
			new Item\Sword('L1Sword', 'Fighters Sword', 0x49), // Uncle must be dead
			new Item\Sword('L1SwordAndShield', 'Fighters Sword and Shield', 0x00), // Uncle must be dead
			new Item\Sword('L2Sword', 'Master Sword', 0x01),
			new Item\Sword('MasterSword', 'Master Sword', 0x50),
			new Item\Sword('L3Sword', 'Tempered Sword', 0x02), // Uncle must be dead
			new Item\Sword('L4Sword', 'Golden Sword', 0x03), // Uncle must be dead
			new Item('BlueShield', 'Fighters Shield', 0x04), // Uncle must be dead
			new Item('RedShield', 'Fire Shield', 0x05), // Uncle must be dead
			new Item('MirrorShield', 'Mirror Shield', 0x06), // Uncle must be dead
			new Item('FireRod', 'Fire Rod', 0x07),
			new Item('IceRod', 'Ice Rod', 0x08),
			new Item('Hammer', 'Hammer', 0x09),
			new Item('Hookshot', 'Hookshot', 0x0a),
			new Item('Bow', 'Bow', 0x0b),
			new Item('Boomerang', 'Boomerang', 0x0c), // alternate: 10 arrows
			new Item('Powder', 'Magic Powder', 0x0d),
			new Item('Bee', 'Bee', 0x0e), // bottle required
			new Item\Medallion('Bombos', 'Bombos', [0x0f, 0x00, 't0' => 0x31, 't1' => 0x90, 't2' => 0x00, 'm0' => 0x31, 'm1' => 0x80, 'm2' => 0x00]),
			new Item\Medallion('Ether', 'Ether', [0x10, 0x01, 't0' => 0x31, 't1' => 0x98, 't2' => 0x00]),
			new Item\Medallion('Quake', 'Quake', [0x11, 0x02, 'm0' => 0x31, 'm1' => 0x88, 'm2' => 0x00]),
			new Item('Lamp', 'Lamp', 0x12), // alternate: 5 rupees
			new Item('Shovel', 'Shovel', 0x13),
			new Item('OcarinaInactive', 'Flute', 0x14),
			new Item('CaneOfSomaria', 'Cane Of Somaria', 0x15),
			new Item\Bottle('Bottle', 'Bottle', 0x16),
			new Item('PieceOfHeart', 'Piece Of Heart', 0x17),
			new Item('StaffOfByrna', 'Staff Of Byrna', 0x18),
			new Item('Cape', 'Magic Cape', 0x19),
			new Item('MagicMirror', 'Magic Mirror', 0x1a),
			new Item('PowerGlove', 'Power Glove', 0x1b),
			new Item('TitansMitt', 'Titans Mitt', 0x1c),
			new Item('BookOfMudora', 'Book Of Mudora', 0x1d),
			new Item('Flippers', 'Flippers', 0x1e),
			new Item('MoonPearl', 'Moon Pearl', 0x1f),
			new Item('BugCatchingNet', 'Bug Catching Net', 0x21),
			new Item('BlueMail', 'Blue Mail', 0x22),
			new Item('RedMail', 'Red Mail', 0x23),
			new Item('Key', 'Key', 0x24),
			new Item('Compass', 'Compass', 0x25),
			new Item('HeartContainerNoAnimation', 'Heart Container', 0x26),
			new Item('Bomb', 'Bomb', 0x27),
			new Item('ThreeBombs', 'Three Bombs', 0x28),
			new Item('Mushroom', 'Mushroom', 0x29),
			new Item('RedBoomerang', 'Magical Boomerang', 0x2a),
			new Item\Bottle('BottleWithRedPotion', 'Bottle (Red Potion)', 0x2b),
			new Item\Bottle('BottleWithGreenPotion', 'Bottle (Green Potion)', 0x2c),
			new Item\Bottle('BottleWithBluePotion', 'Bottle (Blue Potion)', 0x2d),
			new Item('RedPotion', 'Red Potion', 0x2e), // bottle required
			new Item('GreenPotion', 'Green Potion', 0x2f), // bottle required
			new Item('BluePotion', 'Blue Potion', 0x30), // bottle required
			new Item('TenBombs', 'Ten Bombs', 0x31),
			new Item('BigKey', 'Big Key', 0x32),
			new Item('Map', 'Dungeon Map', 0x33),
			new Item('OneRupee', 'One Rupee', 0x34),
			new Item('FiveRupees', 'Five Rupees', 0x35),
			new Item('TwentyRupees', 'Twenty Rupees', 0x36),
			new Item\Pendant('PendantOfCourage', 'Pendant Of Courage', [0x37, 0x04, 0x04, 0x38, 0x00, 0x01]),
			new Item\Pendant('PendantOfWisdom', 'Pendant Of Wisdom', [0x38, 0x01, 0x01, 0x32, 0x00, 0x03]),
			new Item\Pendant('PendantOfPower', 'Pendant Of Power', [0x39, 0x02, 0x02, 0x34, 0x00, 0x02]),
			new Item('BowAndArrows', 'Bow And Arrows', 0x3a),
			new Item('BowAndSilverArrows', 'Bow And Silver Arrows', 0x3b),
			new Item\Bottle('BottleWithBee', 'Bottle (Bee)', 0x3c),
			new Item\Bottle('BottleWithFairy', 'Bottle (Fairy)', 0x3d),
			new Item('BossHeartContainer', 'Heart Container', 0x3e),
			new Item('HeartContainer', 'Heart Container (refill)', 0x3f),
			new Item('OneHundredRupees', 'One Hundred Rupees', 0x40),
			new Item('FiftyRupees', 'Fifty Rupees', 0x41),
			new Item('Heart', 'Heart', 0x42),
			new Item('Arrow', 'Arrow', 0x43),
			new Item('TenArrows', 'Ten Arrows', 0x44),
			new Item('SmallMagic', 'Small Magic', 0x45),
			new Item('ThreeHundredRupees', 'Three Hundred Rupees', 0x46),
			new Item('TwentyRupees2', 'Twenty Rupees', 0x47),
			new Item\Bottle('BottleWithGoldBee', 'Bottle (Golden Bee)', 0x48),
			new Item('OcarinaActive', 'Flute', 0x4a),
			new Item('PegasusBoots', 'Pegasus Boots', 0x4b),
			new Item('BombUpgrade5', 'Bomb Upgrade (5)', 0x51),
			new Item('BombUpgrade10', 'Bomb Upgrade (10)', 0x52),
			new Item('BombUpgrade50', 'Bomb Upgrade (50)', 0x4c),
			new Item('ArrowUpgrade5', 'Arrow Upgrade (5)', 0x53),
			new Item('ArrowUpgrade10', 'Arrow Upgrade (10)', 0x54),
			new Item('ArrowUpgrade70', 'Arrow Upgrade (70)', 0x4d),
			new Item('HalfMagic', 'Half Magic', 0x4e),
			new Item('QuarterMagic', 'Quarter Magic', 0x4f),
			new Item\Crystal('Crystal1', 'Crystal 1', [null, 0x02, 0x02, 0x7F, 0x40, 0x06], [0x10860]),
			new Item\Crystal('Crystal2', 'Crystal 2', [null, 0x10, 0x10, 0x79, 0x40, 0x06], [0x1085E]),
			new Item\Crystal('Crystal3', 'Crystal 3', [null, 0x40, 0x40, 0x6C, 0x40, 0x06], [0x10862]),
			new Item\Crystal('Crystal4', 'Crystal 4', [null, 0x20, 0x20, 0x6D, 0x40, 0x06], [0x1086A]),
			new Item\Crystal('Crystal5', 'Crystal 5', [null, 0x04, 0x04, 0x6E, 0x40, 0x06], [0x10866]),
			new Item\Crystal('Crystal6', 'Crystal 6', [null, 0x01, 0x01, 0x6F, 0x40, 0x06], [0x10864]),
			new Item\Crystal('Crystal7', 'Crystal 7', [null, 0x08, 0x08, 0x7C, 0x40, 0x06], [0x10868]),
		]);
		return static::all();
	}

	/**
	 * Create a new Item
	 *
	 * @param string $name Unique name of item
	 * @param string $nice_name Well formatted name for item
	 * @param array $bytes data to write to Location addresses
	 * @param array|null $address Addresses in ROM to write back Location data if set
	 *
	 * @return void
	 */
	public function __construct($name, $nice_name, $bytes, $address = null) {
		$this->name = $name;
		$this->nice_name = $nice_name;
		$this->bytes = (array) $bytes;
		$this->address = (array) $address;
	}

	/**
	 * Get the name of this Item
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Get the nice name of this Item
	 *
	 * @return string
	 */
	public function getNiceName() {
		return $this->nice_name;
	}

	/**
	 * Get the bytes to write
	 *
	 * @return array
	 */
	public function getBytes() {
		return $this->bytes;
	}

	/**
	 * Get the addresses to write to
	 *
	 * @return array
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * serialized version of Item
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->name . serialize($this->bytes);
	}
}
