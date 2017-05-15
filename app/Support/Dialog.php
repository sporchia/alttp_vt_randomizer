<?php namespace ALttP\Support;

/**
 * Dialog Conversion
 */
class Dialog {
	/**
	 * Convert string to byte array for Dialog Box that can be written to ROM
	 *
	 * @param string $string string to convert
	 * @param int $max_bytes maximum bytes to return
	 *
	 * @return array
	 */
	public function convertDialog(string $string, $max_bytes = 256) {
		$new_string = [];
		$lines = explode("\n", mb_strtoupper($string));
		$i = 0;
		foreach ($lines as $line) {
			switch ($i) {
				case 0:
					$new_string[] = 0x74;
					break;
				case 1:
					$new_string[] = 0x75;
					break;
				case 2:
				default:
					$new_string[] = 0x76;
					break;
			}
			$line_chars = preg_split('//u', mb_substr($line, 0, 14), null, PREG_SPLIT_NO_EMPTY);
			foreach ($line_chars as $char) {
				$write = $this->charToHex($char);
				if ($write[0] == 0xFD) {
					$new_string = array_merge($new_string, $write);
				} else {
					foreach ($write as $byte) {
						$new_string = array_merge($new_string, array_pad([$byte], -2, 0x00));
					}
				}
			}
			if (++$i % 3 == 0 && count($lines) > $i) {
				$new_string[] = 0x7E;
			}
			if ($i >= 3 && $i < count($lines)) {
				$new_string[] = 0x73;
			}
		}

		$new_string[] = 0x7F;
		if (count($new_string) > $max_bytes) {
			return array_merge(array_slice($new_string, 0, $max_bytes - 1), [0x7F]);
		}
		return $new_string;
	}

	/**
	 * Convert string to byte array for Compressed Dialog Box that can be written to ROM
	 *
	 * @param string $string string to convert
	 * @param bool $pause whether to pause for input
	 * @param int $max_bytes maximum bytes to return
	 * @param int $wrap if greater than 0 wrap lines to this value
	 *
	 * @return array
	 */
	public function convertDialogCompressed(string $string, $pause = true, $max_bytes = 2046, $wrap = 14) {
		$pad_out = false;
		$new_string = [0xFB];
		$lines = explode("\n", mb_strtoupper($string));
		if ($wrap > 0) {
			$new_lines = [];
			foreach ($lines as $line) {
				$new_line = mb_wordwrap($line, $wrap, "\n");
				$new_lines = array_merge($new_lines, explode("\n", mb_strtoupper($new_line)));
			}
			$lines = $new_lines;
		}
		$i = 0;
		$line_count = count($lines);
		foreach ($lines as $line) {
			$line_chars = preg_split('//u', mb_substr($line, 0, 14), null, PREG_SPLIT_NO_EMPTY);
			// command
			if (reset($line_chars) == "{") {
				switch (trim($line)) {
					case "{SPEED0}":
						$new_string = array_merge($new_string, [0xFC, 0x00]);
						break;
					case "{SPEED6}":
						$new_string = array_merge($new_string, [0xFC, 0x06]);
						break;
					case "{PAUSE1}":
						$new_string = array_merge($new_string, [0xFE, 0x78, 0x01]);
						break;
					case "{PAUSE3}":
						$new_string = array_merge($new_string, [0xFE, 0x78, 0x03]);
						break;
					case "{PAUSE5}":
						$new_string = array_merge($new_string, [0xFE, 0x78, 0x05]);
						break;
					case "{PAUSE7}":
						$new_string = array_merge($new_string, [0xFE, 0x78, 0x07]);
						break;
					case "{PAUSE9}":
						$new_string = array_merge($new_string, [0xFE, 0x78, 0x09]);
						break;
					case "{CHOICE}":
						$new_string = array_merge($new_string, [0xFE, 0x68]);
						break;
					case "{CHOICE2}":
						$new_string = array_merge($new_string, [0xFE, 0x71]);
						break;
					case "{CHOICE3}":
						$new_string = array_merge($new_string, [0xFE, 0x72]);
						break;
					case "{MENU}":
						$new_string = array_merge($new_string, [0xFE, 0xD6, 0x00]);
						break;
					case "{NOBORDER}":
						$new_string = array_merge($new_string, [0xFE, 0x6B, 0x02]);
						break;
					case "{CHANGEPIC}":
						$new_string = array_merge($new_string, [0xFE, 0x67, 0xFE, 0x67]);
						break;
					case "{INTRO}":
						$pad_out = true;
						$new_string = array_merge($new_string, [0xFE, 0x6E, 0x00, 0xFE, 0x77, 0x07, 0xFC, 0x03, 0xFE, 0x6B, 0x02, 0xFE, 0x67]);
						break;
					case "{IBOX}":
						$new_string = array_merge($new_string, [0xFE, 0x6B, 0x02, 0xFE, 0x77, 0x07, 0xFC, 0x03, 0xF7]);
						break;
				}
				$line_count--;
				if (count($new_string) > $max_bytes) {
					throw new \Exception("command overflowed byte length");
				}
				continue;
			}

			switch ($i) {
				case 0:
					break;
				case 1:
					$new_string[] = 0xF8; // row 2
					break;
				case 2:
				default:
					if ($i >= 3 && $i < count($lines)) {
						$new_string[] = 0xF6; // scroll
					} else {
						$new_string[] = 0xF9; // row 3
					}
					break;
			}

			// the first box needs to fill the full width with spaces as the palette is loaded weird.
			if ($pad_out && $i < 3) {
				$line_chars = array_pad($line_chars, 14, ' ');
			}

			foreach ($line_chars as $char) {
				$new_string = array_merge($new_string, $this->charToHex($char));
			}
			$i++;

			if ($pause && $i % 3 == 0 && $line_count > $i) {
				$new_string[] = 0xFA; // wait for input
			}
		}

		if (count($new_string) > $max_bytes) {
			return array_merge(array_slice($new_string, 0, $max_bytes));
		}
		return $new_string;
	}

