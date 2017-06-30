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
	static public function get(string $name) {
		$items = static::all();
		if (isset($items[$name])) {
			return $items[$name];
		}

		return static::getNice($name);
	}

	/**
	 * Get the Item by nice name
	 *
	 * @param string $name Name of Item
	 *
	 * @throws Exception if the Item doesn't exist
	 *
	 * @return Item
	 */
	static public function getNice(string $name) {
		$items = static::all();

		foreach ($items as $item) {
			if ($item->getNiceName() == $name) {
				return $item;
			}
		}

		throw new \Exception('Unknown Item: ' . $name);
	}

	/**
	 * Get the Item by byte
	 *
	 * @param int $byte byte of Item
	 *
	 * @throws Exception if the Item doesn't exist
	 *
	 * @return Item
	 */
	static public function getWithByte(int $byte) {
		foreach (static::all() as $item) {
			if ($item->bytes[0] == $byte) {
				return $item;
			}
		}

		throw new \Exception('Unknown Item with byte: ' . $byte);
	}

	/**
	 * Get the Item by bytes
	 *
	 * @param array $bytes array of bytes of Item
	 *
	 * @throws Exception if the Item doesn't exist
	 *
	 * @return Item
	 */
	static public function getWithBytes(array $bytes) {
		foreach (static::all() as $item) {
			foreach ($bytes as $key => $byte) {
				if (!isset($item->bytes[$key]) || $item->bytes[$key] != $byte) {
					continue 2;
				}
			}
			return $item;
		}

		throw new \Exception('Unknown Item with bytes: ' . json_encode($bytes));
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
			new Item('Nothing', 'Nothing', [0x5A]),
			new Item\Sword('L1Sword', 'Fighters Sword', [0x49]), // Uncle must be dead
			new Item\Sword('L1SwordAndShield', 'Fighters Sword and Shield', [0x00]), // Uncle must be dead
			new Item\Sword('L2Sword', 'Master Sword', [0x01]),
			new Item\Sword('MasterSword', 'Master Sword', [0x50]),
			new Item\Sword('L3Sword', 'Tempered Sword', [0x02]), // Uncle must be dead
			new Item\Sword('L4Sword', 'Golden Sword', [0x03]), // Uncle must be dead
			new Item\Shield('BlueShield', 'Fighters Shield', [0x04]), // Uncle must be dead
			new Item\Shield('RedShield', 'Fire Shield', [0x05]), // Uncle must be dead
			new Item\Shield('MirrorShield', 'Mirror Shield', [0x06]), // Uncle must be dead
			new Item('FireRod', 'Fire Rod', [0x07]),
			new Item('IceRod', 'Ice Rod', [0x08]),
			new Item('Hammer', 'Hammer', [0x09]),
			new Item('Hookshot', 'Hookshot', [0x0A]),
			new Item('Bow', 'Bow', [0x0B]),
			new Item('Boomerang', 'Boomerang', [0x0C]), // alternate: 10 arrows
			new Item('Powder', 'Magic Powder', [0x0D]),
			new Item('Bee', 'Bee', [0x0E]), // bottle required
			new Item\Medallion('Bombos', 'Bombos', [0x0f, 0x00, 't0' => 0x31, 't1' => 0x90, 't2' => 0x00, 'm0' => 0x31, 'm1' => 0x80, 'm2' => 0x00]),
			new Item\Medallion('Ether', 'Ether', [0x10, 0x01, 't0' => 0x31, 't1' => 0x98, 't2' => 0x00]),
			new Item\Medallion('Quake', 'Quake', [0x11, 0x02, 'm0' => 0x31, 'm1' => 0x88, 'm2' => 0x00]),
			new Item('Lamp', 'Lamp', [0x12]), // alternate: 5 rupees
			new Item('Shovel', 'Shovel', [0x13]),
			new Item('OcarinaInactive', 'Flute', [0x14]),
			new Item('CaneOfSomaria', 'Cane Of Somaria', [0x15]),
			new Item\Bottle('Bottle', 'Bottle', [0x16]),
			new Item('PieceOfHeart', 'Piece Of Heart', [0x17]),
			new Item('CaneOfByrna', 'Cane Of Byrna', [0x18]),
			new Item('Cape', 'Magic Cape', [0x19]),
			new Item('MagicMirror', 'Magic Mirror', [0x1A]),
			new Item('PowerGlove', 'Power Glove', [0x1B]),
			new Item('TitansMitt', 'Titans Mitt', [0x1C]),
			new Item('BookOfMudora', 'Book Of Mudora', [0x1D]),
			new Item('Flippers', 'Flippers', [0x1E]),
			new Item('MoonPearl', 'Moon Pearl', [0x1F]),
			new Item('BugCatchingNet', 'Bug Catching Net', [0x21]),
			new Item('BlueMail', 'Blue Mail', [0x22]),
			new Item('RedMail', 'Red Mail', [0x23]),
			new Item\Key('Key', 'Key', [0x24]),
			new Item\Compass('Compass', 'Compass', [0x25]),
			new Item('HeartContainerNoAnimation', 'Heart Container (no animation)', [0x26]),
			new Item('Bomb', 'Bomb', [0x27]),
			new Item('ThreeBombs', 'Three Bombs', [0x28]),
			new Item('Mushroom', 'Mushroom', [0x29]),
			new Item('RedBoomerang', 'Magical Boomerang', [0x2A]), // alternate: 300 rupees
			new Item\Bottle('BottleWithRedPotion', 'Bottle (Red Potion)', [0x2B]),
			new Item\Bottle('BottleWithGreenPotion', 'Bottle (Green Potion)', [0x2C]),
			new Item\Bottle('BottleWithBluePotion', 'Bottle (Blue Potion)', [0x2D]),
			new Item('RedPotion', 'Red Potion', [0x2E]), // bottle required
			new Item('GreenPotion', 'Green Potion', [0x2F]), // bottle required
			new Item('BluePotion', 'Blue Potion', [0x30]), // bottle required
			new Item('TenBombs', 'Ten Bombs', [0x31]),
			new Item\BigKey('BigKey', 'Big Key', [0x32]),
			new Item\Map('Map', 'Dungeon Map', [0x33]),
			new Item('OneRupee', 'One Rupee', [0x34]),
			new Item('FiveRupees', 'Five Rupees', [0x35]),
			new Item('TwentyRupees', 'Twenty Rupees', [0x36]),
			new Item\Pendant('PendantOfCourage', 'Pendant Of Courage', [0x37, 0x04, 0x38, 0x60, 0x00, 0x69, 0x01]),
			new Item\Pendant('PendantOfWisdom', 'Pendant Of Wisdom', [0x38, 0x01, 0x32, 0x60, 0x00, 0x69, 0x03]),
			new Item\Pendant('PendantOfPower', 'Pendant Of Power', [0x39, 0x02, 0x34, 0x60, 0x00, 0x69, 0x02]),
			new Item('BowAndArrows', 'Bow And Arrows', [0x3A]),
			new Item('BowAndSilverArrows', 'Bow And Silver Arrows', [0x3B]),
			new Item\Bottle('BottleWithBee', 'Bottle (Bee)', [0x3C]),
			new Item\Bottle('BottleWithFairy', 'Bottle (Fairy)', [0x3D]),
			new Item('BossHeartContainer', 'Heart Container', [0x3E]),
			new Item('HeartContainer', 'Heart Container (refill)', [0x3F]),
			new Item('OneHundredRupees', 'One Hundred Rupees', [0x40]),
			new Item('FiftyRupees', 'Fifty Rupees', [0x41]),
			new Item('Heart', 'Heart', [0x42]),
			new Item('Arrow', 'Arrow', [0x43]),
			new Item('TenArrows', 'Ten Arrows', [0x44]),
			new Item('SmallMagic', 'Small Magic', [0x45]),
			new Item('ThreeHundredRupees', 'Three Hundred Rupees', [0x46]),
			new Item('TwentyRupees2', 'Twenty Rupees', [0x47]),
			new Item\Bottle('BottleWithGoldBee', 'Bottle (Golden Bee)', [0x48]),
			new Item('OcarinaActive', 'Flute', [0x4A]),
			new Item('PegasusBoots', 'Pegasus Boots', [0x4B]),
			new Item('BombUpgrade5', 'Bomb Upgrade (5)', [0x51]),
			new Item('BombUpgrade10', 'Bomb Upgrade (10)', [0x52]),
			new Item('BombUpgrade50', 'Bomb Upgrade (50)', [0x4C]),
			new Item('ArrowUpgrade5', 'Arrow Upgrade (5)', [0x53]),
			new Item('ArrowUpgrade10', 'Arrow Upgrade (10)', [0x54]),
			new Item('ArrowUpgrade70', 'Arrow Upgrade (70)', [0x4D]),
			new Item('HalfMagic', 'Half Magic', [0x4E]),
			new Item('QuarterMagic', 'Quarter Magic', [0x4F]),
			new Item('Programmable1', 'Programmable 1', [0x55]),
			new Item('Programmable2', 'Programmable 2', [0x56]),
			new Item('Programmable3', 'Programmable 3', [0x57]),
			new Item('SilverArrowUpgrade', 'Silver Arrows Upgrade', [0x58]),
			new Item('Rupoor', 'Rupoor', [0x59]),
			new Item('RedClock', 'Red Clock', [0x5B]),
			new Item('BlueClock', 'Blue Clock', [0x5C]),
			new Item('GreenClock', 'Green Clock', [0x5D]),
			new Item\Sword('ProgressiveSword', 'Progressive Sword', [0x5E]),
			new Item\Shield('ProgressiveShield', 'Progressive Shield', [0x5F]),
			new Item('ProgressiveArmor', 'Progressive Armor', [0x60]),
			new Item('ProgressiveGlove', 'Progressive Glove', [0x61]),
			new Item('singleRNG', 'Unique RNG Item', [0x62]),
			new Item('multiRNG', 'Non-Unique RNG Item', [0x63]),
			new Item('Triforce', 'Triforce', [0x6A]),
			new Item('PowerStar', 'Power Star', [0x6B]),
			new Item('TriforcePiece', 'Triforce Piece', [0x6C]),
			new Item\Map('MapLW', 'Light World Map', [0x70]),
			new Item\Map('MapDW', 'Dark World Map', [0x71]),
			new Item\Map('MapA2', 'Ganons Tower Map', [0x72]),
			new Item\Map('MapD7', 'Turtle Rock Map', [0x73]),
			new Item\Map('MapD4', 'Thieves Town Map', [0x74]),
			new Item\Map('MapP3', 'Tower of Hera Map', [0x75]),
			new Item\Map('MapD5', 'Ice Palace Map', [0x76]),
			new Item\Map('MapD3', 'Skull Woods Map', [0x77]),
			new Item\Map('MapD6', 'Misery Mire Map', [0x78]),
			new Item\Map('MapD1', 'Palace of Darkness Map', [0x79]),
			new Item\Map('MapD2', 'Swamp Palace Map', [0x7A]),
			new Item\Map('MapA1', 'Agahnims Tower Map', [0x7B]),
			new Item\Map('MapP2', 'Desert Palace Map', [0x7C]),
			new Item\Map('MapP1', 'Eastern Palace Map', [0x7D]),
			new Item\Map('MapH1', 'Hyrule Castle Map', [0x7E]),
			new Item\Map('MapH2', 'Sewers Map', [0x7F]),
			new Item\Compass('CompassA2', 'Ganons Tower Compass', [0x82]),
			new Item\Compass('CompassD7', 'Turtle Rock Compass', [0x83]),
			new Item\Compass('CompassD4', 'Thieves Town Compass', [0x84]),
			new Item\Compass('CompassP3', 'Tower of Hera Compass', [0x85]),
			new Item\Compass('CompassD5', 'Ice Palace Compass', [0x86]),
			new Item\Compass('CompassD3', 'Skull Woods Compass', [0x87]),
			new Item\Compass('CompassD6', 'Misery Mire Compass', [0x88]),
			new Item\Compass('CompassD1', 'Palace of Darkness Compass', [0x89]),
			new Item\Compass('CompassD2', 'Swamp Palace Compass', [0x8A]),
			new Item\Compass('CompassA1', 'Agahnims Tower Compass', [0x8B]),
			new Item\Compass('CompassP2', 'Desert Palace Compass', [0x8C]),
			new Item\Compass('CompassP1', 'Eastern Palace Compass', [0x8D]),
			new Item\Compass('CompassH1', 'Hyrule Castle Compass', [0x8E]),
			new Item\Compass('CompassH2', 'Sewers Compass', [0x8F]),
			new Item\BigKey('BigKeyA2', 'Ganons Tower Big Key', [0x92]),
			new Item\BigKey('BigKeyD7', 'Turtle Rock Big Key', [0x93]),
			new Item\BigKey('BigKeyD4', 'Thieves Town Big Key', [0x94]),
			new Item\BigKey('BigKeyP3', 'Tower of Hera Big Key', [0x95]),
			new Item\BigKey('BigKeyD5', 'Ice Palace Big Key', [0x96]),
			new Item\BigKey('BigKeyD3', 'Skull Woods Big Key', [0x97]),
			new Item\BigKey('BigKeyD6', 'Misery Mire Big Key', [0x98]),
			new Item\BigKey('BigKeyD1', 'Palace of Darkness Big Key', [0x99]),
			new Item\BigKey('BigKeyD2', 'Swamp Palace Big Key', [0x9A]),
			new Item\BigKey('BigKeyA1', 'Agahnims Tower Big Key', [0x9B]),
			new Item\BigKey('BigKeyP2', 'Desert Palace Big Key', [0x9C]),
			new Item\BigKey('BigKeyP1', 'Eastern Palace Big Key', [0x9D]),
			new Item\BigKey('BigKeyH1', 'Hyrule Castle Big Key', [0x9E]),
			new Item\BigKey('BigKeyH2', 'Sewers Big Key', [0x9F]),
			new Item\Key('KeyH2', 'Sewers Key', [0xA0]),
			new Item\Key('KeyH1', 'Hyrule Castle Key', [0xA1]),
			new Item\Key('KeyP1', 'Eastern Palace Key', [0xA2]),
			new Item\Key('KeyP2', 'Desert Palace Key', [0xA3]),
			new Item\Key('KeyA1', 'Agahnims Tower Key', [0xA4]),
			new Item\Key('KeyD2', 'Swamp Palace Key', [0xA5]),
			new Item\Key('KeyD1', 'Palace of Darkness Key', [0xA6]),
			new Item\Key('KeyD6', 'Misery Mire Key', [0xA7]),
			new Item\Key('KeyD3', 'Skull Woods Key', [0xA8]),
			new Item\Key('KeyD5', 'Ice Palace Key', [0xA9]),
			new Item\Key('KeyP3', 'Tower of Hera Key', [0xAA]),
			new Item\Key('KeyD4', 'Thieves Town Key', [0xAB]),
			new Item\Key('KeyD7', 'Turtle Rock Key', [0xAC]),
			new Item\Key('KeyA2', 'Ganons Tower Key', [0xAD]),
			new Item\Crystal('Crystal1', 'Crystal 1', [null, 0x02, 0x34, 0x64, 0x40, 0x7F, 0x06]),
			new Item\Crystal('Crystal2', 'Crystal 2', [null, 0x10, 0x34, 0x64, 0x40, 0x79, 0x06]),
			new Item\Crystal('Crystal3', 'Crystal 3', [null, 0x40, 0x34, 0x64, 0x40, 0x6C, 0x06]),
			new Item\Crystal('Crystal4', 'Crystal 4', [null, 0x20, 0x34, 0x64, 0x40, 0x6D, 0x06]),
			new Item\Crystal('Crystal5', 'Crystal 5', [null, 0x04, 0x34, 0x64, 0x40, 0x6E, 0x06]),
			new Item\Crystal('Crystal6', 'Crystal 6', [null, 0x01, 0x34, 0x64, 0x40, 0x6F, 0x06]),
			new Item\Crystal('Crystal7', 'Crystal 7', [null, 0x08, 0x34, 0x64, 0x40, 0x7C, 0x06]),
			new Item\Event('DefeatAgahnim', 'Defeat Agahnim', [null]),
			new Item\Event('DefeatAgahnim2', 'Defeat Agahnim 2', [null]),
			new Item\Event('DefeatGanon', 'Defeat Ganon', [null]),
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
