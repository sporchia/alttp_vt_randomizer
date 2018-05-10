<?php namespace ALttP\Support;

/**
 * BPS class for creating delta patches on files.
 */
class Bps {
	const BPS_ACTION_SOURCE_READ = 0;
	const BPS_ACTION_TARGET_READ = 1;
	const BPS_ACTION_SOURCE_COPY = 2;
	const BPS_ACTION_TARGET_COPY = 3;

	public function bpsFromFiles(string $original, string $modified) {
		if (!is_readable($modified) || !is_readable($original)) {
			throw new \Exception('Source Files not readable');
		}

		// header
		$bps = ['B', 'P', 'S', '1'];
		$bps = array_merge($bps, $this->encodeNumber(filesize($original)));
		$bps = array_merge($bps, $this->encodeNumber(filesize($modified)));
		$bps = array_merge($bps, [0x80]); // no metadata

		$original_rom = fopen($original, "r");
		$modified_rom = fopen($modified, "r");

		$source_string = file_get_contents($original);
		$target_string = file_get_contents($modified);

		$source = 0;
		$output_offset = 0;
		$target_offset = 0;
		$source_offset = 0;
		$target = '';
		$out = [];
		while (!feof($original_rom) && !feof($modified_rom)) {
			$original_byte = fread($original_rom, 1);
			$modified_byte = fread($modified_rom, 1);
			if ($output_offset % 1024 == 0 && $output_offset % 10 == 0) {
				echo sprintf("%s : %skb (%s :: %s)\n", microtime(true), $output_offset / 1024, $source, strlen($target));
			}
			++$output_offset;
			if ($modified_byte === $original_byte) {
				if ($target) {
					$target_legth = strlen($target);
					if ($target_legth > 5) {
						$search_target = strpos(substr($target_string, 0, $output_offset - $target_legth), $target);
						if ($search_target !== false) {
							$realitve_target_offset = $search_target - $target_offset;
							$bps = array_merge($bps, $this->encodeNumber(static::BPS_ACTION_TARGET_COPY | (($target_legth - 1) << 2)),
								$this->encodeNumber(($realitve_target_offset < 0) | (abs($realitve_target_offset) << 1)));
							$target_offset += $realitve_target_offset + $target_legth;
							continue;
						}

						$search_source = strpos($source_string, $target);
						if ($search_source !== false) {
							$realitve_source_offset = $search_target - $source_offset;
							$bps = array_merge($bps, $this->encodeNumber(static::BPS_ACTION_SOURCE_COPY | (($target_legth - 1) << 2)),
								$this->encodeNumber(($realitve_source_offset < 0) | (abs($realitve_source_offset) << 1)));
							$source_offset += $realitve_source_offset + $target_legth;
						}
					} else {
						$bps = array_merge($bps, $this->encodeNumber(static::BPS_ACTION_TARGET_READ | (($target_legth - 1) << 2)), unpack('C*', $target));
					}
					$target = '';
				}
				++$source;
			} else {
				if ($source) {
					$bps = array_merge($bps, $this->encodeNumber(static::BPS_ACTION_SOURCE_READ | (($source - 1) << 2)));
					$source = 0;
				}
				$target .= $modified_byte;
			}
		}
		fclose($modified_rom);
		fclose($original_rom);

		// footer
		$bps = array_merge($bps, array_values(unpack('C*', pack('H*', hash_file('crc32', $original)))));
		$bps = array_merge($bps, array_values(unpack('C*', pack('H*', hash_file('crc32', $modified)))));
		$bps_string = pack('C*', ...$bps);
		$bps_string .= pack('H*', hash('crc32', $bps_string));

		return $bps_string;
	}

	public function encodeNumber($number) {
		$dataBytes = [];
		while(true){
			$x = $number & 0x7f;
			$number >>= 7;
			if($number == 0){
				$dataBytes[] = 0x80 | $x;
				break;
			}
			$dataBytes[] = $x;
			$number--;
		}
		return $dataBytes;
	}

	public function decodeNumber(array $dataBytes, int $offset = 0) {
		$number = 0;
		$shift = 1;

		while(true) {
			$byte = $dataBytes[$offset++];
			$number += ($byte & 0x7f) * $shift;
			if ($byte & 0x80) {
				break;
			}
			$shift <<= 7;
			$number += $shift;
		}

		return $number;
	}
}
