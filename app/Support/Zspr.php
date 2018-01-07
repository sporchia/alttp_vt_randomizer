<?php namespace ALttP\Support;

use Log;

/**
 * Wrapper for Zspr file
 */
class Zspr {
	private $data;
	private $display_text = '';
	private $author = '';
	private $author_rom = '';
	private $sprite_data_offset;
	private $palette_data_offset;

	/**
	 * Create a new wrapper
	 *
	 * @param string $source_location location of source Zspr
	 *
	 * @return void
	 */
	public function __construct(string $source_location) {
		if (!is_readable($source_location)) {
			throw new \Exception('Source Zspr not readable');
		}

		$this->data = file_get_contents($source_location);

		if (substr($this->data, 0, 4) !== 'ZSPR') {
			throw new \Exception('Source not valid Zspr file');
		}

		$this->bytes = array_values(unpack('C*', $this->data));

		$this->sprite_data_offset = $this->bytes[12] << 24 | $this->bytes[11] << 16 | $this->bytes[10] << 8 | $this->bytes[9];
		$this->palette_data_offset = $this->bytes[18] << 24 | $this->bytes[17] << 16 | $this->bytes[16] << 8 | $this->bytes[15];

		$variable_data = array_values(unpack('v*', substr($this->data, 29, $this->sprite_data_offset - 29)));
		while (count($variable_data)) {
			$char = array_shift($variable_data);
			if (!$char) {
				break;
			}
			$this->display_text .= $this->unichr($char);
		}

		while (count($variable_data)) {
			$char = array_shift($variable_data);
			if (!$char) {
				break;
			}
			$this->author .= $this->unichr($char);
		}

		$variable_data = array_values(unpack('c*', pack('v*', ...$variable_data)));
		while (count($variable_data)) {
			$char = array_shift($variable_data);
			if (!$char) {
				break;
			}
			$this->author_rom .= chr($char);
		}
	}

	public function getVersion() {
		return $this->bytes[4];
	}

	public function checksum() {
		return (array_sum($this->bytes) & 0xFFFF) == ($this->bytes[6] << 8 | $this->bytes[5]);
	}

	public function getPixelData() {
		$length = $this->bytes[14] << 8 | $this->bytes[13];

		return substr($this->data, $this->sprite_data_offset, $length);
	}

	// we have faster access through the internal bytes array, but dirty quick for release here
	public function getPixelBytes() {
		return array_values(unpack('C*', $this->getPixelData()));
	}

	public function getPaletteData() {
		$length = $this->bytes[20] << 8 | $this->bytes[19];

		return substr($this->data, $this->palette_data_offset, $length);
	}

	// @TODO: use internal bytes array instead *derp*
	public function getPaletteBytes() {
		return array_values(unpack('C*', $this->getPaletteData()));
	}

	public function getType() {
		switch ($this->bytes[22] << 8 | $this->bytes[21]) {
			case 1:
				return 'Sprite';
			default:
				return 'Unkown';
		}
	}

	public function getDisplayText() {
		return $this->display_text;
	}

	public function getAuthor() {
		return $this->author;
	}

	public function getAuthorRomDisplay() {
		return $this->author_rom;
	}
	protected function unichr($u) {
		return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
	}
}
