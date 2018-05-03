<?php namespace ALttP;

use ALttP\Support\ItemCollection;

/**
 * An Item is any collectable thing in game.
 */
class Item {
	protected $bytes;
	protected $visiblePlm;
	protected $hiddenPlm;
	protected $chozoPlm;
	protected $address;
	protected $name;
	protected $nice_name;
	protected $linked_region;

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
			new Item('Nothing', 'Nothing', [0x5A], null, 0xf094, 0xe8 + 0xf094, 0x1d0 + 0xf094),
			new Item\Sword('L1Sword', 'Fighters Sword', [0x49], null, 0xf06c, 0xe8 + 0xf06c, 0x1d0 + 0xf06c), // Uncle must be dead
			new Item\Sword('L1SwordAndShield', 'Fighters Sword and Shield', [0x00], null, 0xf06c, 0xe8 + 0xf06c, 0x1d0 + 0xf06c), // Uncle must be dead
			new Item\Sword('L2Sword', 'Master Sword', [0x01], null, 0xf06c, 0xe8 + 0xf06c, 0x1d0 + 0xf06c),
			new Item\Sword('MasterSword', 'Master Sword', [0x50], null, 0xf06c, 0xe8 + 0xf06c, 0x1d0 + 0xf06c),
			new Item\Sword('L3Sword', 'Tempered Sword', [0x02], null, 0xf070, 0xe8 + 0xf070, 0x1d0 + 0xf070), // Uncle must be dead
			new Item\Sword('L4Sword', 'Golden Sword', [0x03], null, 0xf074, 0xe8 + 0xf074, 0x1d0 + 0xf074), // Uncle must be dead
			new Item\Shield('BlueShield', 'Fighters Shield', [0x04], null, 0xf080, 0xe8 + 0xf080, 0x1d0 + 0xf080), // Uncle must be dead
			new Item\Shield('RedShield', 'Fire Shield', [0x05], null, 0xf084, 0xe8 + 0xf084, 0x1d0 + 0xf084), // Uncle must be dead
			new Item\Shield('MirrorShield', 'Mirror Shield', [0x06], null, 0xf088, 0xe8 + 0xf088, 0x1d0 + 0xf088), // Uncle must be dead
			new Item('FireRod', 'Fire Rod', [0x07], null, 0xf000, 0xe8 + 0xf000, 0x1d0 + 0xf000),
			new Item('IceRod', 'Ice Rod', [0x08], null, 0xf004, 0xe8 + 0xf004, 0x1d0 + 0xf004),
			new Item('Hammer', 'Hammer', [0x09], null, 0xf018, 0xe8 + 0xf018, 0x1d0 + 0xf018),
			new Item('Hookshot', 'Hookshot', [0x0A], null, 0xeff0, 0xe8 + 0xeff0, 0x1d0 + 0xeff0),
			new Item\Bow('Bow', 'Bow', [0x0B], null, 0xefe0, 0xe8 + 0xefe0, 0x1d0 + 0xefe0),
			new Item('Boomerang', 'Blue Boomerang', [0x0C], null, 0xefe8, 0xe8 + 0xefe8, 0x1d0 + 0xefe8),
			new Item('Powder', 'Magic Powder', [0x0D], null, 0xeffc, 0xe8 + 0xeffc, 0x1d0 + 0xeffc),
			new Item\BottleContents('Bee', 'Bee', [0x0E], null, 0xefe0, 0xe8 + 0xefe0, 0x1d0 + 0xefe0),
			new Item\Medallion('Bombos', 'Bombos', [0x0f, 0x00, 't0' => 0x51, 't1' => 0x10, 't2' => 0x00, 'm0' => 0x51, 'm1' => 0x00, 'm2' => 0x00], null, 0xf008, 0xe8 + 0xf008, 0x1d0 + 0xf008),
			new Item\Medallion('Ether', 'Ether', [0x10, 0x01, 't0' => 0x51, 't1' => 0x18, 't2' => 0x00, 'm0' => 0x13, 'm1' => 0x9F, 'm2' => 0xF1], null, 0xf00c, 0xe8 + 0xf00c, 0x1d0 + 0xf00c),
			new Item\Medallion('Quake', 'Quake', [0x11, 0x02, 't0' => 0x14, 't1' => 0xEF, 't2' => 0xC4, 'm0' => 0x51, 'm1' => 0x08, 'm2' => 0x00], null, 0xf010, 0xe8 + 0xf010, 0x1d0 + 0xf010),
			new Item('Lamp', 'Lamp', [0x12], null, 0xf014, 0xe8 + 0xf014, 0x1d0 + 0xf014),
			new Item('Shovel', 'Shovel', [0x13], null, 0xf01c, 0xe8 + 0xf01c, 0x1d0 + 0xf01c),
			new Item('OcarinaInactive', 'Flute', [0x14], null, 0xf020, 0xe8 + 0xf020, 0x1d0 + 0xf020),
			new Item('CaneOfSomaria', 'Cane Of Somaria', [0x15], null, 0xf048, 0xe8 + 0xf048, 0x1d0 + 0xf048),
			new Item\Bottle('Bottle', 'Bottle (Empty)', [0x16], null, 0xf02c, 0xe8 + 0xf02c, 0x1d0 + 0xf02c),
			new Item\Upgrade\Health('PieceOfHeart', 'Piece Of Heart', [0x17], null, 0xf08c, 0xe8 + 0xf08c, 0x1d0 + 0xf08c),
			new Item('CaneOfByrna', 'Cane Of Byrna', [0x18], null, 0xf04c, 0xe8 + 0xf04c, 0x1d0 + 0xf04c),
			new Item('Cape', 'Magic Cape', [0x19], null, 0xf050, 0xe8 + 0xf050, 0x1d0 + 0xf050),
			new Item('MagicMirror', 'Magic Mirror', [0x1A], null, 0xf054, 0xe8 + 0xf054, 0x1d0 + 0xf054),
			new Item('PowerGlove', 'Power Glove', [0x1B], null, 0xf058, 0xe8 + 0xf058, 0x1d0 + 0xf058),
			new Item('TitansMitt', 'Titans Mitt', [0x1C], null, 0xf05c, 0xe8 + 0xf05c, 0x1d0 + 0xf05c),
			new Item('BookOfMudora', 'Book Of Mudora', [0x1D], null, 0xf028, 0xe8 + 0xf028, 0x1d0 + 0xf028),
			new Item('Flippers', 'Flippers', [0x1E], null, 0xf064, 0xe8 + 0xf064, 0x1d0 + 0xf064),
			new Item('MoonPearl', 'Moon Pearl', [0x1F], null, 0xf068, 0xe8 + 0xf068, 0x1d0 + 0xf068),
			new Item('BugCatchingNet', 'Bug Catching Net', [0x21], null, 0xf024, 0xe8 + 0xf024, 0x1d0 + 0xf024),
			new Item('BlueMail', 'Blue Mail', [0x22], null, 0xf078, 0xe8 + 0xf078, 0x1d0 + 0xf078),
			new Item('RedMail', 'Red Mail', [0x23], null, 0xf07c, 0xe8 + 0xf07c, 0x1d0 + 0xf07c),
			new Item\Key('Key', 'Key', [0x24]),
			new Item\Compass('Compass', 'Compass', [0x25]),
			new Item\Upgrade\Health('HeartContainerNoAnimation', 'Heart Container (no animation)', [0x26], null, 0xf090, 0xe8 + 0xf090, 0x1d0 + 0xf090),
			new Item('Bomb', 'Single Bomb', [0x27], null, 0xeff4, 0xe8 + 0xeff4, 0x1d0 + 0xeff4),
			new Item('ThreeBombs', 'Three Bombs', [0x28], null, 0xf0a0, 0xe8 + 0xf0a0, 0x1d0 + 0xf0a0),
			new Item('Mushroom', 'Mushroom', [0x29], null, 0xeff8, 0xe8 + 0xeff8, 0x1d0 + 0xeff8),
			new Item('RedBoomerang', 'Magical Boomerang', [0x2A], null, 0xefec, 0xe8 + 0xefec, 0x1d0 + 0xefec),
			new Item\Bottle('BottleWithRedPotion', 'Bottle (Red Potion)', [0x2B], null, 0xf030, 0xe8 + 0xf030, 0x1d0 + 0xf030),
			new Item\Bottle('BottleWithGreenPotion', 'Bottle (Green Potion)', [0x2C], null, 0xf034, 0xe8 + 0xf034, 0x1d0 + 0xf034),
			new Item\Bottle('BottleWithBluePotion', 'Bottle (Blue Potion)', [0x2D], null, 0xf038, 0xe8 + 0xf038, 0x1d0 + 0xf038),
			new Item\BottleContents('RedPotion', 'Red Potion', [0x2E]),
			new Item\BottleContents('GreenPotion', 'Green Potion', [0x2F]),
			new Item\BottleContents('BluePotion', 'Blue Potion', [0x30]),
			new Item('TenBombs', 'Ten Bombs', [0x31], null, 0xf0a4, 0xe8 + 0xf0a4, 0x1d0 + 0xf0a4),
			new Item\BigKey('BigKey', 'Big Key', [0x32]),
			new Item\Map('Map', 'Dungeon Map', [0x33]),
			new Item('OneRupee', 'One Rupee', [0x34], null, 0xf0a8, 0xe8 + 0xf0a8, 0x1d0 + 0xf0a8),
			new Item('FiveRupees', 'Five Rupees', [0x35], null, 0xf0ac, 0xe8 + 0xf0ac, 0x1d0 + 0xf0ac),
			new Item('TwentyRupees', 'Twenty Rupees', [0x36], null, 0xf0b0, 0xe8 + 0xf0b0, 0x1d0 + 0xf0b0),
			new Item\Pendant('PendantOfCourage', 'Pendant Of Courage', [0x37, 0x04, 0x38, 0x62, 0x00, 0x69, 0x01]),
			new Item\Pendant('PendantOfWisdom', 'Pendant Of Wisdom', [0x38, 0x01, 0x32, 0x60, 0x00, 0x69, 0x03]),
			new Item\Pendant('PendantOfPower', 'Pendant Of Power', [0x39, 0x02, 0x34, 0x60, 0x00, 0x69, 0x02]),
			new Item\Bow('BowAndArrows', 'Bow And Arrows', [0x3A], null, 0xefe0, 0xe8 + 0xefe0, 0x1d0 + 0xefe0),
			new Item\Bow('BowAndSilverArrows', 'Bow And Silver Arrows', [0x3B], null, 0xefe4, 0xe8 + 0xefe4, 0x1d0 + 0xefe4),
			new Item\Bottle('BottleWithBee', 'Bottle (Bee)', [0x3C], null, 0xf03c, 0xe8 + 0xf03c, 0x1d0 + 0xf03c),
			new Item\Bottle('BottleWithFairy', 'Bottle (Fairy)', [0x3D], null, 0xf044, 0xe8 + 0xf044, 0x1d0 + 0xf044),
			new Item\Upgrade\Health('BossHeartContainer', 'Heart Container', [0x3E], null, 0xf090, 0xe8 + 0xf090, 0x1d0 + 0xf090),
			new Item\Upgrade\Health('HeartContainer', 'Sancturary Heart Container', [0x3F], null, 0xf090, 0xe8 + 0xf090, 0x1d0 + 0xf090),
			new Item('OneHundredRupees', 'One Hundred Rupees', [0x40], null, 0xf0b8, 0xe8 + 0xf0b8, 0x1d0 + 0xf0b8),
			new Item('FiftyRupees', 'Fifty Rupees', [0x41], null, 0xf0b4, 0xe8 + 0xf0b4, 0x1d0 + 0xf0b4),
			new Item('Heart', 'Small Heart', [0x42]),
			new Item\Arrow('Arrow', 'Single Arrow', [0x43], null, 0xf094, 0xe8 + 0xf094, 0x1d0 + 0xf094),
			new Item\Arrow('TenArrows', 'Ten Arrows', [0x44], null, 0xf09c, 0xe8 + 0xf09c, 0x1d0 + 0xf09c),
			new Item('SmallMagic', 'Small Magic', [0x45]),
			new Item('ThreeHundredRupees', 'Three Hundred Rupees', [0x46], null, 0xf0bc, 0xe8 + 0xf0bc, 0x1d0 + 0xf0bc),
			new Item('TwentyRupees2', 'Twenty Rupees', [0x47], null, 0xf0b0, 0xe8 + 0xf0b0, 0x1d0 + 0xf0b0),
			new Item\Bottle('BottleWithGoldBee', 'Bottle (Golden Bee)', [0x48], null, 0xf040, 0xe8 + 0xf040, 0x1d0 + 0xf040),
			new Item('OcarinaActive', 'Flute (active)', [0x4A], null, 0xf020, 0xe8 + 0xf020, 0x1d0 + 0xf020),
			new Item('PegasusBoots', 'Pegasus Boots', [0x4B], null, 0xf060, 0xe8 + 0xf060, 0x1d0 + 0xf060),
			new Item\Upgrade\Bomb('BombUpgrade5', 'Bomb Upgrade (+5)', [0x51]),
			new Item\Upgrade\Bomb('BombUpgrade10', 'Bomb Upgrade (+10)', [0x52]),
			new Item\Upgrade\Bomb('BombUpgrade50', 'Bomb Upgrade (+50)', [0x4C]),
			new Item\Upgrade\Arrow('ArrowUpgrade5', 'Arrow Upgrade (+5)', [0x53]),
			new Item\Upgrade\Arrow('ArrowUpgrade10', 'Arrow Upgrade (+10)', [0x54]),
			new Item\Upgrade\Arrow('ArrowUpgrade70', 'Arrow Upgrade (+70)', [0x4D]),
			new Item\Upgrade\Magic('HalfMagic', 'Half Magic', [0x4E], null, 0xf0c0, 0xe8 + 0xf0c0, 0x1d0 + 0xf0c0),
			new Item\Upgrade\Magic('QuarterMagic', 'Quarter Magic', [0x4F], null, 0xf0c4, 0xe8 + 0xf0c4, 0x1d0 + 0xf0c4),
			new Item\Programmable('Programmable1', 'Programmable 1', [0x55]),
			new Item\Programmable('Programmable2', 'Programmable 2', [0x56]),
			new Item\Programmable('Programmable3', 'Programmable 3', [0x57]),
			new Item('SilverArrowUpgrade', 'Silver Arrows Upgrade', [0x58], null, 0xefe4, 0xe8 + 0xefe4, 0x1d0 + 0xefe4),
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
			new Item\Event('Triforce', 'Triforce', [0x6A]),
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
			new Item\Key('KeyGK', 'Generic Key', [0xAF]),
			new Item\SuperMetroid('Grapple', 'Grappling Beam', [0xB0], null, 0xef17, 0x54 + 0xef17, 0xa8 + 0xef17),
			new Item\SuperMetroid('XRay', 'X-Ray Scope', [0xB1], null, 0xef0f, 0x54 + 0xef0f, 0xa8 + 0xef0f),
			new Item\SuperMetroid('Varia', 'Varia Suit', [0xB2], null, 0xef07, 0x54 + 0xef07, 0xa8 + 0xef07),
			new Item\SuperMetroid('SpringBall', 'Spring Ball', [0xB3], null, 0xef03, 0x54 + 0xef03, 0xa8 + 0xef03),
			new Item\SuperMetroid('Morph', 'Morphing Ball', [0xB4], null, 0xef23, 0x54 + 0xef23, 0xa8 + 0xef23),
			new Item\SuperMetroid('ScrewAttack', 'Screw Attack', [0xB5], null, 0xef1f, 0x54 + 0xef1f, 0xa8 + 0xef1f),
			new Item\SuperMetroid('Gravity', 'Gravity Suit', [0xB6], null, 0xef0b, 0x54 + 0xef0b, 0xa8 + 0xef0b),
			new Item\SuperMetroid('HiJump', 'Hi-Jump Boots', [0xB7], null, 0xeef3, 0x54 + 0xeef3, 0xa8 + 0xeef3),
			new Item\SuperMetroid('SpaceJump', 'Space Jump', [0xB8], null, 0xef1b, 0x54 + 0xef1b, 0xa8 + 0xef1b),
			new Item\SuperMetroid('Bombs', 'Bombs', [0xB9], null, 0xeee7, 0x54 + 0xeee7, 0xa8 + 0xeee7),
			new Item\SuperMetroid('SpeedBooster', 'Speed Booster', [0xBA], null, 0xeef7, 0x54 + 0xeef7, 0xa8 + 0xeef7),
			new Item\SuperMetroid('ChargeBeam', 'Charge Beam', [0xBB], null, 0xeeeb, 0x54 + 0xeeeb, 0xa8 + 0xeeeb),
			new Item\SuperMetroid('IceBeam', 'Ice Beam', [0xBC], null, 0xeeef, 0x54 + 0xeeef, 0xa8 + 0xeeef),
			new Item\SuperMetroid('WaveBeam', 'Wave Beam', [0xBD], null, 0xeefb, 0x54 + 0xeefb, 0xa8 + 0xeefb),
			new Item\SuperMetroid('Spazer', 'Spazer', [0xBE], null, 0xeeff, 0x54 + 0xeeff, 0xa8 + 0xeeff),
			new Item\SuperMetroid('Plasma', 'Plasma Beam', [0xBF], null, 0xef13, 0x54 + 0xef13, 0xa8 + 0xef13),
			new Item\SuperMetroid('ETank', 'Energy Tank', [0xC0], null, 0xeed7, 0x54 + 0xeed7, 0xa8 + 0xeed7),
			new Item\SuperMetroid('ReserveTank', 'Reserve Tank', [0xC1], null, 0xef27, 0x54 + 0xef27, 0xa8 + 0xef27),
			new Item\SuperMetroid('Missile', 'Missile', [0xC2], null, 0xeedb, 0x54 + 0xeedb, 0xa8 + 0xeedb),
			new Item\SuperMetroid('Super', 'Super Missile', [0xC3], null, 0xeedf, 0x54 + 0xeedf, 0xa8 + 0xeedf),
			new Item\SuperMetroid('PowerBomb', 'Power Bomb', [0xC4], null, 0xeee3, 0x54 + 0xeee3, 0xa8 + 0xeee3),

