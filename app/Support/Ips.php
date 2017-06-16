<?php namespace ALttP\Support;

/**
 * Class to convert our byte array data to IPS format and vice versus.
 */
class Ips {
	public function byteArrayToIps(array $patch) : string {
		$ips = 'PATCH';
		foreach ($patch as $address => $bytes) {
			$ips .= substr(pack('N', $address), 1);
			$ips .= pack('n', count($bytes));
			$ips .= pack('C*', ...$bytes);
		}
		$ips .= 'EOF';
	}

	public function ipsToByteArray(string $ips) : array {
		if (substr($ips, 0, 5) !== 'PATCH') {
			throw new \Exception('Header not present');
		}
		if (substr($ips, -3) !== 'EOF') {
			throw new \Exception('EOF not present');
		}

		// @TODO implement
	}
}
