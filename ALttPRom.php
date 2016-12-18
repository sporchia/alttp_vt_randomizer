<?php namespace Randomizer;

use Monolog\Logger;

/**
 * Wrapper for ROM file
 */
class ALttPRom {
	private $tmp_file;
	protected $log;
	protected $rom;

	/**
	 * Create a new wrapper
	 *
	 * @param string $source_location location of source ROM to edit
	 * @param Logger|null $log Monolog Logger instance to log to
	 *
	 * @return void
	 */
	public function __construct(string $source_location, Logger $log = null) {
		if (is_readable($source_location) && hash_file('md5', $source_location) !== 'ba0093e40e29b1f279cae0d9f06859c6') {
			throw new \Exception('Source ROM not readable or incorrect md5 hash');
		}
		$this->log = $log ?: new Logger('alttp');
		$this->tmp_file = tempnam(sys_get_temp_dir(), __CLASS__);

		copy($source_location, $this->tmp_file);

		$this->rom = fopen($this->tmp_file, "r+");
		$this->setMaxArrows();
		$this->setMaxBombs();
		$this->setHeartBeepSpeed(0x40);
	}

	/**
	 * Set the Low Health Beep Speed
	 *
	 * @param int $byte setting (0x00: off, 0x20: normal, 0x40: half, 0x80: quarter)
	 *
	 * @return $this
	 */
	public function setHeartBeepSpeed($byte) {
		fseek($this->rom, 0x180033);
		fwrite($this->rom, pack('c', $byte));
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
		fseek($this->rom, 0x180035);
		fwrite($this->rom, pack('c', $max));
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
		fseek($this->rom, 0x180034);
		fwrite($this->rom, pack('c', $max));
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
		fseek($this->rom, 0x180040);
		fwrite($this->rom, pack('c', $byte));
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
		fseek($this->rom, 0x102330);
		foreach ($this->convertDialog($string) as $byte) {
			fwrite($this->rom, pack('c', $byte));
		}
		return $this;
	}

	/**
	 * Enable the predefined ROM debug mode: Starts after Zelda is saved with all items. No chests are open.
	 *
	 * @return $this
	 */
	public function enableDebugMode() {
		fseek($this->rom, 0x65B88);
		fwrite($this->rom, pack('c', 0xEA) . pack('c', 0xEA));
		fseek($this->rom, 0x65B91);
		fwrite($this->rom, pack('c', 0xEA) . pack('c', 0xEA));

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
		$this->log->debug(sprintf("write: 0x%s: 0x%2s\n", strtoupper(dechex($offset)), strtoupper(unpack('H*', $data)[1])));
		fseek($this->rom, $offset);
		fwrite($this->rom, $data);

		return $this;
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
		return unpack('H*', fread($this->rom, $length))[1];
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
	 * Convert string to byte array that can be written to ROM
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
			$line = str_split(substr($line, 0, 14));
			foreach ($line as $char) {
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
	 * Convert character to byte for ROM
	 *
	 * @param string $string character to convert
	 *
	 * @return int
	 */
	private function charToHex($char) {
		$char = strtoupper($char);
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
		}

		return 0xFF;
	}
}
