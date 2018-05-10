<?php namespace ALttP\Support;

/**
 * Class to convert our byte array data to IPS format and vice versus.
 */
class Ips {
	public function patchToIps(array $patch) : string {
		$ips = 'PATCH';
		foreach ($patch as $write) {
			foreach ($write as $address => $bytes) {
				$ips .= substr(pack('N', $address), 1);
				$ips .= pack('n', count($bytes));
				$ips .= pack('C*', ...$bytes);
			}
		}
		$ips .= 'EOF';

		return $ips;
	}

	public function ipsToPatch(string $ips) : array {
		if (substr($ips, 0, 5) !== 'PATCH') {
			throw new \Exception('Header not present');
		}
		if (substr($ips, -3) !== 'EOF') {
			throw new \Exception('EOF not present');
		}

		$data = substr($ips, 5, -3);

		$output = [];
		while (!empty($data)) {
			$address = array_first(unpack('N', pack('C', 0x00) . substr($data, 0, 3)));
			$length = array_first(unpack('n', substr($data, 3, 2)));

			$output[$address] = array_values(unpack('C*', substr($data, 5, $length)));

			$data = substr($data, $length + 5);
		}

		return $output;
	}

	public function ipsFromFiles(string $original_rom, string $updated_rom) {
		if (!is_readable($updated_rom) || !is_readable($original_rom)) {
			throw new \Exception('Source Files not readable');
		}

		$original_rom = fopen($original_rom, "r");
		$updated_rom = fopen($updated_rom, "r");

		$i = 0;
		$cont = $i;
		$out = [];
		while (!feof($original_rom)) {
			$original_byte = fread($original_rom, 1);
			$updated_byte = fread($updated_rom, 1);
			if ($updated_byte !== $original_byte) {
				$out[$i] = [unpack('C*', $updated_byte)[1]];
			}
			$i++;
		}

		$backwards = array_reverse($out, true);
		foreach ($backwards as $off => $value) {
			if (isset($backwards[$off - 1])) {
				$backwards[$off - 1] = array_merge($backwards[$off - 1], $backwards[$off]);
				unset($backwards[$off]);
			}
		}
		$forwards = array_reverse($backwards, true);

		array_walk($forwards, function(&$write, $address) {
			$write = [$address => $write];
		});

		return $this->patchToIps(array_values($forwards));
	}
}
