<?php namespace ALttP;

use ALttP\Support\Dialog;
use ALttP\Support\ItemCollection;
use Log;

/**
 * Wrapper for ROM file
 */
class Rom {
	const BUILD = '2017-06-17';
	const HASH = '2da16776168dada7f307cf044675eca7';
	const SIZE = 2097152;
	static private $digit_gfx = [
		0 => 0x30,
		1 => 0x31,
		2 => 0x02,
		3 => 0x03,
		4 => 0x12,
		5 => 0x13,
		6 => 0x22,
		7 => 0x23,
		8 => 0x32,
		9 => 0x33,
	];

	private $tmp_file;
	protected $rom;
	protected $write_log = [];

	/**
	 * Save a ROM build the DB for later retervial if someone is patching for an old seed.
	 *
	 * @param array $patch for the build
	 *
	 * @return Build
	 */
	public static function saveBuild(array $patch) : Build {
		$build = Build::firstOrCreate([
			'build' => static::BUILD,
			'hash' => static::HASH,
		]);
		$build->patch = json_encode($patch);
		$build->save();

		return $build;
	}

	/**
	 * Create a new wrapper
	 *
	 * @param string $source_location location of source ROM to edit
	 *
	 * @return void
	 */
	public function __construct(string $source_location = null) {
		if ($source_location !== null && !is_readable($source_location)) {
			throw new \Exception('Source ROM not readable');
		}
		$this->tmp_file = tempnam(sys_get_temp_dir(), __CLASS__);

		if ($source_location !== null) {
			copy($source_location, $this->tmp_file);
		}

		$this->rom = fopen($this->tmp_file, "r+");
	}

 	/**
	 * resize ROM to a given size
	 *
	 * @param int|null $size number of bytes the ROM should be
	 *
	 * @return $this
	 *
	 */
	public function resize(int $size = null) : self {
		ftruncate($this->rom, $size ?? static::SIZE);

		return $this;
	}

	/**
	 * Check to see if this ROM matches base randomizer ROM.
	 *
	 * @return bool
	 */
	public function checkMD5() : bool {
		return $this->getMD5() === static::HASH;
	}

	/**
	 * Get MD5 of current file.
	 *
	 * @return string
	 */
	public function getMD5() : string {
		return hash_file('md5', $this->tmp_file);
	}

	/**
	 * Set the Low Health Beep Speed
	 *
	 * @param string $setting name (0x00: off, 0x20: normal, 0x40: half, 0x80: quarter)
	 *
	 * @return $this
	 */
	public function setHeartBeepSpeed(string $setting) : self {
		switch ($setting) {
			case 'off':
				$byte = 0x00;
				break;
			case 'half':
				$byte = 0x40;
				break;
			case 'quarter':
				$byte = 0x80;
				break;
			case 'normal':
			default:
				$byte = 0x20;
		}

		$this->write(0x180033, pack('C', $byte));

		return $this;
	}

	/**
	 * Set the Rupoor value to take rupees
	 *
	 * @param int $value
	 *
	 * @return $this
	 */
	public function setRupoorValue($value = 10) : self {
		$this->write(0x180036, pack('v*', $value));

		return $this;
	}

	/**
	 * Set Cane of Byrna Cave spike floor damage
	 *
	 * @param int $dmg_value (0x08: 1 Heart, 0x02: 1/4 Heart)
	 *
	 * @return $this
	 */
	public function setByrnaCaveSpikeDamage($dmg_value = 0x08) {
		$this->write(0x180168, pack('C*', $dmg_value));

		return $this;
	}

	/**
	 * Set mode for HUD clock
	 *
	 * @param string $mode off|stopwatch|countdown-stop|countdown-continue
	 * @param bool $restart wether to restart the timer
	 *
	 * @return $this;
	 */
	public function setClockMode($mode = 'off', $restart = false) {
		switch ($mode) {
			case 'stopwatch':
				$bytes = [0x02, 0x01];
				break;
			case 'countdown-ohko':
				$bytes = [0x01, 0x02];
				$restart = true;
				break;
			case 'countdown-continue':
				$bytes = [0x01, 0x01];
				break;
			case 'countdown-stop':
				$bytes = [0x01, 0x00];
				break;
			case 'off':
			default:
				$bytes = [0x00, 0x00];
				break;
		}

		$bytes = array_merge($bytes, [$restart ? 0x01 : 0x00]);

		$this->write(0x180190, pack('C*', ...$bytes));

		return $this;
	}

	/**
	 * Set starting time for HUD clock
	 *
	 * @param int $seconds time in seconds
	 *
	 * @return $this;
	 */
	public function setStartingTime($seconds = 0) {
		$this->write(0x18020C, pack('l*', $seconds * 60));

		return $this;
	}

