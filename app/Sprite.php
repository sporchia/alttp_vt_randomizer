<?php namespace ALttP;

use ALttP\Support\SpriteCollection;
use ALttP\Rom;

/**
 * A Sprite are the things in game.
 * this is very much a work in progress
 */
class Sprite {
	protected $bytes;
	protected $address;
	protected $name;
	protected $nice_name;

	static protected $items;

	/**
	 * Get the Sprite by name
	 *
	 * @param string $name Name of Sprite
	 *
	 * @throws Exception if the Sprite doesn't exist
	 *
	 * @return Sprite
	 */
	static public function get($name) {
		$items = static::all();
		if (isset($items[$name])) {
			return $items[$name];
		}

		throw new \Exception('Unknown Sprite: ' . $name);
	}

	/**
	 * Get the Sprite by byte
	 *
	 * @param int $byte byte of Sprite
	 *
	 * @throws Exception if the Sprite doesn't exist
	 *
	 * @return Sprite
	 */
	static public function getWithByte($byte) {
		foreach (static::all() as $item) {
			if ($item->bytes[0] == $byte) {
				return $item;
			}
		}

		throw new \Exception('Unknown Sprite: ' . $name);
	}

	/**
	 * Get the Sprite by bytes
	 *
	 * @param array $bytes array of bytes of Sprite
	 *
	 * @throws Exception if the Sprite doesn't exist
	 *
	 * @return Sprite
	 */
	static public function getWithBytes($bytes) {
		foreach (static::all() as $item) {
			foreach ($bytes as $key => $byte) {
				if (!isset($item->bytes[$key]) || $item->bytes[$key] != $byte) {
					continue 2;
				}
			}
			return $item;
		}

		throw new \Exception('Unknown Sprite: ' . $name);
	}

