<?php namespace Randomizer;

/**
 * Wrapper for ROM file
 */
class ALttPRom {
	/**
	 * @var string location of tempory file used for writing
	 */
	private $tmp_file;
	/**
	 * @var resource file pointer to tempory ROM we are editing
	 */
	protected $rom;

	/**
	 * Create a new wrapper
	 *
	 * @param string $source_location location of source ROM to edit
	 *
	 * @return void
	 */
	public function __construct(string $source_location) {
		if (is_readable($source_location) && hash_file('md5', $source_location) !== '64b87baf0c1205b910aa1f6dbc96ca8d') {
			throw new \Exception('Source ROM not readable or incorrect md5 hash');
		}

		$this->tmp_file = tempnam(sys_get_temp_dir(), __CLASS__);

		copy($source_location, $this->tmp_file);

		$this->rom = fopen($this->tmp_file, "r+");
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
		fseek($this->rom, 0x1022A9);
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
	public function save($output_location) {
		return copy($this->tmp_file, $output_location);
	}

	public function setLocationItem(Location $location, Item $item) {
		$this->write($location->getAddress(), $item->getPacked());
	}

	public function write($offset, $data) {
		fseek($this->rom, $offset);
		fwrite($this->rom, $data);
	}

	public function read($offset, $length = 1) {
		fseek($this->rom, $offset);
		return unpack('H*', fread($this->rom, $length))[1];
	}

	public function __destruct() {
		unlink($this->tmp_file);
	}

	public function convertDialog($string) {
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