	/**
	 * Set time adjustment for collecting Red Clock Item
	 *
	 * @param int $seconds time in seconds
	 *
	 * @return $this;
	 */
	public function setRedClock($seconds = 0) {
		$this->write(0x180200, pack('l*', $seconds * 60));

		return $this;
	}

	/**
	 * Set time adjustment for collecting Blue Clock Item
	 *
	 * @param int $seconds time in seconds
	 *
	 * @return $this;
	 */
	public function setBlueClock($seconds = 0) {
		$this->write(0x180204, pack('l*', $seconds * 60));

		return $this;
	}

	/**
	 * Set time adjustment for collecting Green Clock Item
	 *
	 * @param int $seconds time in seconds
	 *
	 * @return $this;
	 */
	public function setGreenClock($seconds = 0) {
		$this->write(0x180208, pack('l*', $seconds * 60));

		return $this;
	}

	/**
	 * Set the starting Max Arrows
	 *
	 * @param int $max
	 *
	 * @return $this
	 */
	public function setMaxArrows($max = 30) : self {
		$this->write(0x180035, pack('C', $max));

		return $this;
	}

	/**
	 * Set the Digging Game Rng
	 *
	 * @param int $digs
	 *
	 * @return $this
	 */
	public function setDiggingGameRng($digs = 15) : self {
		$this->write(0x180020, pack('C', $digs));
		$this->write(0xEFD95, pack('C', $digs));

		return $this;
	}

	/**
	 * Set the starting Max Bombs
	 *
	 * @param int $max
	 *
	 * @return $this
	 */
	public function setMaxBombs($max = 10) : self {
		$this->write(0x180034, pack('C', $max));

		return $this;
	}

	/**
	 * Set values to fill for Capacity Upgrades
	 * currently only 4 things: Bomb5, Bomb10, Arrow5, Arrow10
	 *
	 * @param array $fills array of values to fill in
	 *
	 * @return $this
	 */
	public function setCapacityUpgradeFills(array $fills) : self {
		$this->write(0x180080, pack('C*', ...array_slice($fills, 0, 4)));

		return $this;
	}

	/**
	 * Set values to fill for Health/Magic fills from Bottles
	 * currently only 2 things: Health, Magic
	 *
	 * @param array $fills array of values to fill in [health (0xA0 default), magic (0x80 default)]
	 *
	 * @return $this
	 */
	public function setBottleFills(array $fills) : self {
		$this->write(0x180084, pack('C*', ...array_slice($fills, 0, 2)));

		return $this;
	}

	/**
	 * Set the number of goal items to collect
	 *
	 * @param int $goal
	 *
	 * @return $this
	 */
	public function setGoalRequiredCount($goal = 0) : self {
		$this->write(0x180167, pack('C', $goal));

		return $this;
	}

	/**
	 * Set the goal item icon
	 *
	 * @param string $goal_icon
	 *
	 * @return $this
	 */
	public function setGoalIcon($goal_icon = 'star') : self {
		switch ($goal_icon) {
			case 'triforce':
				$byte = pack('S*', 0x280E);
				break;
			case 'star':
			default:
				$byte = pack('S*', 0x280D);
				break;
		}
		$this->write(0x180165, $byte);

		return $this;
	}

	/**
	 * Set Ganon to Invincible. 'dungeons' will require all dungeon bosses are dead to be able to damage Ganon.
	 *
	 * @param string $setting
	 *
	 * @return $this
	 */
	public function setGanonInvincible($setting = 'no') : self {
		switch ($setting) {
			case 'dungeons':
				$byte = pack('C*', 0x02);
				break;
			case 'yes':
				$byte = pack('C*', 0x01);
				break;
			case 'no':
			default:
				$byte = pack('C*', 0x00);
				break;
		}
		$this->write(0x18003E, $byte);

		return $this;
	}