	/**
	 * Get the all known Sprites
	 *
	 * @return SpriteCollection
	 */
	static public function all() {
		if (static::$items) {
			return static::$items;
		}

		static::$items = new SpriteCollection([
			new Sprite("Raven", "Raven", [0x00]),
			new Sprite("Vulture", "Vulture", [0x01]),
			new Sprite("FlyingStalfosHead", "Flying Stalfos Head", [0x02]),
			new Sprite("Empty", "Empty", [0x03]),
			new Sprite("PullSwitchGood", "Pull Switch (Good)", [0x04]),
			new Sprite("PullSwitch1", "Pull Switch (Unused)", [0x05]),
			new Sprite("PullSwitchBad", "Pull Switch (Bad)", [0x06]),
			new Sprite("PullSwitch2", "Pull Switch (Unused)", [0x07]),
			new Sprite("Octorok1", "Octorok (One Way)", [0x08]),
			new Sprite("Moldorm", "Moldorm (Boss)", [0x09]),
			new Sprite("Octorok4", "Octorok (Four Way)", [0x0A]),
			new Sprite("Chicken", "Chicken", [0x0B]),
			new Sprite("Octorok", "Octorok (?)", [0x0C]),
			new Sprite("Buzzblob", "Buzzblob", [0x0D]),
			new Sprite("Snapdragon", "Snapdragon", [0x0E]),
			new Sprite("Octoballoon", "Octoballoon", [0x0F]),
			new Sprite("OctoballoonHatchlings", "Octoballoon Hatchlings", [0x10]),
			new Sprite("Hinox", "Hinox", [0x11]),
			new Sprite("Moblin", "Moblin", [0x12]),
			new Sprite("MiniHelmasaur", "Mini Helmasaur", [0x13]),
			new Sprite("ForkGate", "Gargoyle's Domain Gate", [0x14]),
			new Sprite("Antifairy", "Antifairy", [0x15]),
			new Sprite("Sahasrahla", "Sahasrahla / Aginah", [0x16]),
			new Sprite("BushHoarder", "Bush Hoarder", [0x17]),
			new Sprite("MiniMoldorm", "Mini Moldorm", [0x18]),
			new Sprite("Poe", "Poe", [0x19]),
			new Sprite("Dwarves", "Dwarves", [0x1A]),
			new Sprite("WallArrow", "Arrow in wall?", [0x1B]),
			new Sprite("Statue", "Statue", [0x1C]),
			new Sprite("Weathervane", "Weathervane", [0x1D]),
			new Sprite("CrystalSwitch", "Crystal Switch", [0x1E]),
			new Sprite("SickKid", "Bug-Catching Kid", [0x1F]),
			new Sprite("Sluggula", "Sluggula", [0x20]),
			new Sprite("PushSwitch", "Push Switch", [0x21]),
			new Sprite("Ropa", "Ropa", [0x22]),
			new Sprite("RedBari", "Red Bari", [0x23]),
			new Sprite("BlueBari", "Blue Bari", [0x24]),
			new Sprite("TalkingTree", "Talking Tree", [0x25]),
			new Sprite("HardhatBeetle", "Hardhat Beetle", [0x26]),
			new Sprite("Deadrock", "Deadrock", [0x27]),
			new Sprite("Storytellers", "Storytellers", [0x28]),
			new Sprite("BlindHistorian", "Blind Hideout attendant", [0x29]),
			new Sprite("SweepingLady", "Sweeping Lady", [0x2A]),
			new Sprite("Multipurpose", "Multipurpose Sprite", [0x2B]),
			new Sprite("Lumberjacks", "Lumberjacks", [0x2C]),
			new Sprite("TelepathicStones", "Telepathic stones? (No idea what this actually is, likely unused)", [0x2D]),
			new Sprite("FluteBoyNotes", "Flute Boy's Notes", [0x2E]),
			new Sprite("RaceNPCs", "Race HP NPCs", [0x2F]),
			new Sprite("Person", "Person?", [0x30]),
			new Sprite("FortuneTeller", "Fortune Teller", [0x31]),
			new Sprite("AngryBrothers", "Angry Brothers", [0x32]),
			new Sprite("PullForRupees", "Pull For Rupees Sprite", [0x33]),
			new Sprite("ScaredGirl2", "Scared Girl 2", [0x34]),
			new Sprite("Innkeeper", "Innkeeper", [0x35]),
			new Sprite("Potion Shop", "Potion Shop", [0x36]),
			new Sprite("Waterfall", "Waterfall", [0x37]),
			new Sprite("ArrowTarget", "Arrow Target", [0x38]),
			new Sprite("AverageMan", "Average Middle-Aged Man", [0x39]),
			new Sprite("MagicBat", "Half Magic Bat", [0x3A]),
			new Sprite("DashItem", "Dash Item", [0x3B]),
			new Sprite("VillageKid", "Village Kid", [0x3C]),
			new Sprite("Sign", "Signs? Chicken lady also showed up / Scared ladies outside houses.", [0x3D]),
			new Sprite("RockHoarder", "Rock Hoarder", [0x3E]),
			new Sprite("TutorialSoldier", "Tutorial Soldier", [0x3F]),
			new Sprite("LightningLock", "Lightning Lock", [0x40]),
			new Sprite("BlueSwordSoldier", "Blue Sword Soldier / Used by guards to detect player", [0x41]),
			new Sprite("GreenSwordSoldier", "Green Sword Soldier", [0x42]),
			new Sprite("RedSpearSoldier", "Red Spear Soldier", [0x43]),
			new Sprite("AssaultSwordSoldier", "Assault Sword Soldier", [0x44]),
			new Sprite("GreenSpearSoldier", "Green Spear Soldier", [0x45]),
			new Sprite("BlueArcher", "Blue Archer", [0x46]),
			new Sprite("GreenArcher", "Green Archer", [0x47]),
			new Sprite("RedJavelinSolider", "Red Javelin Soldier", [0x48]),
			new Sprite("RedJavelinSolider2", "Red Javelin Soldier 2", [0x49]),
			new Sprite("RedBombSolider", "Red Bomb Soldiers", [0x4A]),
			new Sprite("GreenSoldierRecruit", "Green Soldier Recruits", [0x4B]),
			new Sprite("Geldman", "Geldman", [0x4C]),
			new Sprite("Rabbit", "Rabbit", [0x4D]),
			new Sprite("Popo", "Popo", [0x4E]),
			new Sprite("Popo2", "Popo 2", [0x4F]),
			new Sprite("CannonBall", "Cannon Balls", [0x50]),
			new Sprite("Armos", "Armos", [0x51]),
			new Sprite("KingZora", "Giant Zora", [0x52]),
			new Sprite("ArmosKnights", "Armos Knights (Boss)", [0x53]),
			new Sprite("Lanmolas", "Lanmolas (Boss)", [0x54]),
			new Sprite("FireballZora", "Fireball Zora", [0x55]),
			new Sprite("WalkingZora", "Walking Zora", [0x56]),
			new Sprite("DesertPalaceBarrier", "Desert Palace Barriers", [0x57]),
			new Sprite("Crab", "Crab", [0x58]),
			new Sprite("Bird", "Bird", [0x59]),
			new Sprite("Squirrel", "Squirrel", [0x5A]),
			new Sprite("SparkLR", "Spark (Left to Right)", [0x5B]),
			new Sprite("SparkRL", "Spark (Right to Left)", [0x5C]),
			new Sprite("RollerV1", "Roller (vertical moving)", [0x5D]),
			new Sprite("RollerV2", "Roller (vertical moving)", [0x5E]),
			new Sprite("Roller", "Roller", [0x5F]),
			new Sprite("RollerH", "Roller (horizontal moving)", [0x60]),
			new Sprite("Beamos", "Beamos", [0x61]),
			new Sprite("MasterSword", "Master Sword", [0x62]),
			new Sprite("Devalant", "Devalant (Non-shooter)", [0x63]),
			new Sprite("DevalantShooter", "Devalant (Shooter)", [0x64]),
			new Sprite("ShootingGalleryNPC", "Shooting Gallery Proprietor", [0x65]),
			new Sprite("CannonBallShooterR", "Moving Cannon Ball Shooters (Right)", [0x66]),
			new Sprite("CannonBallShooterL", "Moving Cannon Ball Shooters (Left)", [0x67]),
			new Sprite("CannonBallShooterD", "Moving Cannon Ball Shooters (Down)", [0x68]),
			new Sprite("CannonBallShooterU", "Moving Cannon Ball Shooters (Up)", [0x69]),
			new Sprite("BallNChainTrooper", "Ball N' Chain Trooper", [0x6A]),
			new Sprite("CannonSoldier", "Cannon Soldier", [0x6B]),
			new Sprite("MirrorPortal", "Mirror Portal", [0x6C]),
			new Sprite("Rat", "Rat", [0x6D]),
			new Sprite("Rope", "Rope", [0x6E]),
			new Sprite("Keese", "Keese", [0x6F]),
			new Sprite("HelmasaurFireball", "Helmasaur King Fireball", [0x70]),
			new Sprite("Leever", "Leever", [0x71]),
			new Sprite("PondActivation", "Activator for the ponds (where you throw in items)", [0x72]),
			new Sprite("Link's Uncle", "Uncle / Priest", [0x73]),
			new Sprite("RunningMan", "Running Man", [0x74]),
			new Sprite("BottleSalesman", "Bottle Salesman", [0x75]),
			new Sprite("Zelda", "Princess Zelda", [0x76]),
			new Sprite("Antifairy2", "Antifairy (Alternate)", [0x77]),
			new Sprite("VillageElder", "Village Elder", [0x78]),
			new Sprite("Bee", "Bee", [0x79]), // Bee hoard?
			new Sprite("Agahnim", "Agahnim", [0x7A]),
			new Sprite("AgahnimBall", "Agahnim Energy Ball", [0x7B]),
			new Sprite("Hyu", "Hyu", [0x7C]),
			new Sprite("BigSpikeTrap", "Big Spike Trap", [0x7D]),
			new Sprite("GuruguruBarCW", "Guruguru Bar (Clockwise)", [0x7E]),
			new Sprite("GuruguruBarCCW", "Guruguru Bar (Counter Clockwise)", [0x7F]),
			new Sprite("Winder", "Winder", [0x80]),
			new Sprite("WaterTektite", "Water Tektite", [0x81]),
			new Sprite("AntifairyCircle", "Antifairy Circle", [0x82]),
			new Sprite("EyegoreGreen", "Green Eyegore", [0x83]),
			new Sprite("EyegoreRed", "Red Eyegore", [0x84]),
			new Sprite("StalfosYellow", "Yellow Stalfos", [0x85]),
			new Sprite("Kodongos", "Kodongos", [0x86]),
			new Sprite("Flames", "Flames", [0x87]),
			new Sprite("Mothula", "Mothula (Boss)", [0x88]),
			new Sprite("MothulaBeam", "Mothula's Beam", [0x89]),
			new Sprite("SpikeTrap", "Spike Trap", [0x8A]),
			new Sprite("Gibdo", "Gibdo", [0x8B]),
			new Sprite("Arrghus", "Arrghus (Boss)", [0x8C]),
			new Sprite("ArrghusSpawn", "Arrghus spawn", [0x8D]),
			new Sprite("Terrorpin", "Terrorpin", [0x8E]),
			new Sprite("Slime", "Slime", [0x8F]),
			new Sprite("Wallmaster", "Wallmaster", [0x90]),
			new Sprite("StalfosKnight", "Stalfos Knight", [0x91]),
			new Sprite("Helmasaur", "Helmasaur King", [0x92]),
			new Sprite("Bumper", "Bumper", [0x93]),
			new Sprite("Swimmers", "Swimmers", [0x94]),
			new Sprite("EyeLaserR", "Eye Laser (Right)", [0x95]),
			new Sprite("EyeLaserL", "Eye Laser (Left)", [0x96]),
			new Sprite("EyeLaserD", "Eye Laser (Down)", [0x97]),
			new Sprite("EyeLaserU", "Eye Laser (Up)", [0x98]),
			new Sprite("Pengator", "Pengator", [0x99]),
			new Sprite("Kyameron", "Kyameron", [0x9A]),
			new Sprite("Wizzrobe", "Wizzrobe", [0x9B]),
			new Sprite("Tadpoles", "Tadpoles", [0x9C]),
			new Sprite("Tadpoles2", "Tadpoles", [0x9D]),
			new Sprite("Ostrich", "Ostrich (Haunted Grove)", [0x9E]),
			new Sprite("Flute", "Flute", [0x9F]),
			new Sprite("Bird", "Birds (Haunted Grove)", [0xA0]),
			new Sprite("Freezor", "Freezor", [0xA1]),
			new Sprite("Kholdstare", "Kholdstare (Boss)", [0xA2]),
			new Sprite("KholdstareShell", "Kholdstare's Shell", [0xA3]),
			new Sprite("FallingIce", "Falling Ice", [0xA4]),
			new Sprite("ZazakFireball", "Zazak Fireball", [0xA5]),
			new Sprite("ZazakRed", "Red Zazak", [0xA6]),
			new Sprite("Stalfos", "Stalfos", [0xA7]),
			new Sprite("Zirro", "Bomber Flying Creatures from Darkworld", [0xA8]),
			new Sprite("Zirro2", "Bomber Flying Creatures from Darkworld", [0xA9]),
			new Sprite("Pikit", "Pikit", [0xAA]),
			new Sprite("Maiden", "Maiden", [0xAB]),
			new Sprite("Apple", "Apple", [0xAC]),
			new Sprite("LostOldMan", "Lost Old Man", [0xAD]),
			new Sprite("PipeD", "Down Pipe", [0xAE]),
			new Sprite("PipeU", "Up Pipe", [0xAF]),
			new Sprite("PipeR", "Right Pipe", [0xB0]),
			new Sprite("PipeL", "Left Pipe", [0xB1]),
			new Sprite("BeeGood", "Good bee again?", [0xB2]), // released bee
			new Sprite("HylianInscription", "Hylian Inscription", [0xB3]),
			new Sprite("PurpleChest", "Thief's chest (not the one that follows you, the one that you grab from the DW smithy house)", [0xB4]),
			new Sprite("BombSalesman", "Bomb Salesman", [0xB5]),
			new Sprite("Kiki", "Kiki", [0xB6]),
			new Sprite("BlindMaiden", "Maiden following you in Blind Dungeon", [0xB7]),
			new Sprite("Monologue", "Monologue Testing Sprite", [0xB8]),
			new Sprite("FeudingFriends", "Feuding Friends on Death Mountain", [0xB9]),
			new Sprite("Whirlpool", "Whirlpool", [0xBA]),
			new Sprite("Salesman", "Salesman / chestgame guy / 300 rupee giver guy / Chest game thief", [0xBB]),
			new Sprite("Drunk", "Drunk in the inn", [0xBC]),
			new Sprite("Vitreous", "Vitreous (Large Eyeball)", [0xBD]),
			new Sprite("VitreousSmallEyeball", "Vitreous (Small Eyeball)", [0xBE]),
			new Sprite("VitreousLightning", "Vitreous' Lightning", [0xBF]),
			new Sprite("Catfish", "Monster in Lake of Ill Omen / Quake Medallion", [0xC0]),
			new Sprite("AgahnimTeleporting", "Agahnim teleporting Zelda to dark world", [0xC1]),
			new Sprite("Boulders", "Boulders", [0xC2]),
			new Sprite("Gibo", "Gibo", [0xC3]),
			new Sprite("Thief", "Thief", [0xC4]),
			new Sprite("Medusa", "Medusa", [0xC5]),
			new Sprite("YomoMedusa", "Yomo Medusa", [0xC6]),
			new Sprite("HokkuBokku", "Hokku-Bokku", [0xC7]),
			new Sprite("FairyBig", "Big Fairy who heals you", [0xC8]),
			new Sprite("Tektite", "Tektite", [0xC9]),
			new Sprite("ChainChomp", "Chain Chomp", [0xCA]),
			new Sprite("Trinexx", "Trinexx", [0xCB]),
			new Sprite("TrinexxHeadFire", "Another part of trinexx", [0xCC]), // might be wrong
			new Sprite("TrinexxHeadIce", "Yet another part of trinexx", [0xCD]), // might be wrong
			new Sprite("Blind", "Blind The Thief (Boss)", [0xCE]),
			new Sprite("Swamola", "Swamola", [0xCF]),
			new Sprite("Lynel", "Lynel", [0xD0]),
			new Sprite("BunnyBeam", "Bunny Beam", [0xD1]),
			new Sprite("FloppingFish", "Flopping Fish", [0xD2]),
			new Sprite("Stal", "Stal", [0xD3]),
			new Sprite("Landmine", "Landmine", [0xD4]),
			new Sprite("DiggingGameNPC", "Digging Game Proprietor", [0xD5]),
			new Sprite("Ganon", "Ganon", [0xD6]),
			new Sprite("GanonInvisible", "Copy of Ganon, except invincible?", [0xD7]),
			new Sprite("Heart", "Heart", [0xD8]),
			new Sprite("RupeeGreen", "Green Rupee", [0xD9]),
			new Sprite("RupeeBlue", "Blue Rupee", [0xDA]),
			new Sprite("RupeeRed", "Red Rupee", [0xDB]),
			new Sprite("BombRefill1", "Bomb Refill (1)", [0xDC]),
			new Sprite("BombRefill4", "Bomb Refill (4)", [0xDD]),
			new Sprite("BombRefill8", "Bomb Refill (8)", [0xDE]),
			new Sprite("MagicRefillSmall", "Small Magic Refill", [0xDF]),
			new Sprite("MagicRefillFull", "Full Magic Refill", [0xE0]),
			new Sprite("ArrowRefill5", "Arrow Refill (5)", [0xE1]),
			new Sprite("ArrowRefill10", "Arrow Refill (10)", [0xE2]),
			new Sprite("Fairy", "Fairy", [0xE3]),
			new Sprite("Key", "Key", [0xE4]),
			new Sprite("BigKey", "Big Key", [0xE5]),
			new Sprite("Shield", "Shield", [0xE6]),
			new Sprite("Mushroom", "Mushroom", [0xE7]),
			new Sprite("FakeMasterSword", "Fake Master Sword", [0xE8]),
			new Sprite("MagicShopDude", "Magic Shop dude / His items, including the magic powder", [0xE9]),
			new Sprite("HeartContainer", "Heart Container", [0xEA]),
			new Sprite("HeartPiece", "Heart Piece", [0xEB]),
			new Sprite("Bush", "Bushes", [0xEC]),
			new Sprite("SomariaPlatform", "Cane Of Somaria Platform", [0xED]),
			new Sprite("Mantle", "Mantle", [0xEE]),
			new Sprite("SomariaPlatform1", "Cane of Somaria Platform (Unused)", [0xEF]),
			new Sprite("SomariaPlatform2", "Cane of Somaria Platform (Unused)", [0xF0]),
			new Sprite("SomariaPlatform3", "Cane of Somaria Platform (Unused)", [0xF1]),
			new Sprite("MedallionTablet", "Medallion Tablet", [0xF2]),
		]);
		return static::all();
	}

