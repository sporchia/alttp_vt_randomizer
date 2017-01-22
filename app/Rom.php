<?php namespace ALttP;

use Closure;
use Log;

/**
 * Wrapper for ROM file
 */
class Rom {
	const BUILD = '2017-01-09';
	private $tmp_file;
	protected $rom;
	protected $write_log = [];

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
	 * Check to see if this ROM matches base randomizer ROM.
	 *
	 * @return bool
	 */
	public function checkMD5() {
		return hash_file('md5', $this->tmp_file) === '9d06a6a993ad8b18ce13cbabb1254d61';
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
	 * Set the opening Uncle text to one of the predefined values in he ROM
	 *
	 * @param int $byte which text to use: 0x00 -> 0x1F
	 *
	 * @return $this
	 */
	public function setUncleText($byte) {
		$this->write(0x180040, pack('C', $byte));

		return $this;
	}

	/**
	 * Set the opening Uncle text to a custom value
	 *
	 * @param string $string Uncle text can be 3 lines of 14 characters each
	 *
	 * @return $this
	 */
	public function setUncleTextCustom(string $string) {
		$offset = 0x10244A;
		foreach ($this->convertDialog(mb_strtoupper($string)) as $byte) {
			$this->write($offset++, pack('C', $byte));
		}
		$this->setUncleText(0x00);

		return $this;
	}

	/**
	 * Set the Zora credits text to a custom value
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
	 * @param string $setting name (0x00: off, 0x20: normal, 0x40: half, 0x80: quarter)
	 *
	 * @return $this
	 */
	public function setRandomizerSeedType(string $setting) {
		switch ($setting) {
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
	 * @param string $setting name (0x00: off, 0x20: normal, 0x40: half, 0x80: quarter)
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
	 * Convert string to byte array for Dialog Box that can be written to ROM
	 *
	 * @param string $string string to convert
	 *
	 * @return array
	 */
	public function convertDialog(string $string) {
		$new_string = [];
		$lines = explode("\n", $string);
		$i = 0;
		foreach ($lines as $line) {
			switch ($i) {
				case 0:
					$new_string[] = 0x00;
					break;
				case 1:
					$new_string[] = 0x75;
					$new_string[] = 0x00;
					break;
				case 2:
					$new_string[] = 0x76;
					$new_string[] = 0x00;
					break;
			}
			$line_chars = preg_split('//u', mb_substr($line, 0, 14), null, PREG_SPLIT_NO_EMPTY);
			foreach ($line_chars as $char) {
				$new_string[] = $this->charToHex($char);
				$new_string[] = 0x00;
			}
			array_pop($new_string);
			if (++$i > 2) {
				break;
			}
		}

		$new_string[] = 0x7F;
		$new_string[] = 0x7F;
		return $new_string;
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

	/**
	 * Convert character to byte for ROM
	 * @TODO: consider moving this out to a seperate encoding class
	 *
	 * @param string $string character to convert
	 *
	 * @return int
	 */
	private function charToHex($char) {
		if (preg_match('/\d/', $char)) {
			return $char + 0xA0;
		}
		if (preg_match('/[A-Z]/', $char)) {
			return ord($char) - 65 + 0xAA;
		}
		switch ($char) {
			case ' ': return 0xFF;
			case '?': return 0xC6;
			case '!': return 0xC7;
			case ',': return 0xC8;
			case '-': return 0xC9;
			case '.': return 0xCD;
			case '~': return 0xCE;
			case "'": return 0xD8;
			case "@": return 0xD2; // left half link face
			case ">": return 0xD3; // right half link face
			case "%": return 0xDD; // Hylian Bird
			case "^": return 0xDE; // Hylian Ankh
			case "=": return 0xDF; // Hylian Wavy lines
			case "↑": return 0xE0;
			case "↓": return 0xE1;
			case "→": return 0xE2;
			case "←": return 0xE3;
			case "あ": return 0x00;
			case "い": return 0x01;
			case "う": return 0x02;
			case "え": return 0x03;
			case "お": return 0x04;
			case "や": return 0x05;
			case "ゆ": return 0x06;
			case "よ": return 0x07;
			case "か": return 0x08;
			case "き": return 0x09;
			case "く": return 0x0A;
			case "け": return 0x0B;
			case "こ": return 0x0C;
			case "わ": return 0x0D;
			case "を": return 0x0E;
			case "ん": return 0x0F;
			case "さ": return 0x10;
			case "し": return 0x11;
			case "す": return 0x12;
			case "せ": return 0x13;
			case "そ": return 0x14;
			case "が": return 0x15;
			case "ぎ": return 0x16;
			case "ぐ": return 0x17;
			case "た": return 0x18;
			case "ち": return 0x19;
			case "つ": return 0x1A;
			case "て": return 0x1B;
			case "と": return 0x1C;
			case "げ": return 0x1D;
			case "ご": return 0x1E;
			case "ざ": return 0x1F;
			case "な": return 0x20;
			case "に": return 0x21;
			case "ぬ": return 0x22;
			case "ね": return 0x23;
			case "の": return 0x24;
			case "じ": return 0x25;
			case "ず": return 0x26;
			case "ぜ": return 0x27;
			case "は": return 0x28;
			case "ひ": return 0x29;
			case "ふ": return 0x2A;
			case "へ": return 0x2B;
			case "ほ": return 0x2C;
			case "ぞ": return 0x2D;
			case "だ": return 0x2E;
			case "ぢ": return 0x2F;
			case "ま": return 0x30;
			case "み": return 0x31;
			case "む": return 0x32;
			case "め": return 0x33;
			case "も": return 0x34;
			case "づ": return 0x35;
			case "で": return 0x36;
			case "ど": return 0x37;
			case "ら": return 0x38;
			case "り": return 0x39;
			case "る": return 0x3A;
			case "れ": return 0x3B;
			case "ろ": return 0x3C;
			case "ば": return 0x3D;
			case "び": return 0x3E;
			case "ぶ": return 0x3F;
			case "べ": return 0x40;
			case "ぼ": return 0x41;
			case "ぱ": return 0x42;
			case "ぴ": return 0x43;
			case "ぷ": return 0x44;
			case "ぺ": return 0x45;
			case "ぽ": return 0x46;
			case "ゃ": return 0x47;
			case "ゅ": return 0x48;
			case "ょ": return 0x49;
			case "っ": return 0x4A;
			case "ぁ": return 0x4B;
			case "ぃ": return 0x4C;
			case "ぅ": return 0x4D;
			case "ぇ": return 0x4E;
			case "ぉ": return 0x4F;
			case "ア": return 0x50;
			case "イ": return 0x51;
			case "ウ": return 0x52;
			case "エ": return 0x53;
			case "オ": return 0x54;
			case "ヤ": return 0x55;
			case "ユ": return 0x56;
			case "ヨ": return 0x57;
			case "カ": return 0x58;
			case "キ": return 0x59;
			case "ク": return 0x5A;
			case "ケ": return 0x5B;
			case "コ": return 0x5C;
			case "ワ": return 0x5D;
			case "ヲ": return 0x5E;
			case "ン": return 0x5F;
			case "サ": return 0x60;
			case "シ": return 0x61;
			case "ス": return 0x62;
			case "セ": return 0x63;
			case "ソ": return 0x64;
			case "ガ": return 0x65;
			case "ギ": return 0x66;
			case "グ": return 0x67;
			case "タ": return 0x68;
			case "チ": return 0x69;
			case "ツ": return 0x6A;
			case "テ": return 0x6B;
			case "ト": return 0x6C;
			case "ゲ": return 0x6D;
			case "ゴ": return 0x6E;
			case "ザ": return 0x6F;
			case "ナ": return 0x70;
			case "ニ": return 0x71;
			case "ヌ": return 0x72;
			case "ネ": return 0x73;
			case "ノ": return 0x74;
			case "ジ": return 0x75;
			case "ズ": return 0x76;
			case "ゼ": return 0x77;
			case "ハ": return 0x78;
			case "ヒ": return 0x79;
			case "フ": return 0x7A;
			case "ヘ": return 0x7B;
			case "ホ": return 0x7C;
			case "ゾ": return 0x7D;
			case "ダ": return 0x7E;
			case "マ": return 0x80;
			case "ミ": return 0x81;
			case "ム": return 0x82;
			case "メ": return 0x83;
			case "モ": return 0x84;
			case "ヅ": return 0x85;
			case "デ": return 0x86;
			case "ド": return 0x87;
			case "ラ": return 0x88;
			case "リ": return 0x89;
			case "ル": return 0x8A;
			case "レ": return 0x8B;
			case "ロ": return 0x8C;
			case "バ": return 0x8D;
			case "ビ": return 0x8E;
			case "ブ": return 0x8F;
			case "ベ": return 0x90;
			case "ボ": return 0x91;
			case "パ": return 0x92;
			case "ピ": return 0x93;
			case "プ": return 0x94;
			case "ペ": return 0x95;
			case "ポ": return 0x96;
			case "ャ": return 0x97;
			case "ュ": return 0x98;
			case "ョ": return 0x99;
			case "ッ": return 0x9A;
			case "ァ": return 0x9B;
			case "ィ": return 0x9C;
			case "ゥ": return 0x9D;
			case "ェ": return 0x9E;
			case "ォ": return 0x9F;
		}

		return 0xFF;
	}
}