			new Item\Crystal('Crystal1', 'Crystal 1', [null, 0x02, 0x34, 0x64, 0x40, 0x7F, 0x06]),
			new Item\Crystal('Crystal2', 'Crystal 2', [null, 0x10, 0x34, 0x64, 0x40, 0x79, 0x06]),
			new Item\Crystal('Crystal3', 'Crystal 3', [null, 0x40, 0x34, 0x64, 0x40, 0x6C, 0x06]),
			new Item\Crystal('Crystal4', 'Crystal 4', [null, 0x20, 0x34, 0x64, 0x40, 0x6D, 0x06]),
			new Item\Crystal('Crystal5', 'Crystal 5', [null, 0x04, 0x32, 0x64, 0x40, 0x6E, 0x06]),
			new Item\Crystal('Crystal6', 'Crystal 6', [null, 0x01, 0x32, 0x64, 0x40, 0x6F, 0x06]),
			new Item\Crystal('Crystal7', 'Crystal 7', [null, 0x08, 0x34, 0x64, 0x40, 0x7C, 0x06]),
			new Item\Event('RescueZelda', 'Rescue Zelda', [null]),
			new Item\Event('DefeatAgahnim', 'Defeat Agahnim', [null]),
			new Item\Event('DefeatAgahnim2', 'Defeat Agahnim 2', [null]),
			new Item\Event('DefeatGanon', 'Defeat Ganon', [null]),