	/**
	 * Create a new Sprite
	 *
	 * @param string $name Unique name of item
	 * @param string $nice_name Well formatted name for item
	 * @param array $bytes data to write to Location addresses
	 * @param array|null $address Addresses in ROM to write back Location data if set
	 *
	 * @return void
	 */
	public function __construct($name, $nice_name, array $bytes, array $address = null) {
		$this->name = $name;
		$this->nice_name = $nice_name;
		$this->bytes = $bytes;
		$this->address = (array) $address;
	}

	/**
	 * Get the name of this Sprite
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Get the nice name of this Sprite
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
	 * converts 4bpp 8x8 to palette reference at a given offset
	 *
	 * @author Zarby89
	 *
	 * @param array $sprite byte array of gfx data
	 * @param int $pos position in stream to pull 8x8 from
	 *
	 * @return array
	 */
	static public function load8x8(array $sprite, int $pos = 0) {
		//pos = 32 bytes to read per 8x8 tiles, will return an array of 64bytes
		$positions = [0x80, 0x40, 0x20, 0x10, 0x08, 0x04, 0x02, 0x01];
		$temp_array = [];
		for ($x = 0; $x < 8; $x++) {
			for ($y = 0; $y < 8; $y++) {
				$tmpbyte = 0;
				//There's 4 bit per pixel, 2 at the start, 2 at the middle, for every pixels
				//so we read all of them in order up to 32 byte
				if (($sprite[$pos + ($x * 2)] & $positions[$y]) == $positions[$y]) { $tmpbyte += 1; }
				if (($sprite[$pos + ($x * 2) + 1] & $positions[$y]) == $positions[$y]) { $tmpbyte += 2; }
				if (($sprite[$pos + 16 + ($x * 2)] & $positions[$y]) == $positions[$y]) { $tmpbyte += 4; }
				if (($sprite[$pos + 16 + ($x * 2) + 1] & $positions[$y]) == $positions[$y]) { $tmpbyte += 8; }
				$temp_array[$y + ($x * 8)] = $tmpbyte;
			}
		}

		return $temp_array;
	}