	/**
	 * Set the opening Uncle text to a custom value
	 *
	 * @param string $string Uncle text can be 3 lines of 14 characters each
	 *
	 * @return $this
	 */
	public function setUncleTextString(string $string) : self {
		$offset = 0x180500;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the opening Ganon 1 text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setGanon1TextString(string $string) : self {
		$offset = 0x180600;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the opening Ganon 2 text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setGanon2TextString(string $string) : self {
		$offset = 0x180700;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Triforce text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setTriforceTextString(string $string) : self {
		$offset = 0x180400;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Blind text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setBlindTextString(string $string) : self {
		$offset = 0x180800;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Tavern Man text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setTavernManTextString(string $string) : self {
		$offset = 0x180C00;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set Sahasrahla before item collection text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setSahasrahla1TextString(string $string) : self {
		$offset = 0x180A00;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set Sahasrahla after item collection text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setSahasrahla2TextString(string $string) : self {
		$offset = 0x180B00;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set Bomb Shop before crystals 5 & 6 text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setBombShop1TextString(string $string) : self {
		$offset = 0x180E00;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set Bomb Shop after crystals 5 & 6 text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setBombShop2TextString(string $string) : self {
		$offset = 0x180D00;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Pyramid Fairy text to a custom value
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setPyramidFairyTextString(string $string) : self {
		$offset = 0x180900;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Altar text to a custom value
	 *
	 * @param string $string Altar text can be 3 lines of 14 characters each
	 *
	 * @return $this
	 */
	public function setPedestalTextbox(string $string) : self {
		$offset = 0x180300;

		$converter = new Dialog;
		foreach ($converter->convertDialog($string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the King's Return credits to a custom value
	 * Original: the return of the king
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setKingsReturnCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 22), 22, ' ', STR_PAD_BOTH);
		$offset = 0x76928;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Sanctuary credits to a custom value
	 * Original: the loyal priest
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setSanctuaryCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 16), 16, ' ', STR_PAD_BOTH);
		$offset = 0x76964;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Kakariko Town credits to a custom value
	 * Original: sahasralah's homecoming
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setKakarikoTownCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 23), 23, ' ', STR_PAD_BOTH);
		$offset = 0x76997;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Desert Palace credits to a custom value
	 * Original: vultures rule the desert
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setDesertPalaceCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 24), 24, ' ', STR_PAD_BOTH);
		$offset = 0x769D4;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Mountain Tower credits to a custom value
	 * Original: the bully makes a friend
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setMountainTowerCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 24), 24, ' ', STR_PAD_BOTH);
		$offset = 0x76A12;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Links House credits to a custom value
	 * Original: your uncle recovers
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setLinksHouseCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 19), 19, ' ', STR_PAD_BOTH);
		$offset = 0x76A52;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Zora credits text to a custom value
	 * Original: finger webs for sale
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setZoraCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 20), 20, ' ', STR_PAD_BOTH);
		$offset = 0x76A85;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Magic Shop credits text to a custom value
	 * Original: the witch and assistant
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setMagicShopCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 23), 23, ' ', STR_PAD_BOTH);
		$offset = 0x76AC5;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Woodsmans Hut credits text to a custom value
	 * Original: twin lumberjacks
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setWoodsmansHutCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 16), 16, ' ', STR_PAD_BOTH);
		$offset = 0x76AFC;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Flute Boy credits to a custom value
	 * Original: ocarina boy plays again
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setFluteBoyCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 23), 23, ' ', STR_PAD_BOTH);
		$offset = 0x76B34;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Wishing Well credits to a custom value
	 * Original: venus. queen of faeries
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setWishingWellCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 23), 23, ' ', STR_PAD_BOTH);
		$offset = 0x76B71;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Swordsmiths credits to a custom value
	 * Original: the dwarven swordsmiths
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setSwordsmithsCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 23), 23, ' ', STR_PAD_BOTH);
		$offset = 0x76BAC;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Bug-Catching Kid credits to a custom value
	 * Original: the bug-catching kid
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setBugCatchingKidCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 20), 20, ' ', STR_PAD_BOTH);
		$offset = 0x76BDF;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Death Mountain credits to a custom value
	 * Original: the lost old man
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setDeathMountainCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 16), 16, ' ', STR_PAD_BOTH);
		$offset = 0x76C19;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Lost Woods credits to a custom value
	 * Original: the forest thief
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setLostWoodsCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 16), 16, ' ', STR_PAD_BOTH);
		$offset = 0x76C51;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Set the Altar credits to a custom value
	 * Original: and the master sword
	 *
	 * @param string $string
	 *
	 * @return $this
	 */
	public function setAltarCredits(string $string) : self {
		$write_string = str_pad(substr($string, 0, 20), 20, ' ', STR_PAD_BOTH);
		$offset = 0x76C81;
		foreach ($this->convertCredits($write_string) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}

		return $this;
	}

	/**
	 * Enable/Disable the predefined ROM debug mode: Starts after Zelda is saved with all items. No chests are open.
	 *
	 * @return $this
	 */
	public function setDebugMode($enable = true) : self {
		$this->write(0x65B88, pack('S*', $enable ? 0xEAEA : 0x21F0));
		$this->write(0x65B91, pack('S*', $enable ? 0xEAEA : 0x18D0));

		return $this;
	}

	/**
	 * Enable/Disable the SRAM Trace function
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSRAMTrace($enable = true) : self {
		$this->write(0x180030, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Set the single RNG Item table. These items will only get collected by player once per game.
	 *
	 * @param ItemCollection $items
	 *
	 * @return $this
	 */
	public function setSingleRNGTable(ItemCollection $items) : self {
		$bytes = $items->map(function($item) {
			return $item->getBytes()[0];
		});

		$this->write(0x182000, pack('C*', ...$bytes));
		$this->write(0x18207F, pack('C*', count($bytes)));

		return $this;
	}

	/**
	 * Set the multi RNG Item table. These items can be collected multiple times per game.
	 *
	 * @param ItemCollection $items
	 *
	 * @return $this
	 */
	public function setMultiRNGTable(ItemCollection $items) : self {
		$bytes = $items->map(function($item) {
			return $item->getBytes()[0];
		});

		$this->write(0x182080, pack('C*', ...$bytes));
		$this->write(0x1820FF, pack('C*', count($bytes)));

		return $this;
	}

	/**
	 * Set the Seed Type
	 *
	 * @param string $setting name
	 *
	 * @return $this
	 */
	public function setRandomizerSeedType(string $setting) : self {
		switch ($setting) {
			case 'SpeedRunner':
				$byte = 0x02;
				break;
			case 'Glitched':
				$byte = 0x01;
				break;
			case 'off':
				$byte = 0xFF;
				break;
			case 'NoMajorGlitches':
			default:
				$byte = 0x00;
		}

		$this->write(0x180210, pack('C', $byte));

		return $this;
	}

	/**
	 * Set the Game Type
	 *
	 * @param string $setting name
	 *
	 * @return $this
	 */
	public function setGameType(string $setting) : self {
		switch ($setting) {
			case 'Plandomizer':
				$byte = 0x01;
				break;
			case 'other':
				$byte = 0xFF;
				break;
			case 'Randomizer':
			default:
				$byte = 0x00;
		}

		$this->write(0x180211, pack('C', $byte));

		return $this;
	}

	/**
	 * Set the Plandomizer Author
	 *
	 * @param string $name name of author
	 *
	 * @return $this
	 */
	public function setPlandomizerAuthor(string $name) : self {
		$this->write(0x180220, substr($name, 0, 31));

		return $this;
	}

	/**
	 * Set the Tournament Type
	 *
	 * @param string $setting name
	 *
	 * @return $this
	 */
	public function setTournamentType(string $setting) : self {
		switch ($setting) {
			case 'standard':
				$bytes = [0x01, 0x00];
				break;
			case 'none':
			default:
				$bytes = [0x00, 0x01];
		}

		$this->write(0x180213, pack('C*', ...$bytes));

		return $this;
	}

	/**
	 * Removes Shield from Uncle by moving the tiles for shield to his head and replaces them with his head.
	 *
	 * @return $this
	 */
	public function removeUnclesShield() : self {
		$this->write(0x6D253, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D25B, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D283, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D28B, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x00, 0x0E));
		$this->write(0x6D2CB, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x02, 0x0E));
		$this->write(0x6D2FB, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x02, 0x0E));
		$this->write(0x6D313, pack('C*', 0x00, 0x00, 0xe4, 0xff, 0x08, 0x0E));

		return $this;
	}

	/**
	 * Removes Sword from Uncle by moving the tiles for sword to his head and replaces them with his head.
	 *
	 * @return $this
	 */
	public function removeUnclesSword() : self {
		$this->write(0x6D263, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D26B, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D293, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D29B, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x00, 0x0E));
		$this->write(0x6D2B3, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x02, 0x0E));
		$this->write(0x6D2BB, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x02, 0x0E));
		$this->write(0x6D2E3, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x02, 0x0E));
		$this->write(0x6D2EB, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x02, 0x0E));
		$this->write(0x6D31B, pack('C*', 0x00, 0x00, 0xe4, 0xff, 0x08, 0x0E));
		$this->write(0x6D323, pack('C*', 0x00, 0x00, 0xe4, 0xff, 0x08, 0x0E));

		return $this;
	}

	/**
	 * Set the sprite that spawns when a stunned Enemy is killed
	 *
	 * @param int $sprite id of sprite to drop (0xD9 green rupee)
	 *
	 * @return $this
	 */
	public function setStunnedSpritePrize(int $sprite = 0xD9) : self {
		$this->write(0x37993, pack('C*', $sprite));

		return $this;
	}

	/**
	 * Set the sprite that spawns when powdered sprite that usually spawns a faerie is powdered.
	 *
	 * @param int $sprite id of sprite to drop
	 *
	 * @return $this
	 */
	public function setPowderedSpriteFairyPrize(int $sprite = 0xE3) : self {
		$this->write(0x36DD0, pack('C*', $sprite));

		return $this;
	}

	/**
	 * Set pull tree prizes
	 *
	 * @param int $low id of sprite to drop (0xD9 green rupee)
	 * @param int $mid id of sprite to drop (0xDA blue rupee)
	 * @param int $high id of sprite to drop (0xDB red rupee)
	 *
	 * @return $this
	 */
	public function setPullTreePrizes(int $low = 0xD9, int $mid = 0xDA, int $high = 0xDB) : self {
		$this->write(0xEFBD4, pack('C*', $low, $mid, $high));

		return $this;
	}


	/**
	 * Set rupee crab, first and final prizes
	 *
	 * @param int $main id of sprite to drop (0xD9 green rupee)
	 * @param int $final id of sprite to drop (0xDB red rupee)
	 *
	 * @return $this
	 */
	public function setRupeeCrabPrizes(int $main = 0xD9, int $final = 0xDB) : self {
		$this->write(0x329C8, pack('C*', $main));
		$this->write(0x329C4, pack('C*', $final));

		return $this;
	}

	/**
	 * Set fish save prize
	 *
	 * @param int $prize id of sprite to drop (0xDB red rupee)
	 *
	 * @return $this
	 */
	public function setFishSavePrize(int $prize = 0xDB) : self {
		$this->write(0xE82CC, pack('C*', $prize));

		return $this;
	}

	/**
	 * Set Overworld bonk prizes
	 *
	 * @param array $prizes ids of sprites to drop (0x03 empty)
	 *
	 * @return $this
	 */
	public function setOverworldBonkPrizes(array $prize = []) : self {
		$addresses = [
			0x4CF6C, 0x4CFBA, 0x4CFE0, 0x4CFFB, 0x4D018, 0x4D01B, 0x4D028, 0x4D03C,
			0x4D059, 0x4D07A, 0x4D09E, 0x4D0A8, 0x4D0AB, 0x4D0AE, 0x4D0BE, 0x4D0DD,
			0x4D16A, 0x4D1E5, 0x4D1EE, 0x4D20B, 0x4CBBF, 0x4CBBF, 0x4CC17, 0x4CC1A,
			0x4CC4A, 0x4CC4D, 0x4CC53, 0x4CC69, 0x4CC6F, 0x4CC7C, 0x4CCEF, 0x4CD51,
			0x4CDC0, 0x4CDC3, 0x4CDC6, 0x4CE37, 0x4D2DE, 0x4D32F, 0x4D355, 0x4D367,
			0x4D384, 0x4D387, 0x4D397, 0x4D39E, 0x4D3AB, 0x4D3AE, 0x4D3D1, 0x4D3D7,
			0x4D3F8, 0x4D416, 0x4D420, 0x4D423, 0x4D42D, 0x4D449, 0x4D48C, 0x4D4D9,
			0x4D4DC, 0x4D4E3, 0x4D504, 0x4D507, 0x4D55E, 0x4D56A,
		];

		foreach ($addresses as $address) {
			$item = array_pop($prize);
			$this->write($address, pack('C*', $item ?? 0x03));
		}

		return $this;
	}

	/**
	 * Adjust some settings for hard mode
	 *
	 * @param int $level how hard to make it, higher should be harder
	 *
	 * @return $this
	 */
	public function setHardMode($level = 0) : self {
		switch ($level) {
			case 0:
				// Cape magic
				$this->write(0x3ADA7, pack('C*', 0x04, 0x08, 0x10));
				$this->setPowderedSpriteFairyPrize(0xE3);
				$this->setBottleFills([0xA0, 0x80]);
				$this->setShopBlueShieldCost(50);
				$this->setShopRedShieldCost(500);

				$this->setRupoorValue(0);
				$this->setBelowGanonChest(false);
				$this->setByrnaCaveSpikeDamage(0x08);

				break;
			case 1:
				$this->write(0x3ADA7, pack('C*', 0x02, 0x02, 0x02));
				$this->setPowderedSpriteFairyPrize(0xD8); // 1 heart
				$this->setBottleFills([0x28, 0x40]); // 5 hearts, 1/2 magic refills
				$this->setShopBlueShieldCost(100);
				$this->setShopRedShieldCost(999);

				$this->setRupoorValue(10);
				$this->setBelowGanonChest(true);
				$this->write(0xE9A7, pack('C*', 0x58)); // silver arrow upgrade
				$this->setByrnaCaveSpikeDamage(0x02);

				break;
			case 2:
				$this->write(0x3ADA7, pack('C*', 0x01, 0x01, 0x01));
				$this->setPowderedSpriteFairyPrize(0x79); // Bees
				$this->setBottleFills([0x08, 0x20]); // 1 heart, 1/4 magic refills
				$this->setShopBlueShieldCost(9990);
				$this->setShopRedShieldCost(9990);

				$this->setRupoorValue(20);
				$this->setBelowGanonChest(false);
				$this->setByrnaCaveSpikeDamage(0x02);

				break;
		}

		return $this;
	}

	/**
	 * Set the cost of Blue Shields in shops (shop sprite: 0x08).
	 *
	 * @param int $cost
	 *
	 * @return $this
	 */
	public function setShopBlueShieldCost($cost = 50) : self {
		$cost_digits = str_split($cost);
		if ($cost > 999) {
			$this->write(0xF73D2, pack('C*', 0xFC, 0xFF)); // reposition gfx
			$this->write(0xF73DA, pack('C*', 0x04, 0x00)); // reposition gfx
			$this->write(0xF73E2, pack('C*', 0x0C, 0x00)); // reposition gfx
			$this->write(0xF73D6, pack('C*', 0x3C)); // -
			$this->write(0xF73DE, pack('C*', 0x3C)); // -
			$this->write(0xF73E6, pack('C*', 0x3C)); // -
		} else if ($cost > 99) {
			$this->write(0xF73D2, pack('C*', 0xFC, 0xFF)); // reposition gfx
			$this->write(0xF73DA, pack('C*', 0x04, 0x00)); // reposition gfx
			$this->write(0xF73E2, pack('C*', 0x0C, 0x00)); // reposition gfx
			$this->write(0xF73D6, pack('C*', static::$digit_gfx[$cost_digits[0]]));
			$this->write(0xF73DE, pack('C*', static::$digit_gfx[$cost_digits[1]]));
			$this->write(0xF73E6, pack('C*', static::$digit_gfx[$cost_digits[2]]));
		} else {
			$this->write(0xF73D2, pack('C*', 0x00, 0x00)); // reposition gfx
			$this->write(0xF73DA, pack('C*', 0x00, 0x00)); // reposition gfx
			$this->write(0xF73E2, pack('C*', 0x08, 0x00)); // reposition gfx
			$this->write(0xF73D6, pack('C*', static::$digit_gfx[$cost_digits[0]]));
			$this->write(0xF73DE, pack('C*', static::$digit_gfx[$cost_digits[0]]));
			$this->write(0xF73E6, pack('C*', static::$digit_gfx[$cost_digits[1]]));
		}

		$this->write(0xF7201, pack('C*', $cost >> 8));
		$this->write(0xF71FF, pack('C*', $cost & 0xFF));

		return $this;
	}

	/**
	 * Set the cost of Red Shields in shops (shop sprite: ??).
	 *
	 * @param int $cost
	 *
	 * @return $this
	 */
	public function setShopRedShieldCost($cost = 500) : self {
		$cost_digits = str_split($cost);
		if ($cost > 999) {
			$this->write(0xF73FA, pack('C*', 0xFC, 0xFF)); // reposition gfx
			$this->write(0xF7402, pack('C*', 0x04, 0x00)); // reposition gfx
			$this->write(0xF740A, pack('C*', 0x0C, 0x00)); // reposition gfx
			$this->write(0xF73FE, pack('C*', 0x3C)); // -
			$this->write(0xF7406, pack('C*', 0x3C)); // -
			$this->write(0xF740E, pack('C*', 0x3C)); // -
		} else if ($cost > 99) {
			$this->write(0xF73FA, pack('C*', 0xFC, 0xFF)); // reposition gfx
			$this->write(0xF7402, pack('C*', 0x04, 0x00)); // reposition gfx
			$this->write(0xF740A, pack('C*', 0x0C, 0x00)); // reposition gfx
			$this->write(0xF73FE, pack('C*', static::$digit_gfx[$cost_digits[0]]));
			$this->write(0xF7406, pack('C*', static::$digit_gfx[$cost_digits[1]]));
			$this->write(0xF740E, pack('C*', static::$digit_gfx[$cost_digits[2]]));
		} else {
			$this->write(0xF73FA, pack('C*', 0x00, 0x00)); // reposition gfx
			$this->write(0xF7402, pack('C*', 0x00, 0x00)); // reposition gfx
			$this->write(0xF740A, pack('C*', 0x08, 0x00)); // reposition gfx
			$this->write(0xF73FE, pack('C*', static::$digit_gfx[$cost_digits[0]]));
			$this->write(0xF7406, pack('C*', static::$digit_gfx[$cost_digits[0]]));
			$this->write(0xF740E, pack('C*', static::$digit_gfx[$cost_digits[1]]));
		}

		$this->write(0xF7241, pack('C*', $cost >> 8));
		$this->write(0xF723F, pack('C*', $cost & 0xFF));

		return $this;
	}


	/**
	 * Set Smithy Quick Item Give mode. I.E. just gives an item if you rescue him with no sword bogarting
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSmithyQuickItemGive($enable = true) : self {
		$this->write(0x180029, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Set Pyramid Fountain to have 2 chests
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setPyramidFairyChests($enable = true) : self {
		$this->write(0x1FC16, $enable
			? pack('C*', 0xB1, 0xC6, 0xF9, 0xC9, 0xC6, 0xF9)
			: pack('C*', 0xA8, 0xB8, 0x3D, 0xD0, 0xB8, 0x3D));

		return $this;
	}

	/**
	 * Set space directly below Ganon to have a chest
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setBelowGanonChest($enable = true) : self {
		// convert telepathic tile to chest and place it
		$this->write(0x50563, $enable ? pack('C*', 0xC5, 0x76) : pack('C*', 0x3F, 0x14));
		// lock door to under ganon
		$this->write(0x50599, $enable ? pack('C*', 0x38) : pack('C*', 0x00));
		// set dungeon secret to this chest
		$this->write(0xE9A5, $enable ? pack('C*', 0x10, 0x00, 0x58) : pack('C*', 0x7E, 0x00, 0x24));

		return $this;
	}

	/**
	 * Set Game in Open Mode. (Post rain state with Escape undone)
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setOpenMode($enable = true) : self {
		$this->write(0x180032, pack('C*', $enable ? 0x01 : 0x00));
		$this->setSewersLampCone(!$enable);
		$this->setLightWorldLampCone(false);
		$this->setDarkWorldLampCone(false);

		return $this;
	}

	/**
	 * Enable maps to show crystals on overworld map
	 *
	 * @param bool $require_map switch on or off
	 *
	 * @return $this
	 */
	public function setMapMode($require_map = false) : self {
		$this->write(0x18003B, pack('C*', $require_map ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable compass to show dungeon count
	 *
	 * @param bool $show_count switch on or off
	 *
	 * @return $this
	 */
	public function setCompassMode($show_count = false) : self {
		$this->write(0x18003C, pack('C*', $show_count ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable text box to show with free roaming items
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setFreeItemTextMode($enable = true) : self {
		$this->write(0x18016A, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable swordless mode
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSwordlessMode($enable = false) : self {
		$this->write(0x18003F, pack('C*', $enable ? 0x01 : 0x00)); // Hammer Ganon
		$this->write(0x180040, pack('C*', $enable ? 0x01 : 0x00)); // Open Curtains
		$this->write(0x180041, pack('C*', $enable ? 0x01 : 0x00)); // Swordless Medallions
		$this->write(0x180043, pack('C*', $enable ? 0xFF : 0x00)); // set Link's starting sword 0xFF is taken sword

		return $this;
	}

	/**
	 * Enable lampless light cone in Sewers
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSewersLampCone($enable = true) : self {
		$this->write(0x180038, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable lampless light cone in Light World Dungeons
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setLightWorldLampCone($enable = true) : self {
		$this->write(0x180039, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable lampless light cone in Dark World Dungeons
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setDarkWorldLampCone($enable = true) : self {
		$this->write(0x18003A, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable/Disable the ROM Hack that doesn't leave Link stranded in DW
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setMirrorlessSaveAndQuitToLightWorld($enable = true) : self {
		$this->write(0x1800A0, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable/Disable ability to Save and Quit from Boss room after item collection.
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSaveAndQuitFromBossRoom($enable = false) : self {
		$this->write(0x180042, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable/Disable the ROM Hack that drains the Swamp on transition
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSwampWaterLevel($enable = true) : self {
		$this->write(0x1800A1, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable/Disable the ROM Hack that sends Link to Real DW on death in DW dungeon if AG1 is not dead
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setPreAgahnimDarkWorldDeathInDungeon($enable = true) : self {
		$this->write(0x1800A2, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable/Disable World on Agahnim Death
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setWorldOnAgahnimDeath($enable = true) : self {
		$this->write(0x1800A3, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable/Disable locking Hyrule Castle Door to AG1 during escape
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setLockAgahnimDoorInEscape($enable = true) : self {
		$this->write(0x180169, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Set the Ganon Warp Phase and Agahnim BB mode
	 *
	 * @param string $setting name
	 *
	 * @return $this
	 */
	public function setGanonAgahnimRng(string $setting = 'table') : self {
		switch ($setting) {
			case 'none':
				$byte = 0x01;
				break;
			case 'vanilla':
			case 'table':
			default:
				$byte = 0x00;
		}

		$this->write(0x180086, pack('C', $byte));

		return $this;
	}

	/**
	 * Write the seed identifier
	 *
	 * @param string $seed identifier for this seed
	 *
	 * @return $this
	 */
	public function setSeedString(string $seed) : self {
		$this->write(0x7FC0, substr($seed, 0, 21));

		return $this;
	}

	/**
	 * Write a hash of Logic version in ROM.
	 *
	 * @param array $byte byte array that relates to logic
	 *
	 * @return $this
	 */
	public function writeRandomizerLogicHash(array $bytes) : self {
		$this->write(0x181000, pack('C*', ...$bytes));

		return $this;
	}

	/**
	 * Write a block of data to RNG Block in ROM.
	 *
	 * @param callable $random prng byte generator
	 *
	 * @return $this
	 */
	public function writeRNGBlock(callable $random) : self {
		$string = '';
		for ($i = 0; $i < 1024; $i++) {
			$string .= pack('C*', $random());
		}
		$this->write(0x178000, $string);

		return $this;
	}

	/**
	 * set the flags byte in ROM
	 *
	 * dgGe mutT
	 * d - Nonstandard Dungeon Configuration (Not Map/Compass/BigKey/SmallKeys in same quantity as vanilla)
	 * g - Requires Minor Glitches (Fake flippers, bomb jumps, etc)
	 * G - Requires Major Glitches (OW YBA/Clips, etc)
	 * e - Requires EG
	 *
	 * m - Contains Multiples of Major Items
	 * u - Contains Unreachable Items
	 * t - Minor Trolling (Swapped around levers, etc)
	 * T - Major Trolling (Forced-guess softlocks, impossible seed, etc)
	 *
	 * @param int $flags byte of flags to set
	 *
	 * @return $this
	 */
	public function setWarningFlags(int $flags) : self {
		$this->write(0x180212, pack('C*', $flags));

		return $this;
	}

	/**
	 * Apply a patch to the ROM
	 *
	 * @param array $patch patch to apply
	 *
	 * @return $this
	 *
	 **/
	public function applyPatch(array $patch) : self {
		foreach ($patch as $part) {
			foreach ($part as $address => $data) {
				$this->write($address, pack('C*', ...array_values($data)));
			}
		}

		return $this;
	}

	/**
	 * Save the changes to this output file
	 *
	 * @param string $output_location location on the filesystem to write the new ROM.
	 *
	 * @return bool
	 */
	public function save(string $output_location) : bool {
		return copy($this->tmp_file, $output_location);
	}

	/**
	 * Write packed data at the given offset
	 *
	 * @param int $offset location in the ROM to begin writing
	 * @param string $data data to write to the ROM
	 *
	 * @return $this
	 */
	public function write(int $offset, $data) : self {
		Log::debug(sprintf("write: 0x%s: 0x%2s", strtoupper(dechex($offset)), strtoupper(unpack('H*', $data)[1])));
		$this->write_log[] = [$offset => array_values(unpack('C*', $data))];
		fseek($this->rom, $offset);
		fwrite($this->rom, $data);

		return $this;
	}

	/**
	 * Get the array of bytes written in the order they were written to the rom
	 *
	 * @return array
	 */
	public function getWriteLog() : array {
		return $this->write_log;
	}

	/**
	 * Read data from the ROM file into an array
	 *
	 * @param int $offset location in the ROM to begin reading
	 * @param int $length data to read
	 * // TODO: this should probably always be an array, or a new Bytes object
	 * @return array
	 */
	public function read(int $offset, int $length = 1) {
		fseek($this->rom, $offset);
		$unpacked = unpack('C*', fread($this->rom, $length));
		return count($unpacked) == 1 ? $unpacked[1] : array_values($unpacked);
	}

	/**
	 * Object destruction magic method
	 *
	 * @return void
	 */
	public function __destruct() {
		unlink($this->tmp_file);
	}

	/**
	 * Convert string to byte array for Credits that can be written to ROM
	 *
	 * @param string $string string to convert
	 *
	 * @return array
	 */
	public function convertCredits(string $string) : array {
		$byte_array = [];
		foreach (str_split(strtolower($string)) as $char) {
			$byte_array[] = $this->charToCreditsHex($char);
		}

		return $byte_array;
	}

	/**
	 * Convert character to byte for ROM in Credits Sequence
	 *
	 * @param string $string character to convert
	 *
	 * @return int
	 */
	private function charToCreditsHex($char) : int {
		if (preg_match('/[a-z]/', $char)) {
			return ord($char) - 0x47;
		}
		switch ($char) {
			case ' ': return 0x9F;
			case ',': return 0x37;
			case '.': return 0x37;
			case '-': return 0x36;
			case "'": return 0x35;
			default: return 0x9F;
		}
	}
}
