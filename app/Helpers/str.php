<?php
/**
 * mb_str_pad
 *
 * @param string $input
 * @param int $pad_length
 * @param string $pad_string
 * @param int $pad_type
 * @param string $encoding
 *
 * @return string
 */
function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT, $encoding = null) {
    if (!$encoding) {
        $diff = strlen($input) - mb_strlen($input);
    } else {
        $diff = strlen($input) - mb_strlen($input, $encoding);
    }
    return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
}