	/**
	 * converts 4bpp 16x16 to palette reference at a given offset
	 *
	 * @author Zarby89
	 *
	 * @param array $sprite byte array of gfx data
	 * @param int $pos position in stream to pull 8x8 from
	 *
	 * @return array
	 */
	static public function load16x16(array $sprite, int $pos = 0) {
		//pos 0x40 = head facing down, pos 0x4C0 = body facing down
		$temp_array = array_fill(0, 16, []);
		$top_left = static::load8x8($sprite, $pos );
		$top_right = static::load8x8($sprite, $pos + 0x20);
		$bottom_left = static::load8x8($sprite, $pos + 0x200);
		$bottom_right = static::load8x8($sprite, $pos + 0x200 + 0x20);

		//copy all the bytes at the correct position in the 2d array
		for($x = 0; $x < 8; $x++) {
			for ($y = 0; $y < 8; $y++) {
				$temp_array[$x][$y] = $top_left[$x + ($y * 8)];
				$temp_array[$x + 8][$y] = $top_right[$x + ($y * 8)];
				$temp_array[$x][$y + 8] = $bottom_left[$x + ($y * 8)];
				$temp_array[$x + 8][$y + 8] = $bottom_right[$x + ($y * 8)];
			}
		}
		return $temp_array;
	}

