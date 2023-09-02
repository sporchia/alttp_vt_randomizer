<?php

/**
 * Pick the random function to use when we call PRNG.
 *
 * @param int $min minimum value inclusive
 * @param int $max maximum value inclusive
 */
function get_random_int($min = PHP_INT_MIN, $max = PHP_INT_MAX): int
{
    return mt_rand($min, $max);
    // @TODO use the below line when we are done with fixed PRNG
    // return random_int($min, $max);
}

/**
 * Convert PC address to SNES Lorom addresses.
 *
 * @param int $address
 */
function pc_to_snes(int $address): int
{
    return (($address << 1) & 0x7F0000) | ($address & 0x7FFF) | 0x8000;
}

/**
 * Convert SNES Lorom address to PC addresses.
 *
 * @param int $address
 */
function snes_to_pc(int $address): int
{
    return (($address & 0x7F0000) >> 1) | ($address & 0x7FFF);
}

/**
 * Count set bits in an integer
 *
 * @param int $value
 *
 * @return int
 */
function count_set_bits(int $value)
{
    if ($value == 0) {
        return 0;
    } else {
        return ($value & 1) + count_set_bits($value >> 1);
    }
}
