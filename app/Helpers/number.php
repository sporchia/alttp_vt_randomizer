<?php
/**
 * Pick the random function to use when we call PRNG
 *
 * @param int $min
 * @param int $max
 *
 * @return int
 */
function get_random_int($min = PHP_INT_MIN, $max = PHP_INT_MAX) {
	if (config('tournament-mode')) {
		return random_int($min, $max);
	}
	return mt_rand($min, $max);
}

/**
 * Convert PC address to SNES Lorom addresses
 *
 * @param int $address
 *
 * @return int
 */
function pc_to_snes(int $address) {
	return (($address * 2) & 0xFF0000) + ($address & 0x7FFF) + 0x8000;
}

/**
 * Convert SNES Lorom address to PC addresses
 *
 * @param int $address
 *
 * @return int
 */
function snes_to_pc(int $address) {
	return ($address & 0x7FFF) + (($address / 2) & 0xFF8000);
}
