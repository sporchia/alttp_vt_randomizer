<?php

/**
 * Pick the random function to use when we call PRNG
 *
 * @param int $min
 * @param int $max
 *
 * @return int
 */
function get_random_int($min = PHP_INT_MIN, $max = PHP_INT_MAX)
{
    return random_int($min, $max);
}

/**
 * Convert PC address to SNES Lorom addresses
 *
 * @param int $address
 *
 * @return int
 */
function pc_to_snes(int $address)
{
    return (($address << 1) & 0x7F0000) | ($address & 0x7FFF) | 0x8000;
}

/**
 * Convert SNES Lorom address to PC addresses
 *
 * @param int $address
 *
 * @return int
 */
function snes_to_pc(int $address)
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
