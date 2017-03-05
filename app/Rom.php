<?php namespace ALttP;

use ALttP\Support\Dialog;
use Closure;
use Log;

/**
 * Wrapper for ROM file
 */
class Rom {
	const BUILD = '2017-03-04';
	const HASH = '4d09247076be6b318d645c87b164c0c2';
	const SIZE = 2097152;
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
	public static function saveBuild(array $patch) {
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
	public function resize(int $size = null) {
		ftruncate($this->rom, $size ?? static::SIZE);

		return $this;
	}

	/**
	 * Check to see if this ROM matches base randomizer ROM.
	 *
	 * @return bool
	 */
	public function checkMD5() {
		return hash_file('md5', $this->tmp_file) === static::HASH;
	}

	/**
	 * Set the Low Health Beep Speed
	 *
	 * @param string $setting name (0x00: off, 0x20: normal, 0x40: half, 0x80: quarter)
	 *
	 * @return $this
	 */
	public function setHeartBeepSpeed(string $setting) {
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
	public function setRupoorValue($value = 10) {
		$this->write(0x180036, pack('v*', $value));

		return $this;
	}

	/**
	 * Set the starting Max Arrows
	 *
	 * @param int $max
	 *
	 * @return $this
	 */
	public function setMaxArrows($max = 30) {
		$this->write(0x180035, pack('C', $max));

		return $this;
	}

	/**
	 * Set the starting Max Bombs
	 *
	 * @param int $max
	 *
	 * @return $this
	 */
	public function setMaxBombs($max = 10) {
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
	public function setCapacityUpgradeFills(array $fills) {
		$this->write(0x180080, pack('C*', ...array_slice($fills, 0, 4)));

		return $this;
	}

	/**
	 * Set the opening Uncle text to one of the predefined values in he ROM
	 *
	 * @param int $offset which text to use: 0x00 -> 0x1F
	 *
	 * @return $this
	 */
	public function setUncleText(int $offset = 0) {
		$texts = [
			"We're out of\nWeetabix. To\nthe store!",
			"This seed is\nbootless\nuntil boots.",
			"Why do we only\nhave one bed?",
			"This is the\nonly textbox.",
			"I'm going to\ngo watch the\nMoth tutorial.",
			"This seed is\nthe worst.",
			"Chasing tail.\nFly ladies.\nDo not follow.",
			"I feel like\nI've done this\nbefore...",
			"Magic cape can\npass through\nthe barrier!",
			"Boots at race?\nSeed confirmed\nimpossible.",
			"If this is a\nKanzeon seed,\nI'm quitting.",
			"I am not your\nreal uncle.",
			"You're going\nto have a very\nbad time.",
			"Today you\nwill have\nbad luck.",
			"I am leaving\nforever.\nGoodbye.",
			"Don’t worry.\nI got this\ncovered.",
			"Race you to\nthe castle!",
			"\n~69 Blaze It!~",
			"\n      hi",
			"I'M JUST GOING\nOUT FOR A\nPACK OF SMOKES",
			"It's dangerous\nto go alone.\nSee ya!",
			"ARE YOU A BAD\nENOUGH DUDE TO\nRESCUE ZELDA?",
			"\n\n    I AM ERROR",
			"This seed is\nsub 2 hours,\nguaranteed.",
			"The chest is\na secret to\neverybody.",
			"I'm off to\nfind the\nwind fish.",
			"The shortcut\nto Ganon\nis this way!",
			"THE MOON IS\nCRASHING! RUN\nFOR YOUR LIFE!",
			"Time to fight\nhe who must\nnot be named.",
			"RED MAIL\nIS FOR\nCOWARDS.",
			"HEY!\n\nLISTEN!",
			"Well\nexcuuuuuse me,\nprincess!",
			"5,000 Rupee\nreward for @>\nYou're boned",
		];

		$this->setUncleTextString($texts[$offset % count($texts)]);

		return $this;
	}

	/**
	 * Set the opening Uncle text to a custom value
	 *
	 * @param string $string Uncle text can be 3 lines of 14 characters each
	 *
	 * @return $this
	 */
	public function setUncleTextString(string $string) {
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
	public function setGanon1TextString(string $string) {
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
	public function setGanon2TextString(string $string) {
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
	public function setTriforceTextString(string $string) {
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
	public function setBlindTextString(string $string) {
		$offset = 0x180800;

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
	public function setPyramidFairyTextString(string $string) {
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
	public function setPedestalTextbox(string $string) {
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
	public function setKingsReturnCredits(string $string) {
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
	public function setSanctuaryCredits(string $string) {
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
	public function setKakarikoTownCredits(string $string) {
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
	public function setDesertPalaceCredits(string $string) {
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
	public function setMountainTowerCredits(string $string) {
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
	public function setLinksHouseCredits(string $string) {
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
	public function setZoraCredits(string $string) {
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
	public function setMagicShopCredits(string $string) {
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
	public function setWoodsmansHutCredits(string $string) {
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
	public function setFluteBoyCredits(string $string) {
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
	public function setWishingWellCredits(string $string) {
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
	public function setSwordsmithsCredits(string $string) {
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
	public function setBugCatchingKidCredits(string $string) {
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
	public function setDeathMountainCredits(string $string) {
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
	public function setLostWoodsCredits(string $string) {
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
	public function setAltarCredits(string $string) {
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
	public function setDebugMode($enable = true) {
		$this->write(0x65B88, pack('S*', $enable ? 0xEAEA : 0x21F0));
		$this->write(0x65B91, pack('S*', $enable ? 0xEAEA : 0x18D0));

		return $this;
	}

	/**
	 * dont use this. It's not properly set up yet
	 *
	 * @return $this
	 */
	public function setEndGameMode() {
		$this->setDebugMode();
		$debug_offset = 0x2716A;
		$this->write($debug_offset + 26, pack('C*', 0x04)); // sword
		$this->write($debug_offset + 27, pack('C*', 0x03)); // shield
		$this->write($debug_offset + 28, pack('C*', 0x02)); // mail
		$this->write($debug_offset + 53, pack('C*', 0x07)); // pendants
		$this->write($debug_offset + 59, pack('C*', 0xFF)); // crystals
		$this->write($debug_offset + 60, pack('C*', 0x02)); // magic

		return $this;
	}

	/**
	 * Enable/Disable the SRAM Trace function
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSRAMTrace($enable = true) {
		$this->write(0x180030, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Set the Seed Type
	 *
	 * @param string $setting name
	 *
	 * @return $this
	 */
	public function setRandomizerSeedType(string $setting) {
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
	public function setGameType(string $setting) {
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
	 * Set the Tournament Type
	 *
	 * @param string $setting name
	 *
	 * @return $this
	 */
	public function setTournamentType(string $setting) {
		switch ($setting) {
			case 'standard':
				$byte = 0x01;
				break;
			case 'none':
			default:
				$byte = 0x00;
		}

		$this->write(0x180213, pack('C', $byte));

		return $this;
	}

	/**
	 * Removes Shield from Uncle by moving the tiles for shield to his head and replaces them with his head.
	 *
	 * @return $this
	 */
	public function removeUnclesShield() {
		$this->write(0x6D253, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D25B, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D283, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x00, 0x0E));
		$this->write(0x6D28B, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x00, 0x0E));
		$this->write(0x6D2CB, pack('C*', 0x00, 0x00, 0xf6, 0xff, 0x02, 0x0E));
		$this->write(0x6D2FB, pack('C*', 0x00, 0x00, 0xf7, 0xff, 0x02, 0x0E));
		$this->write(0x6D313, pack('C*', 0x00, 0x00, 0xe4, 0xff, 0x08, 0x0E));

		//$rom->write(0x1E9C4, pack('S*', 0x0120)); // Halloween Heads Hobo

		return $this;
	}

	/**
	 * Adjust some settings for hard mode
	 *
	 * @param int $level how hard to make it, higher should be harder
	 *
	 * @return $this
	 */
	public function setHardMode($level = 0, $dont_nerf_blue_potion = false) {
		switch ($level) {
			case 0:
				// Cape magic
				$this->write(0x3ADA7, pack('C*', 0x04, 0x08, 0x10));
				// Bubble transform
				$this->write(0x36DD0, pack('C*', 0xE3));
				// Red Potion Cost
				$this->write(0x2F803, pack('S*', 0x0078)); // 120 Rupees
				$this->write(0x2F822, pack('S*', 0x0078)); // 120 Rupees
				$this->write(0x2F869, pack('C*', 0x31)); // 1
				$this->write(0x2F861, pack('C*', 0x02)); // 2
				$this->write(0x2F859, pack('C*', 0x30)); // 0
				// Green Potion Cost
				$this->write(0x2F6C1, pack('S*', 0x003C)); // 60 Rupees
				$this->write(0x2F6E0, pack('S*', 0x003C)); // 60 Rupees
				$this->write(0x2F714, pack('C*', 0x22)); // 6
				$this->write(0x2F70C, pack('C*', 0x30)); // 0
				// 0x07 Red Potion General
				$this->write(0xF7178, pack('C*', 0x78)); // cost: 120
				$this->write(0xF73AE, pack('C*', 0x31)); // 1
				$this->write(0xF73B6, pack('C*', 0x02)); // 2
				$this->write(0xF73BE, pack('C*', 0x30)); // 0
				// 0x08 Blue Shield
				$this->write(0xF71FF, pack('C*', 0x32)); // cost: 50
				$this->write(0xF73D2, pack('C*', 0x00, 0x00)); // reposition gfx
				$this->write(0xF73DA, pack('C*', 0x00, 0x00)); // reposition gfx
				$this->write(0xF73E2, pack('C*', 0x08, 0x00)); // reposition gfx
				$this->write(0xF73D6, pack('C*', 0x31)); // 5
				$this->write(0xF73DE, pack('C*', 0x30)); // 5
				$this->write(0xF73E6, pack('C*', 0x30)); // 0

				$this->setRupoorValue(0);

				$dont_nerf_blue_potion = true;
				break;
			case 1:
				$this->write(0x3ADA7, pack('C*', 0x02, 0x02, 0x02));
				$this->write(0x36DD0, pack('C*', 0x79));
				// Red Potion Cost
				$this->write(0x2F803, pack('S*', 0x00F0)); // 240 Rupees
				$this->write(0x2F822, pack('S*', 0x00F0)); // 240 Rupees
				$this->write(0x2F869, pack('C*', 0x02)); // 2
				$this->write(0x2F861, pack('C*', 0x12)); // 4
				$this->write(0x2F859, pack('C*', 0x30)); // 0
				// Green Potion Cost
				$this->write(0x2F6C1, pack('S*', 0x0063)); // 99 Rupees
				$this->write(0x2F6E0, pack('S*', 0x0063)); // 99 Rupees
				$this->write(0x2F70C, pack('C*', 0x33)); // 9
				$this->write(0x2F714, pack('C*', 0x33)); // 9
				// Blue Potion Cost
				$this->write(0x2F75E, pack('S*', 0x0140)); // 320 Rupees
				$this->write(0x2F77D, pack('S*', 0x0140)); // 320 Rupees
				$this->write(0x2F7B9, pack('C*', 0x03)); // 3
				$this->write(0x2F7B1, pack('C*', 0x02)); // 2
				$this->write(0x2F7A9, pack('C*', 0x30)); // 0

				// 0x07 Red Potion General
				$this->write(0xF7178, pack('C*', 0xF0)); // cost: 240
				$this->write(0xF73AE, pack('C*', 0x02)); // 2
				$this->write(0xF73B6, pack('C*', 0x12)); // 4
				$this->write(0xF73BE, pack('C*', 0x30)); // 0
				// 0x08 Blue Shield
				$this->write(0xF71FF, pack('C*', 0x64)); // cost: 100
				$this->write(0xF73D2, pack('C*', 0xFC, 0xFF)); // reposition gfx
				$this->write(0xF73DA, pack('C*', 0x04, 0x00)); // reposition gfx
				$this->write(0xF73E2, pack('C*', 0x0C, 0x00)); // reposition gfx
				$this->write(0xF73D6, pack('C*', 0x31)); // 1
				$this->write(0xF73DE, pack('C*', 0x30)); // 0
				$this->write(0xF73E6, pack('C*', 0x30)); // 0

				$this->setRupoorValue(5);

				break;
			case 2:
				$this->write(0x3ADA7, pack('C*', 0x01, 0x01, 0x01));
				$this->write(0x36DD0, pack('C*', 0x79));

				// Red Potion
				$this->write(0x2F803, pack('S*', 0x2706)); // 9999 Rupees
				$this->write(0x2F822, pack('S*', 0x2706)); // 9999 Rupees
				$this->write(0x2F859, pack('C*', 0x3C)); // -
				$this->write(0x2F861, pack('C*', 0x3C)); // -
				$this->write(0x2F869, pack('C*', 0x3C)); // -
				// Green Potion Cost
				$this->write(0x2F6C1, pack('S*', 0x2706)); // 9999 Rupees
				$this->write(0x2F6E0, pack('S*', 0x2706)); // 9999 Rupees
				$this->write(0x2F70C, pack('C*', 0x3C)); // -
				$this->write(0x2F714, pack('C*', 0x3C)); // -
				// Blue Potion Cost
				$this->write(0x2F75E, pack('S*', 0x2706)); // 9999 Rupees
				$this->write(0x2F77D, pack('S*', 0x2706)); // 9999 Rupees
				$this->write(0x2F7B9, pack('C*', 0x3C)); // -
				$this->write(0x2F7B1, pack('C*', 0x3C)); // -
				$this->write(0x2F7A9, pack('C*', 0x3C)); // -

				// 0x07 Red Potion General
				$this->write(0xF717A, pack('C*', 0x27)); // cost: 9984 +
				$this->write(0xF7178, pack('C*', 0x06)); // cost: 6
				$this->write(0xF73AE, pack('C*', 0x3C)); // -
				$this->write(0xF73B6, pack('C*', 0x3C)); // -
				$this->write(0xF73BE, pack('C*', 0x3C)); // -
				// 0x08 Blue Shield
				$this->write(0xF7201, pack('C*', 0x27)); // cost: 9984 +
				$this->write(0xF71FF, pack('C*', 0x06)); // cost: 6
				$this->write(0xF73D2, pack('C*', 0xFC, 0xFF)); // reposition gfx
				$this->write(0xF73DA, pack('C*', 0x04, 0x00)); // reposition gfx
				$this->write(0xF73E2, pack('C*', 0x0C, 0x00)); // reposition gfx
				$this->write(0xF73D6, pack('C*', 0x3C)); // -
				$this->write(0xF73DE, pack('C*', 0x3C)); // -
				$this->write(0xF73E6, pack('C*', 0x3C)); // -

				$this->setRupoorValue(5);

				break;
		}

		if ($dont_nerf_blue_potion) {
			// Blue Bottle Cost
			$this->write(0x2F75E, pack('S*', 0x00A0)); // 160 Rupees
			$this->write(0x2F77D, pack('S*', 0x00A0)); // 160 Rupees
			$this->write(0x2F7B9, pack('C*', 0x31)); // 1
			$this->write(0x2F7B1, pack('C*', 0x22)); // 6
			$this->write(0x2F7A9, pack('C*', 0x30)); // 0
		}
		return $this;
	}

	/**
	 * Set Smithy Quick Item Give mode. I.E. just gives an item if you rescue him with no sword bogarting
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSmithyQuickItemGive($enable = true) {
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
	public function setPyramidFairyChests($enable = true) {
		$this->write(0x1FC16, $enable
			? pack('C*', 0xB1, 0xC6, 0xF9, 0xC9, 0xC6, 0xF9)
			: pack('C*', 0xA8, 0xB8, 0x3D, 0xD0, 0xB8, 0x3D));

		return $this;
	}

	/**
	 * Set Game in Open Mode. (Post rain state with Escape undone)
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setOpenMode($enable = true) {
		$this->write(0x180032, pack('C*', $enable ? 0x01 : 0x00));
		$this->setSewersLampCone(!$enable);
		$this->setLightWorldLampCone(!$enable);
		$this->setDarkWorldLampCone(false);

		return $this;
	}

	/**
	 * Enable lampless light cone in Sewers
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSewersLampCone($enable = true) {
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
	public function setLightWorldLampCone($enable = true) {
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
	public function setDarkWorldLampCone($enable = true) {
		$this->write(0x18003A, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * without this enabled upgraded swords will cause Zelda not to spawn in her cell
	 *
	 * @return $this
	 */
	public function skipZeldaSwordCheck($enable = true) {
		$this->write(0x2EBD4, pack('C*', $enable ? 0x05 : 0x02));

		return $this;
	}

	/**
	 * Enable/Disable the ROM Hack that doesn't leave Link stranded in DW
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setMirrorlessSaveAneQuitToLightWorld($enable = true) {
		$this->write(0x1800A0, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Enable/Disable the ROM Hack that drains the Swamp on transition
	 *
	 * @param bool $enable switch on or off
	 *
	 * @return $this
	 */
	public function setSwampWaterLevel($enable = true) {
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
	public function setPreAgahnimDarkWorldDeathInDungeon($enable = true) {
		$this->write(0x1800A2, pack('C*', $enable ? 0x01 : 0x00));

		return $this;
	}

	/**
	 * Write the seed identifier
	 *
	 * @param string $seed identifier for this seed
	 *
	 * @return $this
	 */
	public function setSeedString(string $seed) {
		$this->write(0x7FC0, substr($seed, 0, 21));
		return $this;
	}

	/**
	 * Write a block of data to RNG Block in ROM.
	 *
	 * @param Closure $random prng byte generator
	 *
	 * @return $this
	 */
	public function writeRNGBlock(Closure $random) {
		$string = '';
		for ($i = 0; $i < 1024; $i++) {
			$string .= pack('C*', $random());
		}
		$this->write(0x178000, $string);
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
	public function applyPatch(array $patch) {
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
	public function save(string $output_location) {
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
	public function write(int $offset, $data) {
		Log::debug(sprintf("write: 0x%s: 0x%2s\n", strtoupper(dechex($offset)), strtoupper(unpack('H*', $data)[1])));
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
	public function getWriteLog() {
		return $this->write_log;
	}

	/**
	 * Read data from the ROM file into an array
	 *
	 * @param int $offset location in the ROM to begin reading
	 * @param int $length data to read
	 *
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
	public function convertCredits(string $string) {
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
	private function charToCreditsHex($char) {
		if (preg_match('/[a-z]/', $char)) {
			return ord($char) - 0x47;
		}
		switch ($char) {
			case ' ': return 0x9F;
			case ',': return 0x37;
			case '-': return 0x36;
			case "'": return 0x35;
		}
	}
}
