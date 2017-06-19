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
}