	public function dumpBinBlock(Rom $rom) {
		return [
			'0x6B080' => sprintf("%08b", $rom->read(0x6B080 + $this->bytes[0], 1)),
			'0x6B173' => sprintf("%08b", $rom->read(0x6B173 + $this->bytes[0], 1)),
			'0x6B266' => sprintf("%08b", $rom->read(0x6B266 + $this->bytes[0], 1)),
			'0x6B359' => sprintf("%08b", $rom->read(0x6B359 + $this->bytes[0], 1)),
			'0x6B44C' => sprintf("%08b", $rom->read(0x6B44C + $this->bytes[0], 1)),
			'0x6B53F' => sprintf("%08b", $rom->read(0x6B53F + $this->bytes[0], 1)),
			'0x6B632' => sprintf("%08b", $rom->read(0x6B632 + $this->bytes[0], 1)),
			'0x6B725' => sprintf("%08b", $rom->read(0x6B725 + $this->bytes[0], 1)),
		];
	}

	public function readPropertiesFromRom(Rom $rom) {
		$bytes = [
			$rom->read(0x6B080 + $this->bytes[0], 1),
			$rom->read(0x6B173 + $this->bytes[0], 1),
			$rom->read(0x6B266 + $this->bytes[0], 1),
			$rom->read(0x6B359 + $this->bytes[0], 1),
			$rom->read(0x6B44C + $this->bytes[0], 1),
			$rom->read(0x6B53F + $this->bytes[0], 1),
			$rom->read(0x6B632 + $this->bytes[0], 1),
			$rom->read(0x6B725 + $this->bytes[0], 1),
		];

		// these need to be bit shifted with mask, otherwise the "flag" might appear wrong
		return [
			'harmless' => $bytes[0] >> 7 & 1,
			'mastersword_ceremony' => $bytes[0] >> 6 & 1,
			'towards_walls' => $bytes[0] >> 5 & 1,
			'visibility' => $bytes[0] & 0x1F,
			'hit_points' => $bytes[1],
			'damage_type' => $bytes[2] & 0x0F,
			'unknown' => $bytes[2] >> 4,
			'death_animation_extra' => $bytes[3] >> 7 & 1,
			'invincible' => $bytes[3] >> 6 & 1,
			'width' => $bytes[3] >> 5 & 1,
			'shadow' => $bytes[3] >> 4 & 1,
			'palette' => $bytes[3] >> 1 & 0x07,
			'unknown2' => $bytes[3] & 1,
			'ignore_collision' => $bytes[4] >> 7 & 1,
			'statis' => $bytes[4] >> 6 & 1,
			'persist' => $bytes[4] >> 5 & 1,
			'hitbox' => $bytes[4] & 0x1F,
			'hitbox_interaction' => $bytes[5] >> 4,
			'deflect_arrows' => $bytes[5] >> 3 & 1,
			'unknown4' => $bytes[5] >> 2 & 1,
			'death_boss' => $bytes[5] >> 1 & 1,
			'falls_in_holes' => $bytes[5] & 1,
			'disable_interactions' => $bytes[6] >> 7 & 1,
			'water' => $bytes[6] >> 6 & 1,
			'shield_destruction' => $bytes[6] >> 5 & 1,
			'damage_sound' => $bytes[6] >> 4 & 1,
			'prize_pack' => $bytes[6] & 0x0F,
			'death_conditional' => $bytes[7] >> 7 & 1,
			'death_conditional2' => $bytes[7] >> 6 & 1,
			'unused2' => $bytes[7] >> 5 & 1,
			'deflect_missles' => $bytes[7] >> 4 & 1,
			'collide_less' => $bytes[7] >> 3 & 1,
			'impervious_sword_hammer' => $bytes[7] >> 2 & 1,
			'impervious_arrows' => $bytes[7] >> 1 & 1,
			'disabled' => $bytes[7] & 1,
		];
	}

	/**
	 * serialized version of Sprite
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->name . serialize($this->bytes);
	}
}