			new Item\Event('DefeatPhantoon', 'Defeat Phantoon', [null]),
			new Item\Event('DefeatKraid', 'Defeat Kraid', [null]),
			new Item\Event('DefeatDraygon', 'Defeat Draygon', [null]),
			new Item\Event('DefeatRidley', 'Defeat Ridley', [null]),
			new Item\Event('DefeatMotherBrain', 'Defeat Mother Brain', [null]),
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
	public function __construct($name, $nice_name, $bytes, $address = null, $visiblePlm = null, $chozoPlm = null, $hiddenPlm = null) {
		$this->name = $name;
		$this->nice_name = $nice_name;
		$this->bytes = (array) $bytes;
		$this->address = (array) $address;
		$this->visiblePlm = $visiblePlm;
		$this->chozoPlm = $chozoPlm;
		$this->hiddenPlm = $hiddenPlm;
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
	 * Get the bytes to write
	 *
	 * @return array
	 */
	public function getVisibleBytes() {
		if($this->visiblePlm == null)
		{
			echo("Null Visible PLM");
		}
		$bytes = [$this->visiblePlm & 0xFF, ($this->visiblePlm >> 8) & 0xFF]; 
		return $bytes;
	}

	/**
	 * Get the bytes to write
	 *
	 * @return array
	 */
	public function getHiddenBytes() {
		if($this->hiddenPlm == null)
		{
			echo("Null Hidden PLM");
		}

		return [$this->hiddenPlm & 0xFF, ($this->hiddenPlm >> 8) & 0xFF];
	}

    /**
	 * Get the bytes to write
	 *
	 * @return array
	 */
	public function getChozoBytes() {
		if($this->chozoPlm == null)
		{
			echo("Null Chozo PLM");
		}
		return [$this->chozoPlm & 0xFF, ($this->chozoPlm >> 8) & 0xFF];
	}

	/**
	 * Get the addresses to write to
	 *
	 * @return array
	 */
	public function getAddress() {
		return $this->address;
	}

	public function linkRegion(Region $region) {
		$this->linked_region = $region;

		return $this;
	}

	public function getLinkedRegion() {
		return $this->linked_region;
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
