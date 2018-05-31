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