	/**
	 * Convert character to byte for ROM
	 *
	 * @param string $string character to convert
	 * E5E7=<1/4 heart>
	 * E6E7=<1/2 heart>
	 * E8E9=<3/4 heart>
	 * EAEB=<full heart>
	 *
	 * @return int
	 */
	private function charToHex($char) {
		if (preg_match('/\d/', $char)) {
			return [$char + 0xA0];
		}
		if (preg_match('/[A-Z]/', $char)) {
			return [ord($char) - 65 + 0xAA];
		}
		switch ($char) {
			case ' ': return [0xFF];
			case '?': return [0xC6];
			case '!': return [0xC7];
			case ',': return [0xC8];
			case '-': return [0xC9];
			case "…": return [0xCC];
			case '.': return [0xCD];
			case '~': return [0xCE];
			case '～': return [0xCE];
			case "'": return [0xD8];
			case "’": return [0xD8];
			case "@": return [0xFE, 0x6A]; // link's name compressed
			case ">": return [0xD2, 0xD3]; // link face
			case "%": return [0xDD]; // Hylian Bird
			case "^": return [0xDE]; // Hylian Ankh
			case "=": return [0xDF]; // Hylian Wavy lines
			case "↑": return [0xE0];
			case "↓": return [0xE1];
			case "→": return [0xE2];
			case "←": return [0xE3];
			case "≥": return [0xE4]; // cursor
			case "あ": return [0x00];
			case "い": return [0x01];
			case "う": return [0x02];
			case "え": return [0x03];
			case "お": return [0x04];
			case "や": return [0x05];
			case "ゆ": return [0x06];
			case "よ": return [0x07];
			case "か": return [0x08];
			case "き": return [0x09];
			case "く": return [0x0A];
			case "け": return [0x0B];
			case "こ": return [0x0C];
			case "わ": return [0x0D];
			case "を": return [0x0E];
			case "ん": return [0x0F];
			case "さ": return [0x10];
			case "し": return [0x11];
			case "す": return [0x12];
			case "せ": return [0x13];
			case "そ": return [0x14];
			case "が": return [0x15];
			case "ぎ": return [0x16];
			case "ぐ": return [0x17];
			case "た": return [0x18];
			case "ち": return [0x19];
			case "つ": return [0x1A];
			case "て": return [0x1B];
			case "と": return [0x1C];
			case "げ": return [0x1D];
			case "ご": return [0x1E];
			case "ざ": return [0x1F];
			case "な": return [0x20];
			case "に": return [0x21];
			case "ぬ": return [0x22];
			case "ね": return [0x23];
			case "の": return [0x24];
			case "じ": return [0x25];
			case "ず": return [0x26];
			case "ぜ": return [0x27];
			case "は": return [0x28];
			case "ひ": return [0x29];
			case "ふ": return [0x2A];
			case "へ": return [0x2B];
			case "ほ": return [0x2C];
			case "ぞ": return [0x2D];
			case "だ": return [0x2E];
			case "ぢ": return [0x2F];
			case "ま": return [0x30];
			case "み": return [0x31];
			case "む": return [0x32];
			case "め": return [0x33];
			case "も": return [0x34];
			case "づ": return [0x35];
			case "で": return [0x36];
			case "ど": return [0x37];
			case "ら": return [0x38];
			case "り": return [0x39];
			case "る": return [0x3A];
			case "れ": return [0x3B];
			case "ろ": return [0x3C];
			case "ば": return [0x3D];
			case "び": return [0x3E];
			case "ぶ": return [0x3F];
			case "べ": return [0x40];
			case "ぼ": return [0x41];
			case "ぱ": return [0x42];
			case "ぴ": return [0x43];
			case "ぷ": return [0x44];
			case "ぺ": return [0x45];
			case "ぽ": return [0x46];
			case "ゃ": return [0x47];
			case "ゅ": return [0x48];
			case "ょ": return [0x49];
			case "っ": return [0x4A];
			case "ぁ": return [0x4B];
			case "ぃ": return [0x4C];
			case "ぅ": return [0x4D];
			case "ぇ": return [0x4E];
			case "ぉ": return [0x4F];
			case "ア": return [0x50];
			case "イ": return [0x51];
			case "ウ": return [0x52];
			case "エ": return [0x53];
			case "オ": return [0x54];
			case "ヤ": return [0x55];
			case "ユ": return [0x56];
			case "ヨ": return [0x57];
			case "カ": return [0x58];
			case "キ": return [0x59];
			case "ク": return [0x5A];
			case "ケ": return [0x5B];
			case "コ": return [0x5C];
			case "ワ": return [0x5D];
			case "ヲ": return [0x5E];
			case "ン": return [0x5F];
			case "サ": return [0x60];
			case "シ": return [0x61];
			case "ス": return [0x62];
			case "セ": return [0x63];
			case "ソ": return [0x64];
			case "ガ": return [0x65];
			case "ギ": return [0x66];
			case "グ": return [0x67];
			case "タ": return [0x68];
			case "チ": return [0x69];
			case "ツ": return [0x6A];
			case "テ": return [0x6B];
			case "ト": return [0x6C];
			case "ゲ": return [0x6D];
			case "ゴ": return [0x6E];
			case "ザ": return [0x6F];
			case "ナ": return [0x70];
			case "ニ": return [0x71];
			case "ヌ": return [0x72];
			case "ネ": return [0x73];
			case "ノ": return [0x74];
			case "ジ": return [0x75];
			case "ズ": return [0x76];
			case "ゼ": return [0x77];
			case "ハ": return [0x78];
			case "ヒ": return [0x79];
			case "フ": return [0x7A];
			case "ヘ": return [0x7B];
			case "ホ": return [0x7C];
			case "ゾ": return [0x7D];
			case "ダ": return [0x7E];
			case "マ": return [0x80];
			case "ミ": return [0x81];
			case "ム": return [0x82];
			case "メ": return [0x83];
			case "モ": return [0x84];
			case "ヅ": return [0x85];
			case "デ": return [0x86];
			case "ド": return [0x87];
			case "ラ": return [0x88];
			case "リ": return [0x89];
			case "ル": return [0x8A];
			case "レ": return [0x8B];
			case "ロ": return [0x8C];
			case "バ": return [0x8D];
			case "ビ": return [0x8E];
			case "ブ": return [0x8F];
			case "ベ": return [0x90];
			case "ボ": return [0x91];
			case "パ": return [0x92];
			case "ピ": return [0x93];
			case "プ": return [0x94];
			case "ペ": return [0x95];
			case "ポ": return [0x96];
			case "ャ": return [0x97];
			case "ュ": return [0x98];
			case "ョ": return [0x99];
			case "ッ": return [0x9A];
			case "ァ": return [0x9B];
			case "ィ": return [0x9C];
			case "ゥ": return [0x9D];
			case "ェ": return [0x9E];
			case "ォ": return [0x9F];
		}

		return [0xFF];
	}
}
