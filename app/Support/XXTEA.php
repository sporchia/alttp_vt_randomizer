<?php namespace ALttP\Support;

/**
 * XXTEA encryption algorithm library for PHP.
 */
class XXTEA {
	const DELTA = 0x9E3779B9;
	protected $key;

	/**
	 * Create encryptor
	 *
	 *	@param array $key 16 byte (max) key to use for encryption/decryption
	 */
	public function __construct(array $key = []) {
		$this->key = array_values(unpack('L*', pack('C*', ...array_slice(array_merge($key, array_fill(0, 16, 0)), 0, 16))));
	}

	/**
	 * encrypt the byte array
	 *
	 * @param array $unencrypted data array to encrypt
	 *
	 * @return array
	 */
	public function encrypt(array $unencrypted) {
		if (count($unencrypted) < 8) {
			throw new \Exception('Data to encrypt must be at least 8 bytes long');
		}

		$unencrypted = array_values(unpack('L*', pack('C*', ...array_slice(array_merge($unencrypted, array_fill(0, 4, 0)), 0, ceil(count($unencrypted) / 4) * 4))));
		$encrypted = $unencrypted;

		$n = count($unencrypted) - 1;
		$z = $unencrypted[$n];
		$q = floor(6 + 52 / ($n + 1));

		$sum = 0;
		while (0 < $q--) {
			$sum = $this->int32($sum + self::DELTA);
			$e = $sum >> 2 & 3;
			for ($p = 0; $p < $n; $p++) {
				$y = $encrypted[$p + 1];
				$z = $encrypted[$p] = $this->int32($encrypted[$p] + $this->mx($sum, $y, $z, $p, $e, $this->key));
			}
			$y = $encrypted[0];
			$z = $encrypted[$n] = $this->int32($encrypted[$n] + $this->mx($sum, $y, $z, $p, $e, $this->key));
		}
		return array_values(unpack('C*', pack('L*', ...$encrypted)));
	}

	/**
	 * encrypt the byte array
	 *
	 * @param array $encrypted data array to encrypt
	 *
	 * @return array
	 */
	public function decrypt(array $encrypted) {
		$encrypted = array_values(unpack('L*', pack('C*', ...$encrypted)));
		$unencrypted = $encrypted;

		$n = count($encrypted) - 1;
		$y = $encrypted[0];
		$q = floor(6 + 52 / ($n + 1));

		$sum = $this->int32($q * self::DELTA);
		while ($sum != 0) {
			$e = $sum >> 2 & 3;
			for ($p = $n; $p > 0; $p--) {
				$z = $unencrypted[$p - 1];
				$y = $unencrypted[$p] = $this->int32($unencrypted[$p] - $this->mx($sum, $y, $z, $p, $e, $this->key));
			}
			$z = $unencrypted[$n];
			$y = $unencrypted[0] = $this->int32($unencrypted[0] - $this->mx($sum, $y, $z, $p, $e, $this->key));
			$sum = $this->int32($sum - self::DELTA);
		}
		return array_values(unpack('C*', pack('L*', ...$unencrypted)));
	}

	private function mx($sum, $y, $z, $p, $e, $k) {
		return ((($z >> 5 & 0x07FFFFFF) ^ $y << 2) + (($y >> 3 & 0x1FFFFFFF) ^ $z << 4)) ^ (($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
	}

	private function int32($n) {
		return ($n & 0xFFFFFFFF);
	}
}
